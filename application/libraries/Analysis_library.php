<?php 

/**
* This libarray is created for Rfq module.
* @author Sagar Kodalkar
*/

class Analysis_library {

	// creating a variable
	protected $ci;
	protected $modelName = '';
	protected $tabs = ['GridView','DownloadTable','Freez'];

	protected $checkedActionButton = array(
        0 => array (
            'name' => 'Delete',
            'link' => 'rfq/deleteComapany',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'rfq/checkedActionDelete'
        ),
        1 => array (
            'name' => 'Send Email',
            'link' => 'rfq/sendBulkEmail',
            'children' => null,
            'allowAdd' => true,
            'isModel' => '#modal',
            'modelUrl' => 'rfq/checkedActionSendEmail'
        )
	);
	protected $action = ['delete'];
	protected $config = ['new','filter','action','actionButton','tabs'];

	protected $rfqColumn = array(
		array('data' => 'b_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),
		array('data' => 'b_id','title' => 'RFQ Action'),
		array('data' => 'title','title' => 'RFQ Title'),
		array('data' => 'status','title' => 'RFQ Status'),
		// array('data' => 'count(title)','title' => 'Application'),
		array('data' => 'opportunity_title','title' => 'Opportunity Title'),
		array('data' => 'approval_deadline','title' => 'Approval Deadline'),
		// array('data' => 'total_price_ex_factory','title' => 'Total Price(Ex-Factory)'),
		// array('data' => 'total_price_fabric','title' => 'Total Price(Fabrics)'),
		// array('data' => 'total_price_leather','title' => 'Total Price(Leather)'),
		
	);

	protected $mapper = array(
		'b_id' => 'b_id',
		'title' => 'title',
		'opportunity_title' => 'opportunity_title',
		'customer_contact' => 'customer_contact',
		// 'sales_person' => 'sales_person',
		'owner_price' => 'owner_price',
		'status' => 'status',
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

	public function getCheckedAction() {
		return $this->checkedActionButton;
	}

	public function getAction() {
		return $this->action;
	}

	public function getRfqColumn() {
		return $this->rfqColumn;
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

} 