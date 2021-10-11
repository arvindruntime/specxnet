<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

	/**
	 * User Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://DomainName/users
	 *
	 * @author		 
	 */
	const USER_ARRAY = array('internal' => 'Internal User', 'Suppliers' => 'Suppliers', 'CustomerContact' => 'Customer');
	// const MODULE_NAME = 'user';

	public function __construct() {
		parent::__construct();
		$user_id = $this->session->userdata('user_id');
        if (!isset($user_id) || $user_id=='') {
            $this->session->sess_destroy();
            redirect('login');
        }
		$this->load->model(array('Activity_model' => 'leadActivityModel'));
		$this->load->model(array('Lead_model' => 'leadOpportunityModel'));
		$this->load->library(array('Activity_library' => 'leadActivity'));
		$this->load->model(array('Company_model' => 'companyMondel'));
		$this->load->model(array('User_model' => 'userModel'));
		$this->load->library(array('Permissions_library' => 'permission'));

	}

	/**
	* index action of user controller
	* @author
	* @param
	* @param
	*/
	public function index($userType = 'internal')
	{
		$permissions = $this->permission->checkUserPermission(22);
		if (!$permissions) {
			redirect('page_not_found');exit;
		}

		$module_name = $this->uri->segment(1);
		// echo $userType; die; 
		$this->page->setTitle('Lead Activity');
		
		// set head style
		$this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");
		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");
		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");
		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");		
		$this->page->setHeadStyle("//cdn.syncfusion.com/ej2/material.css");		
		$this->page->setHeadStyle(base_url()."assets/custom/css/jquery.dataTables.min.css");
		// $this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");		
		$this->page->setHeadStyle(base_url()."assets/custom/css/style.css");
		$this->page->setHeadStyle(base_url()."assets/custom/css/editor.css");
		$this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");
		// <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>
    	// <link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">

    	// Date picker 
		$this->page->setHeadStyle(base_url()."assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css");
		
		//set footer js
		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");
		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");
		$this->page->setFooterJs(base_url()."assets/vendors/base/vendors.bundle.js");
		$this->page->setFooterJs(base_url()."assets/demo/default/base/scripts.bundle.js");
		$this->page->setFooterJs("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");
		$this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");
		// $this->page->setFooterJs("//cdn.syncfusion.com/ej2/dist/ej2.min.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/leadActivity.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/custom.js");
		$this->page->setFooterJs(base_url()."assets/push_notification/notification.js");
		
		// $this->page->setFooterJs(base_url()."assets/demo/default/custom/crud/forms/widgets/ion-range-slider.js");
		// $this->page->setFooterJs(base_url()."assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js");
		// $this->page->setFooterJs(base_url()."assets/custom/js/editor.js");

		// Date Picker
		$this->page->setFooterJs(base_url()."assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js");

		// text editor js
		$this->page->setFooterJs(base_url()."assets/ckeditor/ckeditor.js");

		
		// load layout


		$page['contain'] = 'leadActivityList';
		$page['userType'] = $userType;
		$page['tabs'] = $this->leadActivity->getTabs();
		$page['newButton'] = $this->leadActivity->getNewButton();
		$page['module_name'] = $module_name;
		$page['filter'] = $this->input->post('filter');

		if (isset($page['filter']['saved_filter_id'])) {
			$page['savedfilterID'] = $page['filter']['saved_filter_id'];
		}

		$page['gridView'] = $this->leadActivityModel->getGrid('*',array('module_name' => $module_name));

		$page['activityColumn'] = $this->leadActivity->getActivityCoulmn();

		$selectFilter = '*';
		$whereFilter = array('module' => 'Lead Activity');
		$page['savedFilter'] = $this->leadActivityModel->getSavedFilter($selectFilter,$whereFilter);
		$page['access'] = $this->session->userdata('adminAccess');
		
		// print_r($page['savedFilter']);exit();
		$selectSalesPerson = 'u.user_id,u.first_name,u.last_name';
		$whereSalesPerson = "role_name = 'Sales Person'";
		$page['salesPerson'] = $this->leadActivityModel->getSalesPersons($selectSalesPerson,$whereSalesPerson);

		$page['addPermission'] = $this->permission->checkUserPermission(23);
		$page['editPermission'] = $this->permission->checkUserPermission(24);
		$page['deletePermission'] = $this->permission->checkUserPermission(25);

		$page['showOpportunity'] = $this->permission->checkUserPermission(17);
		$page['showActivity'] = $this->permission->checkUserPermission(22);
		$page['showActivityCalendar'] = $this->permission->checkUserPermission(17);
		$page['showRFQ'] = $this->permission->checkUserPermission(26);
		$page['showProposal'] = $this->permission->checkUserPermission(31);
		$page['showJobs'] = $this->permission->checkUserPermission(36);
		$page['showReleasePO'] = $this->permission->checkUserPermission(47);
		$page['showReleaseInvoice'] = $this->permission->checkUserPermission(48);

		$this->page->getLayout($page);
	}

	/**
	* createUser action of User controller to create user
	* @author Bimal Sharma
	*/
	public function createActivity($userId = null) {
		try{ 
			$post = $this->input->post(); 
			//print_r($post); die;	
			$fk_lead_opportunity_id = "";

			if (isset($post['leadOpportunityUpdateId'])) { 
				$fk_lead_opportunity_id = $post['leadOpportunityUpdateId'];
			}

			if (isset($post['leadOpportunityUpdateIdNew'])) { 
				$fk_lead_opportunity_id = $post['leadOpportunityUpdateIdNew'];
			}

			if (isset($post['fk_lead_opportunity_id'])) { 
				$fk_lead_opportunity_id = $post['fk_lead_opportunity_id'];
			}

			if (isset($post['leadActivityUpdateId'])) {
				$lead_activity_id = $post['leadActivityUpdateId'];
				$whereLeadId = array('lead_activity_id' => $lead_activity_id);
				$selectLead = 'fk_lead_opportunity_id';
				$getLeadOppId = $this->leadActivityModel->getLeadOpportunityId($selectLead,$whereLeadId);
				$fk_lead_opportunity_id = $getLeadOppId[0]['fk_lead_opportunity_id'];
				
			}else {
				$lead_activity_id = '0';
			}


			if (isset($post['follow_up_datetime'])) {
				$follow_up = $post['follow_up_datetime'];				
				$follow_up_date = date("d-m-Y", strtotime($follow_up));
			} else {
				$follow_up_date = '';
			}

			if (isset($post['activity_start_datetime'])) {
				$activity_up = $post['activity_start_datetime'];				
				$activity_date = date("d-m-Y", strtotime($activity_up));
				$activity_date = $activity_date;
			} else {
				$activity_date = '';
			}
			
			if (isset($post['at'])) {
				$at = $post['at'];
			} else {
				$at = '0';
			}
			/*if(isset($post['follow_up_date']))
			{
				$follow_up_date=$post['follow_up_date'];
			}
			else
			{
				$follow_up_date="";
			}*/

			if(!empty($_FILES["activity_attachment"]['name'])) {
        		$config['upload_path']          = APPPATH.'../upload/leadActivityFiles/';
        		$config['allowed_types'] = '*';
        		$new_name = time().$_FILES["activity_attachment"]['name'];
				$config['file_name'] = $new_name;
	            $this->load->library('upload', $config);
	            if ($this->upload->do_upload('activity_attachment'))
	            {
	            	$data = $this->upload->data();
	            	$file = $data['orig_name'];
	            	$file_orig_name = $data['client_name'];
	            	$file_path = $data['full_path'];
	            }
        	}

			$insertActivityArray = array(
				'fk_lead_opportunity_id' => $fk_lead_opportunity_id, 
				'activity_title' => $post['activity_title'], 
				'activity_date' => $activity_date,
				'activity_start_datetime' => $post['activity_start_datetime'],
				'activity_end_datetime' => $post['activity_end_datetime'],
				'reminder' => $post['reminder'],
				'activity_type' => $post['activity_typeUpdate'],
				'initiated_by' => $post['initiated_byUpdate'],
				'assigned_by' => $post['assigned_by'],
				'contacted_by' => $this->session->userdata('user_id'),	
				'description' => $post['description'],
				'follow_up_date' => $follow_up_date,		
				'at' => $at,				
				'activity_status' => 'active',
				'lead_activity_status' => $post['status'],
				'created_by' => $this->session->userdata('user_id')			
			);
			
			if (isset($post['follow_up_datetime'])) {
				$insertActivityArray['follow_up_datetime'] = $post['follow_up_datetime'];
			}

			if (isset($post['email_draft_time'])) {
				$insertActivityArray['email_draft_time'] = $post['email_draft_time'];
			}

		 	if (!empty($_FILES["activity_attachment"]['name'])) {
				$insertActivityArray['activity_attachement_name'] = $file;
				$insertActivityArray['activity_attachement_orig_name'] = $file_orig_name;
				$insertActivityArray['activity_attachement_path'] = $file_path;
			}
			//print_r($insertActivityArray);exit;
			// echo $fk_lead_opportunity_id;
			// echo $this->session->userdata('user_id');
			$sub='';
			$select='GROUP_CONCAT(contact_info) as contact_info';
			$where=array("contact_type" => "Email","fk_user_id" =>  $fk_lead_opportunity_id);
			$to=$_POST['to'];
			if (isset($post['activity_title'])) {
				$sub=$post['activity_title'];
			}
			$msg=$post['description'];
			$from='';

			if ($post['activity_typeUpdate'] == 'Compose Email') {
				$to = str_replace('|', ',', $post['userEmail']);
				$whereUserId = array('fk_user_id' => $this->session->userdata('user_id'));
				$getFromEmailId = $this->leadActivityModel->getUserEmail('*', $whereUserId);

				$from = $getFromEmailId[0]['email_id'];
				$password = $this->my_simple_crypt($getFromEmailId[0]['password'], 'd' );
				$signature = $getFromEmailId[0]['message_signature']."<br/><img src = '".base_url()."upload/".$getFromEmailId[0]['file']."'>";
				if (isset($file)) {
					$file = $file;
				} else {
					$file = '';
				}
				$msg = $post['description'];
				$sub = $post['activity_typeUpdate'];
				if ($post['status'] == 'Complete') {
					$mail_res=$this->Activity_mail($to,$from,$sub,$msg,$file,$password,$signature);
				}
			}

			if(isset($post['message'])) {
				// if($post['activity_mail']){

	        		$config['upload_path']= APPPATH.'../upload/leadActivityFiles';
	        		$config['allowed_types'] = '*';
	        		$new_name = time().$_FILES["activity_mail"]['name'];
	        		$config['file_name'] = $new_name;
		            $this->load->library('upload', $config);
		            if ($this->upload->do_upload('activity_mail'))
		            {
		            	$data = $this->upload->data();
		            	$file = $data['orig_name'];
		            	$file_orig_name = $data['client_name'];
		            	$full_path = $data['full_path'];
		            }
		            $file_info = $this->upload->data();
					//$img = $file_info['activity_mail']; 
					if(isset($post['message']) && $post['message']!='') {
						$mail_res=$this->Activity_mail($to,$from,$sub,$msg,$file);
					}
	        }

	        date_default_timezone_set('Asia/Kolkata');
			if($lead_activity_id == '0' || !$lead_activity_id ) {
			$data['formheading'] = "Add Activity";
				$insertActivityArray['created_date'] = date('d-m-Y h:i A');
				$insertActivityArray['updated_date'] = date('d-m-Y h:i A');
				$insertActivityArray['str_created_date'] = strtotime(date('d-m-Y'));
				$insertActivityArray['str_updated_date'] = strtotime(date('d-m-Y'));
				$data['id'] = $this->leadActivityModel->insertActivity($insertActivityArray);				
				$this->session->set_userdata('setMessage','Added');

				$whereNotificationID = array('fk_notification_id' => '11');
				$addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);
				if(!empty($addLeadNotification['result'])) {
					$userIDs = json_decode($addLeadNotification['result'][0]['user_id']);
					$getEmailList = $this->userModel->getUserEmail('*',$userIDs);
		        	foreach ($getEmailList as $key => $value) {
			        	$emailList[] = $value['contact_info'];
			        } 
				}
		        $where = array('lead_opportunity_id' => $fk_lead_opportunity_id);
            	$getUserdetails = $this->leadOpportunityModel->getLeadDetails($where);
				if ($addLeadNotification['count'] == 1) {
			        $emailString = implode(',', $emailList);
		        	$subject = 'Activity Added Successfully';
		        	$module = 'Activity against';
		        	$name = $getUserdetails['result'][0]['opportunity_title'];
		        	$action = 'added';
		        	$actionBy = $this->session->userdata('user_name');
		        	$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
		        }
				
			} else { 
				$data['formheading'] = "Edit Activity";	
				$where = array('lead_activity_id' => $lead_activity_id);
				
				$insertActivityArray['follow_up_datetime'] = $post['follow_up_datetime'];
				$insertActivityArray['updated_date'] = date('d-m-Y h:i A');
				$insertActivityArray['str_updated_date'] = strtotime(date('d-m-Y'));
				$data['id'] = $this->leadActivityModel->updateActivity($insertActivityArray,$where);
				$this->session->set_userdata('setMessage','Updated');

//print_r($getLeadOppId);exit;
				if (isset($post['follow_up_datetime']) && $post['follow_up_datetime'] !='') {
					$insertActivityArray['activity_start_datetime'] = $post['follow_up_datetime'];
					$insertActivityArray['follow_up_date'] = '';
					$insertActivityArray['follow_up_datetime'] = '';
					$insertActivityArray['activity_end_datetime'] = '';
					$insertActivityArray['fk_lead_opportunity_id'] = $getLeadOppId[0]['fk_lead_opportunity_id'];

					$activity_up = $post['follow_up_datetime'];				
					$activity_date = date("d-m-Y", strtotime($activity_up));
					$insertActivityArray['activity_date'] = $activity_date;
					$data['id'] = $this->leadActivityModel->insertActivity($insertActivityArray);
				}

				$whereNotificationID = array('fk_notification_id' => '12');
				$addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);
				if(!empty($addLeadNotification['result'])) {
					$userIDs = json_decode($addLeadNotification['result'][0]['user_id']);
					$getEmailList = $this->userModel->getUserEmail('*',$userIDs);
		        	foreach ($getEmailList as $key => $value) {
			        	$emailList[] = $value['contact_info'];
			        } 
				}
		        $where = array('lead_opportunity_id' => $getLeadOppId[0]['fk_lead_opportunity_id']);
            	$getUserdetails = $this->leadOpportunityModel->getLeadDetails($where);
				if ($addLeadNotification['count'] == 1) {
			        $emailString = implode(',', $emailList);
		        	$subject = 'Activity Updated Successfully';
		        	$module = 'Activity against';
		        	$name = $getUserdetails['result'][0]['opportunity_title'];
		        	$action = 'updated';
		        	$actionBy = $this->session->userdata('user_name');
		        	$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
		        }		
			}

			if (isset($post['email_draft_time'])) {
				$insertArray = array(
        		'email_Ids' => str_replace(' | ', ',', $post['userEmail']),
        		'subject' => $post['activity_title'],
        		'message' => $post['description'],
        		'draft_time' => $post['email_draft_time'],
        		'added_by' => $this->session->userdata('user_id'),
        	);

        	$insert = $this->userModel->addUserEmailDraft($insertArray);
			}

			if(isset($post['message']) && $post['message']!='') {
				if (isset($data['id'])) {
					$lead_activity_id = $data['id'];
				}

				$insertMailArray = array(
					'fk_lead_activity_id' => $lead_activity_id, 
					'fk_lead_opportunity_id' => $fk_lead_opportunity_id, 
					'to_id' => $to,
					'from_id' => $this->session->userdata('user_id'),
					'sub' => $sub,
					'msg' => $msg,
					'file_path' => $full_path,
					'file_name' => $file,
					'file_orig_name' => $file_orig_name		
				); 
				$activity_mailres=$this->leadActivityModel->addActivityMail($insertMailArray);
			}
			
			if (isset($post['leadActivity'])) {
				redirect('lead');exit;
			}

			$response['code'] = 200;
			$response['message'] = "<div class='alert alert-success'>
	                    <strong>Success!</strong> Activity Added Successfully.</div>";
			$response['data'] = $data['id'];
			// $response['data']['heading'] = $data['formheading'];
		}catch(Exception $e){
			$response['code'] = 505;
			$response['message'] = 'exception in insertion';
			$response['data'] = array();
		}
		echo json_encode($response);
	}

	public function permDeleteUActivity() { 
        $DeleteId = $this->input->post();
        $newUsrId = explode(',', $DeleteId['deleteThis']);
        // $deleteUpdateData = array('activity_status' => 'inactive');
		$DeletedUser = $this->leadActivityModel->permDeleteActivities($newUsrId);
        if ($DeletedUser) {
            $this->session->set_userdata('setMessage','Permanently deleted');
            // $whereNotificationID = array('fk_notification_id' => '13');
			// $deleteLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);
			// $userIDs = json_decode($deleteLeadNotification['result'][0]['user_id']);
        	// $getEmailList = $this->userModel->getUserEmail('*',$userIDs);
        	// foreach ($getEmailList as $key => $value) {
	        // 	$emailList[] = $value['contact_info'];
	        // }

	        // foreach ($newUsrId as $userKey => $userValue) {
            // 	$where = array('lead_opportunity_id' => $userValue);
            // 	$getUserdetails = $this->leadActivityModel->getActivityDetails($where);
            // 	/*if ($deleteLeadNotification['count'] == 1) {
			//         $emailString = implode(',', $emailList);
		    //     	$subject = 'Activity Deleted Successfully';
		    //     	$module = 'Activity against';
		    //     	$name = $getUserdetails['result'][0]['opportunity_title'];
		    //     	$action = 'deleted';
		    //     	$actionBy = $this->session->userdata('user_name');
		    //     	$UserNotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
		    //     }*/
            // }

            return true;
        } else {
            return False;
        }
    }
        

	public function createActivityCalendar($userId = null) {
		//try{ 
			$post = $this->input->post(); 
			//print_r($post);exit;
			if (isset($post['opportunity_title'])) {
				$oppTitle = explode('-', $post['opportunity_title']);
				$opportunity_title = $oppTitle[0];
				if (isset($oppTitle[1])) {
					$full_name = $oppTitle[1];
					$selectFkLead = 'lo.lead_opportunity_id';
					$whereFkLead = array('lo.opportunity_title' => $opportunity_title, 'u.full_name' => $full_name);
					$getFkLeadOpportunityId = $this->leadOpportunityModel->getFkLeadOpportunityId($selectFkLead, $whereFkLead);
					$new_fk_lead_opportunity_id = $getFkLeadOpportunityId[0]['lead_opportunity_id'];
				}
			} else {
				$lead_activity_id = $post['leadActivityUpdateId'];

				$selectLeadOpp = 'fk_lead_opportunity_id';
				$whereLeadAcId = array('lead_activity_id' => $lead_activity_id);
				$getLeadOpportunityId = $this->leadActivityModel->getLeadOpportunityId($selectLeadOpp, $whereLeadAcId);

				$fk_lead_opportunity_id = $getLeadOpportunityId[0]['fk_lead_opportunity_id'];
			}
			//print_r($getLeadOpportunityId[0]['fk_lead_opportunity_id']);exit;

			if (isset($post['follow_up_datetime'])) {
				$follow_up = $post['follow_up_datetime'];				
				$follow_up_date = date("d-m-Y", strtotime($follow_up));
			} else {
				$follow_up_date = '';
			}

			if (isset($post['activity_start_datetime'])) {
				$activity_up = $post['activity_start_datetime'];				
				$activity_date = date("d-m-Y", strtotime($activity_up));
				$activity_date = $activity_date;
			} else {
				$activity_date = '';
			}
			
			if (isset($post['at'])) {
				$at = $post['at'];
			} else {
				$at = '0';
			}
		
			if(!empty($_FILES["activity_attachment"]['name'])) {
        		$config['upload_path']          = APPPATH.'../upload/leadActivityFiles/';
        		$config['allowed_types'] = '*';
        		$new_name = time().$_FILES["activity_attachment"]['name'];
				$config['file_name'] = $new_name;
	            $this->load->library('upload', $config);
	            if ($this->upload->do_upload('activity_attachment'))
	            {
	            	$data = $this->upload->data();
	            	$file = $data['orig_name'];
	            	$file_orig_name = $data['client_name'];
	            	$file_path = $data['full_path'];
	            }
        	}

			$insertActivityArray = array(
				'activity_title' => $post['activity_title'], 
				'activity_date' => $activity_date,
				'activity_start_datetime' => $post['activity_start_datetime'],
				'activity_end_datetime' => $post['activity_end_datetime'],
				'reminder' => $post['reminder'],
				'activity_type' => $post['activity_typeUpdate'],
				'initiated_by' => $post['initiated_byUpdate'],
				'assigned_by' => $post['assigned_by'],
				'description' => $post['description'],
				'follow_up_date' => $follow_up_date,		
				'at' => $at,				
				'activity_status' => 'active',
				'lead_activity_status' => $post['status'],
			);
			
			if (isset($new_fk_lead_opportunity_id)) {
				$insertActivityArray['fk_lead_opportunity_id'] = $new_fk_lead_opportunity_id;
				$fk_lead_opportunity_id = $new_fk_lead_opportunity_id;
			}

			if (isset($post['follow_up_datetime'])) {
				$insertActivityArray['follow_up_datetime'] = $post['follow_up_datetime'];
			}

			if (isset($post['email_draft_time'])) {
				$insertActivityArray['email_draft_time'] = $post['email_draft_time'];
			}

		 	if (!empty($_FILES["activity_attachment"]['name'])) {
				$insertActivityArray['activity_attachement_name'] = $file;
				$insertActivityArray['activity_attachement_orig_name'] = $file_orig_name;
				$insertActivityArray['activity_attachement_path'] = $file_path;
			}
			//print_r($insertActivityArray);exit;
			// echo $fk_lead_opportunity_id;
			// echo $this->session->userdata('user_id');
			$sub='';
			$select='GROUP_CONCAT(contact_info) as contact_info';
			//$where=array("contact_type" => "Email","fk_user_id" =>  $fk_lead_opportunity_id);
			$to=$_POST['to'];
			if (isset($post['activity_title'])) {
				$sub=$post['activity_title'];
			}
			$msg=$post['description'];
			$from='';

			// if ($post['activity_typeUpdate'] == 'Compose Email') {
			// 	$to = str_replace('|', ',', $post['userEmail']);
			// 	$whereUserId = array('fk_user_id' => $this->session->userdata('user_id'));
			// 	$getFromEmailId = $this->leadActivityModel->getUserEmail('*', $whereUserId);

			// 	$from = $getFromEmailId[0]['email_id'];
			// 	$password = $this->my_simple_crypt($getFromEmailId[0]['password'], 'd' );
			// 	$signature = $getFromEmailId[0]['message_signature']."<br/><img src = '".base_url()."upload/".$getFromEmailId[0]['file']."'>";
			// 	if (isset($file)) {
			// 		$file = $file;
			// 	} else {
			// 		$file = '';
			// 	}
			// 	$msg = $post['description'];
			// 	$sub = $post['activity_typeUpdate'];
			// 	if ($post['status'] == 'Complete') {
			// 		$mail_res=$this->Activity_mail($to,$from,$sub,$msg,$file,$password,$signature);
			// 	}
			// }

			// if(isset($post['message'])) {
			// 	// if($post['activity_mail']){

	  //       		$config['upload_path']= APPPATH.'../upload/leadActivityFiles';
	  //       		$config['allowed_types'] = '*';
	  //       		$new_name = time().$_FILES["activity_mail"]['name'];
	  //       		$config['file_name'] = $new_name;
		 //            $this->load->library('upload', $config);
		 //            if ($this->upload->do_upload('activity_mail'))
		 //            {
		 //            	$data = $this->upload->data();
		 //            	$file = $data['orig_name'];
		 //            	$file_orig_name = $data['client_name'];
		 //            	$full_path = $data['full_path'];
		 //            }
		 //            $file_info = $this->upload->data();
			// 		//$img = $file_info['activity_mail']; 
			// 		if(isset($post['message']) && $post['message']!='') {
			// 			$mail_res=$this->Activity_mail($to,$from,$sub,$msg,$file);
			// 		}
	  //       }

	        date_default_timezone_set('Asia/Kolkata');
			if (isset($post['opportunity_title']) && $new_fk_lead_opportunity_id !='') {
				if (isset($post['follow_up_datetime']) && $post['follow_up_datetime'] !='') {
					$insertActivityArray['follow_up_datetime'] = $post['follow_up_datetime'];
				}
				
				$insertActivityArray['updated_date'] = date('d-m-Y h:i A');
				$insertActivityArray['str_updated_date'] = strtotime(date('d-m-Y'));
				$insertActivityArray['created_date'] = date('d-m-Y h:i A');
				$insertActivityArray['str_created_date'] = strtotime(date('d-m-Y'));
				//print_r($insertActivityArray);exit;
				$data['id'] = $this->leadActivityModel->insertActivity($insertActivityArray);
				$this->session->set_userdata('setMessage','Added');
			} else {
				$where = array('lead_activity_id' => $lead_activity_id);
				if (isset($post['follow_up_datetime']) && $post['follow_up_datetime'] !='') {
					$insertActivityArray['follow_up_datetime'] = $post['follow_up_datetime'];
				}
				
				$insertActivityArray['updated_date'] = date('d-m-Y h:i A');
				$insertActivityArray['str_updated_date'] = strtotime(date('d-m-Y'));
				$data['id'] = $this->leadActivityModel->updateActivity($insertActivityArray,$where);
				$this->session->set_userdata('setMessage','Updated');
			}

//print_r($getLeadOppId);exit;
			if (isset($post['follow_up_datetime']) && $post['follow_up_datetime'] !='') {
				$insertActivityArray['activity_start_datetime'] = $post['follow_up_datetime'];
				$insertActivityArray['follow_up_date'] = '';
				$insertActivityArray['follow_up_datetime'] = '';
				$insertActivityArray['activity_end_datetime'] = '';
				$insertActivityArray['fk_lead_opportunity_id'] = $fk_lead_opportunity_id;

				$activity_up = $post['follow_up_datetime'];				
				$activity_date = date("d-m-Y", strtotime($activity_up));
				$insertActivityArray['activity_date'] = $activity_date;
				$data['id'] = $this->leadActivityModel->insertActivity($insertActivityArray);
			}

			$whereNotificationID = array('fk_notification_id' => '12');
			$addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);
			if(!empty($addLeadNotification['result'])) {
				$userIDs = json_decode($addLeadNotification['result'][0]['user_id']);
				$getEmailList = $this->userModel->getUserEmail('*',$userIDs);
	        	foreach ($getEmailList as $key => $value) {
		        	$emailList[] = $value['contact_info'];
		        } 
			}
	        $where = array('lead_opportunity_id' => $fk_lead_opportunity_id);
        	$getUserdetails = $this->leadOpportunityModel->getLeadDetails($where);
			if ($addLeadNotification['count'] == 1) {
		        $emailString = implode(',', $emailList);
	        	$subject = 'Activity Updated Successfully';
	        	$module = 'Activity against';
	        	$name = $getUserdetails['result'][0]['opportunity_title'];
	        	$action = 'updated';
	        	$actionBy = $this->session->userdata('user_name');
	        	$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
	        }		


			if (isset($post['email_draft_time']) && $post['email_draft_time'] !='') {
				$insertArray = array(
        		'email_Ids' => str_replace(' | ', ',', $post['userEmail']),
        		'subject' => $post['activity_title'],
        		'message' => $post['description'],
        		'draft_time' => $post['email_draft_time'],
        		'added_by' => $this->session->userdata('user_id'),
        	);

        	$insert = $this->userModel->addUserEmailDraft($insertArray);
			}

			if(isset($post['message']) && $post['message']!='') {
				if (isset($data['id'])) {
					$lead_activity_id = $data['id'];
				}

				$insertMailArray = array(
					'fk_lead_activity_id' => $lead_activity_id, 
					'fk_lead_opportunity_id' => $fk_lead_opportunity_id, 
					'to_id' => $to,
					'from_id' => $this->session->userdata('user_id'),
					'sub' => $sub,
					'msg' => $msg,
					'file_path' => $full_path,
					'file_name' => $file,
					'file_orig_name' => $file_orig_name		
				); 
				$activity_mailres=$this->leadActivityModel->addActivityMail($insertMailArray);
			}
			
			//if (isset($post['leadActivity'])) {
				redirect('calendar');exit;
			//}

			// $response['code'] = 200;
			// $response['message'] = "<div class='alert alert-success'>
	  //                   <strong>Success!</strong> Activity Added Successfully.</div>";
			// $response['data'] = $data['id'];
			// $response['data']['heading'] = $data['formheading'];
		// }catch(Exception $e){
		// 	$response['code'] = 505;
		// 	$response['message'] = 'exception in insertion';
		// 	$response['data'] = array();
		// }
		//echo json_encode($response);
	}



	public function updateActivity($userId = null) {
		try{ 
			$post = $this->input->post();
			// print_r($post); echo"</br> =>>>";die;
			
			// $insertUserArray = array(
			// 	'fk_lead_opportunity_id' => $post['leadopportunityId'],
			// 	'activity_date' => $post['activity_date'],
			// 	'activity_time_from' => $post['activity_time_from'],
			// 	'activity_time_to' => $post['activity_time_to'],
			// 	'reminder' => $post['reminder'],
			// 	'activity_type' => $post['activity_typeUpdate'],
			// 	'initiated_by' => $post['initiated_byUpdate'],
			// 	'assigned_by' => $post['assigned_by'],
			// 	'contacted_by' => $user_id,
			// 	'address' => $post['address'],
			// 	'city' => $post['city'],
			// 	'state' => $post['stateUpdate'],
			// 	'zip' => $post['zipUpdate'],
			// 	'description' => $post['description'],
			// 	'follow_up_date' => $post['follow_up_date'],				
			// 	'at' => $post['at'],				
			// 	'activity_status' => 'active',				
			// );

			$insertUserArray = array(
				'fk_lead_opportunity_id' => $post['leadopportunityId'],
				'activity_date' => $post['activity_date'],
				'activity_time_from' => $post['activity_time_from'],
				'activity_time_to' => $post['activity_time_to'],
				'reminder' => $post['reminder'],
				'activity_type' => $post['activity_typeUpdate'],
				'initiated_by' => $post['initiated_byUpdate'],
				'assigned_by' => $post['assigned_by'],
				'contacted_by' => $this->session->userdata('user_id'),
				'description' => $post['description'],
				'follow_up_date' => $post['follow_up_date'],				
				'at' => $post['at'],				
				'activity_status' => 'active',				
			);
			if(!$userId) { 
				$data['id'] = $this->leadActivityModel->insertActivity($insertUserArray);
				$this->session->set_userdata('setMessage','Added');
			}else {
				$where = array('user_id' => $userId);
				$data['id'] = $this->userModel->updateUser($insertUserArray,$where);
					$ContactInfo = $post['contact_detail'];
					$ContactType = $post['contact_type'];
					$userContactId = $post['userConactId'];					
			}

			$response['code'] = 200;
			$response['message'] = "<div class='alert alert-success'>
	                    <strong>Success!</strong> Activity Added Successfully.</div>";
			$response['data'] = $data['id'];
		}catch(Exception $e){
			$response['code'] = 505;
			$response['message'] = 'exception in insertion';
			$response['data'] = array();
		}
		echo json_encode($response);
	}
	// end : createuser Action
		/**



	* displayForm action of User controller
	* @author Bimal Sharma
	* @param $userType String user type (internal,supplier,customer)
	*/
	public function displayForm($userType = 'internal',$id = null) {
		try {
			if ($id) {
				$Permission = $this->permission->checkUserPermission(24);
			} else {
				$Permission = $this->permission->checkUserPermission(23);
			}
			if ($Permission) {
				$select = '*,GROUP_CONCAT(CONCAT(uc.contact_info,"_",uc.contact_type)) as user_info, u.full_name, u.designation, c.company_name';
				$where = [];
				$getOpportunityList = $this->leadActivityModel->getLead($select,$where);
				// print_r($getOpportunityList); die;
				
					foreach ($getOpportunityList as $key => $value) {
						$userInfo = explode(",", $value['user_info']);
						$getOpportunityList[$key]['phone'] = '---';
						$getOpportunityList[$key]['email'] = '---';
						$allPhone = array();
						$allEmail = array();
						foreach ($userInfo as $userkey => $uservalue) {
							$userData = explode('_', $uservalue);
							if(@$userData[1] == 'Phone'|| @$userData[1] == 'Cell Phone'){
								$allPhone[] = $userData[0];
							}else if (@$userData[1] == 'Email'){
								$allEmail[] = @$userData[0];
							}
						}
						$getOpportunityList[$key]['phone'] = implode(', ',$allPhone);
						$getOpportunityList[$key]['email'] = implode(', ',$allEmail);
					}
				
				$data['getLead'] =  $getOpportunityList;
				// print_r($data['getLead']['1']['user_info']); die;

				$selectCountry = '*';
				$whereCountry= array();
				$data['activityType'] = $this->leadActivityModel->getActivityType($selectCountry,$whereCountry);

				$whereAcStatus = array('activity_type' => 'Phone Call');
				$data['phone_activity_status'] = $this->leadActivityModel->getActivityStatus('*', $whereAcStatus);

				$whereAcStatus = array();
				$data['get_activity_status'] = $this->leadActivityModel->getActivityStatus('*', $whereAcStatus);

				$selectSalesPerson = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) as name";
				// $whereSalesPerson = array('r.role_name' => 'Sales Person');
				$whereSalesPerson = array('r.role_status' => 'active');

				$data['salesPerson'] = $this->leadActivityModel->getSalesPersons($selectSalesPerson,$whereSalesPerson);
				// print_r($data);die;
				if($id) {$data['formheading'] = "Edit Activity";}
				else{
					$data['formheading'] = "Add Activity";
				}
				if($id) { 
					$selectActi = "t1.*, t2.status, t2.opportunity_title, CONCAT(u2.first_name,' ',u2.last_name) as name,GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info, u3.full_name,u3.designation,c.company_name";

					$where = 'lead_activity_id = "'.$id.'"';
					$actiList = $this->leadActivityModel->getActivity($selectActi,$where);
					//print_r($actiList[0]['fk_lead_opportunity_id']); die;
					$fk_lead_opportunity_id = $actiList[0]['fk_lead_opportunity_id'];

					

					$activity_type = $actiList[0]['activity_type'];
					$wheremodule = array('activity_type' => $activity_type);
					$data['activity_status'] = $this->leadActivityModel->getActivityStatus('*', $wheremodule);

					$data['opportunity_title'] = $actiList[0]['opportunity_title'];

					foreach ($actiList as $key => $value) {
						if($actiList[$key]['follow_up_date'] == ""){						
							$actiList[$key]['follow_up_date'] = NULL;
						} else{ 
						// $oneFollow = $actiList[$key]['follow_up_date'];
						// $newDateFollw = date("d-M-Y", strtotime($oneFollow));
						// $actiList[$key]['follow_up_date'] = $newDateFollw;
						
					}

					if($actiList[$key]['activity_date'] == ""){
							
							$actiList[$key]['activity_date'] = "";
						} else{ 
						// $oneActivity = $actiList[$key]['activity_date'];
						// $newDateActivity = date("d-M-Y", strtotime($oneActivity));
						// $actiList[$key]['activity_date'] = $newDateActivity;					
					}

						$userInfo = explode(",", $value['user_info']);

						$actiList[$key]['phone'] = '---';
						$actiList[$key]['email'] = '---';
						foreach($userInfo as $uservalue) {
							$userData = explode('_', $uservalue);
							if($userData[1] == 'Phone') {
								$getPhone[] = $userData[0]; 
							} else if ($userData[1] == 'Email') {
								$getEmail[] = $userData[0];
							}
						}
						// foreach ($userInfo as $userkey => $uservalue) {
						// 	if ($uservalue != ''){
						// 		$userData = explode('_', $uservalue);
						// 		print_r($userData);
						// 		if($userData[1] == 'Phone'){
						// 			$actiList[$key]['phone'] = $userData[0]; 
						// 		}else if ($userData[1] == 'Email'){
						// 			$actiList[$key]['email'] = $userData[0];
						// 		}
						// 	}
							
						// }
						$actiList[$key]['phone'] = implode(' | ', $getPhone);
						$actiList[$key]['email'] = implode(' | ', $getEmail);
					}

					$data['values'] = $actiList;
					// print_r($data['values']); die;
					if(is_array($data['values'])) {
						$data['values'] = $data['values'][0];
					}
					//-------Activity History------------------
					$selectActivityList = "*";
					$whereOppId = array('fk_lead_opportunity_id' => $data['values']['fk_lead_opportunity_id']);
					$data['activityListHistory'] = $this->leadActivityModel->getActivityList($selectActivityList,$whereOppId);
					//-------Activity History------------------

					// print_r($data['value']['follow_up_date']); die;
					$selectConatactType = '*';
					$whereConactInfo = 'uc.fk_user_id = "'.$id.'"';
					$data['Contact'] = $this->leadOpportunityModel->getUserContact($selectConatactType,$whereConactInfo);
					$data['formheading'] = "Edit Activity";
				}

				$data['userId'] = $id;
				// print_r($data['values']); die;
				$html = $this->page->getPage('leadActivityForm',$data,true);
				$response['code'] = 200;
				$response['message'] = 'form generated';
				$response['data']['html'] = $html;
				$response['data']['heading'] = $data['formheading'];
				$response['data']['editor'] = ['message'];
			} else {
				$data['formheading'] = 'No Permissions Access';
				$response['code'] = 404;
				$response['message'] = 'PAGE NOT FOUND';
				$response['data']['html'] = null;
				$response['data']['heading'] = $data['formheading'];
			}
		}catch(Exception $e) {
			$response['code'] = 505;
			$response['message'] = 'exception in form generation';
			$response['data'] = array();
		}	
		
		echo json_encode($response);
		exit;
	} // end : displayForm Action

	/** displayForm action of User controller
	* @author Sagar Kodalkar
	* @param $userType String user type (internal,supplier,customer)
	*/
	public function displayFormAddActivity($userType = 'internal', $id = null) {
		try {
			if ($id) {
				$Permission = $this->permission->checkUserPermission(24);
			} else {
				$Permission = $this->permission->checkUserPermission(23);
			}
			if ($Permission) {
				$select = '*,GROUP_CONCAT(CONCAT(uc.contact_info,"_",uc.contact_type)) as user_info, u.full_name,u.designation,c.company_name';
				$where = array('lead_opportunity_id' => $id);
				$getOpportunityList = $this->leadActivityModel->getLead($select,$where);
				//print_r($getOpportunityList); die;
				
					foreach ($getOpportunityList as $key => $value) {
						$userInfo = explode(",", $value['user_info']);
						$getOpportunityList[$key]['phone'] = '---';
						$getOpportunityList[$key]['email'] = '---';
						$allPhone = array();
						$allEmail = array();
						foreach ($userInfo as $userkey => $uservalue) {
							$userData = explode('_', $uservalue);
							if($userData[1] == 'Phone'|| $userData[1] == 'Cell Phone'){
								$allPhone[] = $userData[0];
							}else if ($userData[1] == 'Email'){
								$allEmail[] = $userData[0];
							}
						}
						$getOpportunityList[$key]['phone'] = implode(', ',$allPhone);
						$getOpportunityList[$key]['email'] = implode(', ',$allEmail);
					}
				
				$data['getLead'] =  $getOpportunityList;
				// print_r($data['getLead']['1']['user_info']); die;

				$selectCountry = '*';
				$whereCountry= array();
				$data['activityType'] = $this->leadActivityModel->getActivityType($selectCountry,$whereCountry);

				$whereAcStatus = array('activity_type' => 'Phone Call');
				$data['phone_activity_status'] = $this->leadActivityModel->getActivityStatus('*', $whereAcStatus);

				$selectCountry = 'id,nicename,phonecode';
				$whereCountry= array();
				$data['country'] = $this->leadOpportunityModel->getCountry($selectCountry,$whereCountry);

				$selectSalesPerson = "u1.user_id as sales_people_id, CONCAT(u1.first_name, ' ', u1.last_name) as name";
				$whereSalesPerson = array('Manager', 'Sales Executive', 'Sales Person', 'Administrator');
				$data['salesPerson'] = $this->leadOpportunityModel->getSalesPersonsAndAdmins($selectSalesPerson, $whereSalesPerson);
				//$data['salesPerson'] = $this->leadActivityModel->getSalesPersons($selectSalesPerson,$whereSalesPerson);
				//print_r($data['salesPerson']);die;
				$data['formheading'] = "Add Activity";
				
				if($id) {
					$selectActi = "t1.*, t2.status, t2.opportunity_title, , CONCAT(u2.first_name,' ',u2.last_name) as name,GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info, u3.full_name,u3.designation,c.company_name";

					$where = 'lead_activity_id = "'.$id.'"';
					$actiList = $this->leadActivityModel->getActivity($selectActi,$where);
					// print_r($data['value']['follow_up_date']); die;
					$selectConatactType = "GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info";
					$whereContact = array('lo.lead_opportunity_id' => $id);
					$data['Contact'] = $this->leadActivityModel->getuserContactActivity($selectConatactType,$whereContact);
				}

				$selectActivityList = "*";
				$whereOppId = array('fk_lead_opportunity_id' => $id);
				$data['activityListHistory'] = $this->leadActivityModel->getActivityList($selectActivityList,$whereOppId);

				$data['fk_lead_opportunity_id'] = $id;

				$html = $this->page->getPage('leadActivityFormAdd',$data,true);
				
				$response['code'] = 200;
				$response['message'] = 'form generated';
				$response['data']['html'] = $html;
				$response['data']['heading'] = $data['formheading'];

			} else {
				$data['formheading'] = 'No Permissions Access';
				$response['code'] = 404;
				$response['message'] = 'PAGE NOT FOUND';
				$response['data']['html'] = null;
				$response['data']['heading'] = $data['formheading'];
			}
		}catch(Exception $e) {
			$response['code'] = 505;
			$response['message'] = 'exception in form generation';
			$response['data'] = array();
		}	
		
		echo json_encode($response);
		exit;
	} // end : displayForm Action

	public function displaySendEmailForm($id = null, $activity_id = null) {
		try {
			if ($id) {
				$selectConatactType = "uc.contact_info";
				$whereContact = array('lo.lead_opportunity_id' => $id, 'uc.contact_type' => 'Email');
				$data['Contact'] = $this->leadActivityModel->getuserContactActivity($selectConatactType,$whereContact);

				$data['fk_lead_opportunity_id'] = $id;
				$data['activity_id'] = $activity_id;
				$data['formheading'] = 'Send Email';
				// print_r($data['getLead']['0']); die;
				$html = $this->page->getPage('leadActivitySendEmailForm',$data,true);
				
				$response['code'] = 200;
				$response['message'] = 'form generated';
				$response['data']['html'] = $html;
				$response['data']['heading'] = $data['formheading'];
				$response['data']['editor'] = ['message'];
			}
		}catch(Exception $e) {
			$response['code'] = 505;
			$response['message'] = 'exception in form generation';
			$response['data'] = array();
		}	
		
		echo json_encode($response);
		exit;
	} // end : displayForm Action

	public function displayComment($activity_id = null) {
		try {
			//if ($id) {
				$cmt = array();
				$whereSeenComment = array('fk_lead_activity_id' => $activity_id);
				$commentCount = $this->leadActivityModel->getCommentCount($whereSeenComment);
// 				foreach ($commentCount['data'] as $commentkey => $commentvalue) {
// 					$users = json_decode($commentvalue['read_by']);
// 					print_r($users);
// 					if (!empty($users) && @!in_array($this->session->userdata('user_id'), $users)) {
// 						$newArray = json_encode(array_push($users, $this->session->userdata('user_id')));
// 						$updateArray = array(
// 							'read_by' => $newArray
// 						);
						
// 						//$seenComment = $this->leadActivityModel->updateSeenComment($updateArray, $whereSeenComment);
// 					} else {
// 						$newArray = json_encode(array_push($cmt, $this->session->userdata('user_id')));
// 						//print_r($cmt);exit;
// 						$updateArray = array(
// 							'read_by' => $newArray
// 						);
// 						$seenComment = $this->leadActivityModel->updateSeenComment($updateArray, $whereSeenComment);
// 					}
// 				}
// exit;
				$selectConatactType = "ac.*, u.full_name";
				$whereContact = array('ac.fk_lead_activity_id' => $activity_id);
				$data['comment'] = $this->leadActivityModel->getComments($selectConatactType,$whereContact);

				//$data['fk_lead_opportunity_id'] = $id;
				$data['activity_id'] = $activity_id;
				$data['formheading'] = 'Comments';
				// print_r($data['getLead']['0']); die;
				$html = $this->page->getPage('leadActivityComment',$data,true);
				
				$response['code'] = 200;
				$response['message'] = 'form generated';
				$response['data']['html'] = $html;
				$response['data']['heading'] = $data['formheading'];
				$response['data']['editor'] = ['message'];
			//}
		}catch(Exception $e) {
			$response['code'] = 505;
			$response['message'] = 'exception in form generation';
			$response['data'] = array();
		}	
		
		echo json_encode($response);
		exit;
	} // end : displayForm Action

	/**
  	 * get list of copanies	
  	 * @author Bimal Sharma
	 * @param $companyType String company type (internal,supplier,customer)
	 */
	public function getActivity() {

		$request = $this->input->get();
		if (!empty($request)) {
			$offset = $request['start'];
			$limit = $request['length']; 
				// print_r($request); die;

			$columnArray = $request['columns'];
			$feilds = $columns = array_column($columnArray,'data');
			$feilds = $this->leadActivity->getSelectField($columns);
			$whereFeilds = $this->leadActivity->getWhereField($columns); 
		} else {
			$post = $this->input->post();
			$feilds[0] = "t1.lead_activity_id";
			$feilds[1] = "t1.activity_type"; 
			$feilds[2] = "opportunity_title";
			$feilds[3] = "description";
			$limit = null;
			$offset = null;
			$lead_activity_id = $post['lead_opportunity_id'];
		}
		
		$where = 't1.activity_status = "active"';
		if (isset($lead_activity_id)) {
			$where.= " and t1.fk_lead_opportunity_id=".$lead_activity_id;
		}

		
		if(!empty($request['search']['value'])) {
			foreach ($whereFeilds as $key => $value) {
				$where.= ' and '.$value." Like '%".$request['search']['value']."%'";
			}
		}

		// add filters
		if(!empty($request['q'])) { 
			$query = json_decode($request['q'],true);
			if($query) {
				$filter = $this->leadActivity->getWhereField(array_keys($query));
				foreach ($filter as $key => $value) { 
					if ($query[$key] !='') { 
						$where.= ' and '.$value." like '%".$query[$key]."%'"; 
					}
				}
			}
		}
		$order = null;
		if(isset($request['order']) && is_array($request['order'])) {
			$order = $columns[$request['order'][0]['column']].' '.$request['order'][0]['dir']; 	
		}

		array_push($feilds, "GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info, follow_up_date, CONCAT(u2.first_name,' ',u2.last_name) as fullName,t1.status,t1.activity_date,t1.fk_lead_opportunity_id, t1.activity_title, CONCAT(u4.full_name, ' (', c.company_name, ')') as client_name,t1.lead_activity_status,t1.follow_up_datetime,t1.activity_start_datetime");

		$wherepermissions = $this->permission->checkUserPermission(42);
		//print_r($wherepermissions);exit;
		if ($wherepermissions) {
			$whereUserId = array('fk_user_id' => $this->session->userdata('user_id'));
			$selectPermission = '*';
			$userPermissionList = $this->leadActivityModel->getWhoseDataCanView($selectPermission, $whereUserId);
			if (isset($userPermissionList[0]['can_view_activity']) && $userPermissionList[0]['can_view_activity']!='') {
				$userArray = json_decode($userPermissionList[0]['can_view_activity']);
				array_push($userArray, $this->session->userdata('user_id'));
				$users = implode(',', $userArray);
				//print_r($userPermissionList[0]['can_view_activity']);exit;
				$where.= ' and t1.created_by IN( '.$users.')';
			}
		} else {
			$where.= ' and t1.created_by IN( '.$this->session->userdata('user_id').')';
		}

		$companyList = $this->leadActivityModel->getActivity($feilds,$where,$order,$limit,$offset);
		//print_r($companyList);exit;
		foreach ($companyList as $key => $value) {
			$companyList[$key]['activity_start_datetime'] = date('d-M-Y h:i A', strtotime($companyList[$key]['activity_start_datetime']));
			$companyList[$key]['activity_title'] = 	$value['activity_title'];
			$userInfo = explode(",", $value['user_info']);
			$companyList[$key]['phone'] = '---';
			$companyList[$key]['email'] = '---'; 
			if(isset($userInfo)){
				foreach ($userInfo as $userkey => $uservalue) {
					$userData = explode('_', $uservalue); 
					if (!empty($userData)){
						if ( ! isset($userData[1])) {
						   $userData[1] = "--";
						}
						if($userData[1] == 'Phone'){
							$companyList[$key]['phone'] = $userData[0]; 
						}else if ($userData[1] == 'Email'){
							$companyList[$key]['email'] = $userData[0];
						}
					}
				}
			}
			if (isset($companyList[$key]['activity_start_datetime']) || $companyList[$key]['follow_up_datetime']) {
				$status = '';
				$followUpDate = $companyList[$key]['follow_up_datetime'];
				$activity_date = $companyList[$key]['activity_start_datetime'];
				// if (isset($followUpDate) && $followUpDate !='') {
				// 	$followUpDate = date('d-m-Y',strtotime($followUpDate));
				// 	$date = strtotime($followUpDate);
				// 	$now = strtotime(date('d-m-Y h:i A'));
				// 	if($date < $now) {
				// 	    $companyList[$key]['status'] = "<span style='color:red;'>Past Due</span>";
				// 	    $status = 'Past Due';
				// 	} else if ($companyList[$key]['lead_activity_status'] == 'Complete'){
				// 		$companyList[$key]['status'] = "<span style='color:green;'>Complete</span>";
				// 	    $status = 'Complete';
				// 	}
				// 	$companyList[$key]['activity_date'] = date('d-M-Y',strtotime($activity_date));
				// } else if (isset($activity_date) && $activity_date !='' && $status == '') {
				if (isset($activity_date) && $activity_date !='' && $status == '') {
					$activity_date = date('d-m-Y',strtotime($activity_date));
					$date = strtotime($activity_date);
					$now = strtotime(date('d-m-Y h:i A'));
					if($date < $now && $companyList[$key]['lead_activity_status'] != 'Complete') {
					    // $companyList[$key]['status'] = "Not Complete";
					    // $status = 'Not Complete';
					    $companyList[$key]['status'] = "<span style='color:red;'>Past Due</span>";
					    $status = 'Past Due';
					} else {
						$companyList[$key]['status'] = $companyList[$key]['lead_activity_status'];
					}
					// else if ($companyList[$key]['lead_activity_status'] == 'Complete'){
					// 	$companyList[$key]['status'] = "<span style='color:green;'>Complete</span>";
					//     $status = 'Complete';
					// } else {
					// 	$companyList[$key]['status'] = "Pending";
					//     $status = 'Pending';
					// }
					$companyList[$key]['activity_date'] = date('d-M-Y',strtotime($activity_date));
				}
				if (isset($status)) {
					$updateStatusValue= array(
						'status' => $status
					);
					$wherelead = array('lead_activity_id' => $companyList[$key]['lead_activity_id']);
					$updateStatus = $this->leadActivityModel->updateStatus($updateStatusValue,$wherelead);
				}
			}
			$whereComment = array('fk_lead_activity_id' => $companyList[$key]['lead_activity_id']);
			$commentCount = $this->leadActivityModel->getCommentCount($whereComment);
			// print_r($commentCount['data']);exit;
			$commentCnt = 0;
			$final = '';
			foreach ($commentCount['data'] as $commentkey => $commentvalue) {
				$users = explode(',', $commentvalue['read_by']);
				//echo count($users);
				//echo $users; //print_r($users);
				if ($commentvalue['read_by'] == '') {
					$commentCnt++ ;
					$final = $commentCnt;
				} else {
					if (count($users) == 1) {
						if ($users[0] != $this->session->userdata('user_id')) {
							$commentCnt++ ;
							$final = $commentCnt;
						}
					} else if(in_array($this->session->userdata('user_id'), $users)) {
						$commentCnt++ ;
						$final = $commentCount['count'] - $commentCnt;
					}
				}
				
			}
			$companyList[$key]['commentCount'] = $final;
			$commentCnt = 0;
		}
		// echo "<pre>";
		// print_r($companyList);exit;
		//exit;
		$companycount = $this->leadActivityModel->getActivity('*',$where);
		// print_r(count($companycount)); die;
		$data['recordsFiltered'] = count($companycount); 
		$data['recordsTotal'] = count($companycount); 
		$data['data'] = $companyList;
		// print_r($data['data']); die;
		echo json_encode($data);
	} // end : getLeads Action ,2

	public function deleteUActivity() { 
        $DeleteId = $this->input->post();
        $newUsrId = explode(',', $DeleteId['deleteThis']);
        $deleteUpdateData = array('activity_status' => 'inactive');
		$DeletedUser = $this->leadActivityModel->deleteActivities($deleteUpdateData,$newUsrId);
        if ($DeletedUser) {
            $this->session->set_userdata('setMessage','deleted');
            $whereNotificationID = array('fk_notification_id' => '13');
			$deleteLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);
			$userIDs = json_decode($deleteLeadNotification['result'][0]['user_id']);
        	$getEmailList = $this->userModel->getUserEmail('*',$userIDs);
        	foreach ($getEmailList as $key => $value) {
	        	$emailList[] = $value['contact_info'];
	        }

	        foreach ($newUsrId as $userKey => $userValue) {
            	$where = array('lead_opportunity_id' => $userValue);
            	$getUserdetails = $this->leadActivityModel->getActivityDetails($where);
            	if ($deleteLeadNotification['count'] == 1) {
			        $emailString = implode(',', $emailList);
		        	$subject = 'Activity Deleted Successfully';
		        	$module = 'Activity against';
		        	$name = $getUserdetails['result'][0]['opportunity_title'];
		        	$action = 'deleted';
		        	$actionBy = $this->session->userdata('user_name');
		        	$UserNotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
		        }
            }

            return true;
        } else {
            return False;
        }
    }

        public function getEmailIds() { 
        $DeleteId = $this->input->post();
        // print_r($DeleteId); die;
        $newUsrId = explode(',', $DeleteId['getEmail']);
        $select="";
        // print_r($newUsrId); die;
		$getuserData = $this->leadActivityModel->getEmailIds($select,$newUsrId);
		$test = [];
		foreach($getuserData as $a => $val){
            if (is_array($val)){
		        $test[] = implode(",", $val);
		    }
        }
        $finalEmails = implode(", ", $test);

        if (!empty($finalEmails)) {
            $this->session->set_userdata('setMessage','Email Sent Sucessully!');
            echo $finalEmails;
        } else {
            return False;
        }
    }

    public function sendBulkEmail() {

        $post = $this->input->post();
        $to = $post['usrEmail'];
        $subject = $post['usrSub'];
        $message = $post['usrMsg'];
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        // if ($this->form_validation->run() == FALSE) {
        //     echo "<div class='alert-login-danger'>
        //             <strong>Alert!</strong><br/><br/>".
        //             validation_errors().
        //         "</div>";
        // } else {
            try {
                // $email['u2.contact_info']       = $post['email'];
                // $email['u2.contact_type']       = 'Email';

                // $CheckLogin = $this->loginModel->checkValidEmail($email);
                //print_r($CheckLogin['result'][0]['contact_info']);exit;
                // if ($CheckLogin['count'] == 1) {
               		$mail_message = $message;
                    //Load email library
                    $this->load->library('email');
                    $config = array(
                        'protocol'  => 'smtps',
                        'smtp_host' => 'ssl://smtp.live.com',
                        'smtp_port' => 25,
                        'smtp_user' => 'crm@hozpitality.com',
                    	'smtp_pass' => 'Tak32071',
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8'
                    );
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");


                    $this->email->from('crm@hozpitality.com', 'Hozpitality CRM');
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($mail_message);

                    //Send email
                    if($this->email->send()) {
                    	$response['code'] = 200;
						$response['message'] = 'Success';
                    } else {
                    	$response['code'] = 500;
						$response['message'] = 'Failure';
                    }

     //        	} else {
     //        		$response['code'] = 404;
					// $response['message'] = 'Failure';
     //        	}

	        } catch(Exception $E) {
	                $response['code'] = 500;
					$response['message'] = 'Failure';
	        }
        echo json_encode($response);
    	// }
	}
	public function createExcel($list = null) {
		$filename = "Lead Activity-".str_replace('-', '', date('d-M-Y'));
    	header('Content-Disposition: attachment; filename="'.$filename.'.csv";');
    	header('Content-Type: application/csv');

    	$activityList = '';
    	if ($list != '') {
        	$list = str_replace('%20', '', $list);
        	$activityList = explode('_', $list);
        }

        $columnArray = $this->leadActivity->getActivityCoulmn();

        $fields = $columns = array_column($columnArray,'data');
        // print_r($fields); die;
        $title =  array_column($columnArray,'title');
		$fields = $this->leadActivity->getSelectField($columns);
		$fields[0] = "t2.opportunity_title";
		unset($fields[1]);
		//$fields[4] = "CONCAT(u1.first_name,' ',u1.last_name) as first_name ";
		// $fields[4] = "u2.full_name";
		$fields[7] = "(select contact_info from users_contacts where fk_user_id=t2.fk_user_id and contact_type='Email') as `email`";
		$fields[8] = "(select contact_info from users_contacts where fk_user_id=t2.fk_user_id and contact_type='Phone') as `phone`";
		// get where field
		$whereFeilds = $this->leadActivity->getWhereField($columns); 	
		
		$where = 't1.activity_status = "active"'; 
		$activityList = $this->leadActivityModel->getActivityExcel($fields,$where,$activityList);
		// print_r($activityList);exit;
// echo "oooooooooooo"; die;
		$f = fopen("php://output", "w");
		unset($title[0]);
		fputcsv($f, $title);
		foreach ($activityList as $activity) {
    		fputcsv($f, $activity);
		}
		fpassthru($f);   
    }
    public function savefilter() {
		try{
			$post = $this->input->post();
			// print_r($post); die;
			$test = json_encode($post);
			 

	        $insertArray = array(
				'filter_name' => $post['filterName'],
				'filter_values' => $test,
				'module' => 'Lead Activity'
				);
	        $data['id'] = $this->leadActivityModel->createFilter($insertArray);
				
				
				$response['code'] = 200;
				$response['message'] = "<div class='alert alert-success'>
	                    <strong>Success!</strong>Filter Saved Successfully.</div>";
				$response['data'] = $data['id'];
	        

		}catch(Exception $e){
			$response['code'] = 505;
			$response['message'] = 'exception in insertion';
			$response['data'] = array();
		}
		echo json_encode($response);
	} // end : createCompany Action

	public function createGrid($gridId = null) {
		try{
			$data = [];
			$data['options'] = array();
			$data['columns'] = array();
			$module_name = $this->uri->segment(1);
			$selectedColumns = $this->input->post();
			//print_r($selectedColumns);exit;
			$column = $arrayField = $this->leadActivity->getActivityCoulmn();
			$data['columns'] = $column;
			if(!empty($selectedColumns)) {
				$arrayField = array();
				array_push($arrayField, $column[0]);
				foreach ($selectedColumns['internal'] as $key => $value) {
					array_push($arrayField, $column[$value]);
				}

			}else if($gridId) {
				$grid_columns = $this->leadActivityModel->getGrid('grid_columns',array('grid_id' => $gridId));
				if(!empty($grid_columns)) {
					$arrayField = json_decode($grid_columns[0]['grid_columns']);
				}
			}

			if(isset($selectedColumns['ischeck'])) {
	            $columns['grid_columns'] = json_encode($arrayField);
	            $columns['grid_name'] = $selectedColumns['saveGrid'];
	            $columns['module_name'] = $module_name;
	            $this->leadActivityModel->insertGrid($columns);
	        }
	        $data['columns'] = $arrayField;
	        $data['options'] = $this->leadActivityModel->getGrid('*',array('module_name' => $module_name));
			$response['code'] = 200;
			$response['message'] = 'Grid created successfully';
			$response['data'] = $data;
		}catch(Exception $e){
			$response['code'] = 505;
			$response['message'] = 'exception in insertion';
			$response['data'] = array();
		}
		echo json_encode($response);
	} 

	public function Activity_mail($to,$from,$sub,$msg,$file,$password=null,$signature=null)
	{
		try {
                // $CheckLogin = $this->loginModel->checkValidEmail($email);
                //print_r($CheckLogin['result'][0]['contact_info']);exit;
           	$sender = explode(',', $to);
           	foreach ($sender as $key => $to) {
           		//====================Email Code=======================================================================
                $mail_message = $msg;
                $mail_message.= $signature;
                //Load email library
                // echo $mail_message; exit;
                $this->load->library('email');
                $config = array(
                    'protocol'  => 'smtps',
                    'smtp_host' => 'ssl://smtp.live.com',
                    'smtp_port' => 25,
                    'smtp_user' => $from,
                    'smtp_pass' => $password,
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8'
                );
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");


                $this->email->from($from, 'Hozpitality CRM');
                $this->email->to($to);
                $this->email->subject($sub);
                $this->email->message($mail_message);
                if (isset($file)) {
                	$this->email->attach($file);
                }

                //Send email
                if($this->email->send()) {
                    return true;
                } else {
                    return false;
                }
           	}
            } catch(Exception $E) {
                    $response['code'] = 500;
                    $response['message'] = 'Failure';
            }
        echo json_encode($response);
	}

	public function getSavedFilterDropdown() {
		$post = $this->input->post();
		$wheremodule = array('module' => 'Lead Activity');
		$getPath['filterData'] = $this->companyMondel->getFilterDropdown($wheremodule);
		$getIdentifierList = $this->load->view('form/getFilterDropdown', $getPath);
		return $getIdentifierList;
	}

	public function getFiles() {

		// $request = $this->input->get();
		// if (!empty($request)) {
		// 	$offset = $request['start'];
		// 	$limit = $request['length']; 
		// 		// print_r($request); die;

		// 	$columnArray = $request['columns'];
		// 	$feilds = $columns = array_column($columnArray,'data');
		// 	$feilds = $this->leadActivity->getSelectField($columns);
		// 	$whereFeilds = $this->leadActivity->getWhereField($columns); 
		// } else {
			$offset = null;$limit = null;
			$post = $this->input->post();
			if (isset($post['start'])) {
				$offset = $post['start'];
			}
			if (isset($post['length'])) {
				$limit  = $post['length']; 
			}
			// print_r($post[0]);exit;
			// $feilds[0] = "t1.lead_activity_id";
			// $feilds[1] = "t1.activity_type"; 
			// $feilds[2] = "opportunity_title";
			// $feilds[3] = "description";
			// $limit = null;
			// $offset = null;
			// $lead_activity_id = $post['lead_opportunity_id'];
		//}
		
		$select = 'lam.*, u.full_name as sent_from, la.activity_type';
		$where = '';
		if (isset($post[0])) {
			$where= array('lam.fk_lead_opportunity_id' => $post[0]);
		}
		$companyNewList = $this->leadActivityModel->getActivityFiles($select,$where,$limit,$offset);
		$companyList = $companyNewList['data'];
		// print_r($companyNewList['count']);exit;
		foreach ($companyList as $key => $value) {

			$companyList[$key]['created_on'] = date("d-M-Y h:m A", strtotime($companyList[$key]['created_on']));

			if (isset($companyList[$key]['file_path']) && $companyList[$key]['file_path'] !='') {
				$filepath = $companyList[$key]['file_path'];
				$file_orig_name = $companyList[$key]['file_orig_name'];
				$filename = $companyList[$key]['file_name'];

				$companyList[$key]['attachment'] = "<a href='".$filepath."' target='_blank'>".$file_orig_name."</a>";
			} else {
				$companyList[$key]['attachment'] = "--";
			}

		}

		 // print_r(count($companycount)); die;
		$data['recordsFiltered'] = $companyNewList['count']; 
		$data['recordsTotal'] = $companyNewList['count']; 
		$data['data'] = $companyList;
		// print_r($data['data']); die;
		echo json_encode($data);
	} // end : getLeads Action ,2

	public function sendLeadEmail() {
		$post = $this->input->post();
		$to=$_POST['to'];
		$sub=$_POST['subject'];
		$msg=$_POST['message'];
		$file = '';
		$file_orig_name = '';
		$full_path = '';
		if(isset($post['message'])) {
    		$config['upload_path']= APPPATH.'../upload/leadActivityFiles';
    		$config['allowed_types'] = '*';
    		$new_name = time().$_FILES["activity_mail"]['name'];
    		$config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('activity_mail'))
            {
            	$data = $this->upload->data();
            	$file = $data['orig_name'];
            	$file_orig_name = $data['client_name'];
            	$full_path = $data['full_path'];
            }
            $file_info = $this->upload->data();
			//$img = $file_info['activity_mail'];
			$from = '';
			if(isset($post['message']) && $post['message']!='') {
				$mail_res=$this->Activity_mail($to,$from,$sub,$msg,$file);
				$insertMailArray = array(
					'fk_lead_activity_id' => $post['lead_activity_id'],
					'fk_lead_opportunity_id' => $post['fk_lead_opportunity_id'],
					'to_id' => $to,
					'from_id' => $this->session->userdata('user_id'),
					'sub' => $sub,
					'msg' => $msg		
				);
				if (isset($full_path)) {
					$insertMailArray['file_path'] = $full_path;
					$insertMailArray['file_name'] = $file;
					$insertMailArray['file_orig_name'] = $file_orig_name;
				}
				$activity_mailres=$this->leadActivityModel->addActivityMail($insertMailArray);


			}
        }
        return true;
	}

	public function getActivityStatus() {
		$post = $this->input->post();
		$wheremodule = array('activity_type' => $post['activty_type']);
		$getPath['activity_status'] = $this->leadActivityModel->getActivityStatus('*', $wheremodule);
		$getIdentifierList = $this->load->view('form/getActivityStatus', $getPath);
		return $getIdentifierList;
	}

	public function saveComment() {
		$post = $this->input->post();
		date_default_timezone_set('Asia/Kolkata');
		$comment_date = date('d-m-Y h:i A');
		$userArray = array();
		$insertArray = array(
			'fk_lead_activity_id' => $post['lead_activity_id'],
			'comment' => $post['comment'],
			'sender_id' => $this->session->userdata('user_id'),
			'read_by' => json_encode(array_push($userArray, $this->session->userdata('user_id'))),
			'created_date' => $comment_date,
		);
		//print_r($insertArray);exit;
		$addComment = $this->leadActivityModel->addComment($insertArray);

		$select = "ac.*, u.full_name";
		$where = array('ac.fk_lead_activity_id' => $post['lead_activity_id']);
		$data['comment'] = $this->leadActivityModel->getComments($select, $where);

		$getIdentifierList = $this->load->view('pages/activityCommentPage', $data);
		return $getIdentifierList;
	}

	public function deleteAttachFile() {
		$post = $this->input->post();
		$lead_activity_id = $post['lead_activity_id'];
		$select = 'activity_attachement_path';
		$whereCompanyId = array('lead_activity_id' => $lead_activity_id);
		$getPath = $this->leadActivityModel->getFilePath($select, $whereCompanyId);
		//unlink($getPath[0]['activity_attachement_path']);
		$updateArray = array(
					'activity_attachement_name' => '',
					'activity_attachement_orig_name' => '',
					'activity_attachement_path' => '',
				);
		$where = array('lead_activity_id' => $lead_activity_id);
		$companyIdentifierList = $this->leadActivityModel->deleteAttachFile($updateArray, $where);
		$getIdentifierList = $this->load->view('form/getLeadActivityAttachFile', $companyIdentifierList);
		return $getIdentifierList;
	}

	public function getOpportunityDetails() {
		$post = $this->input->post();
		//print_r($post);exit;
		$values = explode(' - ', $post['value']);
		$leadName = $values[0];
		$userName = $values[1];
//print_r($leadName);exit;
		$whereoppid = array('opportunity_title' => $leadName);
		$selectOppId = 'lead_opportunity_id';
		$getOppId = $this->leadOpportunityModel->getLeadOpportunities($selectOppId, $whereoppid);

		if (isset($getOppId[0]['lead_opportunity_id'])) {
			$lopId = $getOppId[0]['lead_opportunity_id'];
		} else {
			$lopId = 0;
		}

		$whereuser = array('full_name' => $userName);
		$selectUser = 'u.full_name,u.designation,c.company_name,GROUP_CONCAT(CONCAT(uc.contact_info,"_",uc.contact_type)) as emails';
		$getUserDetails = $this->userModel->getUsersForActivity($selectUser, $whereuser);
		array_push($getUserDetails[0], $lopId);
		array_push($getUserDetails[0], $leadName);
		$result = implode('|', $getUserDetails[0]);
		//print_r($result);exit;
		//$getIdentifierList = $this->load->view('form/getActivityStatus', $getPath);
		echo $result;
	}

	public function getActivityHistory() {
		$post = $this->input->post();
		$where = array('t1.fk_lead_opportunity_id' => $post['fk_lead_opportunity_id']);
		$select = 't1.activity_title,t1.activity_start_datetime,t1.activity_type';
		$getData['data'] = $this->leadActivityModel->getActivity($select,$where);
		$getIdentifierList = $this->load->view('form/getActivityForm', $getData);
		echo $getIdentifierList;
		
	}

	public function getActivityNotification() {
		$where = array('created_by' => $this->session->userdata('user_id'), 'activity_status' => 'active');
		$select = 'activity_start_datetime, activity_title, reminder';
		$getData = $this->leadActivityModel->getActivityForNotification($select,$where);
		//print_r($getData);exit;
		$record = 0;
		foreach ($getData as $key) {
			$data['title'] = $key['activity_title'];
			// if (isset($key['reminder']) && $key['reminder'] !='') {
			// 	if ($key['reminder'] == '1 min') {

			// 	} else if ($key['reminder'] == '1 min') {

			// 	} else if ($key['reminder'] == '2 min') {
					
			// 	} else if ($key['reminder'] == '5 min') {
					
			// 	} else if ($key['reminder'] == '1 Day') {
					
			// 	} else if ($key['reminder'] == '2 Day') {
					
			// 	} else if ($key['reminder'] == '5 Day') {
					
			// 	}
			// 	$data['title'] = $key['activity_title'];
			// }
			date_default_timezone_set('Asia/Kolkata');
			$data['activity_start_datetime'] = $key['activity_start_datetime'];
			$data['current_time'] = date('Y-m-d').'T'.date('H:i');
			$starttimestamp = strtotime($key['activity_start_datetime']);
			$endtimestamp = strtotime($data['current_time']);
			$difference = abs($endtimestamp - $starttimestamp)/3600;
			$difference_new = number_format((float)$difference, 15, '.', '');
			$data['diff_reminder_value'] = $difference_new;
			if ($difference == '0.016666666666667') {
				$data['diff_reminder'] = '1 min';
			} else if ($difference == '0.033333333333333') {
				$data['diff_reminder'] = '2 min';
			} else if ($difference == '0.083333333333333') {
				$data['diff_reminder'] = '5 min';
			} else if ($difference == '24') {
				$data['diff_reminder'] = '1 Day';
			} else if ($difference == '48') {
				$data['diff_reminder'] = '2 Day';
			} else if ($difference == '120') {
				$data['diff_reminder'] = '3 Day';
			}

			$data['reminder'] = $key['reminder'];
			
			$data['msg'] = 'Your this Activity scheduled at '. date('h:i A', strtotime($key['activity_start_datetime']));
			$data['icon'] = 'https://crm.specxnet.com/assets/app/media/img/logos/HozpitalityLogo.png';
			$data['url'] = '';
			$rows[] = $data;
			// $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($key['notif_repeat']*60));
			// $push->updateNotification($key['id'],$nextime);
			$record++;
		}
		// print_r($rows);exit;
		$array['notif'] = $rows;
		$array['count'] = $record;
		$array['result'] = true;
		//print_r($array);exit;
		echo json_encode($array);
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
