<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Role extends CI_Controller {



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

		$this->load->model(array('Role_model' => 'roleModel'));

		$this->load->model(array('Activity_model' => 'leadActivityModel'));

		$this->load->model(array('Lead_model' => 'leadOpportunityModel'));

		$this->load->library(array('Role_library' => 'role'));

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

		$permissions = $this->permission->checkUserPermission(1);

		if (!$permissions) {

			redirect('page_not_found');

		}

		

		$module_name = $this->uri->segment(1);

		// echo $userType; die; 

		$this->page->setTitle('Role Management');

		

		// set head style

		$this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style-2.css");

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

		$this->page->setFooterJs(base_url()."assets/custom/js/role.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/custom.js");

		

		// load layout



		$page['contain'] = 'roleList';

		$page['userType'] = $userType;

		$page['tabs'] = $this->role->getTabs();

		$page['newButton'] = $this->role->getNewButton();

		$page['module_name'] = $module_name;

		$page['filter'] = $this->input->post('filter');

		//$page['gridView'] = $this->roleModel->getGrid('*',array('module_name' => $module_name));



		$page['activityColumn'] = $this->role->getOpportunityCoulmn();



		$selectFilter = '*';

		$whereFilter = array('module' => 'Role');

		$page['savedFilter'] = $this->roleModel->getSavedFilter($selectFilter,$whereFilter);

		$page['deletePermission'] = $this->permission->checkUserPermission(52);
		

		$this->page->getLayout($page);

	}



	/**

	* createUser action of User controller to create user

	* @author Bimal Sharma

	*/

	public function createRole($roleID = null) {

		try{ 

			$post = $this->input->post();

			if (isset($post['role_id']) && $post['role_id'] !='') {

				$roleID = $post['role_id'];

			}

			// print_r($post);

			$insertRoleArray = array(

				'role_name' => $post['roleName'], 

				'role_description' => $post['roledescription'],

				'role_status' => 'active'			

			);   

			// print_r($insertRoleArray); die;



			$data['formheading'] = "Add Role";

			if(!$roleID) { 

				$data['id'] = $this->roleModel->insertrole($insertRoleArray);				

				$this->session->set_userdata('setMessage','Added');				

				

			}else {

				$where = array('role_id' => $roleID);

				$data['id'] = $this->roleModel->updateRole($insertRoleArray,$where);

				$data['formheading'] = "Edit Activity";	

				$this->session->set_userdata('setMessage','Updated');				

			}



			$response['code'] = 200;

			$response['message'] = "<div class='alert alert-success'>

	                    <strong>Success!</strong> Role Added Successfully.</div>";

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



			$select = '*';

			$where = [];

			$getRoleList = $this->roleModel->getRole($select,$where);

			

			$data['getrole'] =  $getRoleList;

			// print_r($data['getLead']['1']['user_info']); die;





			$selectSalesPerson = 'role_id,role_name';

			$whereSalesPerson = "";

			$data['roleList'] = $this->roleModel->getRoleList($selectSalesPerson,$whereSalesPerson);

			// print_r($data['roleList']);die;

			$data['formheading'] = "Add Role";

			if($id) {

				$selectActi = "*";



				$where = 'role_id = "'.$id.'"';

				$actiList = $this->roleModel->getRole($selectActi,$where);

				$data['value'] = $actiList;

				// print_r($data['value']); die;

				if(is_array($data['value'])) {

					$data['value'] = $data['value'][0];

				}

// print_r($data['value']['follow_up_date']); die;

				$selectConatactType = '*';

				$whereConactInfo = 'fk_user_id = "'.$id.'"';

				// $data['Contact'] = $this->leadOpportunityModel->getUserContact($selectConatactType,$whereConactInfo);

				$data['formheading'] = "Edit Role";

			}

			$data['userId'] = $id;

			// print_r($data['getLead']['0']); die;

			$html = $this->page->getPage('roleForm',$data,true);

			

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

	public function getPermissions(){

		try {

			$post = $this->input->post();

			$data['role_id'] = $post['role_id'];

			// $select = '*';

			// $where = array('fk_role_id' => $post['role_id']);

			// $getPermissions = $this->roleModel->getPermissions($select, $where);

			// if (!empty($getPermissions[0]['permissions'])) {

			// 	$data['permissions'] = json_decode($getPermissions[0]['permissions']);

			// } else {

			// 	$data['permissions'] = array();

			// }

			

			// //print_r($data['permissions']);exit;

			// $data['permissionList'] = $this->roleModel->getPermissionsList();

			// //print_r($data['permissionList']);exit;

			// $select = '*';

			// $where = $data['permissions'];

			// $data['permissionDetails'] = $this->roleModel->getModules($select, $where);

			// // print_r($getModule);exit;

			// foreach ($data['permissionDetails'] as $module) {

			// 	$fk_module_id [] = $module['fk_module_id'];

			// }



			// $select = '*';

			// $where = $fk_module_id;

			// $data['modules'] = $this->roleModel->getModuleDetails($select, $where);

			

			$selectModule = "m.*, GROUP_CONCAT(permission_id,'_',title) as permission";

			$whereModule = array('m.module_type' => 'permissions');

			$data['module'] = $this->userModel->getModulePermissions($selectModule, $whereModule);

			//print_r($data['module']);exit;

			$post = $this->input->post();

			$selectmodule = 'rpn_id, permissions';

			$wheremodule = array('fk_role_id' => $post['role_id']);

			$data['permissions'] = $this->userModel->getPermissionsNotifications($selectmodule, $wheremodule);



			// print_r($data['permissions']);die;

			$data['formheading'] = "Add Role";

			$getPermissionView = $this->load->view('pages/rolePermission', $data);

			echo $getPermissionView;

		}catch(Exception $e) {

			$response['code'] = 505;

			$response['message'] = 'exception in form generation';

			$response['data'] = array();

		}



	} // End : Permission Notification Action



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



	public function addNotification() {

		$post = $this->input->post();

		$emailCheckNotification = json_encode($post['emailcheck']);

		$textCheckNotification = json_encode($post['textcheck']);

		$pushCheckNotification = json_encode($post['pushcheck']);

		$allUserCheckNotification = json_encode($post['allcheck']);



		$role_id = $post['role_id'];

		$whereUser = array('fk_role_id' => $role_id);

		$getRoleID = $this->roleModel->getRoleIdPermissions($whereUser);

		if ($getRoleID == 1) {

			$updateArray = array(

						'email_notifications' => $emailCheckNotification,

						'text_notifications' => $textCheckNotification,

						'push_notifications' => $pushCheckNotification,

						'all_user_notification' => $allUserCheckNotification

						);

			$where = array('fk_role_id' => $role_id);

			$data= $this->roleModel->updateRolePermissions($updateArray, $where);

			$this->session->set_userdata('setMessage','Updated');

		} else {

			$insertArray = array(

						'fk_role_id' => $role_id,

						'email_notifications' => $emailCheckNotification,

						'text_notifications' => $textCheckNotification,

						'push_notifications' => $pushCheckNotification,

						'all_user_notification' => $allUserCheckNotification

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

	public function getRole() {		

		 // echo "dfchgjbk"; die;

		$request = $this->input->get();

		$offset = $request['start'];

		$limit = $request['length']; 

			// print_r($request); die;



		$columnArray = $request['columns'];

		$feilds = $columns = array_column($columnArray,'data');

		$feilds = $this->role->getSelectField($columns); 

		$whereFeilds = $this->role->getWhereField($columns); 

// print_r($whereFeilds);

		// $where = 't1.activity_status = "active"';

		$where = 'role_status!="inactive"';

		

		if(!empty($request['search']['value'])) {

			// foreach ($whereFeilds as $key => $value) {

			// 	$where.= ' or '.$value." Like '%".$request['search']['value']."%'";

			// }
			$where .=" and `role_id` Like '%".$request['search']['value']."%' or `role_name` Like '%".$request['search']['value']."%' or `role_description` Like '%".$request['search']['value']."%'";

		}



		// add filters

		if(!empty($request['q'])) { 

			$query = json_decode($request['q'],true);

			if($query) {

				$filter = $this->role->getWhereField(array_keys($query));

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
// echo $where;
		$order = null;

		if(isset($request['order']) && is_array($request['order'])) {

			$order = $columns[$request['order'][0]['column']].' '.$request['order'][0]['dir']; 	

		}

		// var_dump($feilds); die; 

		//echo "h2222222222222"; die;

		// array_push($feilds, "GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info");

		//$where="`role_status`!='inactive'";	

		$companyList = $this->roleModel->getRole($feilds,$where,$order,$limit,$offset);

		// print_r($companyList);die;

		/*foreach ($companyList as $key => $value) {			

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

		}*/



		// $roleID = $companyList['fk_role_id'];

		// // echo $roleID; die;

		$companycount = $this->roleModel->getRole('*',$where);

		// print_r(count($companycount)); die;

		$data['recordsFiltered'] = count($companycount); 

		$data['recordsTotal'] = count($companycount); 

		$data['data'] = $companyList;

		// print_r($data['data']); die;

		echo json_encode($data);

	} // end : getLeads Action ,2



	public function deleteRole() { 

        $DeleteId = $this->input->post();

		// print_r($DeleteId);

        $newUsrId = explode(',', $DeleteId['deleteThis']);

        $deleteUpdateData = array('role_status' => 'inactive');

		$DeletedUser = $this->roleModel->deleteRole($deleteUpdateData,$newUsrId);

        // print_r($DeletedUser);die;

        if ($DeletedUser) {

            $this->session->set_userdata('setMessage','deleted');

            return true;

        } else {

            return False;

        }

    }



	public function createExcel($userType = null) {



    	header('Content-Disposition: attachment; filename="leadActivity.csv";');

    	header('Content-Type: application/csv');

        $columnArray = $this->role->getActivityCoulmn();



        $fields = $columns = array_column($columnArray,'data');

        // print_r($fields); die;

        $title =  array_column($columnArray,'title');

		$fields = $this->role->getSelectField($columns);

		$fields[0] = "t2.opportunity_title";

		unset($fields[1]);

		$fields[4] = "CONCAT(u1.first_name,' ',u1.last_name) as first_name ";

		$fields[7] = "(select contact_info from users_contacts where fk_user_id=t2.fk_user_id and contact_type='Email') as `email`";

		$fields[8] = "(select contact_info from users_contacts where fk_user_id=t2.fk_user_id and contact_type='Phone') as `phone`";

		// get where field

		$whereFeilds = $this->role->getWhereField($columns); 	

		

		$where = 't1.activity_status = "active"'; 

		$activityList = $this->leadActivityModel->getActivity($fields,$where);

		//print_r($activityList);exit;

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



}

