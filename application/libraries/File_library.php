<?php 

/**
* This libarray is created for setting a folder libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class File_library {

	// creating a variable
	// this is my folder library
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView'];
	protected $newButton = array(
        0 => array (
            'name' => 'Files',
            'link' => 'files/files',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'files/form/files'
        )
	);

	protected $checkedActionButton = array(
        0 => array (
            'name' => 'Delete',
            'link' => 'files/deleteFolder',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'files/checkedActionDelete'
        )
	);
	protected $action = ['delete'];
	protected $config = ['new','filter','action','actionButton','tabs'];
	protected $actionButton = array(
		0 => array(
			'name' => 'Files',
            'link' => 'files/files',
		)
	);
	protected $companyColumn = array(
		'files' => array(
			array('data' => 'file_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll" class="checkbox-action">', 'visible' => 'true'),
			array('data' => 'file_name','title' => 'File Name', 'visible' => 'true'),
			array('data' => 'folder_name','title' => 'Folder Name', 'visible' => 'true'),
			array('data' => 'file_type','title' => 'Type', 'visible' => 'true'),
			array('data' => 'document','title' => 'Document', 'visible' => 'true'),
			array('data' => 'created_date','title' => 'Uploaded On', 'visible' => 'true'),
		)
		
		//array('data' => 'country','title' => 'Country', 'visible' => 'true')
	);

	protected $mapper = array(
		'files' => array(
			'file_id' => 'file_id',
			'file_name' => 'file_name',
			'folder_name' => 'folder_name',
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