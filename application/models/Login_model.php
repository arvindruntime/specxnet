<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Login_model extends CI_Model {
    protected $usersLogin = 'users_login';
    protected $users = 'users';
    protected $usersContacts = 'users_contacts';
    protected $tableUsersPermissions = 'users_permissions';
    protected $tableUsersNotifications = 'users_notifications';

    function __construct() {
        // parent::__construct();
        $this->load->database();
    }

    function setPass($updateField, $where = array()) {
        $this->db->where($where);
        $data = $this->db->update($this->usersLogin, $updateField);
        return $data;
    }

    function checkUserlogin($select = '*',$where = array()) {
        $LoginResult = array();
        try {
            $this->db->select($select);
            $this->db->from($this->usersLogin);
            $this->db->where($where);
            $LoginResult = $this->db->get();
            $result['count'] = $LoginResult->num_rows();
            $result['result'] = $LoginResult->result_array();
            return $result;
        } catch(Exception $e) {
            return $LoginResult;
        }
    }

    function checkUsercontact($select = '*',$where = array()) {
        $LoginResult = array();
        try {
            $this->db->select($select);
            $this->db->from($this->usersContacts);
            $this->db->where($where);
            $LoginResult = $this->db->get();
            $result['count'] = $LoginResult->num_rows();
            $result['result'] = $LoginResult->result_array();
            return $result;
        } catch(Exception $e) {
            return $LoginResult;
        }
    }

    function checkUser($select = '*',$where = array()) {
        $LoginResult = array();
        try {
            $this->db->select($select);
            $this->db->from($this->usersLogin);
            $this->db->where($where);
            // print_r($this->db->last_query());
            // exit;
            // print_r($this->db->get_compiled_select());exit;
            $LoginResult = $this->db->get();
            $result['count'] = $LoginResult->num_rows();
            $result['result'] = $LoginResult->result_array();
            return $result;

        } catch(Exception $e) {
            return $LoginResult;
        }
    }

    function checkValidEmail($where) {
        $this->db->select('u1.user_id, u2.contact_info');
        $this->db->from('users u1');
        $this->db->join('users_contacts u2', 'u1.user_id = u2.fk_user_id', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $result['count'] = $query->num_rows();
        $result['result'] = $query->result_array();
        return $result;
    }

    function getUserInfo($select, $where) {
        $this->db->select($select);
        $this->db->from('users u');
        $this->db->join('users_contacts uc', 'u.user_id = uc.fk_user_id', 'inner');
        $this->db->where($where);
        $getUser = $this->db->get();
        $result['resultUser'] = $getUser->result_array();
        return $result;
    }

    function getUserPermissions($select, $where) {
        $this->db->select($select);
        $this->db->from($this->tableUsersPermissions);
        $this->db->where($where);
        $getUser = $this->db->get();
        $result['count'] = $getUser->num_rows();
        $result['resultUser'] = $getUser->result_array();
        return $result;
    }

    function getUserNotifications($select, $where) {
        $this->db->select($select);
        $this->db->from($this->tableUsersNotifications);
        $this->db->where($where);
        $getUser = $this->db->get();
        $result['count'] = $getUser->num_rows();
        $result['resultUser'] = $getUser->result_array();
        return $result;
    }

    function updateLastLogin($updateField = array(),$where) {
        $this->db->where($where);
        $data = $this->db->update($this->users, $updateField);
        return $data;
    }
}
?>
