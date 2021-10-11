<?php 

/**
* This libarray is created for setting a company libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class leadOpportunity_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView','UploadTable','DownloadTable','Freez'];
	protected $newButton = array(
            'name' => 'Lead Opportunity',
            'link' => 'leadOpportunity',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'leadOpp/form'
       
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
		array('data' => 'lead_opportunity_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),
		array('data' => 'opportunity_title','title' => 'Opportunity Title'),
		array('data' => 'created_date','title' => 'Created'),
		array('data' => 'contact_info','title' => 'Contact'),
		array('data' => 'status','title' => 'Status'),
		array('data' => 'created_date','title' => 'Age'),
		array('data' => 'Confidence','title' => 'Confidence'),
		array('data' => 'est_revenue_from','title' => '$ Estimate R'),
		array('data' => 'est_revenue_to','title' => '$ Estimate R'),
		array('data' => 'activity_date','title' => 'Last Contacted')

	);

	protected $mapper = array(
		'lead_opportunity_id' => 'lead_opportunity_id',
		'opportunity_title' => 'opportunity_title',
		'created_date' => 'lo.created_date',
		'contact_info' => 'contact_info',
		'status' => 'status',
		'created_date' => 'created_date',
		'Confidence' => 'Confidence',
		'est_revenue_from' => 'est_revenue_from',
		'est_revenue_to' => 'est_revenue_to',
		'activity_date' => 'activity_date'
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