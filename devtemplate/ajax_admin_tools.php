<?php
	$curr_dir = dirname(__FILE__);
	include("{$curr_dir}/defaultLang.php");
	include("{$curr_dir}/language.php");
	include("{$curr_dir}/lib.php");

	$admin_tools = new AdminTools($_REQUEST);

	class AdminTools{
		private $request, $lang;
		/*
		0:"__construct"
		1:"show_admin_tools"
		2:"get_admin_tools_js"
		3:"get_record_info"
		*/
		public function __construct($request = array()){
			global $Translation;

			
			$this->lang = $Translation;

			/* process request to retrieve $this->request, and then execute the requested action */
			$this->process_request($request);          
			if(!$this->request['action'] == "show_admin_tools"){
				if(!getLoggedAdmin()) return;
			}
			echo call_user_func_array(array($this, $this->request['action']), array());
		}

		protected function process_request($request){
			/* action must be a valid controller, else set to default (show_admin_tools) */
			$controller = isset($request['action']) ? $request['action'] : false;
			if(!in_array($controller, $this->controllers())) $request['action'] = 'show_admin_tools';

			$this->request = $request;
		}

		/**
		 *  discover the public functions in this class that can act as controllers
		 *  
		 *  @return array of public function names
		 */
		protected function controllers(){
			$rc = new ReflectionClass($this);
			$methods = $rc->getMethods(ReflectionMethod::IS_PUBLIC);

			$controllers = array();
			foreach($methods as $mthd){
				$controllers[] = $mthd->name;
			}

			return $controllers;
		}

		/**
		 * function to show admin tools menu for admins, or nothing otherwise
		 */
		public function show_admin_tools(){
			handle_maintenance();

			$tablename = $this->get_table();

			ob_start();
			?>
			<div class="pull-right" style="width:500px;" id="admin-tools-menu-button">
				<button
					type="button" 
					data-toggle="dropdown" 
					class="btn btn-danger btn-xs pull-right" 
					title="<?php if (getLoggedAdmin()) { echo html_attr($this->lang['Admin Information']); } else { echo html_attr($this->lang['Record Information']); }?>" 
				>
					<i class="glyphicon glyphicon-option-vertical"></i>
				</button>
				<div class="dropdown-menu animated bounceInDown" id="admin-tools-menu" style="z-index:1;">
					<h5><b><?php if (getLoggedAdmin()) { ?><?php echo $this->lang['Admin Information']; ?><?php } else { ?><?php echo $this->lang['Record Information']; ?><?php } ?></b></h5>
					<div class="alert alert-danger no-owner hidden"><?php echo $this->lang['record has no owner']; ?></div>
					<form class="message-center">
						<label class="control-label"><?php echo $this->lang['owner']; ?></label>
							<p><i class="ti-user mr-3"></i><span class="owner-username"></span></p>
							<?php if (getLoggedAdmin()) { ?>
							<p><a class="change-owner-link" href="#"><i class="ti-exchange-vertical"></i> <?php echo $this->lang['Change owner']; ?></a></p>
							<p><a class="user-records-link" href="" target="_blank"><i class="ti-calendar"></i> <?php echo str_replace('<tablename>', $tablename, $this->lang['show all user records from table']); ?></a></p>
							<p><a class="user-email-link" href="" target="_blank"><i class="ti-email"></i> <?php echo $this->lang['email this user']; ?></a></p>
							<?php } ?>

						<label class="control-label"><?php echo $this->lang['group']; ?></label>
							<p><i class="icon-people mr-3"></i><span class="owner-group"></span></p>
							<?php if (getLoggedAdmin()) { ?>
							<p><a class="group-records-link" href="" target="_blank"><i class="ti-calendar"></i> <?php echo str_replace('<tablename>', $tablename, $this->lang['show all group records from table']); ?></a></p>
							<p><a class="group-email-link" href="" target="_blank"><i class="ti-email"></i> <?php echo $this->lang['email this group']; ?></a></p>
							<?php } ?>

						<label class="control-label"><?php echo $this->lang['created']; ?></label>
						<p class="record-created"></p>

						<label class="control-label"><?php echo $this->lang['last modified']; ?></label>
						<p class="record-last-modified"></p>
					</form>
				</div>
			</div>

			<div class="clearfix"></div>

			<style>
				#admin-tools-menu-button{ display: inline-block !important; margin: 0 1em; }
				#admin-tools-menu{ padding: 1em 2em; }
				#admin-tools-menu .dl-horizontal dd, #admin-tools-menu .dl-horizontal dt{ padding: 1em 0; }
			</style>

			<?php
			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		}

		/**
		 * function to return the js code for the admin menu
		 */
		public function get_admin_tools_js(){
			handle_maintenance();

			$record_info = $this->get_record_info();
			if(!$record_info || $record_info == 'null') return;

			@header('Content-type: application/javascript');
			ob_start();
			?>

			$j(function(){
				var tablename = '<?php echo $this->get_table(); ?>';
				var record_id = '<?php echo addslashes($this->request['id']); ?>';
				var record_info = <?php echo $record_info; ?>;

				$j('#admin-tools-menu-button')
					.appendTo('.detail_view .panel-title:first')
					.removeClass('invisible');

				$j(window).resize(function(){
					var dv_width = $j('.detail_view').width();
					var menu_width = Math.min(dv_width * .9, 500);
					$j('#admin-tools-menu').width(menu_width);
				}).trigger('resize');

				/* change owner link */
				$j('#admin-tools-menu .change-owner-link').click(function(){
					mass_change_owner(tablename, [record_id]);
					setTimeout(update_username, 900);
					return false;
				});

				/* function to update record info after 'change owner' dialog is gone */
				var update_username = function(){
					/* wait till any modals disappear */
					if(AppGini.modalOpen()) return setTimeout(update_username, 900);

					$j.ajax({
						url: 'ajax_admin_tools.php',
						data: {
							table: tablename,
							id: record_id,
							action: 'get_record_info'
						},
						success: function(ri){
							update_record_info(ri);
						}
					});
				};

				/* function to update record info */
				var update_record_info = function(ri){
					if(ri == undefined) return;
					$j('#admin-tools-menu .no-owner').addClass('hidden');
					$j('#admin-tools-menu .dl-horizontal').removeClass('hidden');

					if(undefined == ri.memberID){
						$j('#admin-tools-menu .no-owner').removeClass('hidden');
						$j('#admin-tools-menu .dl-horizontal').addClass('hidden');
					}

					$j('#admin-tools-menu .owner-username').html(ri.memberID);
					$j('#admin-tools-menu .user-records-link').attr('href', 'admin/pageViewRecords.php?memberID=' + encodeURIComponent(ri.memberID) + '&tableName=' + encodeURIComponent(tablename));
					$j('#admin-tools-menu .user-email-link').attr('href', 'admin/pageMail.php?memberID=' + encodeURIComponent(ri.memberID));

					$j('#admin-tools-menu .owner-group').html(ri.group);
					$j('#admin-tools-menu .group-records-link').attr('href', 'admin/pageViewRecords.php?groupID=' + encodeURIComponent(ri.groupID) + '&tableName=' + encodeURIComponent(tablename));
					$j('#admin-tools-menu .group-email-link').attr('href', 'admin/pageMail.php?groupID=' + encodeURIComponent(ri.groupID));

					$j('#admin-tools-menu .record-created').html(ri.dateAdded);
					$j('#admin-tools-menu .record-last-modified').html(ri.dateUpdated);
				};

				update_record_info(record_info);
			})
			<?php
			$js = ob_get_contents();
			ob_end_clean();

			return $js;
		}

		public function get_record_info(){
			handle_maintenance();
			@header('Content-type: application/json');

			$table = $this->get_table();
			$safe_id = makeSafe($this->request['id']);

			$res = sql("select r.memberID, r.dateAdded, r.dateUpdated, g.groupID, g.name as 'group' from membership_userrecords r left join membership_groups g on r.groupID=g.groupID where r.tableName='{$table}' and r.pkValue='{$safe_id}'", $eo);
			if(!$res) return 'null';
			$rec_info = @db_fetch_assoc($res);

			$admin_config = config('adminConfig');
			$rec_info['dateAdded'] = date($admin_config['PHPDateTimeFormat'], $rec_info['dateAdded']);
			$rec_info['dateUpdated'] = date($admin_config['PHPDateTimeFormat'], $rec_info['dateUpdated']);

			return @json_encode($rec_info);
		}

		/**
		 *  @brief Retrieve and validate name of current table
		 *  @return table name, or false on error.
		 */
		protected function get_table(){
			$table_ok = true;

			$table = $this->request['table'];
			if(!$table) $table_ok = false;

			if($table_ok){
				$tables = getTableList();
				if(!array_key_exists($table, $tables)) $table_ok = false;
			}

			if(!$table_ok) return false;

			return $table;
		}
	}
