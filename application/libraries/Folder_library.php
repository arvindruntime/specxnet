<?php 

/**
* This libarray is created for setting a folder libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class Folder_library {

	// creating a variable
	// this is my folder library
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView'];
	protected $newButton = array(
        0 => array (
            'name' => 'Folders',
            'link' => 'folders/folders',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'folders/form/folders'
        ),
        1 => array (
            'name' => 'Files',
            'link' => 'folders/files',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'folders/form/files'
        )
	);

	protected $checkedActionButton = array(
        0 => array (
            'name' => 'Delete',
            'link' => 'folders/deleteFolder',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'folders/checkedActionDelete'
        )
	);
	protected $action = ['delete'];
	protected $config = ['new','filter','action','actionButton','tabs'];
	protected $actionButton = array(
		0 => array(
			'name' => 'Folders',
            'link' => 'folders/folders',
		),
		1 => array(
			'name' => 'Files',
            'link' => 'folders/files',
		),
	);
	protected $companyColumn = array(
		'folders' => array(
			array('data' => 'folder_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll" class="checkbox-action">', 'visible' => 'true'),
			array('data' => 'folder_name','title' => 'Folder Name', 'visible' => 'true'),
			array('data' => 'project_name','title' => 'Project Name', 'visible' => 'true'),
			array('data' => 'created_date','title' => 'Uploaded On', 'visible' => 'true'),
		),
		'files' => array(
			array('data' => 'file_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll" class="checkbox-action">', 'visible' => 'true'),
			array('data' => 'file_name','title' => 'File Name', 'visible' => 'true'),
			array('data' => 'project_name','title' => 'Project Name', 'visible' => 'true'),
			array('data' => 'file_type','title' => 'Type', 'visible' => 'true'),
			array('data' => 'document','title' => 'Project Name', 'visible' => 'true'),
			array('data' => 'created_date','title' => 'Uploaded On', 'visible' => 'true'),
		)
		
		//array('data' => 'country','title' => 'Country', 'visible' => 'true')
	);

	protected $mapper = array(
		'folders' => array(
			'folder_id' => 'folder_id',
			'folder_name' => 'folder_name',
			'project_name' => 'project_name',
			'created_date' => 'created_date',
		),
		'files' => array(
			'file_id' => 'file_id',
			'file_name' => 'file_name',
			'project_name' => 'project_name',
			'file_type' => 'file_type',
			'document' => 'document',
			'created_date' => 'created_date',
		),
		
	);


	public function __construct() {
		$this->ci = & get_instance();	
	}

	public function getConfig() {
		return $this->config;
	}

	public function getTabs() {
		return $this->tabs;
	}

	public function getNewButton() {
		return $this->newButton;
	}

	public function getCheckedAction() {
		return $this->checkedActionButton;
	}

	public function getAction() {
		return $this->action;
	}

	public function getActionButton() {
		return $this->actionButton;
	}

	public function getCompanyColumn($type) {
		return $this->companyColumn[$type];
	}

	public function getSelectField($field,$type) {
		$fieldName = array();
		foreach ($field as $key => $value) {
			if(isset($this->mapper[$type][$value])) {
				$fieldName[] = $this->mapper[$type][$value].' as '.$value;	
			}
			
		} 
		return $fieldName;
	}

	public function getWhereField($field,$type) {
		$fieldName = array();
		foreach ($field as $key => $value) {
			if(isset($this->mapper[$type][$value])) {
				$fieldName[$value] = $this->mapper[$type][$value];	
			}
		}
		// print_r($fieldName); die;
		
		return $fieldName;
	}
} 