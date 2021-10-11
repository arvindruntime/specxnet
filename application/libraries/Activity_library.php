<?php 



/**

* This libarray is created for setting a company libarary.

* @author Bimal Sharma <sharma.bimal226@gmail.com>

*/



class Activity_library {



	// creating a variable

	protected $ci;

	protected $modelName = '';

	protected $tabs = ['GridView','DownloadTable','Freez'];

	protected $newButton = array(

        

            'name' => 'Lead Activity',

            'link' => 'activity',

            'children' => null,

            'allowAdd' => true,

            'isModel' => '#modal',

            'modelUrl' => 'activity/form'

       

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

	protected $activityCoulmn = array(

		array('data' => 'lead_activity_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),

		array('data' => 'opportunity_title','title' => 'Opportunity Title'),
		array('data' => 'activity_title','title' => 'Activity Title'),

		array('data' => 'activity_status','title' => 'Status'),

		array('data' => 'activity_type','title' => 'Type'),

		array('data' => 'first_name','title' => 'Assigned User'),

		array('data' => 'activity_date','title' => 'Contact Date'),

		// array('data' => 'description','title' => 'Activity Notes'),

		array('data' => 'email','title' => 'email'),

		array('data' => 'phone','title' => 'phone')

	);



	protected $mapper = array(

		'lead_activity_id' => 'lead_activity_id',

		'activity_status' => 't1.activity_status',

		'role' => 'fk_role_id',

		'activity_type' => 'activity_type',

		'opportunity_title' => 'opportunity_title',
		'activity_title' => 'activity_title',

		//'first_name' => "CONCAT(u1.first_name,' ',u1.last_name)",

		'first_name' => "u2.full_name",

		'activity_date' => 'activity_date',

		'description' => 'description',

		'fk_lead_opportunity_id' => 'fk_lead_opportunity_id',

		'email' => 'contact_info',

		// 'phone' => 'contact_info',

		'status' => 't1.status',

		'assigned_by' => 't1.assigned_by'

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



	public function getActivityCoulmn() {

		return $this->activityCoulmn;

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