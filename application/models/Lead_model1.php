<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class LeadOpportunity_model extends CI_Model {

    protected $tableName = 'lead_opportunity';
    protected $tableNameRole = 'roles';
    protected $tableNameCompany = 'company_template';
    protected $tableUserContact = 'users_contacts';
    protected $tableGrid = 'saved_grid';
    protected $tableSources = 'sources';
    protected $tablejob_type = 'job_type';
    protected $tableTags = 'tags';
    protected $tableUsers = 'users';
    protected $tableCountry = 'country';

    function __construct() {
        // parent::__construct();
        $this->load->database();
    }

    public function getCompany($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableNameCompany);
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
    } // end : getCompany

    public function getExistingPerson($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            // print_r($where); die;
            $this->db->select('lo.*, u.*, uc.*, ct.company_name,ct.company_id');
            $this->db->from('lead_opportunity lo');
            $this->db->join('users u', 'lo.fk_user_id = u.user_id', 'inner');
            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'inner');
            $this->db->join('company_template ct', 'ct.company_id = u.fk_company_id', 'inner');
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
            // echo $this->db->last_query(); die;
            return $CompanyData->result_array();
        } catch(Exception $e) {
            return $CompanyData ;
        }
    } // end : getCompany

    public function getSource($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableSources);
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
    } // end : getCompany

    public function getJobType($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tablejob_type);
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
    } // end : getCompany

    public function getTags($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableTags);
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
    } // end : getCompany

    public function getSalesPersons($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableUsers);
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
    } // end : getCompany

    public function getCountry($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $CompanyData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableCountry);
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
    } // end : getCompany

    public function insertOpportunity($insertFeild) {
        try {
            $id = $this->db->insert($this->tableName,$insertFeild);
            $id = $this->db->insert_id();
            // echo $this->db->last_query(); die;
            return $id;
        } catch(Exception $e) {
            return false;
        }
    } // end : insertUser

    public function insertUserConatct($insertFeild) {
        try {
            $id = $this->db->insert($this->tableUserContact,$insertFeild);
            $id = $this->db->insert_id();
            // echo $this->db->last_query(); die;            
            return $id;
        } catch(Exception $e) {
            return false;
        }
    } 

    public function insertLead($insertFeild) {
        try {
            $id = $this->db->insert($this->tableName,$insertFeild);
            $id = $this->db->insert_id();
            // echo $this->db->last_query(); die;
            return $id;
        } catch(Exception $e) {
            return false;
        }
    }
    /**
     * get Company name
     * @param $select string select field
     * @param $where Array where condition
     * @param $order string add order by
     * @param $limit string add limit
     * @param $offset string add offset
     *
     */
    public function getLead($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        // echo "inside model"; die;
        // print_r($where); die;
        $UserData = array();
        try {
            $this->db->select('lo.*,uc.contact_info,la.activity_date');
             $this->db->group_by('lo.lead_opportunity_id');
            $this->db->from('lead_opportunity lo');
            $this->db->join('users_contacts uc', 'uc.fk_user_id = lo.fk_user_id', 'inner');
            $this->db->join('lead_activity la', 'lo.lead_opportunity_id = la.fk_lead_opportunity_id', 'inner');
            if(!empty($where)) {
                $this->db->where($where);    
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            
            $UserData = $this->db->get();
            // echo $this->db->last_query(); die;
            return $UserData->result_array();
        } catch(Exception $e) {
            return $UserData ;
        }
    } // end : getUSer

    public function getGrid($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $UserData = array();
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
            
            $UserData = $this->db->get();
            return $UserData->result_array();
        } catch(Exception $e) {
            return $UserData ;
        }
    } // end : getUSer

    public function getUserContact($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $UserData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableUserContact);
            if(!empty($where)) {
                $this->db->where($where);    
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            
            $UserData = $this->db->get();
            return $UserData->result_array();
        } catch(Exception $e) {
            return $UserData ;
        }
    } // end : getCompany

    public function getRole($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {
        $RoleData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableNameRole);
            if(!empty($where)) {
                $this->db->where($where);    
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            
            $RoleData = $this->db->get();
            return $RoleData->result_array();
        } catch(Exception $e) {
            return $RoleData ;
        }
    } 


    /**
     * get Company name
     * @param $insertFeild array insert field
     * @return integer auto increment id 
     * @author Bimal Sharma <sharma.bimal226@gmail.com>
     */


        public function insertGrid($insertFeild) {
        try {
            $id = $this->db->insert($this->tableGrid,$insertFeild);
            $id = $this->db->insert_id();
            return $id;
        } catch(Exception $e) {
            return false;
        }
    } // end : insertUser

    function updateUser($updateField = array(),$where) {
        $this->db->where($where);
        $data = $this->db->update($this->tableName, $updateField);
        return $data;
    }

    function updateUserConatct($updateField = array(),$where) {
        $this->db->where($where);
        $data = $this->db->update($this->tableUserContact, $updateField);
        return $data;
    }

//     function deleteCompany($CompanyId=0) {
//         $deleteQuery = $this->db->delete('company_template', array('company_id' => $CompanyId));
//         return true;
//     }
    function deleteOpportunies($updateField= array(),$where) {

        $this->db->where_in('lead_opportunity_id',$where);
        $data = $this->db->update('lead_opportunity', $updateField);
        return $data;
    }

    public function getEmailIds($select = '*',$where = array(),$order = null,$limit = null,$offset=null) { 
        $UserData = array();
        try {
            $this->db->select('uc.contact_info,uc.contact_type');
            $this->db->from('lead_opportunity lo');
            $this->db->join('users u', 'u.user_id = lo.fk_user_id', 'inner');
            $this->db->join('users_contacts uc', 'u.user_id = uc.fk_user_id', 'inner');
            $this->db->where('uc.contact_type', 'Email');

            if(!empty($where)) {
                $this->db->where_in('lead_opportunity_id',$where);
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            
            $UserData = $this->db->get();
            // echo $this->db->last_query();die;
            return $UserData->result_array();
        } catch(Exception $e) {
            return $UserData ;
        }
    } // end : insertUser


    public function createFilter($insertArray) {
        try {
            $id = $this->db->insert('saved_filter',$insertArray);
            return $id;
        } catch(Exception $e) {
            return false;
        }

    } // end : insertCompany

    public function getSavedFilter($select = '*',$where= null,$order = null,$limit = null,$offset=null) {
        $filterData = array();
        try {
            $this->db->select($select);
            $this->db->from("saved_filter");
            if(!empty($where)) {
                $this->db->where($where);    
            }

            if(!empty($order)) {
                $this->db->order_by($order);    
            }

            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            
            $filterData = $this->db->get();
            return $filterData->result_array();
        } catch(Exception $e) {
            return $filterData;
        }
    } // end : getCompany
}