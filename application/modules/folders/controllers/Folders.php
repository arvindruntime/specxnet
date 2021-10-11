<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Folders extends CI_Controller {

	/**
	 * Folder Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://DomainName/company
	 *
	 * @author Amit Singh
	 */

	const FOLDER_ARRAY = array('folders' => 'Folders', 'files' => 'Files');
	protected $formNameArray = array('folders' => 'folderForm', 'files' => 'fileForm');

	public function __construct() {
		parent::__construct();
		$user_id = $this->session->userdata('user_id');
        if (!isset($user_id) || $user_id=='') {
            $this->session->sess_destroy();
            redirect('login');
        }
		$this->load->model(array('Folder_model' => 'folderModel'));
		$this->load->model(array('File_model' => 'fileModel'));
		$this->load->model(array('User_model' => 'userModel'));
		$this->load->library(array('Folder_library' => 'folder'));
		$this->load->library(array('Permissions_library' => 'permission'));
	}

	/**
	* index action of Company controller
	* @author Amit Singh <email id>
	* @param $folderType String type of folder (folders)
 	* @param
	*/
	public function index($folderType='folders')
	{ 
		$permissions = $this->permission->checkUserPermission(2);
		if (!$permissions) {
			redirect('page_not_found');exit;
		}

		if ($folderType == 'folders') {
			$page['foldersPermissions'] = $permissionsType = $this->permission->checkUserPermission(8);
			$page['filesPermissions'] = $this->permission->checkUserPermission(6);
		} else if ($folderType == 'files') {
			$page['filesPermissions'] = $permissionsType = $this->permission->checkUserPermission(6);
			$page['foldersPermissions'] = $this->permission->checkUserPermission(8);
		} 

		if (!$permissionsType) {
			redirect('page_not_found');exit;
		}


		// set title
		$this->page->setTitle('Files & Folders Management');
		
		// set head style
		$this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");
		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");
		$this->page->setHeadStyle(base_url()."assets/custom/css/style.css");
		$this->page->setHeadStyle(base_url()."assets/custom/css/editor.css");
		$this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");
		$this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");

		// Date picker 
		$this->page->setHeadStyle(base_url()."assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css");
		
		// Date picker 
		$this->page->setHeadStyle(base_url()."assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css");

		// select 2 
		$this->page->setHeadStyle(base_url()."assets/select2/dist/css/select2.min.css");
		
		// //set footer js
		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");
		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");
		$this->page->setFooterJs(base_url()."assets/vendors/base/vendors.bundle.js");
		$this->page->setFooterJs(base_url()."assets/demo/default/base/scripts.bundle.js");
		$this->page->setFooterJs("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");
		//$this->page->setHeadStyle("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"); @shruthi Kumar
		$this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/custom.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/folder.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");
		$this->page->setFooterJs(base_url()."assets/custom/js/editor.js");


		$this->page->setHeadStyle(base_url()."assets/custom/css/jquery.dataTables.min.css");		
		$this->page->setFooterJs(base_url()."assets/custom/js/jquery.dataTables.min.js");

		// Date Picker
		$this->page->setFooterJs(base_url()."assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js");

		// Select 2
		$this->page->setFooterJs(base_url()."assets/select2/dist/js/select2.full.min.js");
		//Push Notification
		$this->page->setFooterJs(base_url()."assets/push_notification/notification.js");
		
		// check company config
		
		$page['config'] = $this->folder->getConfig();
		$page['tabs'] = $this->folder->getTabs();
		$page['newButton'] = $this->folder->getNewButton();
		$page['action'] = $this->folder->getAction();
		$page['actionButton'] = $this->folder->getActionButton();
		$page['companyColumn'] = $this->folder->getCompanyColumn($folderType);
		$page['checkedAction'] = $this->folder->getCheckedAction();
		$page['module_name'] = $this->uri->segment(1);
		$page['module_type'] = $this->uri->segment(1);
		//$page['gridView'] = $this->companyMondel->getGrid('*',array('module_name' => $page['module_name']));
		$page['filter'] = $this->input->post('filter');
		// load layout
		$page['contain'] = $folderType;
		$page['folderType'] = $folderType;
		$page['folderData'] = $this->folderModel->getFolders();
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
	public function createFolders($folderId = null) {
		try{
			$post = $this->input->post();
			//print_r($post);exit;
			// print_r($_FILES);exit;
			//@author: Sagar Kodalkar
			//Validation on input start
			$this->load->library('form_validation');
	        $this->form_validation->set_rules('folder_name', 'Folder Name', 'required');
	        $this->form_validation->set_rules('project_name', 'Project Name', 'required');
	        if ($this->form_validation->run() == FALSE) {
	            $response['error'] = "<div class='alert-danger-2'>
	                    <strong>Alert !</strong><br/><br/>".
	                    validation_errors().
	                "</div>";
	        } else {
	        	date_default_timezone_set('Asia/Kolkata');

	        	$insertArray = array(
					'folder_name' => $post['folder_name'],
					'is_parent' => $post['is_parent'],
					'project_name' => $post['project_name'],
					'activity_status' => 'Active'
				);
// print_r($insertArray);exit;
				if(!$folderId) {
					$whereFolder = array('folder_name' => $post['folder_name']);
					$checkFolder = $this->folderModel->isExistFolder($whereFolder);
		        	// print_r($checkCompany['count']);
		        	if ($checkFolder['count'] != 0) {
		        		$response['error'] = "<div class='alert-danger-2'>
								                    <strong>Alert !</strong><br/><br/>
								                    Folder name already exists !
								                </div>";
						$response['code'] = 400;
						$response['message'] = 'exception in insertion';
						echo json_encode($response);
		        		exit;
		        	}
		        	//echo "HIIII";exit;
					$insertArray['created_by'] = $this->session->userdata('user_id');
					$insertArray['created_date'] = date('Y-m-d h:i:s');
					$insertArray['modified_date'] = date('Y-m-d h:i:s');
					$data['folder_id'] = $this->folderModel->insertFolder($insertArray);
					//echo $data['folder_id']; die;
					$this->session->set_userdata('setMessage','Folder Added Successfully');
				} else {
					$whereFolder = array('folder_name' => $post['folder_name']);
					$checkFolder = $this->folderModel->isExistFolder($whereFolder);
		        	// print_r($checkCompany['count']);
		        	if ($checkFolder['count'] != 0 && $checkFolder['result'][0]['folder_id'] != $folderId) {
		        		$response['error'] = "<div class='alert-danger-2'>
								                    <strong>Alert !</strong><br/><br/>
								                    Folder name already exists !
								                </div>";
						$response['code'] = 400;
						$response['message'] = 'exception in insertion';
						echo json_encode($response);
		        		exit;
		        	}
					$insertArray['modified_date'] = date('d-m-Y h:i A');
					$where = array('folder_id' => $folderId);
					$data['folder_id'] = $this->folderModel->updateFolder($insertArray,$where);
					$this->session->set_userdata('setMessage','Folder Updated Successfully');

				}
				
				$response['code'] = 200;
				$response['message'] = "<div class='alert alert-success'>
	                    <strong>Success!</strong> Company Added Successfully.</div>";
				$response['data'] = $data['folder_id'];
	        }

		}catch(Exception $e){
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
	public function displayForm($id = null,$folderType = 'folders') {
		try {
			if ($id) {
				$Permission = $this->permission->checkUserPermission(4);
			} else {
				$Permission = $this->permission->checkUserPermission(3);
			}
			if ($Permission) {
				$select = 'folder_name,folder_id';
				$data['folderType'] = $folderType;
				$data['value'] = array();
				$data['formheading'] = "Add ".ucfirst($folderType);
				if($id) {
					$select = '*';
					$where = 'folder_id = "'.$id.'"';
					$data['value'] = $this->folderModel->getFolders($select,$where);
					
					if(is_array($data['value'])) {
						$data['value'] = $data['value'][0];
					}
					//print_r($data['value']);exit;
					$data['formheading'] = "Edit ".ucfirst($folderType);
				}

				$data['folderId'] = $id;
	
				$html = $this->page->getPage($this->formNameArray[$folderType],$data,true);
				
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
	
	/**
  	 * get list of copanies	
  	 * @author Bimal Sharma
	 * @param $companyType String company type (internal,supplier,customer)
	 */
	public function getFolders($folderType = 'folders') {
		// get method request
		$request = $this->input->get();
		//print_r($request); die;
		$offset = $request['start'];
		$limit = $request['length'];
		$columnArray = $request['columns'];

		// get selected filed
		$fields = $columns = array_column($columnArray,'data');
		
		$fields = $this->folder->getSelectField($columns,$folderType);
		
		// get where field
		$whereFeilds = $this->folder->getWhereField($columns,$folderType);	
		// print_r($whereFeilds); die;

		$where = NULL;
		// print_r($request); die;

		if(!empty($request['search']['value'])) {
			foreach ($whereFeilds as $key => $value) {
				$where.= 'and '.$value." Like '%".$request['search']['value']."%'";
			}
		}
		// print_r($where); die;
		// print_r($request['search']['value']); die;

		// add filters
		$isFilter = 'nofilter';
		if(!empty($request['q'])) {
			$isFilter = 'filter';
			$query = json_decode($request['q'],true);
			if($query) {
				$filter = $this->folder->getWhereField(array_keys($query),$folderType);
				// print_r($filter); die;
				foreach ($filter as $key => $value) {
					if (!empty($query[$key])) {
						$where.= ' and '.$value." like '%".$query[$key]."%'";
					}
				}
			}
		}

		$order = null;
		if(isset($request['order']) && is_array($request['order'])) {
			$order = $columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'];
		}
		//echo '<pre>'; print_r($order); die;
		$companyList = $this->folderModel->getFolders($fields,$where,$order,$limit,$offset,$isFilter);
		$companycount = $this->folderModel->getFolders('count(*) as count',$where);

		$data['recordsFiltered'] = $companycount[0]['count']; 
		$data['recordsTotal'] = $companycount[0]['count']; 
		$data['data'] = $companyList;
		echo json_encode($data);
		// print_r($data['data']); die;
	} // end : getCompanies Action


    function result($folderType) {
        $where = null;
        $postData = $this->session->userdata('filterData');;
        $folder_type = $folderType;

        //if(!empty($postData)) {
            if(isset($postData['folder_name']) && !empty($postData['folder_name'])) {
                $where['folder_name'] = $postData['folder_name'];
                $data['folder_name'] = $postData['folder_name'];
            }
		
            if(isset($postData['project_name']) && !empty($postData['project_name'])) {
                $where['project_name'] = $postData['project_name']; 
                $data['project_name'] = $postData['project_name'];
            }
		
            $data['value']= json_encode($this->folderModel->getFolderList($where));
        
    }

	public function deleteFolder() { 
        $DeleteId = $this->input->post();
        $newUsrId = explode(',', $DeleteId['deleteThis']);
        $deleteUpdateData = array('activity_status' => 'inactive');
		$DeletedUser = $this->folderModel->deleteFolder($deleteUpdateData,$newUsrId);
        if ($DeletedUser) {
            $this->session->set_userdata('setMessage','deleted');
            return true;
        } else {
            return False;
        }
    }	

}
