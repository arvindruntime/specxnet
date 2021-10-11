<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Role_model extends CI_Model {



    protected $tableName = 'roles';

    protected $tableNameRole = 'roles';

    protected $tableModules = 'modules';

    protected $tablePermissions = 'permissions';

    protected $tableNotifications = 'notifications';

    protected $tablePermissionsNotifications = 'role_permission_notification';

    



    function __construct() {

        // parent::__construct();

        $this->load->database();

    }



    public function insertrole($insertFeild) {

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





    public function getRoleList($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $UserData = array();

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

            // $this->db->where();

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



    public function getPermissionsList($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tablePermissions);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getNotificationList($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableNotifications);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getNotifications($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tablePermissionsNotifications);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getPermissions($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tablePermissionsNotifications);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    } 



    public function getModules($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tablePermissions);

            if(!empty($where)) {

                $this->db->where_in('permission_id', $where);    

            }

            $this->db->group_by('fk_module_id');

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            //print_r($RoleData->result_array());exit;

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    public function getModulesNotification($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tableNotifications);

            if(!empty($where)) {

                $this->db->where_in('notification_id', $where);

            }

            $this->db->group_by('fk_module_id');

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            //print_r($RoleData->result_array());exit;

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    } 



    public function getModuleDetails($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tableModules);

            if(!empty($where)) {

                $this->db->where_in('module_id', $where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            //print_r($RoleData->result_array());exit;

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



    function getRoleIdPermissions($where) {

        $RoleData = array();

        try {

            $this->db->select('count(*) as count');

            $this->db->from($this->tablePermissionsNotifications);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            $result = $RoleData->result_array();

            return $result[0]['count'];

        } catch(Exception $e) {

            return $RoleData ;

        }

    }



    function insertRolePermissions($insertField = array()) {

        $id = $this->db->insert($this->tablePermissionsNotifications,$insertField);

        $id = $this->db->insert_id();

            // echo $this->db->last_query(); die;

        return $id;

    }



    function updateRolePermissions($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tablePermissionsNotifications, $updateField);

        return $data;

    }



    function deleteRole($updateField= array(),$where) {



        $this->db->where_in('role_id',$where);

        $data = $this->db->update('roles', $updateField);

            // print_r($this->db->get_compiled_select());exit;



         // echo $this->db->last_query();die;

        return $data;

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

            

            $filterData = $this->db->get();

            return $filterData->result_array();

        } catch(Exception $e) {

            return $filterData;

        }

    } // end : getCompany



}