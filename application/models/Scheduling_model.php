<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Scheduling_model extends CI_Model {



    protected $tableName = 'scheduling';

    protected $scheduleNoteTableName = 'schedule_note';

    protected $scheduleDocumentTableName = 'scheduling_document';

    protected $schedulePhaseTableName = 'schedule_phase';



    function __construct() {

        $this->load->database();

    }





    /**

     *

     */

    public function getSchedule($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $result = array();

        try {

            $this->db->select($select);

            $this->db->from('scheduling s');
            // $this->db->join('schedule_phase','schedule_phase.id=machine_info.machine_category')
            $this->db->join('users u', 'u.user_id=s.assigned_to', 'left');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }



            $result = $this->db->get();  

            // echo $this->db->last_query();die;

            return $result->result_array();



        } catch (Exception $e) {

            return $result;

        }

    }



    /**

     *

     */

    public function getLeadJob()

    {

        try {

            $this->db->select(array('opportunity_title','job_id'));

            $this->db->from('job j');

            $this->db->join('lead_opportunity lo', 'j.fk_lead_opportunity_id = lo.lead_opportunity_id', 'inner');

            $result = $this->db->get();  

            // echo $this->db->last_query();die;

            return $result->result_array();

        }catch(Exception $e) {

            return array();

        }  

    }



    /**

     *

     */

    public function scheduleAssignedTo()

    {

        try {

            $this->db->select(array('full_name','user_id'));

            $this->db->from('users u');

            $result = $this->db->get();  

            // echo $this->db->last_query();die;

            return $result->result_array();

        }catch(Exception $e) {

            return array();

        }  

    }



    /**

    *

    */

    public function insertSchedule($insertFeild) {

        try {

            $id = $this->db->insert($this->tableName,$insertFeild);

            $id = $this->db->insert_id();            

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    /**

    *

    */

    public function updateSchedule($updateField,$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    /**

    *

    */

    public function getNote($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $result = array();

        try {

            $this->db->select($select);

            $this->db->from($this->scheduleNoteTableName.' s');



            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }



            $result = $this->db->get();  

            // echo $this->db->last_query();die;

            return $result->result_array();



        } catch (Exception $e) {

            return $result;

        }

    }



    /**

    *

    */

    public function insertNote($insertFeild)

    {

        try {

            $id = $this->db->insert($this->scheduleNoteTableName,$insertFeild);

            $id = $this->db->insert_id();            

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    /**

    *

    */

    public function updateNote($updateField,$where)

    {

        $this->db->where($where);

        $data = $this->db->update($this->scheduleNoteTableName, $updateField);

        return $data;

    }



    /**

    *

    */

    public function insertScheduleDocument($insertFeild) {

        try {

            $id = $this->db->insert($this->scheduleDocumentTableName,$insertFeild);

            $id = $this->db->insert_id();            

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    /**

    *

    */

    public function getScheduleDocument($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $result = array();

        try {

            $this->db->select($select);

            $this->db->from($this->scheduleDocumentTableName);



            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }



            $result = $this->db->get();  

            // echo $this->db->last_query();die;

            return $result->result_array();



        } catch (Exception $e) {

            return $result;

        }

    }



    /**

    *

    */

    public function updateScheduleDocument($updateField,$where) {

        $this->db->where($where);

        $data = $this->db->update($this->scheduleDocumentTableName, $updateField);

        return $data;

    }



    /**

    *

    */

    public function insertSchedulePhase($insertFeild) {

        try {

            $id = $this->db->insert($this->schedulePhaseTableName,$insertFeild);

            $id = $this->db->insert_id();            

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    /**

    *

    */

    public function getSchedulePhase($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $result = array();

        try {

            $this->db->select($select);

            $this->db->from($this->schedulePhaseTableName);



            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }



            $result = $this->db->get();  

            // echo $this->db->last_query();die;

            return $result->result_array();



        } catch (Exception $e) {

            return $result;

        }

    }



}