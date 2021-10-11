<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CompanyCronjob extends CI_Controller {

	public function index()
	{

		//---- Company Module Starts----------------------------
		$this->load->model(array('Company_model' => 'companyModel'));

		$select0 = 'GROUP_CONCAT(uc.contact_info) as emails';
		$where0 = array('r.role_name' => 'Administrator', 'uc.contact_type' => 'Email');
		$adminData = $this->companyModel->getAdminEmails($select0, $where0);
		$adminEmails  = implode(',', $adminData[0]['emails']);
		$select1 = 'company_name, liable_certificate_expires, liable_certificate_expire_reminder, liable_certificate_expire_reminder_type, liable_certificate_expire_reminder_value, liable_certificate_expire_reminder_value_attempted, workman_certificate_expires, workman_certificate_expire_reminder, workman_certificate_expire_reminder_type, workman_certificate_expire_reminder_value, workman_certificate_expire_reminder_value_attempted';
		$where1 = array('activity_status' => 'active');
		$companyData = $this->companyModel->getExpiryDates($select1, $where1);
		// echo "<pre>";
		// print_r($companyData);exit;
		if ($companyData['count'] != 0) {
			foreach ($companyData['result'] as $key => $value) {
//-------------------Liable Certificate Starts----------------------------------------------------------
				if ($value['liable_certificate_expire_reminder_type'] == 'before') {
				//if (1 == 1) {

					$liable_certificate_expires_date1 = strtotime($value['liable_certificate_expires']);
					// $workman_certificate_expires_date1 = strtotime($value['workman_certificate_expires']);

					$liable_certificate_time = $this->getDateDiff($liable_certificate_expires_date1, date('d-m-Y'), 'company');

					if ($liable_certificate_time == $value['liable_certificate_expire_reminder_value']) {

						$mail_message ='<html>
                            <head>
                              <title>Mail from Hozpitality CRM</title>
                            </head>
                            <body>
                            	<b>Hello,</b><br/><br/>
                            	This is to remind you that,<br/>
                            	Liable Certificate of '.$value['company_name'].' is about to expire on <b>'.$value['liable_certificate_expires'].'</b>.
                            	<br/>
                            	Please contact to concerned person! <br/>
                            	Thank You !
                            </body>
                        </html>';

						$this->sendNotificationEmail($adminEmails,'Expiry Update For Liable Certificate', $mail_message);
					}
					// $workman_certificate_time = $this->getDateDiff($workman_certificate_expires_date1, date('d-m-Y'), 'company');
				} else {
					$liable_certificate_expires_date1 = strtotime($value['liable_certificate_expires']);
					// $workman_certificate_expires_date1 = strtotime($value['workman_certificate_expires']);

					$liable_certificate_time = $this->getDateDiff($liable_certificate_expires_date1, date('d-m-Y'), 'company');

					if ($liable_certificate_time == (0-$value['liable_certificate_expire_reminder_value'])) {

						$mail_message ='<html>
                            <head>
                              <title>Mail from Hozpitality CRM</title>
                            </head>
                            <body>
                            	<b>Hello,</b><br/><br/>
                            	This is to remind you that,<br/>
                            	Liable Certificate of '.$value['company_name'].' has expired on <b>'.$value['liable_certificate_expires'].'</b>.
                            	<br/>
                            	Please contact to concerned person! <br/>
                            	Thank You !
                            </body>
                        </html>';

						$this->sendNotificationEmail($adminEmails,'Expiry Update For Liable Certificate', $mail_message);
					}
				}
//--------------------------------------------Liable Certificate Ends----------------------------------------------------------
//------------------------------------------Workman Certificate Starts----------------------------------------------------------
				if ($value['workman_certificate_expire_reminder_type'] == 'before') {

					$liable_certificate_expires_date1 = strtotime($value['workman_certificate_expires']);
					// $workman_certificate_expires_date1 = strtotime($value['workman_certificate_expires']);

					$liable_certificate_time = $this->getDateDiff($liable_certificate_expires_date1, date('d-m-Y'), 'company');

					if ($liable_certificate_time == $value['workman_certificate_expire_reminder_value']) {

						$mail_message ='<html>
                            <head>
                              <title>Mail from Hozpitality CRM</title>
                            </head>
                            <body>
                            	<b>Hello,</b><br/><br/>
                            	This is to remind you that,<br/>
                            	Workman Comp Certificate of '.$value['company_name'].' is about to expire on <b>'.$value['workman_certificate_expires'].'</b>.
                            	<br/>
                            	Please contact to concerned person! <br/>
                            	Thank You !
                            </body>
                        </html>';

						$this->sendNotificationEmail($adminEmails,'Expiry Update For Workman Certificate', $mail_message);
					}
					// $workman_certificate_time = $this->getDateDiff($workman_certificate_expires_date1, date('d-m-Y'), 'company');
				} else {
					$liable_certificate_expires_date1 = strtotime($value['workman_certificate_expires']);
					// $workman_certificate_expires_date1 = strtotime($value['workman_certificate_expires']);

					$liable_certificate_time = $this->getDateDiff($liable_certificate_expires_date1, date('d-m-Y'), 'company');

					if ($liable_certificate_time == (0-$value['workman_certificate_expire_reminder_value'])) {

						$mail_message ='<html>
                            <head>
                              <title>Mail from Hozpitality CRM</title>
                            </head>
                            <body>
                            	<b>Hello,</b><br/><br/>
                            	This is to remind you that,<br/>
                            	Workman Comp Certificate of '.$value['company_name'].' has expired on <b>'.$value['workman_certificate_expires'].'</b>.
                            	<br/>
                            	Please contact to concerned person! <br/>
                            	Thank You !
                            </body>
                        </html>';

						$this->sendNotificationEmail($adminEmails,'Expiry Update For Workman Certificate', $mail_message);
					}
				}
//------------------------------------------Workman Certificate Ends----------------------------------------------------------
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
				return $minutes;
			}
		}
	}

	public function sendNotificationEmail($emailList='', $subject = '', $message) {
		$mail_message =$message;
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
        $CI->email->to($emailList);
        $CI->email->subject($subject);
        $CI->email->message($mail_message);

        //Send email
        if(!$CI->email->send()) {
            $response['code'] = 500;
            $response['message'] = 'Failure In Invite User';
        }
	}
}