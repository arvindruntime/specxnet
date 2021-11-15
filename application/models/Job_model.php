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
    }			public function insertData($insertField, $id = null)    {		$pmdb = $this->load->database('pmdb',true);	        try {            if ($id) {                //$pmdb->where('id', $id);                //$pmdb->update('projects', $insertField);								//////////////////////////////////								$this->db->where('id', $id);                $this->db->update('projects', $insertField);            } else {															$id = $pmdb->insert('projects', $insertField);								//echo $pmdb->last_query();die;								//print "<pre>";				//print_r($id);die;                //$insert_id = $pmdb->insert_id();								////////////////////////////////////								$id = $this->db->insert('projects', $insertField);                $insert_id = $this->db->insert_id();                return $insert_id;            }        } catch (Exception $e) {            return false;        }    } 			public function getProjects($select = '*', $where = array()) {        $data = array();        try {            $this->db->select($select);            $this->db->from('projects p');			$this->db->join('projects_types as t', 't.id=p.projects_types_id', 'inner');			$this->db->join('projects_status as s', 's.id=p.projects_status_id', 'inner');						$this->db->join('users as u', 'u.user_id=p.created_by', 'inner');            if(!empty($where)) {                //$this->db->where($where);                }            if(!empty($order)) {                //$this->db->order_by($order);                }            if(!empty($limit)) {                //$this->db->limit($limit,$offset);                }                        $data = $this->db->get();						//echo $this->db->last_query();die;            return $data->result_array();        } catch(Exception $e) {            return $data ;        }    } // end : insertUser			public function get_data($tblName = '*',$select = '*', $where = array()) {        $data = array();        try {            $this->db->select($select);            $this->db->from($tblName);            if(!empty($where)) {                $this->db->where($where);                }            if(!empty($order)) {                $this->db->order_by($order);                }            if(!empty($limit)) {                $this->db->limit($limit,$offset);                }            $data = $this->db->get();            return $data->result_array();        } catch(Exception $e) {            return $data ;        }    } // end : insertUser	

}