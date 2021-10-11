<?php 



/**

* This libarray is created for setting a company libarary.

* @author Bimal Sharma <sharma.bimal226@gmail.com>

*/



class Schedule_library {



	// creating a variable

	protected $ci;

	protected $modelName = '';



	protected $config = ['new','filter','action','actionButton','tabs'];

	protected $tabs = ['GridView','UploadTable','DownloadTable','Freez'];

	protected $newButton = array(

        0 => array (

            'name' => 'schedule',

            'link' => 'shedule/internal',

            'children' => null,

            'allowAdd' => true,

            'isModel' => '#modal',

            'modelUrl' => 'schedule/form'

        )

	);

	protected $action = [];

	protected $actionButton = array(

		0 => array(

			'name' => 'month',

            'link' => 'schedule/month',

		),

		1 => array(

			'name' => 'week',

            'link' => 'schedule/week',

		),

		2 => array(

			'name' => 'day',

            'link' => 'schedule/day',

		),

		3 => array(

			'name' => 'agenda',

            'link' => 'schedule/agenda',

		),

		4 => array(

			'name' => 'list',

            'link' => 'schedule/list',

		),

		5 => array(

			'name' => 'Gantt Chart',

            'link' => 'schedule/gantt-chart',

		),

	);

	protected $column = array(

		'list' => array(

			array('data' => 'title','title' => 'Title', 'visible' => 'true'),

			array('data' => 'status','title' => 'Status', 'visible' => 'true'),

			//array('data' => 'phase','title' => 'Phase', 'visible' => 'true'),

			//array('data' => 'duration','title' => 'Duration', 'visible' => 'true'),

			array('data' => 'start','title' => 'Start', 'visible' => 'true'),

			array('data' => 'finish','title' => 'Finish', 'visible' => 'true'),

			array('data' => 'assigned_to','title' => 'Assigned To', 'visible' => 'true')

		),

		'agenda' => array(

			array('data' => 'start_date','title' => 'Date', 'visible' => 'true'),

			array('data' => 'reminder','title' => 'Task Update', 'visible' => 'true'),

			array('data' => 'assigned_to','title' => 'Assigned', 'visible' => 'true')

		),

	);

	protected $checkedActionButton = array();



	protected $mapper = array(

		'list' => array(

			'title' => 's.title',

			'status' => 's.status',

			//'duration' => 's.duration',

			'start' => 's.start_date',

			'finish' => 's.end_date',

			'assigned_to' => 'u.full_name'

		),

		'agenda' => array(

			'start_date' => 's.start_date',

			'reminder' => 's.start_date',

			'assigned_to' => 'u.full_name',

		)

	);





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



	public function getColumn($scheduleType) {

		return $this->column[$scheduleType]??array();

	}



	public function getCheckedAction() {

		return $this->checkedActionButton;

	}



	public function getSelectField($field,$keyMapper) {

		$fieldName = array();

		foreach ($field as $key => $value) {	

			if(isset($this->mapper[$keyMapper][$value])) {

				$fieldName[] = $this->mapper[$keyMapper][$value].' as '.$value;	

			}

			

		} 

		return $fieldName;

	}



	public function getWhereField($field,$keyMapper) {

		$fieldName = array();

		foreach ($field as $key => $value) {

			if(isset($this->mapper[$keyMapper][$value])) {

				$fieldName[$value] = $this->mapper[$keyMapper][$value];	

			}

		}

		// print_r($fieldName); die;

		

		return $fieldName;

	}

} 