<?php

defined('BASEPATH') or exit('No direct script access allowed');



use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Purchase_order extends CI_Controller
{



	/**

	 * Proposal Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://DomainName/proposal

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

		$this->load->model(array('PO_model' => 'POModel'));

		$this->load->library(array('PO_library' => 'PO'));

		$this->load->library(array('Permissions_library' => 'permission'));

		$this->load->model(array('Rfq_model' => 'rfqModel'));
	}



	/**

	 * index action of Proposal controller

	 * @author Sagar Kodalkar

	 */

	public function index()

	{

		$permissions = $this->permission->checkUserPermission(31);

		if (!$permissions) {

			redirect('page_not_found');
			exit;
		}

		// set title

		$this->page->setTitle('Purchase Order');



		// set head style

		$this->page->setHeadStyle(base_url() . "assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style.bundle.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/css/style.css");

		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");

		//$this->page->setHeadStyle(base_url()."assets/custom/css/editor.css");



		//set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs(base_url() . "assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url() . "assets/demo/default/base/scripts.bundle.js");

		$this->page->setFooterJs("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");

		//$this->page->setFooterJs(base_url()."assets/custom/js/editor.js");

		//$this->page->setFooterJs("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js");



		$this->page->setFooterJs(base_url() . "assets/custom/js/ajax.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/purchase_order.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/custom.js");

		//$this->page->setFooterJs(base_url()."assets/app/js/datepicker.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/datatable.js");

		//$this->page->setFooterJs(base_url()."assets/custom/js/datatable2.js");

		//$this->page->setFooterJs(base_url()."assets/custom/js/autocomplete.js");



		// text editor js

		$this->page->setFooterJs(base_url() . "assets/ckeditor/ckeditor.js");





		$page['getFilterData'] = '';

		if (isset($_POST) && !empty($_POST)) {

			$page['getFilterData'] = $this->input->post();

			//print_r($page['getFilterData']);exit;

			$page['getFilterData'] = $page['getFilterData'];
		}

		if (isset($page['getFilterData']['saved_filter_id'])) {

			$page['savedfilterID'] = $page['getFilterData']['saved_filter_id'];
		}

		// load layout

		$page['contain'] = 'purchase_order';

		//List Parent Companies

		// $select2 = 't1.*, t2.company_name as parent_company';

		// $where = array('t1.company_type' => self::COMPANY_ARRAY[$companyType], 't1.activity_status' => 'active');

		// $page['parentCompany'] = $this->POModel->getCompany($select2,$where);

		//print_r($page['parentCompany']);exit;

		//List Countries

		// $select = 'nicename,phonecode';

		// $page['country'] = $this->POModel->getCountry($select);



		$page['redirectAction'] = '';

		$page['importAction'] = base_url() . 'proposal/importData';



		//-- get sales person--

		$select = "u.user_id, CONCAT (u.first_name,' ',u.last_name) AS name";

		$where = array('u.active_status' => 'active');

		$page['getSalesperson'] = $this->POModel->getSalesperson($select, $where);

		// -- Get Saved Filter

		$select2 = "filter_id, filter_name, filter_values";

		$where2 = array('module' => 'Proposal');

		$page['getSavedFilter'] = $this->POModel->getSavedFilter($select2, $where2);



		$page['config'] = $this->PO->getConfig();

		$page['tabs'] = $this->PO->getTabs();

		$page['action'] = $this->PO->getAction();

		$page['proposalColumn'] = $this->PO->getProposalColumn();

		$page['checkedAction'] = $this->PO->getCheckedAction();

		$page['module_name'] = $this->uri->segment(1);

		$page['gridView'] = $this->POModel->getGrid('*', array('module_name' => $page['module_name']));
		$page['access'] = $this->session->userdata('adminAccess');


		$page['addPermission'] = $this->permission->checkUserPermission(32);

		$page['editPermission'] = $this->permission->checkUserPermission(33);

		$page['deletePermission'] = $this->permission->checkUserPermission(34);



		$page['showOpportunity'] = $this->permission->checkUserPermission(17);

		$page['showActivity'] = $this->permission->checkUserPermission(22);

		$page['showActivityCalendar'] = $this->permission->checkUserPermission(17);

		$page['showRFQ'] = $this->permission->checkUserPermission(26);
		$page['showReleasePO'] = $this->permission->checkUserPermission(47);
		$page['showReleaseInvoice'] = $this->permission->checkUserPermission(48);

		$page['showProposal'] = $this->permission->checkUserPermission(31);

		$page['showJobs'] = $this->permission->checkUserPermission(36);



		$this->page->getLayout($page);
	} // end : index Action





	/**

	 * addProposal action to Add part Data from proposal

	 * @author Sagar Kodalkar

	 */

	public function addProposal()
	{

		try {

			$post = $this->input->post();

			//@author: Sagar Kodalkar

			//Validation on input start

			$this->load->library('form_validation');

			$this->form_validation->set_rules('lead_opportunity_id', 'Lead Opportunity', 'required|numeric');

			if (isset($post['notes']) && $post['notes'] != '') {

				$this->form_validation->set_rules('notes', 'Notes', 'required');
			}

			if (isset($post['approval_deadline']) && $post['approval_deadline'] != '') {

				$this->form_validation->set_rules('approval_deadline', 'Approval Deadline', 'required');
			}



			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				$select = "CONCAT ('Proposal for ', lo.opportunity_title, '(', c.company_name, ')') AS name";

				$where = array('lo.lead_opportunity_id' => $post['lead_opportunity_id']);

				$getCompanyLeadOpp = $this->POModel->getCompanyLeadOpp($select, $where);



				$select = "count(title) AS totalcount";

				$getCountOfExistingLead = $this->POModel->getCountOfExistingLead($select, $getCompanyLeadOpp[0]['name']);

				$totalCount = $getCountOfExistingLead[0]['totalcount'] + 1;

				//print_r($totalCount);exit;

				if ($getCountOfExistingLead[0]['totalcount'] != 0) {

					$title = $getCompanyLeadOpp[0]['name'] . "(" . $totalCount . ")";
				} else {

					$title = $getCompanyLeadOpp[0]['name'];
				}

				if ($post['approval_deadline'] != '') {

					$newDate = date("d-m-Y", strtotime($post['approval_deadline']));
				} else {

					$newDate = $post['approval_deadline'];
				}



				$insertArray = array(

					'title' => $title,

					'fk_lead_opportunity_id' => $post['lead_opportunity_id'],

					'approval_deadline' => $newDate,

					'notes' => $post['notes'],

					'status' => 'Drafted',

				);

				//print_r($insertArray);exit;

				if (!isset($post['p_id'])) {

					$data['id'] = $this->POModel->insertProposal($insertArray);

					// $this->session->set_userdata('setMessage','Added');

					$add_P_id = array(

						'fk_pid' => $data['id'],

					);

					$data['itemId'] = $this->POModel->insertIdProposalWorksheet($add_P_id);

					$this->session->set_userdata('setMessage', 'Added');



					$whereNotificationID = array('fk_notification_id' => '18');

					$addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);

					$userIDs = json_decode($addLeadNotification['result'][0]['user_id']);

					$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

					foreach ($getEmailList as $key => $value) {

						$emailList[] = $value['contact_info'];
					}



					if ($addLeadNotification['count'] == 1) {

						$emailString = implode(',', $emailList);

						$subject = 'Proposal Added Successfully';

						$module = 'Proposal for';

						$name = $title;

						$action = 'added';

						$actionBy = $this->session->userdata('user_name');

						$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
					}
				} else {

					//print_r($insertArray);exit;

					$where = array('company_id' => $companyId);

					$data['id'] = $this->POModel->updateCompany($insertArray, $where);

					$this->session->set_userdata('setMessage', 'Updated');
				}



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





	public function getLeadCompany()
	{

		try {

			$keyword = strval($_POST['query']);

			$select = "CONCAT (lo.`opportunity_title`, '-', c.company_name) AS name";

			$where = array('lo.opportunity_title' => $keyword);

			$autocomplete = true;



			$getCompanyLeadOpp = $this->POModel->getCompanyLeadOpp($select, $where, $autocomplete);



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

				$Permission = $this->permission->checkUserPermission(33);
			} else {

				$Permission = $this->permission->checkUserPermission(32);
			}

			if ($Permission) {

				$user_type = $this->session->userdata('user_type');

				$select = '*';

				$where = array('activity_status' => 'active');

				$data['leadOpp'] = $this->POModel->getLeadOpportunities($select, $where);



				$select2 = 'company_id, company_name';

				$where2 = array('company_type' => 'Supplier', 'activity_status' => 'active');

				$data['supplier'] = $this->POModel->getSupplierList($select2, $where2);

				$data['formheading'] = 'Purchase Order';

				$data['value'] = array();

				if ($id) {

					$select = "p.*, pw.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS sales_people";

					$where = array('p.p_id' => $id);

					//$where = 'p.p_id = "'.$id.'"';

					$join = true;

					$data['value'] = $this->POModel->getProposallist($select, $where, $join);
					// print_r($data['value']);
					if (is_array($data['value'])) {

						$data['value'] = $data['value'][0];
					}



					$select2 = "pw.*, c.company_name, u.full_name";

					if ($pw_id) {

						$where2 = array('pw.pw_id' => $pw_id);
					} else {

						$where2 = array('pw.fk_pid' => $id);
					}

					$getItemList = $this->POModel->getItemList($select2, $where2);
					foreach ($getItemList as $Wproposal) {
						$Wproposal['rate_AED'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'];
						$Wproposal['total_amount'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'] * $Wproposal['quantity'];
						$markupAmount = ($Wproposal['markup'] / 100) * $Wproposal['total_amount'];
						$Wproposal['total_amount'] = $Wproposal['total_amount'] + $markupAmount;
						$Wproposal['supplier_id'] = $Wproposal['full_name'] . " (" . $Wproposal['company_name'] . ")";
						$propsalworksheet[] = $Wproposal;
					}
					$data['getItemList'] = $propsalworksheet;
					$select2 = "pf.*";

					$where2 = array('pf.fk_p_id' => $id);

					$data['getFormat'] = $this->POModel->getFormat($select2, $where2);



					$select2 = "sum(total_price_fob) as fob, sum(total_price_cif) as cif";

					$where2 = array('fk_pid' => $id);

					$data['getFobCif'] = $this->POModel->getTotalFOBCIF($select2, $where2);

					$approvePermission = $this->permission->checkUserPermission(35);
					// echo $approvePermission;
					// echo $this->session->userdata('access');
					// exit();

					if ($approvePermission && $this->session->userdata('adminAccess') == 'No') {


						$data['formheading'] = "<button type='button' id='approve' class='btn btn-outline-success m-btn m-btn--custom' style='font-family: sans-serif, Arial;'><span class='m-menu__link-badge'><span class='m-menu__link-icon call-form' data-url='proposal/commentData/'>Approval</span></span></button>
						
						<button type='button' id='decline' class='btn btn-outline-danger m-btn m-btn--custom' style='font-family: sans-serif, Arial;'><span class='m-menu__link-badge'><span class='m-menu__link-icon call-form' data-url='proposal/commentData/'>Decline</span></span></button>";

						// <button type='button' id='decline' class='btn btn-outline-danger m-btn m-btn--custom' style='font-family: sans-serif, Arial;'>Decline</button>";
					} else {
						// <button type='button' id='approve' class='btn btn-outline-success m-btn m-btn--custom' style='font-family: sans-serif, Arial;'>Approve</button>
						if ($data['value']['status'] != 'Released') {
							$data['formheading'] = "<button type='button' id='release' class='btn btn-outline-success m-btn m-btn--custom' style='font-family: sans-serif, Arial;'><span class='m-menu__link-badge'><span class='m-menu__link-icon call-form' data-url='proposal/commentData/'>Release</span></span></button>";
						}
					}
				}

				$data['p_id'] = $id;

				// $data['redirectAction'] = '';

				// $data['importAction'] = base_url() . 'proposal/importData';



				// if ($user_type == 'Customer') {

				// 	$select2 = "pw.*, c.company_name, u.full_name";

				// 	$where2 = array('pw.fk_pid' => $id);

				// 	$getItemList = $this->POModel->getItemList($select2, $where2);
				// 	foreach($getItemList as $Wproposal){
				// 		$Wproposal['rate_AED']=$Wproposal['rate_USD']*$Wproposal['exchange_rate'];
				// 		$Wproposal['total_amount']=$Wproposal['rate_USD']*$Wproposal['exchange_rate']*$Wproposal['quantity'];
				// 		$markupAmount = ($Wproposal['markup'] / 100) * $Wproposal['total_amount'];
				// 		$Wproposal['total_amount'] = $Wproposal['total_amount'] + $markupAmount;
				// 		$Wproposal['supplier_id'] = $Wproposal['full_name']." (".$Wproposal['company_name'].")";
				// 		$propsalworksheet[]=$Wproposal;
				// 	}
				// 	// $data['getItemList']="";
				// 	$data['getItemList']=$propsalworksheet;


				// 	$select3 = "pf.*";

				// 	$where3 = array('pf.fk_p_id' => $id);

				// 	$data['getFormat'] = $this->POModel->getFormat($select3, $where3);

				// }



				$html = $this->page->getPage('proposalForm', $data, true);



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

	public function getComment()
	{
		try {
			$post = $this->input->post();
			$select = 'pc.*,u.*';
			if ($this->session->userdata('adminAccess') == 'Yes') {

				$where = array('pc.p_id' => $post['fk_pid']);
			} else {

				$where = array('pc.p_id' => $post['fk_pid'], 'pc.commented_by' => $this->session->userdata('user_id'));
			}

			$data['comment'] = $this->POModel->getComment($select, $where);
			$data['status'] = $post['status'];
			// print_r($post);

			$html = $this->page->getPage('proposalComment', $data, true);



			$response['code'] = 200;

			$response['message'] = 'form generated';

			$response['html'] = $html;

			// $response['data']['heading'] = $data['formheading'];
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();
		}



		echo json_encode($response);

		exit;
	}

	public function addComment()
	{
		try {
			$post = $this->input->post();
			$insertCommentArray = array(

				'p_id' => $post['p_id'],

				'comment' => $post['comment'],

				'status' => $post['commentStatus'],
				'commented_by' => $this->session->userdata('user_id'),
				'commented_on' => date('Y-m-d'),

			);
			$data['comment'] = $this->POModel->addComment($insertCommentArray);
			// print_r($data['comment']);
			$user_id = $this->session->userdata('user_id');

			$user_type = $this->session->userdata('user_type');

			$post = $this->input->post();
			$status = $post['commentStatus'];

			$p_id = $post['p_id'];

			$updateArray = array(

				'status' => $status,

			);

			if ($user_type == 'Customer') {

				$updateArray['approved_by_customer'] = $user_id;
			} else {

				$updateArray['approved_by_admin'] = $user_id;
			}



			$wherePid = array('p_id' => $p_id);

			$getLeadOpportunityID = $this->POModel->getLeadOpportunityID($wherePid);



			$updateLeadArray = array(

				'job_status' => 'converted',

			);

			$whereLid = array('lead_opportunity_id' => $getLeadOpportunityID);



			$getLeadOpportunityID = $this->POModel->convertLead($updateLeadArray, $whereLid);



			$data = $this->POModel->setStatus($updateArray, $p_id);

			if ($post['commentStatus'] == 'Release Invoice') {
				$insertInvoiceArray = array(

					'fk_p_id' => $post['p_id'],


				);
				$data['comment'] = $this->POModel->addInvoice($insertInvoiceArray);
			}
			// $html = $this->page->getPage('proposalComment', $data, true);


			$response['code'] = 200;

			$response['message'] = "<div class='alert alert-success'>

                    <strong>Success!</strong> Status Updated Successfully !! .</div>";

			// $response['code'] = 200;

			// $response['message'] = 'form generated';

			// $response['html'] = $html;

			// $response['data']['heading'] = $data['formheading'];
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();
		}



		echo json_encode($response);

		exit;
	}

	public function displayApproveForm($id = null, $pw_id = null)
	{

		try {

			if ($id) {

				$Permission = $this->permission->checkUserPermission(33);
			} else {

				$Permission = $this->permission->checkUserPermission(32);
			}

			if ($Permission) {

				$select = '*';

				$where = array('activity_status' => 'active');

				$data['leadOpp'] = $this->POModel->getLeadOpportunities($select, $where);



				$select2 = 'company_id, company_name';

				$where2 = array('company_type' => 'Supplier', 'activity_status' => 'active');

				$data['supplier'] = $this->POModel->getSupplierList($select2, $where2);



				// $data['companyType'] = $companyType;

				$data['formheading'] = 'Add Proposal';

				$data['value'] = array();

				if ($id) {

					$select = "p.*, pw.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS sales_people";

					$where = array('p.p_id' => $id);

					//$where = 'p.p_id = "'.$id.'"';

					$join = true;

					$data['value'] = $this->POModel->getProposallist($select, $where, $join);

					if (is_array($data['value'])) {

						$data['value'] = $data['value'][0];
					}



					$select2 = "pw.*, c.company_name, u.full_name";

					if ($pw_id) {

						$where2 = array('pw.pw_id' => $pw_id);
					} else {

						$where2 = array('pw.fk_pid' => $id);
					}

					$getItemList = $this->POModel->getItemList($select2, $where2);
					foreach ($getItemList as $Wproposal) {
						$Wproposal['rate_AED'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'];
						$Wproposal['total_amount'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'] * $Wproposal['quantity'];
						$markupAmount = ($Wproposal['markup'] / 100) * $Wproposal['total_amount'];
						$Wproposal['total_amount'] = $Wproposal['total_amount'] + $markupAmount;
						$Wproposal['supplier_id'] = $Wproposal['full_name'] . " (" . $Wproposal['company_name'] . ")";
						$propsalworksheet[] = $Wproposal;
					}
					$data['getItemList'] = $propsalworksheet;
					$select2 = "pf.*";

					$where2 = array('pf.fk_p_id' => $id);

					$data['getFormat'] = $this->POModel->getFormat($select2, $where2);



					$select2 = "sum(total_price_fob) as fob, sum(total_price_cif) as cif";

					$where2 = array('fk_pid' => $id);

					$data['getFobCif'] = $this->POModel->getTotalFOBCIF($select2, $where2);

					$data['formheading'] = "<button type='button' id='declineProposal' class='btn btn-outline-danger m-btn m-btn--custom' style='font-family: sans-serif, Arial;'><span class='m-menu__link-badge'><span class='m-menu__link-icon call-form' data-url='proposal/commentData/'>Decline</span></span></button>";

					// <button type='button' id='approveProposal' class='btn btn-outline-success m-btn m-btn--custom' style='font-family: sans-serif, Arial;'>Approve</button><button type='button' id='declineProposal' class='btn btn-outline-danger m-btn m-btn--custom' style='font-family: sans-serif, Arial;'>Decline</button>

					$user_type = $this->session->userdata('user_type');
					// print_r();


					$wherecond['proposal_id'] = $id;

					// $dataPO = $this->POModel->getPO($wherecond);



					if (($user_type == 'Internal User' || $user_type == 'Customer') && ($this->session->userdata('adminAccess') == 'No') && empty($dataPO)) {

						$data['formheading'] .= "<button type='button' id='releasePO' class='btn btn-outline-success m-btn m-btn--custom' style='font-family: sans-serif, Arial;'>Release PO</button>";
					}

					if (($user_type != 'Suppliers' || $user_type != 'Customer') && $this->session->userdata('adminAccess') == "Yes") {

						$data['formheading'] .= "<button type='button' id='releaseInvoice' class='btn btn-outline-success m-btn m-btn--custom' style='font-family: sans-serif, Arial;'>Release Invoice</button>";
					}
				}

				
				// exit();

				$data['p_id'] = $id;

				$data['redirectAction'] = '';

				$data['importAction'] = base_url() . 'proposal/importData';



				$html = $this->page->getPage('proposalForm', $data, true);



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



	public function getItem($var = null)
	{

		$select = "item_name,id_code";

		$data['value'] = $this->POModel->getProposallistdemo($select);

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

	public function getPO()
	{

		$user_type = $this->session->userdata('user_type');

		$request = $this->input->get();

		if (!empty($request)) {

			$offset = $request['start'];

			$limit = $request['length'];

			$columnArray = $request['columns'];

			$columns = array_column($columnArray, 'data');

			if (array_key_exists("q", $request) && !empty(json_decode($request['q']))) {

				$requestNew = json_decode($request['q']);

				if (isset($requestNew->lead_opportunity) && !empty($requestNew->lead_opportunity)) {

					$where['lo.opportunity_title'] = $requestNew->lead_opportunity;

					$data['opportunity_title'] = $requestNew->lead_opportunity;
				}



				if (isset($requestNew->status) && !empty($requestNew->status)) {

					$where['p.status'] = $requestNew->status;

					$data['status'] = $requestNew->status;
				}



				if (isset($requestNew->opportunity_status) && !empty($requestNew->opportunity_status)) {

					$where['lo.activity_status'] = $requestNew->opportunity_status;

					$data['parent_company_id'] = $requestNew->opportunity_status;
				}



				if (isset($requestNew->created_date) && !empty($requestNew->created_date)) {

					if ($requestNew->created_date != '') {

						$newDate = date("d-m-Y", strtotime($requestNew->created_date));
					} else {

						$newDate = $requestNew->created_date;
					}

					$where['po.created_date'] = $newDate;

					$data['created_date'] = $newDate;
				}



				if (isset($requestNew->sales_person) && !empty($requestNew->sales_person)) {

					$where['lo.fk_user_id'] = $requestNew->sales_person;

					$data['sales_person'] = $requestNew->sales_person;
				}



				if ($user_type == 'Customer') {

					$where['u.user_id'] = $this->session->userdata('user_id');

					// $where['u.status'] = 'Approved';

				}
			} else {

				$where = '';

				//$where = 't1.company_type = "'.self::COMPANY_ARRAY[$companyType].'"';

				if (!empty($request['search']['value'])) {

					foreach ($select as $key => $value) {

						$where .= 't1' . $value . " Like '%" . $request['search']['value'] . "%'";
					}
				} else if ($user_type == 'Customer') {

					$where = array('po.created_by_customer'=> $this->session->userdata('user_id'));
				}
			}
		} else {

			$post = $this->input->post();

			// print_r($post);exit;

			if (isset($post[0]) && is_numeric($post[0])) {

				$lead_opportunity_id = $post[0];
			} else {

				if (isset($post['lead_opportunity_id']) && $post['lead_opportunity_id'] != '') {

					$lead_opportunity_id = $post['lead_opportunity_id'];
				} else {

					$lead_opportunity_id = 0;
				}
			}





			if ($user_type == 'Customer') {

				$where = array('fk_lead_opportunity_id' => $lead_opportunity_id, 'u.user_id' => $this->session->userdata('user_id'), 'po.created_by_customer'=> $this->session->userdata('user_id'));

				$where2 = array('fk_lead_opportunity_id' => $lead_opportunity_id);
			} else {

				$where = array('fk_lead_opportunity_id' => $lead_opportunity_id, 'p.status' => 'Drafted');

				$where2 = array('fk_lead_opportunity_id' => $lead_opportunity_id);
			}



			$limit = null;

			$offset = null;
		}

		$order = null;



		$select = "p.*,po.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS sales_people, CONCAT('$', SUM(pw.total_price_ex_factory)) as total_price_ex_factory, CONCAT('$', SUM(pw.unit_total_price_fabric)) as total_price_fabric, CONCAT('$', SUM(pw.unit_total_price_leather)) as total_price_leather, CONCAT('$', SUM(pw.total_price_fob)) as total_fob, CONCAT('$', SUM(pw.total_price_cif)) as total_cif";



		if (isset($request['order']) && is_array($request['order'])) {

			$order = $columns[$request['order'][0]['column']] . ' ' . $request['order'][0]['dir'];
		}


		$proposalList = $this->POModel->getPOlist($select, $where, $order, $limit, $offset);

		foreach ($proposalList as $key => $value) {

			$proposalList[$key]['title']=str_replace("Proposal", "PO", $proposalList[$key]['title']);


			if ($proposalList[$key]['created_date'] == "") {

				$proposalList[$key]['created_date'] = "---";

				//$opportunityDataList[$key]['age'] = "---";

			} else {

				$leadactiDate = $proposalList[$key]['created_date'];

				$actvity_up_date = date("d-M-Y", strtotime($leadactiDate));

				$proposalList[$key]['created_date'] = $actvity_up_date;
			}
		}

		if (!empty($request)) {

			if ($user_type == 'Customer') {

				$companycount[0]['count'] = count($proposalList);
			} else {

				$companycount = $this->POModel->getProposallistCount('count(*) as count', $where);
			}
		} else {

			if ($user_type == 'Customer') {

				$companycount[0]['count'] = count($proposalList);
			} else {

				$companycount = $this->POModel->getProposallistCount('count(*) as count', $where2);
			}
		}

// print_r($proposalList);exit();

		$data['recordsFiltered'] = $companycount[0]['count'];

		$data['recordsTotal'] = $companycount[0]['count'];

		$data['data'] = $proposalList;

		echo json_encode($data);
	} // end : getCompanies Action





	public function getCompanyIdentifier($country)
	{

		$where = array('t2.nicename' => $country, 'status' => 'active');

		$companyIdentifierList['list'] = $this->POModel->getCompanyIdentifier($where);

		$getIdentifierList = $this->load->view('form/getComapnyIdentifier', $companyIdentifierList);

		return $getIdentifierList;
	} // end : getCompanyIdentifier Action



	public function getItemList()
	{

		$post = $this->input->post();

		try {

			$fk_pid = $post['fk_pid'];

			// $select2 = "pw.pw_id, pw.item_name, pw.id_code,pw.fk_pid";

			$select2 = "pw.*, c.company_name, u.full_name";

			$where2 = array('pw.fk_pid' => $fk_pid);

			$data = $this->POModel->getItemList($select2, $where2);
			$propsalworksheet = "";
			foreach ($data as $Wproposal) {
				$Wproposal['rate_AED'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'];
				$Wproposal['total_amount'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'] * $Wproposal['quantity'];
				$markupAmount = ($Wproposal['markup'] / 100) * $Wproposal['total_amount'];
				$Wproposal['total_amount'] = $Wproposal['total_amount'] + $markupAmount;
				$Wproposal['supplier_id'] = $Wproposal['full_name'] . " (" . $Wproposal['company_name'] . ")";
				$propsalworksheet[] = $Wproposal;
			}
			// print_r($propsalworksheet);exit();
			// exit();
			$response['recordsFiltered'] = 10;

			$response['recordsTotal'] = 10;

			$response['data'] = $propsalworksheet;

			echo json_encode($response);

			die;







			//print_r($data['itemList']);exit;

			// $itemList = $this->load->view('layout/table/itemListTable', $data);

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



	public function setStatus($status)
	{

		$user_id = $this->session->userdata('user_id');

		$user_type = $this->session->userdata('user_type');

		$post = $this->input->post();

		//print_r($post);exit;

		try {

			$p_id = $post['fk_pid'];

			$updateArray = array(

				'status' => $status,

			);

			if ($user_type == 'Customer') {

				$updateArray['approved_by_customer'] = $user_id;
			} else {

				$updateArray['approved_by_admin'] = $user_id;
			}



			$wherePid = array('p_id' => $p_id);

			$getLeadOpportunityID = $this->POModel->getLeadOpportunityID($wherePid);



			$updateLeadArray = array(

				'job_status' => 'converted',

			);

			$whereLid = array('lead_opportunity_id' => $getLeadOpportunityID);



			$getLeadOpportunityID = $this->POModel->convertLead($updateLeadArray, $whereLid);



			$data = $this->POModel->setStatus($updateArray, $p_id);
		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}
	} // end : getCompanyIdentifier Action



	function getFilter()
	{

		$postData = $this->input->post();

		$getFilterData['data'] = $this->POModel->getFilterById($postData['filter_id']);

		$select = "u.user_id, CONCAT (u.first_name,' ',u.last_name) AS name";

		$where = array('u.active_status' => 'active');

		$page['getSalesperson'] = $this->POModel->getSalesperson($select, $where);

		$getFilterData['filter_id'] = $postData['filter_id'];

		// if (isset($getFilterData['data'][0]['filter_values'])) {

		//    $newData = json_decode($getFilterData['data'][0]['filter_values']);

		//     $parent_id = $newData->parent_company_id;

		//     if ($parent_id != 0) {

		//         $getFilterData['parentCompany'] = $this->company_model->getParentCompany($parent_id);

		//     } 

		// }

		//print_r($getFilterData['data']);exit;

		$getView = $this->load->view('pages/getProposalFilterView', $getFilterData);

		return $getView;
	}



	public function addFilter()
	{

		$post = $this->input->post();

		try {

			$postData['module'] =  "Proposal";

			$postData['filter_name'] = $this->input->post('filter_name');

			$postData['filter_values'] = json_encode($this->input->post());

			$AddCompany = $this->POModel->saveFilter($postData);

			$response['code'] = 200;

			$response['message'] = "<div class='alert alert-success'>

                    <strong>Success!</strong> Filter Saved Successfully.</div>";

			//$response['data'] = $data['id'];

		} catch (Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();
		}

		echo json_encode($response);
	} // end : getCompanyIdentifier Action



	public function addWorksheet()
	{

		$post = $this->input->post();

		//print_r($post);exit;

		try {

			if (isset($_FILES["photo"]['name']) && $_FILES["photo"]['name'] != '') {

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

					//echo $error;

					print_r($error);
					exit;
				}
			}



			$this->load->library('form_validation');

			if (isset($post['pw_id']) && $post['pw_id'] != '') {

				$this->form_validation->set_rules('pw_id', 'Something Went Wrong', 'required|integer');
			}

			$this->form_validation->set_rules('room_type', 'Room Type', 'required');

			$this->form_validation->set_rules('id_code', 'ID Code', 'required');

			$this->form_validation->set_rules('item_name', 'Item Name', 'required');



			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				$pw_id = $post['pw_id'];

				//-----Calculate ExFactory Amount----------------------

				if ($post['quantity'] != '' && $post['ex_factory_unit_price'] != '' && $post['unit_price_markup'] != '' && $post['ex_factory_mark_up_amt'] != '') {

					if ($post['unit_price_markup'] == '%') {

						$post['ex_factory_total_markup'] = $post['ex_factory_unit_price'] * ($post['ex_factory_mark_up_amt'] / 100);
					} else if ($post['unit_price_markup'] == '$/unit') {

						$post['ex_factory_total_markup'] = $post['quantity'] * $post['ex_factory_mark_up_amt'];
					} else if ($post['unit_price_markup'] == 'Total Markup') {

						$post['ex_factory_total_markup'] = ($post['quantity'] * $post['ex_factory_unit_price']) + $post['ex_factory_mark_up_amt'];
					}

					$post['total_price_ex_factory'] = $post['ex_factory_total_markup'] + ($post['quantity'] * $post['ex_factory_unit_price']);
				}



				//-----Calculate Fabrics Amounts----------------------

				if ($post['fabric_quantity'] != '' && $post['fabric_price'] != '' && $post['fabric_markup'] != '' && $post['fabric_mark_up_amt'] != '') {

					if ($post['fabric_markup'] == '%') {

						$post['fabrics_total_markup'] = $post['fabric_price'] * ($post['fabric_mark_up_amt'] / 100);
					} else if ($post['fabric_markup'] == '$/unit') {

						$post['fabrics_total_markup'] = $post['fabric_quantity'] * $post['fabric_mark_up_amt'];
					} else if ($post['fabric_markup'] == 'Total Markup') {

						$post['fabrics_total_markup'] = ($post['fabric_quantity'] * $post['fabric_price']) + $post['fabric_mark_up_amt'];
					}

					$post['unit_total_price_fabric'] = $post['fabrics_total_markup'] + ($post['fabric_quantity'] * $post['fabric_price']);
				}



				//-----Calculate Leather Amounts----------------------

				if ($post['leather_quantity'] != '' && $post['leather_price'] != '' && $post['leather_markup'] != '' && $post['leather_mark_up_amt'] != '') {

					if ($post['leather_markup'] == '%') {

						$post['leather_total_markup'] = $post['leather_price'] * ($post['leather_mark_up_amt'] / 100);
					} else if ($post['leather_markup'] == '$/unit') {

						$post['leather_total_markup'] = $post['leather_quantity'] * $post['leather_mark_up_amt'];
					} else if ($post['leather_markup'] == 'Total Markup') {

						$post['leather_total_markup'] = ($post['leather_quantity'] * $post['leather_price']) + $post['leather_mark_up_amt'];
					}

					$post['unit_total_price_leather'] = $post['leather_total_markup'] + ($post['leather_quantity'] * $post['leather_price']);
				}



				//--------CAlculate FOB---------------

				if ($post['quantity'] != '' && $post['total_price_ex_factory'] != '' && $post['unit_price_fob'] != '') {

					$post['total_price_fob'] = $post['total_price_ex_factory'] + ($post['quantity'] * $post['unit_price_fob']);
				}



				//--------CAlculate CIF---------------

				if ($post['quantity'] != '' && $post['total_price_ex_factory'] != '' && $post['unit_price_cif'] != '') {

					$post['total_price_cif'] = $post['total_price_ex_factory'] + ($post['quantity'] * $post['unit_price_cif']);
				}



				if (isset($post['pw_id']) && $post['pw_id'] != '') {

					$data['id'] = $this->POModel->insertProposalWorksheet($post, $pw_id);

					$response['code'] = 200;

					$response['message'] = "Lead Proposal Items Updated Successfully.";

					$response['data'] = $data['id'];

					$response['saveNew'] = "";
				} else {

					$data['id'] = $this->POModel->insertProposalWorksheet($post);

					$response['code'] = 200;

					$response['message'] = "Lead Proposal Items Added Successfully.";

					$response['data'] = $data['id'];

					$response['saveNew'] = "saveNew";
				}

				//$this->session->set_userdata('setMessage','Added');

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

		//print_r($post['format_header']);exit;

		try {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('fk_pid', 'Something Went Wrong', 'required|integer');



			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				$p_id = $post['fk_pid'];

				$insertArray = array(

					'fk_p_id' => $post['fk_pid'],

					'format_header' => $post['format_header'],

					'format_footer' => $post['format_footer'],

				);

				if (isset($post['fk_pid']) && $post['fk_pid'] == '') {

					$data['id'] = $this->POModel->insertProposalFormat($insertArray, $post['pf_id']);

					$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Proposal Format Updated Successfully.</div>";
				} else {

					$data['id'] = $this->POModel->insertProposalFormat($insertArray);

					$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Proposal Format Added Successfully.</div>";
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

	public function importData($proposal_id = null)

	{

		// 	require_once APPPATH . 'third_party/PHPExcel.php';

		// 	$objPHPExcel = PHPExcel_IOFactory::load('C:/Users/Dev1/Desktop/Excel_with_images2.xlsx');

		//  $objWorksheet = $objPHPExcel->getActiveSheet();

		//  $i = 0;

		//  $image_fields = [];

		//  foreach ($objWorksheet->getDrawingCollection() as $drawing) {

		//      if ($drawing instanceof PHPExcel_Worksheet_MemoryDrawing) {

		//          ob_start();

		//          call_user_func(

		//              $drawing->getRenderingFunction(),

		//              $drawing->getImageResource()

		//          );

		//          $imageContents = ob_get_contents();

		//          ob_end_clean();

		//          $cellID = $drawing->getCoordinates();

		//          $myFileName = 'questions/questions_' . ++$i.time() . '.' . $extension;

		//          //print_r($myFileName);exit;

		//          $path = Storage::put($myFileName, $imageContents);

		//          $image_fields[$drawing->getCoordinates()] = '<img src="'.asset('storage/'.$myFileName).'">';

		//      }

		//      if ($drawing instanceof PHPExcel_Worksheet_Drawing) {

		//          $zipReader = fopen($drawing->getPath(), 'r');

		//          print_r($zipReader);exit;

		//          $imageContents = '';

		//          while (! feof($zipReader)) {

		//              $imageContents .= fread($zipReader, 1024);

		//          }

		//          fclose($zipReader);

		//          $extension = $drawing->getExtension();

		//          $myFileName = 'questions_' . ++$i.time() . '.' . $extension;

		//          //print_r($myFileName);exit;

		//          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		// $objWriter->save("upload/".$myFileName);

		//          //$path = Storage::put($myFileName, $imageContents);

		//          // $image_fields[$drawing->getCoordinates()] = '<img src="'.asset('storage/'.$myFileName).'">';

		//      }

		//  }

		// print_r($this->input->post());exit;

		$post = $this->input->post();

		$module = 'Proposal';

		$fk_pid = $proposal_id;

		$ExcelHeader = array('Project Name', 'Room Type', 'ID Code', 'Item Name', 'Photo', 'Width', 'Depth', 'Height', 'Short Height', 'Technical Description', 'Quantity', 'Unit Price(Ex-Factory)', 'Unit Price MarkUp', 'Unit Price Markup Amount', 'Ex-Factory Total Markup', 'Total Price(Ex-Factory)', 'Fabrics Quantity', 'Unit Price(Fabrics)', 'Fabrics MarkUp', 'Fabrics Markup Amount', 'Fabrics Total Markup', 'Total Price(Fabrics)', 'Leather Quantity', 'Unit Price(Leather )', 'Leather  MarkUp', 'Leather  Markup Amount', 'Leather  Total Markup', 'Total Price(Leather)', 'Unit Price FOB', 'Unit Price CIF', 'Total Price FOB', 'Total Price CIF', 'CBM', 'Notes');



		try {

			$this->load->library('Excel', 'excel');



			$config['upload_path']          = APPPATH . '../upload/';

			$config['allowed_types']        = 'xlsx|csv|xls';



			$this->load->library('upload', $config);



			if (!$this->upload->do_upload('uploadFile')) {

				$error = $this->upload->display_errors();

				print_r($error);
				die;

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

					'name' => 'project_name',

					'require' => true

				),

				'B' => array(

					'name' => 'room_type',

					'require' => false

				),

				'C' => array(

					'name' => 'id_code',

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

					'require' => false

				),

				'L' => array(

					'name' => 'ex_factory_unit_price',

					'require' => true

				),

				'M' => array(

					'name' => 'unit_price_markup',

					'require' => true

				),

				'N' => array(

					'name' => 'ex_factory_mark_up_amt',

					'require' => true

				),

				'O' => array(

					'name' => 'ex_factory_total_markup',

					'require' => true

				),

				'P' => array(

					'name' => 'total_price_ex_factory',

					'require' => true

				),

				'Q' => array(

					'name' => 'fabric_quantity',

					'require' => true

				),

				'R' => array(

					'name' => 'fabric_price',

					'require' => true

				),

				'S' => array(

					'name' => 'fabric_markup',

					'require' => true

				),

				'T' => array(

					'name' => 'fabric_mark_up_amt',

					'require' => false

				),

				'U' => array(

					'name' => 'fabrics_total_markup',

					'require' => true

				),

				'V' => array(

					'name' => 'unit_total_price_fabric',

					'require' => true

				),

				'W' => array(

					'name' => 'leather_quantity',

					'require' => true

				),

				'X' => array(

					'name' => 'leather_price',

					'require' => true

				),

				'Y' => array(

					'name' => 'leather_markup',

					'require' => true

				),

				'Z' => array(

					'name' => 'leather_mark_up_amt',

					'require' => true

				),

				'AA' => array(

					'name' => 'leather_total_markup',

					'require' => true

				),

				'AB' => array(

					'name' => 'unit_total_price_leather',

					'require' => true

				),

				'AC' => array(

					'name' => 'unit_price_fob',

					'require' => true

				),

				'AD' => array(

					'name' => 'unit_price_cif',

					'require' => true

				),

				'AE' => array(

					'name' => 'total_price_fob',

					'require' => true

				),

				'AF' => array(

					'name' => 'total_price_cif',

					'require' => true

				),

				'AG' => array(

					'name' => 'cbm',

					'require' => true

				),

				'AH' => array(

					'name' => 'notes',

					'require' => true

				),

			);



			$this->excel->setHeaderColumn($importArray);



			if (!$this->excel->validateFileType($file)) {

				$responceMsg = $this->excel->getResponseMessage();

				echo json_encode($responceMsg);

				die;
			}



			if (!$this->excel->loadExcel($file)) {

				$responceMsg = $this->excel->getResponseMessage();

				echo json_encode($responceMsg);

				die;
			}



			if (!$this->excel->importExcel($ExcelHeader, $module)) {

				$responceMsg = $this->excel->getResponseMessage();

				echo json_encode($responceMsg);

				die;
			}



			$data = $this->excel->getImportData();

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

					'fk_pid' => $fk_pid,

					'project_name' => ($value['project_name'] == NULL ? '' : $value['project_name']),

					'room_type' => ($value['room_type'] == NULL ? '' : $value['room_type']),

					'item_name' => ($value['item_name'] == NULL ? '' : $value['item_name']),

					'id_code' => ($value['id_code'] == NULL ? '' : $value['id_code']),

					'photo' => ($value['photo'] == NULL ? '' : $value['photo']),

					'width' => ($value['width'] == NULL ? '' : $value['width']),

					'depth' => ($value['depth'] == NULL ? '' : $value['depth']),

					'height' => ($value['height'] == NULL ? '' : $value['height']),

					'short_height' => ($value['short_height'] == NULL ? '' : $value['short_height']),

					'technical_description' => ($value['technical_description'] == NULL ? '' : $value['technical_description']),

					'quantity' => ($value['quantity'] == NULL ? '' : $value['quantity']),

					'ex_factory_unit_price' => ($value['ex_factory_unit_price'] == NULL ? '' : $value['ex_factory_unit_price']),

					'unit_price_markup' => ($value['unit_price_markup'] == NULL ? '' : $value['unit_price_markup']),

					'ex_factory_mark_up_amt' => ($value['ex_factory_mark_up_amt'] == NULL ? '' : $value['ex_factory_mark_up_amt']),

					'ex_factory_total_markup' => ($value['ex_factory_total_markup'] == NULL ? '' : $value['ex_factory_total_markup']),

					'total_price_ex_factory' => ($value['total_price_ex_factory'] == NULL ? '' : $value['total_price_ex_factory']),

					'fabric_quantity' => ($value['fabric_quantity'] == NULL ? '' : $value['fabric_quantity']),

					'fabric_price' => ($value['fabric_price'] == NULL ? '' : $value['fabric_price']),

					'fabric_markup' => ($value['fabric_markup'] == NULL ? '' : $value['fabric_markup']),

					'fabric_mark_up_amt' => ($value['fabric_mark_up_amt'] == NULL ? '' : $value['fabric_mark_up_amt']),

					'fabrics_total_markup' => ($value['fabrics_total_markup'] == NULL ? '' : $value['fabrics_total_markup']),

					'unit_total_price_fabric' => ($value['unit_total_price_fabric'] == NULL ? '' : $value['unit_total_price_fabric']),

					'leather_quantity' => ($value['leather_quantity'] == NULL ? '' : $value['leather_quantity']),

					'leather_price' => ($value['leather_price'] == NULL ? '' : $value['leather_price']),

					'leather_markup' => ($value['leather_markup'] == NULL ? '' : $value['leather_markup']),

					'leather_mark_up_amt' => ($value['leather_mark_up_amt'] == NULL ? '' : $value['leather_mark_up_amt']),

					'leather_total_markup' => ($value['leather_total_markup'] == NULL ? '' : $value['leather_total_markup']),

					'unit_total_price_leather' => ($value['unit_total_price_leather'] == NULL ? '' : $value['unit_total_price_leather']),

					'unit_price_fob' => ($value['unit_price_fob'] == NULL ? '' : $value['unit_price_fob']),

					'unit_price_cif' => ($value['unit_price_cif'] == NULL ? '' : $value['unit_price_cif']),

					'total_price_fob' => ($value['total_price_fob'] == NULL ? '' : $value['total_price_fob']),

					'total_price_cif' => ($value['total_price_cif'] == NULL ? '' : $value['total_price_cif']),

					'cbm' => ($value['cbm'] == NULL ? '' : $value['cbm']),

					'note' => ($value['notes'] == NULL ? '' : $value['notes']),

				);



				$importExcelData = $this->POModel->insertProposalWorksheet($insertArray);

				$this->session->set_userdata('setMessage', 'Imported');
			}

			$responceMsg = array(

				'code' => 200,

				'message' => "<b style='color:green'>Proposal Data Imported Successfully</b>"

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

	public function createExcel()
	{

		$selectedColumns = $this->input->post();

		$list = $selectedColumns['proposal_id'];

		$userIdList = '';

		if ($list != '') {

			$list = str_replace('%20', '', $list);

			$proposalList = explode('_', $list);
		}

		$fieldName = array('proposal_title', 'opportunity_title', 'sales_person', 'approval_deadline', 'total_price_(Ex_factory)', 'total_price_(Fabrics)', 'total_price_(Leather),proposal_status');

		$selectedColumns['columnFields'] = implode(', ', $fieldName);

		$fileName = 'Proposal_List ' . date('d-m-y') . '.xlsx';

		if (isset($selectedColumns['columnFields'])) {

			$columnArray = explode(',', $selectedColumns['columnFields']);

			foreach ($columnArray as $cA) {

				$getColumn[] = ucwords(str_replace('_', ' ', $cA));
			}

			$columnString = "p.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS sales_people, CONCAT('$', SUM(pw.total_price_ex_factory)) as total_price_ex_factory, CONCAT('$', SUM(pw.unit_total_price_fabric)) as total_price_fabric, CONCAT('$', SUM(pw.unit_total_price_leather)) as total_price_leather";

			$proposalData = $this->POModel->exportCompany($columnString, $proposalList);

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

			//print_r($companyData[0]);exit;

			foreach ($proposalData as $val) {

				if (isset($val['title'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['title']);

					$col++;
				}

				if (isset($val['opportunity_title'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['opportunity_title']);

					$col++;
				}

				if (isset($val['sales_people'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['sales_people']);

					$col++;
				}

				if (isset($val['approval_deadline'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['approval_deadline']);

					$col++;
				}

				if (isset($val['total_price_ex_factory'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['total_price_ex_factory']);

					$col++;
				}

				if (isset($val['total_price_fabric'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['total_price_fabric']);

					$col++;
				}

				if (isset($val['total_price_leather'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['total_price_leather']);

					$col++;
				}

				if (isset($val['status'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['status']);

					$col++;
				}

				$rows++;

				$col = 0;
			}

			$writer = new Xlsx($spreadsheet);

			$writer->save("upload/" . $fileName);

			header("Content-Type: application/vnd.ms-excel");
		}

		//redirect(base_url()."/upload/".$fileName);

		$excelUrl = base_url() . 'upload/' . $fileName;

		echo $excelUrl;
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

			$column = $arrayField = $this->PO->getProposalColumn();

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

				$grid_columns = $this->POModel->getGrid('grid_columns', array('grid_id' => $gridId));

				if (!empty($grid_columns)) {

					$arrayField = json_decode($grid_columns[0]['grid_columns']);
				}
			}



			if (isset($selectedColumns['ischeck']) && $selectedColumns['ischeck'] != '' && $selectedColumns['ischeck'] != 'undefined') {

				$columns['grid_columns'] = json_encode($arrayField);

				$columns['grid_name'] = $selectedColumns['ischeck'];

				$columns['module_name'] = $module_name;

				$this->POModel->insertGrid($columns);
			}

			$data['columns'] = $arrayField;

			$data['options'] = $this->POModel->getGrid('*', array('module_name' => $module_name));

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



	public function deleteproposal()
	{

		$DeleteId = $this->input->post();

		$p_id = explode(',', $DeleteId['deleteThis']);

		// print_r($newUsrId); exit;

		$whereDelete = array('p_id' => $p_id);

		$DeletedUser = $this->POModel->deleteproposal($p_id);

		if ($DeletedUser) {

			$this->session->set_userdata('setMessage', 'deleted');



			$whereNotificationID = array('fk_notification_id' => '20');

			$deleteUserNotification = $this->userModel->getUsersNotification($whereNotificationID);

			$userIDs = json_decode($deleteUserNotification['result'][0]['user_id']);

			$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

			foreach ($getEmailList as $key => $value) {

				$emailList[] = $value['contact_info'];
			}

			$emailString = implode(',', $emailList);



			foreach ($p_id as $userKey => $userValue) {

				$where = array('b_id' => $userValue);

				$getUserdetails = $this->rfqModel->getRFQDetails($where);

				if ($deleteUserNotification['count'] == 1) {

					$emailString = implode(',', $emailList);

					$subject = 'Proposal Deleted Successfully';

					$module = 'Proposal for ';

					$name = $getUserdetails['result'][0]['title'];

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

		//print_r($DeleteId);exit;

		$newUsrId = explode(',', $DeleteId['getEmail']);

		$select = "uc.contact_info";

		$whereUsrs = array('p.p_id' => $newUsrId, 'uc.contact_type' => 'Email');

		$getData = $this->POModel->getEmailIds($select, $newUsrId);

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

				'smtp_user' => 'dev3@hozpitality.com',

				'smtp_pass' => 'Nop79255',

				'mailtype'  => 'html',

				'charset'   => 'utf-8'

			);

			$this->email->initialize($config);

			$this->email->set_mailtype("html");

			$this->email->set_newline("\r\n");





			$this->email->from('dev3@hozpitality.com', 'snehal Kamble');

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



	public function getItemData($val)
	{

		$select2 = "pw.*, c.company_name, u.full_name";

		$where2 = array('pw.pw_id' => $val);

		$getItemList = $this->POModel->getItemList($select2, $where2);

		foreach ($getItemList as $Wproposal) {
			$Wproposal['rate_AED'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'];
			$Wproposal['total_amount'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'] * $Wproposal['quantity'];
			$markupAmount = ($Wproposal['markup'] / 100) * $Wproposal['total_amount'];
			$Wproposal['total_amount'] = $Wproposal['total_amount'] + $markupAmount;
			$Wproposal['supplier_id'] = $Wproposal['full_name'] . " (" . $Wproposal['company_name'] . ")";
			$propsalworksheet[] = $Wproposal;
		}
		$data['getItemList'] = $propsalworksheet;
		$getData = $this->load->view('pages/getProposaIItemList', $data);

		return $getData;
	}



	public function getCompany()
	{

		$post = $this->input->post();



		$select = "c.company_name";

		$where = array('lo.lead_opportunity_id' => $post['lead_opportunity_id']);

		$getCompanyLeadOpp = $this->POModel->getCompanyLeadOpp($select, $where);

		echo $getCompanyLeadOpp[0]['company_name'];
	}



	public function saveProposal()
	{

		$post = $this->input->post();



		if ($post['approval_date'] != '') {

			$newDate = date("d-m-Y", strtotime($post['approval_date']));
		} else {

			$newDate = $post['approval_date'];
		}



		$updateArray = array(

			'approval_deadline' => $newDate,

			'notes' => $post['notes'],

		);



		$where = array('p_id' => $post['p_id']);

		$updateProposal = $this->POModel->updateProposal($updateArray, $where);





		$whereNotificationID = array('fk_notification_id' => '16');

		$addLeadNotification = $this->userModel->getUsersNotification($whereNotificationID);

		$userIDs = json_decode($addLeadNotification['result'][0]['user_id']);

		$getEmailList = $this->userModel->getUserEmail('*', $userIDs);

		foreach ($getEmailList as $key => $value) {

			$emailList[] = $value['contact_info'];
		}

		$where = array('lead_opportunity_id' => $fk_lead_opportunity_id);

		$getUserdetails = $this->rfqModel->getRFQDetails($where);

		if ($addLeadNotification['count'] == 1) {

			$emailString = implode(',', $emailList);

			$subject = 'Proposal Updated Successfully';

			$module = 'Proposal for';

			$name = $getUserdetails['result'][0]['title'];

			$action = 'added';

			$actionBy = $this->session->userdata('user_name');

			$NotificationEmail = $this->permission->sendNotificationsEmail($emailString, $subject, $module, $name, $action, $actionBy);
		}

		return $updateProposal;
	}



	public function get_POpreview($val)
	{
		try {
		// $where2 = array('pw.fk_pid' => $val);
		$data['formheading'] = 'Purchase Order Preview';

		// $select = "*";
		// $where = array('p_id' => $val);
		// $getCompanyLeadOppId = $this->POModel->getProposal($select, $where);
		// $data['proposal']=$getCompanyLeadOppId[0];
		$select = "po.*";
		$where = array('po.fk_pid' => $val);
		$getPO = $this->POModel->getPOlist($select, $where);
		$data['PO']=$getPO[0];
		
		// $admin_id=$getCompanyLeadOppId[0]['approved_by_admin'];
		// $customer_id=$getCompanyLeadOppId[0]['approved_by_customer'];
		
		
		// $select1 = "u.full_name,uc.contact_type,uc.contact_info,c.*";
		// $where1 = array('user_id' => $customer_id);
		// $getSalesperson = $this->POModel->getUsersDetails($where1,$select1);
		// $data['getSalesperson'] = $getSalesperson[0];

		// $select2 = "u.full_name,uc.contact_type,uc.contact_info,c.*";
		// $where2 = array('u.user_id' => $admin_id,'uc.contact_type'=>'Email');
		// $admin = $this->POModel->getUsersDetails($where2,$select2);
		// $data['admin'] = $admin[0];

		// $getCompanyLeadOppId= $getCompanyLeadOppId[0]['fk_lead_opportunity_id'];
		// $select = "c.*,CONCAT ('Proposal for ', lo.opportunity_title, '(', c.company_name, ')') AS name";
		// $where = array('lo.lead_opportunity_id' => $getCompanyLeadOppId);
		// $getCompanyLeadOpp = $this->POModel->getCompanyLeadOpp($select, $where);
		// $data['companyDetails'] = $getCompanyLeadOpp[0];
		
		$where2 = array('pw.fk_pid' => $val);
		$select2 = "pw.*, c.company_name, u.full_name";
		$getItemList = $this->POModel->getItemList($select2, $where2);
		foreach ($getItemList as $Wproposal) {
			$Wproposal['rate_AED'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'];
			$Wproposal['total_amount'] = $Wproposal['rate_USD'] * $Wproposal['exchange_rate'] * $Wproposal['quantity'];
			$markupAmount = ($Wproposal['markup'] / 100) * $Wproposal['total_amount'];
			$Wproposal['total_amount'] = $Wproposal['total_amount'] + $markupAmount;
			$Wproposal['supplier_id'] = $Wproposal['full_name'] . " (" . $Wproposal['company_name'] . ")";
			$propsalworksheet[] = $Wproposal;
		}
		// $data['getItemList']="";
		$data['getItemList'] = $propsalworksheet;

		$select3 = "pf.*";

		$where3 = array('pf.fk_p_id' => $val);

		$data['getFormat'] = $this->POModel->getFormat($select3, $where3);

		// print_r($data);

		$html = $this->page->getPage('getPOpreview', $data, true);

		$response['code'] = 200;

		$response['message'] = 'form generated';

		$response['data']['heading'] = $data['formheading'];

		$response['data']['html'] = $html;
		// $getData = $this->load->view('pages/getPOpreview', $data);

	} catch (Exception $e) {

		$response['code'] = 505;

		$response['message'] = 'exception in form generation';

		$response['data'] = array();
	}



	echo json_encode($response);

	exit;
	}



	public function releasePO()

	{

		$p_id = $_POST['fk_pid'];

		$insertData['proposal_id'] = $p_id;

		$insertData['raised_date'] = date('Y-m-d');

		$this->POModel->insertPO($insertData);
	}



	public function releaseInvoice()

	{

		$p_id = $_POST['fk_pid'];

		$where['proposal_id'] = $p_id;

		$data = $this->POModel->getPO($where);

		if (!empty($data)) {

			$insertData['invoice_number'] = date('YmdH:i:s');

			$insertData['status'] = 'processed';

			$insertData['purchase_order_id'] = $data[0]['id'];

			$this->POModel->insertInvoice($insertData);
		}
	}
}
