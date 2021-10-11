<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UsersCronjob extends CI_Controller {

	public function index()
	{

		//---- User Module Starts----------------------------
		$this->load->model(array('User_model' => 'userModel'));

		$select1 = 'de.*, uc.*, up.*';
		$where1 = array('uc.contact_type' => 'Email');
		$userData = $this->userModel->getDraftEmails($select1, $where1);
		//print_r($userData['result']);exit;
		if ($userData['count'] != 0) {
			foreach ($userData['result'] as $key => $value) {
				$draft_time = strtotime($value['draft_time']);
				// $workman_certificate_expires_date1 = strtotime($value['workman_certificate_expires']);
				date_default_timezone_set('Asia/Kolkata');
				$setdraft_time = $this->getDateDiff($draft_time, strtotime(date('Y-m-d h:i A')), 'users');

				if ($setdraft_time == 0) {
					$to = $value['email_Ids'];
					$from = $value['emails'];
					$password = $this->my_simple_crypt($value['password'], 'd' );
					$subject = $value['subject'];
					$mail_message = $value['message'];
                    $mail_message.= $value['message_signature']."<br/><img src = '".base_url()."upload/".$value['file']."'>";
			        //Load email library
			        $CI =& get_instance();
			        $CI->load->library('email');
			        $config = array(
			            'protocol'  => 'smtps',
			            'smtp_host' => 'ssl://smtp.live.com',
			            'smtp_port' => 25,
			            'smtp_user' => $from,
			            'smtp_pass' => $password,
			            'mailtype'  => 'html',
			            'charset'   => 'utf-8'
			        );
			        $CI->email->initialize($config);
			        $CI->email->set_mailtype("html");
			        $CI->email->set_newline("\r\n");


			        $CI->email->from($from, 'Hozpitality CRM');
			        $CI->email->to($to);
			        $CI->email->subject($subject);
			        $CI->email->message($mail_message);

			        //Send email
			        if(!$CI->email->send()) {
			            $response['code'] = 500;
			            $response['message'] = 'Failure To Sent Email';
			        }
				}
			}// foreach end
		}
		
	}

	public function getDateDiff($date1, $date2,$module) {
		// Formulate the Difference between two dates
		if (isset($date1) && $date1 != '') {
			@$diff = abs($date2 - $date1);  

			$years = floor($diff / (365*60*60*24));  

			$months = floor(($diff - $years * 365*60*60*24) 
			                               / (30*60*60*24));  

			$days = floor(($diff - $years * 365*60*60*24 -  
			             $months*30*60*60*24)/ (60*60*24)); 
			   
			$hours = floor(($diff - $years * 365*60*60*24  
			       - $months*30*60*60*24 - $days*60*60*24) 
			                                   / (60*60));  
			  
			$minutes = floor(($diff - $years * 365*60*60*24  
			         - $months*30*60*60*24 - $days*60*60*24  
			                          - $hours*60*60)/ 60);  
		 
			$seconds = floor(($diff - $years * 365*60*60*24  
			         - $months*30*60*60*24 - $days*60*60*24 
			                - $hours*60*60 - $minutes*60));
			  
			// Print the result
			if ($module == 'company') {
				return $days;
			} else {
				if ($days == 0) {
					return $minutes;
				} else {
					return $days;
				}
			}
		}
	}

	public function my_simple_crypt($string, $action = 'e') {
	    // you may change these values to your own
	    $secret_key = 'preferencesKey';
	    $secret_iv = 'preferencesIV';
	 
	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }
	 
	    return $output;
	}
}