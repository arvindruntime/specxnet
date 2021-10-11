<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	/** 

	 * User Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://DomainName/users

	 *

	 * @author		 

	 */

	const USER_ARRAY = array('internal' => 'Internal User', 'supplier' => 'Suppliers', 'customer' => 'Customer');

	const COMPANY_ARRAY = array('internal' => 'Internal', 'supplier' => 'Supplier', 'customer' => 'Customer Contact');

	// const MODULE_NAME = 'user';

	public function __construct()
	{
		parent::__construct();

		$user_id = $this->session->userdata('user_id');

		if (!isset($user_id) || $user_id == '') {

			$this->session->sess_destroy();

			redirect('login');
		}

		$this->load->model(array('User_model' => 'userModel'));

		$this->load->library(array('User_library' => 'user'));

		$this->load->model(array('Company_model' => 'companyMondel'));

		$this->load->library(array('Permissions_library' => 'permission'));
	}

	/**

	 * index action of user controller

	 * @author

	 * @param

	 * @param

	 */

	public function index($userType = 'internal', $userid = '', $leadTime = '')
	{
		$permissions = $this->permission->checkUserPermission(9);

		if (!$permissions) {

			redirect('page_not_found');
			exit;
		}

		if ($userType == 'internal') {

			$page['internalPermissions'] = $permissionsType = $this->permission->checkUserPermission(15);

			$page['supplierPermissions'] = $this->permission->checkUserPermission(13);

			$page['customerPermissions'] = $this->permission->checkUserPermission(14);
		} else if ($userType == 'supplier') {

			$page['supplierPermissions'] = $permissionsType = $this->permission->checkUserPermission(13);

			$page['internalPermissions'] = $this->permission->checkUserPermission(15);

			$page['customerPermissions'] = $this->permission->checkUserPermission(14);
		} else if ($userType == 'customer') {

			$page['customerPermissions'] = $permissionsType = $this->permission->checkUserPermission(14);

			$page['internalPermissions'] = $this->permission->checkUserPermission(15);

			$page['supplierPermissions'] = $this->permission->checkUserPermission(13);
		}

		if (!$permissionsType) {

			redirect('page_not_found');
			exit;
		}

		$module_name = $this->uri->segment(1);



		$this->page->setTitle(ucfirst($userType) . ' User');


		// set head style

		$this->page->setHeadStyle(base_url() . "assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style.bundle.css");

		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style-2.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/css/jquery.dataTables.min.css");

		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");

		$this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/css/editor.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/css/style.css");



		// Date picker 

		// $this->page->setHeadStyle(base_url()."assets/custom/datepicker/bootstrap/css/bootstrap.min.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/datepicker/bootstrap/css/bootstrap-datetimepicker.min.css");



		//set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs(base_url() . "assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url() . "assets/demo/default/base/scripts.bundle.js");

		$this->page->setFooterJs("//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");

		$this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/jquery.dataTables.min.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/datatable.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/ajax.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/custom.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/user.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/editor.js");



		//Push Notification

		$this->page->setFooterJs(base_url() . "assets/push_notification/notification.js");



		// text editor js

		$this->page->setFooterJs(base_url() . "assets/ckeditor/ckeditor.js");



		// Date Picker

		// $this->page->setFooterJs(base_url()."assets/custom/datepicker/jquery/jquery-1.8.3.min.js");

		$this->page->setFooterJs(base_url() . "assets/custom/datepicker/js/bootstrap-datetimepicker.js");

		$this->page->setFooterJs(base_url() . "assets/custom/datepicker/js/locales/bootstrap-datetimepicker.fr.js");



		//--- Tabs as per user type----- @Sagar Kodalkar

		$page['config'] = $this->user->getConfig();

		if ($userType == 'internal') {

			$page['tabs'] = $this->user->getTabs();
		} else {

			$page['tabs'] = $this->user->getTabs2();
		}

		// Bimal Sharma

		// Now user take detailes from user libarary

		$page['newButton'] = $this->user->getNewButton();

		$page['action'] = $this->user->getAction();

		$page['actionButton'] = $this->user->getActionButton();



		if ($userType == 'customer') {

			$page['userColumn'] = $this->user->getUserCoulmn2();
		} else if ($userType == 'supplier') {

			$page['userColumn'] = $this->user->getUserCoulmn3();
		} else {

			$page['userColumn'] = $this->user->getUserCoulmn();
		}



		$module_name = $this->uri->segment(1);

		$page['gridView'] = $this->userModel->getGrid('*', array('module_name' => $module_name));



		if (isset($userid) && $userid != '') {

			$usrArray = array();

			array_push($usrArray, 'dashboard');

			array_push($usrArray, $userid);

			array_push($usrArray, $leadTime);

			$page['userWise'] = $usrArray;
		}



		$page['filter'] = $this->input->post('filter');



		if (isset($page['filter']['saved_filter_id'])) {

			$page['savedfilterID'] = $page['filter']['saved_filter_id'];
		}

		//print_r($page['filter']); exit;



		$selectFilter = '*';

		$whereFilter = array('module' => 'User');

		$page['savedFilter'] = $this->userModel->getSavedFilter($selectFilter, $whereFilter);

		//print_r($page['filter']);exit;



		$selectRole = 'role_id,role_name,role_description';

		$whereRole = array('Customer', 'Supplier');

		$page['rolesFilter'] = $this->userModel->getRole($selectRole, $whereRole);



		$selectDepartment = 'department_id, department_name';

		$whereDepartment = array();

		$page['departmentFilter'] = $this->userModel->getDepartment($selectDepartment, $whereDepartment);



		//--- Import Function Submit Url----- @Sagar Kodalkar

		$page['redirectAction'] = '';

		$page['importAction'] = base_url() . 'user/importData/' . $userType;



		$page['module_type'] = $this->uri->segment(2);

		$userType = $this->uri->segment(2);



		// load layout

		if ($userType == 'internal') {

			$page['contain'] = 'userList';

			$page['userType'] = $userType;

			$page['module_name'] = $module_name;

			$usertype2 = $userType;
		} else if ($userType == 'supplier') {

			$page['contain'] = 'userList';

			$page['userType'] = $userType;

			$page['module_name'] = $module_name;

			$usertype2 = $userType;
		} else {

			$page['contain'] = 'userList';

			$page['userType'] = $userType;

			$usertype2 = 'Customer Contact';

			$page['module_name'] = $module_name;
		}



		$page['company'] = '';

		$selectCompany = 'company_id,company_name';

		$whereCompany = array('company_type' => $usertype2, 'activity_status' => 'active');

		$companyList = $this->userModel->getCompany($selectCompany, $whereCompany);

		if (!empty($companyList)) {

			foreach ($companyList as $Key => $Value) {

				// $iname = str_replace(' ', '_', $industryValue['industry_name']);

				// $iname = str_replace('/', '-', $iname);

				$company[] = $Value['company_name'];
			}

			$page['company'] = json_encode($company);
		}



		$page['addPermission'] = $this->permission->checkUserPermission(10);

		$page['editPermission'] = $this->permission->checkUserPermission(11);

		$page['deletePermission'] = $this->permission->checkUserPermission(12);

		$page['sendEmailPermission'] = $this->permission->checkUserPermission(16);



		$this->page->getLayout($page);
	}



	/**

	 * createUser action of User controller to create user

	 * @author Bimal Sharma

	 */

	public function createUser($userId = null)
	{

		try {

			$this->load->library('form_validation');

			if (isset($post['parent_company_id']) && $post['parent_company_id'] != '') {

				$this->form_validation->set_rules('parent_company_id', 'Parent Company', 'required');
			}

			$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha_numeric_spaces');

			if (isset($post['last_name']) && $post['last_name'] != '') {

				$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha_numeric_spaces');
			}



			// $this->form_validation->set_rules('designation', 'Designation', 'required');

			$this->form_validation->set_rules('user_role_id', 'Role', 'required|numeric');

			//$this->form_validation->set_rules('user_comp_id', 'Company', 'required|numeric');

			if (isset($post['street_address']) && $post['street_address'] != '') {

				$this->form_validation->set_rules('street_address', 'Street Address', 'alpha_numeric_spaces');
			}

			$this->form_validation->set_rules('city', 'City', 'required|alpha_numeric_spaces');

			if (isset($post['state']) && $post['state'] != '') {

				$this->form_validation->set_rules('state', 'state', 'alpha_numeric_spaces');
			}

			if (isset($post['pincode']) && $post['pincode'] != '') {

				$this->form_validation->set_rules('pincode', 'Pin Code', 'numeric');
			}

			$this->form_validation->set_rules('country', 'Country', 'required');





			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				$post = $this->input->post();

				//print_r($post['company_id']);exit;print_r($post);exit;

				//print_r($_FILES);exit;

				// if (empty($post['emailcheck']) && empty($post['textcheck']) && empty($post['pushcheck']) && empty($post['allcheck'])) {

				// 	$response['error'] = "<div class='alert-danger-2'>

				//                   <strong>Alert !</strong><br/><br/> Please Set Notifications.</div>";

				//           exit;

				// }

				if (isset($post['active_user'])) {

					$active_user = $post['active_user'];
				} else {

					$active_user = 'inactive';
				}

				$getCountry = explode('-', $post['country']);

				$country = $getCountry[0];

				$dialing_code = '+' . $getCountry[1];



				$companydialing_code = '';

				$companycountry = '';

				if ($post['company_country'] && $post['company_country'] != '') {

					$getCompanyCountry = explode('-', $post['company_country']);

					$companycountry = $getCompanyCountry[0];

					$companydialing_code = '+' . $getCompanyCountry[1];
				}





				if (isset($post['invite_user']) && $post['invite_user'] == 'on') {

					$user_invited = 'Yes';
				} else {

					$user_invited = 'No';
				}



				if (!empty($_FILES["message_signature_image"]['name'])) {

					$config['upload_path']          = APPPATH . '../upload/';

					$config['allowed_types'] = '*';

					$new_name = time() . $_FILES["message_signature_image"]['name'];

					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('message_signature_image')) {

						$data = $this->upload->data();

						$file = $data['orig_name'];

						$file_orig_name = $data['client_name'];

						$file_path = $data['full_path'];
					}
				}



				date_default_timezone_set('Asia/Kolkata');



				$insertUserArray = array(

					'first_name' => $post['first_name'],

					'last_name' => $post['last_name'],

					'fk_role_id' => $post['user_role_id'],

					'fk_rpn_id' => '1',

					'user_invited' => $user_invited,

					'street_address' => $post['street_address'],

					'city' => $post['city'],

					'state' => $post['state'],

					'pincode' => $post['pincode'],

					'country' => $country,

					'dialing_code' => $dialing_code,

					'user_type' => self::USER_ARRAY[$post['userType']],

					'active_status' => $active_user,

					'created_date' => date('d-m-Y h:i:s A'),

					'updated_date' => date('d-m-Y h:i:s A')

				);



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
					} else {

						$insertIndustry = array(

							'industry_name' => $post['fk_industry_name'],

						);

						$checkPCompany = $this->companyMondel->addIndustry($insertIndustry);
					}
				}



				$insertArray = array(

					'company_name' => $post['user_comp_id'],

					'parent_company_id' => $post['parent_company_id'],

					'fk_industry_id' => $post['fk_industry_id'],

					'company_type' => self::COMPANY_ARRAY[$post['userType']],

					'city' => $post['company_city'],

					'state' => $post['company_state'],

					'country' => $companycountry,

					'dialing_code' => $companydialing_code,

					'activity_status' => 'active',

				);



				if (isset($post['company_pincode']) && $post['company_pincode'] != '') {

					$insertArray['zip_code'] = $post['company_pincode'];
				}



				if (isset($post['company_street_address']) && $post['company_street_address'] != '') {

					$insertArray['street_address'] = $post['company_street_address'];
				}



				if (isset($post['company_bussiness_contact']) && $post['company_bussiness_contact'] != '') {

					$getCompanyBusinessContact = explode('-', $post['company_bussiness_contact']);

					$insertArray['bussiness_contact'] = $post['company_bussiness_contact'];
				}



				if (isset($post['fk_industry_id']) && $post['fk_industry_id'] != '') {



					$insertArray['fk_industry_id'] = $post['fk_industry_id'];
				}





				if (isset($post['last_name']) && $post['last_name'] != '') {

					$insertUserArray['last_name'] = $post['last_name'];

					$full_name = $post['first_name'] . " " . $post['last_name'];

					$insertUserArray['full_name'] = $full_name;
				} else {

					$full_name = $post['first_name'];

					$insertUserArray['full_name'] = $full_name;
				}



				$full_name = $post['first_name'] . " " . $post['last_name'];



				if (isset($post['designation']) && $post['designation'] != '') {

					$insertUserArray['designation'] = $post['designation'];
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



				//     	if (isset($post['user_comp_id']) && is_numeric($post['user_comp_id'])) {

				// $insertUserArray['user_comp_id'] = $post['user_comp_id'];

				//     	} else {

				//     		$whereCompany = array('company_name' => $post['user_comp_id']);

				// $checkCompany = $this->companyMondel->isExistCompany($whereCompany);

				// //print_r($checkCompany['result'][0]['company_id']);exit;

				//     		if ($checkCompany['count'] == 0) {

				//     			$response['error'] = "<div class='alert-danger-2'>

				// 				                    <strong>Alert !</strong><br/><br/>

				// 				                    The Company name you entered does not exists. Please Contact Administrator !

				// 				                </div>";

				// 	$response['code'] = 400;

				// 	$response['message'] = 'exception in insertion';

				// 	echo json_encode($response);

				//      		exit;

				//     		} else {

				//     			if (isset($checkCompany['result'][0]['company_id'])) {

				//     				$insertUserArray['fk_company_id'] = $checkCompany['result'][0]['company_id'];

				//     			}

				//     		}



				//     	}

				//print_r($insertUserArray);exit;

				if (!isset($post['contact_detail'])) {

					$response['error'] = "<div class='alert-danger-2'>

							                    <strong>Alert !</strong><br/><br/>

							                    You can not delete all contacts !

							                </div>";

					$response['code'] = 400;

					$response['message'] = 'exception in insertion';

					echo json_encode($response);

					exit;
				}



				$ContactInfo = $post['contact_detail'];

				$ContactType = $post['contact_type'];

				$email_key = array_search('success', $ContactType);

				$phone_key = array_search('danger', $ContactType);

				$url_key = array_search('warn', $ContactType);

				if (isset($email_key) && $email_key != '') {

					$ContactType[$email_key] = 'Email';
				}

				if (isset($phone_key) && $phone_key != '') {

					$ContactType[$phone_key] = 'Phone';
				}
				if (isset($url_key) && $url_key != '') {
					$ContactType[$url_key] = 'Mobile';
				}
				$email_count = 0;

				$phone_count = 0;
				$url_key = 0;

				$c = array_combine($ContactInfo, $ContactType);



				foreach ($c as $a => $val) {

					// For Valid Email and If Already Exist logic

					if ($val == "Email") {

						$checkEmail = filter_var($a, FILTER_VALIDATE_EMAIL);

						$validEmail = $checkEmail == '' ? 'Invalid' : 'Valid';

						$where = array('contact_type' => 'Email', 'contact_info' => $a);

						if ($userId) {

							$getCountStatus = $this->userModel->checkEmailExist($a, $where, $userId);
						} else {

							$getCountStatus = $this->userModel->checkEmailExist($a, $where);
						}



						if ($validEmail == 'Invalid' || $getCountStatus == 'Failed') {

							$response['error'] = "<div class='alert-danger-2'>

							                    <strong>Alert !</strong><br/><br/>

							                    Invalid Email Format Or Email Already Exist !

							                </div>";

							$response['code'] = 505;

							$response['message'] = 'exception in insertion';

							echo json_encode($response);

							exit;
						}

						$email_count++;
					} elseif ($val == "Mobile") {

						if (preg_match("/[a-z]/i", $a)) {
							$response['error'] = "<div class='alert-danger-2'>
							                    <strong>Alert !</strong><br/><br/>
							                    Invalid Mobile Number!
							                </div>";
							$response['code'] = 505;
							$response['message'] = 'exception in insertion';
							echo json_encode($response);
							exit;
						}
						$url_key++;
					} else if ($val == "Phone") {
						if (preg_match("/[a-z]/i", $a)) {
							$response['error'] = "<div class='alert-danger-2'>
							                    <strong>Alert !</strong><br/><br/>
							                    Invalid Phone Number!
							                </div>";
							$response['code'] = 505;
							$response['message'] = 'exception in insertion';
							echo json_encode($response);
							exit;
						}
						$phone_count++;
					}
				}



				if ($email_count == 0 || $phone_count == 0) {

					$response['error'] = "<div class='alert-danger-2'>

							                    <strong>Alert !</strong><br/><br/>

							                    Aleast 1 Email & 1 Phone is required as a Contact Details.

							                </div>";

					$response['code'] = 505;

					$response['message'] = 'exception in insertion';

					echo json_encode($response);

					exit;
				}

				$whereNotificationID = array('fk_notification_id' => '4');

				$addUserNotification = $this->userModel->getUsersNotification($whereNotificationID);

				$whereNotificationID = array('fk_notification_id' => '4');

				$editUserNotification = $this->userModel->getUsersNotification($whereNotificationID);



				//-------------------Add Company---------------------------------

				//print_r($insertArray);exit;

				if (isset($post['company_id']) && $post['company_id'] == '') {

					//print_r('hii');exit;

					$insertArray['created_date'] = date('d-m-Y h:i A');

					$insertArray['updated_date'] = date('d-m-Y h:i A');

					$insertArray['str_created_date'] = strtotime(date('d-m-Y'));

					$insertArray['str_updated_date'] = strtotime(date('d-m-Y'));

					$data['id'] = $this->companyMondel->insertCompany($insertArray);

					$insertUserArray['fk_company_id'] = $data['id'];

					$this->session->set_userdata('setMessage', 'Added');
				} else {

					$insertUserArray['fk_company_id'] = $post['company_id'];

					$insertArray['updated_date'] = date('d-m-Y h:i A');

					$insertArray['str_updated_date'] = strtotime(date('d-m-Y'));

					$where = array('company_id' => $post['company_id']);

					$data['id'] = $this->companyMondel->updateCompany($insertArray, $where);

					$this->session->set_userdata('setMessage', 'Updated');
				}

				//----------------------End------------------------------------------



				if (!$userId) {

					$insertUserArray['str_created_date'] = strtotime(date('d-m-Y'));

					$insertUserArray['str_updated_date'] = strtotime(date('d-m-Y'));

					$data['id'] = $this->userModel->insertUser($insertUserArray);

					$insertUserPermissionArray = array(

						'fk_role_id' => $post['user_role_id'],

						'fk_user_id' => $data['id'],

					);



					if (isset($post['check'])) {

						$presale = array('17', '22', '26', '31', '36');

						if (!empty(array_intersect($presale, $post['check']))) {

							$post34 = array_push($post['check'], '37');
						}

						$insertUserPermissionArray['permissions'] = json_encode($post['check']);



						if (isset($post['userComment'])) {

							$insertUserPermissionArray['can_view_activity_comments'] = json_encode($post['userComment']);
						}



						if (isset($post['userCheck'])) {

							$insertUserPermissionArray['can_view_activity'] = json_encode($post['userCheck']);
						}

						if (isset($post['userOpportunity'])) {

							$insertUserPermissionArray['can_view_opportunity'] = json_encode($post['userOpportunity']);
						}

						if (isset($post['userAdded'])) {

							$insertUserPermissionArray['can_view_users'] = json_encode($post['userAdded']);
						}

						if (isset($post['companyAdded'])) {

							$insertUserPermissionArray['can_view_company'] = json_encode($post['companyAdded']);
						}



						$rpn_id = $this->userModel->insertUserpermissions($insertUserPermissionArray);

						// $updateRpnArray = array(

						// 	'fk_rpn_id' => $rpn_id,

						// );

						// $whereUserID = array('user_id' => $userId);

						// $this->userModel->updateRPN($updateRpnArray,$whereUserID);

					} else {
						$selectmodule = 'rpn_id, permissions';
						$wheremodule = array('fk_role_id' => $post['user_role_id']);
						$permissions = $this->userModel->getPermissionsNotifications($selectmodule, $wheremodule);
						// print_r($permissions[0]['permissions']);
						$insertUserPermissionArray['permissions'] = $permissions[0]['permissions'];
						$rpn_id = $this->userModel->insertUserpermissions($insertUserPermissionArray);

					}

// exit();



					$insertUserNotificationArray = array(

						'fk_role_id' => $post['user_role_id'],

						'fk_user_id' => $data['id'],

					);



					if (isset($post['emailcheck'])) {

						$usersId[] = $data['id'];

						foreach ($post['emailcheck'] as $notification) {

							$whereNotification = array('fk_notification_id' => $notification);

							$getNotifiedUser = $this->userModel->getUsersNotification($whereNotification);

							if ($getNotifiedUser['count'] == 0) {

								$setUserNotificationArray = array(

									'fk_notification_id' => $notification,

									'user_id' => json_encode($usersId),

								);

								$setNotifiedUser = $this->userModel->setUsersNotification($setUserNotificationArray);
							} else {

								$userIDs = json_decode($getNotifiedUser['result'][0]['user_id']);

								if (!in_array($data['id'], $userIDs)) {

									array_push($userIDs, $data['id']);
								}

								$newIds = json_encode($userIDs);

								$updateUserSetNotificationArray = array(

									'user_id' => $newIds,

								);

								$updateNotifiedUser = $this->userModel->updateUsersNotification($updateUserSetNotificationArray, $whereNotification);
							}
						}



						$insertUserNotificationArray['email_notifications'] = json_encode($post['emailcheck']);
					}

					// if (isset($post['textcheck'])) {

					// 	$insertUserNotificationArray['text_notifications'] = json_encode($post['textcheck']);

					// }

					// if (isset($post['pushcheck'])) {

					// 	$insertUserNotificationArray['push_notifications'] = json_encode($post['pushcheck']);

					// }

					// if (isset($post['allcheck'])) {

					// 	$insertUserNotificationArray['all_user_notification'] = json_encode($post['allcheck']);

					// }

					// $this->userModel->insertUsernotifications($insertUserNotificationArray);



					// $insertUserPreferencesArray = array(

					// 	'fk_user_id' => $data['id'],

					// 	'message_signature' => $post['message_signature'],

					// );

					// if (isset($file_orig_name) && $file_orig_name != '') {

					// 	$insertUserPreferencesArray['file'] = $file;

					// 	$insertUserPreferencesArray['file_orig_name'] = $file_orig_name;

					// 	$insertUserPreferencesArray['file_path'] = $file_path;

					// }



					// $this->userModel->insertUserPreferences($insertUserPreferencesArray);



					// START: code to create multiple contact for inserted userId //

					$ContactInfo = $post['contact_detail'];

					$ContactType = $post['contact_type'];

					$c = array_combine($ContactInfo, $ContactType);

					//print_r($c);exit;

					foreach ($c as $a => $val) {

						if ($val == 'Email' || $val == 'success') {

							$emailList[] = $a;
						}

						$dataContact['fk_user_id'] = $data['id'];

						$dataContact['contact_info'] = $a;

						if ($val == 'danger' || $val == 'Phone') {

							$newval = 'Phone';
						}

						if ($val == 'success' || $val == 'Email') {

							$newval = 'Email';
						}
						if ($val == 'warn' || $val == 'Mobile') {
							$newval = 'Mobile';
						}
						$dataContact['contact_type'] = $newval;

						$dataContact['created_date'] = date('d-m-Y h:i:s A');

						$dataContact['updated_date'] = date('d-m-Y h:i:s A');

						$this->userModel->insertUserConatct($dataContact);
					}

					// print_r($dataContact);exit;

					if ($addUserNotification['count'] == 1) {

						$userIDs = json_decode($addUserNotification['result'][0]['user_id']);

						$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

						foreach ($getEmailList as $key => $value) {

							$emailListNotification[] = $value['contact_info'];
						}

						$emailString = implode(',', $emailListNotification);



						$subject = 'User Added Successfully';

						$module = 'User';

						$name = $full_name;

						$action = 'added';

						$actionBy = $this->session->userdata('user_name');

						$UserNotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
					}







					$response['code'] = 200;

					$response['message'] = "<div class='alert alert-success'>

			                     <strong>Success!</strong> User Added Successfully.</div>";

					$response['data'] = $data['id'];
				} else {

					$where = array('user_id' => $userId);

					$insertUserArray['str_updated_date'] = strtotime(date('d-m-Y'));

					$data['id'] = $this->userModel->updateUser($insertUserArray, $where);

					$i = '0';

					$ContactInfo = $post['contact_detail'];

					$ContactType = $post['contact_type'];

					$userContactId = $post['userConactId'];

					$length = count($userContactId);



					for ($i = 0; $i < $length;) {

						if ($userContactId[$i] == "") {

							$dataContactNew['fk_user_id'] = $userId;

							$dataContactNew['contact_info'] = $ContactInfo[$i];

							if ($ContactType[$i] == 'danger') {

								$ContactType[$i] = 'Phone';
							}

							if ($ContactType[$i] == 'success' || $ContactType[$i] == 'Email') {

								$ContactType[$i] = 'Email';
							}
							echo $ContactType[$i];



							$dataContactNew['contact_type'] = $ContactType[$i];

							$dataContactNew['created_date'] = date('d-m-Y h:i:s A');

							$dataContactNew['updated_date'] = date('d-m-Y h:i:s A');

							$this->userModel->insertUserConatct($dataContactNew);
						}



						if ($ContactType[$i] == 'Email' || $ContactType[$i] == 'success') {

							$emailList[] = $ContactInfo[$i];
						}

						$datawhere['user_contact_id'] = $userContactId[$i];

						$UpdateUSerContactArray = array(

							'contact_info' => $ContactInfo[$i],

							'contact_type' => $ContactType[$i],

							'updated_date' => date('d-m-Y h:i:s A')

						);

						$i++;

						$this->userModel->updateUserConatct($UpdateUSerContactArray, $datawhere);

						$this->session->set_userdata('setMessage', 'Updated');
					}



					$updateUserPermissionArray = array(

						'fk_user_id' => $userId,

						'fk_role_id' => $post['user_role_id'],

					);





					if (isset($post['check'])) {

						$presale = array('17', '22', '26', '31', '36');

						if (!empty(array_intersect($presale, $post['check']))) {

							$post34 = array_push($post['check'], '37');
						}



						$updateUserPermissionArray['permissions'] = json_encode($post['check']);
					}



					if (isset($post['userComment'])) {

						$updateUserPermissionArray['can_view_activity_comments'] = json_encode($post['userComment']);
					}



					if (isset($post['userCheck'])) {

						$updateUserPermissionArray['can_view_activity'] = json_encode($post['userCheck']);
					}

					if (isset($post['userOpportunity'])) {

						$updateUserPermissionArray['can_view_opportunity'] = json_encode($post['userOpportunity']);
					}

					if (isset($post['userAdded'])) {

						$updateUserPermissionArray['can_view_users'] = json_encode($post['userAdded']);
					}

					if (isset($post['companyAdded'])) {

						$updateUserPermissionArray['can_view_company'] = json_encode($post['companyAdded']);
					}



					$wherePermission = array('fk_user_id' => $userId);

					$countId = $this->userModel->checkUserPermissionExist($wherePermission);

					if ($countId == 0) {

						$rpn_id = $this->userModel->insertUserPermissions($updateUserPermissionArray);



						$updateRpnArray = array(

							'fk_rpn_id' => $rpn_id,

						);

						$whereUserID = array('user_id' => $userId);

						$this->userModel->updateRPN($updateRpnArray, $whereUserID);
					} else {

						$this->userModel->updateUserPermissions($updateUserPermissionArray, $wherePermission);
					}

					//----------------------------------Assign Cooment Permissions--------------------------------------------

					// if (isset($post['userComment'][0])) {

					// 	foreach ($post['userComment'] as $key => $value) {

					// 		$updateUserNewPermissionArray = array(

					// 			'fk_user_id' => $value,

					// 		);

					// 		$updateUserNewPermissionArray['can_view_activity_comments'] = 'Yes';

					// 		$wherePermission = array('fk_user_id' => $value);

					// 		$countId = $this->userModel->checkUserPermissionExist($wherePermission);

					// 		if ($countId == 0) {

					// 			$rpn_id = $this->userModel->insertUserPermissions($updateUserNewPermissionArray);

					// 		} else {

					// 			$this->userModel->updateUserPermissions($updateUserNewPermissionArray, $wherePermission);

					// 		}

					// 	}

					// }



					//----------------------------------Assign Users Activity Permissions--------------------------------------------

					// if (isset($post['userCheck'][0])) {

					// 	foreach ($post['userCheck'] as $key => $value) {

					// 		$updateUserNewPermissionArray = array(

					// 			'fk_user_id' => $value,

					// 		);

					// 		$updateUserNewPermissionArray['can_view_activity'] = 'Yes';

					// 		$wherePermission = array('fk_user_id' => $value);

					// 		$countId = $this->userModel->checkUserPermissionExist($wherePermission);

					// 		if ($countId == 0) {

					// 			$rpn_id = $this->userModel->insertUserPermissions($updateUserNewPermissionArray);

					// 		} else {

					// 			$this->userModel->updateUserPermissions($updateUserNewPermissionArray, $wherePermission);

					// 		}

					// 	}

					// }



					//--------------------------------------End Assign module wise users permissions----------------------------------

					$updateUserNotificationArray = array(

						'fk_role_id' => $post['user_role_id'],

						'fk_user_id' => $userId,

					);

					if (isset($post['emailcheck'])) {

						$usersId[] = $userId;

						foreach ($post['emailcheck'] as $notification) {

							$whereNotification = array('fk_notification_id' => $notification);

							$getNotifiedUser = $this->userModel->getUsersNotification($whereNotification);

							if ($getNotifiedUser['count'] == 0) {

								$setUserNotificationArray = array(

									'fk_notification_id' => $notification,

									'user_id' => json_encode($usersId),

								);

								$setNotifiedUser = $this->userModel->setUsersNotification($setUserNotificationArray);
							} else {

								$userIDs = json_decode($getNotifiedUser['result'][0]['user_id']);

								if (!in_array($userId, $userIDs)) {

									array_push($userIDs, $userId);
								}

								$newIds = json_encode($userIDs);

								$updateUserSetNotificationArray = array(

									'user_id' => $newIds,

								);

								$updateNotifiedUser = $this->userModel->updateUsersNotification($updateUserSetNotificationArray, $whereNotification);
							}
						}



						$updateUserNotificationArray['email_notifications'] = json_encode($post['emailcheck']);
					}

					// if (isset($post['textcheck'])) {

					// 	$updateUserNotificationArray['text_notifications'] = json_encode($post['textcheck']);

					// }

					// if (isset($post['pushcheck'])) {

					// 	$updateUserNotificationArray['push_notifications'] = json_encode($post['pushcheck']);

					// }

					// if (isset($post['allcheck'])) {

					// 	$updateUserNotificationArray['all_user_notification'] = json_encode($post['allcheck']);

					// }

					// print_r($updateUserNotificationArray);exit;

					$whereNotification = array('fk_user_id' => $userId);

					$this->userModel->updateUserNotifications($updateUserNotificationArray, $whereNotification);



					// $updateUserPreferencesArray = array(

					// 	'fk_user_id' => $userId,

					// 	'message_signature' => $post['message_signature'],

					// );

					// if (isset($file_orig_name) && $file_orig_name != '') {

					// 	$updateUserPreferencesArray['file'] = $file;

					// 	$updateUserPreferencesArray['file_orig_name'] = $file_orig_name;

					// 	$updateUserPreferencesArray['file_path'] = $file_path;

					// }



					// $wherePreferences = array('fk_user_id' => $userId);

					// $countId = $this->userModel->checkUserPreferencesExist($wherePreferences);

					// if ($countId == 0) {

					// 	$rpn_id = $this->userModel->insertUserPreferences($updateUserPreferencesArray);

					// } else {

					// 	$this->userModel->updateUserPreferences($updateUserPreferencesArray, $wherePreferences);

					// }



					/*	if ($editUserNotification['count'] == 1) {

						$userIDs = json_decode($editUserNotification['result'][0]['user_id']);

						$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

						foreach ($getEmailList as $key => $value) {

							$emailList[] = $value['contact_info'];
						}

						$emailString = implode(',', $emailList);

						$subject = 'User Updated Successfully';

						$module = 'User';

						$name = $full_name;

						$action = 'updated';

						$actionBy = $this->session->userdata('user_name');

						$UserNotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
					}*/



					$response['code'] = 200;

					$response['message'] = "<div class='alert alert-success'>

				                     <strong>Success!</strong> User Updated Successfully.</div>";

					$response['data'] = $data['id'];
				}

				//--------------Invite User Email Send Start-----------------------------------------------------------------------------

				//print_r($emailList);exit;

				if (isset($post['invite_user']) && $post['invite_user'] == 'on') {

					$send_email = 'yes';

					$ContactInfo = $post['contact_detail'];

					$ContactType = $post['contact_type'];

					$length = count($ContactType);



					$userFname = $post['first_name'];

					$userLname = $post['last_name'];

					$testLname = substr($userLname, 0, 1);
					if ($testLname != "") {
						$emailUserName = $userFname . '.' . $testLname;
					} else {
						$emailUserName = $userFname;
					}

					$randomUsername = $this->getUsername($userFname, $userLname, $emailUserName);

					$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

					$password = substr(str_shuffle($chars), 0, 8);
					$pass = md5($password);



					if ($userId) {

						$myUserId = $userId;

						$dataUserLogin['fk_user_id'] = $userId;

						$whereUserId = array('fk_user_id' => $userId);

						$checkUserExist = $this->userModel->checkUserLoginExist($whereUserId);

						$this->session->set_userdata('setMessage', 'Updated');
					} else {

						$myUserId = $data['id'];

						$dataUserLogin['fk_user_id'] = $data['id'];

						$whereUserId = array('fk_user_id' => $data['id']);

						$checkUserExist = $this->userModel->checkUserLoginExist($whereUserId);

						$this->session->set_userdata('setMessage', 'Added');
					}



					if ($checkUserExist['count'] == 1) {

						$randomUsername = $checkUserExist['result'][0]['username'];

						$updateA = array(

							'password'  => $pass,

						);

						$whereA = array('fk_user_id' => $myUserId);

						$newLogin = $this->userModel->updateUserLogin($updateA, $whereA);
					} else {

						$dataUserLogin['username'] = $randomUsername;

						$dataUserLogin['password'] = $pass;

						$dataUserLogin['login_type'] = 'Username';

						$newLogin = $this->userModel->insertUserLogin($dataUserLogin);
					}


					//====================Email Code=======================================================================

					foreach ($emailList as $key => $toEmail) {

						$mail_message = '<html>

                                    <head>

                                      <title>Mail from Specxnet</title>

                                    </head>

                                    <body>

                                    	<b>Welcome To Specxnet</b><br/><br/>

                                    	<p>Below are your Login Credentials</p>

                                        <table style="width: 700px; font-family: arial; font-size: 14px;" border="0">

                                            <tr style="height: 32px; background-color:#f0f0f0;">

                                                <th align="left" style="width:250px; padding-right:5px;">Username:</th>

                                                <td align="left" style="padding-left:5px; line-height: 20px;">' . $randomUsername . '</td>

                                            </tr>

                                            <tr style="height: 32px; background-color:#f0f0f0;">

                                                <th align="left" style="width:250px; padding-right:5px;">Password:</th>

                                                <td align="left" style="padding-left:5px; line-height: 20px;">' . $password . '</td>

                                            </tr>

                                            <tr style="height: 32px; background-color:#f0f0f0;">

                                                <th align="left" style="width:250px; padding-right:5px;">Login Link:</th>

                                                <td align="left" style="padding-left:5px; line-height: 20px;"><a href="https://specxnet.com/login">Click Here</a></td>

                                            </tr>

                                      </table>

                                    </body>

                                </html>';

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





						$this->email->from('crm@hozpitality.com', 'Specxnet');

						$this->email->to($toEmail);

						$this->email->subject('Invite Link');

						$this->email->message($mail_message);



						//Send email

						if (!$this->email->send()) {

							$response['code'] = 500;

							$response['message'] = 'Failure In Invite User';
						}
					}
				}

				//--------------Invite User Email Send End-----------------------------------------------------------------------------



			}
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : createuser Action

	/**



		/**

	 * createGrid action of User controller to create user

	 * @author Bimal Sharma

	 * @edited Bimal Sharma

	 */
	public function permDeleteUActivity()
	{
		$DeleteId = $this->input->post();
		// print_r($DeleteId); die;
		$newUsrId = explode(',', $DeleteId['deleteThis']);
		// print_r($newUsrId); die;
		$whereDelete = array('user_id' => $newUsrId);
		// $deleteUpdateData = array('active_status' => 'inactive');
		$DeletedUser = $this->userModel->permDeleteUser($newUsrId);
		if ($DeletedUser) {
			$this->session->set_userdata('setMessage', 'Permanently deleted');

			return true;
		} else {
			return False;
		}
	}
	public function createGrid($gridId = null)
	{

		try {

			$data = [];

			$data['options'] = array();

			$data['columns'] = array();

			$module_name = $this->uri->segment(1);

			$selectedColumns = $this->input->post();

			//print_r($selectedColumns);exit;

			$column = $arrayField = $this->user->getUserCoulmn();

			$data['columns'] = $column;

			if (!empty($selectedColumns)) {

				$arrayField = array();

				array_push($arrayField, $column[0]);

				foreach ($selectedColumns['internal'] as $key => $value) {

					array_push($arrayField, $column[$value]);
				}
			} else if ($gridId) {

				$grid_columns = $this->userModel->getGrid('grid_columns', array('grid_id' => $gridId));

				if (!empty($grid_columns)) {

					$arrayField = json_decode($grid_columns[0]['grid_columns']);
				}
			}



			if (isset($selectedColumns['ischeck'])) {

				$columns['grid_columns'] = json_encode($arrayField);

				$columns['grid_name'] = $selectedColumns['saveGrid'];

				$columns['module_name'] = $module_name;

				$this->userModel->insertGrid($columns);
			}

			$data['columns'] = $arrayField;

			$data['options'] = $this->userModel->getGrid('*', array('module_name' => $module_name));

			$response['code'] = 200;

			$response['message'] = 'Grid created successfully';

			$response['data'] = $data;
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : createuser Action

	/**







	 * displayForm action of User controller

	 * @author Bimal Sharma

	 * @param $userType String user type (internal,supplier,customer)

	 */

	public function displayForm($userType = 'internal', $id = null)
	{

		// echo "ssnehal"; die;

		// echo $userType; die;

		try {



			$select = 'first_name,user_id';

			$where = array(
				'user_type' => self::USER_ARRAY[$userType],

				'active_status' => 'active'
			);

			//$data['parentCompany'] = $this->userModel->getUser($select,$where);



			$select = 'nicename,phonecode';

			$data['country'] = $this->companyMondel->getCountry($select);



			$selectModule = 'm.*, GROUP_CONCAT(title) as permission';

			$whereModule = array('m.module_type' => 'permissions');

			$data['modulePermissions'] = $this->userModel->getModulePermissions($selectModule, $whereModule);

			//print_r($data['module']);exit;



			$selectRole = 'role_id,role_name,role_description';

			$whereRole = array('Customer', 'Suppliers');

			$data['roles'] = $this->userModel->getRole($selectRole, $whereRole);



			if ($userType == 'customer') {

				$userType2 = 'Customer Contact';
			} else {

				$userType2 = ucwords($userType);
			}

			$selectDepartment = 'department_name';

			$whereDepartment = array('active_status' => 'active');

			$data['departmentNames'] = $this->userModel->getDepartment($selectDepartment, $whereDepartment);



			$selectCompany = 'company_id,company_name';

			$whereCompany = array('company_type' => $userType2, 'activity_status' => 'active');

			$data['company'] = $this->userModel->getCompany($selectCompany, $whereCompany);



			$selectCompany = 'company_id,company_name';

			$whereCompany = array('company_type' => $userType2, 'activity_status' => 'active');

			$data['companyListDropdown'] = $this->userModel->getCompany($selectCompany, $whereCompany);



			$companyType = $userType;

			$select = 'c1.company_name,c1.company_id';

			$where = array('c1.company_type' => self::COMPANY_ARRAY[$companyType], 'c1.activity_status' => 'active', 'c1.parent_company_id' => '0');

			$data['parentCompany'] = $this->companyMondel->getCompany($select, $where);



			$selectIndustry = 'industry_name';

			$whereIndustry = array('active_status' => 'active');

			$data['industryNames'] = $this->companyMondel->getIndustry($selectIndustry, $whereIndustry);



			$data['userType'] = $userType;

			// print_r($data['Roles']); die;

			$data['value'] = array();

			if ($userType == 'customer') {

				$data['formheading'] = ucfirst($userType) . " - Add Client";
			} else {

				$data['formheading'] = ucfirst($userType) . " - Add User";
			}



			if ($id) {

				$select = 'u.*,d.department_name as department_name,c1.company_id,c1.company_name,c1.parent_company_id,c1.bussiness_contact,c1.street_address as companyAddress,c1.city as companycity,c1.state as companystate,c1.country as companycountry,c1.dialing_code,c1.zip_code as companyzip,c1.fax, c2.company_name as parentCompany, c2.company_id as parentCompanyId, i.industry_name as industry_name,i.industry_id as industry_id';

				$where = 'user_id = "' . $id . '"';

				$data['value'] = $this->userModel->getUserUpdate($select, $where);

				if (is_array($data['value'])) {

					$data['value'] = $data['value'][0];
				}

				$selectConatactType = '*';

				// $whereConactInfo = 'fk_user_id = "'.$id.'"';

				// $whereConactInfo= array('uc.fk_user_id' => $id, 'u.active_status' => 'active');
				$whereConactInfo = array('uc.fk_user_id' => $id);

				$data['Contact'] = $this->userModel->getUserContact($selectConatactType, $whereConactInfo);



				$selectPreferences = '*';

				$wherePreferences = array('fk_user_id' => $id);

				$data['preferences'] = $this->userModel->getUserPreferences($selectPreferences, $wherePreferences);



				if ($userType == 'customer') {

					$data['formheading'] = ucfirst($userType) . " - Edit Client";
				} else {

					$data['formheading'] = ucfirst($userType) . " - Edit User";
				}

				//$data['formheading'] = ucfirst($userType)." - Edit User";

			}



			$data['userId'] = $id;

			// print_r($data['Contact']); die;

			$html = $this->page->getPage('userForm', $data, true);



			$response['code'] = 200;

			$response['message'] = 'form generated';

			$response['data']['html'] = $html;

			$response['data']['heading'] = $data['formheading'];

			$response['data']['editor'] = ['message_signature'];
		} catch (Exception $e) {

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

	public function getUsers($userType = 'internal', $usertype2 = null)
	{



		if ($userType == 'index') {

			$userType = 'customer';
		}



		$request = $this->input->get();

		// print_r($request); die; 

		$offset = $request['start'];

		$limit = $request['length'];



		$columnArray = $request['columns'];

		$feilds = $columns = array_column($columnArray, 'data');

		$feilds = $this->user->getSelectField($columns);

		// print_r($feilds);exit;

		$where = 'u.user_type= "' . self::USER_ARRAY[$userType] . '"';

		$whereFeilds = $this->user->getWhereField($columns);



		if (!empty($request['q'])) {

			$query = json_decode($request['q'], true);

			if (isset($query[0]) && $query[0] == 'dashboard') {

				$where = 'u.user_type= "' . self::USER_ARRAY['customer'] . '"';
			} else {

				$where = 'u.user_type= "' . self::USER_ARRAY[$userType] . '"';
			}
		}



		if (!empty($request['search']['value'])) {

			foreach ($whereFeilds as $key => $value) {

				$where .= ' and ' . $value . " Like '%" . $request['search']['value'] . "%'";
			}
		}

		if (!empty($request['q'])) {

			$query = json_decode($request['q'], true);

			//print_r($query);exit;

			if ($query) {

				$filter = $this->user->getWhereField(array_keys($query));

				foreach ($filter as $key => $value) {

					if ($query[$key] != '') {

						if ($key == 'userStatus' || $key == 'roleId') {

							$where .= ' and ' . $value . " = '" . $query[$key] . "'";
						} else {

							$where .= ' and ' . $value . " like '%" . $query[$key] . "%'";
						}
					}
				}
			}
		}

		$order = null;

		//print_r($request);exit;

		if (isset($request['order']) && is_array($request['order'])) {

			$order = $feilds[$request['order'][0]['column']] . ',' . $request['order'][0]['dir'];
		}

		// will add Full name @Sagar Kodalkar 20-08-2019

		array_push($feilds, "CONCAT(u.first_name,' ',u.last_name) as full_name, u.user_invited, u.street_address, u.city, u.state, u.active_status, u.dialing_code, u.admin_access");



		// email and phone number changes

		array_push($feilds, "GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info");



		$wherepermissions = $this->permission->checkUserPermission(45);

		if ($wherepermissions) {

			$whereUserId = array('fk_user_id' => $this->session->userdata('user_id'));

			$selectPermission = '*';

			$userPermissionList = $this->userModel->getWhoseDataCanView($selectPermission, $whereUserId);

			if (isset($userPermissionList[0]['can_view_users']) && $userPermissionList[0]['can_view_users'] != '') {

				$userArray = json_decode($userPermissionList[0]['can_view_users']);

				array_push($userArray, $this->session->userdata('user_id'));

				$users = implode(',', $userArray);

				//print_r($userPermissionList[0]['can_view_activity']);exit;

				$where .= ' and u.created_by IN( ' . $users . ')';
			}



			//$where.= ' and lo.fk_sales_people_id = '.$this->session->userdata('user_id');

		} else {

			$where .= ' and u.created_by IN( ' . $this->session->userdata('user_id') . ')';
		}



		//------------------------------Section For Dashboard Redirect For Data--------------------------------------------//

		if (!empty($request['q'])) {

			$query = json_decode($request['q'], true);

			if (isset($query[0]) && $query[0] == 'dashboard') {

				$leadUser = $query[1];

				$leadTime = $query[2];

				date_default_timezone_set('Asia/Kolkata');

				if (date('D') != 'Mon') {

					//take the last monday

					$staticstart = date('d-m-Y', strtotime('last Monday'));
				} else {

					$staticstart = date('d-m-Y');
				}

				//always next saturday

				if (date('D') != 'Sat') {

					$staticfinish = date('d-m-Y', strtotime('next Saturday'));
				} else {



					$staticfinish = date('d-m-Y');
				}



				if ($leadTime == 'yesterday') {

					$datetime = new DateTime('yesterday');

					$tomorrow = $datetime->format('d-m-Y');

					//$where = array('u.created_by' => $leadUser,'u.str_created_date' => strtotime($tomorrow));

					$where .= ' and u.str_created_date = ' . strtotime($tomorrow) . 'u.created_by=' . $leadUser;
				} else if ($leadTime == 'this_week') {

					//$where = array('u.created_by' => $leadUser, 'u.str_created_date >=' => strtotime($staticstart), 'u.str_created_date <=' => strtotime($staticfinish));

					$where .= ' and u.str_created_date >= ' . strtotime($staticstart) . ' and u.str_created_date <= ' . strtotime($staticfinish) . 'u.created_by=' . $leadUser;
				} else if ($leadTime == 'this_month') {

					$first_day_this_month = strtotime(date('01-m-Y'));

					$last_day_this_month  = strtotime(date('t-m-Y'));

					$where .= ' and u.str_created_date >= ' . $first_day_this_month . ' and u.str_created_date <= ' . $last_day_this_month . 'u.created_by=' . $leadUser;
				} else if ($leadTime == 'today') {

					//$where = array('u.created_by' => $leadUser, 'u.str_created_date' => strtotime(date('d-m-Y')));

					$where .= ' and u.str_created_date >= ' . strtotime(date('d-m-Y')) . ' and u.created_by=' . $leadUser;
				} else {

					$where .= ' and u.created_by=' . $leadUser;
				}
			}



			if (isset($query['designation'])) {

				$insertDepartmentArray = array(

					'department_name' => $query['designation'],

				);

				$checkDepartment = $this->userModel->isExistDepartment('*', $insertDepartmentArray);



				if (isset($checkDepartment['result'][0]['department_id'])) {

					$fk_department_id = $checkDepartment['result'][0]['department_id'];

					$where = array('u.fk_department_id' => $fk_department_id);
				}
			}
		}

		// print_r($feilds);exit;

		//------------------------------End Section For Dashboard Redirect For Data--------------------------------------------//

		$companyList = $this->userModel->getUser($feilds, $where, $order, $limit, $offset);

		$companycount = $this->userModel->getUserCount('u.user_id', $where, $order);



		//count($companyList);exit;



		//$companycount = coun



		foreach ($companyList as $key => $value) {
			// echo $companyList[$key]['user'];
			//$companyList[$key]['adminAccess'] = '<i class="fa fa-check"></i>';

			if ($companyList[$key]['admin_access'] == 'Yes') {

				$companyList[$key]['admin_access'] = '<i class="fa fa-check"></i>';
			} else {

				$companyList[$key]['admin_access'] = '<i class="fa fa-times"></i>';
			}



			if ($companyList[$key]['user_invited'] == 'Yes') {

				$companyList[$key]['loginEnabled'] = '<i class="fa fa-check"></i>';
			} else {

				$companyList[$key]['loginEnabled'] = '<i class="fa fa-times"></i>';
			}



			$companyList[$key]['actoAccess'] = '<i class="fa fa-check"></i>';

			$userInfo = explode(",", $value['user_info']);

			$companyList[$key]['phone'] = '---';

			$companyList[$key]['email'] = '---';

			foreach ($userInfo as $userkey => $uservalue) {

				$userData = explode('_', $uservalue);

				if (!$userData[0]) {

					$companyList[$key]['phone'] = "";

					$companyList[$key]['email'] = "";
				} else {

					if ($userData[1] == 'Phone') {

						$companyList[$key]['phone'] = $userData[0];

						$companyList[$key]['phone'] = $companyList[$key]['dialing_code'] . ' - ' . $userData[0];
					} else if ($userData[1] == 'Email') {

						$companyList[$key]['email'] = $userData[0];
					}
				}
			}

			$whereUser = array('fk_user_id' => $companyList[$key]['user'], 'activity_status' => 'active', 'job_status' => 'not_converted');

			$companyList[$key]['lcount'] = $this->userModel->getUserLeadCount($whereUser);
		}

		$data['recordsFiltered'] = count($companyList);

		$data['recordsTotal'] = $companycount;

		$data['data'] = $companyList;
// PRINT_r($data);
		echo json_encode($data);
	} // end : getCompanies Action



	public function getUsername($firstName, $lastName, $emailUserName)
	{

		$username = $firstName . "-" . $lastName;

		$like = $emailUserName;

		$selectfileds = '*';

		$loginList = $this->userModel->checkUserName($selectfileds, $like);

		$countUser = count($loginList) + 1;

		return ($countUser > 1) ? "{$emailUserName}{$countUser}" : $emailUserName;
	}

	public function deleteUser()
	{

		$DeleteId = $this->input->post();

		// print_r($DeleteId); die;

		$newUsrId = explode(',', $DeleteId['deleteThis']);

		// print_r($DeleteId['deleteThis']); die;

		$whereDelete = array('user_id' => $newUsrId);

		$deleteUpdateData = array('active_status' => 'inactive');

		$DeletedUser = $this->userModel->deleteUser($deleteUpdateData, $newUsrId);

		if ($DeletedUser) {

			$this->session->set_userdata('setMessage', 'deleted');



			$whereNotificationID = array('fk_notification_id' => '6');

			$deleteUserNotification = $this->userModel->getUsersNotification($whereNotificationID);

			$userIDs = json_decode($deleteUserNotification['result'][0]['user_id']);

			$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

			foreach ($getEmailList as $key => $value) {

				$emailList[] = $value['contact_info'];
			}

			$emailString = implode(',', $emailList);



			foreach ($newUsrId as $userKey => $userValue) {

				$select = '*';

				$where = array('user_id' => $userValue);

				$getUserdetails = $this->userModel->getUsersDetails($where, $select);

				if ($deleteUserNotification['count'] == 1) {

					$emailString = implode(',', $emailList);

					$subject = 'User Deleted Successfully';

					$module = 'User';

					$name = $getUserdetails['result'][0]['full_name'];

					$action = 'deleted';

					$actionBy = $this->session->userdata('user_name');

					$UserNotificationEmail = $this->permission->sendNotificationsEmail($to, $subject, $module, $name, $action, $actionBy);
				}
			}



			return true;
		} else {

			return False;
		}
	}

	public function getEmailIds()
	{

		$DeleteId = $this->input->post();

		$newUsrId = explode(',', $DeleteId['getEmail']);

		$select = "";

		$whereUsrs = array('fk_user_id' => $newUsrId);

		$getuserData = $this->userModel->getEmailIds($select, $newUsrId);

		$test = [];

		foreach ($getuserData as $a => $val) {

			if (is_array($val)) {

				$test[] = implode(",", $val);
			}
		}

		$finalEmails = implode(", ", $test);



		if (!empty($finalEmails)) {

			$this->session->set_userdata('setMessage', 'Email Sent Sucessully!');

			echo $finalEmails;
		} else {

			return False;
		}
	}



	public function sendBulkEmail()
	{



		$post = $this->input->post();

		$to = $post['usrEmail'];

		// $cc = $post['userEmailCC'];

		// $bcc = $post['userEmailBCC'];

		$subject = $post['usrSub'];

		$message = $post['usrMsg'];



		$where = array('fk_user_id' => $this->session->userdata('user_id'));

		$preferences = $this->userModel->getPreferencesForUser($where);

		//print_r($preferences);exit;

		if (isset($preferences['result'][0]['file']) && $preferences['result'][0]['file'] != '') {

			$message .= "<br/><br/><br/><img src=" . base_url() . 'upload/' . $preferences['result'][0]['file'] . ">";
		}



		if (isset($preferences['result'][0]['message_signature']) && $preferences['result'][0]['message_signature'] != '') {

			$message .= "<br/>" . $preferences['result'][0]['message_signature'];
		}



		if ((isset($post['setDateTime']) && $post['setDateTime'] == 'on') && isset($post['draft_time'])) {

			$insertArray = array(

				'email_Ids' => $post['usrEmail'],

				'subject' => $post['usrSub'],

				'message' => $message,

				'draft_time' => $post['draft_time'],

				'added_by' => $this->session->userdata('user_id'),

			);



			$insert = $this->userModel->addUserEmailDraft($insertArray);
		} else {

			//print_r($message);exit;

			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			try {

				$toemail = explode(',', $to);

				foreach ($toemail as $key => $email) {

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





					$this->email->from('crm@hozpitality.com', 'Specxnet');

					$this->email->to($email);

					if (isset($cc) && $cc != '') {

						$this->email->cc($cc);
					}

					if (isset($bcc) && $bcc != '') {

						$this->email->bcc($bcc);
					}

					$this->email->subject($subject);

					$this->email->message($mail_message);



					//Send email

					if ($this->email->send()) {

						$response['code'] = 200;

						$response['message'] = 'Success';
					} else {

						$response['code'] = 500;

						$response['message'] = 'Failure';
					}
				}
			} catch (Exception $E) {

				$response['code'] = 500;

				$response['message'] = 'Failure';
			}
		}



		redirect('user/internal');

		// }

	}



	public function createExcel($userType = null, $list = '')
	{

		$filename = ucfirst($userType) . "-Users-" . str_replace('-', '', date('d-M-Y'));

		header('Content-Disposition: attachment; filename="' . $filename . '.csv";');

		header('Content-Type: application/csv');

		$userIdList = '';

		if ($list != '') {

			$list = str_replace('%20', '', $list);

			$userIdList = explode('_', $list);
		}

		$columnArray = $this->user->getUserCoulmn();



		$fields = $columns = array_column($columnArray, 'data');

		$title =  array_column($columnArray, 'title');

		$fields = $this->user->getSelectField($columns);

		// $fields[0] = "CONCAT(u.first_name,' ',u.last_name) as user";
		unset($fields[0]);

		$fields[6] = "(select GROUP_CONCAT(contact_info SEPARATOR ', ') from users_contacts where fk_user_id=`u`.`user_id` and contact_type='Email') as `email`";

		$fields[7] = "(select GROUP_CONCAT(contact_info SEPARATOR ', ') from users_contacts where fk_user_id=`u`.`user_id` and contact_type='Phone') as `phone`";

		// get where field

		$whereFeilds = $this->user->getWhereField($columns);



		if ($userType) {

			$where = 'u.user_type = "' . self::USER_ARRAY[$userType] . '"';
		}

		$userList = $this->userModel->getUserExcel($fields, $where, $userIdList);



		$f = fopen("php://output", "w");

		unset($title[0]);

		fputcsv($f, $title);

		foreach ($userList as $user) {

			fputcsv($f, $user);
		}

		fpassthru($f);
	}

	public function savefilter()
	{

		try {

			$post = $this->input->post();



			$test = json_encode($post);





			$insertArray = array(

				'filter_name' => $post['filterName'],

				'filter_values' => $test,

				'module' => 'User'

			);

			// print_r($insertArray);

			// die;

			$data['id'] = $this->userModel->createFilter($insertArray);

			//print_r($insertArray);exit;





			$response['code'] = 200;

			$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Filter Saved Successfully.</div>";

			$response['data'] = $data['id'];
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : createCompany Action



	public function importData($userType)

	{

		$ExcelHeader = array('First Name', 'Last Name', 'Company Name', 'Designation', 'Role', 'Street Address', 'City', 'State', 'Pincode', 'Active Status', 'Email (a1@email.com/a2@email.com/...)', 'Phone (num1/num2/..)');



		try {

			$this->load->library('Excel', 'excel');



			$config['upload_path']          = APPPATH . '../upload/';

			$config['allowed_types']        = 'xlsx|csv|xls';



			$this->load->library('upload', $config);



			if (!$this->upload->do_upload('file')) {

				$error = $this->upload->display_errors();

				$responceMsg = array(

					'code' => 418,

					'message' => 'error in upload file'

				);

				echo json_encode($responceMsg);

				die;
			}

			$data = $this->upload->data();



			$file = $data['full_path'];



			$importArray = array(

				'A' => array(

					'name' => 'first_name',

					'require' => true

				),

				'B' => array(

					'name' => 'last_name',

					'require' => false

				),

				'C' => array(

					'name' => 'fk_company_id',

					'require' => true

				),

				'D' => array(

					'name' => 'designation',

					'require' => true

				),

				'E' => array(

					'name' => 'fk_role_id',

					'require' => true

				),

				'F' => array(

					'name' => 'street_address',

					'require' => true

				),

				'G' => array(

					'name' => 'city',

					'require' => true

				),

				'H' => array(

					'name' => 'state',

					'require' => true

				),

				'I' => array(

					'name' => 'pincode',

					'require' => true

				),

				'J' => array(

					'name' => 'active_status',

					'require' => true

				),

				'K' => array(

					'name' => 'email',

					'require' => true

				),

				'L' => array(

					'name' => 'phone',

					'require' => true

				),

			);



			$this->excel->setHeaderColumn($importArray);



			if (!$this->excel->validateFileType($file)) {

				$responceMsg = array(

					'code' => 418,

					'message' => $this->excel->getResponseMessage()

				);

				echo json_encode($responceMsg);

				die;
			}



			if (!$this->excel->loadExcel($file)) {

				$responceMsg = array(

					'code' => 418,

					'message' => $this->excel->getResponseMessage()

				);

				echo json_encode($responceMsg);

				die;
			}



			if (!$this->excel->importExcel($ExcelHeader)) {

				$responceMsg = array(

					'code' => 418,

					'message' => $this->excel->getResponseMessage()

				);

				echo json_encode($responceMsg);

				die;
			}



			$data = $this->excel->getImportData();

			foreach ($ExcelHeader as $header => $value) {

				if (!in_array($value, $data['cellArray'])) {

					//echo $value;

					unlink($file);

					$responceMsg = array(

						'code' => 500,

						'message' => "<b style='color:red'>Invalid Excel! You can not upload company data with this excel<br/> For ideal format please <a href=" . base_url() . "upload/sampleUserList.xls>Click Here</a></b>"

					);

					echo json_encode($responceMsg);

					return false;
				}
			}

			$header =  $data['column'] ?? array();

			$rows =  $data['rows'] ?? array();



			if (empty($header) || empty($rows)) {

				$responceMsg = array(

					'code' => 418,

					'message' => 'data is empty'

				);

				echo json_encode($responceMsg);

				die;
			}



			foreach ($rows as $key => $value) {

				$insertArray = array(

					'first_name' => $value['first_name'],

					'last_name' => $value['last_name'],

					'designation' => $value['designation'],

					'street_address' => $value['street_address'],

					'city' => $value['city'],

					'state' => $value['state'],

					'pincode' => $value['pincode'],

					'user_type' => self::USER_ARRAY[$userType],

					'active_status' => $value['active_status'],

				);

				$ParentCompanyId   = 0;
				// print_r($value['fk_company_id']);
				if (isset($value['fk_company_id']) && !empty($value['fk_company_id'])) {
					// echo $userType;
					if ($userType == "customer") {
						$userType = "Customer Contact";
					}
					$where = array('company_type' => ucfirst($userType));

					$CompanyDetail = $this->userModel->getCompanyId($value['fk_company_id'], $where);

					if (!empty($CompanyDetail)) {

						$insertArray['fk_company_id'] = $CompanyDetail[0]['company_id'];
					}
				}



				if (isset($value['fk_role_id']) && !empty($value['fk_role_id'])) {

					$roleDetail = $this->userModel->getRoleId($value['fk_role_id']);

					if (!empty($roleDetail)) {

						$insertArray['fk_role_id'] = $roleDetail[0]['role_id'];
					}
				}



				if (isset($value['email']) && !empty($value['email'])) {

					$getEmail = explode('/', $value['email']);
				}



				if (isset($value['phone']) && !empty($value['phone'])) {

					$getPhone = explode('/', $value['phone']);
				}







				$importExcelData = $this->userModel->insertUser($insertArray);



				foreach ($getEmail as $email) {

					$insertEmailArray = array(

						'fk_user_id' => $importExcelData,

						'contact_info' => $email,

						'contact_type' => 'Email',

					);

					$importEmail = $this->userModel->insertUserConatct($insertEmailArray);
				}



				foreach ($getPhone as $phone) {

					$insertEmailArray = array(

						'fk_user_id' => $importExcelData,

						'contact_info' => $phone,

						'contact_type' => 'Phone',

					);

					$importPhone = $this->userModel->insertUserConatct($insertEmailArray);
				}



				$this->session->set_userdata('setMessage', 'Imported');
			}

			$responceMsg = array(

				'code' => 200,

				'message' => "<b style='color:green'>User Data Imported Successfully</b>"

			);

			unlink($file);

			echo json_encode($responceMsg);
		} catch (Exception $e) {

			$responceMsg = array(

				'code' => $e->getCode(),

				'message' => $e->getMessage()

			);

			echo json_encode($responceMsg);

			die;
		}
	}



	public function deleteusercontact($uc_id = null)
	{

		echo $uc_id;

		if ($uc_id) {

			$whereDelete = array('user_contact_id' => $uc_id);
		} else {

			$DeleteId = $this->input->post();

			$whereDelete = array('user_contact_id' => $DeleteId['deleteThis']);
		}



		//$checkUserContactCount = $this->userModel->checkUserContactCount($whereDelete);

		$DeletedUser = $this->userModel->deleteUserContact($whereDelete);

		return true;
	}



	public function getCountOfContact()
	{

		$DeleteId = $this->input->post();

		$whereDelete = array('user_contact_id' => $DeleteId['contact_id']);

		$getUserID = $this->userModel->getUserId($whereDelete);

		$whereUser = array('fk_user_id' => $getUserID);

		$getCount = $this->userModel->getCountOfContact($whereUser, $DeleteId['contact_id']);

		//echo $getCount;

		if ($getCount < 1) {

			echo "<div class='alert-danger-2'>

							                    <strong>Alert !</strong><br/><br/>

							                    You can not delete all your contacts.

							                </div>";
		} else {

			$whereDelete = array('user_contact_id' => $DeleteId['contact_id']);

			$DeletedUser = $this->userModel->deleteUserContact($whereDelete);

			echo 'Success';
		}
	}



	public function getSavedFilterDropdown()
	{

		$post = $this->input->post();

		$wheremodule = array('module' => 'User');

		$getPath['filterData'] = $this->companyMondel->getFilterDropdown($wheremodule);

		$getIdentifierList = $this->load->view('form/getFilterDropdown', $getPath);

		return $getIdentifierList;
	}



	public function getRolePermissions($user_id = null)
	{

		$selectModule = "m.*, GROUP_CONCAT(permission_id,'_',title) as permission";

		$whereModule = array('m.module_type' => 'permissions');

		$data['module'] = $this->userModel->getModulePermissions($selectModule, $whereModule);

		$post = $this->input->post();
		// echo $user_id;
		if ($user_id && $user_id != 'null') {
			$selectmodule = '*';

			$wheremodule = array('fk_user_id' => $user_id);

			$data['permissions'] = $this->userModel->getUserPermissions($selectmodule, $wheremodule);
			if (empty($data['permissions'])) {
				$selectmodule = 'rpn_id, permissions';
				$wheremodule = array('fk_role_id' => $post['role_id']);

				$data['permissions'] = $this->userModel->getPermissionsNotifications($selectmodule, $wheremodule);
			}
		} else {
			$selectmodule = 'rpn_id, permissions';
			$wheremodule = array('fk_role_id' => $post['role_id']);

			$data['permissions'] = $this->userModel->getPermissionsNotifications($selectmodule, $wheremodule);
		}
		// print_r($data['permissions']);exit();

		$data['currentUser'] = $user_id;



		$selectUserList = 'user_id, full_name,up.*';

		$whererole = array('u.fk_role_id' => '5');

		$data['userList'] = $this->userModel->getSalesPeople($selectUserList, $whererole);



		// print_r($data);

		$getpermissionList = $this->load->view('pages/permissionList', $data);

		return $getpermissionList;
	}



	public function getRoleNotifications($user_id = null)
	{

		$selectModule = "m.*, GROUP_CONCAT(notification_id,'_',title,'_',email_notifications,'_',text_notifications,'_',push_notifications,'_',all_users_notification) as notification";

		$whereModule = array('m.module_type' => 'notifications');

		$data['module'] = $this->userModel->getModuleNotification($selectModule, $whereModule);

		$post = $this->input->post();

		if ($user_id && $user_id != null) {

			$selectmodule = 'user_notification_id, email_notifications, text_notifications, push_notifications, all_user_notification';

			$wheremodule = array('fk_user_id' => $user_id);

			$data['notifications'] = $this->userModel->getUserNotifications($selectmodule, $wheremodule);
		} else {

			$selectmodule = 'rpn_id, email_notifications, text_notifications, push_notifications, all_user_notification';

			$wheremodule = array('fk_role_id' => $post['role_id']);

			$data['notifications'] = $this->userModel->getPermissionsNotifications($selectmodule, $wheremodule);
		}

		//print_r( $data);exit;

		$getpermissionList = $this->load->view('pages/notificationList', $data);

		return $getpermissionList;
	}



	public function getDepartment()
	{

		$post = $this->input->post();

		$selectDepartment = 'department_id,department_name';

		$whereDepartment = array('active_status' => 'active');

		$data['department'] = $this->userModel->getDepartment($selectDepartment, $whereDepartment);



		$data['value'] = $post['value'];

		$getIdentifierList = $this->load->view('form/getDepartment', $data);

		return $getIdentifierList;
	}



	public function getUsersJob()
	{

		$post = $this->input->post();

		$data['user_id'] = $post['user_id'];

		$getIdentifierList = $this->load->view('form/getUsersJobView', $data);

		return $getIdentifierList;
	}



	public function getCompanyDetails()
	{

		$post = $this->input->post();

		//print_r($post);exit;

		if ($post['company_type'] == 'internal') {

			$post['company_type'] = 'Internal';
		} else if ($post['company_type'] == 'supplier') {

			$post['company_type'] = 'Supplier';
		} else {

			$post['company_type'] = 'Customer Contact';
		}

		$select = 'c1.company_id,c1.company_name,c1.parent_company_id,c1.bussiness_contact,c1.street_address,c1.city,c1.state,CONCAT(con.name,"-",con.phonecode) as country,c1.dialing_code,c1.zip_code,c1.fax, c2.company_name as parentCompany, c2.company_id as parentCompanyId, i.industry_name as industry_name,i.industry_id as industry_id';

		$where = array('c1.company_name' => $post['company_name'], 'c1.company_type' => $post['company_type']);

		$getCompanyList = $this->userModel->getCompanyList($select, $where);

		if (!empty($getCompanyList)) {

			$getCompanyList[0]['country'] = ucwords(strtolower($getCompanyList[0]['country']));

			echo $companyData = implode('|', $getCompanyList[0]);
		}

		// return $getCompanyList[0];

	}
}
