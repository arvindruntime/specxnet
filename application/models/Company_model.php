<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Company_model extends CI_Model {



    protected $tableName = 'company_template';

    protected $tableGrid = 'saved_grid';

    protected $tableFilter = 'saved_filter';

    protected $tableDivision = 'division';

    protected $tableIndustry = 'industry';



    function __construct() {

        // parent::__construct();

        $this->load->database();

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

    public function getCompany($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        //print_r($where );exit;

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from('company_template c1');

            $this->db->join('company_template c2', 'c1.parent_company_id = c2.company_id', 'left');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            } else {

                $this->db->order_by('c1.company_id', 'desc');

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();  

            // echo $this->db->last_query();die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData;

        }

    } // end : getCompany



    public function getCompanyEditForm($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        //print_r($where );exit;

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from('company_template c1');

            $this->db->join('company_template c2', 'c1.parent_company_id = c2.company_id', 'left');

            $this->db->join('industry i', 'c1.fk_industry_id = i.industry_id', 'left');

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

            // echo $this->db->last_query();die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData;

        }

    } // end : getCompany



    public function getParentCompany($select = '*',$where = array()) {

        //print_r($where );exit;

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from('company_template c1');

            $this->db->join('company_template c2', 'c1.parent_company_id = c2.company_id', 'left');

            $this->db->where('c1.parent_company_id != 0');

            if(!empty($where)) {

                $this->db->where($where);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();  

            // echo $this->db->last_query();die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData;

        }

    } // end : getCompany



    public function getCompanyExcel($select = '*',$where = array(),$companyIdList=null) {

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from('company_template c1');

            $this->db->join('company_template c2', 'c1.parent_company_id = c2.company_id', 'left');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($companyIdList)) {

                $this->db->where_in('c1.company_id', $companyIdList);    

            }



            //print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();  

            // echo $this->db->last_query();die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData;

        }

    }



    /**

     * get Country name

     * @param $select string select field

     * @param $order string add order by

     * @param $limit string add limit

     * @param $offset string add offset

     *

     */

    public function getCountry($select = '*',$order = null,$limit = null,$offset=null) {

        $CountryData = array();

        try {

            $this->db->select($select);

            $this->db->from('country');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            

            $CountryData = $this->db->get();

            return $CountryData->result_array();

        } catch(Exception $e) {

            return $CountryData;

        }

    } // end : getCompany





    /**

     * get Company name

     * @param $insertFeild array insert field

     * @return integer auto increment id 

     * @author Bimal Sharma <sharma.bimal226@gmail.com>

     */

    public function insertCompany($insertFeild) {

        //print_r($insertFeild);exit;

        try {

            $id = $this->db->insert($this->tableName,$insertFeild);

            $insert_id = $this->db->insert_id();
        // echo $this->db->last_query();die;

            return $insert_id;

        } catch(Exception $e) {

            return false;

        }

        



    } // end : insertCompany



   



    function updateCompany($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

    }



//     function deleteCompany($CompanyId=0) {

//         $deleteQuery = $this->db->delete('company_template', array('company_id' => $CompanyId));

//         return true;

//     }



    /**

     * get Export Data

     * @param $company_type consist(Internal, Supplier, Customer)

     * @return $newColumnString consist list of column names 

     * @author Sagar Kodalkar

     */



    function exportCompany($company_type, $newColumnString) {



        $this->db->select("$newColumnString, t2.company_name as parent_company");

        $this->db->from("company_template t1");

        $this->db->join("company_template t2", "t1.parent_company_id = t2.company_id", "left");

        if ($company_type == 'internal') {

            $this->db->where("t1.company_type", "Internal");

        } else if($company_type == 'suppliers') {

            $this->db->where('t1.company_type', 'Supplier');

        } else if($company_type == 'customers') {

            $this->db->where('t1.company_type', 'Customer Contact');

        }

        $this->db->where('t1.activity_status', 'active');

        $CompanyData = $this->db->get();

        return $CompanyData->result_array();

    }



    /**

     * get Company List for Result page after filter

     * @param $company_type consist(Internal, Supplier, Customer)

     * @return $newColumnString consist list of column names 

     * @author Sagar Kodalkar

     */



    function getCompanyList($select='t1.*', $where = NULL,$company_type='') {

        //print_r($where);exit;

        $this->db->select($select);

        $this->db->from('company_template t1');

        $this->db->join('company_template t2', 't1.parent_company_id = t2.company_id', 'left');

        $this->db->like($where);

        //print_r($this->db->get_compiled_select());exit;

        $CompanyData = $this->db->get();

        return $CompanyData->result_array();

    }



    function getCompanyIdentifier($where) {

        //print_r($where);exit;

        $this->db->select('t1.*');

        $this->db->from('master_identifier t1');

        $this->db->join('country t2', 't1.fk_phone_code = t2.phonecode', 'left');

        $this->db->where($where);

        $identifierData = $this->db->get();

        return $identifierData->result_array();

    }



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



    public function insertGrid($insertFeild) {

        try {

            $id = $this->db->insert($this->tableGrid,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertGrid



    function deleteCompany($updateField= array(),$where) {

        // print_r($where); die;



        $this->db->where_in('company_id',$where);

        

        $data = $this->db->update($this->tableName, $updateField);

        // print_r($this->db->get_compiled_update()); die;





        // $data = $this->db->update($this->tableName, $updateField);



        // echo $this->db->last_query();die;

        return $data;

    }



    public function getEmailId($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $UserData = array();

        try {

            $this->db->select('uc.contact_info');

            $this->db->from('company_template ct');

            $this->db->join('users u', 'u.fk_company_id = ct.company_id', 'inner');

            $this->db->join('users_contacts uc', 'u.user_id = uc.fk_user_id', 'inner');

            $this->db->where('uc.contact_type', 'Email');



            if(!empty($where)) {

                $this->db->where_in('u.fk_company_id',$where);

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

            $id = $this->db->insert($this->tableFilter,$insertArray);

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



    function deleteAttachFile($updateField= array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableName, $updateField);

        return $data;

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



    function getFilterDropdown($where= array()) {

        $getPath = array();

        try {

            $this->db->select('*');

            $this->db->from($this->tableFilter);

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



    function getDivision($where= array()) {

        $getPath = array();

        try {

            $getPath = $this->db->get($this->tableDivision);

            $path = $getPath->result_array();

            return $path;

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function addDivision($division = array()) {

        try {

            $this->db->insert($this->tableDivision,$division);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    function getIndustry($selectIndustry, $whereIndustry= array()) {

        //$getPath = array();

        try {

            // $getPath = $this->db->get($this->tableIndustry);

            $this->db->select($selectIndustry);

            $this->db->from($this->tableIndustry);

            if(!empty($whereIndustry)) {

                $this->db->where($whereIndustry);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            return $getPath->result_array();

        } catch(Exception $e) {

            return $getPath;

        }

    }



    function addIndustry($industry = array()) {

        try {

            $this->db->insert($this->tableIndustry,$industry);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    function isExistIndustry($selectIndustry = '*', $where = array()) {

        $getPath = array();

        $where['active_status'] = 'active';

        try {

            // $getPath = $this->db->get($this->tableIndustry);

            $this->db->select($selectIndustry);

            $this->db->from($this->tableIndustry);

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



    function isExistDivision($selectDivision = '*', $where = array()) {

        $getPath = array();

        try {

            $this->db->select($selectDivision);

            $this->db->from($this->tableDivision);

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



    public function getCompanyDetails($where = array()) {

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



    function isExistCompany($where = array()) {

        try {

            $this->db->select('company_id');

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



//----------For Cron Job------------------

    public function getExpiryDates($select, $where = array()) {

        try {

            $this->db->select($select);

            $this->db->from($this->tableName);

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



    public function getAdminEmails($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        //print_r($where );exit;

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from('users_contacts uc');

            $this->db->join('users u', 'uc.fk_user_id = u.user_id', 'inner');

            $this->db->join('roles r', 'u.fk_role_id = r.role_id', 'inner');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            //print_r($this->db->get_compiled_select());exit;

            $CompanyData = $this->db->get();  

            // echo $this->db->last_query();die;

            return $CompanyData->result_array();

        } catch(Exception $e) {

            return $CompanyData;

        }

    }

}