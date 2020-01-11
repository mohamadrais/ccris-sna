<?php
$memberInfo = getMemberInfo();
// echo $memberInfo['group'];
if ($memberInfo['group'] != 'Admins') {
?>
    <script type='text/javascript'>
        document.observe("dom:loaded", function() {
            $j('label[for="memberID"]').parent().hide();
        });
    </script>
<?php
}
?>
<script type='text/javascript'>
    document.observe("dom:loaded", function() {
		var $el = $j('#fo_ReportsTo-container'),
			s2Version3 = false,
			s2Version4 = false;

		$el.on( 'select2:opening', function() {
			// this event only works for v4
			s2Version4 = true;
		});

		$el.on( 'select2-opening', function() {
			// this event only works for v3
			s2Version3 = true;
		});

		$el.on( 'change', function() {
			if ( s2Version3 ) {
				console.log('s2 version: 3');
			} else {
				console.log('s2 version: 4');
			}
		});
		
		if($j('#notif-dropdown').is(':visible')){
			$j('#notif-dropdown').on('click touchstart', function(e) {
				e.preventDefault(); 
				// e.stopPropagation();
				$j.ajax({
					url: "ajax_crud_noti.php",
					method: "POST",
					data: {
						'o'	 : 'select',
						'nls': '0',
						'nl' : '20'
					},
					dataType: "JSON",
					success: function(notifData) {
						// var keys = Object.keys(notifData[0]);
						// notiArr = [];
						// for (i=0; i< keys.length; i++){
						// 	_dataColumnNames.push(keys[i].replace(/_/g, ' '));
						// }
						// notiArr.push(_dataColumnNames);
						$j('#notif-dropdown-area').empty();
						let unreadCount = 0;
						if(notifData.length > 0){
							let _notifications=[];
							let day = moment($j.ajax({async: false}).getResponseHeader( 'Date' )).tz("Asia/Kuala_Lumpur");
							for(x=0; x< notifData.length; x++){
								let currNotifLine = '';
								notifIconClass = '', readFlagClass = '';
								switch(notifData[x]['notif_title']){
									case 'New work order':
										notifIconClass = 'class="fa fa-tasks pull-right text-info"';
										break;
									case 'Update on work order':
										notifIconClass = 'class="fa fa-paperclip fa-pull-right text-warning"';
										break;
									case 'KPI not achieved':
										notifIconClass = 'class="fa fa-exclamation-circle fa-pull-right text-danger"';
										break;
								}
								if (notifData[x]['read_flag'] == 'N'){
									unreadCount++;
									readFlagClass = 'class="new"';
									btnReadText = 'Mark as Read';
								} 
								else{
									btnReadText = 'Mark as Unread';
								}
								let notif_time = moment(notifData[x]['notif_time']);
								if(moment(notif_time).isSame(day, 'day')){
									notif_time = notif_time.format('hh:mm A');
								}
								else {
									notif_time = moment(notif_time).fromNow();
								}
								currNotifLine += `
									
									<a id="notif_id_${notifData[x]['id']}" ${readFlagClass} href="${notifData[x]['notif_url']}">
										<div class="mail-contnet">
											<i ${notifIconClass}></i>
											<h5>${notifData[x]['notif_title']}</h5><span class="mail-desc">${notifData[x]['notif_msg']}<span class="time">${notif_time}</span> </div>
										</span>
									</a>`;
								_notifications.push(currNotifLine);
							}
							if(unreadCount > 0){
								if(!$j('#notif-heartbit').hasClass('hearbit')) $j('#notif-heartbit').addClass('heartbit');
								if(!$j('#notif-point').hasClass('point')) $j('#notif-point').addClass('point');		
							}
							$j('#notif-dropdown-area').prepend(_notifications);
						}
						else{
							$j('#notif-dropdown-area').prepend(`
								<a href="#">
									<div class="mail-contnet">
										<h5>You do not have any active notifications</h5> <span class="mail-desc"></span> <span class="time"></span> </div>
								</a>
							`);
							$j('#mark-all-read').hide();
							$j('#see-all-notif').hide();
						}
						
					},         
					error: function(response) {
						console.log('notif-dropdown ajax error: ' + response.statusText);
					},
				});
			});
			$j('#notif-dropdown-area').on("click touchstart", "a[id^='notif_id_']" , function(e) {
				e.preventDefault();
				// e.stopPropagation();
				
				var nId = $j(this).attr('id').substr(9, $j(this).attr('id').length-1);
				if($j(this).hasClass('new')){
					$j.ajax({
						url: "ajax_crud_noti.php",
						method: "POST",
						data: {
							'o'  : 'toggle_r',
							'nId': nId
						},
						dataType: "JSON",
						success: function(read_flag_returned) {
							// window.location = $link.attr('href');
						},         
						error: function(response) {
							console.log('notif-dropdown-area-a ajax error: ' + response.statusText);
						},
					});
				}
				var unreadCount = 0;
				$j(this).parent().find('a').each(function(i, el){
					if($j(el).hasClass('new')) unreadCount++;
				});
				if(unreadCount <= 1){
					if($j('#notif-heartbit').hasClass('heartbit')) $j('#notif-heartbit').removeClass('heartbit');
					if($j('#notif-point').hasClass('point')) $j('#notif-point').removeClass('point');
				}
				window.location = $j(this).attr('href');
			});
			$j('#mark-all-read').on("click touchstart", function(e) {
				e.preventDefault();
				e.stopPropagation();
				$j('#notif-dropdown-area a').each(function(i, el){
					var nId = $j(el).attr('id').substr(9, $j(el).attr('id').length-1);
					if($j(this).hasClass('new')){
						$j.ajax({
							url: "ajax_crud_noti.php",
							method: "POST",
							data: {
								'o'  : 'toggle_r',
								'nId': nId
							},
							dataType: "JSON",
							success: function(read_flag_returned) {
								$j(el).removeClass('new');
							},         
							error: function(response) {
								console.log('notif-dropdown-mark-all ajax error: ' + response.statusText);
							},
						});
					}
				});
				if($j('#notif-heartbit').hasClass('heartbit')) $j('#notif-heartbit').removeClass('heartbit');
				if($j('#notif-point').hasClass('point')) $j('#notif-point').removeClass('point');
			});
		}
		
		
		if($j('#attach').is(':visible')){
			$j('#attach').on('click touchstart', function(e) {
				// e.preventDefault(); 
				// e.stopPropagation();
				var tableName = $j('[name ="myform"]').attr('action');
				tableName = tableName.substr(0, tableName.indexOf('_view.php'));
				var selectedID = $j("[aria-labelledby='selectedID']").html().trim();
				var uniqID = uniqId();
				$j('div[id$="dv_action_buttons"]').append(`
					<div class="modal" id="wo_modal">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="card-title">Select a work order</h4>
								</div>
								<div class="modal-body">
									<div class="message-box" style="max-height: 358px;overflow: scroll;">
										<ul class="list-task todo-list list-group m-b-0" id="wo_content_list">
											<span id="wo_content-container${uniqID}"></span>
											<input type="hidden" name="wo_content-input" id="wo_content-input${uniqID}" value="">
										</ul>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary" id="attachWOButton" disabled>Attach</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				`);
				get_workorders(tableName, selectedID, uniqID);
			});
		}
		function uniqId() {
			return Math.round(new Date().getTime() + (Math.random() * 100));
		}
		if(!$j('#searchPageForm').is(':visible')){
			$j('#fullsearchicon').parent().replaceWith(`
				<form role="search" method="get" class="search-form" action="search.php" id="searchForm">
					<label>
						<input class="search-field" placeholder="Search" value="" name="searchText" type="search" id="searchText">
					</label>
					<i id="fullsearchicon" class="glyphicon glyphicon-search" style="font-size: 18px"></i>
					<input type="hidden" name="page" value="1" class="form-control">
					<input type="hidden" id="dateStart" name="dateStart" value="" class="form-control">
					<input type="hidden" id="dateEnd" name="dateEnd" value="" class="form-control">
					<input type="hidden" id="departmentID" name="departmentID" value="0" class="form-control">
					<input type="hidden" id="tableName" name="tableName" value="All tables" class="form-control">
				</form>`);
			
			var today = moment($j.ajax({async: false}).getResponseHeader( 'Date' )).tz("Asia/Kuala_Lumpur");
			var dateStart = moment(today).subtract(365, 'days').format("YYYY-MM-DD");
			var dateEnd = moment(today).format("YYYY-MM-DD");
			$j('#dateStart').val(dateStart);
			$j('#dateEnd').val(dateEnd);
			
			$j("#fullsearchicon").on("click touchstart",function(e){
				e.preventDefault();
				if($j('#searchText').hasClass('open') && $j('#searchText').val().length >= 3){
					$j('#searchForm').submit();
					// 	window.location.replace("search.php");
				}
				else{
					$j(".search-field").toggleClass("open");
				}
			});
		}
		else{
			$j('#fullsearchicon').prop("disabled", true);
			$j('#fullsearchicon').parent().removeAttr('href');
		}

		$j('#searchText').keypress(function(e){
			if(e.which == 13){	// Enter key pressed
				e.preventDefault();
				if(e.target.value.length >= 3){
					if(!$j('#searchPageForm').is(':visible')){
						$j("#fullsearchicon").click();
					}
					else if($j('#searchPageForm').is(':visible')){
						$j('#submitSearch').click();
					}
				}
				else{
					$j("#searchText").effect( "shake", { direction: "up", times: 3, distance: 2}, 600 );
				}
			}
		});

		$j('#submitSearch').on("click touchstart",function(e){
			if($j('#searchText').val().length < 3){
				e.preventDefault();
				$j("#searchText").effect( "shake", { direction: "up", times: 3, distance: 2}, 600 );
			}
		});
		
		$j("#searchText").on("change paste keyup", function() {
			if($j(this).val().length == 0){
				$j(this).removeClass("successSearch");
				$j(this).removeClass("errorSearch");
			}
			else if($j(this).val().length<3){
				$j(this).addClass("errorSearch");
				$j(this).removeClass("successSearch");
			}
			else{
				$j(this).addClass("successSearch");
				$j(this).removeClass("errorSearch");
			}
		});
		
		if($j("[aria-labelledby='selected_wo_ID']").is(":visible")){
			var selected_wo_ID = $j("[aria-labelledby='selected_wo_ID']").html().trim();
			get_workorder_related_records(selected_wo_ID);
		}
    });
        ///////////////////////////////////////////////
        if ($j("#startEdit").is(":visible")){
			$j("input").attr("readonly", true);
			$j("textarea").attr("readonly", true);
            $j("select").attr("disabled", true);
            setTimeout(function(){ 
                $j(".nicEdit-main").attr("contenteditable", "false");
                $j('input[type="radio"]').attr("disabled", true);
            }, 3000);
            $j("[id*='_remove']").each(function (i, el) {
                el.hide();
            });
            $j('.dropify').each(function (i, el) {
                if(el.files.length==0) {
                    $j(this).parent().hide();
                }
            });
            $j('[for="editAttachment"]').each(function (i, el) {
                el.hide();
            });

			$j("#startEdit").click(function(){
				$j("input").attr("readonly", false);
				$j("textarea").attr("readonly", false);
                $j("select").attr("disabled", false);
                $j('[class="control-label text-muted"]').show();
                $j('input[type="radio"]').attr("disabled", false);
				$j(".nicEdit-main").attr("contenteditable", "true");

				if (!$j("#ot_SharedLink1").is(":visible")) {
					$j("#ot_SharedLink1").show();
					$j('#ot_SharedLink1_remove').show();
				}

				if (!$j("#ot_Ref01").is(":visible")) {
					$j("#ot_Ref01").parent().parent().show();
                }
                if (!$j("#ot_Ref04").is(":visible")) {
					$j("#ot_Ref04").parent().parent().show();
                }
                if (!$j("#ot_Photo01").is(":visible")) {
					$j("#ot_Photo01").parent().parent().show();
                }

                $j('[for="editAttachment"]').each(function (i, el) {
                    el.show();
                });

				$j(this).hide();
				$j("#exitEdit").show();
			});
			
			$j("#exitEdit").click(function(){
				$j("input").attr("readonly", true);
				$j("textarea").attr("readonly", true);
                $j("select").attr("disabled", true);
                $j('input[type="radio"]').attr("disabled", true);
				$j(".nicEdit-main").attr("contenteditable", "false");
				$j('#ot_SharedLink1_remove').hide();
                $j('#ot_SharedLink2_remove').hide();
                $j('#addLink').hide();
                $j('#addDocument').hide();
                $j('#addCompFolder').hide();
                $j('#addPhoto').hide();
				$j(this).hide();
				$j("#startEdit").show();
            });
        }
            
            ///////////////////////////////////////////////
		{
			var _x = $j('#totalLinkAttached').html();
			if (!_x) {
				_x = 0;
			}

			if ($j('#ot_SharedLink1').val().length > 0) {
				_x++;
			}

			if ($j('#ot_SharedLink2').val().length > 0) {
				_x++;
			} else {
				$j('#ot_SharedLink2').hide();
				$j('#ot_SharedLink2_remove').hide();
			}

			$j('#totalLinkAttached').html(_x);

			$j('#ot_SharedLink1').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_SharedLink1').val().length > 0) {
					x++;
				}
				if ($j('#ot_SharedLink2').val().length > 0) {
					x++;
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('#ot_SharedLink2').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_SharedLink1').val().length > 0) {
					x++;
				}
				if ($j('#ot_SharedLink2').val().length > 0) {
					x++;
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('#ot_SharedLink1_remove').click(function () {
				var x = $j('#totalLinkAttached').html();
				if (!x) {
					x = 0;
				}
				if ($j('#ot_SharedLink1').val().length > 0 && $j('#ot_SharedLink2').val().length > 0) {
					$j('#ot_SharedLink1').val('');
					$j("#ot_SharedLink1").hide();
					$j('#ot_SharedLink1_remove').hide();
					$j("#addLink").show()
					x--;
				} else if ($j('#ot_SharedLink1').val().length > 0 && $j('#ot_SharedLink2').val().length == 0) {
					$j('#ot_SharedLink1').val('');
					x--;
				} else if ($j('#ot_SharedLink1').val().length == 0 && $j('#ot_SharedLink2').val().length == 0) {
					$j("#ot_SharedLink1").hide();
					$j('#ot_SharedLink1_remove').hide();
					$j("#addLink").show();
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('#ot_SharedLink2_remove').click(function () {
				var x = $j('#totalLinkAttached').html();
				if (!x) {
					x = 0;
				}
				if ($j('#ot_SharedLink1').val().length > 0 && $j('#ot_SharedLink2').val().length > 0) {
					$j('#ot_SharedLink2').val('');
					$j("#ot_SharedLink2").hide();
					$j('#ot_SharedLink2_remove').hide();
					$j("#addLink").show();
					x--;
				} else if ($j('#ot_SharedLink1').val().length == 0 && $j('#ot_SharedLink2').val().length > 0) {
					$j('#ot_SharedLink2').val('');
					x--;
				} else if ($j('#ot_SharedLink1').val().length == 0 && $j('#ot_SharedLink2').val().length == 0) {
					$j("#ot_SharedLink2").hide();
					$j('#ot_SharedLink2_remove').hide();
					$j("#addLink").show();
				}
				$j('#totalLinkAttached').html(x);
			});
			$j("#addLink").click(function () {

				if (!$j("#ot_SharedLink1").is(":visible")) {
					$j("#ot_SharedLink1").show();
					$j('#ot_SharedLink1_remove').show();
				} else if (!$j("#ot_SharedLink2").is(":visible")) {
					$j("#ot_SharedLink2").show();
					$j('#ot_SharedLink2_remove').show();
				}

				if ($j("#ot_SharedLink1").is(":visible") && $j("#ot_SharedLink2").is(":visible")) {
					$j("#addLink").hide();
				}
			});
		}
		///////////////////////////////////////////////
		{
			var _x = $j('#totalDocumentAttached').html();
			if (!_x) {
				_x = 0;
			}
			if ($j('#ot_Ref01').val().length > 0) {
				_x++;
			}
			if ($j('#ot_Ref02').val().length > 0) {
				_x++;
			} else {
				// $j('#ot_Ref02').hide();
				$j("#ot_Ref02").parent().hide();
			}
			if ($j('#ot_Ref03').val().length > 0) {
				_x++;
			} else {
				// $j('#ot_Ref03').hide();
				$j("#ot_Ref03").parent().hide();
			}
			$j('#totalDocumentAttached').html(_x);

			$j('#ot_Ref01').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref02').val().length > 0) {
					x++;
				}
				$j('#totalDocumentAttached').html(x);
			});
			$j('#ot_Ref02').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref02').val().length > 0) {
					x++;
				}
				$j('#totalDocumentAttached').html(x);
			});

			$j("#addDocument").click(function () {

				if (!$j("#ot_Ref01").parent().parent().is(":visible")) {
					// $j("#ot_Ref01").show();
					$j("#ot_Ref01").parent().parent().show();
				} else if (!$j("#ot_Ref02").parent().parent().is(":visible")) {
					// $j("#ot_Ref02").show();
					$j("#ot_Ref02").parent().parent().show();
				} else if (!$j("#ot_Ref03").parent().parent().is(":visible")) {
					// $j("#ot_Ref03").show();
					$j("#ot_Ref03").parent().parent().show();
				}

				if ($j("#ot_Ref01").parent().parent().is(":visible") && $j("#ot_Ref02").parent().parent().is(":visible") && $j("#ot_Ref03").parent().parent().is(":visible")) {
					$j("#addDocument").hide();
				}
			});
		}

		///////////////////////////////////////////////

		{
			var _x = $j('#totalCompFolderAttached').html();
			if (!_x) {
				_x = 0;
			}
			if ($j('#ot_Ref04').val().length > 0) {
				_x++;
			}
			if ($j('#ot_Ref05').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Ref05').parent().hide()
			}
			if ($j('#ot_Ref06').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Ref06').parent().hide();
			}
			$j('#totalCompFolderAttached').html(_x);

			$j('#ot_Ref04').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref04').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref05').val().length > 0) {
					x++;
				}
				$j('#totalCompFolderAttached').html(x);
			});
			$j('#ot_Ref05').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Ref04').val().length > 0) {
					x++;
				}
				if ($j('#ot_Ref05').val().length > 0) {
					x++;
				}
				$j('#totalCompFolderAttached').html(x);
			});

			$j("#addCompFolder").click(function () {

				if (!$j("#ot_Ref04").parent().parent().is(":visible")) {
					$j("#ot_Ref04").parent().parent().show();
				} else if (!$j("#ot_Ref05").parent().parent().is(":visible")) {
					$j("#ot_Ref05").parent().parent().show();
				} else if (!$j("#ot_Ref06").parent().parent().is(":visible")) {
					$j("#ot_Ref06").parent().parent().show();
				}

				if ($j("#ot_Ref04").parent().parent().is(":visible") && $j("#ot_Ref05").parent().parent().is(":visible") && $j("#ot_Ref06").parent().parent().is(":visible")) {
					$j("#addCompFolder").hide();
				}
			});
		}

		///////////////////////////////////////////////

		{
			var _x = $j('#totalPhotoAttached').html();
			if (!_x) {
				_x = 0;
			}
			if ($j('#ot_Photo01').val().length > 0) {
				_x++;
			}
			if ($j('#ot_Photo02').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Photo02').parent().hide()
			}
			if ($j('#ot_Photo03').val().length > 0) {
				_x++;
			} else {
				$j('#ot_Photo03').parent().hide();
			}
			$j('#totalPhotoAttached').html(_x);

			$j('#ot_Photo01').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Photo01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Photo02').val().length > 0) {
					x++;
				}
				$j('#totalPhotoAttached').html(x);
			});
			$j('#ot_Photo02').on("change paste keyup", function () {
				var x = 0;
				if ($j('#ot_Photo01').val().length > 0) {
					x++;
				}
				if ($j('#ot_Photo02').val().length > 0) {
					x++;
				}
				$j('#totalPhotoAttached').html(x);
			});

			$j("#addPhoto").click(function () {

				if (!$j("#ot_Photo01").parent().parent().is(":visible")) {
					$j("#ot_Photo01").parent().parent().show();
				} else if (!$j("#ot_Photo02").parent().parent().is(":visible")) {
					$j("#ot_Photo02").parent().parent().show();
				} else if (!$j("#ot_Photo03").parent().parent().is(":visible")) {
					$j("#ot_Photo03").parent().parent().show();
				}

				if ($j("#ot_Photo01").parent().parent().is(":visible") && $j("#ot_Photo02").parent().parent().is(":visible") && $j("#ot_Photo03").parent().parent().is(":visible")) {
					$j("#addPhoto").hide();
				}
			});
        }
        
    // $j('[id$=dv_action_buttons] .btn-toolbar').append(
    //     '<div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
    //     '<button type="button" class="btn btn-default btn-lg" onclick="$j(\'[id$=_dv_form] :input\').attr(\'readonly\', false);$j(\'[id$=container]\').attr(\'disabled\', false);">' +
    //     '<i class="glyphicon glyphicon-edit"></i> Enable Edit</button>' +
    //     '</div>'
    // );

    // $j('[id$=_dv_form] :input').attr('readonly', true);

    // function readyFn(jquery) {
    //     $x = $j('[id$=_dv_form]');
    //     $j('[id$=container]').prop('disabled', true);
    //     $j('[id$=container]').attr('disabled', true);
    // }
    // jQuery(function() {
    //     setTimeout(function() {
    //         if (typeof(readyFn) == 'function') readyFn();
    //     }, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
    // });
</script>