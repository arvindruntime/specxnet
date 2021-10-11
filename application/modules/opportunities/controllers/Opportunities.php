<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Opportunities extends CI_Controller {



	/**

	 * User Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://DomainName/users

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

		$this->load->model(array('Lead_model' => 'leadOpportunityModel'));

		$this->load->library(array('Permissions_library' => 'permission'));

		//$this->load->library(array('Role_library' => 'role'));

		//$this->load->model(array('Role_model' => 'roleModel'));

		$this->load->library(array('Opportunity_library' => 'opportunity'));

		$this->load->model(array('Opportunity_model' => 'opportunityModel'));

	}



	/**

	* index action of user controller

	* @author

	* @param

	* @param

	*/

	public function index($userType = 'internal')

	{

		$permissions = $this->permission->checkUserPermission(1);

		if (!$permissions) {

			redirect('page_not_found');

		}

		

		$module_name = $this->uri->segment(1);

		// echo $userType; die; 

		$this->page->setTitle('Opportunities Management');

		

		// set head style

		$this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");

		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");	

		$this->page->setHeadStyle(base_url()."assets/custom/css/jquery.dataTables.min.css");

		// $this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");		

		$this->page->setHeadStyle(base_url()."assets/custom/css/style.css");

		$this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");

		// <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js"></script>

    	// <link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">

		

		//set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs(base_url()."assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url()."assets/demo/default/base/scripts.bundle.js");

		$this->page->setFooterJs("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");

		$this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/opportunity.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/custom.js");

		

		// load layout



		$page['contain'] = 'opportunityList';

		$page['userType'] = $userType;

		$page['tabs'] = $this->opportunity->getTabs();

		$page['newButton'] = $this->opportunity->getNewButton();

		$page['module_name'] = $module_name;

		$page['filter'] = $this->input->post('filter');

		//$page['gridView'] = $this->roleModel->getGrid('*',array('module_name' => $module_name));



		$page['activityColumn'] = $this->opportunity->getOpportunityCoulmn();



		// $selectFilter = '*';

		// $whereFilter = array('module' => 'Role');

		// $page['savedFilter'] = $this->roleModel->getSavedFilter($selectFilter,$whereFilter);

		

		$this->page->getLayout($page);

	}



	/**

	* createUser action of User controller to create user

	* @author Bimal Sharma

	*/

	public function create_opportunity($opportunity_id = null) {

		try{ 

			$post = $this->input->post();

			if (isset($post['opportunity_id']) && $post['opportunity_id'] !='') {

				$opportunity_id = $post['opportunity_id'];

			}

			// print_r($post);

			$insertOpportunityArray = array(

				'opportunity_title' => $post['opportunity_title'], 

				'created_date' => date('d-m-Y'),

			);   

			// print_r($insertRoleArray); die;



			$data['formheading'] = "Add Role";

			if(!$opportunity_id) { 

				$data['id'] = $this->opportunityModel->inserttitle($insertOpportunityArray);				

				$this->session->set_userdata('setMessage','Added');				

				

			}else {

				$where = array('opportunity_id' => $opportunity_id);

				$data['id'] = $this->opportunityModel->updateOpportunity($insertOpportunityArray,$where);

				$data['formheading'] = "Edit Activity";	

				$this->session->set_userdata('setMessage','Updated');				

			}



			$response['code'] = 200;

			$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Opportunity Title Added Successfully.</div>";

			$response['data'] = $data['id'];

			// $response['data']['heading'] = $data['formheading'];

		}catch(Exception $e){

			$response['code'] = 505;

			$response['message'] = 'exception in insertion';

			$response['data'] = array();

		}

		echo json_encode($response);

	}





/**	* displayForm action of User controller

	* @author Bimal Sharma

	* @param $userType String user type (internal,supplier,customer)

	*/

	public function displayForm($id = null) {

		// echo $userType; die;

		// echo "displayForm for update"; die;

		// echo $id; die;

		try {



			// $select = '*';

			// $where = [];

			// $getRoleList = $this->roleModel->getRole($select,$where);

			

			// $data['getrole'] =  $getRoleList;

			// print_r($data['getLead']['1']['user_info']); die;





			// $selectSalesPerson = 'role_id,role_name';

			// $whereSalesPerson = "";

			// $data['roleList'] = $this->roleModel->getRoleList($selectSalesPerson,$whereSalesPerson);

			// print_r($data['roleList']);die;

			$data['formheading'] = "Add Title";

			if($id) {

				$selectActi = "*";

				$where = 'opportunity_id = "'.$id.'"';

				$actiList = $this->opportunityModel->getOpportunityTitle($selectActi,$where);

				$data['value'] = $actiList;

				// print_r($data['value']); die;

				if(is_array($data['value'])) {

					$data['value'] = $data['value'][0];

				}

// print_r($data['value']['follow_up_date']); die;

				$selectConatactType = '*';

				$whereConactInfo = 'fk_user_id = "'.$id.'"';

				// $data['Contact'] = $this->leadOpportunityModel->getUserContact($selectConatactType,$whereConactInfo);

				$data['formheading'] = "Edit Title";

			}

			$data['userId'] = $id;

			// print_r($data['getLead']['0']); die;

			$html = $this->page->getPage('opportunityForm',$data,true);

			

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





	// Start : Permission Notification Action

	public function getIndustryData(){

		try {

			$post = $this->input->post();

			$selectModule = "industry_id as id, industry_name as name";

			$whereModule = array();

			$data['data'] = $this->dropdownModel->getIndustryData($selectModule, $whereModule);



			// print_r($data['permissions']);die;

			$data['formheading'] = $post['module_name']." Dropdown Data";

			$data['module'] = "Industry";

			$getPermissionView = $this->load->view('pages/dropdownList', $data);

			echo $getPermissionView;

		}catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}



	}



	// Start : Permission Notification Action

	public function getDivisionData(){

		try {

			$post = $this->input->post();

			$selectModule = "division_id as id, division_name as name";

			$whereModule = array();

			$data['data'] = $this->dropdownModel->getDivsionData($selectModule, $whereModule);



			// print_r($data['permissions']);die;

			$data['formheading'] = $post['module_name']." Dropdown Data";

			$data['module'] = "Division";

			$getPermissionView = $this->load->view('pages/dropdownList', $data);

			echo $getPermissionView;

		}catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}



	}



	// Start : Permission Notification Action

	public function getDepartmentData(){

		try {

			$post = $this->input->post();

			$selectModule = "department_id as id, department_name as name";

			$whereModule = array();

			$data['data'] = $this->dropdownModel->getDepartmentData($selectModule, $whereModule);



			// print_r($data['permissions']);die;

			$data['formheading'] = $post['module_name']." Dropdown Data";

			$data['module'] = "Department";

			$getPermissionView = $this->load->view('pages/dropdownList', $data);

			echo $getPermissionView;

		}catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}



	}



	// Start : Permission Notification Action

	public function getSourcesData(){

		try {

			$post = $this->input->post();

			$selectModule = "source_id as id, source_name as name";

			$whereModule = array();

			$data['data'] = $this->dropdownModel->getSourceData($selectModule, $whereModule);



			// print_r($data['permissions']);die;

			$data['formheading'] = $post['module_name']." Dropdown Data";

			$data['module'] = "Sources";

			$getPermissionView = $this->load->view('pages/dropdownList', $data);

			echo $getPermissionView;

		}catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}



	}



	// Start : Permission Notification Action

	public function getJobTypeData(){

		try {

			$post = $this->input->post();

			$selectModule = "job_type_id as id, job_name as name";

			$whereModule = array();

			$data['data'] = $this->dropdownModel->getJobTypeData($selectModule, $whereModule);



			// print_r($data['permissions']);die;

			$data['formheading'] = $post['module_name']." Dropdown Data";

			$data['module'] = "Job Type";

			$getPermissionView = $this->load->view('pages/dropdownList', $data);

			echo $getPermissionView;

		}catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}



	}



	public function getNotification(){

		try {

			$post = $this->input->post();

			$data['role_id'] = $post['role_id'];

			$select = '*';

			$where = array('fk_role_id' => $post['role_id']);

			// $getNotification = $this->roleModel->getNotifications($select, $where);

			// if (!empty($getNotification[0]['notifications'])) {

			// 	$data['permissions'] = json_decode($getNotification[0]['notifications']);

			// } else {

			// 	$data['permissions'] = array();

			// }

			

			// //print_r($data['permissions']);exit;

			// $data['permissionList'] = $this->roleModel->getNotificationList();

			// //print_r($data['permissionList']);exit;

			// $select = '*';

			// $where = $data['permissions'];

			// $data['permissionDetails'] = $this->roleModel->getModulesNotification($select, $where);

			// // print_r($getModule);exit;

			// foreach ($data['permissionDetails'] as $module) {

			// 	$fk_module_id [] = $module['fk_module_id'];

			// }



			// $select = '*';

			// $where = $fk_module_id;

			// $data['modules'] = $this->roleModel->getModuleDetails($select, $where);

			



			// // print_r($data['roleList']);die;

			// $data['formheading'] = "Add Role";



			$selectModule = "m.*, GROUP_CONCAT(notification_id,'_',title,'_',email_notifications,'_',text_notifications,'_',push_notifications,'_',all_users_notification) as notification";

			$whereModule = array('m.module_type' => 'notifications');

			$data['module'] = $this->userModel->getModuleNotification($selectModule, $whereModule);

			$post = $this->input->post();

			$selectmodule = 'rpn_id, email_notifications, text_notifications, push_notifications, all_user_notification';

			$wheremodule = array('fk_role_id' => $post['role_id']);

			$data['notifications'] = $this->userModel->getPermissionsNotifications($selectmodule, $wheremodule);





			$getPermissionView = $this->load->view('pages/roleNotification', $data);

			echo $getPermissionView;

		}catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}



	} // End : Permission Notification Action







	public function addPermissions() {

		$post = $this->input->post();

		$checkedPermissions = json_encode($post['check']);

		$role_id = $post['role_id'];

		$whereUser = array('fk_role_id' => $role_id);

		$getRoleID = $this->roleModel->getRoleIdPermissions($whereUser);

		if ($getRoleID == 1) {

			$updateArray = array(

						'permissions' => $checkedPermissions

						);

			$where = array('fk_role_id' => $role_id);

			$data= $this->roleModel->updateRolePermissions($updateArray, $where);

			$this->session->set_userdata('setMessage','Updated');

		} else {

			$insertArray = array(

						'fk_role_id' => $role_id,

						'permissions' => $checkedPermissions

						);

			$data= $this->roleModel->insertRolePermissions($insertArray);

			$this->session->set_userdata('setMessage','Updated');

		}

		



		redirect('role/index');



	}



	/**

  	 * get list of copanies	

  	 * @author Bimal Sharma

	 * @param $companyType String company type (internal,supplier,customer)

	 */

	public function gettitle() {		

		 // echo "dfchgjbk"; die;

		$request = $this->input->get();

		$offset = $request['start'];

		$limit = $request['length']; 

			// print_r($request); die;



		$columnArray = $request['columns'];

		$feilds = $columns = array_column($columnArray,'data');

		$feilds = $this->opportunity->getSelectField($columns); 

		$whereFeilds = $this->opportunity->getWhereField($columns); 

// print_r($whereFeilds);

		// $where = 't1.activity_status = "active"';

		$where = 'active_status = "active"';

		

		if(!empty($request['search']['value'])) {

			foreach ($whereFeilds as $key => $value) {

				$where.= ' and '.$value." Like '%".$request['search']['value']."%'";

			}

		}



		// add filters

		if(!empty($request['q'])) { 

			$query = json_decode($request['q'],true);

			if($query) {

				$filter = $this->opportunity->getWhereField(array_keys($query));

				foreach ($filter as $key => $value) { 

					// if ($query[$key] !='') { 

					// 	$where.= ' and '.$value." = '".$query[$key]."'"; 

					// }

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

// print_r($where);exit;

		$companyList = $this->opportunityModel->getOpportunityTitle('*',$where,$order,$limit,$offset);

		

		$companycount = $this->opportunityModel->getOpportunityTitle('*',$where);

		// print_r(count($companycount)); die;

		$data['recordsFiltered'] = count($companycount); 

		$data['recordsTotal'] = count($companycount); 

		$data['data'] = $companyList;

		// print_r($data['data']); die;

		echo json_encode($data);

	} // end : getLeads Action ,2



	public function deleteOpportunity() { 

        $post = $this->input->post();



        $newUsrId = explode(',', $post['deleteThis']);

        $whereDelete = array('opportunity_id' => $newUsrId);

        $deleteUpdateData = array('active_status' => 'inactive');

		$DeletedUser = $this->opportunityModel->deleteTitle($deleteUpdateData,$whereDelete);

        // print_r($DeletedUser);die;

        if ($DeletedUser) {

            $this->session->set_userdata('setMessage','deleted');

            //redirect('dropdown');

        } else {

            return False;

        }

    }



    public function setModuleData() {

    	$post = $this->input->post();



		$module_id = $post['moduleId'];

		$module_name = $post['module_name'];

		$name = $post['check'];

		$i=0;

		foreach ($module_id as $key => $value) {

			if ($post['module_name'] == 'Industry') {

				$whereIndustry = array('industry_id' => $value);

	    		$updateArray = array(

	    			'industry_name' => $name[$i],

	    		);

	    	}



	    	if ($post['module_name'] == 'Division') {

				$whereIndustry = array('division_id' => $value);

	    		$updateArray = array(

	    			'division_name' => $name[$i],

	    		);

	    	}



	    	if ($post['module_name'] == 'Department') {

				$whereIndustry = array('department_id' => $value);

	    		$updateArray = array(

	    			'department_name' => $name[$i],

	    		);

	    	}



	    	if ($post['module_name'] == 'Sources') {

				$whereIndustry = array('source_id' => $value);

	    		$updateArray = array(

	    			'source_name' => $name[$i],

	    		);

	    	}



	    	if ($post['module_name'] == 'Job Type') {

				$whereIndustry = array('job_type_id' => $value);

	    		$updateArray = array(

	    			'job_name' => $name[$i],

	    		);

	    	}



	    	$updateIndustry = $this->dropdownModel->updateModuleItems($updateArray,$whereIndustry,$module_name);

	    	$i++;

		}



		redirect('dropdown');



    }

		

}

