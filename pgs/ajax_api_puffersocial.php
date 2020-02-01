<?php
	$curr_dir = dirname(__FILE__);
	include("{$curr_dir}/defaultLang.php");
	include("{$curr_dir}/language.php");
	include("{$curr_dir}/lib.php");

	$admin_tools = new APITools($_REQUEST);

	class APITools{
		private $request, $lang;
		public function __construct($request = array()){
			global $Translation;
			$this->lang = $Translation;
			$return_emtpy = array();

			$url = parse_url($_SERVER['REQUEST_URI']);
			// only requests that are POST and with no URL parameters
			if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($url['query'])) {
				header('Method Not Allowed', true, 405);
				echo @json_encode($return_emtpy);
				exit;
			}
			
			
			/* process request to retrieve $this->request, and then execute the requested action */
			$valid = $this->process_request($request);

			if($valid){
				$mValid = $this->check_valid_member();
				if ($mValid){
					echo call_user_func_array(array($this, $this->request['action']), array());
				}
			}
			handle_maintenance();
			@header('Content-type: application/json');
			echo @json_encode($return_emtpy);
			exit;
		}

		protected function process_request($request){
			/* action must be a valid controller, else return empty array */
			$controller = isset($request['action']) ? $request['action'] : false;
			if(!in_array($controller, $this->controllers())) return false;

			$this->request = $request;
			return true;
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

		private function check_valid_member(){
			if($this->request['m'] != '' && $this->request['t'] != ''){
				$username = makeSafe(strtolower($this->request['m']));
				$email = makeSafe(strtolower($this->request['t']));

				if(sqlValue("select count(1) from membership_users where lcase(memberID)='$username' and email='$email' and isApproved=1 and isBanned=0")==1){
					return true;
				}
			}
			return false;
		}

		/**
		 * function to get_last_five
		 */
		public function get_last_five(){
			handle_maintenance();
			@header('Content-type: application/json');
			$tl = getTableList2(true);
			$company_last5 = $this->get_last_5_comany_records($tl);
			$user_last5 = $this->get_last_5_user_records($tl);
			$user_total_rec = $this->get_total_user_records();

			$output = array(
				'company_last5'  => $company_last5,
				'user_last5' 	 => $user_last5,
				'user_total_rec' => $user_total_rec
			);

			echo @json_encode($output);
			exit;
		}

		/**
		 * function to get last 5 comany records
		 */
		protected function get_last_5_comany_records($tl){
			$res = sql("select tableName, pkValue, from_unixtime(`dateAdded`), from_unixtime(`dateUpdated`) from membership_userrecords order by dateUpdated desc limit 5", $eo);
			$output = array();

			if (isset($res) && $res->num_rows > 0) {
				while($row=db_fetch_row($res)){ 
					$output[] = array(
						'table_name' => $tl[$row[0]],
						'created' => $row[2],
						'modified' => $row[3],
						'data' => substr(getCSVData($row[0], $row[1]),0,20) . '...'

					);
				}
			}
			return $output;
		}

		/**
		 * function to get last 5 user records
		 */
		protected function get_last_5_user_records($tl){
			$res = sql("select tableName, pkValue, from_unixtime(`dateAdded`), from_unixtime(`dateUpdated`) from membership_userrecords where memberID = '" . makeSafe(strtolower($this->request['m'])) . "' order by dateUpdated desc limit 5", $eo);
			$output = array();

			if (isset($res) && $res->num_rows > 0) {
				while($row=db_fetch_row($res)){ 
					$output[] = array(
						'table_name' => $tl[$row[0]],
						'created' => $row[2],
						'modified' => $row[3],
						'data' => substr(getCSVData($row[0], $row[1]),0,20) . '...'

					);
				}
			}
			return $output;
		}

		/**
		 * function to get total number of user records
		 */
		protected function get_total_user_records(){
			$res = sqlValue("select count(*) from membership_userrecords where memberID = '" . makeSafe(strtolower($this->request['m'])) . "'");
			$output = (isset($res)) ? $res : 0;
			return $output;
		}
	}
