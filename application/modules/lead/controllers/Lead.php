<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Lead extends CI_Controller {



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

		$this->load->model(array('Lead_model' => 'leadOpportunityModel'));

		$this->load->model(array('Company_model' => 'companyMondel'));

		$this->load->model(array('User_model' => 'userModel'));

		$this->load->library(array('Lead_library' => 'leadOpportunity'));

		$this->load->model(array('Activity_model' => 'leadActivityModel'));

		$this->load->model(array('Proposal_model' => 'proposalModel'));

		$this->load->library(array('Permissions_library' => 'permission'));

	}



	/**

	* index action of user controller

	* @author

	* @param

	* @param

	*/

	public function index($userType = 'internal', $leadTime = '')

	{

		$permissions = $this->permission->checkUserPermission(17);

		if (!$permissions) {

			redirect('page_not_found');exit;

		}



		$module_name = $this->uri->segment(1);

		// echo $userType; die; 

		$this->page->setTitle('Lead Opportunity');

		

		// set head style
		
	

		$this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");

//		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");
		
		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style-2.css");

		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");

		//$this->page->setHeadStyle(base_url()."assets/custom/css/nouislider.css");

		// $this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setHeadStyle(base_url()."assets/custom/css/style.css");		

		$this->page->setHeadStyle(base_url()."assets/custom/css/editor.css");

		$this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");		

		//$this->page->setHeadStyle("//cdn.syncfusion.com/ej2/material.css"); // for date

		//$this->page->setHeadStyle("//maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.cs"); // for search

		$this->page->setHeadStyle(base_url()."media/style.css");



		// Date picker 

		$this->page->setHeadStyle(base_url()."assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css");



		// select 2 

		$this->page->setHeadStyle(base_url()."assets/select2/dist/css/select2.min.css");





		//set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.3.0/nouislider.min.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs("//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"); // for search

		$this->page->setFooterJs(base_url()."assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url()."assets/demo/default/base/scripts.bundle.js");

		$this->page->setFooterJs("//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");

		$this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/leadOpportunity.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/custom.js");

		//Push Notification

		$this->page->setFooterJs(base_url()."assets/push_notification/notification.js");

		//$this->page->setFooterJs(base_url()."assets/demo/default/custom/crud/forms/widgets/ion-range-slider.js");

		//$this->page->setFooterJs(base_url()."assets/custom/js/nouislider.js");

		//$this->page->setFooterJs(base_url()."assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js");

		// $this->page->setFooterJs(base_url()."assets/custom/js/editor.js");

		// $this->page->setFooterJs("//cdn.syncfusion.com/ej2/dist/ej2.min.js"); // for date

		

		// text editor js

		$this->page->setFooterJs(base_url()."assets/ckeditor/ckeditor.js");



		// Date Picker

		$this->page->setFooterJs(base_url()."assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js");



		// Select 2

		$this->page->setFooterJs(base_url()."assets/select2/dist/js/select2.full.min.js");





		// load layout 

		$page['tabs'] = $this->leadOpportunity->getTabs();

		$page['contain'] = 'leadOpportunityList';

		$page['userType'] = $userType; 

		$page['module_name'] = $module_name; 		

		$page['newButton'] = $this->leadOpportunity->getNewButton();



		if (isset($userType) && $userType !='' && $userType !='internal') {

			$usrArray = array();

			array_push($usrArray, 'dashboard');

			array_push($usrArray, $userType);

			array_push($usrArray, $leadTime);

			$page['userWise'] = $usrArray;

		}

// print_r($this->input->post('filter'));exit;

		$page['filter'] = $this->input->post('filter');



		if (isset($page['filter']['saved_filter_id'])) {

			$page['savedfilterID'] = $page['filter']['saved_filter_id'];

		}


		$page['gridView'] = $this->leadOpportunityModel->getGrid('*',array('module_name' => $module_name));
		//print_r($page['gridView']);exit;



		$selectSalesPerson = "u1.user_id as sales_people_id, CONCAT(u1.first_name, ' ', u1.last_name) as name";

		$whereSalesPerson = array('r.role_name' => 'Sales Person');

		$page['salesPerson'] = $this->leadOpportunityModel->getSalesPersons($selectSalesPerson, $whereSalesPerson);

		$page['leadOpportunityColumn'] = $this->leadOpportunity->getOpportunityCoulmn();



		// var_dump($page['filter']); die;

		$selectFilter = '*';

		$whereFilter = array('module' => 'Lead Opportunity');

		$page['savedFilter'] = $this->leadOpportunityModel->getSavedFilter($selectFilter,$whereFilter);

		$page['access'] = $this->session->userdata('adminAccess');


		//Add,Edit,Delete Lead

		$page['addPermission'] = $this->permission->checkUserPermission(18);

		$page['editPermission'] = $this->permission->checkUserPermission(19);

		$page['deletePermission'] = $this->permission->checkUserPermission(20);

		$page['assignTo'] = $this->permission->checkUserPermission(43);




		$page['showOpportunity'] = $this->permission->checkUserPermission(17);

		$page['showActivity'] = $this->permission->checkUserPermission(22);

		$page['showActivityCalendar'] = $this->permission->checkUserPermission(17);

		$page['showRFQ'] = $this->permission->checkUserPermission(26);

		$page['showProposal'] = $this->permission->checkUserPermission(31);

		$page['showJobs'] = $this->permission->checkUserPermission(36);
		$page['showReleasePO'] = $this->permission->checkUserPermission(47);
		$page['showReleaseInvoice'] = $this->permission->checkUserPermission(48);


		// print_r($page);exit;

		$this->page->getLayout($page);

	}



	/**

	* createUser action of User controller to create user

	* @author Bimal Sharma

	*/

	public function createLead($leadId = null) {

		try{

			// echo $leadId/; die;

			$post = $this->input->post();  

			// print_r($post);exit;



			$whereOppTitle = array('opportunity_title' => $post['leadGeneraloppTitle']);

			$selectOppId = 'opportunity_id';

			$getOpp = $this->leadOpportunityModel->isExistOpportunityTitle($selectOppId, $whereOppTitle);



			if ($getOpp == 0) {

				$whereOppTitle['created_date'] = date('d-m-Y');

				$addOpp = $this->leadOpportunityModel->insertOpportunityTitle($whereOppTitle);

			}



			if (isset($post['lead_opportunity_id']) && $post['lead_opportunity_id'] !='') {

				$leadId = $post['lead_opportunity_id'];

			}

			$exitUserID = '';

			if (isset($post['getUsrID']) && $post['getUsrID'] !='') {

				$exitUserID = $post['getUsrID'];

			}

			if ($leadId) {

				$whereUser = array('lead_opportunity_id' =>$leadId);

				$exitUserID = $this->leadOpportunityModel->getUSerID($whereUser);

			}



			if (isset($post['user_country']) && $post['user_country'] !='') {

				$getCountry = explode('-', $post['user_country']);

				$user_country = $getCountry[0];

				$userdialing_code = '+'.$getCountry[1];

			}



			if (isset($post['company_country']) && $post['company_country'] !='') {

				$getCountry = explode('-', $post['company_country']);

				$company_country = $getCountry[0];

				$companydialing_code = '+'.$getCountry[1];

			}



			$whererole = array('role_name' =>'Customer');

			$getRole = $this->userModel->getRoleIdLead($whererole);

			$priLeadOppId = $post['priLeadOppIdUsr'];

			$post['weight'] = str_replace('%', '', $post['confidence']);





			if (!$leadId && isset($post['Leadfirst_name']) && $post['Leadfirst_name'] !='') {

				

				// $insertUserArray = array(

				// 	'first_name' => $post['Leadfirst_name'],

				// 	'last_name' => $post['Leadlast_name'],

				// 	'fk_company_id' => $post['Leaduser_comp_id'],

				// 	'designation' => $post['Leaddesignation'],

				// 	'fk_role_id' => $getRole,

				// 	'street_address' => $post['Leadstreet_address'],

				// 	'city' => $post['Leadcity'],

				// 	'state' => $post['Leadstate'],

				// 	'pincode' => $post['Leadpincode'],

				// 	'user_type' => 'customer',

				// 	'active_status' => 'active'

				// );



				date_default_timezone_set('Asia/Kolkata');



				$getcompany_id = isset($post['company_id'])?$post['company_id']:'';



				if (isset($post['Leaduser_comp_id']) && $post['Leaduser_comp_id'] != '' && $getcompany_id == '') {

					$wherePCompany = array('company_name' => $post['Leaduser_comp_id']);

					$checkPCompany = $this->companyMondel->isExistCompany($wherePCompany);



					if (isset($checkPCompany['result'][0]['company_id'])) {

						$getcompany_id = $checkPCompany['result'][0]['company_id'];

					}

				}



				if (isset($post['parent_company_id']) && $post['parent_company_id'] == '') {

					$wherePCompany = array('company_name' => $post['parent_company_name']);

					$checkPCompany = $this->companyMondel->isExistCompany($wherePCompany);



					if (isset($checkPCompany['result'][0]['company_id'])) {

						$post['parent_company_id'] = $checkPCompany['result'][0]['company_id'];

					}

				}



				if (isset($post['fk_industry_id']) && $post['fk_industry_id'] == '') {

					$selectIndustry = 'industry_id';

					$wherePCompany = array('industry_name' => $post['fk_industry_name']);

					$checkPCompany = $this->companyMondel->isExistIndustry($selectIndustry, $wherePCompany);



					if (isset($checkPCompany['result'][0]['industry_id'])) {

						$post['fk_industry_id'] = $checkPCompany['result'][0]['industry_id'];

					}

				}



				$insertArray = array(

					'company_name' => $post['Leaduser_comp_id'],

					'parent_company_id' => $post['parent_company_id'],

					'fk_industry_id' => $post['fk_industry_id'],

					'company_type' => 'Customer Contact',

					'city' => $post['Leadcity'],

					'country' => $company_country,

					'dialing_code' => $companydialing_code,

					'activity_status' => 'active',

					'created_by' => $this->session->userdata('user_id')

				);



				if (isset($post['Leadpincode']) && $post['Leadpincode'] !='') {

	        		$insertArray['zip_code'] = $post['Leadpincode'];

	        	}



	        	if (isset($post['Leadstreet_address']) && $post['Leadstreet_address'] !='') {

	        		$insertArray['street_address'] = $post['Leadstreet_address'];

	        	}



	        	if (isset($post['Leadstreet_address']) && $post['Leadstreet_address'] !='') {

	        		$insertArray['street_address'] = $post['Leadstreet_address'];

	        	}



	        	if (isset($post['company_bussiness_contact']) && $post['company_bussiness_contact'] !='') {

	        		$getCompanyBusinessContact = explode('-', $post['company_bussiness_contact']);

	        		if (isset($getCompanyBusinessContact[1]) && $getCompanyBusinessContact[1] !='') {

	        			$insertArray['bussiness_contact'] = $getCompanyBusinessContact[1];

	        		} else {

	        			$insertArray['bussiness_contact'] = $post['company_bussiness_contact'];

	        		}

	        	}



	    //     	if (isset($post['fk_industry_id']) && $post['fk_industry_id'] !='') {

	        		

					// $insertArray['fk_industry_id'] = $post['fk_industry_id'];

	    //     	}

	        	if (isset($post['company_id']) && $post['company_id'] =='') {

	        		//print_r('hii');exit;

	        		$insertArray['created_date'] = date('d-m-Y h:i A');

					$insertArray['updated_date'] = date('d-m-Y h:i A');

					$insertArray['str_created_date'] = strtotime(date('d-m-Y'));

					$insertArray['str_updated_date'] = strtotime(date('d-m-Y'));

					if (!$leadId) {

						$data['id'] = $this->companyMondel->insertCompany($insertArray);

					}

					$fk_company_id = $data['id'];

					$this->session->set_userdata('setMessage','Added');



	        	} else {

					$fk_company_id = $post['company_id'];

	        		$insertArray['updated_date'] = date('d-m-Y h:i A');

					$insertArray['str_updated_date'] = strtotime(date('d-m-Y'));

					$where = array('company_id' => $post['company_id']);

					$data['id'] = $this->companyMondel->updateCompany($insertArray,$where);

					$this->session->set_userdata('setMessage','Updated');

	        	}



//------------------------Add User---------------------------------------------------------



				$insertUserArray = array(

					'first_name' => $post['Leadfirst_name'],

					'last_name' => $post['Leadlast_name'],

					'fk_role_id' => '181',

					'fk_company_id' => $fk_company_id,

					'user_invited' => 'No',

					'street_address' => $post['street_address'],

					'city' => $post['city'],

					'state' => $post['state'],

					'pincode' => $post['pincode'],

					'country' => $user_country,

					'dialing_code' => $userdialing_code,			

					'user_type' => 'Customer',

					'active_status' => 'active',

					'created_by' => $this->session->userdata('user_id')

				);



				if (isset($post['Leadlast_name']) && $post['Leadlast_name'] !='') {

				    $insertUserArray['last_name'] = $post['Leadlast_name'];

				    $full_name = $post['Leadfirst_name']." ".$post['Leadlast_name'];

				    $insertUserArray['full_name'] = $full_name;

				} else {

					$full_name = $post['Leadfirst_name'];

					$insertUserArray['full_name'] = $full_name;

				}



				$full_name = $post['Leadfirst_name']." ".$post['Leadlast_name'];



				if (isset($post['Leaddesignation']) && $post['Leaddesignation'] !='') {

				    $insertUserArray['designation'] = $post['Leaddesignation'];

				}



				if (isset($post['check']) && in_array('admin', $post['check'])) {

				    $insertUserArray['admin_access'] = 'Yes';

				}



				if (isset($post['fk_department_id']) && is_numeric($post['fk_department_id'])) {

					$insertUserArray['fk_department_id'] = $post['fk_department_id'];

	        	} else {

	        		$insertDepartmentArray = array(

	        			'department_name' => $post['fk_department_id'],

	        		);

	        		$checkDepartment = $this->userModel->isExistDepartment('*', $insertDepartmentArray);

	        		if ($checkDepartment['count'] == 0 && $post['fk_department_id'] != '') {

	        			$departmentId = $this->userModel->addDepartment($insertDepartmentArray);

	        		$insertUserArray['fk_department_id'] = $departmentId;

	        		} else {

	        			if (isset($checkDepartment['result'][0]['department_id'])) {

	        				$insertUserArray['fk_department_id'] = $checkDepartment['result'][0]['department_id'];

	        			}

	        		}

	        		

	        	}



	        	$insertUserArray['created_date'] = date('d-m-Y h:i A');

				$insertUserArray['updated_date'] = date('d-m-Y h:i A');

				$insertUserArray['str_created_date'] = strtotime(date('d-m-Y'));

				$insertUserArray['str_updated_date'] = strtotime(date('d-m-Y'));



				if (!$leadId) {

					$data['user_id'] = $this->userModel->insertUser($insertUserArray);

				}





				$insertUserContactArray = array(

					'fk_user_id' => $data['user_id'],

					'contact_info' => $post['pemail'],

					'contact_type' => 'Email',

					'created_date' => date('d-m-Y h:i A'),

					'updated_date' => date('d-m-Y h:i A')

				);

				$data['user_contact_id'] = $this->userModel->insertUserConatct($insertUserContactArray);

				$insertUserContactArray = array(

					'fk_user_id' => $data['user_id'],

					'contact_info' => $post['pphone'],

					'contact_type' => 'Phone',

					'created_date' => date('d-m-Y h:i A'),

					'updated_date' => date('d-m-Y h:i A')

				);

				$data['user_contact_id'] = $this->userModel->insertUserConatct($insertUserContactArray);

			}



			// if (!$post['getUsrID']) {

			// 		if (isset($post['useInfo']) && $post['useInfo'] != 'thirdoption') {

			// 			$exitUserID = $this->userModel->insertUser($insertUserArray);

			// 		}

					

			//         $ContactInfo = $post['contact_detail'];

			// 		$ContactType = $post['contact_type'];

			// 		$c = array_combine($ContactInfo, $ContactType);

			//         foreach($c as $a => $val){

			//             $dataContact['fk_user_id'] = $exitUserID;

			//             $dataContact['contact_info'] = $a;

			//             $dataContact['contact_type'] = $val;

			//             $where = array('contact_info' => $a);

			//             $this->userModel->insertUserConatctfromLead($dataContact, $exitUserID, $where);

			//         }

			// 	} else {

			// 		$where = array('user_id' => $exitUserID);

			// 		if (isset($post['Leadfirst_name']) && $post['Leadfirst_name'] !='') {

			// 			$updateUser = $this->userModel->updateUser($insertUserArray,$where);

			// 			$i = '0'; 

			// 			$ContactInfo = $post['contact_detail'];

			// 			$ContactType = $post['contact_type'];

			// 			$userContactId = $post['userConactId'];

			// 			// print_r(expression)

			// 			$length = count($userContactId);

			// 			for ($i = 0; $i < $length;) { 

			// 				  if ($userContactId[$i] == "") { 

			// 					  	$dataContactNew['fk_user_id'] = $exitUserID;

			// 			            $dataContactNew['contact_info'] = $ContactInfo[$i];

			// 			            $dataContactNew['contact_type'] = $ContactType[$i];

			// 			            $where = array('contact_info' => $ContactInfo[$i]);

			// 			            $this->userModel->insertUserConatctfromLead($dataContactNew, $exitUserID, $where);

			// 				  } 

			// 	            	$datawhere['user_contact_id'] = $userContactId[$i];

			// 	            	$UpdateUSerContactArray = array(

			// 						'contact_info' => $ContactInfo[$i],

			// 						'contact_type' => $ContactType[$i]

			// 					);

			// 				  	$i++;

			// 				 	$this->userModel->updateUserConatct($UpdateUSerContactArray,$datawhere);

			// 				 	$this->session->set_userdata('setMessage','Updated');

			// 				}

			// 		}

			// 	}

				if( isset($post['follow_up_date'])){

					//$projectDate = date("d-m-Y", strtotime($post['follow_up_date']));

					$projectDate = $post['follow_up_date'];

				} else {

					 $projectDate = "";

				}

				date_default_timezone_set('Asia/Calcutta');

				// Then call the date functions

                $leadTags = '';

				if (isset($post['leadGeneralTags'])) {

					$leadTags = implode(',', $post['leadGeneralTags']);

				}

				date_default_timezone_set('Asia/Kolkata');

				$Update_date = date('Y-m-d H:i:s');



				$inserLeadOpportunity= array(

					'opportunity_title' => $post['leadGeneraloppTitle'],

					//'street_address' => $post['leadGeneralStreet'],

					//'city' => $post['leadGeneralCity'],

					//'state' => $post['leadGeneralState'],

					//'country' => $post['leadGeneralcountry'],leadGeneralJobType

					//'zip' => $post['leadGeneralZip'],

					'Confidence' =>  $post['weight'],

					'projected_sales_date' => $projectDate,

					'str_projected_sales_date' => strtotime($projectDate),

					'fk_sales_people_id' => $post['leadGeneralSalesPeople'],				

					'source' => $post['leadGeneralSourceName'],

					'status' => $post['leadGeneralStatus'],				

					'activity_status' => 'active'

					//'notes' => $post['leadNotes']

				);

				// print_r($inserLeadOpportunity); die;



				if (isset($post['leadGeneralJobType']) && $post['leadGeneralJobType'] !='') {

	        		if (is_numeric($post['leadGeneralJobType'])) {

					$inserLeadOpportunity['job_type_id'] = $post['leadGeneralJobType'];

		        	} else {

		        		$insertDivisionArray = array(

		        			'job_name' => $post['leadGeneralJobType'],

		        		);



		        		$checkDivision = $this->leadOpportunityModel->isExistJobType('*', $insertDivisionArray);

		        		if ($checkDivision['count'] == 0 && $post['leadGeneralJobType'] != '') {

		        			$divisionId = $this->leadOpportunityModel->addJobType($insertDivisionArray);

		        			$inserLeadOpportunity['job_type_id'] = $divisionId;

		        		} else {

		        			$inserLeadOpportunity['job_type_id'] = $checkDivision['result'][0]['job_type_id'];

		        		}

		        	}

	        	}



	        	if (isset($post['leadGeneralSourceName'])) {

	        		if (is_numeric($post['leadGeneralSourceName'])) {

					$inserLeadOpportunity['source'] = $post['leadGeneralSourceName'];

		        	} else {

		        		$insertDivisionArray = array(

		        			'source_name' => $post['leadGeneralSourceName'],

		        		);



		        		$checkDivision = $this->leadOpportunityModel->isExistSource('*', $insertDivisionArray);

		        		// print_r($checkDivision);exit;

		        		if ($checkDivision['count'] == 0) {

		        			$divisionId = $this->leadOpportunityModel->addSource($insertDivisionArray);

		        			$inserLeadOpportunity['source'] = $post['leadGeneralSourceName'];

		        		} else {

		        			$inserLeadOpportunity['source'] = $checkDivision['result'][0]['source_name'];

		        		}

		        	}

	        	}



			if(!$leadId ) {

				if (isset($data['user_id'])) {

					$inserLeadOpportunity['fk_user_id'] = $data['user_id'];

				} else {

					$inserLeadOpportunity['fk_user_id'] = $post['getUsrID'];

				}

				



				$inserLeadOpportunity['created_by'] = $this->session->userdata('user_id');

				$inserLeadOpportunity['created_date'] = date('d-m-Y h:i A');

				$inserLeadOpportunity['updated_date'] = date('d-m-Y h:i A');

				$inserLeadOpportunity['str_created_date'] = strtotime(date('d-m-Y'));

				$inserLeadOpportunity['str_updated_date'] = strtotime(date('d-m-Y'));



				// print_r($inserLeadOpportunity); die;



				$data['lead_id'] = $this->leadOpportunityModel->insertOpportunity($inserLeadOpportunity);

				$this->session->set_userdata('setMessage','Added');



				$whereNotificationID = array('fk_notification_id' => '7');

				$addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);

				$userIDs = json_decode($addLeadNotification['result'][0]['user_id']);

	        	$getEmailList = $this->userModel->getUserEmail('*',$userIDs);

	        	foreach ($getEmailList as $key => $value) {

		        	$emailList[] = $value['contact_info'];

		        }

				if ($addLeadNotification['count'] == 1) {

			        $emailString = implode(',', $emailList);

		        	$subject = 'Lead Added Successfully';

		        	$module = 'Lead';

		        	$name = $post['leadGeneraloppTitle'];

		        	$action = 'added';

		        	$actionBy = $this->session->userdata('user_name');

		        	//$UserNotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);

		        }

			}else {

				$inserLeadOpportunity['updated_date'] = date('d-m-Y h:i A');

				$inserLeadOpportunity['str_updated_date'] = strtotime(date('d-m-Y'));

				$where = array('lead_opportunity_id' => $leadId);

				$data['id'] = $this->leadOpportunityModel->updateLead($inserLeadOpportunity,$where);

				$data['lead_id'] = $leadId;

				$this->session->set_userdata('setMessage','Updated');



				$whereNotificationID = array('fk_notification_id' => '8');

				$editLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);

				$userIDs = json_decode($editLeadNotification['result'][0]['user_id']);

	        	$getEmailList = $this->userModel->getUserEmail('*',$userIDs);

	        	foreach ($getEmailList as $key => $value) {

		        	$emailList[] = $value['contact_info'];

		        }

				if ($editLeadNotification['count'] == 1) {

			        $emailString = implode(',', $emailList);

		        	$subject = 'Lead Updated Successfully';

		        	$module = 'Lead';

		        	$name = $post['leadGeneraloppTitle'];

		        	$action = 'updated';

		        	$actionBy = $this->session->userdata('user_name');

		        	//$UserNotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);

		        }			

			}



//---------------------------Lead Activity------------------------------------------



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

				'fk_lead_opportunity_id' => $data['lead_id'],

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



			// $sub='';

			// $select='GROUP_CONCAT(contact_info) as contact_info';

			// $where=array("contact_type" => "Email","fk_user_id" =>  $data['lead_id']);

			// $to=$_POST['to'];

			// if (isset($post['activity_title'])) {

			// 	$sub=$post['activity_title'];

			// }

			// $msg=$post['description'];

			// $from='';



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



			$insertActivityArray['created_date'] = date('d-m-Y h:i A');

			$insertActivityArray['updated_date'] = date('d-m-Y h:i A');

			$insertActivityArray['str_created_date'] = strtotime(date('d-m-Y'));

			$insertActivityArray['str_updated_date'] = strtotime(date('d-m-Y'));



			//print_r($insertActivityArray);exit;

			if (!$leadId) {

				$data['id'] = $this->leadActivityModel->insertActivity($insertActivityArray);				

				$this->session->set_userdata('setMessage','Added');

			}



			$whereNotificationID = array('fk_notification_id' => '11');

			$addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);

			if(!empty($addLeadNotification['result'])) {

				$userIDs = json_decode($addLeadNotification['result'][0]['user_id']);

				$getEmailList = $this->userModel->getUserEmail('*',$userIDs);

	        	foreach ($getEmailList as $key => $value) {

		        	$emailList[] = $value['contact_info'];

		        } 

			}

	        $where = array('lead_opportunity_id' => $data['lead_id']);

        	$getUserdetails = $this->leadOpportunityModel->getLeadDetails($where);

			if ($addLeadNotification['count'] == 1) {

		        $emailString = implode(',', $emailList);

	        	$subject = 'Activity Added Successfully';

	        	$module = 'Activity against';

	        	$name = $getUserdetails['result'][0]['opportunity_title'];

	        	$action = 'added';

	        	$actionBy = $this->session->userdata('user_name');

	        	//$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);

	        }



//-------------------------------Lead Activity End--------------------------------------------------------------------



			$response['code'] = 200;

			$response['message'] = 'Opportunity created successfully';

			$response['data'] = $data['id'];

			if ($leadId) {

				$response['lead_id'] = $leadId;

			} else {

				$response['lead_id'] = $data['id'];

			}

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

				$Permission = $this->permission->checkUserPermission(19);

			} else {

				$Permission = $this->permission->checkUserPermission(18);

			}

			if ($Permission) {

				$select = 'opportunity_title,lead_opportunity_id';

				$where = [];

				$data['parentCompany'] = $this->leadOpportunityModel->getLead($select,$where);

				// print_r($data['parentCompany']); die;



				$select = 'opportunity_id,opportunity_title';

				$where = array('active_status' => 'active');

				$data['opportunity_master'] = $this->leadOpportunityModel->getOpportunityMaster($select,$where);



				$selectCompany = 'company_id,company_name';

				$whereCompany= array('company_type' => 'Customer Contact');

				$data['company'] = $this->leadOpportunityModel->getCompany($selectCompany,$whereCompany);

//----------------------------User & Company-------------------------------------------

				$companyType = $userType;

				$select = 'c1.company_name,c1.company_id';

				$where = array('c1.company_type' => 'Customer Contact', 'c1.activity_status' => 'active', 'c1.parent_company_id' => '0');

				$data['parentCompany'] = $this->companyMondel->getCompany($select,$where);



				$selectDepartment = 'department_name';

				$whereDepartment = array('active_status' => 'active');

				$data['departmentNames'] = $this->userModel->getDepartment($selectDepartment,$whereDepartment);



				$selectIndustry = 'industry_name';

				$whereIndustry = array('active_status' => 'active');

				$data['industryNames'] = $this->companyMondel->getIndustry($selectIndustry,$whereIndustry);

//----------------------User & Company End--------------------------------------------------

//-------------------------Lead Activity---------------------------------------------------

				$selectCountry = '*';

				$whereCountry= array();

				$data['activityType'] = $this->leadActivityModel->getActivityType($selectCountry,$whereCountry);



				$whereAcStatus = array('activity_type' => 'Phone Call');

				$data['phone_activity_status'] = $this->leadActivityModel->getActivityStatus('*', $whereAcStatus);



				$selectSalesPerson = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) as name";

				$whereSalesPerson = array('Manager', 'Sales Executive', 'Sales Person', 'Administrator');

				//$whereSalesPerson = array('r.role_name' => 'Sales Person', 'r.role_name' => 'Sales Person');

				$data['salesPerson'] = $this->leadActivityModel->getSalesPersonsAndAdmins($selectSalesPerson,$whereSalesPerson);



//----------------------Lead Activity End--------------------------------------------------



				$selectSource = 'source_id,source_name';

				$whereSource= array();

				$data['source'] = $this->leadOpportunityModel->getSource($selectSource,$whereSource);



				$selectJobType = 'job_type_id,job_name';

				$whereJobType= array();

				$data['jobType'] = $this->leadOpportunityModel->getJobType($selectJobType,$whereJobType);



				$selectTag = 'tag_id,tag_name';

				$whereTag= array();

				$data['tags'] = $this->leadOpportunityModel->getTags($selectTag,$whereTag);



				$selectCountry = 'id,nicename,phonecode';

				$whereCountry= array();

				$data['country'] = $this->leadOpportunityModel->getCountry($selectCountry,$whereCountry);



				$selectSalesPerson = "u1.user_id as sales_people_id, CONCAT(u1.first_name, ' ', u1.last_name) as name";

				//$whereSalesPerson = array('r.role_name' => 'Sales Person');

				$whereSalesPerson = array('Manager', 'Sales Executive', 'Sales Person', 'Administrator');

				$data['salesPerson'] = $this->leadOpportunityModel->getSalesPersonsAndAdmins($selectSalesPerson, $whereSalesPerson);



				$selectExisting = '*';

				// $whereExisting = 'user_type = Customer';

				$whereExisting = array('u.user_type' => 'Customer','u.active_status' => 'active');

				// echo $whereExisting; die;

				$existingList = $this->leadOpportunityModel->getExistingPerson($selectExisting,$whereExisting);



				foreach ($existingList as $key => $value) {

					$userInfo = explode(",", $value['user_info']);

					$existingList[$key]['phone'] = '---';

					$existingList[$key]['email'] = '---';

					foreach ($userInfo as $userkey => $uservalue) {

						$userData = explode('_', $uservalue);

						if (!empty($userData)) {

							if(@$userData[1] == 'Phone'){

								$existingList[$key]['phone'] = $userData[0];

							} else if (@$userData[1] == 'Email'){

								$existingList[$key]['email'] = $userData[0];

							}

						}

					}

				}

				$data['existingUser'] = $existingList;

				$data['formheading'] = "Add Opportunity";

				if($id) { 

					$select = 'lo.*,u.*,uc.*';

					$where = 'lead_opportunity_id = "'.$id.'"'; 

					$data['value'] = $this->leadOpportunityModel->getLead($select,$where);







					if(is_array($data['value'])) {

						$data['value'] = $data['value'][0];



					}

					$selectConatactType = 'uc.user_contact_id,uc.fk_user_id,contact_info,contact_type';

					$whereConactInfo = array('lo.lead_opportunity_id' => $id);

					$datactLict = $this->leadOpportunityModel->getUserContact($selectConatactType,$whereConactInfo);

					// foreach ($datactLict as $key => $value) {

					// 		if($value['contact_type'] == 'Phone'){

					// 			$datactLict[$key]['phone'] = $userData[0]; 

					// 		}else if ($uservalue == 'Email'){

					// 			$datactLict[$key]['email'] = $userData[0];

					// 		} 

						

					// }

					 

					$data['Contact'] = $datactLict;

					// print_r($datactLict); die;

					$data['formheading'] = "Edit Opportunity";

				}



				//Permissions

				$data['addUser'] = $this->permission->checkUserPermission(10);

				$data['showActivity'] = $this->permission->checkUserPermission(22);

				$data['addActivity'] = $this->permission->checkUserPermission(23);

				$data['showProposal'] = $this->permission->checkUserPermission(31);

				$data['addProposal'] = $this->permission->checkUserPermission(32);



				$data['userId'] = $id;

				$html = $this->page->getPage('leadOpportunityForm',$data,true);

				

				$response['code'] = 200;

				$response['message'] = 'form generated';

				$response['data']['html'] = $html;

				$response['data']['heading'] = $data['formheading'];

				$response['data']['editor'] = ['leadNotes'];

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



	public function displayUpdateForm($updateType = null,$id = null) {



		try {



			if ($id) {

				$Permission = $this->permission->checkUserPermission(19);

			} else {

				$Permission = $this->permission->checkUserPermission(18);

			}

			if ($Permission) {

				if ($updateType == 'userdata') {

			

					$select = 'nicename,phonecode';

					$data['country'] = $this->companyMondel->getCountry($select);



					$selectModule = 'm.*, GROUP_CONCAT(title) as permission';

					$whereModule = array('m.module_type' => 'permissions');

					$data['modulePermissions'] = $this->userModel->getModulePermissions($selectModule, $whereModule);

					//print_r($data['module']);exit;



					$selectRole = 'role_id,role_name,role_description';

					$whereRole= array('Customer', 'Suppliers');

					$data['roles'] = $this->userModel->getRole($selectRole,$whereRole);



					$userType2 = 'Customer Contact';



					$selectDepartment = 'department_name';

					$whereDepartment = array('active_status' => 'active');

					$data['departmentNames'] = $this->userModel->getDepartment($selectDepartment,$whereDepartment);



					$selectCompany = 'company_id,company_name';

					$whereCompany= array('company_type' => $userType2, 'activity_status' => 'active');

					$data['company'] = $this->userModel->getCompany($selectCompany,$whereCompany);



					$select = 'c1.company_name,c1.company_id';

					$where = array('c1.company_type' => $userType2, 'c1.activity_status' => 'active', 'c1.parent_company_id' => '0');

					$data['parentCompany'] = $this->companyMondel->getCompany($select,$where);



					$selectIndustry = 'industry_name';

					$whereIndustry = array('active_status' => 'active');

					$data['industryNames'] = $this->companyMondel->getIndustry($selectIndustry,$whereIndustry);



					$data['userType'] = 'customer';

					// print_r($data['Roles']); die;

					$data['value'] = array();



					if($id) {

						$select = 'u.*,d.department_name as department_name,c1.company_id,c1.company_name,c1.parent_company_id,c1.bussiness_contact,c1.street_address as companyAddress,c1.city as companycity,c1.state as companystate,c1.country as companycountry,c1.dialing_code,c1.zip_code as companyzip,c1.fax, c2.company_name as parentCompany, c2.company_id as parentCompanyId, i.industry_name as industry_name,i.industry_id as industry_id';

						$where = 'user_id = "'.$id.'"';

						$data['value'] = $this->userModel->getUserUpdate($select,$where);

						if(is_array($data['value'])) {

							$data['value'] = $data['value'][0];



						}

						$selectConatactType = '*';

						// $whereConactInfo = 'fk_user_id = "'.$id.'"';

						$whereConactInfo= array('uc.fk_user_id' => $id, 'u.active_status' => 'active');

						$data['Contact'] = $this->userModel->getUserContact($selectConatactType,$whereConactInfo);



						$selectPreferences = '*';

						$wherePreferences= array('fk_user_id' => $id);

						$data['preferences'] = $this->userModel->getUserPreferences($selectPreferences,$wherePreferences);



					}



					$data['userId'] = $id;

					$data['formheading'] = 'Update User';

					$html = $this->page->getPage('leadUsersForm',$data,true);

				}

				

				$response['code'] = 200;

				$response['message'] = 'form generated';

				$response['data']['html'] = $html;

				$response['data']['heading'] = $data['formheading'];

				$response['data']['editor'] = ['leadNotes'];

			} else {

				$data['formheading'] = 'No Permissions Access';

				$response['code'] = 404;

				$response['message'] = 'PAGE NOT FOUND';

				$response['data']['html'] = null;

				$response['data']['heading'] = $data['formheading'];

			}

			

		} catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}	

		

		echo json_encode($response);

		exit;

	} // end : displayForm Action



	/* displayForm action of User controller

	* @author Bimal Sharma

	* @param $userType String user type (internal,supplier,customer)

	*/

	public function displayUser($id = null) {

		// echo $userType; die;

		// echo "displayForm for update"; die;

		// echo $id; die;

		try {



			$whereUser = array('lo.lead_opportunity_id' => $id);

			$data['users'] = $this->leadOpportunityModel->getUserInfo($whereUser);



			$data['formheading'] = "User Details";



			$data['userId'] = $id;

			$html = $this->page->getPage('leadOpportunityUserDetails',$data,true);

			

			$response['code'] = 200;

			$response['message'] = 'form generated';

			$response['data']['html'] = $html;

			$response['data']['heading'] = $data['formheading'];

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
	public function permDeleteOpportunity() { 
        $DeleteId = $this->input->post();
        $newUsrId = explode(',', $DeleteId['deleteThis']);
        // $deleteUpdateData = array('activity_status' => 'inactive');
		$DeletedUser = $this->leadOpportunityModel->permDeleteOpportunies($newUsrId);
		// $newUsrId = explode(',', $DeleteId['deleteThis']);
        // $deleteUpdateData = array('activity_status' => 'inactive');
		$DeletedActivityUser = $this->leadOpportunityModel->permDeleteOppoActivities($newUsrId);
        
        if ($DeletedActivityUser) {
            $this->session->set_userdata('setMessage','deleted');
            // $whereNotificationID = array('fk_notification_id' => '9');
			// $deleteLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);
			// $userIDs = json_decode($deleteLeadNotification['result'][0]['user_id']);
        	// $getEmailList = $this->userModel->getUserEmail('*',$userIDs);
        	// foreach ($getEmailList as $key => $value) {
	        // 	$emailList[] = $value['contact_info'];
	        // }

	        // foreach ($newUsrId as $userKey => $userValue) {
            // 	$where = array('lead_opportunity_id' => $userValue);
            // 	$getUserdetails = $this->leadOpportunityModel->getLeadDetails($where);
            // 	/*if ($deleteLeadNotification['count'] == 1) {
			//         $emailString = implode(',', $emailList);
		    //     	$subject = 'Lead Deleted Successfully';
		    //     	$module = 'Lead';
		    //     	$name = $getUserdetails['result'][0]['opportunity_title'];
		    //     	$action = 'deleted';
		    //     	$actionBy = $this->session->userdata('user_name');
		    //     	// $UserNotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
		    //     }*/
            // }
            return true;
        } else {
            return False;
        }
    }
	public function getLead() {		

		$request = $this->input->get();

		//print_r($request);exit;

		$offset = $request['start'];

		$limit = $request['length']; 

			// echo $userType; die;

// print_r($request); die;

		$columnArray = $request['columns'];

		$feilds = $columns = array_column($columnArray,'data');

		$feilds = $this->leadOpportunity->getSelectField($columns); 

		$whereFeilds = $this->leadOpportunity->getWhereField($columns); 



		$where = 'lo.job_status = "not_converted" and lo.activity_status = "active"';

		

		if(!empty($request['search']['value'])) {

			foreach ($whereFeilds as $key => $value) {

				$where.= ' and '.$value." Like '%".$request['search']['value']."%'";

			}

		}



		// add filters

		if(!empty($request['q'])) {

			date_default_timezone_set('Asia/Kolkata');

	        if (date('D')!='Mon')

	        {    

	         //take the last monday

	          $staticstart = date('d-m-Y',strtotime('last Sunday'));    



	        } else {

	            $staticstart = date('d-m-Y');   

	        }

	        //always next saturday

	        if (date('D')!='Sat')

	        {

	            $staticfinish = date('d-m-Y',strtotime('next Saturday'));

	        } else {



	            $staticfinish = date('d-m-Y');

	        }

			$query = json_decode($request['q'],true);

			//print_r($query);exit;

			if (isset($query['contact_info']) && $query['contact_info'] != '') {

				$query['contact_info2'] = $query['contact_info'];

			}

			if($query) {

				$filter = $this->leadOpportunity->getWhereField(array_keys($query));

				 // print_r($filter);exit;

				foreach ($filter as $key => $value) {

					if ($query[$key] !='') {

						if ($value == 'u.last_name') {

							$where.= ' or '.$value." like '%".$query[$key]."%'";

						} else if ($key == 'age') {

							if ($query[$key] == 'yesterday') {

				                $datetime = new DateTime('yesterday');

				                $tomorrow = $datetime->format('d-m-Y');

				                $where.=' and lo.str_created_date = '.strtotime($tomorrow);

				            } else if ($query[$key] == 'this_week') {

				                $where.= ' and lo.str_created_date >= '.strtotime($staticstart).' and lo.str_created_date <= '.strtotime($staticfinish);

				            } else if ($query[$key] == 'this_month') {

				                $first_day_this_month = strtotime(date('01-m-Y'));

				                $last_day_this_month  = strtotime(date('t-m-Y'));

				                $where.= ' and lo.str_created_date >= '.$first_day_this_month.' and lo.str_created_date <= '.$last_day_this_month;

				            } else if ($query[$key] == 'today') {

				                $where.=' and lo.str_created_date = '.strtotime(date('d-m-Y'));

				            }



						}  else if ($key == 'projected_sales_date') {

							if ($query[$key] == 'yesterday') {

				                $datetime = new DateTime('yesterday');

				                $tomorrow = $datetime->format('d-m-Y');

				                $where.=' and lo.str_projected_sales_date = '.strtotime($tomorrow);

				            } else if ($query[$key] == 'this_week') {

				                $where.= ' and lo.str_projected_sales_date >= '.strtotime($staticstart).' and lo.str_projected_sales_date <= '.strtotime($staticfinish);

				            } else if ($query[$key] == 'this_month') {

				                $first_day_this_month = strtotime(date('01-m-Y'));

				                $last_day_this_month  = strtotime(date('t-m-Y'));

				                $where.= ' and lo.str_projected_sales_date >= '.$first_day_this_month.' and lo.str_projected_sales_date <= '.$last_day_this_month;

				            } else if ($query[$key] == 'today') {

				                $where.=' and lo.str_projected_sales_date = '.strtotime(date('d-m-Y'));

				            }



						} else {

							$where.= ' and '.$value." like '%".$query[$key]."%'";

						}

					}

				} 

			}

			

		}

// print_r($where);exit;

		$order = null;

		$order = 'lo.lead_opportunity_id DESC';

		if(isset($request['order']) && is_array($request['order'])) {

			$order = $columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'];

		}

		array_push($feilds, "CONCAT(u.first_name,' ',u.last_name) as username");

		array_push($feilds, "CONCAT(u2.first_name,' ',u2.last_name) as username2, activity_type");

		array_push($feilds, "CONCAT(u3.first_name,' ',u3.last_name) as username3");

		array_push($feilds, 'c.company_name');

		array_push($feilds, 'u.user_id as userId');

		array_push($feilds, 'lo.projected_sales_date');



		$wherepermissions = $this->permission->checkUserPermission(21);

		if ($wherepermissions) {

			$whereUserId = array('fk_user_id' => $this->session->userdata('user_id'));

			$selectPermission = '*';

			$userPermissionList = $this->leadActivityModel->getWhoseDataCanView($selectPermission, $whereUserId);

			if (isset($userPermissionList[0]['can_view_opportunity']) && $userPermissionList[0]['can_view_opportunity']!='') {

				$userArray = json_decode($userPermissionList[0]['can_view_opportunity']);

				array_push($userArray, $this->session->userdata('user_id'));

				$users = implode(',', $userArray);

				//print_r($userPermissionList[0]['can_view_activity']);exit;

				$where.= ' and lo.fk_sales_people_id IN( '.$users.')';

			}



			//$where.= ' and lo.fk_sales_people_id = '.$this->session->userdata('user_id');

		} else {

			$where.= ' and lo.fk_sales_people_id IN( '.$this->session->userdata('user_id').')';

		}

		

//------------------------------Section For Dashboard Redirect For Data--------------------------------------------//

		if(!empty($request['q'])) {

			$query = json_decode($request['q'],true);



			date_default_timezone_set('Asia/Kolkata');

	        if (date('D')!='Mon')

	        {    

	         //take the last monday

	          $staticstart = date('d-m-Y',strtotime('last Sunday'));    



	        } else {

	            $staticstart = date('d-m-Y');   

	        }

	        //always next saturday

	        if (date('D')!='Sat')

	        {

	            $staticfinish = date('d-m-Y',strtotime('next Saturday'));

	        } else {



	            $staticfinish = date('d-m-Y');

	        }



			if (isset($query[0]) && $query[0] == 'dashboard') {

				$leadUser = $query[1];

				$leadTime = $query[2];



		        if ($leadTime == 'yesterday') {

	                $datetime = new DateTime('yesterday');

	                $tomorrow = $datetime->format('d-m-Y');

	                //$where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.created_by' => $leadUser,'lo.str_created_date' => strtotime($tomorrow));

	                $where.=' and lo.str_created_date = '.strtotime($tomorrow).' and lo.created_by='.$leadUser;

	            } else if ($leadTime == 'this_week') {

	                //$where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.created_by' => $leadUser, 'lo.str_created_date >=' => strtotime($staticstart), 'lo.str_created_date <=' => strtotime($staticfinish));

	                $where.= ' and lo.str_created_date >= '.strtotime($staticstart).' and lo.str_projected_sales_date <= '.strtotime($staticfinish).' and lo.created_by='.$leadUser;

	            } else if ($leadTime == 'this_month') {

	                $first_day_this_month = strtotime(date('01-m-Y'));

	                $last_day_this_month  = strtotime(date('t-m-Y'));

	                //$where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.created_by' => $leadUser, 'lo.str_created_date >=' => $first_day_this_month, 'lo.str_created_date <=' => $last_day_this_month);



	                $where.= ' and lo.str_created_date >= '.$first_day_this_month.' and lo.str_created_date <= '.$last_day_this_month.' and lo.created_by='.$leadUser;

	            } else if ($leadTime == 'today') {

	                // $where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.created_by' => $leadUser, 'lo.str_created_date' => strtotime(date('d-m-Y')));

	                $where.=' and lo.str_created_date = '.strtotime(date('d-m-Y')).' and lo.created_by='.$leadUser;

	            } else {

	                //$where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.created_by' => $leadUser);

	                $where.=' and lo.created_by='.$leadUser;

	            }

			}



			// if(isset($query['age'])) {

			// 	if ($query['age'] == 'today') {

			// 		$where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_created_date' => strtotime(date('d-m-Y')));

			// 	}

			// 	if ($query['age'] == 'yesterday') {

			// 		$datetime = new DateTime('yesterday');

	  //               $tomorrow = $datetime->format('d-m-Y');

	  //               $where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_created_date' => strtotime($tomorrow));

			// 	}

			// 	if ($query['age'] == 'this_week') {

			// 		$where.= array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_created_date >=' => strtotime($staticstart), 'lo.str_created_date <=' => strtotime($staticfinish));

			// 	}

			// 	if ($query['age'] == 'this_month') {

			// 		$first_day_this_month = strtotime(date('01-m-Y'));

	  //               $last_day_this_month  = strtotime(date('t-m-Y'));

	  //               $where = array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_created_date >=' => $first_day_this_month, 'lo.str_created_date <=' => $last_day_this_month);

			// 	}

			// }



			// if(isset($query['projected_sales_date'])) {

			// 	if ($query['projected_sales_date'] == 'today') {

			// 		$where = array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_projected_sales_date' => strtotime(date('d-m-Y')));

			// 	}

			// 	if ($query['projected_sales_date'] == 'tomorrow') {

			// 		$datetime = new DateTime('tomorrow');

	  //               $tomorrow = $datetime->format('d-m-Y');

	  //               $where = array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_projected_sales_date' => strtotime($tomorrow));

			// 	}

			// 	if ($query['projected_sales_date'] == 'this_week') {

			// 		$where = array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_projected_sales_date >=' => strtotime($staticstart), 'lo.str_projected_sales_date <=' => strtotime($staticfinish));

			// 	}

			// 	if ($query['projected_sales_date'] == 'this_month') {

			// 		$first_day_this_month = strtotime(date('01-m-Y'));

	  //               $last_day_this_month  = strtotime(date('t-m-Y'));

	  //               $where = array('lo.job_status' => 'not_converted', 'lo.activity_status ' => 'active', 'lo.str_projected_sales_date >=' => $first_day_this_month, 'lo.str_projected_sales_date <=' => $last_day_this_month);

			// 	}

			// }

		}

		//print_r($where);exit;

//------------------------------End Section For Dashboard Redirect For Data--------------------------------------------//

		//print_r($feilds);exit;

		$opportunityDataList = $this->leadOpportunityModel->getLead($feilds,$where,$order,$limit,$offset);

		foreach ($opportunityDataList as $key => $value) {

			if (isset($opportunityDataList[$key]['created_date'])) {

				$leadOppCreatedDate = $opportunityDataList[$key]['created_date'];

				$opp_date = date("d-M-Y h:m A", strtotime($leadOppCreatedDate));

				$opportunityDataList[$key]['created_date'] = $opp_date;



				if($opportunityDataList[$key]['created_date'] ==""){

					$opportunityDataList[$key]['created_date']= "---";

					//$opportunityDataList[$key]['age'] = "---";

				}

			}



			if (isset($opportunityDataList[$key]['projected_sales_date'])) {

				$projected_sales_date = $opportunityDataList[$key]['projected_sales_date'];

				$projected_sales_date_new = date("d-M-Y h:m A", strtotime($projected_sales_date));

				$opportunityDataList[$key]['projected_sales_date'] = $projected_sales_date_new;



				if($opportunityDataList[$key]['projected_sales_date'] ==""){

					$opportunityDataList[$key]['projected_sales_date']= "---";

					//$opportunityDataList[$key]['age'] = "---";

				}

			}



			if (isset($opportunityDataList[$key]['activity_date'])) {

				$leadOppActivityDate = $opportunityDataList[$key]['activity_date'];

			}



			$username2 = $opportunityDataList[$key]['username2'];

			$activity_type = $opportunityDataList[$key]['activity_type'];

			

			

			if (isset($leadOppActivityDate) && $leadOppActivityDate !='') {

				$activity_date = date("d-M-Y h:m A", strtotime($leadOppActivityDate));

				$opportunityDataList[$key]['activity_date'] = $activity_date." By ".$username2.'('.$activity_type.')';



				if($opportunityDataList[$key]['activity_date'] ==""){

					$opportunityDataList[$key]['activity_date']= "Not Contacted Yet";

					//$opportunityDataList[$key]['age'] = "---";

				} else  {

					$leadactiDate = $opportunityDataList[$key]['created_date'];			

					$actvity_up_date = date("d-M-Y h:m A", strtotime($leadactiDate));

					$opportunityDataList[$key]['created_date'] = $actvity_up_date;

				}

			} else {

				$opportunityDataList[$key]['activity_date']= "Not Contacted Yet";

			}

			

			if (isset($opportunityDataList[$key]['created_date'])) {

				$age = $opportunityDataList[$key]['created_date'];



				$date1 = strtotime(date('d-m-Y', strtotime($opportunityDataList[$key]['created_date'])));  

				$date2 = strtotime(date('d-m-Y'));  

				  

				// Formulate the Difference between two dates 

				$diff = abs($date2 - $date1);  



				$years = floor($diff / (365*60*60*24));

				

				$months = floor(($diff - $years * 365*60*60*24) 

				                             / (30*60*60*24));  

				

				$days = floor(($diff - $years * 365*60*60*24 -  

				             $months*30*60*60*24)/ (60*60*24));



				// $age = '---';

	

				if ($years == 0) {

					if ($months == 0) {

						if ($days == 1) {

							$age = $days.' Day';

						} else {

							$age = $days.' Days';

						}

					} else {

						if ($months == 1) {

						$age = $months.' Month';

						} else {

							$age = $months.' Months';

						}

					}

				} else {

					if ($years == 1) {

						$age = $years.' Year';

					} else {

						$age = $years.' Years';

					}

				}



				$opportunityDataList[$key]['age'] = $age;



				// $ageWeek = round($diff/7);

				// if ($ageWeek < 1) {

				// 	if ($opportunityDataList[$key]['age'] != '') {

				// 		if ($age == 1) {

				// 			$opportunityDataList[$key]['age'] = $age.' Day';

				// 		} else {

				// 			$opportunityDataList[$key]['age'] = $age.' Days';

				// 		}

				// 	} else {

				// 		$opportunityDataList[$key]['age'] = '--';

				// 	}

				// }

				// else if ($ageWeek >= 1 && $ageWeek <= 4) {

				// 	if ($ageWeek == 1) {

				// 		$opportunityDataList[$key]['age'] = $ageWeek.' Week';

				// 	} else {

				// 		$opportunityDataList[$key]['age'] = $ageWeek.' Weeks';

				// 	}

				// } else {

				// 	$ageMonth = round($ageWeek/4);

				// 	if ($ageMonth >= 1 && $ageMonth <= 12) {

				// 		if ($ageMonth == 1) {

				// 		$opportunityDataList[$key]['age'] = $ageMonth.' Month';

				// 		} else {

				// 			$opportunityDataList[$key]['age'] = $ageMonth.' Months';

				// 		}

				// 	} else {

				// 		$ageYear = round($ageMonth/12);

				// 		if ($ageYear == 1) {

				// 		$opportunityDataList[$key]['age'] = $ageYear.' Year';

				// 		} else {

				// 			$opportunityDataList[$key]['age'] = $ageYear.' Years';

				// 		}

				// 	}

				// }



				$updateAgeValue= array(

					'age' => $age

				);

				$wherelead = array('lead_opportunity_id' => $opportunityDataList[$key]['lead_opportunity_id']);

				$updateAge = $this->leadOpportunityModel->updateAge($updateAgeValue, $wherelead);

			}

			

			$opportunityDataList[$key]['newActivity'] = '<i class="fa fa-plus" style="color:#454242;"></i>';

			$opportunityDataList[$key]['sendEmail'] = '<i class="flaticon-mail-1"></i>';

			

		}  

		// print_r($opportunityDataList['0']); die;

		$companycount = $this->leadOpportunityModel->getLead('*',$where);





		$data['recordsFiltered'] = count($companycount); 

		$data['recordsTotal'] = count($companycount); 

		$data['data'] = $opportunityDataList;

		echo json_encode($data);



	} // end : getLeads Action



	public function deleteOpportunity() { 

        $DeleteId = $this->input->post();

        $newUsrId = explode(',', $DeleteId['deleteThis']);

        $deleteUpdateData = array('activity_status' => 'inactive');

		$DeletedUser = $this->leadOpportunityModel->deleteOpportunies($deleteUpdateData,$newUsrId);

        if ($DeletedUser) {

            $this->session->set_userdata('setMessage','deleted');

            $whereNotificationID = array('fk_notification_id' => '9');

			$deleteLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);

			$userIDs = json_decode($deleteLeadNotification['result'][0]['user_id']);

        	$getEmailList = $this->userModel->getUserEmail('*',$userIDs);

        	foreach ($getEmailList as $key => $value) {

	        	$emailList[] = $value['contact_info'];

	        }



	        foreach ($newUsrId as $userKey => $userValue) {

            	$where = array('lead_opportunity_id' => $userValue);

            	$getUserdetails = $this->leadOpportunityModel->getLeadDetails($where);

            	if ($deleteLeadNotification['count'] == 1) {

			        $emailString = implode(',', $emailList);

		        	$subject = 'Lead Deleted Successfully';

		        	$module = 'Lead';

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

        $newUsrId = explode(',', $DeleteId['getEmail']);

        $select="";

		$getuserData = $this->leadOpportunityModel->getEmailIds($select,$newUsrId);

		$test = [];

		foreach($getuserData as $a => $val){

            if (is_array($val)){

		        $test[] = implode(",", $val);

		    }

        }

        $finalEmails = implode(", ", $test); 

       

        if (!empty($finalEmails)) {

            echo $finalEmails;

        } else {

            return False;

        }

    }



    public function getUcontData() {

        $userId = $this->input->post();

        $newUsrId = $userId['userID'];

        $select=""; 

		$getuserDat = $this->leadOpportunityModel->getCTDetails($select,$newUsrId);

       	foreach($getuserDat as $k=>$v) {

			$newArray[$k] = $v;

		}

		$getuserData['Contact'] = $newArray;

      	$CtView = $this->load->view('pages/getContactFieldViewLead', $getuserData);

        echo $CtView;

    }



    public function getContactFields() {

      	$CtView = $this->load->view('pages/getContactFields');

        echo $CtView;

    }



        public function sendBulkEmail() {



        $post = $this->input->post();

        $to = $post['usrEmail'];

        $subject = $post['usrSub'];

        $message = $post['usrMsg'];

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');



            try {

               

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

		$filename = "Lead Opportunity-".str_replace('-', '', date('d-M-Y'));

    	header('Content-Disposition: attachment; filename="'.$filename.'.csv";');

    	header('Content-Type: application/csv');

    	$leadList = '';

    	if ($list != '') {

        	$leadList = explode('_', $list);

        }

        $columnArray = $this->leadOpportunity->getOpportunityCoulmn();

        $fields = $columns = array_column($columnArray,'data');

        $title =  array_column($columnArray,'title');
		$fields = $this->leadOpportunity->getSelectField($columns);
		unset($fields[0]);
		
		// $whereFeilds = $this->leadOpportunity->getWhereField($columns); 	
		$where = 'lo.job_status = "not_converted" and lo.activity_status = "active"';

		$leadData = $this->leadOpportunityModel->getLeadExcel($fields,$where,$leadList);
		$f = fopen("php://output", "w");

		unset($title[0]);

		fputcsv($f, $title);

		foreach ($leadData as $user) {

    		fputcsv($f, $user);

		}

		fpassthru($f);   

    }

    public function savefilter() {

		try{

			$post = $this->input->post();

			

			$test = json_encode($post);



	        $insertArray = array(

				'filter_name' => $post['filterName'],

				'filter_values' => $test,

				'module' => 'Lead Opportunity'

				);

	        // print_r($insertArray);

	        // die;

	        $data['id'] = $this->leadOpportunityModel->createFilter($insertArray);

				// print_r($data['id']);exit;

				// 

				

				$response['code'] = 200;

				$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Filter Added Successfully.</div>";

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

			// var_dump($selectedColumns); die;

			$column = $arrayField = $this->leadOpportunity->getOpportunityCoulmn();

			$data['columns'] = $column; 

			if(!empty($selectedColumns)) {

				$arrayField = array();

				array_push($arrayField, $column[0]);

				foreach ($selectedColumns['internal'] as $key => $value) {

					array_push($arrayField, $column[$value]);

				}

			} else if($gridId) {

				$grid_columns = $this->leadOpportunityModel->getGrid('grid_columns',array('grid_id' => $gridId));

				if(!empty($grid_columns)) {

					$arrayField = json_decode($grid_columns[0]['grid_columns']);

				}

			}



			if(isset($selectedColumns['ischeck'])) {

	            $columns['grid_columns'] = json_encode($arrayField);

	            $columns['grid_name'] = $selectedColumns['saveGrid'];

	            $columns['module_name'] = $module_name;

	            $this->leadOpportunityModel->insertGrid($columns);

	        }

	        $data['columns'] = $arrayField;

	        $data['options'] = $this->leadOpportunityModel->getGrid('*',array('module_name' => $module_name));

			$data['gridId'] = $gridId;

			$response['code'] = 200;

			$response['message'] = 'Grid created successfully';

			$response['data'] = $data;

		}catch(Exception $e){

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();

		}

		echo json_encode($response);

	} // end : createGrid Action



	public function getSavedFilterDropdown() {

		$post = $this->input->post();

		$wheremodule = array('module' => 'Lead Opportunity');

		$getPath['filterData'] = $this->companyMondel->getFilterDropdown($wheremodule);

		$getIdentifierList = $this->load->view('form/getFilterDropdown', $getPath);

		return $getIdentifierList;

	}



	public function getLeadActivityView() {

		$post = $this->input->post();

		$data['lead_opportunity_id'] = $post['lead_opportunity_id'];

		$data['addActivity'] = $this->permission->checkUserPermission(23);

		$getIdentifierList = $this->load->view('form/getAddActivityView', $data);

		return $getIdentifierList;

	}



	public function getActivity() {

		$post = $this->input->post();

		$data['fk_lead_opportunity_id'] = $post['lead_opportunity_id'];

		$data['newValue'] = $post['value'];



		$selectContacts = "GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info,u.full_name,u.designation,c.company_name";

		$whereContacts = array('lo.lead_opportunity_id' => $post['lead_opportunity_id']);

		$data['contacts'] = $this->leadOpportunityModel->getUserContact($selectContacts,$whereContacts);

//print_r($data['contacts']);exit;

		$selectSalesPerson = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) as name";

		$whereSalesPerson = array('r.role_name' => 'Sales Person');

		$data['salesPerson'] = $this->leadActivityModel->getSalesPersons($selectSalesPerson,$whereSalesPerson);

		//print_r($data['salesPerson']);die;

		$selectCountry = '*';

		$whereCountry= array();

		$data['activityType'] = $this->leadActivityModel->getActivityType($selectCountry,$whereCountry);

		

		// print_r($data['getLead']['0']); die;

		$getIdentifierList = $this->load->view('form/getAddActivityForm', $data);

		return $getIdentifierList;

	}



	public function getLeadProposalView() {

		$post = $this->input->post();

		$data['lead_opportunity_id'] = $post['lead_opportunity_id'];

		$data['addProposal'] = $this->permission->checkUserPermission(32);

		$getIdentifierList = $this->load->view('form/getAddProposalView', $data);

		return $getIdentifierList;

	}





	public function getProposal() {

		$post = $this->input->post();

		$data['fk_lead_opportunity_id'] = $post['lead_opportunity_id'];

		$data['newValue'] = $post['value'];



		$select = "CONCAT ('Proposal for ', lo.opportunity_title, '(', c.company_name, ')') AS name";

    	$where = array('lo.lead_opportunity_id' => $data['fk_lead_opportunity_id']);

    	$getCompanyLeadOpp = $this->proposalModel->getCompanyLeadOpp($select, $where);



    	$select = "count(title) AS totalcount";

    	$getCountOfExistingLead = $this->proposalModel->getCountOfExistingLead($select, $getCompanyLeadOpp[0]['name']);

    	$totalCount = $getCountOfExistingLead[0]['totalcount'] + 1;

    	//print_r($totalCount);exit;

    	if ($getCountOfExistingLead[0]['totalcount'] != 0) {

    		$title = $getCompanyLeadOpp[0]['name']."(".$totalCount.")";

    	} else {

    		$title = $getCompanyLeadOpp[0]['name'];

    	}



    	$insertArray = array(

			'title' => $title,

			'fk_lead_opportunity_id' => $data['fk_lead_opportunity_id'],

			'status' => 'Drafted',

		);

    	$data['id'] = $this->proposalModel->insertProposal($insertArray);

		$add_P_id = array(

			'fk_pid' => $data['id'],

		);

		$data['itemId'] = $this->proposalModel->insertIdProposalWorksheet($add_P_id);

		// $this->session->set_userdata('setMessage','Added');



		$select = 'lo.lead_opportunity_id, lo.fk_user_id, lo.opportunity_title, u.full_name';

		$where = array('lo.lead_opportunity_id' => $data['fk_lead_opportunity_id']);

		$data['value'] = $this->leadOpportunityModel->getLeadOpportunities($select,$where);



// print_r($data['value']);exit;

		$data['formheading'] = 'Add Proposal';

		

		// print_r($data['getLead']['0']); die;

		$getIdentifierList = $this->load->view('form/getAddProposalForm', $data);

		return $getIdentifierList;

	}





	public function addWorksheet() {

		$post = $this->input->post();

		try {

			if(isset($_FILES["photo"]['name']) && $_FILES["photo"]['name'] !='') {

				$config['upload_path'] = './upload/addItemImages/';

		        $config['allowed_types'] = 'jpg|png|jpeg';

		        $config['max_size'] = 2000;

		        $config['max_width'] = 1500;

		        $config['max_height'] = 1500;

		        $new_name = time().str_replace(' ', '_', $_FILES["photo"]['name']);

				$config['file_name'] = $new_name;

		        $post['photo'] = $new_name;

		        $this->load->library('upload', $config);

		        if ( ! $this->upload->do_upload('photo')) {

		            $error = array('error' => $this->upload->display_errors());

		            echo $error;

		        }

			}



         	$this->load->library('form_validation');

			if (isset($post['pw_id']) && $post['pw_id']!='') {

				$this->form_validation->set_rules('pw_id', 'Something Went Wrong', 'required|integer');

			}

	        $this->form_validation->set_rules('room_type', 'Room Type', 'required');

	        $this->form_validation->set_rules('id_code', 'ID Code', 'required');

	        $this->form_validation->set_rules('item_name', 'Item Name', 'required');



	        if ($this->form_validation->run() == FALSE) {

	            $response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>".

	                    validation_errors().

	                "</div>";

	        } else {

	        	$pw_id = $post['pw_id'];

	        	//-----Calculate ExFactory Amount----------------------

	        	if($post['quantity'] !='' && $post['ex_factory_unit_price'] !='' && $post['unit_price_markup'] !='' && $post['ex_factory_mark_up_amt'] !='') {

	        		if ($post['unit_price_markup'] == '%') {

	        			$post['ex_factory_total_markup'] = $post['ex_factory_unit_price'] * ($post['ex_factory_mark_up_amt']/100);

	        		} else if ($post['unit_price_markup'] == '$/unit') {

	        			$post['ex_factory_total_markup'] = $post['quantity'] * $post['ex_factory_mark_up_amt'];

	        		} else if ($post['unit_price_markup'] == 'Total Markup') {

	        			$post['ex_factory_total_markup'] = ($post['quantity'] * $post['ex_factory_unit_price']) + $post['ex_factory_mark_up_amt'];

	        		}

	        		$post['total_price_ex_factory'] = $post['ex_factory_total_markup'] + ($post['quantity']*$post['ex_factory_unit_price']);

	        	}



	        	//-----Calculate Fabrics Amounts----------------------

	        	if($post['fabric_quantity'] !='' && $post['fabric_price'] !='' && $post['fabric_markup'] !='' && $post['fabric_mark_up_amt'] !='') {

				    if ($post['fabric_markup'] == '%') {

				        $post['fabrics_total_markup'] = $post['fabric_price'] * ($post['fabric_mark_up_amt']/100);

				    } else if ($post['fabric_markup'] == '$/unit') {

				        $post['fabrics_total_markup'] = $post['fabric_quantity'] * $post['fabric_mark_up_amt'];

				    } else if ($post['fabric_markup'] == 'Total Markup') {

				        $post['fabrics_total_markup'] = ($post['fabric_quantity'] * $post['fabric_price']) + $post['fabric_mark_up_amt'];

				    }

				    $post['unit_total_price_fabric'] = $post['fabrics_total_markup'] + ($post['fabric_quantity']*$post['fabric_price']);

				}



				//-----Calculate Leather Amounts----------------------

	        	if($post['leather_quantity'] !='' && $post['leather_price'] !='' && $post['leather_markup'] !='' && $post['leather_mark_up_amt'] !='') {

				    if ($post['leather_markup'] == '%') {

				        $post['leather_total_markup'] = $post['leather_price'] * ($post['leather_mark_up_amt']/100);

				    } else if ($post['leather_markup'] == '$/unit') {

				        $post['leather_total_markup'] = $post['leather_quantity'] * $post['leather_mark_up_amt'];

				    } else if ($post['leather_markup'] == 'Total Markup') {

				        $post['leather_total_markup'] = ($post['leather_quantity'] * $post['leather_price']) + $post['leather_mark_up_amt'];

				    }

				    $post['unit_total_price_leather'] = $post['leather_total_markup'] + ($post['leather_quantity']*$post['leather_price']);

				}



				//--------CAlculate FOB---------------

				if ($post['quantity'] !='' && $post['total_price_ex_factory'] !='' && $post['unit_price_fob'] !='') {

					$post['total_price_fob'] = $post['total_price_ex_factory'] + ($post['quantity'] * $post['unit_price_fob']);

				}



				//--------CAlculate CIF---------------

				if ($post['quantity'] !='' && $post['total_price_ex_factory'] !='' && $post['unit_price_cif'] !='') {

					$post['total_price_cif'] = $post['total_price_ex_factory'] + ($post['quantity'] * $post['unit_price_cif']);

				}



	        	

	        	$data['id'] = $this->proposalModel->insertProposalWorksheet($post, $pw_id);

				//$this->session->set_userdata('setMessage','Added');

				$response['code'] = 200;

				$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Lead Proposal Items Added Successfully.</div>";

				$response['data'] = $data['id'];

				redirect(base_url().'lead');

	        }

		} catch(Exception $e){

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();

			echo json_encode($response);

		}

		// echo json_encode($response);

	} // end : getCompanyIdentifier Action



	public function getProposalItemList() {

		$post = $this->input->post();

		$data['p_id'] = $post['p_id'];

		$data['newValue'] = $post['value'];

		$select = "title,fk_lead_opportunity_id, CONCAT('$', SUM(pw.total_price_fob)) as total_fob, CONCAT('$', SUM(pw.total_price_cif)) as total_cif";

		$where = array('p_id' => $data['p_id']);

		$data['proposal'] = $this->proposalModel->getProposallist($select, $where);



		$selectFormat = "fk_p_id, format_header, format_footer";

		$where = array('fk_p_id' => $data['p_id']);

		$data['getFormat'] = $this->proposalModel->getFormat($selectFormat, $where);



		$select2 = "pw.*";

		$where2 = array('pw.fk_pid' => $data['p_id']);

		$data['getItemList'] = $this->proposalModel->getItemList($select2, $where2);



		$getIdentifierList = $this->load->view('form/getProposalItemList', $data);

		return $getIdentifierList;

	}



	public function setStatus($status) {

		$post = $this->input->post();

		try {

			$p_id = $post['p_id'];

			$updateArray = array(

				'status' => $status,

			);

        	$data= $this->proposalModel->setStatus($updateArray, $p_id);

		} catch(Exception $e){

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();

		}

	} // end : getCompanyIdentifier Action



	public function getLeadActivityFilesView() {

		$post = $this->input->post();

		$data['lead_opportunity_id'] = $post['lead_opportunity_id'];

		$getIdentifierList = $this->load->view('form/getActivityFilesView', $data);

		return $getIdentifierList;

	}



	public function addNotes() {

		$post = $this->input->post();

		$data['lead_opportunity_id'] = $post['lead_opportunity_id'];

		$updateArray = array(

			'notes' => $post['notes'],

		);

		$where = array('lead_opportunity_id' => $data['lead_opportunity_id']);

		$data['value'] = $this->leadOpportunityModel->addNotes($updateArray,$where);

	}



	public function leadConvertToJob() {

		$post = $this->input->post();

		$data['lead_opportunity_id'] = $post['value'];

		$insertArray = array(

			'fk_lead_opportunity_id' => $post['value'],

			'created_by' => $this->session->userdata('user_id'),

		);

		$updateArray = array(

			'job_status' => 'converted',

		);

		$whereArray = array('lead_opportunity_id' => $data['lead_opportunity_id']);

		$data['updateid'] = $this->leadOpportunityModel->updateJobStatus($updateArray, $whereArray);

		$data['id'] = $this->leadOpportunityModel->addJob($insertArray);

		$this->session->set_userdata('setMessage','UpdatedConverted');

		return $data;

	}



	public function getJobType() {

		$post = $this->input->post();



		$data['jobType'] = $this->leadOpportunityModel->getJobTypeView();



		$data['value'] = $post['value'];

		$getIdentifierList = $this->load->view('form/getJobType', $data);

		return $getIdentifierList;

	}



	public function getSource() {

		$post = $this->input->post();



		$selectIndustry = 'industry_id,industry_name';

		$whereIndustry = array('active_status' => 'active');

		$data['source'] = $this->leadOpportunityModel->getSourceView($selectIndustry,$whereIndustry);



		$data['value'] = $post['value'];

		$getIdentifierList = $this->load->view('form/getSource', $data);

		return $getIdentifierList;

	}



	public function getSalesPersonList() {

		$post = $this->input->post();



		$selectIndustry = 'user_id,full_name';

		$whereIndustry = array('fk_role_id' => '5');

		$data = $this->userModel->getUsersDetails($whereIndustry, $selectIndustry);

		$data['userDetails'] = $data['result'];

		$data['lead_id'] = $post['leadId'];

		$getIdentifierList = $this->load->view('pages/getSalesPersonList', $data);

		return $getIdentifierList;

	}



	public function assignUser() {

		$post = $this->input->post();

		$assignuser = explode(',', $post['lead_id']);



		$updateArray = array(

			'fk_sales_people_id' => $post['sales_person'],

		);

		

		$data = $this->leadOpportunityModel->updateAssignToUser($updateArray, $assignuser);

		

		$this->session->set_userdata('setMessage','Updated');

		redirect('lead');



	}



	public function checkEmailExist() {

		$post = $this->input->post();

		$select = 'user_contact_id';

		$where = array('contact_info' => $post['email']);

		$data = $this->userModel->getEmailExist($select, $where);

		if ($data != 0) {

			echo "<span style='color:red'>User with same Email ID already exist. Please select another option from above <b>Select User</b> dropdown.</span>";

		} else {

			echo "<span style='color:green'>Email ID does not exist. Please go ahead and add user.</span>";

		}



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



}

