<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Lead_model extends CI_Model {



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

    protected $tableJob = 'job';

    protected $tableJobType = 'job_type';

    protected $tablesources = 'sources';



    function __construct() {

        // parent::__construct();

        $this->load->database();

    }

    function permDeleteOpportunies($where) {

        $this->db->where_in('lead_opportunity_id',$where);
        $data = $this->db->delete('lead_opportunity');
        return $data;
    }
    function permDeleteOppoActivities($where) {
        $this->db->where_in('fk_lead_opportunity_id',$where);
        $data = $this->db->delete('lead_activity');
         // echo $this->db->last_query();die;
        return $data;
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

            $this->db->select('u.*, uc.*, GROUP_CONCAT(CONCAT(uc.contact_info,"_",uc.contact_type)) as user_info,ct.company_name,ct.company_id, ct.fk_industry_id,ct.bussiness_contact, ct.street_address as company_add,ct.city as company_city, ct.state as company_state,ct.country company_country, ct.dialing_code,ct.zip_code as company_zip, i.industry_name, c2.company_name as parentCompany, c2.company_id as parentCompanyId, CONCAT(u.country,"-",u.dialing_code) as countryName,d.department_name as department_name');                  

            $this->db->group_by('u.user_id');

            $this->db->from('users u');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'inner');

            $this->db->join('company_template ct', 'ct.company_id = u.fk_company_id', 'inner');

            $this->db->join('company_template c2', 'ct.parent_company_id = c2.company_id', 'left');

            $this->db->join('industry i', 'ct.fk_industry_id = i.industry_id', 'left');

            $this->db->join('department d', 'u.fk_department_id = d.department_id', 'left');

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



    public function getSalesPersons($select = '*',$where = array()) {

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from('users u1');

            $this->db->join('roles r', 'u1.fk_role_id = r.role_id', 'inner');

            if(!empty($where)) {

                $this->db->like($where);    

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



    public function getSalesPersonsAndAdmins($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);            

            $this->db->from('users u1');

            $this->db->join('roles r', 'u1.fk_role_id = r.role_id', 'inner');

            if(!empty($where)) {

                $this->db->where_in('r.role_name', $where);    

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

        $UserData = array();
        try {  
            $this->db->select($select);
             $this->db->group_by('lo.lead_opportunity_id');
            $this->db->from('lead_opportunity lo');
            $this->db->join('users u', 'u.user_id = lo.fk_user_id', 'inner');
            $this->db->join('users_contacts uc', 'uc.fk_user_id = lo.fk_user_id', 'inner');
            $this->db->join('lead_activity la', 'lo.lead_opportunity_id = la.fk_lead_opportunity_id', 'left');
            $this->db->join('users u2', 'la.contacted_by = u2.user_id', 'left');
            $this->db->join('users u3', 'u3.user_id = lo.fk_sales_people_id', 'left');
            $this->db->join('company_template c', 'u.fk_company_id = c.company_id', 'left');
            if(!empty($where)) {
                $this->db->where($where);    
            }
            if(!empty($order)) {
                $this->db->order_by($order);    
            } else {
                $this->db->order_by('lo.lead_opportunity_id', 'DESC');    
            }
            if(!empty($limit)) {
                $this->db->limit($limit,$offset);    
            }
            // print_r($this->db->get_compiled_select());exit;
            $UserData = $this->db->get();
            // echo $this->db->last_query(); die;
            return $UserData->result_array();
        } catch(Exception $e) {
            return $UserData ;
        }
    } // end : getUSer



    public function getLeadExcel($select = '*',$where = array(),$leadList) {
        $leadData = array();
        try {  
            // print_r($select); die;
            $this->db->select($select);
             $this->db->group_by('lo.lead_opportunity_id');
            $this->db->from('lead_opportunity lo');
            $this->db->join('users u', 'u.user_id = lo.fk_user_id', 'inner');
            // $this->db->join('users_contacts uc', 'uc.fk_user_id = lo.fk_user_id', 'inner');
            $this->db->join('lead_activity la', 'lo.lead_opportunity_id = la.fk_lead_opportunity_id', 'left');
            $this->db->join('users u2', 'la.contacted_by = u2.user_id', 'left');
            $this->db->join('users u3', 'u3.user_id = lo.fk_sales_people_id', 'left');
            $this->db->join('company_template c', 'u.fk_company_id = c.company_id', 'left');
            if(!empty($where)) {
                $this->db->where($where);    
            }
            if(!empty($leadList)) {
                $this->db->where_in('lo.lead_opportunity_id', $leadList);    
            }
            // print_r($this->db->get_compiled_select());exit;
            $leadData = $this->db->get();
            // echo $this->db->last_query(); die;
            return $leadData->result_array();

        } catch(Exception $e) {

            return $leadData ;

        }

    } // end : getUSer



    public function getGrid($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $UserData = array();

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

            
//print_r($this->db->get_compiled_select());exit;
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

            $this->db->from("users_contacts uc");

            $this->db->join("users u", "uc.fk_user_id = u.user_id", "inner");

            $this->db->join("lead_opportunity lo", "lo.fk_user_id = u.user_id", "inner");

            $this->db->join("company_template c", "u.fk_company_id = c.company_id", "left");

            $this->db->where($where);

            //print_r($this->db->get_compiled_select());exit;

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



     function updateLead($updateField = array(),$where) {

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

            $this->db->select('uc.contact_info');

            $this->db->from('lead_opportunity lo');

            $this->db->join('users_contacts uc', 'lo.fk_user_id = uc.fk_user_id', 'inner');

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

             //echo $this->db->last_query();die;

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



        public function getCTDetails($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $UserData = array();

        try {

            $this->db->select('contact_info,contact_type,user_contact_id');

            $this->db->from('users_contacts');

            



            if(!empty($where)) {

                $this->db->where('fk_user_id', $where);

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

    }



    function getUSerID($where) {

        $this->db->select('fk_user_id');

        $this->db->from($this->tableName);

        $this->db->where($where);  

        

        $getUSerID = $this->db->get();

        $userArray = $getUSerID->result_array();

        return $userArray[0]['fk_user_id'];

    }



    public function getUserInfo($whereUser=array()) {

        $CompanyData = array();

        try {

            // print_r($where); die;

            $this->db->select('u.*, GROUP_CONCAT(CONCAT(uc.contact_info,"_",uc.contact_type)) as user_info, ct.company_name,ct.company_id, CONCAT(u.country,"-",u.dialing_code) as countryName');                  

            $this->db->group_by('u.user_id');

            $this->db->from('lead_opportunity lo');

            $this->db->join('users u', 'lo.fk_user_id = u.user_id', 'inner');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'inner');

            $this->db->join('company_template ct', 'ct.company_id = u.fk_company_id', 'inner');

            if(!empty($whereUser)) {

                $this->db->where($whereUser);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();

             // echo $this->db->last_query(); die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData ;

        }

    } // end : getCompany



    function updateAge($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    public function getLeadOpportunities($select = '*',$where = array()) {

        $proposalData = array();

        try {

            $this->db->select($select);

            $this->db->from('lead_opportunity lo');

            $this->db->join('users u', 'u.user_id = lo.fk_user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    } // end : getProposallist



    public function getFkLeadOpportunityId($select = '*',$where = array()) {

        $proposalData = array();

        try {

            $this->db->select($select);

            $this->db->from('lead_opportunity lo');

            $this->db->join('users u', 'u.user_id = lo.fk_user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    } // end : getProposallist



    function addNotes($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    function updateJobStatus($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    function addJob($insertField = array()) {

        try {

            $id = $this->db->insert($this->tableJob,$insertField);

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    public function getLeadDetails($where = array()) {

        try {

            $this->db->select('*');

            $this->db->from($this->tableName);

            if(!empty($where)) {

                $this->db->where($where);   

            } 



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data['result'] = $getPath->result_array();

            $data['count'] = $getPath->num_rows();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function getJobTypeView($where= array()) {

        $getPath = array();

        try {

            $getPath = $this->db->get($this->tableJobType);

            $path = $getPath->result_array();

            return $path;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function addJobType($division = array()) {

        try {

            $this->db->insert($this->tableJobType,$division);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    function getSourceView($where= array()) {

        $getPath = array();

        try {

            $getPath = $this->db->get($this->tablesources);

            $path = $getPath->result_array();

            return $path;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function addSource($division = array()) {

        try {

            $this->db->insert($this->tablesources,$division);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    function isExistJobType($selectDivision = '*', $where = array()) {

        $getPath = array();

        try {

            $this->db->select($selectDivision);

            $this->db->from($this->tableJobType);

            if(!empty($where)) {

                $this->db->where($where);   

            } 



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data['result'] = $getPath->result_array();

            $data['count'] = $getPath->num_rows();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function isExistSource($selectDivision = '*', $where = array()) {

        $getPath = array();

        try {

            $this->db->select($selectDivision);

            $this->db->from($this->tablesources);

            if(!empty($where)) {

                $this->db->where($where);   

            } 



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data['result'] = $getPath->result_array();

            $data['count'] = $getPath->num_rows();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function updateAssignToUser($updateField = array(),$where = array()) {

        $this->db->where_in('lead_opportunity_id', $where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    function getLeadCountByUSer($selectLead = '*', $where = array(),$groupBy = null) {

        $getPath = array();

        try {

            $this->db->select($selectLead);

            $this->db->from('lead_opportunity lo');

            $this->db->join('users u', 'lo.created_by = u.user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);   

            }

            if($groupBy) {

                $this->db->group_by($groupBy);   

            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data = $getPath->result_array();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function getClientCountByUSer($selectLead = '*', $where = array(),$groupBy = null) {

        $getPath = array();

        try {

            $this->db->select($selectLead);

            $this->db->from('users u1');

            $this->db->join('users u', 'u1.created_by = u.user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);   

            }

            if($groupBy) {

                $this->db->group_by($groupBy);   

            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data = $getPath->result_array();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function getLeadOpportunityStatusCount($selectLead = '*', $where = array(),$groupBy = null) {

        $getPath = array();

        try {

            $this->db->select($selectLead);

            $this->db->from('lead_opportunity');

            if(!empty($where)) {

                $this->db->where($where);   

            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data = $getPath->result_array();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function getOpportunityMaster($selectLead = '*', $where = array(),$groupBy = null) {

        try {

            $this->db->select($selectLead);

            $this->db->from('opportunity_master');

            if(!empty($where)) {

                $this->db->where($where);   

            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data = $getPath->result_array();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function isExistOpportunityTitle($selectLead = '*', $where = array(),$groupBy = null) {

        try {

            $this->db->select($selectLead);

            $this->db->from('opportunity_master');

            if(!empty($where)) {

                $this->db->where($where);   

            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data = $getPath->num_rows();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function insertOpportunityTitle($insertFeild) {

        try {

             $id = $this->db->insert('opportunity_master',$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return $getPath;

        }

    }

}