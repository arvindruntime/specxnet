<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class files extends CI_Controller {

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
		$this->load->library(array('File_library' => 'files'));
		$this->load->library(array('Permissions_library' => 'permission'));
	}

	/**
	* index action of Company controller
	* @author Amit Singh <email id>
	* @param $folderType String type of folder (folders)
 	* @param
	*/
	public function index($folderType='files')
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
		$this->page->setFooterJs(base_url()."assets/custom/js/files.js");
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
		
		$page['config'] = $this->files->getConfig();
		$page['tabs'] = $this->files->getTabs();
		$page['newButton'] = $this->files->getNewButton();
		$page['action'] = $this->files->getAction();
		$page['actionButton'] = $this->files->getActionButton();
		$page['companyColumn'] = $this->files->getCompanyColumn($folderType);
		$page['checkedAction'] = $this->files->getCheckedAction();
		$page['module_name'] = $this->uri->segment(1);
		$page['module_type'] = $this->uri->segment(1);
		//$page['gridView'] = $this->companyMondel->getGrid('*',array('module_name' => $page['module_name']));
		$page['filter'] = $this->input->post('filter');
		// load layout
		$page['contain'] = $folderType;
		$page['folderType'] = $folderType;
		if($folderType=='folders')
		{
		$page['folderData'] = $this->folderModel->getFolders();
		}
		else
		{
		$page['folderData'] = $this->fileModel->getFiles();
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
	public function createFolders($folderId = null) {
		try{
			$post = $this->input->post();
			//print_r($post);exit;
			 
			//@author: Amit Singh
			//Validation on input start
			$this->load->library('form_validation');
	        $this->form_validation->set_rules('file_name', 'File Name', 'required');
	        $this->form_validation->set_rules('folder_name', 'Folder Name', 'required');
			$this->form_validation->set_rules('file_type', 'File Type', 'required');
	        if ($this->form_validation->run() == FALSE) {
	            $response['error'] = "<div class='alert-danger-2'>
	                    <strong>Alert !</strong><br/><br/>".
	                    validation_errors().
	                "</div>";
	        } else {
	        	date_default_timezone_set('Asia/Kolkata');
                $folder_data=array();
				$folder_data=explode("-",$post['folder_name']);
				$folderIds=$folder_data[0];
				$folderName=$folder_data[1];
				
				$user_id=$this->session->userdata('user_id');
				$config['upload_path'] = './upload/files_upload/';
		        $config['allowed_types'] = '*';
		       
		        $files = $_FILES; 
		        if(isset($files) && !empty($files) && $files['document']['name'] !='') {
			        for ($i=0;$i<count($files['document']['name']);$i++) {
			        	$new_name = $files['document']['name'][$i];
			        	$config['document'] = $new_name;
			        	$post['document'][] = $new_name;
			        	$this->load->library('upload', $config);

			        	$_FILES['document']['name']= $files['document']['name'][$i];
				        $_FILES['document']['type']= $files['document']['type'][$i];
				        $_FILES['document']['tmp_name']= $files['document']['tmp_name'][$i];
				        $_FILES['document']['error']= $files['document']['error'][$i];
				        $_FILES['document']['size']= $files['document']['size'][$i];

				        $this->upload->do_upload('document');
			        }
			    }
	        	$insertArray = array(
					'file_name' => $post['file_name'],
					'folder_id' => $folderIds,
					'folder_name' => $folderName,
					'file_type' => $post['file_type'],
					'document' => $post['document'][0],
					'activity_status' => 'Active',
				);
// print_r($insertArray);exit;
				if(!$folderId) {
					$whereFolder = array('file_name' => $post['file_name']);
					$checkFolder = $this->fileModel->isExistFile($whereFolder);
		        	// print_r($checkCompany['count']);
		        	if ($checkFolder['count'] != 0) {
		        		$response['error'] = "<div class='alert-danger-2'>
								                    <strong>Alert !</strong><br/><br/>
								                    File name already exists !
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
					$data['file_id'] = $this->fileModel->insertFile($insertArray);
					$this->session->set_userdata('setMessage','File Added Successfully');
				} else {
					$whereFolder = array('file_name' => $post['file_name']);
					$checkFolder = $this->fileModel->isExistFile($whereFolder);
		        	// print_r($checkCompany['count']);
		        	if ($checkFolder['count'] != 0 && $checkFolder['result'][0]['file_id'] != $folderId) {
		        		$response['error'] = "<div class='alert-danger-2'>
								                    <strong>Alert !</strong><br/><br/>
								                    Folder name already exists !
								                </div>";
						$response['code'] = 400;
						$response['message'] = 'exception in insertion';
						echo json_encode($response);
		        		exit;
		        	}
					$insertArray['modified_date'] = date('Y-m-d h:i:s');
					$where = array('file_id' => $folderId);
					$data['file_id'] = $this->fileModel->updateFile($insertArray,$where);
					$this->session->set_userdata('setMessage','File Updated Successfully');

				}
				
				$response['code'] = 200;
				$response['message'] = "<div class='alert alert-success'>
	                    <strong>Success!</strong> File Added Successfully.</div>";
				$response['data'] = $data['file_id'];
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
	public function displayForm($folderType = 'files',$id = null) {
		try {
			if ($id) {
				$Permission = $this->permission->checkUserPermission(4);
			} else {
				$Permission = $this->permission->checkUserPermission(3);
			}
			if ($Permission) {
				$select = 'folder_name,folder_id';
				$where = array('activity_status' => 'Active');
				$data['folders'] = $this->folderModel->getFolders($select,$where);
				$select = 'file_name,file_id';
				$data['folderType'] = $folderType;
				$data['value'] = array();
				$data['formheading'] = "Add ".ucfirst($folderType);
				if($id) {
					$select = '*';
					$where = 'file_id = "'.$id.'"';
					$data['value'] = $this->fileModel->getFiles($select,$where);
					print_r($data['value']);exit;
					if(is_array($data['value'])) {
						$data['value'] = $data['value'][0];
					}
					
					$data['formheading'] = "Edit ".ucfirst($folderType);
				}

				$data['folderId'] = $id;
	
				$html = $this->page->getPage('fileForm',$data,true);
				
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
	public function getFiles($folderType = 'files') {
		// get method request
		$request = $this->input->get();
		//print_r($request); die;
		$offset = $request['start'];
		$limit = $request['length'];
		$columnArray = $request['columns'];

		// get selected filed
		$fields = $columns = array_column($columnArray,'data');
		
		$fields = $this->files->getSelectField($columns,$folderType);
		
		// get where field
		$whereFeilds = $this->files->getWhereField($columns,$folderType);	
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
				$filter = $this->files->getWhereField(array_keys($query),$folderType);
				// print_r($filter); die;
				foreach ($filter as $key => $value) {
					if (!empty($query[$key])) {
						$where.= ' and '.$value." like '%".$query[$key]."%'";
					}
				}
			}
		}
		// print_r($where); die;
		//set order

		/*$wherepermissions = $this->permission->checkUserPermission(46);
		if ($wherepermissions) {
			$whereUserId = array('fk_user_id' => $this->session->userdata('user_id'));
			$selectPermission = '*';
			$userPermissionList = $this->userModel->getWhoseDataCanView($selectPermission, $whereUserId);
			if (isset($userPermissionList[0]['can_view_company']) && $userPermissionList[0]['can_view_company']!='') {
				$userArray = json_decode($userPermissionList[0]['can_view_company']);
				array_push($userArray, $this->session->userdata('user_id'));
				$users = implode(',', $userArray);
				//print_r($userPermissionList[0]['can_view_activity']);exit;
				$where.= ' and c1.created_by IN( '.$users.')';
			}

			//$where.= ' and lo.fk_sales_people_id = '.$this->session->userdata('user_id');
		}  else {
			$where.= ' and c1.created_by IN( '.$this->session->userdata('user_id').')';
		}*/

		$order = null;
		if(isset($request['order']) && is_array($request['order'])) {
			$order = $columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'];
		}
		//echo '<pre>'; print_r($order); die;
		// add if condtion for folder and files
		if($folderType=='folders')
		{
		$companyList = $this->folderModel->getFolders($fields,$where,$order,$limit,$offset,$isFilter);
		$companycount = $this->folderModel->getFolders('count(*) as count',$where);
		}
		else
		{
		$companyList = $this->fileModel->getFiles($fields,$where,$order,$limit,$offset,$isFilter);
		$companycount = $this->fileModel->getFiles('count(*) as count',$where);
		}

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
	/*public function getCompanyIdentifier($dialing_code) {
		$where = array('t2.phonecode' => $dialing_code, 'status' => 'active');
		$companyIdentifierList['list'] = $this->companyMondel->getCompanyIdentifier($where);
		$getIdentifierList = $this->load->view('form/getComapnyIdentifier', $companyIdentifierList);
		return $getIdentifierList;
	} // end : getCompanyIdentifier Action*/

	/**
    * This is import a company detail.
    * @author Sagar Kodalkar
    * @return excel object
    */
    /*public function importData(){
        $ExcelHeader = array('Company Name', 'Parent Company', 'Business Contact', 'Street Address', 'City', 'State', 'Country', 'Zip');

        try {
            $this->load->library('Excel','excel');

            $config['upload_path']          = APPPATH.'../upload/';
            $config['allowed_types']        = 'xlsx|csv|xls';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('file'))
            {
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

            if(!$this->excel->validateFileType($file)) {
                $responceMsg = array(
                    'code' => 418,
                    'message' => $this->excel->getResponseMessage()
                );
                echo json_encode($responceMsg);
                die;
            }

            if(!$this->excel->loadExcel($file)) {   
                $responceMsg = array(
                    'code' => 418,
                    'message' => $this->excel->getResponseMessage()
                );
                echo json_encode($responceMsg);
                die;
            }
            
            if(!$this->excel->importExcel($ExcelHeader)) {
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
		                'message' => "<b style='color:red'>Invalid Excel! You can not upload company data with this excel<br/> For ideal format please <a href=".base_url()."upload/sampleCompany.xls>Click Here</a></b>"
		            );
		            echo json_encode($responceMsg);
            		return false;
            	}
            }
            $header =  $data['column'] ?? array();
            $rows =  $data['rows'] ?? array();

            if(empty($header) || empty($rows)) {
                $responceMsg = array(
                    'code' => 418,
                    'message' => 'data is empty'
                );
                echo json_encode($responceMsg);
                die;
            }

            foreach ($rows as $key => $value) {
                $ParentCompanyId   = 0;
                if(isset($value['parent_company']) && !empty($value['parent_company'])) {
                    $parentCompanyDetail = $this->company_model->getParentCompanyByName($value['parent_company']);
                    if(!empty($parentCompanyDetail)){
                        $ParentCompanyId = $parentCompanyDetail[0]['company_id'];
                    }
                }
                $fax='';
                if(isset($value['fax']) && !empty($value['fax'])) {
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
				);

                $importExcelData = $this->companyMondel->insertCompany($insertArray);
            	$this->session->set_userdata('setMessage','Imported');
            }
            $responceMsg = array(
                'code' => 200,
                'message' => "<b style='color:green'>Company Data Imported Successfully</b>"
            );
            unlink($file);
            echo json_encode($responceMsg);
            
        } catch(Exception $e) {
            $responceMsg = array(
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            );
            echo json_encode($responceMsg);
            die;
        }
        
    }// end : importData function */

    /**
    * This is export a company detail.
    * @author Sagar Kodalkar
    * @return excel object
    */
    /*public function createExcel($companyType = null, $list='') {
    	$filename = ucfirst($companyType)."-Companies-".str_replace('-', '', date('d-M-Y'));
    	header('Content-Disposition: attachment; filename="'.$filename.'.csv";');
    	header('Content-Type: application/csv');

        $columnArray = $this->company->getCompanyColumn();
        unset($columnArray[0]);
        //print_r($columnArray);exit;
        $fields = $columns = array_column($columnArray,'data');
        // print_r($fields);
        //foreach ($fields as $key => $value) {
        	// echo $value;
        	//$title[]=str_replace('_', ' ', $value);
        	# code...
        //}
        $companyIdList = '';
    	if ($list != '') {
        	$list = str_replace('%20', '', $list);
        	$companyIdList = explode('_', $list);
        }
        $title =  array_column($columnArray,'data');
		$fields = $this->company->getSelectField($columns);
		// get where field
		$whereFeilds = $this->company->getWhereField($columns);		
		
		if($companyType) {
			$where = 'c1.company_type = "'.self::COMPANY_ARRAY[$companyType].'" and c1.activity_status = "active"';
		}

		$companyList = $this->companyMondel->getCompanyExcel($fields,$where,$companyIdList);
		// print_r($companyList);exit();

		$f = fopen("php://output", "w");
		// unset($title[0]);
		fputcsv($f, $title);
		foreach ($companyList as $company) {
    		fputcsv($f, $company);
		}
		fpassthru($f);   
    }*/

    function result($folderType) {
        $where = null;
        $postData = $this->session->userdata('filterData');;
        $folder_type = $folderType;

        //if(!empty($postData)) {
            if(isset($postData['folder_name']) && !empty($postData['folder_name'])) {
                $where['t1.folder_name'] = $postData['folder_name'];
                $data['folder_name'] = $postData['folder_name'];
            }
		
            if(isset($postData['project_name']) && !empty($postData['project_name'])) {
                $where['t1.project_name'] = $postData['project_name']; 
                $data['project_name'] = $postData['project_name'];
            }
		
            $data['value']= json_encode($this->folderModel->getFolderList($where));

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

    /*public function createGrid($gridId = null) {
		try{
			$data = [];
			$data['options'] = array();
			$data['columns'] = array();
			$module_name = $this->uri->segment(1);
			$selectedColumns = $this->input->post();
			// var_dump($selectedColumns); die;
			$column = $arrayField = $this->company->getCompanyColumn();
			$data['columns'] = $column; 
			if(!empty($selectedColumns)) {
				$arrayField = array();
				array_push($arrayField, $column[0]);
				foreach ($selectedColumns['internal'] as $key => $value) {
					array_push($arrayField, $column[$value]);
				}
			} else if($gridId) {
				$grid_columns = $this->companyMondel->getGrid('grid_columns',array('grid_id' => $gridId));
				if(!empty($grid_columns)) {
					$arrayField = json_decode($grid_columns[0]['grid_columns']);
				}
			}

			if(isset($selectedColumns['ischeck'])) {
	            $columns['grid_columns'] = json_encode($arrayField);
	            $columns['grid_name'] = $selectedColumns['saveGrid'];
	            $columns['module_name'] = $module_name;
	            $this->companyMondel->insertGrid($columns);
	        }
	        $data['columns'] = $arrayField;
	        $data['options'] = $this->companyMondel->getGrid('*',array('module_name' => $module_name));
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
	} // end : createGrid Action*/

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

    
    

		// */	

}
