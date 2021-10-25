<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Rfq extends CI_Controller
{
	/**
	 * RFQ Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://DomainName/rfq
	 *
	 * @author Sagar Kodalkar
	 */

	public function __construct()
	{
		parent::__construct();
		$user_id = $this->session->userdata('user_id');
		if (!isset($user_id) || $user_id == '') {
			$this->session->sess_destroy();
			redirect('login');
		}

		$this->load->model(array('Rfq_model' => 'rfqModel'));
		$this->load->library(array('Rfq_library' => 'rfq'));
		$this->load->model(array('User_model' => 'userModel'));
		$this->load->library(array('Permissions_library' => 'permission'));
		$this->load->model(array('Company_model' => 'company'));
	}


	/**
	 * index action of RFQ controller
	 * @author Sagar Kodalkar
	 */

	public function index()
	{
		$permissions = $this->permission->checkUserPermission(26);
		if (!$permissions) {
			redirect('page_not_found');
			exit;
		}

		// set title
		$this->page->setTitle('RFQ');
		// set head style
		$this->page->setHeadStyle(base_url() . "assets/vendors/base/vendors.bundle.css");
		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style.bundle.css");
		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style-2.css");
		$this->page->setHeadStyle(base_url() . "assets/custom/css/style.css");
		$this->page->setHeadStyle("//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css");
		// $this->page->setHeadStyle("//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css");
		$this->page->setHeadStyle("https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");
		$this->page->setHeadStyle("https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css");
		$this->page->setHeadStyle(base_url() . "assets/custom/Editor/css/editor.dataTables.min.css");
		// select 2
		$this->page->setHeadStyle(base_url() . "assets/select2/dist/css/select2.min.css");
		$this->page->setHeadStyle("//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css");
		// $this->page->setHeadStyle("https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css");
		//set footer js
		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");
		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");
		$this->page->setFooterJs(base_url() . "assets/vendors/base/vendors.bundle.js");
		$this->page->setFooterJs(base_url() . "assets/demo/default/base/scripts.bundle.js");
		$this->page->setFooterJs("https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js");
		$this->page->setFooterJs("https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js");
		$this->page->setHeadStyle(base_url() . "assets/custom/Editor/js/dataTables.editor.min.js");
		// $this->page->setFooterJs("https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js");
		$this->page->setFooterJs(base_url() . "assets/custom/js/ajax.js");
		$this->page->setFooterJs(base_url() . "assets/custom/js/rfq.js");
		$this->page->setFooterJs(base_url() . "assets/custom/js/custom.js");
		$this->page->setFooterJs(base_url() . "assets/app/js/datepicker.js");
		$this->page->setFooterJs(base_url() . "assets/custom/js/datatable.js");
		$this->page->setFooterJs(base_url() . "assets/custom/js/datatable2.js");
		// text editor js
		$this->page->setFooterJs(base_url() . "assets/ckeditor/ckeditor.js");
		// Select 2
		$this->page->setFooterJs(base_url() . "assets/select2/dist/js/select2.full.min.js");
		$this->page->setFooterJs("//momentjs.com/downloads/moment.js");
		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js");
		// $this->page->setFooterJs(base_url()."assets/custom/js/bootstrap-multiselect.js");
		//$this->page->setFooterJs(base_url()."assets/custom/js/autocomplete.js");
		$page['getFilterData'] = '';
		if (isset($_POST) && !empty($_POST)) {
			$page['getFilterData'] = $this->input->post();
			//print_r($this->input->post());exit;
			if (isset($page['getFilterData']['approval_deadline'])) {
				$filter_date = $page['getFilterData']['approval_deadline'];
			}
			// $page['getFilterData']['approval_deadline']=date("m-d-Y", strtotime($filter_date));
			$page['getFilterData'] = $page['getFilterData'];
		}

		if (isset($page['getFilterData']['saved_filter_id'])) {
			$page['savedfilterID'] = $page['getFilterData']['saved_filter_id'];
		}
		// load layout
		$page['contain'] = 'rfq';
		//List Parent Companies
		// $select2 = 't1.*, t2.company_name as parent_company';
		// $where = array('t1.company_type' => self::COMPANY_ARRAY[$companyType], 't1.activity_status' => 'active');
		// $page['parentCompany'] = $this->rfqModel->getCompany($select2,$where);
		//print_r($page['parentCompany']);exit;
		//List Countries
		// $select = 'nicename,phonecode';
		// $page['country'] = $this->rfqModel->getCountry($select);
		$page['redirectAction'] = '';
		$page['importAction'] = base_url() . 'rfq/importData';
		//-- get sales person--
		$select = "u.user_id, CONCAT (u.first_name,' ',u.last_name) AS name";
		$where = array('u.active_status' => 'active');
		// $page['getSalesperson'] = $this->rfqModel->getSalesperson($select, $where);
		// -- Get Saved Filter
		$select2 = "filter_id, filter_name, filter_values";
		$where2 = array('module' => 'rfq');
		$page['getSavedFilter'] = $this->rfqModel->getSavedFilter($select2, $where2);
		$page['config'] = $this->rfq->getConfig();
		$page['tabs'] = $this->rfq->getTabs();
		$page['action'] = $this->rfq->getAction();
		$page['rfqColumn'] = $this->rfq->getRfqColumn();
		$page['checkedAction'] = $this->rfq->getCheckedAction();
		$page['module_name'] = $this->uri->segment(1);
		$page['gridView'] = $this->rfqModel->getGrid('*', array('module_name' => $page['module_name']));
		$page['access'] = $this->session->userdata('adminAccess');
		// print_r($this->session->userdata());
		// print_r($page);exit();
		$page['addPermission'] = $this->permission->checkUserPermission(27);
		$page['editPermission'] = $this->permission->checkUserPermission(28);
		$page['deletePermission'] = $this->permission->checkUserPermission(29);
		$page['showOpportunity'] = $this->permission->checkUserPermission(17);
		$page['showActivity'] = $this->permission->checkUserPermission(22);
		$page['showActivityCalendar'] = $this->permission->checkUserPermission(17);
		$page['showRFQ'] = $this->permission->checkUserPermission(26);
		$page['showProposal'] = $this->permission->checkUserPermission(31);
		$page['showJobs'] = $this->permission->checkUserPermission(36);
		$page['showReleasePO'] = $this->permission->checkUserPermission(47);
		$page['showReleaseInvoice'] = $this->permission->checkUserPermission(48);
		$this->page->getLayout($page);
	} // end : index Action

	/**
	 * addrfq action to Add part Data from rfq
	 * @author Sagar Kodalkar
	 */
	public function addrfq()
	{
		/*print "<pre>";
		print_r($_POST);die;*/
		try {
			$post = $this->input->post();
			// print_r($post);
			$fileError = false;
			//Validation on input start
			$this->load->library('form_validation');
			$this->form_validation->set_rules('lead_opportunity_id', 'Lead Opportunity', 'required|numeric');
			$this->form_validation->set_rules('approval_deadline', 'Approval Deadline', 'required');
			if (isset($post['fk_b_id'])  && $post['fk_b_id'] == "") {
				$this->form_validation->set_rules('projectName', 'Project Name', 'required');
				$this->form_validation->set_rules('internalCompany', 'Internal Company Name', 'required');
				$this->form_validation->set_rules('company', 'Company Name', 'required');
			}
			// $this->form_validation->set_rules('projectName', 'Project Name', 'required');
			// $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
			if (isset($post['notes']) && $post['notes'] != '') {
				$this->form_validation->set_rules('notes', 'Notes', 'required');
			}
			// print_r($fileError);
			if ($this->form_validation->run() == FALSE) {
				$response['error'] = "<div class='alert-danger-2'>
	                    <strong>Alert !</strong><br/><br/>" .
					validation_errors() .
					"</div>";
			} else if ($fileError) {
				$response['error'] = "<div class='alert-danger-2'>
	                    <strong>Alert !</strong><br/><br/>" .
					validation_errors() .
					"</div>";
			} else {
				
				/// code for Multiple Attachment doc
				$config['upload_path'] = './upload/addItemImages/';
				$config['allowed_types'] = '*';
				// print_r($_FILES);
				$files = $_FILES;
				if (!empty($_FILES["attachment"])) {
					for ($i = 0; $i < count($files["attachment"]['name']); $i++) {
						$image_name = time() . str_replace(' ', '_', $files["attachment"]['name'][$i]);
						$post['attachment'][] = $image_name;
						$_FILES['attachment']['name'] = $image_name;
						$_FILES['attachment']['type'] = $files['attachment']['type'][$i];
						$_FILES['attachment']['tmp_name'] = $files['attachment']['tmp_name'][$i];
						$_FILES['attachment']['error'] = $files['attachment']['error'][$i];
						$_FILES['attachment']['size'] = $files['attachment']['size'][$i];
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('attachment')) {
							$error = array('error' => $this->upload->display_errors());
							$this->load->view('upload_form', $error);
						}
					}
				}
				if (!empty($_FILES["imageAttachment"])) {
					for ($i = 0; $i < count($files["imageAttachment"]['name']); $i++) {
						$image_name = time() . str_replace(' ', '_', $files["imageAttachment"]['name'][$i]);
						$post['imageAttachment'][] = $image_name;
						$_FILES['imageAttachment']['name'] = $image_name;
						$_FILES['imageAttachment']['type'] = $files['imageAttachment']['type'][$i];
						$_FILES['imageAttachment']['tmp_name'] = $files['imageAttachment']['tmp_name'][$i];
						$_FILES['imageAttachment']['error'] = $files['imageAttachment']['error'][$i];
						$_FILES['imageAttachment']['size'] = $files['imageAttachment']['size'][$i];
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('imageAttachment')) {
							$error = array('error' => $this->upload->display_errors());
							$this->load->view('upload_form', $error);
						}
					}
				}
				$select = "CONCAT ('RFQ for ', lo.opportunity_title, '(', c.company_name, ')') AS name";
				$where = array('lo.lead_opportunity_id' => $post['lead_opportunity_id']);
				$getCompanyLeadOpp = $this->rfqModel->getCompanyLeadOpp($select, $where);
				$select = "count(title) AS totalcount";
				$getCountOfExistingLead = $this->rfqModel->getCountOfExistingLead($select, $getCompanyLeadOpp[0]['name']);
				$totalCount = $getCountOfExistingLead[0]['totalcount'] + 1;
				if ($getCountOfExistingLead[0]['totalcount'] != 0) {
					$title = $getCompanyLeadOpp[0]['name'] . "(" . $totalCount . ")";
				} else {
					$title = $getCompanyLeadOpp[0]['name'];
				}
				if ($post['approval_deadline']) {
					$approval_deadline = date("Y-m-d H:i:s", strtotime($post['approval_deadline']));
				} else {
					$approval_deadline = "";
				}
				if (isset($post['fk_b_id']) && $post['fk_b_id'] == "") {
					$insertArray = array(
						'title' => $title,
						'fk_lead_opportunity_id' => $post['lead_opportunity_id'],
						'approval_deadline' => $approval_deadline,
						'supplier' => $post['supplier_id'],
						'markup_type' => '', // need to remove
						'notes' => $post['notes'],
						'status' => 'Processing',
						'project_name' => $post['projectName'],
						'company_id' => $post['company'],
						'internal_company_id' => $post['internalCompany']
					);
				} else {
					$insertArray = array(
						'title' => $title,
						'fk_lead_opportunity_id' => $post['lead_opportunity_id'],
						'project_name' => $post['projectName'],
						'approval_deadline' => $approval_deadline,
						'supplier' => $post['supplier_id'],
						'markup_type' => '', // need to remove
						'notes' => $post['notes'],
						'company_id' => $post['company'],
						'internal_company_id' => $post['internalCompany']
					);
				}
				if (isset($post['markup_type_value_ex_factory']) && $post['markup_type_value_ex_factory'] != '') {
					$insertArray['markup_type_value_ex_factory'] = $post['markup_type_value_ex_factory'];
				}
				if (isset($post['markup_type_value_fabric']) && $post['markup_type_value_fabric'] != '') {
					$insertArray['markup_type_value_fabric'] = $post['markup_type_value_fabric'];
				}
				if (isset($post['markup_type_value_leather']) && $post['markup_type_value_leather'] != '') {
					$insertArray['markup_type_value_leather'] = $post['markup_type_value_leather'];
				}
				// print_r($post);
				// print_r($insertArray);exit();
				if (!isset($post['fk_b_id'])) {
					// echo"case1";
					$data['id'] = $this->rfqModel->insertRfq($insertArray);
					$add_P_id = array(
						'fk_b_id' => $data['id'],
					);
					$data['itemId'] = $this->rfqModel->insertIdRfqWorksheet($add_P_id);
					// exit();
					$this->session->set_userdata('setMessage', 'Added');
					// $whereNotificationID = array('fk_notification_id' => '15');
					// $addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);
					// $userIDs = json_decode($addLeadNotification['result'][0]['user_id']);
					//      	$getEmailList = $this->userModel->getUserEmail('*',$userIDs);
					//      	foreach ($getEmailList as $key => $value) {
					//       	$emailList[] = $value['contact_info'];
					//       }
					if (isset($addLeadNotification) && $addLeadNotification['count'] == 1) {
						$emailString = implode(',', $emailList);
						$subject = 'RFQ Added Successfully';
						$module = 'RFQ for';
						$name = $title;
						$action = 'added';
						$actionBy = $this->session->userdata('user_name');
						$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
					}
				} else {
					// echo "case2";
					// print_r($insertArray);exit();

					$where = array('b_id' => $post['fk_b_id']);
					$data['itemId'] = $post['fk_b_id'];
					$this->rfqModel->updateRFQ($insertArray, $where);
					$data['id'] = $post['fk_b_id'];
					// $data['id'] = $this->rfqModel->updateCompany($insertArray, $where);

					// print_r($data['id']);exit;

					$this->session->set_userdata('setMessage', 'Updated');
				}
				// print_r($post);
				if (isset($post['attachment']) && !empty($post['attachment'])) {

					foreach ($post['attachment'] as $key => $value) {

						$insertArray = array(

							'name' => $value,

							'type' => 'attachment',

							'fk_bid_id' => $data['id']

						);

						$this->rfqModel->bidDocumentUpload($insertArray);
					}
				}



				if (isset($post['imageAttachment']) && !empty($post['imageAttachment'])) {

					foreach ($post['imageAttachment'] as $key => $value) {

						$insertArray = array(

							'name' => $value,

							'type' => 'imageAttachment',

							'fk_bid_id' => $data['id']

						);

						$this->rfqModel->bidDocumentUpload($insertArray);
					}
				}


				// exit();
				$response['code'] = 200;

				// $response['message'] = "<div class='alert alert-success'>

				//                  <strong>Success!</strong> Company Added Successfully.</div>";

				$response['data'] = $data['id'];

				$response['itemId'] = $data['itemId'];
			}
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
			
		}

		echo json_encode($response);
	} // end : createCompany Action

	/*public function updaterfq()

	{

		$post = $this->input->post();

		$where = array('b_id' => $post['b_id']);

		print_r($insertArray);die;

		$data['id'] = $this->rfqModel->updaterfq($insertArray,$where);

	}*/



	public function getLeadCompany()
	{

		try {

			$keyword = strval($_POST['query']);

			$select = "CONCAT (lo.`opportunity_title`, '-', c.company_name) AS name";

			$where = array('lo.opportunity_title' => $keyword);

			$autocomplete = true;



			$getCompanyLeadOpp = $this->rfqModel->getCompanyLeadOpp($select, $where, $autocomplete);



			echo json_encode($countryResult);
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : createCompany Action



	public function displayForm($id = null, $pw_id = null)
	{

		try {



			if ($id) {

				$Permission = $this->permission->checkUserPermission(28);
			} else {

				$Permission = $this->permission->checkUserPermission(27);
			}

			if ($Permission) {

				$select5 = '*';

				$where5 = array('activity_status' => 'active');

				$data['leadOpp'] = $this->rfqModel->getLeadOpportunities($select5, $where5);



				$select4 = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS supplier_people, u.fk_company_id,c.company_name";

				$where4 = array('u.active_status' => 'active', 'u.user_type' => 'Suppliers');

				$data['supplier'] = $this->rfqModel->getSupplierList($select4, $where4);

				// print_r($data['supplier']);die;

				// $data['companyType'] = $companyType;



				$data['value'] = array();

				$data['formheading'] = "Add RFQ";

				if ($id) {

					$data['formheading'] = "Edit RFQ";

					$select = "b.*, bw.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS supplier_id, markup_type, markup_type_value_ex_factory,markup_type_value_fabric,markup_type_value_leather";

					$where = array('b.b_id' => $id);

					//$where = 'p.p_id = "'.$id.'"';

					$join = true;

					$data['value'] = $this->rfqModel->getRfqlist($select, $where, $join);

					// print_r($data['value']);exit;

					if (is_array($data['value'])) {

						$data['value'] = $data['value'][0];
					}

					$data['attachment'] = $this->rfqModel->getRFQDoc(array('fk_bid_id' => $id));

					$select2 = "bw.bw_id, bw.item_name, bw.id_code";

					if ($pw_id) {

						$where2 = array('bw.bw_id' => $pw_id);
					} else {

						$where2 = array('bw.fk_b_id' => $id);
					}

					$data['getItemList'] = $this->rfqModel->getItemList($select2, $where2);

					$select3 = "bf.*";

					$where3 = array('bf.fk_b_id' => $id);

					$data['getFormat'] = $this->rfqModel->getFormat($select3, $where3);
				}


				$select4 = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS supplier_people, u.fk_company_id,c.company_name,c.company_id";

				$where4 = array('u.active_status' => 'active', 'u.user_type' => 'Customer');

				$data['company'] = $this->rfqModel->getSupplierList($select4, $where4);
				// print_r($data['company']);
				// $data['company'] = $this->company->getCompany("c1.company_id,c1.company_name", array('c1.company_type' => 'Customer Contact', 'c1.activity_status' => 'active'));

				$data['internalcompany'] = $this->company->getCompany("c1.company_id,c1.company_name", array('c1.company_type' => 'Internal', 'c1.activity_status' => 'active'));

				$data['b_id'] = $id;

				$data['redirectAction'] = '';

				$data['importAction'] = base_url() . 'rfq/importData';



				$html = $this->page->getPage('rfqForm', $data, true);





				$response['code'] = 200;

				$response['message'] = 'form generated';

				$response['data']['html'] = $html;

				$response['data']['heading'] = $data['formheading'];

				//$response['data']['editor'] = ['notes'];

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



	public function displayResponses($bid = null)
	{



		try {



			$whereRFQID = array('b_id' => $bid);

			$title = $this->rfqModel->getRFQDetails($whereRFQID);

			$data['title'] = $title[0]['title'];

			$data['approval_deadline'] = $title[0]['approval_deadline'];

			$data['created_date'] = $title[0]['created_date'];

			$data['b_id'] = $bid;





			$bidUserList = $this->rfqModel->getRFQBidUserList($whereRFQID);

			//print_r($bidUserList);exit;

			foreach ($bidUserList as $key => $value) {

				$whereRFQUSerID = array('b_id' => $bid, 'fk_user_id' => $value['fk_user_id']);

				$data['bid_list'][] = $this->rfqModel->getRFQBidList($whereRFQUSerID);
			}



			$data['formheading'] = "Bid Packages";



			$html = $this->page->getPage('responseTable', $data, true);





			$response['code'] = 200;

			$response['message'] = 'form generated';

			$response['data']['html'] = $html;

			$response['data']['heading'] = $data['formheading'];

			//$response['data']['editor'] = ['notes'];



		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();
		}



		echo json_encode($response);

		exit;
	} // end : displayForm Action



	public function rfqApproval($bid = null)
	{



		try {



			$data['b_id'] = $bid;

			$html = $this->page->getPage('approveRFQForm', $data, true);



			$response['code'] = 200;

			$response['message'] = 'form generated';

			$response['data']['html'] = $html;

			//$response['data']['editor'] = ['notes'];



		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();
		}



		echo json_encode($response);

		exit;
	} // end : displayForm Action



	public function getItem($var = null)
	{

		$select = "item_name,id_code";

		$data['value'] = $this->rfqModel->getRfqlistdemo($select);

		if (is_array($data['value'])) {

			$data['value'] = $data['value'][0];
		}

		//print_r($data['value']);exit;

		$json_data = array(

			"recordsTotal"    => intval('1'),

			"recordsFiltered" => intval('1'),

			"data"            => $data['value']

		);



		echo json_encode($json_data);
	} // end : displayForm Action



	/**

	 * get list of copanies

	 * @author Bimal Sharma

	 * @param $companyType String company type (internal,supplier,customer)

	 */

	public function getRfq()
	{
		$request = $this->input->get();

		// print_r($request);exit;

		$offset = $request['start'];

		$limit = $request['length'];

		$columnArray = $request['columns'];

		$columns = array_column($columnArray, 'data');

		$order = null;

		if (array_key_exists("q", $request) && !empty(json_decode($request['q']))) {

		
			$requestNew = json_decode($request['q']);

			if (isset($requestNew->lead_opportunity) && !empty($requestNew->lead_opportunity)) {

				$where['lo.opportunity_title'] = $requestNew->lead_opportunity;

				$data['opportunity_title'] = $requestNew->lead_opportunity;
			}



			if (isset($requestNew->status) && !empty($requestNew->status)) {

				$where['b.status'] = $requestNew->status;

				$data['status'] = $requestNew->status;
			}



			if (isset($requestNew->opportunity_status) && !empty($requestNew->opportunity_status)) {

				$where['lo.activity_status'] = $requestNew->opportunity_status;

				$data['parent_company_id'] = $requestNew->opportunity_status;
			}



			if (isset($requestNew->approval_deadline) && !empty($requestNew->approval_deadline)) {

				$where['b.approval_deadline'] = date("d-m-Y", strtotime($requestNew->approval_deadline));

				$data['approval_deadline'] = $requestNew->approval_deadline;
			}



			/* if(isset($requestNew->sales_person) && !empty($requestNew->sales_person)) {

                $where['p.supplier'] = $requestNew->sales_person;

                $data['supplier_id'] = $requestNew->sales_person;

            }*/
		} else {

			$where = '';

			//$where = 't1.company_type = "'.self::COMPANY_ARRAY[$companyType].'"';

			if (!empty($request['search']['value'])) {

				foreach ($select as $key => $value) {

					$where .= 't1' . $value . " Like '%" . $request['search']['value'] . "%'";
				}
			}
		}



		$select = "b.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, count(bwi.bwi_id) as bwiCount";



		if (isset($request['order']) && is_array($request['order'])) {

			$order = $columns[$request['order'][0]['column']] . ' ' . $request['order'][0]['dir'];
		}



		$userId = $this->session->userdata('user_id');



		$user_type = $this->rfqModel->getUserRole($userId);



		if ($user_type['role_name'] == 'Customer') {

			$customer = $userId;
		} else {

			$customer = '';
		}

		$adminAccess = $this->session->userdata('adminAccess');
		if ($adminAccess == 'No') {
			$where .= 'FIND_IN_SET(' . $this->session->userdata('user_id') . ', b.supplier) AND b.parent_bid_id="0"';
			// $where .= 'b.supplier IN(' . $this->session->userdata('user_id').')';
		} else {
			$where .= 'b.parent_bid_id="0"';
		}
		$companyList = $this->rfqModel->getRfqlist($select, $where, $order, $limit, $offset);
		// print_r($companyList);
		$companycount = count($companyList);
		$RFQdata[] = '';

		$dataAnalysis = $this->permission->checkUserPermission(30);
		foreach ($companyList as $key => $value) {
			// print_r($value);
			$suppliers = explode(',', $value['supplier']);
			if ($adminAccess == 'No' && in_array($userId, $suppliers)) {
				// echo 'suppliershow';

				$RFQdata[] = $value;
				$RFQdata = array_values(array_filter($RFQdata));
				// print_r($RFQdata);
				$expire = strtotime($value['approval_deadline']);
				$today = strtotime("today midnight");

				if ($today >= $expire) {
					// echo "expired";
					$RFQdata[$key]['expiry'] = "Yes";
				} else {
					$RFQdata[$key]['expiry'] = "No";
					// echo "active";
				}

				if ($user_type['role_name'] == 'Customer' && in_array($userId, $suppliers)) {

					if ($value['approval_deadline']) {



						$value['approval_deadline'] = date('d-M-Y', strtotime($value['approval_deadline']));

						$RFQdata[$key]['approval_deadline'] = $value['approval_deadline'];
					} else {

						$RFQdata[$key]['approval_deadline'] = "N/A";
					}



					if ($RFQdata[$key]['bwiCount'] == 0) {

						$RFQdata[$key]['bwiCount'] = 'disabled';

						$RFQdata[$key]['modelShow'] = '';
					} else {

						$RFQdata[$key]['bwiCount'] = '';

						$RFQdata[$key]['modelShow'] = 'data-toggle="modal" data-target="#modal"';
					}



					$RFQdata[$key]['response'] = $value['bwiCount'];



					$RFQdata[$key]['dataAnalysis'] = $dataAnalysis;
				} else {

					if ($value['approval_deadline']) {



						$value['approval_deadline'] = date('d-M-Y', strtotime($value['approval_deadline']));

						$RFQdata[$key]['approval_deadline'] = $value['approval_deadline'];
					} else {

						$RFQdata[$key]['approval_deadline'] = "N/A";
					}



					if (isset($RFQdata[$key]['bwiCount']) && ($RFQdata[$key]['bwiCount'] == 0)) {

						$RFQdata[$key]['bwiCount'] = 'disabled';

						$RFQdata[$key]['modelShow'] = '';
					} else {

						$RFQdata[$key]['bwiCount'] = '';

						$RFQdata[$key]['modelShow'] = 'data-toggle="modal" data-target="#modal"';
					}



					$RFQdata[$key]['response'] = $value['bwiCount'];



					$RFQdata[$key]['dataAnalysis'] = $dataAnalysis;
					$RFQdata[$key]['access'] = $this->session->userdata('adminAccess');
					$RFQdata[$key]['login_user_type'] = $user_type['role_name'];
					$RFQdata[$key]['login_user_id'] = $this->session->userdata('user_id');

					$select3 = "b.accept_rebid_id,b.reject_rebid_id";

					$where3 = array('b.b_id' => $RFQdata[$key]['rebid_id']);

					$value3 = $this->rfqModel->getRfqlist($select3, $where3);
					$RFQdata[$key]['rebidStatus'] = "";
					if (isset($value3[0]['accept_rebid_id'])) {

						$parts1 = explode(',', $value3[0]['accept_rebid_id']);
						if (in_array($userId, $parts1)) {
							$RFQdata[$key]['rebidStatus'] = "accepted";
						}
					}
					if (isset($value3[0]['accept_rebid_id'])) {
						$parts2 = explode(',', $value3[0]['reject_rebid_id']);
						if (in_array($userId, $parts2)) {
							$RFQdata[$key]['rebidStatus'] = "rejected";
						}
					}
				}
			} elseif ($adminAccess == 'Yes' && !empty($value)) {
				// echo 'admin show';
				// print_r($value);
				$RFQdata[] = $value;
				$RFQdata = array_values(array_filter($RFQdata));
				// print_r($RFQdata);



				if ($user_type['role_name'] == 'Customer' && in_array($userId, $suppliers)) {

					if ($value['approval_deadline']) {



						$value['approval_deadline'] = date('d-M-Y', strtotime($value['approval_deadline']));

						$RFQdata[$key]['approval_deadline'] = $value['approval_deadline'];
					} else {

						$RFQdata[$key]['approval_deadline'] = "N/A";
					}



					if ($RFQdata[$key]['bwiCount'] == 0) {

						$RFQdata[$key]['bwiCount'] = 'disabled';

						$RFQdata[$key]['modelShow'] = '';
					} else {

						$RFQdata[$key]['bwiCount'] = '';

						$RFQdata[$key]['modelShow'] = 'data-toggle="modal" data-target="#modal"';
					}



					$RFQdata[$key]['response'] = $value['bwiCount'];



					$RFQdata[$key]['dataAnalysis'] = $dataAnalysis;
				} else {

					if ($value['approval_deadline']) {



						$value['approval_deadline'] = date('d-M-Y', strtotime($value['approval_deadline']));

						$RFQdata[$key]['approval_deadline'] = $value['approval_deadline'];
					} else {

						$RFQdata[$key]['approval_deadline'] = "N/A";
					}



					if (isset($RFQdata[$key]['bwiCount']) && ($RFQdata[$key]['bwiCount'] == 0)) {

						$RFQdata[$key]['bwiCount'] = 'disabled';

						$RFQdata[$key]['modelShow'] = '';
					} else {

						$RFQdata[$key]['bwiCount'] = '';

						$RFQdata[$key]['modelShow'] = 'data-toggle="modal" data-target="#modal"';
					}



					$RFQdata[$key]['response'] = $value['bwiCount'];



					$RFQdata[$key]['dataAnalysis'] = $dataAnalysis;
					$RFQdata[$key]['access'] = $this->session->userdata('adminAccess');
					$RFQdata[$key]['login_user_type'] = $user_type['role_name'];
					$RFQdata[$key]['login_user_id'] = $this->session->userdata('user_id');
				}
				$select4 = "distinct(`u`.`full_name`), `c`.`company_name`, u.user_id";
				$where4 = array('bw.fk_b_id' => $RFQdata[$key]['b_id']);
				$totalSp = $this->rfqModel->getRFQSupplierList($select4, $where4);

				$select5 = "b.b_id";
				$where5 = array('b.parent_bid_id' => $RFQdata[$key]['b_id']);
				$totalRebid = $this->rfqModel->getRFQRebidList($select5, $where5);
				// print_r($totalSp);
				$RFQdata[$key]['totalSp'] = count($totalSp);
				// $RFQdata[$key]['totalSp'] = count($totalSp);
				$RFQdata[$key]['totalRebid'] = count($totalRebid);
				$RFQdata[$key]['totalRebid_id'] = $totalRebid;
			}
		}



		//$companycount = count($companyList);

		// print_r(array_values(array_filter($RFQdata)));
		// exit;

		//$companycount = array_sum(array_column($companycount, 'count'));
		// print_r( $this->session->userdata('adminAccess'));

		// $colorsNoEmptyOrNull = array_filter($RFQdata, function($v){
		// return !is_null($v) && $v !== '';
		//    });
		//    print_r($RFQdata);
		$data['recordsFiltered'] = $companycount;

		$data['recordsTotal'] = $companycount;
		// $data['access'] = $this->session->userdata('adminAccess');

		$data['data'] = array_values(array_filter($RFQdata));
		// print_r($data['data']);
		echo json_encode($data);
	} // end : getCompanies Action





	public function getCompanyIdentifier($country)
	{

		$where = array('t2.nicename' => $country, 'status' => 'active');

		$companyIdentifierList['list'] = $this->rfqModel->getCompanyIdentifier($where);

		$getIdentifierList = $this->load->view('form/getComapnyIdentifier', $companyIdentifierList);

		return $getIdentifierList;
	} // end : getCompanyIdentifier Action



	public function getItemList()
	{
		$post = $this->input->post();
		try {
			$fk_b_id = $post['fk_b_id'];
			$select2 = "bw.bw_id, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note";
			$where2 = array('bw.fk_b_id' => $fk_b_id);
			$data = $this->rfqModel->getItemList($select2, $where2);
			$response['recordsFiltered'] = 10;
			$response['recordsTotal'] = 10;
			$response['data'] = $data;
			// echo json_encode($response);
			// die;

			$itemList = "<table class='table table-bordered'>
			<thead>
			<tr style='height: 32px;color: black;background-color: #d1cdcd;font-size: 18px'>
			<th>Sr No</th>
			<th>Item</th>
			<th>Item Code</th>
			</tr>
			</thead>
			<tbody>";
			if ($data) {
				$i = 1;
				foreach ($data as $item) {
					if ($item['item_name'] != '') {
						$itemList .= "<tr>
						<td>" . $i . "</td>
						<td>" . $item['item_name'] . "</td>
						<td>" . $item['id_code'] . "</td>
						<td>" . $item['item_type'] . "</td>
						<td>" . $item['photo'] . "</td>
						<td>" . $item['width'] . "</td>
						<td>" . $item['depth'] . "</td>
						<td>" . $item['height'] . "</td>
						<td>" . $item['short_height'] . "</td>
						<td>" . $item['technical_description'] . "</td>
						<td>" . $item['quantity'] . "</td>
						<td>" . $item['fabric_quantity'] . "</td>
						<td>" . $item['leather_quantity'] . "</td>
						<td>" . $item['cbm'] . "</td>
						<td>" . $item['note'] . "</td>
						</tr>";
						$i++;
					}
				}
			} else {
				$itemList .= "<tr>
				<td colspan='3'>No Data Available</td>
				</tr>";
			}

			$itemList .= "</tbody>
			</table>";
			echo $itemList;
		} catch (Exception $e) {
			$response['code'] = 505;
			$response['message'] = 'exception in insertion';
			$response['data'] = array();
		}
	} // end : getCompanyIdentifier Action





	function getFilter()
	{

		$postData = $this->input->post();

		$getFilterData['data'] = $this->rfqModel->getFilterById($postData['filter_id']);

		$getFilterData['filter_id'] = $postData['filter_id'];

		/*$select = "u.user_id, CONCAT (u.first_name,' ',u.last_name) AS name";

        $where = array('u.active_status' => 'active');

        $page['getSalesperson'] = $this->rfqModel->getSalesperson($select, $where);*/

		// if (isset($getFilterData['data'][0]['filter_values'])) {

		//    $newData = json_decode($getFilterData['data'][0]['filter_values']);

		//     $parent_id = $newData->parent_company_id;

		//     if ($parent_id != 0) {

		//         $getFilterData['parentCompany'] = $this->company_model->getParentCompany($parent_id);

		//     }

		// }

		// print_r($getFilterData['data']);exit;

		$getView = $this->load->view('pages/getRFQFilterView', $getFilterData);

		return $getView;
	}



	public function addFilter()
	{

		$post = $this->input->post();

		try {

			$postData['module'] =  "Rfq";

			$postData['filter_name'] = $this->input->post('filter_name');

			$postData['filter_values'] = json_encode($this->input->post());

			$AddCompany = $this->rfqModel->saveFilter($postData);
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}
	} // end : getCompanyIdentifier Action



	public function addWorksheet()
	{

		$post = $this->input->post();

		try {

			$post['photo'] = '';
			$error ='';

			if (isset($_FILES) && !empty($_FILES) && $_FILES["photo"]['name'] != '') {

				$config['upload_path'] = './upload/addItemImages/';

				$config['allowed_types'] = '*';

				$config['max_size'] = 2000;

				$config['max_width'] = 1500;

				$config['max_height'] = 1500;

				$new_name = time() . str_replace(' ', '_', $_FILES["photo"]['name']);

				$config['file_name'] = $new_name;

				$post['photo'] = $new_name;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('photo')) {

					$error = array('error' => $this->upload->display_errors());

					//print_r($error);
				}
			}



			$this->load->library('form_validation');

			if (isset($post['pw_id']) && $post['pw_id'] != '') {

				$this->form_validation->set_rules('pw_id', 'Something Went Wrong', 'required|integer');
			}

			$this->form_validation->set_rules('item_name', 'Item Name', 'required');

			$this->form_validation->set_rules('item_type', 'Item Type', 'required');

			$this->form_validation->set_rules('id_code', 'ID Code', 'required');

			// $this->form_validation->set_rules('item_name', 'Item Name', 'required');



			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				// print_r($post);exit();

				$pw_id = $post['bw_id'];

				//-----Calculate ExFactory Amount----------------------

				/*	if($post['quantity'] !='' && $post['ex_factory_unit_price'] !='' && $post['unit_price_markup'] !='' && $post['ex_factory_mark_up_amt'] !='') {

	        		if ($post['unit_price_markup'] == '%') {

	        			$post['ex_factory_total_markup'] = $post['ex_factory_unit_price'] * ($post['ex_factory_mark_up_amt']/100);

	        		} else if ($post['unit_price_markup'] == '$/unit') {

	        			$post['ex_factory_total_markup'] = $post['quantity'] * $post['ex_factory_mark_up_amt'];

	        		} else if ($post['unit_price_markup'] == 'Total Markup') {

	        			$post['ex_factory_total_markup'] = ($post['quantity'] * $post['ex_factory_unit_price']) + $post['ex_factory_mark_up_amt'];

	        		}

	        		$post['total_price_ex_factory'] = $post['ex_factory_total_markup'] + ($post['quantity']*$post['ex_factory_unit_price']);

	        	}*/



				//-----Calculate Fabrics Amounts----------------------

				/*if($post['fabric_quantity'] !='' && $post['fabric_price'] !='' && $post['fabric_markup'] !='' && $post['fabric_mark_up_amt'] !='') {

				    if ($post['fabric_markup'] == '%') {

				        $post['fabrics_total_markup'] = $post['fabric_price'] * ($post['fabric_mark_up_amt']/100);

				    } else if ($post['fabric_markup'] == '$/unit') {

				        $post['fabrics_total_markup'] = $post['fabric_quantity'] * $post['fabric_mark_up_amt'];

				    } else if ($post['fabric_markup'] == 'Total Markup') {

				        $post['fabrics_total_markup'] = ($post['fabric_quantity'] * $post['fabric_price']) + $post['fabric_mark_up_amt'];

				    }

				    $post['unit_total_price_fabric'] = $post['fabrics_total_markup'] + ($post['fabric_quantity']*$post['fabric_price']);

				}*/



				//-----Calculate Leather Amounts----------------------

				/*if($post['leather_quantity'] !='' && $post['leather_price'] !='' && $post['leather_markup'] !='' && $post['leather_mark_up_amt'] !='') {

				    if ($post['leather_markup'] == '%') {

				        $post['leather_total_markup'] = $post['leather_price'] * ($post['leather_mark_up_amt']/100);

				    } else if ($post['leather_markup'] == '$/unit') {

				        $post['leather_total_markup'] = $post['leather_quantity'] * $post['leather_mark_up_amt'];

				    } else if ($post['leather_markup'] == 'Total Markup') {

				        $post['leather_total_markup'] = ($post['leather_quantity'] * $post['leather_price']) + $post['leather_mark_up_amt'];

				    }

				    $post['unit_total_price_leather'] = $post['leather_total_markup'] + ($post['leather_quantity']*$post['leather_price']);

				}*/



				//--------CAlculate FOB---------------

				/*	if ($post['quantity'] !='' && $post['unit_price_fob'] !='') {

					$post['total_price_fob'] = ($post['quantity'] * $post['unit_price_fob']);

				}



				//--------CAlculate CIF---------------

				if ($post['quantity'] !=''  && $post['unit_price_cif'] !='') {

					$post['total_price_cif'] = ($post['quantity'] * $post['unit_price_cif']);

				}*/

				// print_r($post)

				if (isset($post['bw_id']) && $post['bw_id'] != '') {

					$data['id'] = $this->rfqModel->insertRfqWorksheet($post, $pw_id);

					$response['message'] = "RFQ Item Updated Successfully.";

					$response['saveNew'] = "";
				} else {

					$pw_id = $data['id'] = $this->rfqModel->insertRfqWorksheet($post);

					$response['message'] = "RFQ Items Added Successfully.";

					$response['saveNew'] = "saveNew";
				}



				//$this->session->set_userdata('setMessage','Added');

				if($error)
				{
					$response['code'] = 505;

					$response['message'] = $error;
				}
				else
				{
					$response['code'] = 200;

					$response['data'] = $data['id'];
				}
				
			}
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : getCompanyIdentifier Action



	public function addFormat()
	{

		$post = $this->input->post();

		//print_r($post);exit;

		try {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('fk_b_id', 'Something Went Wrong', 'required|integer');



			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				$p_id = $post['fk_b_id'];

				$insertArray = array(

					'fk_b_id' => $post['fk_b_id'],

					'format_header' => $post['format_header'],

					'format_footer' => $post['format_footer'],

				);

				if (isset($post['bf_id']) && $post['bf_id'] != '') {

					$data['id'] = $this->rfqModel->insertRfqFormat($insertArray, $post['bf_id']);

					$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> RFQ Format Updated Successfully.</div>";
				} else {

					$data['id'] = $this->rfqModel->insertRfqFormat($insertArray);

					$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> RFQ Format Added Successfully.</div>";
				}

				//$this->session->set_userdata('setMessage','Added');

				$response['code'] = 200;

				$response['data'] = $data['id'];
			}
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : getCompanyIdentifier Action



	/**

	 * This is import a company detail.

	 * @author Sagar Kodalkar

	 * @return excel object

	 */

	public function importData($rfq_id = null)

	{

		// echo $rfq_id;

		$ExcelHeader = array('Room Type', 'ID Code', 'Item Type', 'Item Ref', 'Photo', 'Width', 'Depth', 'Height', 'Short Height', 'Technical Description', 'Quantity', 'Unit Price(Ex-Factory)', 'Fabrics Quantity', 'Unit Price(Fabrics)', 'Leather Quantity', 'Unit Price(Leather)', 'Unit Price FOB', 'Unit Price CIF', 'Total Price FOB', 'Total Price CIF', 'CBM', 'Notes');



		try {

			$this->load->library('Excel', 'excel');



			$config['upload_path']          = APPPATH . '../upload/';

			$config['allowed_types']        = 'xlsx|csv|xls';



			$this->load->library('upload', $config);



			if (!$this->upload->do_upload('uploadFile')) {

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

					'name' => 'room_type',

					'require' => true

				),

				'B' => array(

					'name' => 'id_code',

					'require' => false

				),

				'C' => array(

					'name' => 'item_type',

					'require' => true

				),

				'D' => array(

					'name' => 'item_name',

					'require' => true

				),

				'E' => array(

					'name' => 'photo',

					'require' => true

				),

				'F' => array(

					'name' => 'width',

					'require' => true

				),

				'G' => array(

					'name' => 'depth',

					'require' => true

				),

				'H' => array(

					'name' => 'height',

					'require' => true

				),

				'I' => array(

					'name' => 'short_height',

					'require' => true

				),

				'J' => array(

					'name' => 'technical_description',

					'require' => true

				),

				'K' => array(

					'name' => 'quantity',

					'require' => true

				),

				'L' => array(

					'name' => 'ex_factory_unit_price',

					'require' => false

				),

				'M' => array(

					'name' => 'fabric_quantity',

					'require' => true

				),

				'N' => array(

					'name' => 'fabric_price',

					'require' => true

				),

				'O' => array(

					'name' => 'leather_quantity',

					'require' => true

				),

				'P' => array(

					'name' => 'leather_price',

					'require' => true

				),

				'Q' => array(

					'name' => 'unit_price_fob',

					'require' => true

				),

				'R' => array(

					'name' => 'unit_price_cif',

					'require' => true

				),

				'S' => array(

					'name' => 'total_price_fob',

					'require' => true

				),

				'T' => array(

					'name' => 'total_price_cif',

					'require' => true

				),

				'U' => array(

					'name' => 'cbm',

					'require' => true

				),

				'V' => array(

					'name' => 'notes',

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

			// print_r($data);

			// print_r($ExcelHeader);

			foreach ($ExcelHeader as $header => $value) {

				if (!in_array($value, $data['cellArray'])) {

					unlink($file);

					$responceMsg = array(

						'code' => 500,

						'message' => "<b style='color:red'>Invalid Excel! You can not upload Items with this excel<br/> For ideal format please <a href='https://testing.specxnet.com/upload/sampleItemList.xls'>Click Here</a></b>"

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

				// if(isset($value['id_code']) && !empty($value['id_code'])) {

				//     $id_code = $this->company_model->isExistItem($value['id_code']);

				//     if(!empty($parentCompanyDetail)){

				//         $ParentCompanyId = $parentCompanyDetail[0]['company_id'];

				//     }

				// }

				// $fax='';

				// if(isset($value['fax']) && !empty($value['fax'])) {

				// 	$fax = $value['fax'];

				// }



				$insertArray = array(

					'fk_b_id' => $rfq_id,

					'room_type' => ($value['room_type'] == NULL ? '' : $value['room_type']),

					'item_name' => ($value['item_name'] == NULL ? '' : $value['item_name']),

					'item_type' => ($value['item_type'] == NULL ? '' : $value['item_type']),

					'id_code' => ($value['id_code'] == NULL ? '' : $value['id_code']),

					'photo' => ($value['photo'] == NULL ? '' : $value['photo']),

					'width' => ($value['width'] == NULL ? '' : $value['width']),

					'depth' => ($value['depth'] == NULL ? '' : $value['depth']),

					'height' => ($value['height'] == NULL ? '' : $value['height']),

					'short_height' => ($value['short_height'] == NULL ? '' : $value['short_height']),

					'technical_description' => ($value['technical_description'] == NULL ? '' : $value['technical_description']),

					'quantity' => ($value['quantity'] == NULL ? '' : $value['quantity']),

					'ex_factory_unit_price' => ($value['ex_factory_unit_price'] == NULL ? '' : $value['ex_factory_unit_price']),

					'fabric_quantity' => ($value['fabric_quantity'] == NULL ? '' : $value['fabric_quantity']),

					'fabric_price' => ($value['fabric_price'] == NULL ? '' : $value['fabric_price']),

					'leather_quantity' => ($value['leather_quantity'] == NULL ? '' : $value['leather_quantity']),

					'leather_price' => ($value['leather_price'] == NULL ? '' : $value['leather_price']),

					'unit_price_fob' => ($value['unit_price_fob'] == NULL ? '' : $value['unit_price_fob']),

					'unit_price_cif' => ($value['unit_price_cif'] == NULL ? '' : $value['unit_price_cif']),

					'total_price_fob' => ($value['total_price_fob'] == NULL ? '' : $value['total_price_fob']),

					'total_price_cif' => ($value['total_price_cif'] == NULL ? '' : $value['total_price_cif']),

					'cbm' => ($value['cbm'] == NULL ? '' : $value['cbm']),

					'note' => ($value['notes'] == NULL ? '' : $value['notes']),

				);



				$importExcelData = $this->rfqModel->insertRfqWorksheet($insertArray);


				$this->session->set_userdata('setMessage', 'Imported');
			}

			$responceMsg = array(

				'code' => 200,

				'message' => "<b style='color:green'>RFQ Data Imported Successfully</b>"

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

	public function createExcel($list = null)
	{


		$filename = "RFQ-" . str_replace('-', '', date('d-M-Y'));
		header('Content-Disposition: attachment; filename="' . $filename . '.csv";');
		header('Content-Type: application/csv');

		$activityList = '';
		if ($list != '') {
			$list = str_replace('%20', '', $list);
			$activityList = explode('_', $list);
		}

		$columnArray = $this->rfq->getRfqColumn();

		$fields = $columns = array_column($columnArray, 'data');
		// print_r($fields); die;
		$title =  array_column($columnArray, 'title');
		$fields = $this->rfq->getSelectField($columns);



		// $columnString = "b.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS supplier";
		$where = "";
		$rfqData = $this->rfqModel->exportCompany($fields, $where);

		$f = fopen("php://output", "w");
		unset($title[0]);
		fputcsv($f, $title);
		foreach ($rfqData as $rfq) {
			fputcsv($f, $rfq);
		}
		fpassthru($f);
	}



	public function createGrid()
	{

		try {

			$data = [];

			$data['options'] = array();

			$data['columns'] = array();

			$module_name = $this->uri->segment(1);

			$selectedColumns = $this->input->post();

			$gridId = $selectedColumns['gridId'];

			$selectedColumns['internal'] = explode(',', $selectedColumns['internal']);

			$column = $arrayField = $this->rfq->getRfqColumn();

			$data['columns'] = $column;

			//print_r($selectedColumns['internal']);exit;

			if (!empty($selectedColumns) && $gridId == 'null') {

				$arrayField = array();

				array_push($arrayField, $column[0]);

				$i = 0;

				foreach ($selectedColumns['internal'] as $key => $value) {

					foreach ($column as $key22 => $value22) {

						if ($value22['title'] == $value) {

							array_push($arrayField, $column[$key22]);
						}
					}

					++$i;
				}

				// print_r($arrayField);

				// exit;

			} else if ($gridId != 'null') {

				$grid_columns = $this->rfqModel->getGrid('grid_columns', array('grid_id' => $gridId));

				if (!empty($grid_columns)) {

					$arrayField = json_decode($grid_columns[0]['grid_columns']);
				}
			}



			if (isset($selectedColumns['ischeck']) && $selectedColumns['ischeck'] != '' && $selectedColumns['ischeck'] != 'undefined') {

				$columns['grid_columns'] = json_encode($arrayField);

				$columns['grid_name'] = $selectedColumns['ischeck'];

				$columns['module_name'] = $module_name;

				$this->rfqModel->insertGrid($columns);
			}

			$data['columns'] = $arrayField;

			$data['options'] = $this->rfqModel->getGrid('*', array('module_name' => $module_name));

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



	public function deleterfq()
	{

		$DeleteId = $this->input->post();

		$p_id = explode(',', $DeleteId['deleteThis']);

		// print_r($newUsrId); exit;

		$whereDelete = array('b_id' => $p_id);

		$DeletedUser = $this->rfqModel->deleterfq($p_id);

		if ($DeletedUser) {

			$this->session->set_userdata('setMessage', 'deleted');

			return true;
		} else {

			return False;
		}
	}

	public function deleterfqDoc()
	{

		$DeleteId = $this->input->post();
		$path = './upload/addItemImages/' . $DeleteId['filename'];
		if (unlink($path)) {
			$DeletedUser = $this->rfqModel->deleterfqDoc($DeleteId['id']);

			if ($DeletedUser) {

				$this->session->set_userdata('setMessage', 'deleted');

				echo "success";
			}
		} else {
			echo "File can't be deleted";
		}
	}



	public function deleteitem()
	{

		$DeleteId = $this->input->post();

		// print_r($DeleteId);die;

		$p_id = explode(',', $DeleteId['item_id']);

		// print_r($newUsrId); exit;

		$whereDelete = array('b_id' => $p_id);

		$DeletedUser = $this->rfqModel->deleteitem($p_id);

		// print_r($DeletedUser);

		if ($DeletedUser) {

			echo "success";
		} else {

			echo "fail";
		}
	}



	public function getEmailIds()
	{

		$DeleteId = $this->input->post();

		//print_r($DeleteId);exit;

		$newUsrId = explode(',', $DeleteId['getEmail']);

		$select = "uc.contact_info";

		$whereUsrs = array('b.b_id' => $newUsrId, 'uc.contact_type' => 'Email');

		$getData = $this->rfqModel->getEmailIds($select, $newUsrId);

		$test = [];

		foreach ($getData as $a => $val) {

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

				'smtp_user' => 'email@specxnet.com',

				'smtp_pass' => 'Email@123',

				'mailtype'  => 'html',

				'charset'   => 'utf-8'

			);

			$this->email->initialize($config);

			$this->email->set_mailtype("html");

			$this->email->set_newline("\r\n");





			$this->email->from('email@specxnet.com', 'Specxreef');

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

			$response['message'] = 'Failure';
		}

		echo json_encode($response);

		// }

	}



	public function get_item_email()

	{

		$post = $this->input->post();

		if ($post['approval_deadline'] != '') {

			$newDate = date("d-m-Y", strtotime($post['approval_deadline']));
		} else {

			$newDate = "";
		}



		if ($post['supplier_id'] != '') {

			$supplier_id = $post['supplier_id'];
		} else {

			$supplier_id = "";
		}



		$updateArray = array(

			'approval_deadline' => $newDate,

			'supplier' => implode(',', $supplier_id),

			'notes' => $post['notes'],

		);

		// print_r($updateArray);

		// print_r($post);

		$where = array('b_id' => $post['fk_b_id']);

		$updaterfq = $this->rfqModel->updateRFQ($updateArray, $where);



		$suppliers = $this->input->post();

		$select3 = "count(bw_id) as count";

		$where3 = array('fk_b_id' => $suppliers['fk_b_id']);

		$worksheet_exist = $this->rfqModel->getRfqworksheet($select3, $where3);

		// print_r($worksheet_exist[0]['count']);exit();
		$from = "";
		$to = "";
		if ($worksheet_exist[0]['count'] > 0) {



			$select1 = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS supplier_people,uc.contact_info,uc.contact_type";

			$where1 = array('u.active_status' => 'active', 'u.user_type' => 'Suppliers');

			$supplier_list = $this->rfqModel->getSupplierlists($select1, $where1);



			$select2 = "bf.*";

			$where2 = array('bf.fk_b_id' => $suppliers['fk_b_id']);

			$getFormat = $this->rfqModel->getFormat($select2, $where2);

			// print_r($getFormat);

			if (!empty($getFormat)) {

				$header = $getFormat[0]['format_header'];

				$footer = $getFormat[0]['format_footer'];
			}



			// $email_list[]="";

			foreach ($supplier_list as $key => $value) {

				if ($value['contact_type'] === "Email") {

					$email_list[] = $value['contact_info'];
				}
			}



			foreach ($email_list as $emailkey => $emailvalue) {



				$to = $email_list_sent = $emailvalue;

				$from = "email@specxnet.com";

				$from_name = "'Specxreef'";



				$select2 = "bw.*";

				$where2 = array('bw.fk_b_id' => $suppliers['fk_b_id']);

				$getItemList = $this->rfqModel->getItemList($select2, $where2);

				// print_r($getItemList);exit();

				if (isset($header)) {
					$header;
				} else {
					$header = '';
				}

				if (isset($footer)) {
					$footer;
				} else {
					$footer = '';
				}

				$mail_message = '';

				$mail_message .= "<html>

	                                        <head>

	                                          <title>Mail from Specxnet</title>

	                                        </head>

	                                        <body>

	                                        <p>" . $header . "</p>

	                                        </body>

	                                    </html>";

				$mail_message .= ' <table class="table table-borderless">



	                    <tr>

	                        <td colspan="4">

	                            <div><span style="color: rgb(39, 39, 39); font-family: Lato, sans-serif; font-size: 15px; font-weight: bold;"></span><br></div>

	                        </td>

	                    </tr>

	                    <tr>

	                        <td colspan="4" align="center">

	                            <table class="table table-bordered">

	                                <thead>

	                                    <tr style="height: 32px;color: black;background-color: #d1cdcd;font-size: 18px">

	                                        <th>Sr No</th>

	                                        <th>Item</th>

	                                        <th>Item Code</th>

	                                    </tr>

	                                </thead>

	                                <tbody>';

				// print_r($getItemList);

				if (isset($getItemList)) {

					$i = 1;

					foreach ($getItemList as $item) {

						// echo $item['item_name'];
						
						if ($item['item_name'] != '') {

							$mail_message .= '<tr><td>' . $i . '</td><td>' . $item['item_name'] . '</td><td>' . $item['id_code'] . '</td></tr>';

							$i++;
						}
					}
				} else {

					$mail_message .= '<tr>

	                                                <td colspan="3">No Data Available</td>

	                                            </tr>';
				}

				$mail_message .= '

	                                </tbody>

	                           </table>

	                        </td>

	                    </tr>

	                     <tr><td colspan="4" align="center">' . isset($footer) ? $footer : '' . '</td></tr>

	                </table>';



				//Listoad email library

				$this->load->library('email');

				$config = array(

					'protocol'  => 'smtps',

					'smtp_host' => 'ssl://smtp.live.com',

					'smtp_port' => 25,

					'smtp_user' => $from,

					'smtp_pass' => 'Email@123',

					'mailtype'  => 'html',

					'charset'   => 'utf-8'

				);

				$this->email->initialize($config);

				$this->email->set_mailtype("html");

				$this->email->set_newline("\r\n");





				$this->email->from($from, $from_name);


				$this->email->to('arvind.runtime@gmail.com');


				$this->email->subject('List of Item for RFQ');

				$this->email->message($mail_message);



				//Send email

				if ($this->email->send()) {

					$response['code'] = 200;

					$response['message'] = 'Success';
				} else {

					$response['code'] = 500;

					$response['message'] = 'Failure: '.$this->email->print_debugger();
				}
			}
		} else {

			$response['code'] = 200;

			$response['message'] = 'no item';
		}

		$insertArray = array(

			'fk_bid_id' => $post['fk_b_id'],

			'fk_user_id' => $this->session->userdata('user_id'),

			'sent_from' => $from,

			'sent_to' => $to,

			'mail_status' => $response['message']

		);

		//print_r($insertArray);exit;

		$data['id'] = $this->rfqModel->insertmail($insertArray);

		if ($data['id']) {

			$status = "Processing";

			$this->setStatus($status, $post['fk_b_id']);
		}

		echo json_encode($response);
	}



	public function setStatus($status, $fk_b_id)
	{

		$post = $this->input->post();

		try {

			$p_id = $fk_b_id;

			$updateArray = array(

				'status' => $status,

			);

			$data = $this->rfqModel->setStatus($updateArray, $p_id);
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}
	} // end : getCompanyIdentifier Action





	public function getItemData($val)
	{

		$select2 = "bw.*";

		$where2 = array('bw.bw_id' => $val);

		$data['getItemList'] = $this->rfqModel->getItemList($select2, $where2);

		$getData = $this->load->view('pages/getRFQItemList', $data);

		return $getData;
	}



	public function get_preview($val)
	{

		// $post = $this->input->post();

		// print_r($post);exit();

		$select2 = "bw.*";

		$where2 = array('bw.fk_b_id' => $val);

		$data['getItemList'] = $this->rfqModel->getItemList($select2, $where2);



		$select3 = "bf.*";

		$where3 = array('bf.fk_b_id' => $val);

		$data['getFormat'] = $this->rfqModel->getFormat($select3, $where3);

		// print_r($data['getFormat']);



		$getData = $this->load->view('pages/get_RFQpreview', $data);

		return $getData;
	}
	
	/// Start code to get Item list added by arvind on 20-10-2021 //////////////
	public function get_item_list($val=null)
	{

		// $post = $this->input->post();

		// print_r($post);exit();

		$select2 = "bw.*";

		if($val)
		{
			$where2 = array('bw.fk_b_id' => $val);
		}
		else{
			$where2 = array();
		}
		

		$data['getItemList'] = $this->rfqModel->getItemList($select2, $where2);

		// print_r($data['getFormat']);

		$getData = $this->load->view('pages/get_RFQItemList', $data);

		return $getData;
	}
	/// End code added by arvind 

	public function getCompany()
	{

		$post = $this->input->post();



		$select = "lo.opportunity_title,lo.lead_opportunity_id";

		$where = array('c.company_id' => $post['company_id']);

		$getCompanyLeadOpp = $this->rfqModel->getCompanyLeadOpp($select, $where);

		echo json_encode($getCompanyLeadOpp);
	}

	public function saverfq()
	{

		$post = $this->input->post();

		//print_r($post);exit;

		if ($post['approval_deadline'] != '') {

			$newDate = date("Y-m-d H:i:s", strtotime($post['approval_deadline']));
			// $newDate = date("d-m-Y  H:i:s", strtotime($post['approval_deadline']));
		} else {

			$newDate = $post['approval_deadline'];
		}



		if ($post['supplier_id'] != '') {

			$supplier_id = $post['supplier_id'];
		} else {

			$supplier_id = "";
		}



		$updateArray = array(

			'approval_deadline' => $newDate,

			'supplier' => implode(',', $supplier_id),

			'markup_type' => $post['markup_type'],

			'markup_type_value_ex_factory' => $post['markup_type_value_ex_factory'],

			'markup_type_value_fabric' => $post['markup_type_value_fabric'],

			'markup_type_value_leather' => $post['markup_type_value_leather'],

			'notes' => $post['notes'],

		);

		//print_r($updateArray);exit;

		if (isset($post['markup_type_value_ex_factory']) && $post['markup_type_value_ex_factory'] != '') {

			$updateArray['markup_type_value_ex_factory'] = $post['markup_type_value_ex_factory'];
		}

		if (isset($post['markup_type_value_fabric']) && $post['markup_type_value_fabric'] != '') {

			$updateArray['markup_type_value_fabric'] = $post['markup_type_value_fabric'];
		}

		if (isset($post['markup_type_value_leather']) && $post['markup_type_value_leather'] != '') {

			$updateArray['markup_type_value_leather'] = $post['markup_type_value_leather'];
		}

		$where = array('b_id' => $post['b_id']);

		$updaterfq = $this->rfqModel->updateRFQ($updateArray, $where);



		//   	$whereNotificationID = array('fk_notification_id' => '16');

		// $addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);

		// $userIDs = json_decode($addLeadNotification['result'][0]['user_id']);

		//   	$getEmailList = $this->userModel->getUserEmail('*',$userIDs);

		//   	foreach ($getEmailList as $key => $value) {

		//       	$emailList[] = $value['contact_info'];

		//       }

		//       $where = array('lead_opportunity_id' => $fk_lead_opportunity_id);

		//       $getUserdetails = $this->rfqModel->getRFQDetails($where);

		// if ($addLeadNotification['count'] == 1) {

		//        $emailString = implode(',', $emailList);

		//       	$subject = 'RFQ Updated Successfully';

		//       	$module = 'RFQ for';

		//       	$name = $getUserdetails['result'][0]['title'];

		//       	$action = 'added';

		//       	$actionBy = $this->session->userdata('user_name');

		//       	$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);

		//       }

		// print_r($updaterfq);

		return $updaterfq;
	}







	public function uploadBid($rfqId)
	{
		$userId = $this->session->userdata('user_id');
		$version = $this->rfqModel->getLatestVersion($rfqId);
		$permissionsAdmin = $this->permission->checkUserPermission(40);
		$permissionsSupplier = $this->permission->checkUserPermission(41);

		$select2 = "b.*,bw.bw_id, bw.room_type, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note,bw.selling_price";
		$where2 = array('bw.fk_b_id' => $rfqId);
		$item = $this->rfqModel->getItemList($select2, $where2);

		$tables = array();
		$rebidId = 0;
		$i = 1;
		//echo "<pre>"; print_r($item);
		
		if(isset($item) && !empty($item) && is_array($item))
		{
		foreach ($item as $key => $value) {
			$rebidId   = $value['rebid_id'];
			$markup_type = $value['markup_type'];
			$markup_type_value_ex_factory = $value['markup_type_value_ex_factory'];
			$markup_type_value_fabric = $value['markup_type_value_fabric'];
			$markup_type_value_leather = $value['markup_type_value_leather'];
			$bid = $this->rfqModel->getItemBidPrice($value['bw_id'], $userId);
			
			$table['b_id'] = $value['b_id'];
			$table['room_type'] = $value['room_type'];
			$table['item_name'] = $value['item_name'];
			$table['id_code'] = $value['id_code'];
			$table['item_type'] = $value['item_type'];
			$table['w'] = $value['width'];
			$table['d'] = $value['depth'];
			$table['h'] = $value['height'];
			$table['sh'] = $value['short_height'];
			$table['technical_description'] = $value['technical_description'];
			$table['qty'] = $value['quantity'];
			$table['fabric_quantity'] = $value['fabric_quantity'];
			$table['leather_quantity'] = $value['leather_quantity'];
			$table['bw_id'] = '<input type="hidden" value="' . $value['bw_id'] . '" name="bw_id[]">';
			$bwi_id = (isset($bid[0]['bwi_id'])) ? $bid[0]['bwi_id'] : "";
			$table['bwi_id'] = '<input type="hidden" value="' . $bwi_id . '" name="bwi_id[]">';
			$table['fabric_quantity_hidden'] = '<input type="hidden" id="fabric' . $rfqId . $i . '" value="' . $value['fabric_quantity'] . '" name="fabric_quantity[]">';
			$table['leather_quantity_hidden'] = '<input type="hidden" id="leather' . $rfqId . $i . '" value="' . $value['leather_quantity'] . '" name="leather_quantity[]">';
			$table['ex_factory_quantity'] = '<input type="hidden" id="quantity' . $rfqId . $i . '" value="' . $value['quantity'] . '" name="ex_factory_quantity[]">';

			$ex_factory_unit_price = (isset($bid[0]['ex_factory_unit_price'])) ? $bid[0]['ex_factory_unit_price'] : "";
			$efup = "ex_factory_unit_price" . $rfqId . $i;
			$fbup = "fabric_price" . $rfqId . $i;
			$lup = "leather_price" . $rfqId . $i;
			$utpf = "unit_total_price_fabric" . $rfqId . $i;
			$utpl = "unit_total_price_leather" . $rfqId . $i;
			$tpef = "unit_total_price_ex_factory" . $rfqId . $i;
			$topef = "total_order_price_ex_factory" . $rfqId . $i;
			$sp = "selling_price" . $rfqId . $i;

			if ($value['leather_quantity'] == '') {
				$value['leather_quantity'] = 0;
			}
			if ($value['fabric_quantity'] == '') {
				$value['fabric_quantity'] = 0;
			}
			if ($value['rebid_id'] != 0) {
				$table['ex_factory_unit_price'] =  $ex_factory_unit_price;
			} else {
				$table['ex_factory_unit_price'] = '<input type="text" id="ex_factory_unit_price' . $rfqId . $i . '" value="' . $ex_factory_unit_price . '" name="ex_factory_unit_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',' . $value['fabric_quantity'] . ',' . $value['leather_quantity'] . ',"' . $efup . '","' . $fbup . '","' . $lup . '","' . $utpf . '","' . $utpl . '","' . $tpef . '","' . $topef . '","' . $sp . '")>';
			}
			$fup = "fabric_price" . $rfqId . $i;
			$fma = "fabric_markup" . $rfqId . $i;
			$tpfab = "unit_total_price_fabric" . $rfqId . $i;
			$fabric_price = (isset($bid[0]['fabric_price'])) ? $bid[0]['fabric_price'] : "";
			if ($value['rebid_id'] != 0) {
				$table['fabric_price'] =  $fabric_price;
			} else {
				$table['fabric_price'] = '<input type="text" id="fabric_price' . $rfqId . $i . '" value="' . $fabric_price . '" name="fabric_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',' . $value['fabric_quantity'] . ',' . $value['leather_quantity'] . ',"' . $efup . '","' . $fbup . '","' . $lup . '","' . $utpf . '","' . $utpl . '","' . $tpef . '","' . $topef . '","' . $sp . '")>';
			}
			$lup = "leather_price" . $rfqId . $i;
			$lma = "leather_markup" . $rfqId . $i;
			$tplet = "unit_total_price_leather" . $rfqId . $i;
			$leather_price = (isset($bid[0]['leather_price'])) ? $bid[0]['leather_price'] : "";
			if ($value['rebid_id'] != 0) {
				$table['leather_price'] =  $leather_price;
			} else {
				$table['leather_price'] = '<input type="text" id="leather_price' . $rfqId . $i . '" value="' . $leather_price . '" name="leather_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',' . $value['fabric_quantity'] . ',' . $value['leather_quantity'] . ',"' . $efup . '","' . $fbup . '","' . $lup . '","' . $utpf . '","' . $utpl . '","' . $tpef . '","' . $topef . '","' . $sp . '")>';
			}
			$ufob = "unit_price_fob" . $rfqId . $i;
			$fobmarkup = '0';
			$tfob = "total_price_fob" . $rfqId . $i;
			$unit_price_fob = (isset($bid[0]['unit_price_fob'])) ? $bid[0]['unit_price_fob'] : "";
			if ($value['rebid_id'] != 0) {
				$table['unit_price_fob'] =  $unit_price_fob;
			} else {
				$table['unit_price_fob'] = '<input type="text" id="unit_price_fob' . $rfqId . $i . '" value="' . $unit_price_fob . '" name="unit_price_fob[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',"' . $ufob . '","' . $fobmarkup . '","' . $tfob . '")>';
			}
			$ucif = "up_cif" . $rfqId . $i;
			$cifmarkup = '0';
			$tcif = "tp_cif" . $rfqId . $i;
			$unit_price_cif = (isset($bid[0]['unit_price_cif'])) ? $bid[0]['unit_price_cif'] : "";
			if ($value['rebid_id'] != 0) {
				$table['unit_price_cif'] =  $unit_price_cif;
			} else {
				$table['unit_price_cif'] = '<input type="text" id="up_cif' . $rfqId . $i . '" value="' . $unit_price_cif . '" name="unit_price_cif[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',"' . $ucif . '","' . $cifmarkup . '","' . $tcif . '")>';
			}
			$total_price_ex_factory = (isset($bid[0]['total_price_ex_factory'])) ? $bid[0]['total_price_ex_factory'] : "";
			if ($value['rebid_id'] != 0) {
				$table['total_price_ex_factory'] =  $total_price_ex_factory;
			} else {
				$table['total_price_ex_factory'] = '<input type="text" id="total_price_ex_factory' . $rfqId . $i . '" value="' . $total_price_ex_factory . '" name="total_price_ex_factory[]" style="width: 90px;" readonly>';
			}
			$total_price_fob = (isset($bid[0]['total_price_fob'])) ? $bid[0]['total_price_fob'] : "";
			if ($value['rebid_id'] != 0) {
				$table['total_price_fob'] =  $total_price_fob;
			} else {
				$table['total_price_fob'] = '<input type="text" id="total_price_fob' . $rfqId . $i . '" value="' . $total_price_fob . '" name="total_price_fob[]" style="width: 90px;" disabled>';
			}
			$total_price_cif = (isset($bid[0]['total_price_cif'])) ? $bid[0]['total_price_cif'] : "";
			if ($value['rebid_id'] != 0) {
				$table['total_price_cif'] =  $total_price_cif;
			} else {
				$table['total_price_cif'] = '<input type="text" id="tp_cif' . $rfqId . $i . '" value="' . $total_price_cif . '" name="total_price_cif[]" style="width: 90px;" disabled>';
			}
			$table['cbm'] = $value['cbm'];
			$table['note'] = $value['note'];

			if ($markup_type == 'fixed') {	// REBID
				$table['ex_factory_markup'] = '<input type="text" id="ex_factory_markup' . $rfqId . $i . '" value="' . $markup_type_value_ex_factory . '" name="ex_factory_markup[]" style="width: 90px;" disabled>';
				//$fabric_markup = (isset($bid[0]['fabric_markup']))?$bid[0]['fabric_markup']:"";
				$table['fabric_markup'] = '<input type="text" id="fabric_markup' . $rfqId . $i . '" value="' . $markup_type_value_fabric . '" name="fabric_markup[]" style="width: 90px;" disabled>';
				//$leather_markup = (isset($bid[0]['leather_markup']))?$bid[0]['leather_markup']:"";
				$table['leather_markup'] = '<input type="text" id="leather_markup' . $rfqId . $i . '" value="' . $markup_type_value_leather . '" name="leather_markup[]" style="width: 90px;" disabled>';
			} else {		// BID
				$efup = "ex_factory_unit_price" . $rfqId . $i;
				$efma = "ex_factory_markup" . $rfqId . $i;
				$tpef = "unit_total_price_ex_factory" . $rfqId . $i;
				$table['ex_factory_markup'] = '<input type="text" id="ex_factory_markup' . $rfqId . $i . '" value="' . $markup_type_value_ex_factory . '" name="ex_factory_markup[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',"' . $efup . '","' . $efma . '","' . $tpef . '")>';
				$fup = "fabric_price" . $rfqId . $i;
				$fma = "fabric_markup" . $rfqId . $i;
				$tpfab = "unit_total_price_fabric" . $rfqId . $i;
				$table['fabric_markup'] = '<input type="text" id="fabric_markup' . $rfqId . $i . '" value="' . $markup_type_value_fabric . '" name="fabric_markup[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['fabric_quantity'] . ',"' . $fup . '","' . $fma . '","' . $tpfab . '")>';
				$lup = "leather_price" . $rfqId . $i;
				$lma = "leather_markup" . $rfqId . $i;
				$tplet = "unit_total_price_leather" . $rfqId . $i;
				$table['leather_markup'] = '<input type="text" id="leather_markup' . $rfqId . $i . '" value="' . $markup_type_value_leather . '" name="leather_markup[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['leather_quantity'] . ',"' . $lup . '","' . $lma . '","' . $tplet . '")>';
			}
			$unit_total_price_ex_factory = (isset($bid[0]['unit_total_price_ex_factory'])) ? $bid[0]['unit_total_price_ex_factory'] : "";
			$table['unit_total_price_ex_factory'] = '<input type="text" id="unit_total_price_ex_factory' . $rfqId . $i . '" value="' . $unit_total_price_ex_factory . '" name="unit_total_price_ex_factory[]" style="width: 90px;" disabled>';
			$unit_total_price_fabric = (isset($bid[0]['unit_total_price_fabric'])) ? $bid[0]['unit_total_price_fabric'] : "";
			$table['unit_total_price_fabric'] = '<input type="text" id="unit_total_price_fabric' . $rfqId . $i . '" value="' . $unit_total_price_fabric . '" name="unit_total_price_fabric[]" style="width: 90px;" disabled>';
			$unit_total_price_leather = (isset($bid[0]['unit_total_price_leather'])) ? $bid[0]['unit_total_price_leather'] : "";
			$table['unit_total_price_leather'] = '<input type="text" id="unit_total_price_leather' . $rfqId . $i . '" value="' . $unit_total_price_leather . '" name="unit_total_price_leather[]" style="width: 90px;" disabled>';
			$tmp = "total_price_markup" . $rfqId . $i;
			$toef = "total_order_price_ex_factory" . $rfqId . $i;
			$sp = "selling_price" . $rfqId . $i;

			//$total_price_markup = (isset($bid[0]['total_price_markup']))?$bid[0]['total_price_markup']:"";

			//$table['total_price_markup'] = '<input type="text" id="total_price_markup'.$rfqId.$i.'" value="'.$total_price_markup.'" name="total_price_markup[]" style="width: 90px;" onkeyup=getSellingPrice("'.$tmp.'","'.$toef.'","'.$sp.'")>';

			$selling_price = (isset($bid[0]['selling_price'])) ? $bid[0]['selling_price'] : "";
			$table['selling_price'] = '<input type="text" id="selling_price' . $rfqId . $i . '" value="' . $selling_price . '" name="selling_price[]" style="width: 90px;" disabled>';
			$selling_price = (isset($bid[0]['total_order_price_ex_factory'])) ? $bid[0]['total_order_price_ex_factory'] : "";
			$table['total_order_price_ex_factory'] = '<input type="text" id="total_order_price_ex_factory' . $rfqId . $i . '" value="' . $selling_price . '" name="total_order_price_ex_factory[]" style="width: 90px;" disabled>';
			// }
			$i++;
			array_push($tables, $table);
		}
		
		
			$response['data'] = $tables;
			//print_r($tables);
			 //exit();
			$response['sId'] = '<input type="hidden" value="' . $userId . '" name="sId">';
			$response['rfqId'] = '<input type="hidden" value="' . $rfqId . '" name="rfqId">';
			$response['rebid_id'] = $value['rebid_id'];
			$response['code'] = 200;
			// echo "<pre>";
		}
		else{
			$response['code'] = 201;
		}
		
		$html = $this->load->view('bidtable', $response, true);
		$json['data'] = $html;
		$json['code'] = 200;
		echo json_encode($json);
	}

	public function bidDetails($id)
	{
		$select5 = '*';

		$where5 = array('activity_status' => 'active');

		$data['leadOpp'] = $this->rfqModel->getLeadOpportunities($select5, $where5);

		$data['value'] = array();

		$data['formheading'] = "Edit RFQ";

		$select = "b.*, bw.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS supplier_id, markup_type, markup_type_value_ex_factory,markup_type_value_fabric,markup_type_value_leather";

		$where = array('b.b_id' => $id);

		$join = true;

		$data['value'] = $this->rfqModel->getRfqlist($select, $where, $join);
		//print_r($id);
		$data['attachment'] = $this->rfqModel->getRFQDoc(array('fk_bid_id' => $id));

		if (is_array($data['value'])) {

			$data['value'] = $data['value'][0];
		}

		$select2 = "bw.bw_id, bw.item_name, bw.id_code";

		if (isset($pw_id)) {

			$where2 = array('bw.bw_id' => $pw_id);
		} else {

			$where2 = array('bw.fk_b_id' => $id);
		}

		$data['getItemList'] = $this->rfqModel->getItemList($select2, $where2);

		$select3 = "bf.*";

		$where3 = array('bf.fk_b_id' => $id);

		$data['getFormat'] = $this->rfqModel->getFormat($select3, $where3);
		$internal_company_name = $this->company->getCompany("c1.company_name", array('c1.company_type' => 'Internal', 'c1.company_id' => $data['value']['internal_company_id'], 'c1.activity_status' => 'active'));
		// print_r($internal_company_name);
		if (!empty($internal_company_name)) {
			$data['value']['internalcompany'] = $internal_company_name[0]['company_name'];
		}

		$data['b_id'] = $id;
		$data['redirectAction'] = '';
		// print_r($data);exit();
		$html = $this->load->view('showBidDetials', $data, true);

		$json['data'] = $html;

		$json['code'] = 200;

		echo json_encode($json);
	}

	public function viewBid($rfqId)
	{
		$userId = $this->session->userdata('user_id');
		$select4 = "distinct(`u`.`full_name`), `c`.`company_name`, u.user_id";
		$where4 = array('bw.fk_b_id' => $rfqId);
		$response['supplier'] = $this->rfqModel->getRFQSupplierList($select4, $where4);
		// sponse['supplier'] = $this->rfqModel->getSupplierList($select4, $where4);
		$response['RFQ_id'] = $rfqId;
		$response['sId'] = '<input type="hidden" value="' . $userId . '" name="sId">';
		$html = $this->load->view('viewBid', $response, true);
		$json['data'] = $html;
		$json['code'] = 200;
		echo json_encode($json);
	}

	public function viewBidTable()
	{
		$post = $this->input->post();
		$rfqId = $post['RFQid'];
		$userId = $post['supplier'];

		$select2 = "b.markup_type,b.markup_type_value_ex_factory,b.markup_type_value_fabric,b.markup_type_value_leather,bw.bw_id, bw.room_type, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note,bw.selling_price";
		$where2 = array('bw.fk_b_id' => $rfqId);
		$item = $this->rfqModel->getItemList($select2, $where2);
		$tables = array();

		$i = 1;

		foreach ($item as $key => $value) {
			$markup_type = $value['markup_type'];
			$markup_type_value_ex_factory = $value['markup_type_value_ex_factory'];
			$markup_type_value_fabric = $value['markup_type_value_fabric'];
			$markup_type_value_leather = $value['markup_type_value_leather'];
			$bid = $this->rfqModel->getItemBid($value['bw_id'], $userId);
			$table['room_type'] = $value['room_type'];
			$table['item_name'] = $value['item_name'];
			$table['id_code'] = $value['id_code'];
			$table['item_type'] = $value['item_type'];
			$table['w'] = $value['width'];
			$table['d'] = $value['depth'];
			$table['h'] = $value['height'];
			$table['sh'] = $value['short_height'];
			$table['technical_description'] = $value['technical_description'];
			$table['qty'] = $value['quantity'];
			$table['fabric_quantity'] = $value['fabric_quantity'];
			$table['leather_quantity'] = $value['leather_quantity'];
			$ex_factory_unit_price = (isset($bid[0]['ex_factory_unit_price'])) ? $bid[0]['ex_factory_unit_price'] : "";

			if ($value['leather_quantity'] == '') {
				$value['leather_quantity'] = 0;
			}

			if ($value['fabric_quantity'] == '') {
				$value['fabric_quantity'] = 0;
			}

			$table['ex_factory_unit_price'] = '<span>' . $ex_factory_unit_price . '</span>';

			$fabric_price = (isset($bid[0]['fabric_price'])) ? $bid[0]['fabric_price'] : "0";
			$table['fabric_price'] = '<span>' . $fabric_price . '</span>';

			$leather_price = (isset($bid[0]['leather_price'])) ? $bid[0]['leather_price'] : "0";
			$table['leather_price'] = '<span>' . $leather_price . '</span>';

			$unit_price_fob = (isset($bid[0]['unit_price_fob'])) ? $bid[0]['unit_price_fob'] : "0";
			$table['unit_price_fob'] = '<span>' . $unit_price_fob . '</span>';

			$unit_price_cif = (isset($bid[0]['unit_price_cif'])) ? $bid[0]['unit_price_cif'] : "0";
			$table['unit_price_cif'] = '<span>' . $unit_price_cif . '</span>';

			$total_price_ex_factory = (isset($bid[0]['total_price_ex_factory'])) ? $bid[0]['total_price_ex_factory'] : "0";
			$table['total_price_ex_factory'] = '<span>' . $total_price_ex_factory . '</span>';

			$total_price_fob = (isset($bid[0]['total_price_fob'])) ? $bid[0]['total_price_fob'] : "0";
			$table['total_price_fob'] = '<span>' . $total_price_fob . '</span>';

			$total_price_cif = (isset($bid[0]['total_price_cif'])) ? $bid[0]['total_price_cif'] : "0";
			$table['total_price_cif'] = '<span>' . $total_price_cif . '</span>';

			$table['cbm'] = $value['cbm'];
			$table['note'] = $value['note'];

			if ($markup_type == 'fixed') {
				$table['ex_factory_markup'] = '<span>' . $markup_type_value_ex_factory . '</span>';
				$table['fabric_markup'] = '<span>' . $markup_type_value_fabric . '</span>';
				$table['leather_markup'] = '<span>' . $markup_type_value_leather . '</span>';
			} else {
				$table['ex_factory_markup'] = '<span>' . $markup_type_value_ex_factory . '</span>';
				$table['fabric_markup'] = '<span>' . $markup_type_value_fabric . '</span>';
				$table['leather_markup'] = '<span>' . $markup_type_value_leather . '</span>';
			}

			$unit_total_price_ex_factory = (isset($bid[0]['unit_total_price_ex_factory'])) ? $bid[0]['unit_total_price_ex_factory'] : "0";
			$table['unit_total_price_ex_factory'] = '<span>' . $unit_total_price_ex_factory . '</span>';

			$unit_total_price_fabric = (isset($bid[0]['unit_total_price_fabric'])) ? $bid[0]['unit_total_price_fabric'] : "0";
			$table['unit_total_price_fabric'] = '<span>' . $unit_total_price_fabric . '</span>';

			$unit_total_price_leather = (isset($bid[0]['unit_total_price_leather'])) ? $bid[0]['unit_total_price_leather'] : "0";
			$table['unit_total_price_leather'] = '<span>' . $unit_total_price_leather . '</span>';


			$selling_price = (isset($bid[0]['selling_price'])) ? $bid[0]['selling_price'] : "0";
			$table['selling_price'] = '<span>' . $selling_price . '</span>';

			$selling_price = (isset($bid[0]['total_order_price_ex_factory'])) ? $bid[0]['total_order_price_ex_factory'] : "0";
			$table['total_order_price_ex_factory'] = '<span>' . $selling_price . '</span>';

			$i++;

			array_push($tables, $table);
		}

		$response['data'] = $tables;
		$response['RFQ_id'] = $rfqId;
		//$response['RFQ_id'] = '<input type="hidden" value="' . $rfqId . '" name="RFQ_id">';
		$response['sId'] = '<input type="hidden" value="' . $userId . '" name="sId">';
		$html = $this->load->view('viewBidTable', $response, true);
		$json['data'] = $html;
		$json['code'] = 200;
		echo json_encode($json);
	}


	public function addBidPrice()

	{

		$post = $this->input->post();
		
		//print"<pre>";
		//print_r($post);die;

		$countData = count($post['ex_factory_unit_price']);

		$data = array();

		for ($i = 0; $i < $countData; $i++) {

			$data['ex_factory_unit_price'] = $post['ex_factory_unit_price'][$i];


			if (isset($post['unit_price_fob'][$i]) && $post['unit_price_fob'][$i] != '') {

				$data['unit_price_fob'] = $post['unit_price_fob'][$i];
			}

			if (isset($post['unit_price_fob'][$i]) && $post['unit_price_fob'][$i] != '') {

				$data['unit_price_cif'] = $post['unit_price_cif'][$i];
			}



			if (isset($post['fabric_quantity'][$i]) && $post['fabric_quantity'][$i] != '') {

				$data['fabric_quantity'] = $post['fabric_quantity'][$i];
			} else {

				$data['fabric_quantity'] = 0;
			}



			if (isset($post['leather_quantity'][$i]) && $post['leather_quantity'][$i] != '') {

				$data['leather_quantity'] = $post['leather_quantity'][$i];
			} else {

				$data['leather_quantity'] = 0;
			}



			if (isset($post['fabric_price'][$i]) && $post['fabric_price'][$i] != '') {

				$data['fabric_price'] = $post['fabric_price'][$i];
				
				$fabric_price = $post['fabric_price'][$i];
				if($fabric_price>0)
				{
					$fabric_price = $fabric_price;
				}
				else{
					$fabric_price = 0;
				}
				
				$fabric_quantity = $post['fabric_quantity'][$i];
				if($fabric_quantity>0)
				{
					$fabric_quantity = $fabric_quantity;
				}
				else{
					$fabric_quantity = 0;
				}

				$data['unit_total_price_fabric'] = ($fabric_price * $fabric_quantity);
				
				$unitFabricPrice = $data['unit_total_price_fabric'];

			} else {

				$data['fabric_price'] = 0;

				$unitFabricPrice = 0;
			}



			if (isset($post['leather_price'][$i]) && $post['leather_price'][$i] != '') {

				$data['leather_price'] = $post['leather_price'][$i];
				
				$leather_price = $post['leather_price'][$i];
				if($leather_price>0)
				{
					$leather_price = $leather_price;
				}
				else{
					$leather_price = 0;
				}
				
				$leather_quantity = $post['leather_quantity'][$i];
				if($leather_quantity>0)
				{
					$leather_quantity = $leather_quantity;
				}
				else{
					$leather_quantity = 0;
				}
				

				$data['unit_total_price_leather'] = $leather_price * $leather_quantity;
				
				$unitLeatherPrice = $data['unit_total_price_leather'];
			} else {

				$data['leather_price'] = 0;

				$unitLeatherPrice = 0;
			}

			$data['unit_total_price_ex_factory'] = 0;
			$post['ex_factory_unit_price'][$i];
			$post['ex_factory_quantity'][$i];
			$data['unit_total_price_ex_factory'] = $post['ex_factory_unit_price'][$i] * $post['ex_factory_quantity'][$i];


			$data['total_order_price_ex_factory'] = $unitFabricPrice + $unitLeatherPrice + $data['unit_total_price_ex_factory'];


			$data['total_price_markup'] = 0; //$post['total_price_markup'][$i];

			if(isset($data['total_order_price_ex_factory'])) {

			$sell = ($data['total_price_markup'] / 100) * $data['total_order_price_ex_factory'];

		    }

			$data['selling_price'] = $sell + $data['total_order_price_ex_factory'];
			// print_r($data);

// exit();

			//$data['leather_quantity'] = $post['leather_quantity'][$i];

			$data['ex_factory_quantity'] = $post['ex_factory_quantity'][$i];

			$data['total_price_markup'] = 0; //$post['total_price_markup'][$i];

			$data['fk_bw_id'] = $post['bw_id'][$i];

			$data['fk_user_id'] = $post['sId'];


			if (isset($post['bwi_id'][$i]) && $post['bwi_id'][$i] != '') {

				$this->rfqModel->updateRfqBidPrice($post['bwi_id'][$i], $data);
			} else {

				$this->rfqModel->insertRfqBidPrice($data);
			}
		}
		// exit();

		redirect('rfq');
	}



	public function rfqDataAnalysis($rfqId)

	{

		$select2 = "bw.bw_id, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note";

		$where2 = array('bw.fk_b_id' => $rfqId);

		$item = $this->rfqModel->getItemListForAnalysis($select2, $where2);

		$tables = array();

		foreach ($item as $key => $value) {

			$table['item'] = $value['item_name'];

			$table['item_type'] = $value['item_type'];

			$table['id_code'] = $value['id_code'];

			$table['quantity'] = $value['quantity'];

			$table['fabric_quantity'] = $value['fabric_quantity'];

			$table['leather_quantity'] = $value['leather_quantity'];



			$bid = $this->rfqModel->getItemBidPrice($value['bw_id']);

			$bidCount = count($bid);

			foreach ($bid as $innerkey => $innervalue) {

				$table['supplier' . ($innerkey + 1)] = $innervalue['total_price_fob'];
			}

			//print_r($table);exit;

			array_push($tables, $table);
		}



		$html = $this->load->view('dataAnalysis', array('data' => $tables, 'count' => $bidCount, 'fk_b_id' => $rfqId), true);

		$json['data'] = $html;

		$json['code'] = 200;

		echo json_encode($json);
	}



	/**

	 * This is export a company detail.

	 * @author Sagar Kodalkar

	 * @return excel object

	 */

	public function createItemExcelAnalysis()
	{

		$selectedColumns = $this->input->post();

		$fk_b_id = $selectedColumns['fk_b_id'];



		$fieldName = array('item', 'item_type', 'id_code', 'Quantity', 'Fabric Quantity', 'Leather Quantity');



		$select2 = "bw.bw_id, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note";

		$where2 = array('bw.fk_b_id' => $fk_b_id);

		$item = $this->rfqModel->getItemListForAnalysis($select2, $where2);

		foreach ($item as $key => $value) {

			$bid = $this->rfqModel->getItemBidPrice($value['bw_id']);

			$bidCount = count($bid);

			// foreach ($bid as $innerkey => $innervalue) {

			// 	array_push($fieldName, 'supplier'.($innerkey+1));

			// }

			$innerkey = 0;

			for ($i = 0; $i < $bidCount; $i++) {

				array_push($fieldName, 'supplier' . ($innerkey + 1));
			}
		}



		$selectedColumns['columnFields'] = implode(', ', $fieldName);

		$fileName = 'RFQ_Item_List ' . date('d-m-y') . '.xlsx';

		if (isset($selectedColumns['columnFields'])) {

			$columnArray = explode(',', $selectedColumns['columnFields']);

			foreach ($columnArray as $cA) {

				$getColumn[] = ucwords(str_replace('_', ' ', $cA));
			}

			$columnString = "*";

			$whereBidId = array('fk_b_id' => $fk_b_id);

			//$rfqData = $this->rfqModel->exportRfqItem($select2, $where2);

			$alphabets = range('A', 'Z');

			//echo $alphabets[1];exit;

			$spreadsheet = new Spreadsheet();

			$sheet = $spreadsheet->getActiveSheet();

			$col = 0;



			foreach ($getColumn as $column) {

				$sheet->setCellValue($alphabets[$col] . '1', $column);

				$col++;
			}

			$rows = 2;

			$col = 0;

			$ii = 0;

			$bid = $this->rfqModel->getItemBidPrice($value['bw_id']);

			$bidCount = count($bid);

			foreach ($item as $key => $val) {

				if (isset($val['item_name'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['item_name']);

					$col++;
				}

				if (isset($val['item_type'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['item_type']);

					$col++;
				}

				if (isset($val['id_code'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['id_code']);

					$col++;
				}

				if (isset($val['quantity'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['quantity']);

					$col++;
				}

				if (isset($val['fabric_quantity'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['fabric_quantity']);

					$col++;
				}

				if (isset($val['leather_quantity'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['leather_quantity']);

					$col++;
				}





				//foreach ($bid as $innerkey => $innervalue) {

				//$table['supplier'.($innerkey+1)] = $innervalue['total_price_fob'];

				if (isset($bid[$ii]['total_price_fob'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $bid[$ii]['total_price_fob']);

					$col++;
				}

				//}

			}

			$rows++;

			$col = 0;

			$ii++;
		}

		$writer = new Xlsx($spreadsheet);

		$writer->save("upload/" . $fileName);

		header("Content-Type: application/vnd.ms-excel");



		//redirect(base_url()."/upload/".$fileName);

		$excelUrl = base_url() . 'upload/' . $fileName;

		echo $excelUrl;
	}





	public function createItemExcel()
	{

		$selectedColumns = $this->input->post();



		$list = $selectedColumns['b_id'];

		//print_r($selectedColumns['b_id']);exit;

		//$list = 20;

		$fieldName = array('Room Type', 'Item_name', 'id_code', 'item_type', 'Width', 'Depth', 'Height', 'Short Height', 'Quantity', 'Fabric Quantity', 'Leather Quantity', 'unit_price_(_ex_factory_)', 'fabric_price', 'leather_price', 'unit_price_fob', 'unit_price_cif', 'cbm', 'note');

		$selectedColumns['columnFields'] = implode(', ', $fieldName);

		$fileName = 'RFQ_Item_List ' . date('d-m-y') . '.xlsx';

		//if (isset($selectedColumns['columnFields'])) {

		// $columnArray = explode(',', $selectedColumns['columnFields']);

		// foreach ($columnArray as $cA) {

		//     $getColumn[] = ucwords(str_replace('_', ' ', $cA));

		// }

		$columnString = "*";

		$whereBidId = array('fk_b_id' => $list);

		$rfqData = $this->rfqModel->exportRfqItem($columnString, $whereBidId);

		//print_r($rfqData);exit;

		$alphabets = range('A', 'Z');



		// create file name

		$fileName = 'RFQ_Item_List ' . date('d-m-y') . '.xlsx';

		// load excel library

		$this->load->library('excel');

		//$empInfo = $this->export->employeeList();

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->setActiveSheetIndex(0);

		// set Header

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Room Type');

		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Item_name');

		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Id Code');

		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Item Type');

		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Width');

		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Depth');

		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Height');

		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Short Height');

		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Quantity');

		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Fabric Quantity');

		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Leather Quantity');

		// $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Unit Price (Ex-Factory)');

		// $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Fabric Price');

		// $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Leather Price');

		// $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Unit Price FOB');

		// $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Unit Price CIF');

		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'CBM');

		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Note');

		// set Row

		$rowCount = 2;

		foreach ($rfqData as $element) {

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['room_type']);

			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['item_name']);

			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['id_code']);

			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['item_type']);

			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['width']);

			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['depth']);

			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['height']);

			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['short_height']);

			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['quantity']);

			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['fabric_quantity']);

			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['leather_quantity']);

			// $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['ex_factory_unit_price']);

			// $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['fabric_price']);

			// $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element['leather_price']);

			// $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element['unit_price_fob']);

			// $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element['unit_price_cif']);

			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['cbm']);

			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['note']);

			$rowCount++;
		}

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		$objWriter->save('upload/' . $fileName);

		// download file

		//header("Content-Type: application/vnd.ms-excel");

		//redirect( base_url().'assets/uploads/import/'. $fileName);

		//echo $alphabets[1];exit;

		// $spreadsheet = new Spreadsheet();

		// $sheet = $spreadsheet->getActiveSheet();

		// $col = 0;

		// foreach ($getColumn as $column) {

		//     $sheet->setCellValue($alphabets[$col].'1', $column);

		//     $col++;

		// }

		// $rows = 2;

		// $col = 0;

		// foreach ($rfqData as $val){

		//     if(isset($val['room_type'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['room_type']);

		//         $col++;

		//     }



		//     if(isset($val['item_name'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['item_name']);

		//         $col++;

		//     }

		//     if(isset($val['id_code'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['id_code']);

		//         $col++;

		//     }

		//     if(isset($val['item_type'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['item_type']);

		//         $col++;

		//     }

		//     if(isset($val['width'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['width']);

		//         $col++;

		//     }

		//     if(isset($val['depth'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $rows, $val['depth']);

		//         $col++;

		//     }

		//     if(isset($val['height'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['height']);

		//         $col++;

		//     }

		//     if(isset($val['short_height'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['short_height']);

		//         $col++;

		//     }



		//     if(isset($val['quantity'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['quantity']);

		//         $col++;

		//     }

		//     if(isset($val['fabric_quantity'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['fabric_quantity']);

		//         $col++;

		//     }

		//     if(isset($val['leather_quantity'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['leather_quantity']);

		//         $col++;

		//     }

		//     if(isset($val['ex_factory_unit_price'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['ex_factory_unit_price']);

		//         $col++;

		//     }

		//     if(isset($val['fabric_price'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['fabric_price']);

		//         $col++;

		//     }

		//     if(isset($val['leather_price'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['leather_price']);

		//         $col++;

		//     }if(isset($val['unit_price_fob'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['unit_price_fob']);

		//         $col++;

		//     }

		//     if(isset($val['unit_price_cif'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['unit_price_cif']);

		//         $col++;

		//     }

		//     if(isset($val['cbm'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['cbm']);

		//         $col++;

		//     }

		//     if(isset($val['note'])) {

		//         $sheet->setCellValue($alphabets[$col]. $rows, $val['note']);

		//         $col++;

		//     }

		//     $rows++;

		//     $col=0;

		// }

		// $writer = new Xlsx($spreadsheet);

		// $writer->save("upload/".$fileName);

		// header("Content-Type: application/vnd.ms-excel");

		//}

		//redirect(base_url()."/upload/".$fileName);

		$excelUrl = base_url() . 'upload/' . $fileName;

		//$excelUrl = base_url().'assets/uploads/import/'. $fileName;

		echo $excelUrl;
	}



	public function bidchange($id)
	{

		$data['data'] = '<button type="button" class="btn mr-md-2 mb-md-0 mb-2 btn-success" style="margin-right:10px;" style="" onclick="reBidStatus(\'' . $id . '\',\'accept\')">Re-BID Accept</button><button type="button" class="btn mr-md-2 mb-md-0 mb-2 btn-danger" style="margin-right:10px;" onclick="reBidStatus(\'' . $id . '\',\'reject\')">Re-BID Reject</button>';

		$data['code'] = '200';

		echo json_encode($data);
	}



	// public function changeStatus($id, $status)

	// {

	// 	$rfqStatus = ($status == 'accept') ? 'Accepted' : 'Rejected';



	// 	if ($status == 'accept') {

	// 		$version = $this->rfqModel->getLatestVersion($id);

	// 		$this->rfqModel->dublicateBid($id, $version);
	// 	}



	// 	$this->rfqModel->updateRFQ(['status' => $rfqStatus], ['b_id' => $id]);

	// 	redirect('rfq');
	// }
	public function changeStatus($id, $status)

	{
		// echo $status;
		$status = str_replace("_", " ", $status);

		// $rfqStatus = ($status == 'accept') ? 'Accepted' : 'Rejected';



		// if ($status == 'Re Bid') {

		$version = $this->rfqModel->getLatestVersion($id);

		$ReBid_id = $this->rfqModel->dublicateBid($id, $version);
		// }

		$this->rfqModel->updateRFQ(['status' => "Processing"], ['b_id' => $ReBid_id]);


		$this->rfqModel->updateRFQ(['status' => $status, 'rebid_id' => $ReBid_id], ['b_id' => $id]);

		redirect('rfq');
	}
	public function changeRebidStatus($id, $status)

	{
		$parts = "";
		$userId = $this->session->userdata('user_id');
		$rebidStatus = ($status == 'accept') ? 'Accepted' : 'Rejected';

		$select = "b.*";
		$where = array('b.b_id' => $id);

		$value = $this->rfqModel->getRfqlist($select, $where);
		if (!empty($value[0]['rebid_suppliers'])) {
			$parts = explode(',', $value[0]['rebid_suppliers']);
		}
		if ($rebidStatus == 'Accepted') {
			$parts = explode(',', $value[0]['accept_rebid_id']);
			$field_name = "accept_rebid_id";
			$parts[] = $userId;
		} else if ($rebidStatus == 'Rejected') {
			$parts = explode(',', $value[0]['reject_rebid_id']);
			$field_name = "reject_rebid_id";
			$parts[] = $userId;
		}
		$parts = array_filter($parts);
		if ($parts != "") {
			$newValue = implode(',', $parts);
		}
		$rebid_time = 0;
		if($value[0]['rebid_time']==0){
			$rebid_time = 1;
		}
		$this->rfqModel->updateRFQ([$field_name => $newValue,'rebid_time' => $rebid_time], ['b_id' => $id]);

		// exit();

		redirect('rfq');
	}



	public function uploadReBid($rfqId)

	{

		$userId = $this->session->userdata('user_id');



		$version = $this->rfqModel->getLatestVersion($rfqId);



		$permissionsAdmin = $this->permission->checkUserPermission(40);

		$permissionsSupplier = $this->permission->checkUserPermission(41);



		$select2 = "b.markup_type,b.markup_type_value_ex_factory,b.markup_type_value_fabric,b.markup_type_value_leather,bw.bw_id, bw.room_type, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note,bw.selling_price";

		$where2 = array('bw.fk_b_id' => $rfqId);

		$item = $this->rfqModel->getItemList($select2, $where2);

		$tables = array();



		$i = 1;

		foreach ($item as $key => $value) {

			$markup_type = $value['markup_type'];

			$markup_type_value_ex_factory = $value['markup_type_value_ex_factory'];

			$markup_type_value_fabric = $value['markup_type_value_fabric'];

			$markup_type_value_leather = $value['markup_type_value_leather'];

			$bid = $this->rfqModel->getItemBidPrice($value['bw_id'], $userId);

			$table['room_type'] = $value['room_type'];

			$table['item_name'] = $value['item_name'];

			$table['id_code'] = $value['id_code'];

			$table['item_type'] = $value['item_type'];

			$table['w'] = $value['width'];

			$table['d'] = $value['depth'];

			$table['h'] = $value['height'];

			$table['sh'] = $value['short_height'];

			$table['technical_description'] = $value['technical_description'];

			$table['qty'] = $value['quantity'];

			$table['fabric_quantity'] = $value['fabric_quantity'];

			$table['leather_quantity'] = $value['leather_quantity'];



			$table['bw_id'] = '<input type="hidden" value="' . $value['bw_id'] . '" name="bw_id[]">';



			$bwi_id = (isset($bid[0]['bwi_id'])) ? $bid[0]['bwi_id'] : "";

			$table['bwi_id'] = '<input type="hidden" value="' . $bwi_id . '" name="bwi_id[]">';



			$table['fabric_quantity_hidden'] = '<input type="hidden" id="fabric' . $rfqId . $i . '" value="' . $value['fabric_quantity'] . '" name="fabric_quantity[]">';



			$table['leather_quantity_hidden'] = '<input type="hidden" id="leather' . $rfqId . $i . '" value="' . $value['leather_quantity'] . '" name="leather_quantity[]">';



			$table['ex_factory_quantity'] = '<input type="hidden" id="quantity' . $rfqId . $i . '" value="' . $value['quantity'] . '" name="ex_factory_quantity[]">';



			// if ($permissionsSupplier) {

			$ex_factory_unit_price = (isset($bid[0]['ex_factory_unit_price'])) ? $bid[0]['ex_factory_unit_price'] : "";



			$efup = "ex_factory_unit_price" . $rfqId . $i;

			$fbup = "fabric_price" . $rfqId . $i;

			$lup = "leather_price" . $rfqId . $i;

			$utpf = "unit_total_price_fabric" . $rfqId . $i;

			$utpl = "unit_total_price_leather" . $rfqId . $i;

			$tpef = "unit_total_price_ex_factory" . $rfqId . $i;

			$topef = "total_order_price_ex_factory" . $rfqId . $i;
			$sp = "selling_price" . $rfqId . $i;


			if ($value['leather_quantity'] == '') {

				$value['leather_quantity'] = 0;
			}

			if ($value['fabric_quantity'] == '') {

				$value['fabric_quantity'] = 0;
			}



			$table['ex_factory_unit_price'] = '<input type="text" id="ex_factory_unit_price' . $rfqId . $i . '" value="' . $ex_factory_unit_price . '" name="ex_factory_unit_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',' . $value['fabric_quantity'] . ',' . $value['leather_quantity'] . ',"' . $efup . '","' . $fbup . '","' . $lup . '","' . $utpf . '","' . $utpl . '","' . $tpef . '","' . $topef . '","' . $sp . '")>';



			$fup = "fabric_price" . $rfqId . $i;

			$fma = "fabric_markup" . $rfqId . $i;

			$tpfab = "unit_total_price_fabric" . $rfqId . $i;



			$fabric_price = (isset($bid[0]['fabric_price'])) ? $bid[0]['fabric_price'] : "";

			$table['fabric_price'] = '<input type="text" id="fabric_price' . $rfqId . $i . '" value="' . $fabric_price . '" name="fabric_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',' . $value['fabric_quantity'] . ',' . $value['leather_quantity'] . ',"' . $efup . '","' . $fbup . '","' . $lup . '","' . $utpf . '","' . $utpl . '","' . $tpef . '","' . $topef . '","' . $sp . '")>';



			$lup = "leather_price" . $rfqId . $i;

			$lma = "leather_markup" . $rfqId . $i;

			$tplet = "unit_total_price_leather" . $rfqId . $i;



			$leather_price = (isset($bid[0]['leather_price'])) ? $bid[0]['leather_price'] : "";

			$table['leather_price'] = '<input type="text" id="leather_price' . $rfqId . $i . '" value="' . $leather_price . '" name="leather_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',' . $value['fabric_quantity'] . ',' . $value['leather_quantity'] . ',"' . $efup . '","' . $fbup . '","' . $lup . '","' . $utpf . '","' . $utpl . '","' . $tpef . '","' . $topef . '","' . $sp . '")>';



			$ufob = "unit_price_fob" . $rfqId . $i;

			$fobmarkup = '0';

			$tfob = "total_price_fob" . $rfqId . $i;



			$unit_price_fob = (isset($bid[0]['unit_price_fob'])) ? $bid[0]['unit_price_fob'] : "";

			$table['unit_price_fob'] = '<input type="text" id="unit_price_fob' . $rfqId . $i . '" value="' . $unit_price_fob . '" name="unit_price_fob[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',"' . $ufob . '","' . $fobmarkup . '","' . $tfob . '")>';



			$ucif = "up_cif" . $rfqId . $i;

			$cifmarkup = '0';

			$tcif = "tp_cif" . $rfqId . $i;



			$unit_price_cif = (isset($bid[0]['unit_price_cif'])) ? $bid[0]['unit_price_cif'] : "";

			$table['unit_price_cif'] = '<input type="text" id="up_cif' . $rfqId . $i . '" value="' . $unit_price_cif . '" name="unit_price_cif[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',"' . $ucif . '","' . $cifmarkup . '","' . $tcif . '")>';



			$total_price_ex_factory = (isset($bid[0]['total_price_ex_factory'])) ? $bid[0]['total_price_ex_factory'] : "";

			$table['total_price_ex_factory'] = '<input type="text" id="total_price_ex_factory' . $rfqId . $i . '" value="' . $total_price_ex_factory . '" name="total_price_ex_factory[]" style="width: 90px;" readonly>';



			$total_price_fob = (isset($bid[0]['total_price_fob'])) ? $bid[0]['total_price_fob'] : "";

			$table['total_price_fob'] = '<input type="text" id="total_price_fob' . $rfqId . $i . '" value="' . $total_price_fob . '" name="total_price_fob[]" style="width: 90px;" disabled>';



			$total_price_cif = (isset($bid[0]['total_price_cif'])) ? $bid[0]['total_price_cif'] : "";

			$table['total_price_cif'] = '<input type="text" id="tp_cif' . $rfqId . $i . '" value="' . $total_price_cif . '" name="total_price_cif[]" style="width: 90px;" disabled>';



			$table['cbm'] = $value['cbm'];

			$table['note'] = $value['note'];

			// }



			// if ($permissionsAdmin) {

			//$ex_factory_markup = (isset($bid[0]['ex_factory_markup']))?$bid[0]['ex_factory_markup']:"";

			if ($markup_type == 'fixed') {

				$table['ex_factory_markup'] = '<input type="text" id="ex_factory_markup' . $rfqId . $i . '" value="' . $markup_type_value_ex_factory . '" name="ex_factory_markup[]" style="width: 90px;" disabled>';

				//$fabric_markup = (isset($bid[0]['fabric_markup']))?$bid[0]['fabric_markup']:"";

				$table['fabric_markup'] = '<input type="text" id="fabric_markup' . $rfqId . $i . '" value="' . $markup_type_value_fabric . '" name="fabric_markup[]" style="width: 90px;" disabled>';

				//$leather_markup = (isset($bid[0]['leather_markup']))?$bid[0]['leather_markup']:"";

				$table['leather_markup'] = '<input type="text" id="leather_markup' . $rfqId . $i . '" value="' . $markup_type_value_leather . '" name="leather_markup[]" style="width: 90px;" disabled>';
			} else {

				$efup = "ex_factory_unit_price" . $rfqId . $i;

				$efma = "ex_factory_markup" . $rfqId . $i;

				$tpef = "unit_total_price_ex_factory" . $rfqId . $i;

				$table['ex_factory_markup'] = '<input type="text" id="ex_factory_markup' . $rfqId . $i . '" value="' . $markup_type_value_ex_factory . '" name="ex_factory_markup[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',"' . $efup . '","' . $efma . '","' . $tpef . '")>';



				$fup = "fabric_price" . $rfqId . $i;

				$fma = "fabric_markup" . $rfqId . $i;

				$tpfab = "unit_total_price_fabric" . $rfqId . $i;

				$table['fabric_markup'] = '<input type="text" id="fabric_markup' . $rfqId . $i . '" value="' . $markup_type_value_fabric . '" name="fabric_markup[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['fabric_quantity'] . ',"' . $fup . '","' . $fma . '","' . $tpfab . '")>';



				$lup = "leather_price" . $rfqId . $i;

				$lma = "leather_markup" . $rfqId . $i;

				$tplet = "unit_total_price_leather" . $rfqId . $i;

				$table['leather_markup'] = '<input type="text" id="leather_markup' . $rfqId . $i . '" value="' . $markup_type_value_leather . '" name="leather_markup[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['leather_quantity'] . ',"' . $lup . '","' . $lma . '","' . $tplet . '")>';
			}



			$unit_total_price_ex_factory = (isset($bid[0]['unit_total_price_ex_factory'])) ? $bid[0]['unit_total_price_ex_factory'] : "";

			$table['unit_total_price_ex_factory'] = '<input type="text" id="unit_total_price_ex_factory' . $rfqId . $i . '" value="' . $unit_total_price_ex_factory . '" name="unit_total_price_ex_factory[]" style="width: 90px;" disabled>';



			$unit_total_price_fabric = (isset($bid[0]['unit_total_price_fabric'])) ? $bid[0]['unit_total_price_fabric'] : "";

			$table['unit_total_price_fabric'] = '<input type="text" id="unit_total_price_fabric' . $rfqId . $i . '" value="' . $unit_total_price_fabric . '" name="unit_total_price_fabric[]" style="width: 90px;" disabled>';



			$unit_total_price_leather = (isset($bid[0]['unit_total_price_leather'])) ? $bid[0]['unit_total_price_leather'] : "";

			$table['unit_total_price_leather'] = '<input type="text" id="unit_total_price_leather' . $rfqId . $i . '" value="' . $unit_total_price_leather . '" name="unit_total_price_leather[]" style="width: 90px;" disabled>';



			$tmp = "total_price_markup" . $rfqId . $i;

			$toef = "total_order_price_ex_factory" . $rfqId . $i;

			$sp = "selling_price" . $rfqId . $i;



			//$total_price_markup = (isset($bid[0]['total_price_markup']))?$bid[0]['total_price_markup']:"";

			//$table['total_price_markup'] = '<input type="text" id="total_price_markup'.$rfqId.$i.'" value="'.$total_price_markup.'" name="total_price_markup[]" style="width: 90px;" onkeyup=getSellingPrice("'.$tmp.'","'.$toef.'","'.$sp.'")>';



			$selling_price = (isset($bid[0]['selling_price'])) ? $bid[0]['selling_price'] : "";

			$table['selling_price'] = '<input type="text" id="selling_price' . $rfqId . $i . '" value="' . $selling_price . '" name="selling_price[]" style="width: 90px;" disabled>';



			$selling_price = (isset($bid[0]['total_order_price_ex_factory'])) ? $bid[0]['total_order_price_ex_factory'] : "";

			$table['total_order_price_ex_factory'] = '<input type="text" id="total_order_price_ex_factory' . $rfqId . $i . '" value="' . $selling_price . '" name="total_order_price_ex_factory[]" style="width: 90px;" disabled>';



			// }

			$i++;

			array_push($tables, $table);
		}



		$response['data'] = $tables;

		$response['sId'] = '<input type="hidden" value="' . $userId . '" name="sId">';
		$response['rfqId'] = '<input type="hidden" value="' . $rfqId . '" name="rfqId">';

		$html = $this->load->view('bidtable', $response, true);

		$json['data'] = $html;

		$json['code'] = 200;

		echo json_encode($json);
	}
}
