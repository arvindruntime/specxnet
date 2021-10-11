<?php

defined('BASEPATH') or exit('No direct script access allowed');



use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Company extends CI_Controller
{



	/**

	 * User Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://DomainName/company

	 *

	 * @author Bimal Sharnma

	 */



	const COMPANY_ARRAY = array('internal' => 'Internal', 'supplier' => 'Supplier', 'customer' => 'Customer Contact');



	public function __construct()
	{

		parent::__construct();

		$user_id = $this->session->userdata('user_id');

		if (!isset($user_id) || $user_id == '') {

			$this->session->sess_destroy();

			redirect('login');
		}

		$this->load->model(array('Company_model' => 'companyMondel'));

		$this->load->model(array('User_model' => 'userModel'));

		$this->load->library(array('Company_library' => 'company'));

		$this->load->library(array('Permissions_library' => 'permission'));
	}



	/**

	 * index action of Company controller

	 * @author Bimal Sharma

	 * @param $companyType String company type (internal,supplier,customer)

	 * @param

	 */

	public function index($companyType = 'internal')

	{

		$permissions = $this->permission->checkUserPermission(2);

		if (!$permissions) {

			redirect('page_not_found');
			exit;
		}



		if ($companyType == 'internal') {

			$page['internalPermissions'] = $permissionsType = $this->permission->checkUserPermission(8);

			$page['supplierPermissions'] = $this->permission->checkUserPermission(6);

			$page['customerPermissions'] = $this->permission->checkUserPermission(7);
		} else if ($companyType == 'supplier') {

			$page['supplierPermissions'] = $permissionsType = $this->permission->checkUserPermission(6);

			$page['internalPermissions'] = $this->permission->checkUserPermission(8);

			$page['customerPermissions'] = $this->permission->checkUserPermission(7);
		} else if ($companyType == 'customer') {

			$page['customerPermissions'] = $permissionsType = $this->permission->checkUserPermission(7);

			$page['internalPermissions'] = $this->permission->checkUserPermission(8);

			$page['supplierPermissions'] = $this->permission->checkUserPermission(6);
		}



		if (!$permissionsType) {

			redirect('page_not_found');
			exit;
		}





		// set title

		$this->page->setTitle('Company');



		// set head style

		$this->page->setHeadStyle(base_url() . "assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style.bundle.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/css/style.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/css/editor.css");
		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style-2.css");

		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");

		$this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");



		// Date picker 

		$this->page->setHeadStyle(base_url() . "assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css");



		// Date picker 

		$this->page->setHeadStyle(base_url() . "assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css");



		// select 2 

		$this->page->setHeadStyle(base_url() . "assets/select2/dist/css/select2.min.css");



		// //set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs(base_url() . "assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url() . "assets/demo/default/base/scripts.bundle.js");

		$this->page->setFooterJs("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");

		//$this->page->setHeadStyle("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"); @shruthi Kumar

		$this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");



		$this->page->setFooterJs(base_url() . "assets/custom/js/ajax.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/custom.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/company.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/datatable.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/editor.js");





		$this->page->setHeadStyle(base_url() . "assets/custom/css/jquery.dataTables.min.css");
		
		

		$this->page->setFooterJs(base_url() . "assets/custom/js/jquery.dataTables.min.js");



		// Date Picker

		$this->page->setFooterJs(base_url() . "assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js");



		// Date Picker

		$this->page->setFooterJs(base_url() . "assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js");



		// Select 2

		$this->page->setFooterJs(base_url() . "assets/select2/dist/js/select2.full.min.js");

		//Push Notification

		$this->page->setFooterJs(base_url() . "assets/push_notification/notification.js");



		// check company config

		$page['config'] = $this->company->getConfig();

		$page['tabs'] = $this->company->getTabs();

		$page['newButton'] = $this->company->getNewButton();

		$page['action'] = $this->company->getAction();

		$page['actionButton'] = $this->company->getActionButton();

		$page['companyColumn'] = $this->company->getCompanyColumn();

		$page['checkedAction'] = $this->company->getCheckedAction();

		$page['module_name'] = $this->uri->segment(1);

		$page['module_type'] = $this->uri->segment(2);

		$page['gridView'] = $this->companyMondel->getGrid('*', array('module_name' => $page['module_name']));

		$page['filter'] = $this->input->post('filter');

		if (isset($page['filter']['saved_filter_id'])) {

			$page['savedfilterID'] = $page['filter']['saved_filter_id'];
		}

		// print_r($page['filter']); echo "</br> </br>";exit;

		// load layout

		$page['contain'] = 'company';

		//$page['companyType'] = $companyType;

		$page['companyType'] = $this->uri->segment(2);

		//List Companies

		$select2 = 'c2.company_id,c2.company_name';

		$where = array('c1.company_type' => self::COMPANY_ARRAY[$companyType], 'c1.activity_status' => 'active');

		$page['parentCompany'] = $this->companyMondel->getParentCompany($select2, $where);

		// print_r($page['parentCompany']); die;

		//List Countries

		$select = 'nicename,phonecode';

		$page['country'] = $this->companyMondel->getCountry($select);



		$selectFilter = '*';

		$whereFilter = array('module' => 'Company');

		$page['savedFilter'] = $this->companyMondel->getSavedFilter($selectFilter, $whereFilter);



		$page['redirectAction'] = $companyType;

		$page['importAction'] = base_url() . 'company/importData';



		$selectIndustry = 'industry_name';

		$whereIndustry = array('active_status' => 'active');

		$industry_name = $this->companyMondel->getIndustry($selectIndustry, $whereIndustry);

		foreach ($industry_name as $industryKey => $industryValue) {

			// $iname = str_replace(' ', '_', $industryValue['industry_name']);

			// $iname = str_replace('/', '-', $iname);

			$industry[] = $industryValue['industry_name'];
		}

		$page['industry'] = json_encode($industry);



		$select = 'c1.company_name,c1.company_id';

		$where = array('c1.company_type' => self::COMPANY_ARRAY[$companyType], 'c1.activity_status' => 'active', 'c1.parent_company_id' => '0');

		$parentCompany = $this->companyMondel->getCompany($select, $where);

		if (!empty($parentCompany)) {

			foreach ($parentCompany as $pcKey => $pcValue) {

				// $iname = str_replace(' ', '_', $industryValue['industry_name']);

				// $iname = str_replace('/', '-', $iname);

				$pcompany[] = $pcValue['company_name'];
			}

			$page['pcompany'] = json_encode($pcompany);
		}



		//Add,Edit,Delete Company

		$page['addPermission'] = $this->permission->checkUserPermission(3);

		$page['editPermission'] = $this->permission->checkUserPermission(4);

		$page['deletePermission'] = $this->permission->checkUserPermission(5);



		$this->page->getLayout($page);
	} // end : index Action





	/**

	 * createCompany action of Company controller to create company

	 * @author Bimal Sharma

	 */

	public function createCompany($companyId = null)
	{

		try {

			$post = $this->input->post();

			//print_r($post);exit;

			// print_r($_FILES);exit;

			//@author: Sagar Kodalkar

			//Validation on input start

			$this->load->library('form_validation');

			$this->form_validation->set_rules('company_name', 'Company Name', 'required');

			if (isset($post['parent_company_id']) && $post['parent_company_id'] != '') {

				$this->form_validation->set_rules('parent_company_id', 'Parent Company', 'required');
			}

			$this->form_validation->set_rules('bussiness_contact', 'Bussiness Contact', 'required|numeric|max_length[15]');
			// $this->form_validation->set_rules('company_logo', 'Company Logo', 'required|numeric|max_length[15]');

			$this->form_validation->set_rules('city', 'City', 'required|alpha_numeric_spaces');

			$this->form_validation->set_rules('country', 'Country', 'required');

			$this->form_validation->set_rules('fk_industry_id', 'Industry', 'required');

			if (isset($post['zip_code']) && $post['zip_code'] != '') {

				$this->form_validation->set_rules('zip_code', 'Zip Code', 'numeric|max_length[6]');
			}



			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				$getcountry = explode('-', $post['country']);



				$file = '';

				$vat = '';

				if (!empty($_FILES["doc_type_file"]['name'])) {

					$config['upload_path'] = APPPATH . '../upload/';

					$config['allowed_types'] = '*';

					$new_name = time() . $_FILES["doc_type_file"]['name'];

					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('doc_type_file')) {

						$data = $this->upload->data();

						$file = $data['orig_name'];

						$file_orig_name = $data['client_name'];

						$full_path = $data['full_path'];
					}

					$vat = $post['doc_type_text'];
				}


				if (!empty($_FILES["company_logo"]['name'])) {

					$config['upload_path']          = APPPATH . '../upload/company_logo';

					$config['allowed_types'] = '*';

					$new_name = time() . $_FILES["company_logo"]['name'];

					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('company_logo')) {

						$data = $this->upload->data();

						$company_logo_file = $data['orig_name'];

						$company_logo_org_file_name = $data['client_name'];

						// $company_logo = $data['full_path'];
						$company_logo_file_path = $config['upload_path'];
					}

					// $vat = $post['doc_type_text'];

				}


				if (!empty($_FILES["liable_certificate_file"]['name'])) {

					$config['upload_path']          = APPPATH . '../upload/liability_certificate/';

					$config['allowed_types'] = '*';

					$new_name = time() . $_FILES["liable_certificate_file"]['name'];

					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('liable_certificate_file')) {

						$data = $this->upload->data();

						$liable_certificate_file = $data['orig_name'];

						$liable_certificate_orig_name = $data['client_name'];

						$liable_certificate_file_path = $data['full_path'];
					}
				}


				// print_r($_FILES["workman_certificate_file"]);

				if (!empty($_FILES["workman_certificate_file"]['name'])) {

					$config['upload_path']          = APPPATH . '../upload/workman_certificate/';

					$config['allowed_types'] = '*';

					$new_name = time() . $_FILES["workman_certificate_file"]['name'];

					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('workman_certificate_file')) {

						$data = $this->upload->data();

						$workman_certificate_file = $data['orig_name'];

						$workman_certificate_orig_name = $data['client_name'];

						$workman_certificate_file_path = $data['full_path'];
					}
				}
				// print_r($_FILES["companyProfileFile"]);
				if (!empty($_FILES["companyProfileFile"]['name'])) {

					$config['upload_path']          = APPPATH . '../upload/company_profile/';

					$config['allowed_types'] = '*';

					$new_name = time() . $_FILES["companyProfileFile"]['name'];

					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('companyProfileFile')) {

						$data = $this->upload->data();

						$company_profile_file = $data['orig_name'];

						$company_profile_orig_name = $data['client_name'];

						$company_profile_file_path = $data['full_path'];
					}
				}

				if (!empty($_FILES["companyCatelog"]['name'])) {

					$config['upload_path']          = APPPATH . '../upload/company_catelog/';

					$config['allowed_types'] = '*';

					$new_name = time() . $_FILES["companyCatelog"]['name'];

					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('companyCatelog')) {
						$data = $this->upload->data();

						$company_catalog_file = $data['orig_name'];

						$company_catalog_orig_name = $data['client_name'];

						$company_catalog_file_path = $data['full_path'];
					}
				}


				$wherePCompany = array('company_name' => $post['parent_company_id']);

				$checkPCompany = $this->companyMondel->isExistCompany($wherePCompany);



				if (isset($checkPCompany['result'][0]['company_id'])) {

					$post['parent_company_id'] = $checkPCompany['result'][0]['company_id'];
				}

				date_default_timezone_set('Asia/Kolkata');



				$insertArray = array(

					'company_name' => $post['company_name'],

					'parent_company_id' => $post['parent_company_id'],

					'company_type' => self::COMPANY_ARRAY[$post['companyType']],

					'bussiness_contact' => $post['bussiness_contact'],

					'city' => $post['city'],

					'state' => $post['state'],

					'country' => $getcountry[0],

					'dialing_code' => $post['dialing_code'],

					'fax' => $post['fax'],

					'activity_status' => 'active',

				);



				if (isset($post['zip_code']) && $post['zip_code'] != '') {

					$insertArray['zip_code'] = $post['zip_code'];
				}



				if (isset($post['street_address']) && $post['street_address'] != '') {

					$insertArray['street_address'] = $post['street_address'];
				}



				if (isset($post['division'])) {

					if (is_numeric($post['division'])) {

						$insertArray['division'] = $post['division'];
					} else {

						$insertDivisionArray = array(

							'division_name' => $post['division'],

						);



						$checkDivision = $this->companyMondel->isExistDivision('*', $insertDivisionArray);

						if ($checkDivision['count'] == 0 && $post['division'] != '') {

							$divisionId = $this->companyMondel->addDivision($insertDivisionArray);

							$insertArray['division'] = $divisionId;
						} else {

							$insertArray['division'] = $checkDivision['result'][0]['division_id'];
						}
					}
				}

				//print_r($post['fk_industry_id']);exit;

				if (is_numeric($post['fk_industry_id'])) {

					$insertArray['fk_industry_id'] = $post['fk_industry_id'];
				} else {

					$insertIndustryArray = array(

						'industry_name' => $post['fk_industry_id'],

					);



					$industryName = $this->companyMondel->isExistIndustry('*', $insertIndustryArray);



					if ($industryName['count'] == 0  && $post['fk_industry_id'] != '') {

						$industryId = $this->companyMondel->addIndustry($insertIndustryArray);

						$insertArray['fk_industry_id'] = $industryId;
					} else {

						if (isset($industryName['result'][0]['industry_id']) && $industryName['result'][0]['industry_id'] != '') {

							$insertArray['fk_industry_id'] = $industryName['result'][0]['industry_id'];
						}
					}
				}



				if (!empty($_FILES["doc_type_file"]['name'])) {

					$insertArray['file'] = $file;

					$insertArray['file_orig_name'] = $file_orig_name;

					$insertArray['file_path'] = $full_path;
				}




				if (!empty($_FILES["company_logo"]['name'])) {

					$insertArray['company_logo_file'] = $company_logo_file;

					$insertArray['company_logo_org_file_name'] = $company_logo_org_file_name;

					$insertArray['company_logo_file_path'] = $company_logo_file_path;
				}
				if (!empty($_FILES["liable_certificate_file"]['name'])) {

					$insertArray['liable_certificate_file'] = $liable_certificate_file;

					$insertArray['liable_certificate_orig_name'] = $liable_certificate_orig_name;

					$insertArray['liable_certificate_file_path'] = $liable_certificate_file_path;
				}


				if (!empty($_FILES["workman_certificate_file"]['name'])) {

					$insertArray['workman_certificate_file'] = $workman_certificate_file;

					$insertArray['workman_certificate_orig_name'] = $workman_certificate_orig_name;

					$insertArray['workman_certificate_file_path'] = $workman_certificate_file_path;
				}

				if (!empty($_FILES["companyProfileFile"]['name'])) {

					$insertArray['company_profile_file'] = $company_profile_file;

					$insertArray['company_profile_orig_name'] = $company_profile_orig_name;

					$insertArray['company_profile_file_path'] = $company_profile_file_path;
				}

				if (!empty($_FILES["companyCatelog"]['name'])) {

					$insertArray['catalog_file'] = $company_catalog_file;

					$insertArray['catalog_orig_name'] = $company_catalog_orig_name;

					$insertArray['catalog_file_path'] = $company_catalog_file_path;
				}



				if (isset($post['permit_access_to_new_job'])) {

					$insertArray['permit_access_to_new_job'] = 'Yes';
				}



				if (isset($post['allow_to_view_information'])) {

					$insertArray['allow_to_view_information'] = 'Yes';
				}



				if (isset($post['allow_to_share_doc'])) {

					$insertArray['allow_to_share_doc'] = 'Yes';
				}



				if (isset($post['allow_to_assign_rfi'])) {

					$insertArray['allow_to_assign_rfi'] = 'Yes';
				}



				if (isset($post['liable_certificate_expires'])) {

					$insertArray['liable_certificate_expires'] = $post['liable_certificate_expires'];
				}



				if (isset($post['liable_certificate_expire_reminder'])) {

					$insertArray['liable_certificate_expire_reminder'] = $post['liable_certificate_expire_reminder'];
				}



				if (isset($post['liable_certificate_expire_reminder_type'])) {

					$insertArray['liable_certificate_expire_reminder_type'] = $post['liable_certificate_expire_reminder_type'];
				}



				if (isset($post['liable_certificate_expire_reminder_value'])) {

					$insertArray['liable_certificate_expire_reminder_value'] = $post['liable_certificate_expire_reminder_value'];
				}



				if (isset($post['workman_certificate_expires'])) {

					$insertArray['workman_certificate_expires'] = $post['workman_certificate_expires'];
				}



				if (isset($post['workman_certificate_expire_reminder'])) {

					$insertArray['workman_certificate_expire_reminder'] = $post['workman_certificate_expire_reminder'];
				}



				if (isset($post['workman_certificate_expire_reminder_type'])) {

					$insertArray['workman_certificate_expire_reminder_type'] = $post['workman_certificate_expire_reminder_type'];
				}



				if (isset($post['workman_certificate_expire_reminder_value'])) {

					$insertArray['workman_certificate_expire_reminder_value'] = $post['workman_certificate_expire_reminder_value'];
				}

				// print_r($insertArray);exit;

				if (!$companyId) {

					$whereCompany = array('company_name' => $post['company_name']);

					$checkCompany = $this->companyMondel->isExistCompany($whereCompany);

					// print_r($checkCompany['count']);

					if ($checkCompany['count'] != 0) {

						$response['error'] = "<div class='alert-danger-2'>

								                    <strong>Alert !</strong><br/><br/>

								                    Company name already exists !

								                </div>";

						$response['code'] = 400;

						$response['message'] = 'exception in insertion';

						echo json_encode($response);

						exit;
					}

					//echo "HIIII";exit;

					$insertArray['vat'] = $vat;

					$insertArray['created_by'] = $this->session->userdata('user_id');

					$insertArray['created_date'] = date('d-m-Y h:i A');

					$insertArray['str_created_date'] = strtotime(date('d-m-Y h:i A'));

					$insertArray['updated_date'] = date('d-m-Y h:i A');

					$insertArray['str_updated_date'] = strtotime(date('d-m-Y h:i A'));
					// print_r($insertArray);exit();
					$data['id'] = $this->companyMondel->insertCompany($insertArray);

					$this->session->set_userdata('setMessage', 'Added');



					$whereNotificationID = array('fk_notification_id' => '1');

					$addCompanyNotification = $this->userModel->getUsersNotification($whereNotificationID);

					$userIDs = json_decode($addCompanyNotification['result'][0]['user_id']);

					$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

					foreach ($getEmailList as $key => $value) {

						$emailList[] = $value['contact_info'];
					}

					if ($addCompanyNotification['count'] == 1) {

						$emailString = implode(',', $emailList);

						$subject = 'Company Added Successfully';

						$module = 'Company';

						$name = $post['company_name'];

						$action = 'added';

						$actionBy = $this->session->userdata('user_name');

						$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
					}
				} else {

					$whereCompany = array('company_name' => $post['company_name']);

					$checkCompany = $this->companyMondel->isExistCompany($whereCompany);

					// print_r($checkCompany['count']);

					if ($checkCompany['count'] != 0 && $checkCompany['result'][0]['company_id'] != $companyId) {

						$response['error'] = "<div class='alert-danger-2'>

								                    <strong>Alert !</strong><br/><br/>

								                    Company name already exists !

								                </div>";

						$response['code'] = 400;

						$response['message'] = 'exception in insertion';

						echo json_encode($response);

						exit;
					}

					$insertArray['vat'] = $vat;

					$insertArray['updated_date'] = date('d-m-Y h:i A');

					$insertArray['str_updated_date'] = strtotime(date('d-m-Y h:i A'));

					$where = array('company_id' => $companyId);
					// print_r($insertArray);
					$data['id'] = $this->companyMondel->updateCompany($insertArray, $where);

					$this->session->set_userdata('setMessage', 'Updated');



					$whereNotificationID = array('fk_notification_id' => '2');

					$editCompanyNotification = $this->userModel->getUsersNotification($whereNotificationID);

					$userIDs = json_decode($editCompanyNotification['result'][0]['user_id']);

					$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

					foreach ($getEmailList as $key => $value) {

						$emailList[] = $value['contact_info'];
					}

					if ($editCompanyNotification['count'] == 1) {

						$emailString = implode(',', $emailList);

						$subject = 'Company Updated Successfully';

						$module = 'Company';

						$name = $post['company_name'];

						$action = 'updated';

						$actionBy = $this->session->userdata('user_name');

						$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
					}
				}



				$response['code'] = 200;

				$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Company Added Successfully.</div>";

				$response['data'] = $data['id'];
			}
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : createCompany Action





	/**

	 * displayForm action of Company controller

	 * @author Bimal Sharma

	 * @param $companyType String company type (internal,supplier,customer)

	 */

	public function displayForm($companyType = 'internal', $id = null)
	{

		try {

			if ($id) {

				$Permission = $this->permission->checkUserPermission(4);
			} else {

				$Permission = $this->permission->checkUserPermission(3);
			}

			if ($Permission) {

				$select = 'c1.company_name,c1.company_id';

				$where = array('c1.company_type' => self::COMPANY_ARRAY[$companyType], 'c1.activity_status' => 'active', 'c1.parent_company_id' => '0');

				$data['parentCompany'] = $this->companyMondel->getCompany($select, $where);



				$data['division'] = $this->companyMondel->getDivision();



				$selectIndustry = 'industry_name';

				$whereIndustry = array('active_status' => 'active');

				$data['industryNames'] = $this->companyMondel->getIndustry($selectIndustry, $whereIndustry);



				$select = 'nicename,phonecode';

				$data['country'] = $this->companyMondel->getCountry($select);



				$data['companyType'] = $companyType;



				$data['value'] = array();

				$data['formheading'] = "Add " . ucfirst($companyType) . " Company";

				if ($id) {

					$select = 'c1.*,i.industry_name as industry_name,c2.company_name as parent_company';

					$where = 'c1.company_id = "' . $id . '"';

					$data['value'] = $this->companyMondel->getCompanyEditForm($select, $where);



					if (is_array($data['value'])) {

						$data['value'] = $data['value'][0];
					}

					//print_r($data['value']);exit;

					$data['formheading'] = "Edit " . ucfirst($companyType) . " Company";
				}



				$data['companyId'] = $id;



				$html = $this->page->getPage('companyForm', $data, true);



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

	public function getCompanies($companyType = 'internal')
	{

		// get method request

		$request = $this->input->get();

		//print_r($request); die;

		$offset = $request['start'];

		$limit = $request['length'];

		$columnArray = $request['columns'];



		// get selected filed

		$fields = $columns = array_column($columnArray, 'data');

		$fields = $this->company->getSelectField($columns);



		// get where field

		$whereFeilds = $this->company->getWhereField($columns);

		// print_r($whereFeilds); die;



		$where = 'c1.company_type = "' . self::COMPANY_ARRAY[$companyType] . '" and c1.activity_status = "active"';

		// print_r($request); die;



		if (!empty($request['search']['value'])) {

			foreach ($whereFeilds as $key => $value) {

				$where .= 'and ' . $value . " Like '%" . $request['search']['value'] . "%'";
			}
		}

		// print_r($where); die;

		// print_r($request['search']['value']); die;



		// add filters

		$isFilter = 'nofilter';

		if (!empty($request['q'])) {

			$isFilter = 'filter';

			$query = json_decode($request['q'], true);

			if ($query) {

				$filter = $this->company->getWhereField(array_keys($query));

				// print_r($filter); die;

				foreach ($filter as $key => $value) {

					if (!empty($query[$key])) {

						$where .= ' and ' . $value . " like '%" . $query[$key] . "%'";
					}
				}
			}
		}

		// print_r($where); die;

		//set order



		$wherepermissions = $this->permission->checkUserPermission(46);

		if ($wherepermissions) {

			$whereUserId = array('fk_user_id' => $this->session->userdata('user_id'));

			$selectPermission = '*';

			$userPermissionList = $this->userModel->getWhoseDataCanView($selectPermission, $whereUserId);

			if (isset($userPermissionList[0]['can_view_company']) && $userPermissionList[0]['can_view_company'] != '') {

				$userArray = json_decode($userPermissionList[0]['can_view_company']);

				array_push($userArray, $this->session->userdata('user_id'));

				$users = implode(',', $userArray);

				//print_r($userPermissionList[0]['can_view_activity']);exit;

				$where .= ' and c1.created_by IN( ' . $users . ')';
			}



			//$where.= ' and lo.fk_sales_people_id = '.$this->session->userdata('user_id');

		} else {

			$where .= ' and c1.created_by IN( ' . $this->session->userdata('user_id') . ')';
		}



		$order = null;

		if (isset($request['order']) && is_array($request['order'])) {

			$order = $columns[$request['order'][0]['column']] . ' ' . $request['order'][0]['dir'];
		}

		//print_r($where); die;

		$companyList = $this->companyMondel->getCompany($fields, $where, $order, $limit, $offset, $isFilter);

		$companycount = $this->companyMondel->getCompany('count(*) as count', $where);



		$data['recordsFiltered'] = $companycount[0]['count'];

		$data['recordsTotal'] = $companycount[0]['count'];

		$data['data'] = $companyList;

		echo json_encode($data);

		// print_r($data['data']); die;

	} // end : getCompanies Action





	/**

	 * get list of copanies	

	 * @author Bimal Sharma

	 * @param $companyType String company type (internal,supplier,customer)

	 */

	public function getCompanyIdentifier($dialing_code)
	{

		$where = array('t2.phonecode' => $dialing_code, 'status' => 'active');

		$companyIdentifierList['list'] = $this->companyMondel->getCompanyIdentifier($where);

		$getIdentifierList = $this->load->view('form/getComapnyIdentifier', $companyIdentifierList);

		return $getIdentifierList;
	} // end : getCompanyIdentifier Action



	/**

	 * This is import a company detail.

	 * @author Sagar Kodalkar

	 * @return excel object

	 */

	public function importData()

	{

		$ExcelHeader = array('Company Name', 'Parent Company', 'Business Contact', 'Street Address', 'City', 'State', 'Country', 'Zip');



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

					'name' => 'company_name',

					'require' => true

				),

				'B' => array(

					'name' => 'parent_company',

					'require' => false

				),

				'C' => array(

					'name' => 'bussiness_contact',

					'require' => true

				),

				'D' => array(

					'name' => 'company_type',

					'require' => true

				),

				'E' => array(

					'name' => 'street_address',

					'require' => true

				),

				'F' => array(

					'name' => 'city',

					'require' => true

				),

				'G' => array(

					'name' => 'state',

					'require' => true

				),

				'H' => array(

					'name' => 'country',

					'require' => true

				),

				'I' => array(

					'name' => 'zip',

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

						'message' => "<b style='color:red'>Invalid Excel! You can not upload company data with this excel<br/> For ideal format please <a href=" . base_url() . "upload/sampleCompany.xls>Click Here</a></b>"

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

				$ParentCompanyId   = 0;

				if (isset($value['parent_company']) && !empty($value['parent_company'])) {

					$parentCompanyDetail = $this->company_model->getParentCompanyByName($value['parent_company']);

					if (!empty($parentCompanyDetail)) {

						$ParentCompanyId = $parentCompanyDetail[0]['company_id'];
					}
				}

				$fax = 0;

				if (isset($value['fax']) && !empty($value['fax'])) {

					$fax = $value['fax'];
				}



				$insertArray = array(

					'company_name' => $value['company_name'],

					'parent_company_id' => $ParentCompanyId,

					'company_type' => self::COMPANY_ARRAY[strtolower($value['company_type'])],

					'bussiness_contact' => $value['bussiness_contact'],

					'street_address' => $value['street_address'],

					'city' => $value['city'],

					'state' => $value['state'],

					'country' => $value['country'],

					'zip_code' => $value['zip'],

					'fax' => $fax,

					'activity_status' => 'active',
					'created_by' => $this->session->userdata('user_id'),
					'created_date' => date('d-m-Y h:i A'),
					'str_created_date' => strtotime(date('d-m-Y h:i A')),

				);

				// print_r($insertArray);exit();
				$importExcelData = $this->companyMondel->insertCompany($insertArray);

				$this->session->set_userdata('setMessage', 'Imported');
			}

			$responceMsg = array(

				'code' => 200,

				'message' => "<b style='color:green'>Company Data Imported Successfully</b>"

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
	} // end : importData function



	/**

	 * This is export a company detail.

	 * @author Sagar Kodalkar

	 * @return excel object

	 */

	public function createExcel($companyType = null, $list = '')
	{

		$filename = ucfirst($companyType) . "-Companies-" . str_replace('-', '', date('d-M-Y'));

		header('Content-Disposition: attachment; filename="' . $filename . '.csv";');

		header('Content-Type: application/csv');



		$columnArray = $this->company->getCompanyColumn();

		unset($columnArray[0]);

		//print_r($columnArray);exit;

		$fields = $columns = array_column($columnArray, 'data');

		// print_r($fields);

		/*foreach ($fields as $key => $value) {

        	// echo $value;

        	$title[]=str_replace('_', ' ', $value);

        	# code...

        }*/

		$companyIdList = '';

		if ($list != '') {

			$list = str_replace('%20', '', $list);

			$companyIdList = explode('_', $list);
		}

		$title =  array_column($columnArray, 'data');

		$fields = $this->company->getSelectField($columns);

		// get where field

		$whereFeilds = $this->company->getWhereField($columns);



		if ($companyType) {

			$where = 'c1.company_type = "' . self::COMPANY_ARRAY[$companyType] . '" and c1.activity_status = "active"';
		}



		$companyList = $this->companyMondel->getCompanyExcel($fields, $where, $companyIdList);

		// print_r($companyList);exit();



		$f = fopen("php://output", "w");

		// unset($title[0]);

		fputcsv($f, $title);

		foreach ($companyList as $company) {

			fputcsv($f, $company);
		}

		fpassthru($f);
	}



	function result($companyType)
	{

		$where = null;

		$postData = $this->session->userdata('filterData');;

		$company_type = $companyType;



		//if(!empty($postData)) {

		if (isset($postData['company_name']) && !empty($postData['company_name'])) {

			$where['t1.company_name'] = $postData['company_name'];

			$data['company_name'] = $postData['company_name'];
		}



		if (isset($postData['company_type']) && !empty($postData['company_type'])) {

			$where['t1.company_type'] = $postData['company_type'];

			$data['company_type'] = $postData['company_type'];
		}



		if (isset($postData['parent_company_id']) && !empty($postData['parent_company_id'])) {

			$where['t1.parent_company_id'] = $postData['parent_company_id'];

			$data['parent_company_id'] = $postData['parent_company_id'];
		}



		if (isset($postData['bussiness_contact']) && !empty($postData['bussiness_contact'])) {

			$where['t1.bussiness_contact'] = $postData['bussiness_contact'];

			$data['bussiness_contact'] = $postData['bussiness_contact'];
		}



		if (isset($postData['city']) && !empty($postData['city'])) {

			$where['t1.city'] = $postData['city'];

			$data['city'] = $postData['city'];
		}



		if (isset($postData['state']) && !empty($postData['state'])) {

			$where['t1.state'] = $postData['state'];

			$data['state'] = $postData['state'];
		}



		if (isset($postData['country']) && !empty($postData['country'])) {

			$where['t1.country'] = $postData['country'];

			$data['country'] = $postData['country'];
		}



		$data['value'] = json_encode($this->companyMondel->getCompanyList($where, $company_type));



		//          $select = 'company_name,company_id';

		// $where2 = array('company_type' => self::COMPANY_ARRAY[$company_type], 'activity_status' => 'active');

		// $data['data'] = json_encode($this->companyMondel->getCompany($select,$where2));



		//          $select = 'nicename,phonecode';

		// $data['country'] = $this->companyMondel->getCountry($select);

		//          //$data['getFilter'] = $this->company_model->getFilter();

		//          $data['action'] = base_url().'company/importData';

		//          $data['redirectAction'] = $company_type;



		// $data['contain'] = 'company';

		// $data['companyType'] = $company_type;

		//return $data;

		//}



	}



	public function createGrid($gridId = null)
	{

		try {

			$data = [];

			$data['options'] = array();

			$data['columns'] = array();

			$module_name = $this->uri->segment(1);

			$selectedColumns = $this->input->post();

			// var_dump($selectedColumns); die;

			$column = $arrayField = $this->company->getCompanyColumn();

			$data['columns'] = $column;

			if (!empty($selectedColumns)) {

				$arrayField = array();

				array_push($arrayField, $column[0]);

				foreach ($selectedColumns['internal'] as $key => $value) {

					array_push($arrayField, $column[$value]);
				}
			} else if ($gridId) {

				$grid_columns = $this->companyMondel->getGrid('grid_columns', array('grid_id' => $gridId));

				if (!empty($grid_columns)) {

					$arrayField = json_decode($grid_columns[0]['grid_columns']);
				}
			}



			if (isset($selectedColumns['ischeck'])) {

				$columns['grid_columns'] = json_encode($arrayField);

				$columns['grid_name'] = $selectedColumns['saveGrid'];

				$columns['module_name'] = $module_name;

				$this->companyMondel->insertGrid($columns);
			}

			$data['columns'] = $arrayField;

			$data['options'] = $this->companyMondel->getGrid('*', array('module_name' => $module_name));

			$data['gridId'] = $gridId;

			$response['code'] = 200;

			$response['message'] = 'Grid created successfully';

			$response['data'] = $data;
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : createGrid Action



	public function deleteCompany()
	{

		$DeleteId = $this->input->post();

		$newUsrId = explode(',', $DeleteId['deleteThis']);

		$deleteUpdateData = array('activity_status' => 'inactive');

		$DeletedUser = $this->companyMondel->deleteCompany($deleteUpdateData, $newUsrId);

		if ($DeletedUser) {

			$this->session->set_userdata('setMessage', 'deleted');



			$whereNotificationID = array('fk_notification_id' => '3');

			$deleteCompanyNotification = $this->userModel->getUsersNotification($whereNotificationID);

			$userIDs = json_decode($deleteCompanyNotification['result'][0]['user_id']);

			$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

			foreach ($getEmailList as $key => $value) {

				$emailList[] = $value['contact_info'];
			}



			foreach ($newUsrId as $userKey => $userValue) {

				$where = array('company_id' => $userValue);

				$getUserdetails = $this->companyMondel->getCompanyDetails($where);

				if ($deleteCompanyNotification['count'] == 1) {

					$emailString = implode(',', $emailList);

					$subject = 'Company Deleted Successfully';

					$module = 'Company';

					$name = $getUserdetails['result'][0]['company_name'];

					$action = 'deleted';

					$actionBy = $this->session->userdata('user_name');

					$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
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

		$getuserData = $this->companyMondel->getEmailId($select, $newUsrId);

		// print_r($getuserData); die;

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





			$this->email->from('email@specxnet.com', 'Hozpitality CRM');

			$this->email->to($to);

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



			//        	} else {

			//        		$response['code'] = 404;

			// $response['message'] = 'Failure';

			//        	}



		} catch (Exception $E) {

			$response['code'] = 500;

			$respgonse['message'] = 'Failure';
		}

		echo json_encode($response);

		// }

	}



	// */

	public function savefilter()
	{

		try {

			$post = $this->input->post();



			$test = json_encode($post);





			$insertArray = array(

				'filter_name' => $post['filterName'],

				'filter_values' => $test,

				'module' => 'Company'

			);

			// print_r($insertArray);

			// die;

			$data['id'] = $this->companyMondel->createFilter($insertArray);

			//print_r($insertArray);exit;





			$response['code'] = 200;

			$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Filter Saved Successfully.</div>";

			$response['data'] = $data['id'];
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = "<div class='alert alert-danger'>

	                    <strong>Oops!</strong> Something went wrong.</div>";

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : createCompany Action



	public function deleteAttachFile()
	{

		$post = $this->input->post();

		$company_id = $post['company_id'];

		$select = 'file_path';

		$whereCompanyId = array('company_id' => $company_id);

		$getPath = $this->companyMondel->getFilePath($select, $whereCompanyId);

		unlink($getPath[0]['file_path']);

		$updateArray = array(

			'file' => '',

			'file_orig_name' => '',

			'file_path' => '',

		);

		$where = array('company_id' => $company_id);

		$companyIdentifierList['list'] = $this->companyMondel->deleteAttachFile($updateArray, $where);

		$companyIdentifierList['value'] = 'file';

		$getIdentifierList = $this->load->view('form/getComapnyIdentifierFile', $companyIdentifierList);

		return $getIdentifierList;
	}



	public function deleteAttachLiabilityFile()
	{

		$post = $this->input->post();

		$company_id = $post['company_id'];

		$select = 'liable_certificate_file_path';

		$whereCompanyId = array('company_id' => $company_id);

		$getPath = $this->companyMondel->getFilePath($select, $whereCompanyId);

		unlink($getPath[0]['liable_certificate_file_path']);

		$updateArray = array(

			'liable_certificate_file' => '',

			'liable_certificate_orig_name' => '',

			'liable_certificate_file_path' => '',

		);

		$where = array('company_id' => $company_id);

		$companyIdentifierList['list'] = $this->companyMondel->deleteAttachFile($updateArray, $where);

		$companyIdentifierList['value'] = 'liability';

		$getIdentifierList = $this->load->view('form/getComapnyIdentifierFile', $companyIdentifierList);

		return $getIdentifierList;
	}



	public function deleteAttachWorkmanFile()
	{

		$post = $this->input->post();

		$company_id = $post['company_id'];

		$select = 'workman_certificate_file_path';

		$whereCompanyId = array('company_id' => $company_id);

		$getPath = $this->companyMondel->getFilePath($select, $whereCompanyId);

		unlink($getPath[0]['workman_certificate_file_path']);

		$updateArray = array(

			'workman_certificate_file' => '',

			'workman_certificate_orig_name' => '',

			'workman_certificate_file_path' => '',

		);

		$where = array('company_id' => $company_id);

		$companyIdentifierList['list'] = $this->companyMondel->deleteAttachFile($updateArray, $where);

		$companyIdentifierList['value'] = 'workman';

		$getIdentifierList = $this->load->view('form/getComapnyIdentifierFile', $companyIdentifierList);

		return $getIdentifierList;
	}

	public function deleteAttachCompanyProfileFile()
	{

		$post = $this->input->post();

		$company_id = $post['company_id'];

		$select = 'company_profile_file_path';

		$whereCompanyId = array('company_id' => $company_id);

		$getPath = $this->companyMondel->getFilePath($select, $whereCompanyId);

		unlink($getPath[0]['company_profile_file_path']);

		$updateArray = array(

			'company_profile_file' => '',

			'company_profile_orig_name' => '',

			'company_profile_file_path' => '',

		);

		$where = array('company_id' => $company_id);

		$companyIdentifierList['list'] = $this->companyMondel->deleteAttachFile($updateArray, $where);

		$companyIdentifierList['value'] = 'comapny profile';

		$getIdentifierList = $this->load->view('form/getComapnyIdentifierFile', $companyIdentifierList);

		return $getIdentifierList;
	}

	public function deleteCatalogFile()
	{

		$post = $this->input->post();

		$company_id = $post['company_id'];

		$select = 'catalog_file_path';

		$whereCompanyId = array('company_id' => $company_id);

		$getPath = $this->companyMondel->getFilePath($select, $whereCompanyId);

		unlink($getPath[0]['catalog_file_path']);

		$updateArray = array(

			'catalog_file' => '',

			'catalog_orig_name' => '',

			'catalog_file_path' => '',

		);

		$where = array('company_id' => $company_id);

		$companyIdentifierList['list'] = $this->companyMondel->deleteAttachFile($updateArray, $where);

		$companyIdentifierList['value'] = 'catalog';

		$getIdentifierList = $this->load->view('form/getComapnyIdentifierFile', $companyIdentifierList);

		return $getIdentifierList;
	}



	public function getSavedFilterDropdown()
	{

		$post = $this->input->post();

		$wheremodule = array('module' => 'Company');

		$getPath['filterData'] = $this->companyMondel->getFilterDropdown($wheremodule);

		$getIdentifierList = $this->load->view('form/getFilterDropdown', $getPath);

		return $getIdentifierList;
	}



	public function getDivision()
	{

		$post = $this->input->post();



		$data['division'] = $this->companyMondel->getDivision();



		$data['value'] = $post['value'];

		$getIdentifierList = $this->load->view('form/getDivision', $data);

		return $getIdentifierList;
	}



	public function getIndustry()
	{

		$post = $this->input->post();



		$selectIndustry = 'industry_id,industry_name';

		$whereIndustry = array('active_status' => 'active');

		$data['industry'] = $this->companyMondel->getIndustry($selectIndustry, $whereIndustry);



		$data['value'] = $post['value'];

		$getIdentifierList = $this->load->view('form/getIndustry', $data);

		return $getIdentifierList;
	}



	public function myProfileForm($id = null)
	{

		try {

			// if ($id) {

			// 	$Permission = $this->permission->checkUserPermission(4);

			// } else {

			// 	$Permission = $this->permission->checkUserPermission(3);

			// }

			// if ($Permission) {

			$select = '*';

			$where = array('fk_user_id' => $id);

			$preferences = $this->userModel->getUserPreferences($select, $where);

			foreach ($preferences as $key => $value) {

				if (isset($preferences[$key]['password']) && $preferences[$key]['password'] != '') {

					$decrypted = $this->my_simple_crypt($preferences[$key]['password'], 'd');

					$preferences[$key]['password'] = $decrypted;
				}
			}



			$data['data'] = $preferences;

			$data['value'] = array();

			$data['formheading'] = $this->session->userdata('user_name');



			$data['fk_user_id'] = $id;



			$html = $this->page->getPage('myProfileForm', $data, true);



			$response['code'] = 200;

			$response['message'] = 'form generated';

			$response['data']['html'] = $html;

			$response['data']['heading'] = $data['formheading'];

			// } else {

			// 	$data['formheading'] = 'No Permissions Access';

			// 	$response['code'] = 404;

			// 	$response['message'] = 'PAGE NOT FOUND';

			// 	$response['data']['html'] = null;

			// 	$response['data']['heading'] = $data['formheading'];

			// }





		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();
		}



		echo json_encode($response);

		exit;
	} // end : displayForm Action



	public function my_simple_crypt($string, $action = 'e')
	{

		// you may change these values to your own

		$secret_key = 'preferencesKey';

		$secret_iv = 'preferencesIV';



		$output = false;

		$encrypt_method = "AES-256-CBC";

		$key = hash('sha256', $secret_key);

		$iv = substr(hash('sha256', $secret_iv), 0, 16);



		if ($action == 'e') {

			$output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
		} else if ($action == 'd') {

			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}



		return $output;
	}



	public function createMyProfile($userID = null)
	{

		try {

			$post = $this->input->post();

			// print_r($post);exit;

			$password = $this->my_simple_crypt($post['password'], 'e');



			$insertUserPreferencesArray = array(

				'fk_user_id' => $userID,

				'email_id' => $post['email_id'],

				'password' => $password,

				'message_signature' => $post['message_signature'],

			);

			if (isset($file_orig_name) && $file_orig_name != '') {

				$insertUserPreferencesArray['file'] = $file;

				$insertUserPreferencesArray['file_orig_name'] = $file_orig_name;

				$insertUserPreferencesArray['file_path'] = $file_path;
			}

			// print_r($insertRoleArray); die;



			$wherePreferences = array('fk_user_id' => $userID);

			$countId = $this->userModel->checkUserPreferencesExist($wherePreferences);

			if ($countId == 0) {

				$rpn_id = $this->userModel->insertUserPreferences($insertUserPreferencesArray);

				$response['code'] = 200;

				$response['message'] = "<div class='alert alert-success'>

		                    <strong>Success!</strong> Profile Added Successfully.</div>";
			} else {

				$this->userModel->updateUserPreferences($insertUserPreferencesArray, $wherePreferences);

				$response['code'] = 200;

				$response['message'] = "<div class='alert alert-success'>

		                    <strong>Success!</strong> Profile Updated Successfully.</div>";
			}





			// $response['data']['heading'] = $data['formheading'];

		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	}
}
