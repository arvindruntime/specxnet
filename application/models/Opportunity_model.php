<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Opportunity_model extends CI_Model {

    protected $tableName = 'opportunity_master';
    protected $tableIndustry = 'industry';
    protected $tableDepartment = 'department';
    protected $tableDivision = 'division';
    protected $tableJob_type = 'job_type';
    protected $tableSources = 'sources';
    

    function __construct() {
        // parent::__construct();
        $this->load->database();
    }

    public function inserttitle($insertFeild) {
        try {
            $id = $this->db->insert($this->tableName,$insertFeild);
            $id = $this->db->insert_id();
            // echo $this->db->last_query(); die;
            return $id;
        } catch(Exception $e) {
            return false;
        }
    } // end : insertUser

    public function getOpportunityTitle($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $RoleData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableName);
            if(!empty($where)) {
                $this->db->where($where);    
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            //print_r($this->db->get_compiled_select());exit;
            // print_r($this->db->get_compiled_select());exit;
            
            $RoleData = $this->db->get();
            return $RoleData->result_array();
        } catch(Exception $e) {
            return $RoleData ;
        }
    }

    function updateRole($updateField = array(),$where) {
        $this->db->where($where);
        $data = $this->db->update($this->tableName, $updateField);
        return $data;
    }

    function updateOpportunity($updateField = array(),$where) {
        $this->db->where($where);
        $data = $this->db->update($this->tableName, $updateField);
        return $data;
    }

    function deleteTitle($updateField= array(),$where) {
        //print_r($where['opportunity_id']); die;

        $this->db->where_in('opportunity_id',$where['opportunity_id']);
        // print_r($this->db->get_compiled_update()); die;

        $data = $this->db->update($this->tableName, $updateField);

        return $data;
    }

}