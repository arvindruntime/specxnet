<?php 

/**
* This libarray is created for setting a company libarary.
* @author Bimal Sharma <sharma.bimal226@gmail.com>
*/

class Lead_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView','DownloadTable','Freez'];
	protected $newButton = array(
            'name' => 'Lead Inquiry',
            'link' => 'lead',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'lead/form'
       
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
		array('data' => 'opportunity_title','title' => 'Opportunity Type'),
		array('data' => 'created_date','title' => 'Created Date'),
		array('data' => 'contact_info','title' => 'Client Name'),
		array('data' => 'company_name','title' => 'Company Name'),
		array('data' => 'status','title' => 'Status'),
		array('data' => 'age','title' => 'Age'),
		array('data' => 'confidence','title' => 'Conversion Probability'),
		// array('data' => 'est_revenue_from','title' => '$ Est Revenue Min'),
		// array('data' => 'est_revenue_to','title' => '$ Est Revenue Max'),
		// array('data' => 'sales_people','title' => 'Sales People'),
		array('data' => 'source','title' => 'Source'),
		array('data' => 'activity_date','title' => 'Last Contacted')

	);

	protected $mapper = array(
		'lead_opportunity_id' => 'lead_opportunity_id',
		'opportunity_title' => 'opportunity_title',
		'created_date' => 'lo.created_date',
		'contact_info' => 'u.full_name',
		'company_name' => 'c.company_name',
		'contact_info2' => 'u.last_name',
		'status' => 'lo.status',
		'age' => "lo.age",
		'projected_sales_date' => "lo.projected_sales_date",
		'confidence' => "CONCAT(confidence,'%')",
		'created_date' => 'lo.created_date',
		// 'est_revenue_from' => 'est_revenue_from',
		// 'est_revenue_to' => 'est_revenue_to',
		'fk_sales_people_id' => "fk_sales_people_id",
		'source' => "source",
		'activity_date' => 'la.updated_date'
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