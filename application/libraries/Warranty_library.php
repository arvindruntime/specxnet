<?php 

/**
* This libarray is created for setting a company libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class Warranty_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView','Freez'];
	protected $newButton = array(
        0 => array (
            'name' => 'Warranty',
            'link' => 'warranty',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'warranty/form'
        ),
        // 1 => array (
        //     'name' => 'Suppliers',
        //     'link' => 'company/supplier',
        //     'children' => null,
        //     'allowAdd' => true,
        //     'isModel' => '#modal',
        //     'modelUrl' => 'company/form/supplier'
        // ),
        // 2 => array (
        //     'name' => 'Customer',
        //     'link' => 'company/customer',
        //     'children' => null,
        //     'allowAdd' => true,
        //     'isModel' => '#modal',
        //     'modelUrl' => 'company/form/customer'
        // )
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
		// 0 => array(
		// 	'name' => 'Internal',
        //     'link' => 'company/internal',
		// ),
		// 1 => array(
		// 	'name' => 'Suppliers',
        //     'link' => 'company/supplier',
		// ),
		// 2 => array(
		// 	'name' => 'Customer Contact',
        //     'link' => 'company/customer',
		// ),
	);
	protected $companyColumn = array(
		array('data' => 'id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll" class="checkbox-action">', 'visible' => 'true'),
		array('data' => 'claim','title' => 'Claim', 'visible' => 'true'),
		array('data' => 'title','title' => 'Title', 'visible' => 'true'),
		array('data' => 'priority','title' => 'Priority', 'visible' => 'true'),
		array('data' => 'description_of_problem','title' => 'Description Of Problem', 'visible' => 'true'),
		array('data' => 'internal_note','title' => 'Internal Note', 'visible' => 'true')
	);

	protected $mapper = array(
		'id' => 'id',
		'claim' => 'claim',
		'title' => 'title',
		'priority' => 'priority',
		'description_of_problem' => 'description_of_problem',
		'internal_note' => 'internal_note'
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