<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Activity_model extends CI_Model {



    protected $tableName = 'lead_activity';

    protected $tableNameRole = 'roles';

    protected $tableNameactivityMail = 'lead_activity_mail';

    protected $tableNameCompany = 'company_template';

    protected $tableUserContact = 'users_contacts';

    protected $tableGrid = 'saved_grid';

    protected $tableSources = 'sources';

    protected $tablejob_type = 'job_type';

    protected $tableTags = 'tags';

    protected $tableUsers = 'users';

    protected $tableCountry = 'country';

    protected $tableActivityType = 'activity_type';

    protected $tableActivityStatus = 'activity_status';

    protected $tableActivityComment = 'activity_comments';



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


    function permDeleteActivities($where) {



        $this->db->where_in('lead_activity_id',$where);

        $data = $this->db->delete('lead_activity');

         // echo $this->db->last_query();die;

        return $data;

    }
    
    public function getSalesPersons($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);            

            $this->db->from('roles r');            

            $this->db->join('users u', 'u.fk_role_id = r.role_id', 'inner');

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



    public function getSalesPersonsAndAdmins($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);            

            $this->db->from('roles r');            

            $this->db->join('users u', 'u.fk_role_id = r.role_id', 'inner');

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



    public function getSalesPer($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);            

            $this->db->from('sales_people s');            

            // $this->db->join('users u', 'u.fk_role_id = r.role_id', 'inner');

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



    public function insertUser($insertFeild) {

        try {

            $id = $this->db->insert($this->tableUsers,$insertFeild);

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



     public function insertActivity($insertFeild) {

        try {

            $id = $this->db->insert($this->tableName,$insertFeild);

            $id = $this->db->insert_id();

            // echo $this->db->last_query(); die;

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }

     public function addActivityMail($insertFeilds) {

        try {

            $id = $this->db->insert($this->tableNameactivityMail,$insertFeilds);

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

        $UserData = array();

        try {

            $this->db->select($select);

            $this->db->group_by('lo.lead_opportunity_id');

            $this->db->from('lead_opportunity lo');

            $this->db->join('users u', 'lo.fk_user_id = u.user_id', 'inner');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'inner');

            $this->db->join('company_template c', 'u.fk_company_id = c.company_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

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



    public function getActivity($select = '*',$where = array(),$order = null,$limit = null,$offset=null) { 

        $UserData = array();

        try {

            $this->db->select($select);            

            $this->db->group_by('t1.lead_activity_id');

            $this->db->from('lead_activity t1');

            $this->db->join('lead_opportunity t2', 't1.fk_lead_opportunity_id = t2.lead_opportunity_id', 'inner');

            $this->db->join('users_contacts uc', 'uc.fk_user_id =  t2.fk_user_id', 'left');

            $this->db->join('users u2', 't1.assigned_by = u2.user_id', 'left');

            $this->db->join('users u3', 't2.fk_user_id = u3.user_id', 'left');

            $this->db->join('company_template c', 'u3.fk_company_id = c.company_id', 'inner');

            $this->db->join('activity_comments ac', 't1.lead_activity_id = ac.fk_lead_activity_id', 'left');

            $this->db->join('users u4', 't2.fk_user_id = u4.user_id', 'inner');

            $this->db->join('company_template c2', 'u4.fk_company_id = c2.company_id', 'inner');

            $this->db->where('t1.activity_status','active');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            } else {

                $this->db->order_by('lead_activity_id','desc');

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            // print_r($this->db->get_compiled_select());exit;

            $UserData = $this->db->get();

            return $UserData->result_array();

        } catch(Exception $e) {

            return $UserData ;

        }

    } // end : getUSer



    public function getActivityList($select = '*',$where = array(),$order = 'lead_activity_id',$limit = 10,$offset=0) { 

        $UserData = array();

        try {

            $this->db->select($select);

            $this->db->from('lead_activity');

            $this->db->where('activity_status','active');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order,'desc');    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            // print_r($this->db->get_compiled_select());exit;

            $UserData = $this->db->get();

            return $UserData->result_array();

        } catch(Exception $e) {

            return $UserData ;

        }

    } // end : getUSer



    public function getActivityExcel($select = '*',$where = array(),$activityList) { 

        $activityData = array();

        try {

            $this->db->select($select);            

            $this->db->group_by('t1.lead_activity_id');

            $this->db->from('lead_activity t1');

            $this->db->join('lead_opportunity t2', 't1.fk_lead_opportunity_id = t2.lead_opportunity_id', 'inner');

            $this->db->join('users_contacts uc', 'uc.fk_user_id =  t2.fk_user_id', 'left');

            $this->db->join('users u2', 't1.assigned_by = u2.user_id', 'left');

            $this->db->join('users u3', 't2.fk_user_id = u3.user_id', 'left');

            $this->db->join('company_template c', 'u3.fk_company_id = c.company_id', 'inner');

            $this->db->join('activity_comments ac', 't1.lead_activity_id = ac.fk_lead_activity_id', 'left');

            $this->db->join('users u4', 't2.fk_user_id = u4.user_id', 'inner');

            $this->db->join('company_template c2', 'u4.fk_company_id = c2.company_id', 'inner');
            // $this->db->join('sales_people u1', 't2.fk_sales_people_id = u1.sales_people_id', 'left');


            $this->db->where('t1.activity_status','active');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($activityList)) {

                $this->db->where_in('t1.lead_activity_id', $activityList);    

            }

            $activityData = $this->db->get();

            // echo $this->db->last_query(); die;

            return $activityData->result_array();

        } catch(Exception $e) {

            return $activityData ;

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





    public function getUserdetails($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

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

            //int_r($this->db->get_compiled_select());exit;

            

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



    function updateActivity($updateField = array(),$where) {

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

    function deleteActivities($updateField= array(),$where) {



        $this->db->where_in('lead_activity_id',$where);

        $data = $this->db->update('lead_activity', $updateField);

         // echo $this->db->last_query();die;

        return $data;

    }



    public function getEmailIds($select = '*',$where = array(),$order = null,$limit = null,$offset=null) { 

        $UserData = array();

        try {

            $this->db->select('uc.contact_info');

            $this->db->from('lead_activity la');

            $this->db->join('lead_opportunity lo', 'lo.lead_opportunity_id = la.lead_activity_id', 'inner');

            $this->db->join('users u', 'u.user_id = lo.fk_user_id', 'inner');

            $this->db->join('users_contacts uc', 'u.user_id = uc.fk_user_id', 'inner');

            $this->db->where('uc.contact_type', 'Email');



            if(!empty($where)) {

                $this->db->where_in('la.lead_activity_id',$where);

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



    public function createFilter($insertArray) {

        try {

            $id = $this->db->insert('saved_filter',$insertArray);

            // echo $this->db->last_query(); die;

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

            //print_r($this->db->get_compiled_select());exit;

            

            $filterData = $this->db->get();

            return $filterData->result_array();

        } catch(Exception $e) {

            return $filterData;

        }

    } // end : getCompany



    public function getuserContactActivity($select = '*',$where = array()) { 

        $UserData = array();

        try {

            $this->db->select("GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info");

            $this->db->from('lead_opportunity lo');

            $this->db->join('users u', 'u.user_id = lo.fk_user_id', 'inner');

            $this->db->join('users_contacts uc', 'u.user_id = uc.fk_user_id', 'inner');



            if(!empty($where)) {

                $this->db->where($where);

            }

            //print_r($this->db->get_compiled_select());exit;

            $UserData = $this->db->get();

            

            return $UserData->result_array();

        } catch(Exception $e) {

            return $UserData ;

        }

    }



    function updateStatus($updateField = array(),$where,$limit = null,$offset=null) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    public function getActivityFiles($select = '*',$where = array()) { 

        $activityData = array();

        try {

            $this->db->select($select);

            $this->db->from('lead_activity_mail lam');

            $this->db->join('lead_opportunity lo', 'lam.fk_lead_opportunity_id = lo.lead_opportunity_id', 'inner');

            $this->db->join('lead_activity la', 'lam.fk_lead_activity_id = la.lead_activity_id', 'inner');

            $this->db->join('users u', 'lam.from_id = u.user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }

            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            $activityData = $this->db->get();

            // print_r($this->db->get_compiled_select());exit;

            $data['data'] = $activityData->result_array();

            $data['count'] = $activityData->num_rows();

            return $data;

        } catch(Exception $e) {

            return $activityData ;

        }

    } // end : getUSer



    public function getLeadEmailFields($where = array()) { 

        $activityData = array();

        $select = "uc.contact_info";

        try {

            $this->db->select($select);

            $this->db->from('lead_opportunity lo');

            $this->db->join('users_contacts uc', 'lo.fk_user_id = uc.fk_user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }

            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            $activityData = $this->db->get();

            //print_r($this->db->get_compiled_select());exit;

            $data['data'] = $activityData->result_array();

            $data['count'] = $activityData->num_rows();

            print_r($data['data']);exit;

            return $data;

        } catch(Exception $e) {

            return $activityData ;

        }

    } // end : getUSer



    public function getActivityDetails($where = array()) {

        try {

            $this->db->select('lo.opportunity_title');

            $this->db->from('lead_activity la');

            $this->db->join('lead_opportunity lo', 'la.fk_lead_opportunity_id = lo.lead_opportunity_id', 'inner');

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



    public function getActivityType($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);            

            $this->db->from($this->tableActivityType);

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

             // print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();

            // echo $this->db->last_query(); die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData ;

        }

    } // end : getCompany



    public function getActivityStatus($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);            

            $this->db->from($this->tableActivityStatus);

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            // print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();

            // echo $this->db->last_query(); die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData ;

        }

    } // end : getCompany



    public function addComment($insertArray) {

        try {

            $id = $this->db->insert('activity_comments',$insertArray);

            // echo $this->db->last_query(); die;

            return $id;

        } catch(Exception $e) {

            return false;

        }



    } // end : insertCompany



    public function getComments($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);           

            $this->db->from('activity_comments ac');

            $this->db->join('users u', 'ac.sender_id = u.user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            // print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData ;

        }

    }



    function getFilePath($select, $where= array()) {

        $getPath = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableName);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            

            $getPath = $this->db->get();

            $path = $getPath->result_array();

            return $path;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function deleteAttachFile($updateField= array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    function getUserEmail($select, $where= array()) {

        $getPath = array();

        try {

            $this->db->select($select);

            $this->db->from('users_preferences');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            $getPath = $this->db->get();

            $path = $getPath->result_array();

            return $path;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    public function getCommentCount($where = array()) {

        $activityData = array();

        try {

            $this->db->select('*');

            $this->db->from('activity_comments');

            if(!empty($where)) {

                $this->db->where($where);    

            }

            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            $activityData = $this->db->get();

            // print_r($this->db->get_compiled_select());exit;

            $data['data'] = $activityData->result_array();

            $data['count'] = $activityData->num_rows();

            return $data;

        } catch(Exception $e) {

            return $activityData ;

        }

    } // end : getUSer



    function updateSeenComment($updateField= array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableActivityComment, $updateField);

        return $data;

    }



    public function getLeadOpportunityId($select= '*', $where = array()) {

        try {

            $this->db->select($select);

            $this->db->from('lead_activity');

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



    public function getWhoseDataCanView($select= '*', $where = array()) {

        try {

            $this->db->select($select);

            $this->db->from('users_permissions');

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



    function getActivityCountByUSer($selectLead = '*', $where = array(),$groupBy = null) {

        $getPath = array();

        try {

            $this->db->select($selectLead);

            $this->db->from('lead_activity la');

            $this->db->join('users u', 'la.created_by = u.user_id', 'inner');

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



    function getActivityStatusCount($selectLead = '*', $where = array(),$groupBy = null) {

        $getPath = array();

        try {

            $this->db->select($selectLead);

            $this->db->from('lead_activity');

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



    function getActivityForNotification($selectLead = '*', $where = array(),$groupBy = null) {

        try {

            $this->db->select($selectLead);

            $this->db->from('lead_activity');

            //$this->db->join('users u', 'la.created_by = u.user_id', 'inner');

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



    //----------------Cron Jobs-----------------------------



    public function getDraftEmails($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        //print_r($where );exit;

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from('user_draft_email de');

            $this->db->join('users_contacts uc', 'de.added_by = uc.fk_user_id', 'inner');

            $this->db->join('users_preferences up', 'de.added_by = up.fk_user_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            // print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();  

            $data['result'] = $CompanyData->result_array();

            $data['count'] = $CompanyData->num_rows();

            return $data;

        } catch(Exception $e) {

            return $CompanyData;

        }

    }



    public function getReminders($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        //print_r($where );exit;

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableName);

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            // print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();  

            $data['result'] = $CompanyData->result_array();

            $data['count'] = $CompanyData->num_rows();

            return $data;

        } catch(Exception $e) {

            return $CompanyData;

        }

    }



}