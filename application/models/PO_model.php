<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class PO_model extends CI_Model {



    protected $tableNamePO = 'purchase_order';
    protected $tableNameProposal = 'proposal';
    protected $tableNameProposalComment = 'proposal_comment';
    protected $tableNameProposalInvoice = 'release_invoice';

    protected $tableNameWorksheet = 'proposal_worksheet';

    protected $tableNameFormat = 'proposal_format pf';

    protected $tableGrid = 'saved_grid';

    protected $tableCompany = 'company_template';

    protected $tableLeadOpportunity = 'lead_opportunity';

    protected $tableUsers = 'users';

    protected $tableSavedFilter = 'saved_filter';



    function __construct() {

        // parent::__construct();

        $this->load->database();

    }



    /**

     * get Proposal List

     * @param $select string select field

     * @param $where Array where condition

     * @param $order string add order by

     * @param $limit string add limit

     * @param $offset string add offset

     *

     */

    public function getPOlist($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $proposalData = array();

        try {

            $this->db->select($select);

            $this->db->from("purchase_order po");

            $this->db->join("proposal p", "po.fk_pid = p.p_id", "inner");
            $this->db->join("proposal_worksheet pw", "p.p_id = pw.fk_pid", "inner");

            $this->db->join("lead_opportunity lo", "p.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");

            $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");

            $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");

            //$this->db->join('company_template t2', 't1.parent_company_id = t2.company_id', 'left');

            if(!empty($where)) {

                $this->db->where($where);    

            }



            if(!empty($order)) {

                $this->db->order_by($order);    

            }



            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    

            }

            $this->db->group_by("p.p_id");

            // print_r($this->db->get_compiled_select());exit;

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    } // end : getProposallist

    public function getProposal($select = '*',$where = array(),$order = null,$limit = null,$offset=null) {

        $proposalData = array();

        try {

            $this->db->select($select);

            $this->db->from("proposal");

            if(!empty($where)) {

                $this->db->where($where);    

            }

            if(!empty($order)) {

                $this->db->order_by($order);    
            }

            if(!empty($limit)) {

                $this->db->limit($limit,$offset);    
            }

            $this->db->group_by("p_id");


            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    } // end : getProposallist


    public function getProposallistCount($select = '*', $where = array()) {

        $this->db->select($select);

        $this->db->from("proposal p");

        $this->db->join("proposal_worksheet pw", "p.p_id = pw.fk_pid", "inner");

        if(!empty($where)) {

            $this->db->where($where);    

        }

        // print_r($this->db->get_compiled_select());exit;

        $proposalData = $this->db->get();

        return $proposalData->result_array();

    }

    public function getUsersDetails($where = array(),$select='*') {

        try {

            $this->db->select($select);

            $this->db->from($this->tableUsers." u");
            $this->db->join("users_contacts uc", "uc.fk_user_id = u.user_id", "inner");
            $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");


            if(!empty($where)) {

                $this->db->where($where);   

            } 



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data = $getPath->result_array();

            // $data['count'] = $getPath->num_rows();

            return $data;

        } catch(Exception $e) {

            return $getPath;

        }

    }


    public function getProposallistdemo($select = '*') {

        $proposalData = array();

        try {

            $this->db->select($select);

            $this->db->from("proposal_worksheet");

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    } // end : getProposallist



    public function getItemList($select = '*', $where = array()) {

        $itemData = array();

        try {

            $this->db->select($select);

            $this->db->from("proposal_worksheet pw");

            $this->db->join("proposal p", "pw.fk_pid = p.p_id", "inner");
            $this->db->join("users u", "pw.fk_user_id = u.user_id", "inner");
        $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");


            $this->db->where($where);

            $this->db->where("item_name !='' and id_code !=''");

            // print_r($this->db->get_compiled_select());exit;

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    } // end : getProposallist


public function getComment($select = '*',$where = array()) {

        $proposalData = array();

        try {

            $this->db->select($select);

            $this->db->from('proposal_comment pc');
            // $this->db->from("proposal p");

            $this->db->join("proposal p", "pc.p_id = p.p_id", "inner");
            $this->db->join("lead_opportunity lo", "p.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");

            $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");
    
            $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");
            //$this->db->join('company_template t2', 't1.parent_company_id = t2.company_id', 'left');

            if(!empty($where)) {

                $this->db->where($where);    

            }



           

            //print_r($this->db->get_compiled_select());exit;

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

}
public function addComment($insertField) {

    
    try {

        $id = $this->db->insert($this->tableNameProposalComment,$insertField);

        $insert_id = $this->db->insert_id();

        return $insert_id;

    } catch(Exception $e) {

        return false;

    }

} 
public function addInvoice($insertField) {

    
    try {

        $id = $this->db->insert($this->tableNameProposalInvoice,$insertField);

        $insert_id = $this->db->insert_id();

        return $insert_id;

    } catch(Exception $e) {

        return false;

    }

} 
public function getFormat($select, $where = array()) {

        $itemData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableNameFormat);

            $this->db->where($where); 

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    }



    public function getTotalFOBCIF($select, $where = array()) {

        $itemData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableNameWorksheet);

            $this->db->where($where);

            $this->db->where("item_name !='' and id_code !=''");

            //print_r($this->db->get_compiled_select());exit;

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    }



    public function getSupplierList($select = '*', $where = array()) {

        $getSupplierList = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableCompany);

            $this->db->where($where); 

            $getSupplierList = $this->db->get();

            return $getSupplierList->result_array();

        } catch(Exception $e) {

            return $getSupplierList;

        }

    } // end : getProposallist



    public function getSalesperson($select, $where) {

        $getSalesperson = array();

        try {

            $this->db->select($select);

            $this->db->from("lead_opportunity lo");

            $this->db->join("users u", "lo.fk_user_id = u.user_id", "inner");

            $this->db->where($where); 

            $getSalesperson = $this->db->get();

            return $getSalesperson->result_array();

        } catch(Exception $e) {

            return $getSalesperson;

        }

    } // end : getProposallist



    public function getCountOfExistingLead($select = '*', $leadname) {

        $getLeadCount = array();

        try {

            $getLeadCount = $this->db->select($select)->from($this->tableNameProposal)->where("title LIKE '%$leadname%'")->get()->result_array();

            //print_r($this->db->get_compiled_select());exit;

            return $getLeadCount;

        } catch(Exception $e) {

            return $getLeadCount;

        }

    } // end : getProposallist



    public function getLeadOpportunityList($select = '*', $leadname) {

        $getLeadCount = array();

        try {

            $getLeadCount = $this->db->select($select)->from($this->tableLeadOpportunity)->where("opportunity_title LIKE '%$leadname%'")->get()->result_array();

            //print_r($this->db->get_compiled_select());exit;

            return $getLeadCount;

        } catch(Exception $e) {

            return $getLeadCount;

        }

    } // end : getProposallist





    public function getLeadOpportunities($select = '*',$where = array()) {

        $proposalData = array();

        try {

            $this->db->select($select);

            $this->db->from('lead_opportunity');

            //$this->db->join('company_template t2', 't1.parent_company_id = t2.company_id', 'left');

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

            $proposalData = $this->db->get();

            return $proposalData->result_array();

        } catch(Exception $e) {

            return $proposalData;

        }

    } // end : getProposallist



    public function getLeadOpportunitiesUsers($select = '*',$where = array()) {

        $this->db->select($select);

        $this->db->from("proposal p");

        $this->db->join("proposal_worksheet pw", "p.p_id = pw.fk_pid", "inner");

        $this->db->join("lead_opportunity lo", "p.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");

        $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");

        $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");

        $this->db->where($where);

        //print_r($this->db->get_compiled_select());exit;

        $CompanyLeadOppData = $this->db->get();

        return $CompanyLeadOppData->result_array();

    } // end : getProposallist



    public function getCompanyLeadOpp($select,$where,$autoC=null) {

        $this->db->select($select);

        $this->db->from("lead_opportunity lo");

        $this->db->join("users u", "lo.fk_user_id = u.user_id", "inner");

        $this->db->join("company_template c", "u.fk_company_id = c.company_id", "inner");

        if ($autoC != null) {

            $this->db->like($where);

        } else {

            $this->db->where($where);

        }

        //print_r($this->db->get_compiled_select());exit;

        $CompanyLeadOppData = $this->db->get();

        return $CompanyLeadOppData->result_array();

        

    } // end : getCompanyLeadOpportunity


    public function getCompanyDetails($select,$where,$autoC=null) {

        $this->db->select($select);

        $this->db->from("lead_opportunity lo");

        $this->db->join("users u", "lo.fk_user_id = u.user_id", "inner");

        $this->db->join("company_template c", "u.fk_company_id = c.company_id", "inner");

        if ($autoC != null) {

            $this->db->like($where);

        } else {

            $this->db->where($where);

        }

        //print_r($this->db->get_compiled_select());exit;

        $CompanyLeadOppData = $this->db->get();

        return $CompanyLeadOppData->result_array();

        

    } // end : getCompanyLeadOpportunity



    public function insertProposal($insertField) {

        try {

            $id = $this->db->insert($this->tableNameProposal,$insertField);

            $insert_id = $this->db->insert_id();

            return $insert_id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertCompany



    public function insertIdProposalWorksheet($insertid) {

        try {

            $id = $this->db->insert($this->tableNameWorksheet,$insertid);

            $insert_id = $this->db->insert_id();

            return $insert_id;

        } catch(Exception $e) {

            return false;

        }

    } // end : insertCompany



    public function setStatus($insertField, $p_id) {

        try {

            if ($p_id) {

                $this->db->where('p_id', $p_id);

                $this->db->update($this->tableNameProposal, $insertField);

            }

            

        } catch(Exception $e) {

            return false;

        }

    }



    public function insertProposalWorksheet($insertField, $pw_id=null) {

        try {

            if ($pw_id) {

                $this->db->where('pw_id', $pw_id);

                $this->db->update($this->tableNameWorksheet, $insertField);

            } else {

                $id = $this->db->insert($this->tableNameWorksheet,$insertField);

                $insert_id = $this->db->insert_id();

                return $insert_id;

            }

            

        } catch(Exception $e) {

            return false;

        }

    } // end : insertCompany



    public function insertProposalFormat($insertField, $p_id=null) {

        try {

            if ($p_id) {

                $this->db->where('pf_id', $p_id);

                $this->db->update($this->tableNameFormat, $insertField);

            } else {

                $id = $this->db->insert('proposal_format',$insertField);

                $insert_id = $this->db->insert_id();

                return $insert_id;

            }

            

        } catch(Exception $e) {

            return false;

        }

    } // end : insertCompany



    function saveFilter($data) {

        $query=$this->db->insert('saved_filter', $data);

    }



    public function getSavedFilter($select, $where) {

        $getSavedFilter = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableSavedFilter);

            $this->db->where($where); 

            $getSavedFilter = $this->db->get();

            return $getSavedFilter->result_array();

        } catch(Exception $e) {

            return $getSavedFilter;

        }

    } // end : getProposallist



    function getFilterById($postData) {

        $this->db->select('*');

        $this->db->from('saved_filter');

        $this->db->where('filter_id', $postData);  

        

        $getfilterData = $this->db->get();

        return $getfilterData->result_array();

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



    function exportCompany($newColumnString,$where=null) {



        $this->db->select($newColumnString);

        $this->db->from("proposal p");

        $this->db->join("proposal_worksheet pw", "p.p_id = pw.fk_pid", "inner");

        $this->db->join("lead_opportunity lo", "p.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");

        $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");

        $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");

        if(!empty($where)) {

            $this->db->where_in('p.p_id', $where);    

        }

        $this->db->group_by("p.p_id");

        //print_r($this->db->get_compiled_select());exit;

        $CompanyData = $this->db->get();

        return $CompanyData->result_array();

    }



    public function insertGrid($insertFeild) {

        try {

            $id = $this->db->insert($this->tableGrid,$insertFeild);

            $id = $this->db->insert_id();

            return $id;

        } catch(Exception $e) {

            return false;

        }

    }



    public function deleteproposal($p_id) {

        if ($p_id !='' && !empty($p_id)) {

            $this->db->where_in('p_id', $p_id);

            $this->db->delete($this->tableNameProposal);



            $this->db->where_in('fk_pid', $p_id);

            $this->db->delete($this->tableNameWorksheet);



            return true;

        } else {

            return False;

        }

        

    }



    public function getEmailIds($select = '*',$where = array()) {

        $UserData = array();

        try {

            $this->db->select($select);

            $this->db->from("proposal p");

            $this->db->join("lead_opportunity lo", "p.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");

            $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");

            $this->db->join("users_contacts uc", "uc.fk_user_id = u.user_id", "inner");

            $this->db->where('uc.contact_type', 'Email');

            if(!empty($where)) {

                $this->db->where_in('p.p_id',$where);

            }

            //print_r($this->db->get_compiled_select());exit;

            $Data = $this->db->get();

            return $Data->result_array();

        } catch(Exception $e) {

            return $Data ;

        }

    }



    function updateProposal($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableNameProposal, $updateField);

        return $data;

    }



    public function getLeadOpportunityID($where = array()) {

        $UserData = array();

        try {

            $this->db->select('fk_lead_opportunity_id');

            $this->db->from($this->tableNameProposal);

            if(!empty($where)) {

                $this->db->where($where);

            }

            //print_r($this->db->get_compiled_select());exit;

            $Data = $this->db->get();

            $result = $Data->result_array();

            return $result[0]['fk_lead_opportunity_id'];

        } catch(Exception $e) {

            return $Data ;

        }

    }



    function convertLead($updateField = array(),$where) {

        $this->db->where($where);

        $data = $this->db->update($this->tableLeadOpportunity, $updateField);

        return $data;

    }



    function insertWorkSheet($insertField)

    {

         try {

            $id = $this->db->insert($this->tableNameWorksheet,$insertField);

            $insert_id = $this->db->insert_id();

            return $insert_id;

        } catch(Exception $e) {

            return false;

        }

    }

}