<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Todo extends CI_Controller {



    /**

     * Scheduling Controller.

     *

     * Maps to the following URL

     *      http://DomainName/login

     *

     * @author Bimal Sharma

     */



    public function __construct() {

        parent::__construct();

        $this->load->model(array('Todo_model' => 'TodoModel'));

        $this->load->model(array('Scheduling_model' => 'SchedulingModel'));

        $this->load->library(array('Todo_library' => 'Todo'));

    }



    /**

    * index action of Login controller

    * @author Bimal Sharma

    * @param

    */

    public function index() {

        // set title

        $this->page->setTitle('Schedule');

        

        // set head style

        $this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");

        $this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");
		
		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style-2.css");

        $this->page->setHeadStyle(base_url()."assets/custom/css/style.css");

        $this->page->setHeadStyle(base_url()."assets/custom/css/editor.css");

        $this->page->setHeadStyle("//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css");

        $this->page->setHeadStyle("//cdn.datatables.net/fixedcolumns/3.2.6/css/fixedColumns.dataTables.min.css");

        $this->page->setHeadStyle(base_url()."assets/custom/css/jquery.dataTables.min.css");

        $this->page->setHeadStyle("//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css");

        $this->page->setHeadStyle("//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css");



        // //set footer js

        $this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

        $this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

        $this->page->setFooterJs(base_url()."assets/vendors/base/vendors.bundle.js");

        $this->page->setFooterJs(base_url()."assets/demo/default/base/scripts.bundle.js");

        $this->page->setFooterJs("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js");

        $this->page->setFooterJs("//cdn.datatables.net/fixedcolumns/3.2.6/js/dataTables.fixedColumns.min.js");

        $this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js");

        $this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js");



        $this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");

        $this->page->setFooterJs(base_url()."assets/custom/js/custom.js");

        $this->page->setFooterJs(base_url()."assets/custom/js/todo.js");

        $this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");

        $this->page->setFooterJs(base_url()."assets/custom/js/jquery.dataTables.min.js");





        $page['config'] = $this->Todo->getConfig();

        $page['tabs'] = $this->Todo->getTabs();

        $page['newButton'] = $this->Todo->getNewButton();

        $page['action'] = $this->Todo->getAction();

        $page['actionButton'] = $this->Todo->getActionButton();

        $page['tableColumn'] = $this->Todo->getColumn();

        $page['checkedAction'] = $this->Todo->getCheckedAction();

        $page['module_name'] = "todo";

        $page['contain'] = 'todo';

        $page['module_type'] = 'list';

        $page['gridView'] = array();//$this->companyMondel->getGrid('*',array('module_name' => $page['module_name']));

        $page['filter'] = array();





        $this->page->getLayout($page);

    }



    /**

     *

     */

    public function get($type = 'todo') {

        

        $request = $this->input->get();

        //print_r($request); die;

        $offset = $request['start'];

        $limit = $request['length'];

        $columnArray = $request['columns'];



        // get selected filed

        $fields = $columns = array_column($columnArray,'data');

        $fields = $this->Todo->getSelectField($columns);

        // get where field

        $whereFeilds = $this->Todo->getWhereField($columns);



        $where = '';

        if(!empty($request['search']['value'])) {

            foreach ($whereFeilds as $key => $value) {

                $where.= 'and '.$value." Like '%".$request['search']['value']."%'";

            }

        }



        // add filters

        $isFilter = 'nofilter';

        if(!empty($request['q'])) {

            $isFilter = 'filter';

            $query = json_decode($request['q'],true);

            if($query) {

                $filter = $this->Todo->getWhereField(array_keys($query));

                // print_r($filter); die;

                foreach ($filter as $key => $value) {

                    if (!empty($query[$key])) {

                        $where.= ' and '.$value." like '%".$query[$key]."%'";

                    }

                }

            }

        }



        //set order

        $order = null;

        if(isset($request['order']) && is_array($request['order'])) {

            $order = $columns[$request['order'][0]['column']].' '.$request['order'][0]['dir'];

        }

        //print_r($where); die;

        $companyList = $this->TodoModel->getTodo($fields,$where,$order,$limit,$offset,$isFilter);



        foreach ($companyList as $key => &$value) {

            $value['phase'] = '-';

        }





        $companycount = $this->TodoModel->getTodo('count(*) as count',$where);



        $data['recordsFiltered'] = $companycount[0]['count']; 

        $data['recordsTotal'] = $companycount[0]['count']; 

        $data['data'] = $companyList;

        echo json_encode($data);

        // print_r($data['data']); die

    }



    /**

     *

     */

    public function form($id = null) {

        $html = '';

        $data = array();



        $data['job'] = $this->TodoModel->getLeadJob();

        $data['assignedTo'] = $this->TodoModel->scheduleAssignedTo();

        $data['schedule'] = $this->SchedulingModel->getSchedule(['id','title']);

        $data['todo'] = array();

        $data['url'] = 'todo/create/todo/';

        if($id) {

            $data['url'] = 'todo/edit/todo/'.$id;

            $data['todo'] = $this->TodoModel->getTodo('*',['id' => $id]);

            if(!empty($data['todo'])) {

                $data['todo'] = $data['todo'][0];

            }

        }

        

        try {

            $html = $this->page->getPage('todoForm',$data,true);

            $response['code'] = 200;

            $response['message'] = 'form generated';

            $response['data']['html'] = $html;

            $response['data']['heading'] = '';

        } catch(Exception $e) {

            $response['code'] = 200;

            $response['message'] = 'form generated';

            $response['data']['html'] = $html;

            $response['data']['heading'] = '';

        }

        echo json_encode($response);

    }



    /**

     *

     */

    public function create($id = null) {

        try {

            $post = $this->input->post();

            //validation error

            $this->load->library('form_validation');

            $this->form_validation->set_rules('job', 'Job', 'required|numeric');

            $this->form_validation->set_rules('title', 'Title', 'required');

            $this->form_validation->set_rules('priority', 'Priority', 'required');

            $this->form_validation->set_rules('date_time', 'Date Time Required', 'required');

            $this->form_validation->set_rules('assigned_to', 'Assigned To', 'required');

            $this->form_validation->set_rules('reminder', 'Reminder', 'required');



            if ($this->form_validation->run() == FALSE) {

                $response['error'] = "<div class='alert-danger-2'>

                        <strong>Alert !</strong><br/><br/>".

                        validation_errors().

                    "</div>";

                $response['code'] = 200;

                $response['message'] = 'error in insertion';

                $response['data'] = array();    

            } else {

                $insertArray = array(

                    'fk_job' => $post['job'],

                    'fk_schedule' => $post['schedule'],

                    'note' => trim($post['title']),

                    'priority' => $post['priority'],	

                    'is_completed' => isset($post['completed'])?1:0,	

                    'start_date_time' => isset($post['date_time'])?date('Y-m-d H:i:s',strtotime($post['date_time'])):'',

                    'assigned_to' => $post['assigned_to'],

                    'reminder' => $post['reminder'],

                    'day' => $post['day'],

                    'option' => $post['option'],

                    'when' => $post['when']

                );

               

                if($id) {

                    $data['id'] = $id; 

                    $this->TodoModel->updateTodo($insertArray,['id' => $id]);

                }else {

                    $data['id'] = $this->TodoModel->insertTodo($insertArray);

                }



                

                $response['code'] = 200;

                 $response['message'] = "<div class='alert alert-success'><strong>Success!</strong> Schedule Created Successfully.</div>";

                $response['data'] = $data['id'];

            }



        } catch (Exception $e) {

            $response['error'] = "<div class='alert-danger-2'><strong>Alert !</strong><br/><br/>Error in saving a data</div>";

            $response['code'] = 505;

            $response['message'] = 'error in insertion';

            $response['data'] = array();

        }



        echo json_encode($response);

    }

}



