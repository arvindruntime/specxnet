<?php 

/**
* This libarray is created for Proposal module.
* @author Bimal Sharma
*/

class Todo_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';

	protected $config = ['new','filter','action','actionButton','tabs'];
	protected $tabs = ['GridView','UploadTable','DownloadTable','Freez'];
	protected $newButton = array(
        0 => array (
            'name' => 'todo',
            'link' => 'todo',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'todo/form'
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
	);
	
	protected $checkedActionButton = array();

	protected $column = array(
		array('data' => 'todo','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),
		array('data' => 'note','title' => 'Note'),
		array('data' => 'is_completed','title' => 'Complete'),
		array('data' => 'start_date_time','title' => 'Start Date Time'),
	);

	protected $mapper = array(
		'todo' => 'id',
		'note' => 'note',
		'is_completed' => 'is_completed',
		'start_date_time' => 'start_date_time',
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

	public function getColumn() {
		return $this->column;
	}

	public function getCheckedAction() {
		return $this->checkedActionButton;
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