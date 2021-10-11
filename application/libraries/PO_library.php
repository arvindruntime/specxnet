<?php 



/**

* This libarray is created for Proposal module.

* @author Sagar Kodalkar

*/



class PO_library {



	// creating a variable

	protected $ci;

	protected $modelName = '';

	protected $tabs = ['GridView','UploadTable','DownloadTable','Freez'];



	protected $checkedActionButton = array(

        0 => array (

            'name' => 'Delete',

            'link' => 'purchase_order/deleteComapany',

            'children' => null,

            'allowAdd' => true,

            'isModel' => '#modal',

            'modelUrl' => 'purchase_order/checkedActionDelete'

        ),

        1 => array (

            'name' => 'Send Email',

            'link' => 'purchase_order/sendBulkEmail',

            'children' => null,

            'allowAdd' => true,

            'isModel' => '#modal',

            'modelUrl' => 'purchase_order/checkedActionSendEmail'

        )

	);

	protected $action = ['delete'];

	protected $config = ['new','filter','action','actionButton','tabs'];



	protected $POColumn = array(

		array('data' => 'p_id','title' => '<input name="select_all" type="checkbox" id="ckbCheckAll">'),

		// array('data' => 'status','title' => 'Proposal Status'),

		array('data' => 'title','title' => 'PO Title'),
		array('data' => 'po_no','title' => 'PO No.'),

		array('data' => 'opportunity_title','title' => 'Opportunity Title'),

		array('data' => 'sales_people','title' => 'Sales Person'),

		array('data' => 'created_date','title' => 'PO date'),

		// array('data' => 'total_price_ex_factory','title' => 'Total Price(Ex-Factory)'),

		// array('data' => 'total_price_fabric','title' => 'Total Price(Fabrics)'),

		// array('data' => 'total_price_leather','title' => 'Total Price(Leather)'),

		array('data' => 'total_fob','title' => 'Total price(FOB)'),

		array('data' => 'total_cif','title' => 'Total Price(CIF)'),

		

	);



	protected $mapper = array(

		'p_id' => 'p_id',

		'title' => 'title',

		'opportunity_title' => 'opportunity_title',

		'customer_contact' => 'customer_contact',

		'sales_person' => 'sales_person',

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



	public function getProposalColumn() {

		return $this->POColumn;

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