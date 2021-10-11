<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Todo_model extends CI_Model {

    protected $tableName = 'todo';

    function __construct() {
        $this->load->database();
    }


    /**
     *
     */
    public function getTodo($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $result = array();
        try {
            $this->db->select($select);
            $this->db->from('todo s');

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
    public function insertTodo($insertFeild) {
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
    public function updateTodo($updateField,$where) {
        $this->db->where($where);
        $data = $this->db->update($this->tableName, $updateField);
        return $data;
    }
}