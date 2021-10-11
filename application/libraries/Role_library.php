<?php 

/**
* This libarray is created for setting a company libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class Role_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView','DownloadTable','Freez'];
	protected $newButton = array(
            'name' => 'Role Management',
            'link' => 'Role',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'role/form'
       
	);
	protected $action = ['delete'];
	protected $config = ['new','filter','action','actionButton','tabs'];
	protected $actionButton = array(
		0 => array(
			'name' => 'Internal Users',
            'link' => 'user/internal',
		),
		1 => array(
			'name' => 'Suppliers',
            'link' => 'user/supplier',
		),
		2 => array(
			'name' => 'Customer Contact',
            'link' => 'user/customer',
		),
	);
	protected $opportunityCoulmn = array(
		array('data' => 'role_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),
		array('data' => 'role_name','title' => 'Role Name'),
		array('data' => 'role_description','title' => 'Role Description'),
		array('data' => 'created_date','title' => 'Created'),
			);

	protected $mapper = array(
		'role_id' => 'role_id',
		'role_name' => 'role_name',
		'role_description' => 'role_description',
		'created_date' => 'lo.created_date',
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

	public function getAction() {
		return $this->action;
	}

	public function getActionButton() {
		return $this->actionButton;
	}

	public function getOpportunityCoulmn() {
		return $this->opportunityCoulmn;
	}

	public function getSelectField($field) {
		$fieldName = array();
		foreach ($field as $key => $value) {
			if(isset($this->mapper[$value])) {
				$fieldName[] = $this->mapper[$value].' as '.$value;	
			}
			
		}
		return $fieldName;
	}

	public function getWhereField($field) {
		$fieldName = array();
		foreach ($field as $key => $value) {
			if(isset($this->mapper[$value])) {
				$fieldName[$value] = $this->mapper[$value];	
			}
		}
		return $fieldName;
	}

} 