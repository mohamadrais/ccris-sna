<?php
global $adminConfig;
$memberInfo = getMemberInfo();
// echo $memberInfo['group'];
if (!($memberInfo['group'] == 'Admins' && $memberInfo['username'] == $adminConfig['adminUsername'])) {
?>
    <script type='text/javascript'>
        $j(document).ready(function() {	
            $j('label[for="memberID"]').parent().hide();
        });
    </script>
<?php
}
?>
<script type='text/javascript'>

	$j(document).ready(function() {	
		if($j('#notif-dropdown').is(':visible')){
			$j('#notif-dropdown').on('click touchstart', function(e) {
				// e.preventDefault(); 
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
					beforeSend: function() {
						if($j('#notifDropdownLoading').length) {
							$j('#notifDropdownLoading').html('<div style="direction: ltr;"><img src="loading.gif"></div>');
						}
					},
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
					complete: function(){
						if($j('#notifDropdownLoading').length) $j('#notifDropdownLoading').html('');
						scrollFlag = false;
					}
				});
			});
			$j('#notif-dropdown-area').on("click", "a[id^='notif_id_']" , function(e) {
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
			$j('#mark-all-read').on("click", function(e) {
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
							beforeSend: function() {
								if($j('#notifDropdownLoading').length) {
									$j('#notifDropdownLoading').html('<div style="direction: ltr;"><img src="loading.gif"></div>');
								}
							},
							success: function(read_flag_returned) {
								$j(el).removeClass('new');
							},         
							error: function(response) {
								console.log('notif-dropdown-mark-all ajax error: ' + response.statusText);
							},
							complete: function(){
								if($j('#notifDropdownLoading').length) $j('#notifDropdownLoading').html('');
								scrollFlag = false;
							}
						});
					}
				});
				if($j('#notif-heartbit').hasClass('heartbit')) $j('#notif-heartbit').removeClass('heartbit');
				if($j('#notif-point').hasClass('point')) $j('#notif-point').removeClass('point');
			});
		}
		
		
		// if($j('#attach').is(':visible')){
			$j('#attach').on('click touchstart', function(e) {
				// e.preventDefault(); 
				// e.stopPropagation();
				var tableName = $j('[name ="myform"]').attr('action');
				tableName = tableName.substr(0, tableName.indexOf('_view.php'));
				var selectedID = $j("[aria-labelledby='selectedID']").html().trim();
				var uniqID = uniqId();
				$j('[name ="myform"]').append(`
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
									<button type="button" class="btn btn-outline-plain" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				`);
				get_workorders(tableName, selectedID, uniqID);
			});
		// }
		function uniqId() {
			return Math.round(new Date().getTime() + (Math.random() * 100));
		}
		if(!$j('#searchPageForm').is(':visible')){
			var today = moment($j.ajax({async: false}).getResponseHeader( 'Date' )).tz("Asia/Kuala_Lumpur");
			var dateStart = moment(today).subtract(365, 'days').format("YYYY-MM-DD");
			var dateEnd = moment(today).format("YYYY-MM-DD");
			$j('#hdateStart').val(dateStart);
			$j('#hdateEnd').val(dateEnd);
			
			$j('[id$=fullsearchicon]').on("click touchstart",function(e){
				e.preventDefault();
				if($j(this).parent().find('.search-field').hasClass('open') && $j(this).parent().find('.search-field').val().length > 0){
					if($j(this).parent().find('.search-field').val().length >= 3){
						$j(this).parent().submit();
					}
					else{
						$j(this).parent().find('.search-field').effect( "shake", { direction: "up", times: 3, distance: 2}, 600 );
					}
				}
				else {
					$j(this).parent().find('.search-field').toggleClass("open");
				}
				// if($j('#searchText').hasClass('open') && $j('#searchText').val().length >= 3){
				// 	$j('#searchForm').submit();
				// 	// 	window.location.replace("search.php");
				// }
				// else{
				// 	$j(".search-field").toggleClass("open");
				// }
			});
		}
		else{
			 // $j('[id$=fullsearchicon]').prop("disabled", true);
			$j('[id$=fullsearchicon]').parent().removeAttr('href');
			$j('[id$=fullsearchicon]').on("click touchstart",function(e){
				e.preventDefault();
				if($j("#left_sidebar").hasClass("show")){
					$j("#mobile_menu").click();
				}
				$j('[id$=searchText]').focus();
				$j('[id$=searchText]').effect( "shake", { direction: "up", times: 3, distance: 2}, 600 );
			});
		}

		$j('[id$=searchText]').keypress(function(e){
			if(e.which == 13){	// Enter key pressed
				e.preventDefault();
				if(e.target.value.length >= 3){
					if(!$j('#searchPageForm').is(':visible')){
						if($j('#fullsearchicon').is(':visible')) $j('[id=fullsearchicon]').click();
						else if($j('#mfullsearchicon').is(':visible')) $j('[id=mfullsearchicon]').click();
					}
					else if($j('#searchPageForm').is(':visible')){
						$j('#submitSearch').click();
					}
				}
				else{
					$j(this).effect( "shake", { direction: "up", times: 3, distance: 2}, 600 );
				}
			}
		});

		$j('#submitSearch').on("click touchstart",function(e){
			if($j(this).parent().parent().find('#searchText').val().length < 3){
				e.preventDefault();
				$j(this).parent().parent().find('#searchText').effect( "shake", { direction: "up", times: 3, distance: 2}, 600 );
			}
		});
		
		$j('[id$=searchText]').on("change paste keyup", function() {
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
		
		var tN = $j('[name ="myform"]').attr('action');
		if(tN == 'WorkOrder_view.php' && $j("[aria-labelledby='selectedID']").is(":visible")){
			var selected_wo_ID = $j("[aria-labelledby='selectedID']").html().trim();
			get_workorder_related_records(selected_wo_ID);
		}

		function calcAttached(attachType, totalLabel, initial=false){
			var x = 0;
			$j('input[aria-label='+attachType+']').each(function(i, e){
				var ddf_attr = $j(this).attr('data-default-file');
				if ($j(this).val().length > 0 || (typeof ddf_attr !== typeof undefined && ddf_attr !== false && ddf_attr.length > 0)) {
					x++;
					$j(this).parent().show();
				}
				var selectedID = "";
				if($j("[aria-labelledby='selectedID']").length > 0){
					selectedID = $j("[aria-labelledby='selectedID']").html().trim();
				}
				if(selectedID == "" && initial == true && i>0){
					$j(this).parent().hide();
				}
			});
			$j("#"+totalLabel).html(x);
		}

		function addButtonShowHide(attachType, attachLabel, checkAttachLabelOnly=false){
			var x = $j('input[aria-label='+attachType+']').length;
			$j('input[aria-label='+attachType+']').each(function(i, e){
				if(checkAttachLabelOnly == true){
					if(i==(x-1) && $j(this).parent().parent().is(":visible")){
						$j("#"+attachLabel).hide();
						return false;
					}
				}
				else{
					if(i==(x-1)){
						$j("#"+attachLabel).hide();
					}
					if (!$j(this).parent().parent().is(":visible")) {
						$j(this).parent().parent().show();
						return false;
					}	
				}
			});
		}
		
		function dropifyShowHide(attachType){
			$j('input[aria-label='+attachType+']').each(function(i, e){
				if (!$j(this).is(":visible") && i>0) {
					var ddf_attr = $j(this).attr('data-default-file');
					if ($j(this).val().length > 0 || (typeof ddf_attr !== typeof undefined && ddf_attr !== false && ddf_attr.length > 0)) {
						$j(this).parent().parent().show();
					}
				}
				else{
					$j(this).parent().parent().show();
				}
			});
		}

		var attachArray = [["attach-documents", "totalDocumentAttached", "addDocument"], ["attach-compressed-folders", "totalCompFolderAttached", "addCompFolder"], ["attach-images", "totalPhotoAttached", "addPhoto"]];
		
		attachArray.forEach(function(i){
			calcAttached(i[0], i[1], true);
			$j('input[aria-label='+i[0]+']').on("change paste keyup", function () {
				calcAttached(i[0], i[1]);
			});
			$j("#"+i[2]).click(function () {
				addButtonShowHide(i[0], i[2]);
			});
		});

		var select2FieldList='#BaseLocation-container, #ccpID-container, #ClientID-container, #DCCID-container, #DPRID-container, #EmployeeID-container, #fo_BaseLocation-container, #fo_CalCom-container, #fo_CategoryID-container, #fo_ClientID-container, #fo_DCCITEM-container, #fo_EmployeeID-container, #fo_InventoryID-container, #fo_item-container, #fo_ItemID-container, #fo_Logistic-container, #fo_Position-container, #fo_ProductID-container, #fo_ProjectID-container, #fo_ProjectTeamID-container, #fo_Recources-container, #fo_ReportsTo-container, #fo_ResourcesID-container, #fo_ShipAddress-container, #fo_ShipCity-container, #fo_ShipCountry-container, #fo_ShipName-container, #fo_ShipPostalCode-container, #fo_ShipRegion-container, #fo_ShipVia-container, #fo_SupplierID-container, #fo_suppliers-container, #fo_Vendor-container, #fo_VendorID-container, #InquiryID-container, #memberID-container, #MTSID-container, #MwoID-container, #OrderID-container, #PostID-container, #ProjectsID-container, #ProjectTeamID-container, #ReceivablesID-container, #ResourceId-container, #ResourcesID-container, #WorkLocationID-container, #worklocID-container, #WrLocID-container';
		
		var checkboxFieldList='#ClosedIssue, #fo_Acknowledgement, #fo_AuditMemo, #fo_AuditNote, #fo_AuditPlan, #fo_AuditReport, #fo_Available, #fo_AVList, #fo_ClosedIssue, #fo_Discontinued, #fo_Induction, #fo_NewList';

		if ($j("#startEdit").is(":visible")){
			$j("input").attr("readonly", true);
			$j("textarea").attr("readonly", true);
            $j("select").attr("disabled", true);
 			$j(select2FieldList).prop('readonly', true);
			$j(select2FieldList).attr('disabled', true);
			$j(checkboxFieldList).attr('disabled', true);
            setTimeout(function(){ 
                $j(".nicEdit-main").attr("contenteditable", "false");
			}, 3000);
			$j('input[type="radio"]').attr("disabled", true);
			setTimeout(function(){ $j('input[type="radio"]').attr("disabled", true); }, 300);
			setTimeout(function(){ $j('input[type="radio"]').attr("disabled", true); }, 600);
			setTimeout(function(){ $j('input[type="radio"]').attr("disabled", true); }, 1200);
			setTimeout(function(){ $j('input[type="radio"]').attr("disabled", true); }, 1800);
			setTimeout(function(){ $j('input[type="radio"]').attr("disabled", true); }, 2400);
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
				$j(select2FieldList).prop('readonly', false);
				$j(select2FieldList).attr('disabled',false);
				$j(checkboxFieldList).attr('disabled', false);
				$j('input[type="radio"]').attr("disabled", false);
				setTimeout(function(){ $j('input[type="radio"]').attr("disabled", false); }, 300);
				setTimeout(function(){ $j('input[type="radio"]').attr("disabled", false); }, 600);
				setTimeout(function(){ $j('input[type="radio"]').attr("disabled", false); }, 1200);
				setTimeout(function(){ $j('input[type="radio"]').attr("disabled", false); }, 1800);
				setTimeout(function(){ $j('input[type="radio"]').attr("disabled", false); }, 2400);
                $j('[class="control-label text-muted"]').show();
				$j('input[type="radio"]').attr("disabled", false);
				$j("[id*='_remove']").each(function (i, el) {
					el.show();
				});
				$j(".nicEdit-main").attr("contenteditable", "true");
				$j('[for="editAttachment"]').each(function (i, el) {
                    el.show();
				});
				
				if (!$j('input[id$="_SharedLink1"]'
				).is(":visible")) {
					$j('input[id$="_SharedLink1"]').show();
					$j('#sl1').show();
				}
				
				attachArray.forEach(function(i){
					dropifyShowHide(i[0]);
					addButtonShowHide(i[0], i[2], true);
				});

				$j(this).hide();
				$j("#deselect").hide();
				$j('[ aria-labelledby="attachment-readMode"]').hide();
				$j("#backToReadMode").show();
				$j("#backToReadMode").show();
				$j("#updateRecord").show();
			});

			///////////////////////////////////////////////
			
			var _x = $j('#totalLinkAttached').html();
			if (!_x) {
				_x = 0;
			}

			if($j('input[id$="_SharedLink1"]').length){
				if ($j('input[id$="_SharedLink1"]').val().length > 0) {
					_x++;
				}
			}
			if($j('input[id$="_SharedLink2"]').length){
				if ($j('input[id$="_SharedLink2"]').val().length > 0) {
					_x++;
				} else {
					$j('input[id$="_SharedLink2"]').hide();
					$j('#sl2').hide();
				}
			}

			$j('#totalLinkAttached').html(_x);

			$j('input[id$="_SharedLink1"]').on("change paste keyup", function () {
				var x = 0;
				if ($j('input[id$="_SharedLink1"]').val().length > 0) {
					x++;
				}
				if ($j('input[id$="_SharedLink2"]').val().length > 0) {
					x++;
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('input[id$="_SharedLink2"]').on("change paste keyup", function () {
				var x = 0;
				if ($j('input[id$="_SharedLink1"]').val().length > 0) {
					x++;
				}
				if ($j('input[id$="_SharedLink2"]').val().length > 0) {
					x++;
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('button[id$="_SharedLink1_remove"]').click(function () {
				var x = $j('#totalLinkAttached').html();
				if (!x) {
					x = 0;
				}
				if ($j('input[id$="_SharedLink1"]').val().length > 0 && $j('input[id$="_SharedLink2"]').val().length > 0) {
					$j('input[id$="_SharedLink1"]').val('');
					$j('input[id$="_SharedLink1"]').hide();
					$j('#sl1').hide();
					$j("#addLink").show();
					$j('a[id$="_SharedLink1-link"]').prop('href', '');
					$j('a[id$="_SharedLink1-link"]').hide();
					x--;
				} else if ($j('input[id$="_SharedLink1"]').val().length > 0 && $j('input[id$="_SharedLink2"]').val().length == 0) {
					$j('input[id$="_SharedLink1"]').val('');
					$j('a[id$="_SharedLink1-link"]').prop('href', '');
					$j('a[id$="_SharedLink1-link"]').hide();
					x--;
				} else if ($j('input[id$="_SharedLink1"]').val().length == 0 && $j('input[id$="_SharedLink2"]').val().length == 0) {
					$j('input[id$="_SharedLink1"]').hide();
					$j('#sl1').hide();
					$j("#addLink").show();
					$j('a[id$="_SharedLink1-link"]').prop('href', '');
					$j('a[id$="_SharedLink1-link"]').hide();
				}
				$j('#totalLinkAttached').html(x);
			});
			$j('button[id$="_SharedLink2_remove"]').click(function () {
				var x = $j('#totalLinkAttached').html();
				if (!x) {
					x = 0;
				}
				if ($j('input[id$="_SharedLink1"]').val().length > 0 && $j('input[id$="_SharedLink2"]').val().length > 0) {
					$j('input[id$="_SharedLink2"]').val('');
					$j('input[id$="_SharedLink2"]').hide();
					$j('#sl2').hide();
					$j("#addLink").show();
					$j('a[id$="_SharedLink2-link"]').prop('href', '');
					$j('a[id$="_SharedLink2-link"]').hide();
					x--;
				} else if ($j('input[id$="_SharedLink1"]').val().length == 0 && $j('input[id$="_SharedLink2"]').val().length > 0) {
					$j('input[id$="_SharedLink2"]').val('');
					$j('a[id$="_SharedLink2-link"]').prop('href', '');
					$j('a[id$="_SharedLink2-link"]').hide();
					x--;
				} else if ($j('input[id$="_SharedLink1"]').val().length == 0 && $j('input[id$="_SharedLink2"]').val().length == 0) {
					$j('input[id$="_SharedLink2"]').hide();
					$j('#sl2').hide();
					$j("#addLink").show();
					$j('a[id$="_SharedLink2-link"]').prop('href', '');
					$j('a[id$="_SharedLink2-link"]').hide();
				}
				$j('#totalLinkAttached').html(x);
			});
			$j("#addLink").click(function () {

				if (!$j('input[id$="_SharedLink1"]').is(":visible")) {
					$j('input[id$="_SharedLink1"]').show();
					$j('#sl1').show();
				} else if (!$j('input[id$="_SharedLink2"]').is(":visible")) {
					$j('input[id$="_SharedLink2"]').show();
					$j('#sl2').show();
				}

				if ($j('input[id$="_SharedLink1"]').is(":visible") && $j('input[id$="_SharedLink2"]').is(":visible")) {
					$j("#addLink").hide();
				}
			});
			
			///////////////////////////////////////////////

		}

		$j('[name="myform"]').change(function (e) {
			if(e.target.className != 'adminToggle'){
				if ($j(this).data('already_changed')) return;
				if ($j('#deselect').length) $j('#deselect').removeClass('btn-default').addClass('btn-warning').get(0).lastChild.data = " <%%TRANSLATION(Cancel)%%>";
				$j(this).data('already_changed', true);
			}
		});

		function reloadDV(){
			location.reload();
			$j("backToReadMode").hide();
			$j("#updateRecord").hide();
			$j("#startEdit").show();
			$j("#deselect").show();
			$j('[ aria-labelledby="attachment-readMode"]').show();
		}

		$j("#backToReadMode").click(function(e){
			e.preventDefault();
			if ($j('#deselect.btn-warning').length) {
				var c = confirm('Discard changes to this record?');
				if(c){
					reloadDV();
				}
				else{
					return false;
				}
			}
			else{
				reloadDV();
			}
		})			
		
	});
	document.addEventListener("DOMContentLoaded", function (event) {
		$j('a[data-toggle="tab"]').removeClass('not-active');
	});
</script>