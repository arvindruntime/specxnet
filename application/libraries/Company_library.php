<?php 

/**
* This libarray is created for setting a company libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class Company_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView','UploadTable','DownloadTable','Freez'];
	protected $newButton = array(
        0 => array (
            'name' => 'Internal',
            'link' => 'company/internal',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'company/form/internal'
        ),
        1 => array (
            'name' => 'Suppliers',
            'link' => 'company/supplier',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'company/form/supplier'
        ),
        2 => array (
            'name' => 'Customer',
            'link' => 'company/customer',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'company/form/customer'
        )
	);

	protected $checkedActionButton = array(
        0 => array (
            'name' => 'Delete',
            'link' => 'company/deleteComapany',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'company/checkedActionDelete'
        ),
        1 => array (
            'name' => 'Send Email',
            'link' => 'company/sendBulkEmail',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'company/checkedActionSendEmail'
        )
	);
	protected $action = ['delete'];
	protected $config = ['new','filter','action','actionButton','tabs'];
	protected $actionButton = array(
		0 => array(
			'name' => 'Internal',
            'link' => 'company/internal',
		),
		1 => array(
			'name' => 'Suppliers',
            'link' => 'company/supplier',
		),
		2 => array(
			'name' => 'Customer Contact',
            'link' => 'company/customer',
		),
	);
	protected $companyColumn = array(
		array('data' => 'company_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll" class="checkbox-action">', 'visible' => 'true'),
		array('data' => 'company_name','title' => 'Company Name', 'visible' => 'true'),
		array('data' => 'parent_company_name','title' => 'Parent Company', 'visible' => 'true'),
		array('data' => 'bussiness_contact','title' => 'Business Contact', 'visible' => 'true'),
		array('data' => 'street_address','title' => 'Street Address', 'visible' => 'true'),
		array('data' => 'city','title' => 'City', 'visible' => 'true'),
		array('data' => 'state','title' => 'State', 'visible' => 'true'),
		array('data' => 'country','title' => 'Country', 'visible' => 'true')
	);

	protected $mapper = array(
		'company_id' => 'c1.company_id',
		'company_name' => 'c1.company_name',
		'parent_company_name' => 'IF(`c2`.`company_name` is null , "N/A", `c2`.`company_name`)',
		'parent_company' => 'c2.company_id',
		'bussiness_contact' => 'c1.bussiness_contact',
		'street_address' => 'c1.street_address',
		'city' => 'c1.city',
		'state' => 'c1.state',
		'country' => 'c1.country',
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

	public function getCompanyColumn() {
		return $this->companyColumn;
	}

	public function getSelectField($field) {
		$fieldName = array();
		// print_r($fieldName); die;
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