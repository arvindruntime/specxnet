<?php 

class Permissions_library {

	public function checkUserPermission($permission_id) {
		//echo $permission_id;exit;
		$permissions = json_decode($_SESSION['user_permissions']);
        // print_r($permissions);exit;
		if (in_array($permission_id, $permissions)) {
			return true;
		} else {
			return false;
		}
	}

	public function checkUserNotifications($notification_id) {
		//echo $permission_id;exit;
		$notifications = json_decode($_SESSION['user_notifications']);
		if (in_array($notification_id, $notifications)) {
			return true;
		} else {
			return false;
		}
	}

	public function sendNotificationsEmail($emailList='', $subject = '', $module = '', $name = '', $action ='', $actionBy ='') {
        $emailList = explode(',', $emailList);
        foreach ($emailList as $key => $to) {
           $mail_message ='<html>
                            <head>
                              <title>Mail from Hozpitality CRM</title>
                            </head>
                            <body>
                                <b>Hello,</b><br/><br/>
                                '.$module.' <b>'.$name.'</b> has been '.$action.' successfully by '.$actionBy.'.
                            </body>
                        </html>';
            //Load email library
            $CI =& get_instance();
            $CI->load->library('email');
            $config = array(
                'protocol'  => 'smtps',
                'smtp_host' => 'ssl://smtp.live.com',
                'smtp_port' => 25,
                'smtp_user' => 'crm@hozpitality.com',
                'smtp_pass' => 'Tak32071',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );
            $CI->email->initialize($config);
            $CI->email->set_mailtype("html");
            $CI->email->set_newline("\r\n");


            $CI->email->from('crm@hozpitality.com', 'Hozpitality CRM');
            $CI->email->to($to);
            $CI->email->subject($subject);
            $CI->email->message($mail_message);

            //Send email
            if(!$CI->email->send()) {
                $response['code'] = 500;
                $response['message'] = 'Failure In Invite User';
            }
        }
	}

} 