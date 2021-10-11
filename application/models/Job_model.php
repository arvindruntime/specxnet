<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Job_model extends CI_Model {

    protected $tableName = 'job';

    function __construct() {
        // parent::__construct();
        $this->load->database();
    }

    public function getJobs($select = '*', $where = array()) {
        $jobData = array();
        try {
            $this->db->select($select);
            $this->db->from('lead_opportunity lo');
            $this->db->join('job j', 'lo.lead_opportunity_id = j.fk_lead_opportunity_id', 'inner');
            $this->db->join('users u', 'j.created_by = u.user_id', 'inner');
            $this->db->join('users u2', 'lo.fk_user_id = u2.user_id', 'inner');
            if(!empty($where)) {
                $this->db->where($where);    
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            
            $jobData = $this->db->get();
            return $jobData->result_array();
        } catch(Exception $e) {
            return $jobData ;
        }
    } // end : insertUser

    public function insertJob($insertFeild)
    {
        try {
            $id = $this->db->insert($this->tableName,$insertFeild);
            $id = $this->db->insert_id();            
            return $id;
        } catch(Exception $e) {
            return false;
        }
    }

}