<?php 

/**
* This libarray is created for setting a company libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class User_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView','DownloadTable','Freez'];
	protected $tabs2 = ['GridView','UploadTable','DownloadTable','Freez'];
	protected $newButton = array(
        0 => array (
            'name' => 'Internal Users',
            'link' => 'user/internal',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'user/form/internal'
        ),
        1 => array (
            'name' => 'Suppliers',
            'link' => 'user/supplier',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'user/form/supplier'
        ),
        2 => array (
            'name' => 'Customer Contact',
            'link' => 'user/customer',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'user/form/customer'
        )
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
	protected $userCoulmn = array(
		array('data' => 'user','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),
		array('data' => 'full_name','title' => 'Name'),
		array('data' => 'role','title' => 'Role'),
		array('data' => 'admin_access','title' => 'Admin Access'),
		array('data' => 'loginEnabled','title' => 'Login Enabled'),
		array('data' => 'actoAccess','title' => 'Auto Access'),
		array('data' => 'email','title' => 'Email'),
		array('data' => 'phone','title' => 'Phone'),
		array('data' => 'active_status','title' => 'Status'),
	);

	protected $userCoulmn2 = array(
		array('data' => 'user','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),
		array('data' => 'full_name','title' => 'Name'),
		//array('data' => 'role','title' => 'Role'),
		array('data' => 'street_address','title' => 'Street Address'),
		array('data' => 'city','title' => 'City'),
		array('data' => 'state','title' => 'State'),
		array('data' => 'email','title' => 'Email'),
		array('data' => 'phone','title' => 'Phone'),
		array('data' => 'lcount','title' => 'Lead Opportunity'),
		array('data' => 'active_status','title' => 'Status'),
	);

	protected $userCoulmn3 = array(
		array('data' => 'user','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),
		array('data' => 'full_name','title' => 'Name'),
		//array('data' => 'role','title' => 'Role'),
		array('data' => 'street_address','title' => 'Street Address'),
		array('data' => 'city','title' => 'City'),
		array('data' => 'state','title' => 'State'),
		array('data' => 'email','title' => 'Email'),
		array('data' => 'phone','title' => 'Phone'),
		array('data' => 'active_status','title' => 'Status'),
	);

	protected $mapper = array(
		'user' => 'user_id',
		'first_name' => 'first_name',
		'last_name' => 'last_name',
		'full_name' => 'full_name',
		'designation' => 'designation',
		'role' => 'role_name',
		'admin_access' => 'u.admin_access',
		'loginEnabled' => 'u.user_invited',
		'actoAccess' => 'fk_rpn_id',
		'email' => 'contact_info',
		'phone' => 'contact_info',
		'roleId' => 'role_id',
		'userStatus' => 'u.active_status'

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

	public function getTabs2() {
		return $this->tabs2;
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

	public function getUserCoulmn() {
		return $this->userCoulmn;
	}

	public function getUserCoulmn2() {
		return $this->userCoulmn2;
	}

	public function getUserCoulmn3() {
		return $this->userCoulmn3;
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
		// print_r($fieldName); die;
		return $fieldName;
	}

} 