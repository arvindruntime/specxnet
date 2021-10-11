<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Folder_model extends CI_Model {

    protected $tableName = 'folders';
    function __construct() {
        // parent::__construct();
        $this->load->database();
    }

    /**
     * Store Folder form data
     * @param $insertFeild array insert field
     * @return integer auto increment id 
     * @author Amit Singh <dev1@hozpitality.com>
     */
	
	public function getFolders($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $result = array();
        try {
            $this->db->select($select);
            $this->db->from('folders');

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
	
    public function insertFolder($insertFeild) {
        //print_r($insertFeild);exit;
        try {
            $id = $this->db->insert($this->tableName,$insertFeild);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } catch(Exception $e) {
            return false;
        }
        

    } // end : insertCompany

   

    function updateFolder($updateField = array(),$where) {
        $this->db->where($where);
        $data = $this->db->update($this->tableName, $updateField);
        return $data;
    }
    
    function deleteFolder($updateField= array(),$where) {
        // print_r($where); die;

        $this->db->where_in('folder_id',$where);
        
        $data = $this->db->update($this->tableName, $updateField);
        // print_r($this->db->get_compiled_update()); die;


        // $data = $this->db->update($this->tableName, $updateField);

        // echo $this->db->last_query();die;
        return $data;
    }
	
    function isExistFolder($where = array()) {
        try {
            $this->db->select('folder_id');
            $this->db->from($this->tableName);
            //$this->db->like('company_name', $company_name, 'after');
            if(!empty($where)) {
                $this->db->where($where);
            }
            //print_r($this->db->get_compiled_select());exit;
            $getPath = $this->db->get();
            $data['result'] = $getPath->result_array();
            $data['count'] = $getPath->num_rows();
            return $data;
        } catch(Exception $e) {
            return $getPath;
        }
    }
}