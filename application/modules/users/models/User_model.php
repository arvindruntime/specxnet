<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class User_model extends CI_Model {

    protected $tableName = 'users';

    protected $tableNameRole = 'roles';

    protected $tableNameCompany = 'company_template';

    protected $tableUserContact = 'users_contacts';

    protected $tableGrid = 'saved_grid';

    protected $tableUserLogin = 'users_login';

    protected $tableRoles = 'roles';

    protected $tablePermissionsNotifications = 'role_permission_notification';

    protected $tableUsersPermissions = 'users_permissions';

    protected $tableUsersNotifications = 'users_notifications';

    protected $tableUsersPreferences = 'users_preferences';

    protected $tableNameDepartment = 'department';

    protected $tableLeadOpportunity = 'lead_opportunity';

    protected $tableUsersSetNotification = 'user_set_notification';

    protected $tableDepartment = 'department';

    function __construct() {

        // parent::__construct();

        //$this->load->database();

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

    public function getUserCount($select = 'user_id',$where = array(),$order = null,$limit = null,$offset=null) {

        try {

            $this->db->select($select);

            $this->db->from('users u');
            $this->db->join('roles r', 'u.fk_role_id = r.role_id', 'left');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'inner');

            $this->db->join('lead_opportunity lo', 'u.user_id = lo.fk_user_id', 'left');
            
            if(!empty($where)) {

                $this->db->where($where);    

            }
            if(!empty($order)) {

                $this->db->order_by($order);    

            } else {

                $this->db->order_by('user_id', 'desc');

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }


            // print_r($this->db->get_compiled_select());exit;

            $UserData = $this->db->get();

            return $UserData->num_rows();

        } catch(Exception $e) {

            return $UserData ;

        }

    }

    public function getUser($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        // $UserData = array();

        // print_r($where); die;

        try {

            $this->db->select($select);            

            $this->db->group_by('u.user_id');

            $this->db->from('users u');

            $this->db->join('roles r', 'u.fk_role_id = r.role_id', 'left');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'inner');

            $this->db->join('lead_opportunity lo', 'u.user_id = lo.fk_user_id', 'left');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            } else {

                $this->db->order_by('user_id', 'desc');

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


    function permDeleteUser($where) {
        $this->db->where_in('fk_user_id',$where);
        $data = $this->db->delete('users_contacts');

        $this->db->where_in('fk_user_id',$where);
        $data = $this->db->delete('users_login');

        $this->db->where_in('fk_user_id',$where);
        $data = $this->db->delete('lead_opportunity');

        $this->db->where_in('created_by',$where);
        $data = $this->db->delete('lead_activity');
        return $data;

    }
    

    public function getUsersForActivity($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        // $UserData = array();

        // print_r($where); die;

        try {

            $this->db->select($select);            

            $this->db->group_by('u.user_id');

            $this->db->from('users u');

            $this->db->join('roles r', 'u.fk_role_id = r.role_id', 'left');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'left');

            $this->db->join('lead_opportunity lo', 'u.user_id = lo.fk_user_id', 'left');

            $this->db->join('company_template c', 'u.fk_company_id = c.company_id', 'left');

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



    public function getUserUpdate($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        // $UserData = array();

        // print_r($where); die;

        try {

            $this->db->select($select);            

            $this->db->group_by('u.user_id');

            $this->db->from('users u');

            $this->db->join('roles r', 'u.fk_role_id = r.role_id', 'left');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'left');

            $this->db->join('lead_opportunity lo', 'u.user_id = lo.fk_user_id', 'left');

            $this->db->join('company_template c1', 'u.fk_company_id = c1.company_id', 'left');

            $this->db->join('company_template c2', 'c1.parent_company_id = c2.company_id', 'left');

            $this->db->join('department d', 'u.fk_department_id = d.department_id', 'left');

            $this->db->join('industry i', 'c1.fk_industry_id = i.industry_id', 'left');

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

            return $UserData->result_array();

        } catch(Exception $e) {

            return $UserData ;

        }

    } // end : getUSer



    public function getUserExcel($select = '*',$where = array(),$userIdList=null) {

        // $UserData = array();

        // print_r($where); die;

        try {

            $this->db->select($select);            

            $this->db->group_by('u.user_id');

            $this->db->from('users u');

            $this->db->join('roles r', 'u.fk_role_id = r.role_id', 'inner');

            $this->db->join('users_contacts uc', 'uc.fk_user_id = u.user_id', 'left');

            if(!empty($where)) {

                $this->db->where($where);    

            }

            if(!empty($userIdList)) {

                $this->db->where_in('u.user_id', $userIdList);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $UserData = $this->db->get();

            //echo $this->db->last_query();die;

            return $UserData->result_array();

        } catch(Exception $e) {

            return $UserData ;

        }

    } // end : getUSer



    public function getUserContact($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $UserData = array();

        try {

            $this->db->from("users_contacts uc");

            $this->db->join("users u", "uc.fk_user_id = u.user_id", "inner");

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

            

        // echo $this->db->last_query();die;

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

            $this->db->where('role_status', 'active');

            if(!empty($where)) {

                $this->db->where_not_in('role_name', $where);  

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            // print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    } 



    public function checkUserName($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $this->db->select('*');

        $this->db->from($this->tableUserLogin);



        $this->db->like('username',$where);

        $UserLoginData = $this->db->get();

        // echo $this->db->last_query();die;

        return $UserLoginData->result_array();

    }



    public function getDepartment($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableNameDepartment);

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

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData ;

        }

    } // end : getCompany



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

            //print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData ;

        }

    } // end : getCompany





    /**

     * get Company name

     * @param $insertFeild array insert field

     * @return integer auto increment id 

     * @author Bimal Sharma <sharma.bimal226@gmail.com>

     */

    public function insertUser($insertFeild) {

        try { 

            $id = $this->db->insert($this->tableName,$insertFeild);

            $id = $this->db->insert_id();

            //echo $this->db->last_query();die;

            return $id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertUser



    public function insertGrid($insertFeild) {

        try {

            $id = $this->db->insert($this->tableGrid,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertUser





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

    } // end : insertUser



    public function checkEmailExist($email, $where, $userId=null) {

        try {

            $this->db->select('count(*) as count');

            $this->db->from($this->tableUserContact);

            $this->db->where($where);

            if ($userId) {

                $this->db->where("fk_user_id !=$userId");

            }

            //print_r($this->db->get_compiled_select());

            $id = $this->db->get();

            $count = $id->result_array();

            if($count[0]['count'] == 0) {

                return 'Success';

            } else {

                return 'Failed';

            }

            

        } catch(Exception $e) {

            return false;

        }

    } // end : insertUserContact



    public function insertUserConatctfromLead($insertFeild, $fk_user_id, $where) {

        try {

            $this->db->select('count(*) as count');

            $this->db->from($this->tableUserContact);

            $this->db->where("fk_user_id = $fk_user_id");

            $this->db->where($where);

            //print_r($this->db->get_compiled_select());exit;

            $id = $this->db->get();

            $count = $id->result_array();

            if ($count[0]['count'] == 0) {

                // $sql = $this->db->set($insertFeild)->get_compiled_insert($this->tableUserContact);

                // print_r($sql);exit;

                $id = $this->db->insert($this->tableUserContact,$insertFeild);

                $id = $this->db->insert_id();

                return $id; 

            }

            

        } catch(Exception $e) {

            return false;

        }

        



    } // end : insertUserContact


public function insert_data($tblName,$insertFeild) {

        try {

            $id = $this->db->insert($tblName,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

        



    } // end : insertUserContact


    public function insertUserConatct($insertFeild) {

        try {

            $id = $this->db->insert($this->tableUserContact,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

        



    } // end : insertUserContact



    public function insertUserpermissions($insertFeild) {

        try {

            $id = $this->db->insert($this->tableUsersPermissions,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertUserContact



    public function insertUsernotifications($insertFeild) {

        try {

            $id = $this->db->insert($this->tableUsersNotifications,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertUserContact



    public function insertUserPreferences($insertFeild) {

        try {

            $id = $this->db->insert($this->tableUsersPreferences,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertUserContact



    function updateUserPreferences($updateField = array(),$where) {

        // print_r($this->db->set($updateField)->get_compiled_update($this->tableUsersPreferences));exit;

        $this->db->where($where);

        $data = $this->db->update($this->tableUsersPreferences, $updateField);

        return $data;

    }



    function updateUserPermissions($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableUsersPermissions, $updateField);

        return $data;

    }



    function updateUserNotifications($updateField = array(),$where) {

        // print_r($this->db->set($updateField)->get_compiled_update($this->tableUsersNotifications));exit;

        $this->db->where($where);

        $data = $this->db->update($this->tableUsersNotifications, $updateField);

        return $data;

    }



    function updateUser($updateField = array(),$where) {

        // $sql = $this->db->set($updateField)->get_compiled_update($this->tableName);

        // echo $sql."<br/>"; 

        // print_r($where);

        // exit;

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    function updateUserConatct($updateField = array(),$where) { 

        $this->db->where($where);

        $data = $this->db->update($this->tableUserContact, $updateField);



        // echo $this->db->last_query();die;

        return $data;

    }



//     function deleteCompany($CompanyId=0) {

//         $deleteQuery = $this->db->delete('company_template', array('company_id' => $CompanyId));

//         return true;

//     }



    public function insertUserLogin($dataUserLogin) {

        try {

            $id = $this->db->insert($this->tableUserLogin,$dataUserLogin);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertUser



    function updateUserLogin($updateField = array(),$where = array()) { 

        $this->db->where($where);

        $data = $this->db->update($this->tableUserLogin, $updateField);



        // echo $this->db->last_query();die;

        return $data;

    }



    function deleteUser($updateField= array(),$where) {

        // print_r($where); die;



        $this->db->where_in('user_id',$where);

        // print_r($this->db->get_compiled_update()); die;



        $data = $this->db->update('users', $updateField);



        return $data;

    }



    function deleteUserContact($where) {



        $this->db->where($where);

        $this->db->delete($this->tableUserContact);

    }



    public function getEmailIds($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $UserData = array();

        try {

            $this->db->select('contact_info');

            $this->db->from($this->tableUserContact);

            $this->db->where('contact_type', 'Email');



            if(!empty($where)) {

                $this->db->where_in('fk_user_id',$where);

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

            
            // print_r($this->db->get_compiled_select());exit;

            $filterData = $this->db->get();

            return $filterData->result_array();

        } catch(Exception $e) {

            return $filterData;

        }

    } // end : getCompany



    public function getCompanyId($companyName=null, $where=array()) {

        $getCompanyId = array();

        try {

            $this->db->select('company_id');

            $this->db->from($this->tableNameCompany);

            $this->db->like('company_name', $companyName);

            if(!empty($where)) {

                $this->db->where($where);    

            }
            $this->db->group_by('company_type');


            // print_r($this->db->get_compiled_select());exit;

            $getCompanyId = $this->db->get();

            return $getCompanyId->result_array();

        } catch(Exception $e) {

            return $getCompanyId;

        }

    } // end : getCompanyID



    public function getRoleId($roleName=null) {

        $getRoleId = array();

        try {

            $this->db->select('role_id');

            $this->db->from($this->tableNameRole);

            $this->db->like('role_name', $roleName);

            //print_r($this->db->get_compiled_select());exit;

            $getRoleId = $this->db->get();

            return $getRoleId->result_array();

        } catch(Exception $e) {

            return $getRoleId;

        }

    } // end : getCompanyID 



    public function getUserEmail($userID, $where) {

        $emailID = array();

        try {

            $this->db->select('contact_info');

            $this->db->from($this->tableUserContact);

            $this->db->where('contact_type', 'Email');

            $this->db->where_in('fk_user_id',$where);

            //print_r($this->db->get_compiled_select());exit;

            $emailID = $this->db->get();

            return $emailID->result_array();

        } catch(Exception $e) {

            return $emailID;

        }

    } // end : getCompanyID



    public function getRoleIdLead($where) {

        $emailID = array();

        try {

            $this->db->select('role_id');

            $this->db->from($this->tableRoles);

            $this->db->where($where);

            //print_r($this->db->get_compiled_select());exit;

            $emailID = $this->db->get();

            $getRole = $emailID->result_array();

            return $getRole[0]['role_id'];

        } catch(Exception $e) {

            return $emailID;

        }

    } // end : getCompanyID



    public function getUserId($where) {

        $emailID = array();

        try {

            $this->db->select('fk_user_id');

            $this->db->from($this->tableUserContact);

            $this->db->where($where);

            //print_r($this->db->get_compiled_select());exit;

            $emailID = $this->db->get();

            $getRole = $emailID->result_array();

            if (isset($getRole[0]['fk_user_id'])) {

                return $getRole[0]['fk_user_id'];

            } else {

                return 0;

            }

            

        } catch(Exception $e) {

            return $emailID;

        }

    } // end : getCompanyID



    public function getCountOfContact($where, $id) {

        $emailID = array();

        try {

            $this->db->select('count(user_contact_id) as count');

            $this->db->from($this->tableUserContact);

            $this->db->where($where);

            $this->db->where("user_contact_id != $id");

            //print_r($this->db->get_compiled_select());exit;

            $emailID = $this->db->get();

            $getRole = $emailID->result_array();

            return $getRole[0]['count'];

        } catch(Exception $e) {

            return $emailID;

        }

    } // end : getCompanyID



    public function getModulePermissions($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $permissionsData = array();

        try {

            $this->db->select($select);

            $this->db->from('permissions p');

            $this->db->join("modules m", "p.fk_module_id = m.module_id", "inner");

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            $this->db->group_by('p.fk_module_id');

            //print_r($this->db->get_compiled_select());exit;

            $permissionsData = $this->db->get();

            return $permissionsData->result_array();

        } catch(Exception $e) {

            return $permissionsData ;

        }

    } // end : getCompany



    public function getPermissionsNotifications($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tablePermissionsNotifications);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            // print_r($this->db->get_compiled_select());exit();

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getUserPermissions($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableUsersPermissions);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getUserNotifications($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableUsersNotifications);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getModuleNotification($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $notificationsData = array();

        try {

            $this->db->select($select);

            $this->db->from('notifications n');

            $this->db->join("modules m", "n.fk_module_id = m.module_id", "inner");

            // $this->db->join("modules m2", "m.parent_module = m2.module_id", "inner");

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            $this->db->group_by('n.fk_module_id');

            // print_r($this->db->get_compiled_select());exit;

            $notificationsData = $this->db->get();

            return $notificationsData->result_array();

        } catch(Exception $e) {

            return $notificationsData ;

        }

    } // end : getCompany



    public function getUserPreferences($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableUsersPreferences);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    function addDepartment($updateField = array()) {

        try {

            $id = $this->db->insert($this->tableNameDepartment, $updateField);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    public function getUserLeadCount($where = array()) {

        $RoleData = array();

        try {

            $this->db->select('lead_opportunity_id');

            $this->db->from($this->tableLeadOpportunity);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->num_rows();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function checkUserPermissionExist($where = array()) {

        $RoleData = array();

        try {

            $this->db->select('user_permission_id');

            $this->db->from($this->tableUsersPermissions);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->num_rows();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    function updateRPN($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



    public function checkUserPreferencesExist($where = array()) {

        $RoleData = array();

        try {

            $this->db->select('user_preference_id');

            $this->db->from($this->tableUsersPreferences);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->num_rows();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getPreferencesForUser($where = array()) {

        $RoleData = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tableUsersPreferences);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            $data['count'] = $RoleData->num_rows();

            $data['result'] = $RoleData->result_array();

            return $data;

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function checkUserLoginExist($where = array()) {

        $this->db->select('user_login_id, username, password');

        $this->db->from($this->tableUserLogin);

        if(!empty($where)) {

            $this->db->where($where);    

        }

        $UserLoginData = $this->db->get();

        $result['count'] = $UserLoginData->num_rows();

        $result['result'] = $UserLoginData->result_array();

        return $result;

    }



    public function isExistDepartment($selectDivision = '*', $where = array()) {

        $getPath = array();

        try {

            $this->db->select($selectDivision);

            $this->db->from($this->tableDepartment);

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



    public function getUsersNotification($where = array()) {

        try {

            $this->db->select('*');

            $this->db->from($this->tableUsersSetNotification);

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



    function setUsersNotification($updateField = array(),$action='') {

        try {

            $id = $this->db->insert($this->tableUsersSetNotification, $updateField);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    function updateUsersNotification($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableUsersSetNotification, $updateField);

        return $data;

    }



    public function getUsersDetails($where = array(),$select='*') {

        try {

            $this->db->select($select);

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



    public function addUserEmailDraft($insertArray) {

        try {

            $id = $this->db->insert('user_draft_email',$insertArray);

            return $id;

        } catch(Exception $e) {

            return false;

        }



    } // end : insertCompany



    public function getSalesPeople($select = '*', $where = array()) {

        $this->db->select($select);

        $this->db->from('users u');

        $this->db->join("users_permissions up", "up.fk_user_id = u.user_id", "left");

        if(!empty($where)) {

            $this->db->where($where);    

        }

        //print_r($this->db->get_compiled_select());exit;

        $CompanyData = $this->db->get();

        // echo $this->db->last_query(); die;

        return $CompanyData->result_array();



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



    public function getCompanyList($select= '*', $where = array()) {

        try {

            $this->db->select($select);

            $this->db->from('company_template c1');

            $this->db->join('company_template c2', 'c1.parent_company_id = c2.company_id', 'left');

            $this->db->join('industry i', 'c1.fk_industry_id = i.industry_id', 'left');

            $this->db->join('country con', 'c1.country = con.name', 'left');

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



    public function getUserData($select= '*', $where = array()) {

        try {

            $this->db->select($select);

            $this->db->from('users');

            if(!empty($where)) {

                $this->db->where($where);   

            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data = $getPath->result_array();

            return $data[0];

        } catch(Exception $e) {

            return $getPath;

        }

    }



    public function getEmailExist($select = '*', $where = array()) {

        try {

            $this->db->select($select);

            $this->db->from($this->tableUserContact);

            if(!empty($where)) {

                $this->db->like($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            return $RoleData->num_rows();

        } catch(Exception $e) {

            return $RoleData ;

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



}

