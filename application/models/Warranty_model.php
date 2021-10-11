<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Warranty_model extends CI_Model {

    protected $tableName = 'warranty';
    protected $tableGrid = 'saved_grid';
    protected $tableFilter = 'saved_filter';
    protected $tableDivision = 'division';
    protected $tableIndustry = 'industry';

    function __construct() {
        // parent::__construct();
        $this->load->database();
    }


    /**
     * get Warranty Data
     * @param $select string select field
     * @param $where Array where condition
     * @param $order string add order by
     * @param $limit string add limit
     * @param $offset string add offset
     *
     */
    public function getWarranty($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $WarrantyData = array();
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
            
            $CompanyData = $this->db->get();  
            
            return $CompanyData->result_array();
        } catch(Exception $e) {
            return $CompanyData;
        }
    } // end : getWarranty

    /**
     * 
     */
    public function getGrid($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableGrid);
            if(!empty($where)) {
                $this->db->where($where);    
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            
            $CompanyData = $this->db->get();
            return $CompanyData->result_array();
        } catch(Exception $e) {
            return $CompanyData ;
        }
    } // end : Get grid

     /**
     * create warranty
     * @param $insertFeild array insert field
     * @return integer auto increment id 
     * @author Bimal Sharma <sharma.bimal226@gmail.com>
     */
    public function insertWarranty($insertFeild) {
        try {
            $id = $this->db->insert($this->tableName,$insertFeild);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } catch(Exception $e) {
            return false;
        }
        

    } // end : insertWarranty

    /**
     * update warranty
     * @param $updateField array update filed data
     * @param $where array 
     */
    function updateWarranty($updateField = array(),$where) {
        $this->db->where($where);
        $data = $this->db->update($this->tableName, $updateField);
        return $data;
    }

    public function insertGrid($insertFeild) {
        try {
            $id = $this->db->insert($this->tableGrid,$insertFeild);
            $id = $this->db->insert_id();
            return $id;
        } catch(Exception $e) {
            return false;
        }
    } // end : insertGrid
}