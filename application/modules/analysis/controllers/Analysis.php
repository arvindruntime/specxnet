<?php

defined('BASEPATH') or exit('No direct script access allowed');



use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Analysis extends CI_Controller
{



	/**

	 * RFQ Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://DomainName/analysis

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

		$this->load->model(array('Job_model' => 'jobModel'));

		$this->load->model(array('Proposal_model' => 'proposalModel'));

		$this->load->library(array('Analysis_library' => 'rfq'));

		$this->load->library(array('Permissions_library' => 'permission'));
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

		$this->page->setTitle('Analysis');



		// set head style

		$this->page->setHeadStyle(base_url() . "assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style.bundle.css");
		
		$this->page->setHeadStyle(base_url() . "assets/demo/default/base/style-2.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/css/style.css");

		// $this->page->setHeadStyle(base_url()."assets/custom/css/bootstrap-multiselect.css");

		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");

		$this->page->setHeadStyle("//cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css");

		$this->page->setHeadStyle(base_url() . "assets/custom/Editor/css/editor.dataTables.min.css");

		// select 2 

		$this->page->setHeadStyle(base_url() . "assets/select2/dist/css/select2.min.css");



		// $this->page->setHeadStyle("https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css");



		//set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs(base_url() . "assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url() . "assets/demo/default/base/scripts.bundle.js");

		//------------------------------------------------------------------------------------------

		$this->page->setFooterJs("//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js");

		$this->page->setFooterJs("//cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js");

		$this->page->setFooterJs("//cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js");

		//------------------------------------------------------------------------------------------

		$this->page->setFooterJs("//cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js");

		$this->page->setHeadStyle(base_url() . "assets/custom/Editor/js/dataTables.editor.min.js");

		// $this->page->setFooterJs("https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js");



		$this->page->setFooterJs(base_url() . "assets/custom/js/ajax.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/analysis.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/custom.js");

		$this->page->setFooterJs(base_url() . "assets/app/js/datepicker.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/datatable.js");

		$this->page->setFooterJs(base_url() . "assets/custom/js/datatable2.js");



		// text editor js

		$this->page->setFooterJs(base_url() . "assets/ckeditor/ckeditor.js");



		// Select 2

		$this->page->setFooterJs(base_url() . "assets/select2/dist/js/select2.full.min.js");



		// $this->page->setFooterJs(base_url()."assets/custom/js/bootstrap-multiselect.js");

		//$this->page->setFooterJs(base_url()."assets/custom/js/autocomplete.js");

		$page['getFilterData'] = '';

		if (isset($_POST) && !empty($_POST)) {

			$page['getFilterData'] = $this->input->post();

			$filter_date = $page['getFilterData']['approval_deadline'];

			// $page['getFilterData']['approval_deadline']=date("m-d-Y", strtotime($filter_date));

			// print_r($page['	getFilterData']);

			// exit;

			$page['getFilterData'] = $page['getFilterData'];
		}

		// load layout

		$page['contain'] = 'analysis';

		//List Parent Companies

		// $select2 = 't1.*, t2.company_name as parent_company';

		// $where = array('t1.company_type' => self::COMPANY_ARRAY[$companyType], 't1.activity_status' => 'active');

		// $page['parentCompany'] = $this->rfqModel->getCompany($select2,$where);

		//print_r($page['parentCompany']);exit;

		//List Countries

		// $select = 'nicename,phonecode';

		// $page['country'] = $this->rfqModel->getCountry($select);



		$page['redirectAction'] = '';

		$page['importAction'] = base_url() . 'analysis/importData';



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

		try {

			$post = $this->input->post();

			// print_r($post);

			//@author: Sagar Kodalkar

			//Validation on input start

			$this->load->library('form_validation');

			$this->form_validation->set_rules('lead_opportunity_id', 'Lead Opportunity', 'required|numeric');

			$this->form_validation->set_rules('approval_deadline', 'Approval Deadline', 'required');

			// $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');

			if (isset($post['notes']) && $post['notes'] != '') {

				$this->form_validation->set_rules('notes', 'Notes', 'required');
			}



			if ($this->form_validation->run() == FALSE) {

				$response['error'] = "<div class='alert-danger-2'>

	                    <strong>Alert !</strong><br/><br/>" .

					validation_errors() .

					"</div>";
			} else {

				$select = "CONCAT ('RFQ for ', lo.opportunity_title, '(', c.company_name, ')') AS name";

				$where = array('lo.lead_opportunity_id' => $post['lead_opportunity_id']);

				$getCompanyLeadOpp = $this->rfqModel->getCompanyLeadOpp($select, $where);



				$select = "count(title) AS totalcount";

				$getCountOfExistingLead = $this->rfqModel->getCountOfExistingLead($select, $getCompanyLeadOpp[0]['name']);

				$totalCount = $getCountOfExistingLead[0]['totalcount'] + 1;

				//print_r($totalCount);exit;

				if ($getCountOfExistingLead[0]['totalcount'] != 0) {

					$title = $getCompanyLeadOpp[0]['name'] . "(" . $totalCount . ")";
				} else {

					$title = $getCompanyLeadOpp[0]['name'];
				}

				if ($post['approval_deadline']) {

					$approval_deadline = date("d-m-Y", strtotime($post['approval_deadline']));
				} else {

					$approval_deadline = "";
				}

				//print_r($title);exit;

				$insertArray = array(

					'title' => $title,

					'fk_lead_opportunity_id' => $post['lead_opportunity_id'],

					'approval_deadline' => $approval_deadline,

					'supplier' => $post['supplier_id'],

					'markup_type' => $post['markup_type'],

					'notes' => $post['notes'],

					'status' => 'Drafted',

				);



				if (isset($post['markup_type_value_ex_factory']) && $post['markup_type_value_ex_factory'] != '') {

					$insertArray['markup_type_value_ex_factory'] = $post['markup_type_value_ex_factory'];
				}

				if (isset($post['markup_type_value_fabric']) && $post['markup_type_value_fabric'] != '') {

					$insertArray['markup_type_value_fabric'] = $post['markup_type_value_fabric'];
				}

				if (isset($post['markup_type_value_leather']) && $post['markup_type_value_leather'] != '') {

					$insertArray['markup_type_value_leather'] = $post['markup_type_value_leather'];
				}

				//print_r($insertArray);exit;

				if (!isset($post['b_id'])) {

					$data['id'] = $this->rfqModel->insertRfq($insertArray);

					$add_P_id = array(

						'fk_b_id' => $data['id'],

					);

					$data['itemId'] = $this->rfqModel->insertIdRfqWorksheet($add_P_id);

					$this->session->set_userdata('setMessage', 'Added');
				} else {

					$where = array('company_id' => $companyId);

					$data['id'] = $this->rfqModel->updateCompany($insertArray, $where);

					// print_r($data['id']);exit;

					//$this->session->set_userdata('setMessage','Updated');

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



				$select4 = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) AS supplier_people";

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

	public function getAnalysis()
	{

		$request = $this->input->get();

		// print_r($request);exit;

		$offset = $request['start'];

		$limit = $request['length'];

		$columnArray = $request['columns'];

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

			$order = $select[$request['order'][0]['column']] . ' ' . $request['order'][0]['dir'];
		}

		$companyList = $this->rfqModel->getRfqlist($select, $where, $order, $limit, $offset);


		$companycount = $this->rfqModel->getRfqlistCount('count(*) as count');

		$dataAnalysis = $this->permission->checkUserPermission(30);

		foreach ($companyList as $key => $value) {

			if ($value['approval_deadline']) {



				$value['approval_deadline'] = date('d-M-Y', strtotime($value['approval_deadline']));

				$companyList[$key]['approval_deadline'] = $value['approval_deadline'];
			} else {

				$companyList[$key]['approval_deadline'] = "N/A";
			}



			if ($companyList[$key]['bwiCount'] == 0) {

				$companyList[$key]['bwiCount'] = 'disabled';

				$companyList[$key]['modelShow'] = '';
			} else {

				$companyList[$key]['bwiCount'] = '';

				$companyList[$key]['modelShow'] = 'data-toggle="modal" data-target="#modal"';
			}



			$companyList[$key]['dataAnalysis'] = $dataAnalysis;
		}



		//$companycount = count($companyList);

		// print_r($companyList);exit;

		//$companycount = array_sum(array_column($companycount, 'count'));



		$data['recordsFiltered'] = $companycount[0]['count'];

		$data['recordsTotal'] = $companycount[0]['count'];

		$data['data'] = $companyList;

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

					print_r($error);
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

	public function createExcel()
	{

		$selectedColumns = $this->input->post();

		$list = $selectedColumns['b_id'];

		$userIdList = '';

		if ($list != '') {

			$list = str_replace('%20', '', $list);

			$rfqList = explode('_', $list);
		}

		$fieldName = array('opportunity_title', 'supplier', 'approval_deadline', 'RFQ_status');

		$selectedColumns['columnFields'] = implode(', ', $fieldName);

		$fileName = 'RFQ_List ' . date('d-m-y') . '.xlsx';

		if (isset($selectedColumns['columnFields'])) {

			$columnArray = explode(',', $selectedColumns['columnFields']);

			foreach ($columnArray as $cA) {

				$getColumn[] = ucwords(str_replace('_', ' ', $cA));
			}

			$columnString = "b.*, lo.lead_opportunity_id, lo.opportunity_title, c.company_name, CONCAT(u.first_name, ' ', u.last_name) AS supplier";

			$rfqData = $this->rfqModel->exportCompany($columnString, $rfqList);

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

			foreach ($rfqData as $val) {

				if (isset($val['title'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['title']);

					$col++;
				}



				if (isset($val['supplier'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['supplier']);

					$col++;
				}

				if (isset($val['approval_deadline'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['approval_deadline']);

					$col++;
				}

				/* if(isset($val['total_price_ex_factory'])) {

                    $sheet->setCellValue($alphabets[$col]. $rows, $val['total_price_ex_factory']);

                    $col++;

                }

                if(isset($val['total_price_fabric'])) {

                    $sheet->setCellValue($alphabets[$col]. $rows, $val['total_price_fabric']);

                    $col++;

                }

                if(isset($val['total_price_leather'])) {

                    $sheet->setCellValue($alphabets[$col]. $rows, '<img src="../../../../upload/addItemImages/1565764562dressing_table.jpg">');

                    $col++;

                }*/

				if (isset($val['status'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['status']);

					$col++;
				}

				$rows++;

				$col = 0;
			}

			$writer = new Xlsx($spreadsheet);

			$writer->save("upload/" . $fileName);

			// header("Content-Type: application/vnd.ms-excel");
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



			$to = $email_list_sent = implode(",", $email_list);

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

			// print_r($mail_message);

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

			$this->email->to($to);

			$this->email->subject('List of Item for RFQ');

			$this->email->message($mail_message);



			//Send email

			if ($this->email->send()) {

				$response['code'] = 200;

				$response['message'] = 'Success';



				// $getData = $this->rfqModel->getSuppDetail($select,$newUsrId);

			} else {

				$response['code'] = 500;

				$response['message'] = 'Failure';
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



		$getData = $this->load->view('pages/get_preview', $data);

		return $getData;
	}

	public function getCompany()
	{

		$post = $this->input->post();



		$select = "c.company_name";

		$where = array('lo.lead_opportunity_id' => $post['lead_opportunity_id']);

		$getCompanyLeadOpp = $this->rfqModel->getCompanyLeadOpp($select, $where);

		echo $getCompanyLeadOpp[0]['company_name'];
	}

	public function saverfq()
	{

		$post = $this->input->post();

		//print_r($post);exit;

		if ($post['approval_deadline'] != '') {

			$newDate = date("d-m-Y", strtotime($post['approval_deadline']));
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

		// print_r($updaterfq);

		return $updaterfq;
	}







	public function uploadBid($rfqId)
	{



		$userId = $this->session->userdata('user_id');



		//$user_type = $this->rfqModel->getUserRole($userId);



		$permissionsAdmin = $this->permission->checkUserPermission(40);

		$permissionsSupplier = $this->permission->checkUserPermission(41);



		$select2 = "b.b_id,b.markup_type,b.markup_type_value_ex_factory,b.markup_type_value_fabric,b.markup_type_value_leather,bw.bw_id, bw.room_type, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note";

		$where2 = array('bw.fk_b_id' => $rfqId, 'bwi.fk_user_id' => $userId);

		$item = $this->rfqModel->getItemList($select2, $where2);

		$markup_type = $item[0]['markup_type'];

		$markup_type_value_ex_factory = $item[0]['markup_type_value_ex_factory'];

		$markup_type_value_fabric = $item[0]['markup_type_value_fabric'];

		$markup_type_value_leather = $item[0]['markup_type_value_leather'];

		$tables = array();



		$i = 1;

		foreach ($item as $key => $value) {

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



			if ($permissionsSupplier) {

				$ex_factory_unit_price = (isset($bid[0]['ex_factory_unit_price'])) ? $bid[0]['ex_factory_unit_price'] : "";



				$efup = "ex_factory_unit_price" . $rfqId . $i;

				$efma = "ex_factory_markup" . $rfqId . $i;

				$tpef = "unit_total_price_ex_factory" . $rfqId . $i;



				$table['ex_factory_unit_price'] = '<input type="text" id="ex_factory_unit_price' . $rfqId . $i . '" value="' . $ex_factory_unit_price . '" name="ex_factory_unit_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['quantity'] . ',"' . $efup . '","' . $efma . '","' . $tpef . '")>';



				$fup = "fabric_price" . $rfqId . $i;

				$fma = "fabric_markup" . $rfqId . $i;

				$tpfab = "unit_total_price_fabric" . $rfqId . $i;



				$fabric_price = (isset($bid[0]['fabric_price'])) ? $bid[0]['fabric_price'] : "";

				$table['fabric_price'] = '<input type="text" id="fabric_price' . $rfqId . $i . '" value="' . $fabric_price . '" name="fabric_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['fabric_quantity'] . ',"' . $fup . '","' . $fma . '","' . $tpfab . '")>';



				$lup = "leather_price" . $rfqId . $i;

				$lma = "leather_markup" . $rfqId . $i;

				$tplet = "unit_total_price_leather" . $rfqId . $i;



				$leather_price = (isset($bid[0]['leather_price'])) ? $bid[0]['leather_price'] : "";

				$table['leather_price'] = '<input type="text" id="leather_price' . $rfqId . $i . '" value="' . $leather_price . '" name="leather_price[]" style="width: 90px;" onkeyup=getUnitPriceValue(' . $value['leather_quantity'] . ',"' . $lup . '","' . $lma . '","' . $tplet . '")>';



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
			}



			if ($permissionsAdmin) {

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



				$total_price_markup = (isset($bid[0]['total_price_markup'])) ? $bid[0]['total_price_markup'] : "";

				$table['total_price_markup'] = '<input type="text" id="total_price_markup' . $rfqId . $i . '" value="' . $total_price_markup . '" name="total_price_markup[]" style="width: 90px;">';
			}

			$i++;

			array_push($tables, $table);
		}



		$response['data'] = $tables;


		$response['sId'] = '<input type="hidden" value="' . $userId . '" name="sId">';

		$html = $this->load->view('bidtable', $response, true);

		$json['data'] = $html;

		$json['code'] = 200;

		echo json_encode($json);
	}



	public function addBidPrice()

	{

		$post = $this->input->post();

		$countData = count($post['ex_factory_unit_price']);

		$data = array();

		for ($i = 0; $i < $countData; $i++) {

			$data['ex_factory_unit_price'] = $post['ex_factory_unit_price'][$i];

			$data['fabric_price'] = $post['fabric_price'][$i];

			$data['leather_price'] = $post['leather_price'][$i];

			$data['unit_price_fob'] = $post['unit_price_fob'][$i];

			$data['unit_price_cif'] = $post['unit_price_cif'][$i];

			$data['fabric_quantity'] = $post['fabric_quantity'][$i];

			$data['leather_quantity'] = $post['leather_quantity'][$i];

			$data['ex_factory_quantity'] = $post['ex_factory_quantity'][$i];

			$data['fk_bw_id'] = $post['bw_id'][$i];

			$data['fk_user_id'] = $post['sId'];



			$getMarkupValue = $this->rfqModel->getMarkupValue($post['bw_id'][$i]);



			$markup_type = $getMarkupValue['markup_type'];

			if ($markup_type == 'fixed') {

				$data['ex_factory_markup'] = $getMarkupValue['markup_type_value_ex_factory'];

				$data['fabric_markup'] = $getMarkupValue['markup_type_value_fabric'];

				$data['leather_markup'] = $getMarkupValue['markup_type_value_leather'];
			} else {

				$data['ex_factory_markup'] = isset($post['ex_factory_markup'][$i]) ? $post['ex_factory_markup'][$i] : 0;

				$data['fabric_markup'] = isset($post['fabric_markup'][$i]) ? $post['fabric_markup'][$i] : 0;

				$data['leather_markup'] = isset($post['leather_markup'][$i]) ? $post['leather_markup'][$i] : 0;
			}



			$data['unit_total_price_ex_factory'] = $post['ex_factory_quantity'][$i] * $post['ex_factory_unit_price'][$i];

			$data['admin_unit_total_price_exfactory'] = $data['unit_total_price_ex_factory'] + ($data['ex_factory_markup'] / 100);



			$data['unit_total_price_fabric'] = $post['fabric_quantity'][$i] * $post['fabric_price'][$i];

			$data['admin_unit_total_price_fabric'] = $data['unit_total_price_fabric'] + ($data['fabric_markup'] / 100);



			$data['unit_total_price_leather'] = $post['leather_quantity'][$i] * $post['leather_price'][$i];

			$data['admin_unit_total_price_leather'] = $data['unit_total_price_leather'] + ($data['leather_markup'] / 100);





			// $data['total_price_fob'] = (((double)$data['fabric_quantity'] * (double)$data['fabric_price']) + ((double)$data['leather_quantity'] * (double)$data['leather_price'])) + ((double)$data['unit_price_fob'] * ((double)$data['leather_quantity']+(double)$data['fabric_quantity']));



			$data['total_price_fob'] = $data['ex_factory_quantity'] * $data['unit_price_fob'];



			// $data['total_price_cif'] = (((double)$data['fabric_quantity'] * (double)$data['fabric_price']) + ((double)$data['leather_quantity'] * (double)$data['leather_price'])) + ((double)$data['unit_price_cif'] * ((double)$data['leather_quantity']+(double)$data['fabric_quantity']));



			$data['total_price_cif'] = $data['ex_factory_quantity'] * $data['unit_price_cif'];



			// $updateArray = array(

			// 	'ex_factory_unit_price' => $data['ex_factory_unit_price'],

			// 	'fabric_quantity' => $data['fabric_quantity'],

			// 	'fabric_price' => $data['fabric_price'],

			// 	'leather_quantity' => $data['leather_quantity'],

			// 	'leather_price' => $data['leather_price'],

			// 	'unit_price_fob' => $data['unit_price_fob'],

			// 	'unit_price_cif' => $data['unit_price_cif'],

			// 	'total_price_fob' => $data['total_price_fob'],

			// 	'total_price_cif' => $data['total_price_cif'],

			// );



			if (isset($post['bwi_id'][$i]) && $post['bwi_id'][$i] != '') {

				$this->rfqModel->updateRfqBidPrice($post['bwi_id'][$i], $data);
			} else {

				$this->rfqModel->insertRfqBidPrice($data);
			}
		}

		redirect('rfq');
	}



	public function rfqDataAnalysis($rfqId, $check = '')

	{

		$select2 = "bwi.bwi_id, bw.bw_id, bw.item_name, bw.id_code,bw.fk_b_id,bw.item_type,bw.photo,bw.width,bw.depth,bw.height,bw.short_height,bw.technical_description,bw.quantity,bw.fabric_quantity,bw.leather_quantity,bw.cbm,bw.note";

		$where2 = array('bw.fk_b_id' => $rfqId);

		$item = $this->rfqModel->getItemListForAnalysis($select2, $where2);

		$tables = array();

		foreach ($item as $key => $value) {

			$bwi_id['bwi_id'][] = $value['bwi_id'];
			$bw_id['bw_id'][] = $value['bw_id'];

			$table['item'] = $value['item_name'];

			// $table['item'] = $value['item_name'];

			$table['item_type'] = $value['item_type'];

			$table['id_code'] = $value['id_code'];

			$table['quantity'] = $value['quantity'];

			$table['fabric_quantity'] = $value['fabric_quantity'];

			$table['leather_quantity'] = $value['leather_quantity'];



			$bid = $this->rfqModel->getItemBidPrice($value['bw_id']);

			//print_r($bid);exit;

			$bidCount = count($bid);

			foreach ($bid as $innerkey => $innervalue) {

				$table['supplier' . ($innerkey + 1)] = $innervalue['ex_factory_unit_price'] . '_' . $innervalue['company_name'];

				$usercomanyname[] = ' (' . $innervalue['company_name'] . ')';
			}

			// print_r($table);exit;

			array_push($tables, $table);
		}



		$AED_price = $this->session->userdata('aed_price');

		$html = $this->load->view('dataAnalysis', array('data' => $tables, 'count' => $bidCount, 'fk_b_id' => $rfqId, 'bwi_id' => $bwi_id['bwi_id'], 'bw_id' => $bw_id['bw_id'], 'userCompany' => $usercomanyname, 'conversion_rate' => $AED_price, 'check' => $check), true);

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



		$fieldName = array('Room Type', 'Item_name', 'id_code', 'item_type', 'Width', 'Depth', 'Height', 'Short Height', 'Quantity', 'Fabric Quantity', 'Leather Quantity', 'unit_price_(_ex_factory_)', 'fabric_price', 'leather_price', 'unit_price_fob', 'unit_price_cif', 'cbm', 'note');

		$selectedColumns['columnFields'] = implode(', ', $fieldName);

		$fileName = 'RFQ_Item_List ' . date('d-m-y') . '.xlsx';

		if (isset($selectedColumns['columnFields'])) {

			$columnArray = explode(',', $selectedColumns['columnFields']);

			foreach ($columnArray as $cA) {

				$getColumn[] = ucwords(str_replace('_', ' ', $cA));
			}

			$columnString = "*";

			$whereBidId = array('fk_b_id' => $list);

			$rfqData = $this->rfqModel->exportRfqItem($columnString, $whereBidId);

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

			foreach ($rfqData as $val) {

				if (isset($val['room_type'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['room_type']);

					$col++;
				}



				if (isset($val['item_name'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['item_name']);

					$col++;
				}

				if (isset($val['id_code'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['id_code']);

					$col++;
				}

				if (isset($val['item_type'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['item_type']);

					$col++;
				}

				if (isset($val['width'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['width']);

					$col++;
				}

				if (isset($val['depth'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $rows, $val['depth']);

					$col++;
				}

				if (isset($val['height'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['height']);

					$col++;
				}

				if (isset($val['short_height'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['short_height']);

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

				if (isset($val['ex_factory_unit_price'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['ex_factory_unit_price']);

					$col++;
				}

				if (isset($val['fabric_price'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['fabric_price']);

					$col++;
				}

				if (isset($val['leather_price'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['leather_price']);

					$col++;
				}
				if (isset($val['unit_price_fob'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['unit_price_fob']);

					$col++;
				}

				if (isset($val['unit_price_cif'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['unit_price_cif']);

					$col++;
				}

				if (isset($val['cbm'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['cbm']);

					$col++;
				}

				if (isset($val['note'])) {

					$sheet->setCellValue($alphabets[$col] . $rows, $val['note']);

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



	public function bidApply($id)
	{
		// echo $id;
		$version = $this->rfqModel->getLatestVersion($id);
		$this->rfqModel->dublicateBid($id, $version);
		// exit();

		$update = $this->rfqModel->updateRFQ(['status' => 'Re Bid'], ['b_id' => $id]);
		// print_r($update);
		// die;
		redirect('analysis');
	}



	public function sendProposal($rfq)

	{

		$markup = $this->input->post('markup');
		$bwi_id_array[] = "";
		foreach ($markup as $bw_id => $bwi_id) {
			foreach ($bwi_id as  $key => $markup) {
				$bwi_id_array[] = $key;
				$markup_array[] = $markup;
			}
			$bwi = array_values(array_filter($bwi_id_array));
		}
		$refqDetail = $this->rfqModel->getRFQDetails(['b_id' => $rfq]);
		$update = $this->rfqModel->updateRFQ(['status' => 'Wating For Approval'], ['b_id' => $rfq]);
		$insertProposal['fk_lead_opportunity_id'] = $refqDetail[0]['fk_lead_opportunity_id'];

		$prop_title = str_replace("RFQ", "Proposal", $refqDetail[0]['title']);

		$insertProposal['title'] = $prop_title;

		$insertProposal['approval_deadline'] = $refqDetail[0]['approval_deadline'];

		$insertProposal['notes'] = $refqDetail[0]['notes'];

		$insertProposal['created_date'] = date('Y-m-d H:i:s');

		$insertProposal['send_date'] = date('Y-m-d H:i:s');

		$insertProposal['status'] = 'Drafted';

		$insertProposal['approved_by_admin'] = '0';

		$insertProposal['approved_by_customer'] = '0';
		$insertProposal['fk_b_id'] =$rfq;

		$version = $refqDetail[0]['version'];



		$id = $this->proposalModel->insertProposal($insertProposal);



		$bid = $this->rfqModel->getItemBidItemPrice($bwi, $version);
		// echo "<pre>"; 
		// print_r($bid);
		// $key = array_keys($bid, min($bid));
			$insertWorkSheet =array();

		foreach ($bid as $key =>  $proposal_bid) {
			$rfqWorksheet = $proposal_bid;
// print_r($rfqWorksheet);
			$insertWorkSheet['fk_pid'] = $id;
			$insertWorkSheet['fk_user_id'] = $rfqWorksheet['fk_user_id'];

			$insertWorkSheet['project_name'] = $refqDetail[0]['project_name'];

			$insertWorkSheet['room_type'] = $rfqWorksheet['room_type'];

			$insertWorkSheet['id_code'] = $rfqWorksheet['id_code'];

			$insertWorkSheet['item_name'] = $rfqWorksheet['item_name'];

			$insertWorkSheet['item_type'] = $rfqWorksheet['item_type'];

			// $insertWorkSheet['width'] = $rfqWorksheet['width']; 

			// $insertWorkSheet['depth'] = $rfqWorksheet['depth']; 

			// $insertWorkSheet['height'] = $rfqWorksheet['height']; 

			// $insertWorkSheet['short_height'] = $rfqWorksheet['short_height']; 

			// $insertWorkSheet['technical_description'] = $rfqWorksheet['technical_description']; 

			$insertWorkSheet['quantity'] = $rfqWorksheet['quantity'];

			$insertWorkSheet['ex_factory_unit_price'] = $rfqWorksheet['ex_factory_unit_price'];

			$insertWorkSheet['unit_price_markup'] = 0;

			$insertWorkSheet['ex_factory_mark_up_amt'] = 0;

			$insertWorkSheet['ex_factory_total_markup'] = 0;

			$insertWorkSheet['total_price_ex_factory'] = $rfqWorksheet['total_price_ex_factory'];

			$insertWorkSheet['fabric_quantity'] = $rfqWorksheet['fabric_quantity'];

			$insertWorkSheet['fabric_price'] = $rfqWorksheet['fabric_price'];

			$insertWorkSheet['fabric_markup'] = $rfqWorksheet['fabric_markup'];

			$insertWorkSheet['fabric_mark_up_amt'] = 0;

			$insertWorkSheet['fabrics_total_markup'] = 0;

			$insertWorkSheet['unit_total_price_fabric'] = $rfqWorksheet['unit_total_price_fabric'];

			$insertWorkSheet['leather_quantity'] = $rfqWorksheet['leather_quantity'];

			$insertWorkSheet['leather_price'] = $rfqWorksheet['leather_price'];

			$insertWorkSheet['leather_markup'] = $rfqWorksheet['leather_markup'];

			$insertWorkSheet['leather_mark_up_amt'] = 0;

			$insertWorkSheet['leather_total_markup'] = 0;

			$insertWorkSheet['unit_total_price_leather'] = $rfqWorksheet['unit_total_price_leather'];

			$insertWorkSheet['unit_price_fob'] = $rfqWorksheet['unit_price_fob'];

			$insertWorkSheet['unit_price_cif'] = $rfqWorksheet['unit_price_cif'];

			$insertWorkSheet['total_price_fob'] = $rfqWorksheet['total_price_fob'];

			$insertWorkSheet['total_price_cif'] = $rfqWorksheet['total_price_cif'];

			$insertWorkSheet['cbm'] = $rfqWorksheet['cbm'];

			$insertWorkSheet['note'] = $rfqWorksheet['note'];

			$insertWorkSheet['total_price_markup'] = $markup_array[$key];
			$insertWorkSheet['markup'] = $markup_array[$key];
			$insertWorkSheet['rate_USD'] = $rfqWorksheet['ex_factory_unit_price'];
			$insertWorkSheet['exchange_rate'] = $this->session->userdata('aed_price');
			// $insertWorkSheet['rate_AED'] = $rfqWorksheet['ex_factory_unit_price'] * $this->session->userdata('aed_price');

			if ($markup_array[$key] != 0) {

				$insertWorkSheet['total_price_fob'] = $rfqWorksheet['total_price_fob'] + ($rfqWorksheet['total_price_fob'] * ($markup_array[$key] / 100));

				$insertWorkSheet['total_price_cif'] = $rfqWorksheet['total_price_cif'] + ($rfqWorksheet['total_price_cif'] * ($markup_array[$key] / 100));;
			}

			$insertWorkSheet['created_date'] = date('Y-m-d H:i:s');

			$insertWorkSheet['updated_date'] = date('Y-m-d H:i:s');

			// print_r($insertWorkSheet);

			$wid = $this->proposalModel->insertWorkSheet($insertWorkSheet);
		}

		$this->rfqModel->updateLeadToJob($refqDetail[0]['fk_lead_opportunity_id']);

		// print_r($_SESSION['user_id']);

		$insertJob['fk_lead_opportunity_id'] = $refqDetail[0]['fk_lead_opportunity_id'];

		$insertJob['created_by'] = $_SESSION['user_id'];

		$this->jobModel->insertJob($insertJob);



		redirect('proposal');
	}
	
}
