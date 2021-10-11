<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Schedule extends CI_Controller {



    protected $phase = array('Design Phase','Manufacturing Phase');



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

        $this->load->model(array('Scheduling_model' => 'SchedulingModel'));

        $this->load->library(array('Schedule_library' => 'Schedule'));

    }



    /**

    * index action of Login controller

    * @author Bimal Sharma

    * @param

    */

    public function index($scheduleType = 'list') {

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

        $this->page->setHeadStyle(base_url()."assets/custom/gantt/jsgantt.css");



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

        $this->page->setFooterJs(base_url()."assets/custom/js/schedule.js");

        $this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");

        $this->page->setFooterJs(base_url()."assets/custom/js/jquery.dataTables.min.js");

        $this->page->setFooterJs(base_url()."assets/custom/gantt/jsgantt.js");







        $page['config'] = $this->Schedule->getConfig();

        $page['tabs'] = $this->Schedule->getTabs();

        $page['newButton'] = $this->Schedule->getNewButton();

        $page['action'] = $this->Schedule->getAction();

        $page['actionButton'] = $this->Schedule->getActionButton();

        $page['tableColumn'] = $this->Schedule->getColumn($scheduleType);

        $page['checkedAction'] = $this->Schedule->getCheckedAction();

        $page['module_name'] = "schedule";

        $page['contain'] = 'schedule';

        $page['module_type'] = $scheduleType;

        $page['gridView'] = array();//$this->companyMondel->getGrid('*',array('module_name' => $page['module_name']));

        $page['filter'] = array();




        $this->page->getLayout($page);

    }



    /**

     *

     */

    public function get($type = 'list') {

        if($type == 'list') {

            $this->list();

        }else if($type == 'agenda') {

            $this->agenda();

        }

    }



    protected function agenda() {

        $request = $this->input->get();

        //print_r($request); die;

        $offset = $request['start'];

        $limit = $request['length'];

        $columnArray = $request['columns'];



        // get selected filed

        $fields = $columns = array_column($columnArray,'data');

        $fields = $this->Schedule->getSelectField($columns,'agenda');

        // get where field

        $whereFeilds = $this->Schedule->getWhereField($columns,'agenda');

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

                $filter = $this->company->getWhereField(array_keys($query));

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

        $companyList = $this->SchedulingModel->getSchedule($fields,$where,$order,$limit,$offset,$isFilter);



        foreach ($companyList as $key => &$value) {

            $value['phase'] = '-';

        }





        $companycount = $this->SchedulingModel->getSchedule('count(*) as count',$where);



        $data['recordsFiltered'] = $companycount[0]['count']; 

        $data['recordsTotal'] = $companycount[0]['count']; 

        $data['data'] = $companyList;

        echo json_encode($data);

        // print_r($data['data']); die

    }



    /**

     *

     */

    protected function list() {

        // get method request

        $request = $this->input->get();

        //print_r($request); die;

        $offset = $request['start'];

        $limit = $request['length'];

        $columnArray = $request['columns'];



        // get selected filed

        $fields = $columns = array_column($columnArray,'data');

        $fields = $this->Schedule->getSelectField($columns,'list');

        array_push($fields, 's.id');

        // get where field

        $whereFeilds = $this->Schedule->getWhereField($columns,'list');

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

                $filter = $this->company->getWhereField(array_keys($query));

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

        

        $scheduleList = $this->SchedulingModel->getSchedule($fields,$where,$order,$limit,$offset,$isFilter);



        foreach ($scheduleList as $key => &$value) {

            $value['phase'] = '-';

        }





        $companycount = $this->SchedulingModel->getSchedule('count(*) as count',$where);



        $data['recordsFiltered'] = $companycount[0]['count']; 

        $data['recordsTotal'] = $companycount[0]['count']; 

        $data['data'] = $scheduleList;

        echo json_encode($data);

        // print_r($data['data']); die;

    }



    /**

     *

     */

    public function form($id = null) {

        $html = '';

        $data = array();



        $data['job'] = $this->SchedulingModel->getLeadJob();

        $data['assignedTo'] = $this->SchedulingModel->scheduleAssignedTo();

        $data['schedule'] = array();

        $data['url'] = 'shedule/create/schedule/';

        $data['NoteUrl'] = 'shedule/create/schedule/note/';

        $data['uploadUrl'] = 'shedule/upload/schedule/';

        $data['phaseUrl'] = 'shedule/phase/schedule/';

        $data['phase'] = $this->phase;

        $data['note']['all'] = '';

        $data['note']['internal'] = '';

        $data['note']['owner'] = '';

        $data['note']['vendor'] = '';

        if($id) {

            $data['url'] = 'shedule/edit/schedule/'.$id;

            $data['NoteUrl'] = 'shedule/create/schedule/note/'.$id;

            $data['uploadUrl'] = 'shedule/upload/schedule/'.$id;

            $data['phaseUrl'] = 'shedule/phase/schedule/'.$id;

            $data['schedule'] = $this->SchedulingModel->getSchedule('*',['id' => $id]);

            if(!empty($data['schedule'])) {

                $data['schedule'] = $data['schedule'][0];

            }



            $getNote = $this->SchedulingModel->getNote('*',['fk_schedule_id' => $id]);

            foreach ($getNote as $key => $value) {

                $data['note'][$value['type']] = $value['note'];

            }



            $getScheduleDocument = $this->SchedulingModel->getScheduleDocument('*',['fk_schedule_id' => $id]);

            foreach ($getScheduleDocument as $key => $value) {

                $data['scheduleDocument']= $value['name'];

            }  



            $getPhase = $this->SchedulingModel->getSchedulePhase('*',['fk_schedule_id' => $id],'created_at DESC');

            if(!empty($getPhase)) {

                $data['schedulePhase']= $getPhase[0]['phase'];

            }

        }

        $data['id'] = $id;



        try {

            $html = $this->page->getPage('scheduleForm',$data,true);

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

            $this->form_validation->set_rules('schedule_title', 'Schedule Title', 'required');

            $this->form_validation->set_rules('start_date', 'Start Date', 'required');

            $this->form_validation->set_rules('end_date', 'End Date', 'required');

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

                    'job_id' => $post['job'],

                    'title' => $post['schedule_title'],

                    'start_date' => date('Y-m-d',strtotime($post['start_date'])),

                    'end_date' => date('Y-m-d',strtotime($post['end_date'])),

                    'start_time' => date('H:i:s',strtotime($post['start_date'])),

                    'end_time' => date('H:i:s',strtotime($post['end_date'])),

                    'duration' => 0,

                    'assigned_to' => $post['assigned_to'],

                    'reminder' => $post['reminder'],

                    'status' => 'In Process'

                );

               

                if($id) {

                    $data['id'] = $id; 

                    $this->SchedulingModel->updateSchedule($insertArray,['id' => $id]);

                }else {

                    $data['id'] = $this->SchedulingModel->insertSchedule($insertArray);

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



    public function getEvents() {

        

        $request = $this->input->get();



        $form = date('Y-m-d',strtotime($request['start']));

        $end = date('Y-m-d',strtotime($request['end'])); 



        $where = "(start_date >= '$form' and end_date <= '$end') OR (end_date between '$form' and '$end') OR (start_date between '$form' and '$end') OR (start_date <= '$form' and end_date >= '$form') OR (start_date >= '$end' and end_date <= '$end')"; 



        $data = $this->SchedulingModel->getSchedule('*',$where);



        $result = array();



        foreach ($data as $key => $value) {

            

            $row['title'] = $value['title'];

            $row['start'] = $value['start_date'];

            if($value['start_time'] != '00:00:00') {

                $row['start'].= 'T'.$value['start_time'];

            }



            $row['end'] = $value['end_date'];

            if($value['end_time'] != '00:00:00') {

                $row['end'].= 'T'.$value['end_time'];

            }



            array_push($result, $row);

        }
        print_r($result);exit();

        echo json_encode($result);

    }



    public function getGantChartData() {

        $data = $this->SchedulingModel->getSchedule();

        $response = array();

        foreach ($data as $key => $value) {

            $row['id'] = $value['id'];

            $row['title'] = $value['title'];

            $row['from'] = date('m/d/Y H:i',strtotime($value['start_date'].''.$value['start_time']));

            $row['to'] = date('m/d/Y H:i',strtotime($value['end_date'].''.$value['end_time']));

            $row['color'] = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT).''.str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT).''.str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);



            array_push($response, $row);

        }

        echo json_encode($response);

    }



    public function createNote($id = null) {   

        $post = $this->input->post();

        

        foreach ($post as $key => $value) {

            $where['fk_schedule_id'] = $data['fk_schedule_id'] = $id;

            $where['type'] = $data['type'] = $key;



            $dataNote = $this->SchedulingModel->getNote(['type'],$where);

            

            $data['note'] = $value;

            if(empty($dataNote))

            {

                $this->SchedulingModel->insertNote($data);

            }else {

               $this->SchedulingModel->updateNote($data,$where); 

            }

        }



        $response['code'] = 200;

        $response['message'] = "<div class='alert alert-success'><strong>Success!</strong> Schedule Note Created Successfully.</div>";

        $response['data'] = $id;

        echo json_encode($response);

    }



    public function uploadDocument($id) {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('uploadFile', 'File', 'trim|xss_clean');

        if ($this->form_validation->run()==FALSE) {

            $response['error'] = "<div class='alert-danger-2'>

                        <strong>Alert !</strong><br/><br/>".

                        validation_errors().

                    "</div>";;

            $response['code'] = 505;

            $response['message'] = 'error in upload file';

            $response['data'] = array();

            echo json_encode($response); die;

        }else {

            $config['upload_path']   = './upload/schedule/';

            $config['allowed_types'] = 'gif|jpg|png|docx|doc|txt|rtf';



            $this->load->library('upload', $config);



            if(!$this->upload->do_upload('uploadFile',FALSE)) {

                $response['error'] = "<div class='alert-danger-2'>

                        <strong>Alert !</strong><br/><br/>".

                        $this->upload->display_errors().

                    "</div>";;

                $response['code'] = 505;

                $response['message'] = 'error in upload file';

                $response['data'] = array();

                echo json_encode($response); die;

            }else {

                $data = $this->upload->data();



                $scheduleDocument = $this->SchedulingModel->getScheduleDocument(['id'],['fk_schedule_id' => $id]);



                $insertData['name'] = $data['client_name'];

                $insertData['fk_schedule_id'] = $id;



                if(!empty($scheduleDocument)) {

                    $this->SchedulingModel->updateScheduleDocument($insertData,['id' => $scheduleDocument[0]['id']]);

                }else {

                    $id = $this->SchedulingModel->insertScheduleDocument($insertData);

                }



                $response['message'] = "<div class='alert alert-success'><strong>Success!</strong> File Uploaded Successfully.</div>";

                $response['data'] = $id;



                echo json_encode($response); die;

            }

        }

    }



    /**

    *

    */

    public function schedulePhase($id) {

        //validation error

        try {

            $post = $this->input->post();

            $this->load->library('form_validation');

            $this->form_validation->set_rules('phase', 'Phase', 'required');



            if ($this->form_validation->run() == FALSE) {

                $response['error'] = "<div class='alert-danger-2'>

                            <strong>Alert !</strong><br/><br/>".validation_errors().

                            "</div>";

                $response['code'] = 500;

                $response['message'] = 'error in insertion';

                $response['data'] = array();    

            } else {

                $insertArray = array(

                    'phase' => $post['phase'],

                    'fk_schedule_id' => $id

                );

                   

                $data['id'] = $this->SchedulingModel->insertSchedulePhase($insertArray);

                    

                $response['code'] = 200;

                $response['message'] = "<div class='alert alert-success'><strong>Success!</strong> Schedule Phase Created Successfully.</div>";

                $response['data'] = $data['id'];

            }

        } catch (Exception $e) {

            $response['error'] = "<div class='alert-danger-2'><strong>Alert !</strong><br/><br/>Error in saving a data</div>";

            $response['code'] = 500;

            $response['message'] = 'error in insertion';

            $response['data'] = array();

        }



        echo json_encode($response);

    }

}



