$(document).ready(function() {
	showNotification();
	setInterval(function(){ showNotification(); }, 60000);
});
function showNotification() {
	if (!Notification) {
		$('body').append('<h4 style="color:red">*Browser does not support Web Notification</h4>');
		return;
	}
	if (Notification.permission !== "granted") {		
		Notification.requestPermission();
	} else {
	var ajax_url = 'activity/getActivityNotification';	
		$.ajax({

			url : ajax_url,
			type: "POST",
			success: function(data, textStatus, jqXHR) {
				//console.log(jQuery.parseJSON(data));
				var data = jQuery.parseJSON(data);
				if(data.result == true) {
					var data_notif = data.notif;
					var check = false;
					for (var i = data_notif.length - 1; i >= 0; i--) {
						
						var reminder = data_notif[i]['reminder'];
						var diff_reminder_value = data_notif[i]['diff_reminder_value'];
						if (reminder =='1 min' && diff_reminder_value == '0.016666666666667') {
							check = true;
						}
						if (reminder =='2 min' && diff_reminder_value == '0.033333333333333') {
							check = true;
						}
						if (reminder =='5 min' && diff_reminder_value == '0.08333333333333333') {
							check = true;
						}
						if (reminder =='1 Day' && diff_reminder_value == '24') {
							check = true;
						}
						if (reminder =='2 Day' && diff_reminder_value == '48') {
							check = true;
						}
						if (reminder =='5 Day' && diff_reminder_value == '120') {
							check = true;
						}

						if (check) {
							var theurl = data_notif[i]['url'];
							var notifikasi = new Notification(data_notif[i]['title'], {
								icon: data_notif[i]['icon'],
								body: data_notif[i]['msg'],
							});
							notifikasi.onclick = function () {
								//window.open(theurl); 
								notifikasi.close();     
							};
							setTimeout(function(){
								notifikasi.close();
							}, 5000);
						}
						check=false;
					};
				} else {
				}
			},
			error: function(jqXHR, textStatus, errorThrown)	{}
		}); 
	}
};
