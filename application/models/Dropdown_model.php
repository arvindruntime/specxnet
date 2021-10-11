<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Dropdown_model extends CI_Model
{



    protected $tableName = 'dropdowns';

    protected $tableIndustry = 'industry';

    protected $tableDepartment = 'department';

    protected $tableDivision = 'division';

    protected $tableJob_type = 'job_type';

    protected $tableSources = 'sources';





    function __construct()
    {

        // parent::__construct();

        $this->load->database();
    }



    public function insertrole($insertFeild)
    {

        try {

            $id = $this->db->insert($this->tableName, $insertFeild);

            $id = $this->db->insert_id();

            // echo $this->db->last_query(); die;

            return $id;
        } catch (Exception $e) {

            return false;
        }
    } // end : insertUser



    public function insertUserConatct($insertFeild)
    {

        try {

            $id = $this->db->insert($this->tableUserContact, $insertFeild);

            $id = $this->db->insert_id();

            // echo $this->db->last_query(); die;            

            return $id;
        } catch (Exception $e) {

            return false;
        }
    }





    public function getRoleList($select = '*', $where = array(), $order = null, $limit = null, $offset = null)
    {

        $UserData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableNameRole);

            if (!empty($where)) {

                $this->db->where($where);
            }



            if (!empty($order)) {

                $this->db->order_by($order);
            }



            if (!empty($limit)) {

                $this->db->limit($limit, $offset);
            }



            $UserData = $this->db->get();

            return $UserData->result_array();
        } catch (Exception $e) {

            return $UserData;
        }
    } // end : getCompany



    public function getDropdown($select = '*', $where = array(), $order = null, $limit = null, $offset = null)
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableName);

            if (!empty($where)) {

                $this->db->where($where);
            }



            if (!empty($order)) {

                $this->db->order_by($order);
            }



            if (!empty($limit)) {

                $this->db->limit($limit, $offset);
            }

            //print_r($this->db->get_compiled_select());exit;

            // print_r($this->db->get_compiled_select());exit;



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }

    // public function dorpdownExist($select = '*',$where = array()) {
    //     $this->db->select($select);

    //     $this->db->from($this->tableIndustry);

    //     $this->db->where($where);         

    //     $RoleData = $this->db->get();

    //     return $RoleData->result_array();

    // }
    public function getIndustryData($select = '*',$where = array()) {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableIndustry);

            if(!empty($where)) {

                $this->db->where($where);    

            }

            

            $RoleData = $this->db->get();

            return $RoleData->result_array();

        } catch(Exception $e) {

            return $RoleData ;

        }

    }

    public function dorpdownExist( $where, $module)
    {
            $this->db->select('count(*) as count');
            if ($module == 'Industry') {

                $this->db->from($this->tableIndustry);
                $this->db->where($where);
            }
    
            if ($module == 'Division') {
                $this->db->from($this->tableDivision);
                $this->db->where($where);
            }
    
            if ($module == 'Department') {
                $this->db->from($this->tableDepartment);
                $this->db->where($where);
            }
    
            if ($module == 'Sources') {
                $this->db->from($this->tableSources);
                $this->db->where($where);
            }
    
            if ($module == 'Job Type') {
                $this->db->from($this->tableJob_type);
                $this->db->where($where);
            }

            $id = $this->db->get();

            $count = $id->result_array();
            if ($count[0]['count'] == 0) {

                return true;
            } else {

                return false;
            }
    } // end : insertUserContact


    public function getDepartmentData($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableDepartment);

            if (!empty($where)) {

                $this->db->where($where);
            }



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getSourceData($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableSources);

            if (!empty($where)) {

                $this->db->where($where);
            }



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getJobTypeData($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableJob_type);

            if (!empty($where)) {

                $this->db->where($where);
            }



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getDivsionData($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableDivision);

            if (!empty($where)) {

                $this->db->where($where);
            }



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getNotificationList($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableNotifications);

            if (!empty($where)) {

                $this->db->where($where);
            }



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getNotifications($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tablePermissionsNotifications);

            if (!empty($where)) {

                $this->db->where($where);
            }



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getPermissions($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tablePermissionsNotifications);

            if (!empty($where)) {

                $this->db->where($where);
            }



            $RoleData = $this->db->get();

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getModules($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tablePermissions);

            if (!empty($where)) {

                $this->db->where_in('permission_id', $where);
            }

            $this->db->group_by('fk_module_id');

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            //print_r($RoleData->result_array());exit;

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getModulesNotification($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tableNotifications);

            if (!empty($where)) {

                $this->db->where_in('notification_id', $where);
            }

            $this->db->group_by('fk_module_id');

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            //print_r($RoleData->result_array());exit;

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    public function getModuleDetails($select = '*', $where = array())
    {

        $RoleData = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tableModules);

            if (!empty($where)) {

                $this->db->where_in('module_id', $where);
            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            //print_r($RoleData->result_array());exit;

            return $RoleData->result_array();
        } catch (Exception $e) {

            return $RoleData;
        }
    }





    function updateRole($updateField = array(), $where)
    {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;
    }



    function getRoleIdPermissions($where)
    {

        $RoleData = array();

        try {

            $this->db->select('count(*) as count');

            $this->db->from($this->tablePermissionsNotifications);

            if (!empty($where)) {

                $this->db->where($where);
            }

            //print_r($this->db->get_compiled_select());exit;

            $RoleData = $this->db->get();

            $result = $RoleData->result_array();

            return $result[0]['count'];
        } catch (Exception $e) {

            return $RoleData;
        }
    }



    function insertRolePermissions($insertField = array())
    {

        $id = $this->db->insert($this->tablePermissionsNotifications, $insertField);

        $id = $this->db->insert_id();

        // echo $this->db->last_query(); die;

        return $id;
    }



    function updateRolePermissions($updateField = array(), $where)
    {

        $this->db->where($where);

        $data = $this->db->update($this->tablePermissionsNotifications, $updateField);

        return $data;
    }



    function deleteRole($updateField = array(), $where)
    {



        $this->db->where_in('role_id', $where);

        $data = $this->db->update('roles', $updateField);

        // print_r($this->db->get_compiled_select());exit;



        // echo $this->db->last_query();die;

        return $data;
    }



    public function createFilter($insertArray)
    {

        try {

            $id = $this->db->insert('saved_filter', $insertArray);

            // echo $this->db->last_query(); die;

            return $id;
        } catch (Exception $e) {

            return false;
        }
    } // end : insertCompany



    public function updateModuleItems($updateField = array(), $where, $module)
    {

        $this->db->where($where);

        if ($module == 'Industry') {

            $data = $this->db->update($this->tableIndustry, $updateField);
        }

        if ($module == 'Division') {

            $data = $this->db->update($this->tableDivision, $updateField);
        }

        if ($module == 'Department') {

            $data = $this->db->update($this->tableDepartment, $updateField);
        }

        if ($module == 'Sources') {

            $data = $this->db->update($this->tableSources, $updateField);
        }

        if ($module == 'Job Type') {

            $data = $this->db->update($this->tableJob_type, $updateField);
        }
        // echo $this->db->last_query();
        // die;


        return $data;
    }



    function deleteData($tableName, $where = array())
    {



        $data = $this->db->delete($tableName, $where);

        // echo $this->db->last_query();


        return $data;
    }
}
