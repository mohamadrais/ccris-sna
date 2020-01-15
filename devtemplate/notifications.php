<?php 
    $currDir=dirname(__FILE__);
    $hooks_dir = $currDir . "/hooks";
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
    include("$currDir/lib.php");
    $x = new DataList;
    $x->TableTitle = 'Notifications';
    include_once("$currDir/header.php");
    include("$currDir/language.php");
	include("{$currDir}/language-admin.php");
	$memberInfo = getMemberInfo();
    global $Translation;
	
?>

<div class="page-wrapper ps ps--theme_default">
<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="message-box">
						<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 570px;">
							<div id="notif-area" class="message-widget message-scroll" style="overflow: scroll; width: auto; height: 570px;">
								<!-- Message -->
								<!-- <a href="#" class="new">
									<div class="mail-contnet">
										<h5>Pavan kumar
											<span class="action-icons notify">
												<i class="ti-check-box" data-toggle="tooltip" data-placement="bottom" title="Mark as read"></i>
												<i class="icon-close" data-toggle="tooltip" data-placement="bottom" title="Delete"></i>
											</span>
										</h5> 
										<span class="mail-desc">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been.</span>
										<span class="time">9:30 AM</span>
									</div>
								</a> -->
								<!-- Message -->
								<!-- <a href="#">
									<div class="mail-contnet">
										<h5>Sonu Nigam
											<span class="action-icons notify">
												<i class="ti-check-box" data-toggle="tooltip" data-placement="bottom" title="Mark as read"></i>
												<i class="icon-close" data-toggle="tooltip" data-placement="bottom" title="Delete"></i>
											</span>
										</h5> 
										<span class="mail-desc">I've sung a song! See you at</span> 
										<span class="time">9:10 AM</span> 
									</div>
								</a> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<span id="notifLoading" style="position: relative; left: 50%"></span>
	<input type="hidden" name="page" value="1">
	<input type="hidden" name="maxReached" value="0">
	
	</div>
</div> <!-- div container-fluid end -->
</div> <!-- div page-wrapper end -->
<style>
.form-inline .form-group{ margin: .5em 1em; }
</style>

<script>
	$j(function(){
		var scrollFlag = false;
		$j(document).ready(function () {
			var page = $j('[name="page"]').val();
			call_ajax_notif(page);
		});
		$j('#notif-area').bind('scroll', function(e) {
			if($j(this).scrollTop() + $j(this).innerHeight()>=$j(this)[0].scrollHeight) {
				if (typeof scrollFlag != 'undefined' && scrollFlag) return;
				if($j('[name="maxReached"]').val() != 1){
					call_ajax_notif($j('[name="page"]').val());
					scrollFlag = true;
				}
			}
		})

		function call_ajax_notif(nextPage){
			$j.ajax({
				url: "ajax_crud_noti.php",
				method: "POST",
				data: {
					'o'	 : 'selectAll',
					'p' : nextPage
				},
				dataType: "JSON",
				beforeSend: function() {
					if($j('#notifLoading').length) {
						$j('#notifLoading').html('<div style="direction: ltr;"><img src="loading.gif"></div>');
					}
				},
				success: function(notifData) {
					//$j('#notif-area').empty();
					let unreadCount = 0;
					if(notifData.length > 0){
						var page = parseInt($j('[name="page"]').val());
						page++;
						$j('[name="page"]').val(page);
						let _notifications=[];
						let day = moment($j.ajax({async: false}).getResponseHeader( 'Date' )).tz("Asia/Kuala_Lumpur");
						for(x=0; x< notifData.length; x++){
							let currNotifLine = '';
							notifIconClass = ''; readFlagClass = '';
							switch(notifData[x]['notif_title']){
								case 'New work order':
									notifIconClass = 'class="fa fa-tasks text-info"';
									break;
								case 'Update on work order':
									notifIconClass = 'class="fa fa-paperclip text-warning"';
									break;
								case 'KPI not achieved':
									notifIconClass = 'class="fa fa-exclamation-circle text-danger"';
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
							currNotifLine += `<a id="notif_id_${notifData[x]['id']}" ${readFlagClass} href="${notifData[x]['notif_url']}">
									<div class="mail-contnet">
										<h5>${notifData[x]['notif_title']}
											&nbsp;&nbsp;<i ${notifIconClass}></i>
											<span class="action-icons notify">
												<i id="r_id_${notifData[x]['id']}" class="ti-check-box" data-toggle="tooltip" data-placement="bottom" title="${btnReadText}"></i>
												<i id="d_id_${notifData[x]['id']}" class="icon-close" data-toggle="tooltip" data-placement="bottom" title="Delete"></i>
											</span>
										</h5>
										<span class="mail-desc">${notifData[x]['notif_msg']}</span>
										<span class="time">${notif_time}</span> 
									</div>
								</a>`;
							_notifications.push(currNotifLine);
						}
						
						var currHTML = $j('#notif-area').html();
						$j('#notif-area').html(currHTML + _notifications.join(' '));
					}
					else{
						if($j('[name="maxReached"]').val()==0 && $j('[name="page"]').val()==1){
							$j('#notif-area').html(`
								<a href="#">
									<div class="mail-contnet">
										<h5>You do not have any active notifications
											<span class="action-icons notify">
												
											</span>
										</h5> 
										<span class="mail-desc"></span>
										<span class="time"></span>
									</div>
								</a>
							`);
						}
						else {
							$j('[name="maxReached"]').val('1');
						}
					}
					
				},         
				error: function(response) {
					console.log('call_ajax_notif error: ' + response.statusText);
				},
				complete: function(){
					if($j('#notifLoading').length) $j('#notifLoading').html('');
					scrollFlag = false;
				}
			});
		}

		$j('#notif-area').on("click", "a[id^='notif_id_']" , function(e) {
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
						console.log('notif-area-a ajax error: ' + response.statusText);
					},
				});
			}
			window.location = $j(this).attr('href');
		});
		
		$j('#notif-area').on("click", "a[id^='notif_id_'] div h5 span i[id^='r_id_']" , function(e) {
			e.preventDefault();
			e.stopPropagation();
			var nId = $j(this).attr('id').substr(5, $j(this).attr('id').length-1);
			$j.ajax({
				url: "ajax_crud_noti.php",
				method: "POST",
				data: {
					'o'  : 'toggle_r',
					'nId': nId
				},
				beforeSend: function() {
					if($j('#notifLoading').length) {
						$j('#notifLoading').html('<div style="direction: ltr;"><img src="loading.gif"></div>');
					}
				},
				dataType: "JSON",
				success: function(read_flag_returned) {
					if(read_flag_returned == 'Y'){
						$j('#'+"notif_id_"+nId).removeClass('new');
						$j('#'+"r_id_"+nId).prop('title', 'Mark as Unread');
					}
					else{
						$j('#'+"notif_id_"+nId).addClass('new');
						$j('#'+"r_id_"+nId).prop('title', 'Mark as Read');
					}
					return false;
				},         
				error: function(response) {
					console.log('notif-area-r-id ajax error: ' + response.statusText);
					return false;
				},
				complete: function(){
					if($j('#notifLoading').length) $j('#notifLoading').html('');
					scrollFlag = false;
				}
			});
			
		});

		$j('#notif-area').on("click touchstart", "a[id^='notif_id_'] div h5 span i[id^='d_id_']" , function(e) {
			e.preventDefault();
			e.stopPropagation();
			var nId = $j(this).attr('id').substr(5, $j(this).attr('id').length-1);
			var confirm_message = '<div class="alert alert-danger">' +
					'<i class="glyphicon glyphicon-warning-sign"></i> ' + 
					'Are you sure you would like to delete this notification? This action cannot be undone.' +
				'</div>';
			var confirm_title = 'Confirm';
			var label_yes = 'Yes';
			var label_no = 'No';
			
			modal_window({
				message: confirm_message,
				title: confirm_title,
				footer: [
					{
						label: '<i class="glyphicon glyphicon-ok"></i> ' + label_yes,
						bs_class: 'danger',
						click: function(){

							$j.ajax({
								url: "ajax_crud_noti.php",
								method: "POST",
								data: {
									'o'  : 'mark_d',
									'nId': nId
								},
								dataType: "JSON",
								beforeSend: function() {
									if($j('#notifLoading').length) {
										$j('#notifLoading').html('<div style="direction: ltr;"><img src="loading.gif"></div>');
									}
								},
								success: function(resp) {
									if(resp && resp.result && resp.result == 'ok'){
										$j('#'+"notif_id_"+nId).remove();
									}
									else{
										alert('Unable to delete. Please try again later.')
									}
									return false;
								},         
								error: function(response) {
									console.log('notif-area-d-id ajax error: ' + response.statusText);
									return false;
								},
								complete: function(){
									if($j('#notifLoading').length) $j('#notifLoading').html('');
									scrollFlag = false;
								}
							});
						}
					},
					{
						label: '<i class="glyphicon glyphicon-remove"></i> ' + label_no,
						bs_class: '' 
					}
				]
			});
		});
	})
</script>
<?php include_once("$currDir/footer.php"); ?>
