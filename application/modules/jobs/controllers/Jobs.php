<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Jobs extends CI_Controller {



	/**

	 * Job Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://DomainName/job

	 *

	 * @author		 

	 */



	public function __construct() {

		parent::__construct();

		$user_id = $this->session->userdata('user_id');

        if (!isset($user_id) || $user_id=='') {

            $this->session->sess_destroy();

            redirect('login');

        }

		$this->load->model(array('Job_model' => 'jobModel'));

		$this->load->library(array('Permissions_library' => 'permission'));

	}



	/**

	* index action of user controller

	* @author

	* @param

	* @param

	*/

	public function index()

	{

		$permissions = $this->permission->checkUserPermission(36);

		if (!$permissions) {

			redirect('page_not_found');exit;

		}



		$module_name = $this->uri->segment(1);

		 // echo $module_name; die; 

		$this->page->setTitle('Jobs');

		// set head style

		$this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style-2.css");

		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");	

		$this->page->setHeadStyle(base_url()."assets/custom/css/jquery.dataTables.min.css");

		

		$this->page->setHeadStyle(base_url()."assets/custom/css/style.css");

		$this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");

		

		//set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs(base_url()."assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url()."assets/demo/default/base/scripts.bundle.js");

		$this->page->setFooterJs("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");

		$this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/job.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/custom.js");

		// load layout

		$page['module_name'] = $module_name;

		$page['contain'] = 'jobList';

		$page['access'] = $this->session->userdata('adminAccess');


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



	public function getJob() {

		 // echo "dfchgjbk"; die;

		$offset = null;

		$limit = null;

		$request = $this->input->get();

		//$offset = $request['start'];

		//$limit = $request['length']; 

			// print_r($request); die;

		

		if(!empty($request['search']['value'])) {

			foreach ($whereFeilds as $key => $value) {

				$where.= ' and '.$value." Like '%".$request['search']['value']."%'";

			}

		}



		// add filters

		if(!empty($request['q'])) { 

			$query = json_decode($request['q'],true);

			if($query) {

				$filter = $this->role->getWhereField(array_keys($query));

				foreach ($filter as $key => $value) { 

					if ($query[$key] !='') { 

						$where.= $value." = '".$query[$key]."'"; 

					}

				}

			}

		}

		$order = null;

		if(isset($request['order']) && is_array($request['order'])) {

			$order = $columns[$request['order'][0]['column']].' '.$request['order'][0]['dir']; 	

		}

		$post = $this->input->post();

		//print_r($post);exit;

		$select = 'lo.opportunity_title as job_name, u.full_name as converted_by, j.created_date as converted_date, j.job_id, u2.full_name as customer_contact';

		if(isset($post[0]) && is_numeric($post[0])) {

			

			$where = array('lo.job_status' => 'converted', 'lo.fk_sales_people_id' => $post[0]);

		} else {

			$where = array('lo.job_status' => 'converted');

		}

		$jobList = $this->jobModel->getJobs($select,$where);



		foreach ($jobList as $key => $value) {

			$jobList[$key]['converted_date'] = date("d-M-Y h:m A", strtotime($jobList[$key]['converted_date']));

		}



		$jobCount = $this->jobModel->getJobs('j.job_id',$where);

		// print_r(count($companycount)); die;

		$data['recordsFiltered'] = count($jobCount); 

		$data['recordsTotal'] = count($jobCount); 

		$data['data'] = $jobList;

		// print_r($data['data']); die;

		echo json_encode($data);

	} // end : getLeads Action ,2



}

