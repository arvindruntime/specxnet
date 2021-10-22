<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rfq_model extends CI_Model
{
    protected $tableNameRfq = 'bid';
    protected $tableNameWorksheet = 'bid_worksheet';
    protected $tableNameFormat = 'bid_format bf';
    protected $tableGrid = 'saved_grid';
    protected $tableCompany = 'company_template';
    protected $tableLeadOpportunity = 'lead_opportunity';
    protected $tableUsers = 'users';
    protected $tableSavedFilter = 'saved_filter';
    protected $tableDocument = 'bid_document';

    function __construct()
    {
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

    public function getRfqlist($select = '*', $where = array(), $order = null, $limit = null, $offset = null)
    {
        $proposalData = array();
        try {
            $this->db->select($select);
            $this->db->from("bid b");
            $this->db->join("bid_worksheet bw", "b.b_id = bw.fk_b_id", "inner");
            $this->db->join("lead_opportunity lo", "b.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");
            $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");
            $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");
            $this->db->join('bid_worksheet_item bwi', 'bwi.fk_bw_id = bw.bw_id', 'left');
            if (!empty($where)) {
                $this->db->where($where);
            }
            if (!empty($order)) {
                $this->db->order_by($order);
            }
            if (!empty($limit)) {
                $this->db->limit($limit, $offset);
            }
            $this->db->group_by("b.b_id");
            // print_r($this->db->get_compiled_select());exit;
            $proposalData = $this->db->get();
            return $proposalData->result_array();
        } catch (Exception $e) {
            return $proposalData;
        }
    } // end : getProposallist



    public function getRfqlistCount($select = '*')
    {
        $this->db->select($select);
        $this->db->from($this->tableNameRfq);
        // print_r($this->db->get_compiled_select());exit;
        $proposalData = $this->db->get();
        return $proposalData->result_array();
    }

    public function getRfqworksheet($select = '*', $where = array())
    {
        $proposalData = array();
        try {
            $this->db->select($select);
            $this->db->from("bid_worksheet");
            $this->db->where($where);
            // print_r($this->db->get_compiled_select());exit;
            $proposalData = $this->db->get();
            return $proposalData->result_array();
        } catch (Exception $e) {
            return $proposalData;
        }
    } // end : getProposallist


    public function getItemList($select = '*', $where = array())
    {
        $itemData = array();
        try {
            $this->db->select($select);
            $this->db->from("bid_worksheet bw");
            $this->db->join("bid b", "bw.fk_b_id = b.b_id", "inner");
            //$this->db->join("bid_worksheet_item bwi", "bw.bw_id = bwi.fk_bw_id", "inner");
			if($where!='' && isset($where))
			{
				$this->db->where($where);
			}
            $this->db->where("item_name !='' and id_code !=''");
            // print_r($this->db->get_compiled_select());exit;
            $proposalData = $this->db->get();
            return $proposalData->result_array();
        } catch (Exception $e) {
            return $proposalData;
        }
    } // end : getProposallist



    public function getItemListForAnalysis($select = '*', $where = array())
    {
        $itemData = array();
        try {
            $this->db->select($select);
            $this->db->from("bid_worksheet bw");
            $this->db->join("bid b", "bw.fk_b_id = b.b_id", "inner");
            $this->db->join("bid_worksheet_item bwi", "bwi.fk_bw_id = bw.bw_id", "inner");
            $this->db->where($where);
            $this->db->where("item_name !='' and id_code !=''");
            $this->db->group_by("bw.bw_id");
            //print_r($this->db->get_compiled_select());exit;
            $proposalData = $this->db->get();
            return $proposalData->result_array();
        } catch (Exception $e) {
            return $proposalData;
        }
    } // end : getProposallist

    public function getFormat($select, $where = array())
    {
        $itemData = array();
        try {
            $this->db->select($select);
            $this->db->from($this->tableNameFormat);
            $this->db->where($where);
            // print_r($this->db->get_compiled_select());exit;
            $proposalData = $this->db->get();
            return $proposalData->result_array();
        } catch (Exception $e) {
            return $proposalData;
        }
    }

    public function getSupplierList($select = '*', $where = array())
    {
        $getSupplierList = array();
        try {
            $this->db->select($select);
            $this->db->from("users u");
            $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");
            $this->db->where($where);
            // print_r($this->db->get_compiled_select());exit;
            $getSupplierList = $this->db->get();
            return $getSupplierList->result_array();
        } catch (Exception $e) {
            return $getSupplierList;
        }
    }

    public function getSupplierlists($select = '*', $where = array())
    {
        $getSupplierList = array();
        try {
            $this->db->select($select);
            $this->db->from("users u");
            $this->db->join("users_contacts uc", "u.user_id = uc.fk_user_id", "inner");
            $this->db->where($where);
            // print_r($this->db->get_compiled_select());exit;
            $getSupplierList = $this->db->get();
            return $getSupplierList->result_array();
        } catch (Exception $e) {
            return $getSupplierList;
        }
    }  // end : getProposallist


    public function getRFQSupplierList($select = '*', $where = array())
    {
        $getSupplierList = array();
        try {
            $this->db->select($select);
            $this->db->from("users u");
            $this->db->join("bid_worksheet_item bwi", "u.user_id = bwi.fk_user_id", "inner");
            $this->db->join("bid_worksheet bw", "bw.bw_id = bwi.fk_bw_id", "inner");
            $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");
            $this->db->where($where);
            // print_r($this->db->get_compiled_select());exit;
            $getSupplierList = $this->db->get();
            return $getSupplierList->result_array();
        } catch (Exception $e) {
            return $getSupplierList;
        }
    }

    public function getRFQRebidList($select = '*', $where = array())
    {
        $getSupplierList = array();
        try {
            $this->db->select($select);
            $this->db->from("bid b");
            // $this->db->join("bid_worksheet_item bwi", "u.user_id = bwi.fk_user_id", "inner");
            // $this->db->join("bid_worksheet bw", "bw.bw_id = bwi.fk_bw_id", "inner");
            // $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");
            $this->db->where($where);
            // print_r($this->db->get_compiled_select());exit;
            $getSupplierList = $this->db->get();
            return $getSupplierList->result_array();
        } catch (Exception $e) {
            return $getSupplierList;
        }
    }

    public function getSuppDetail($select, $where)
    {
        $getSalesperson = array();
        try {
            $this->db->select($select);
            $this->db->from("lead_opportunity lo");
            $this->db->join("users u", "lo.fk_user_id = u.user_id", "inner");
            $this->db->where($where);
            $getSalesperson = $this->db->get();
            return $getSalesperson->result_array();
        } catch (Exception $e) {
            return $getSalesperson;
        }
    } // end : getProposallist



    public function getCountOfExistingLead($select = '*', $leadname)
    {
        $getLeadCount = array();
        try {
            $getLeadCount = $this->db->select($select)->from($this->tableNameRfq)->where("title LIKE '%$leadname%'")->get()->result_array();
            //print_r($this->db->get_compiled_select());exit;
            return $getLeadCount;
        } catch (Exception $e) {
            return $getLeadCount;
        }
    } // end : getProposallist


    public function getLeadOpportunityList($select = '*', $leadname)
    {
        $getLeadCount = array();
        try {
            $getLeadCount = $this->db->select($select)->from($this->tableLeadOpportunity)->where("opportunity_title LIKE '%$leadname%'")->get()->result_array();
            //print_r($this->db->get_compiled_select());exit;
            return $getLeadCount;
        } catch (Exception $e) {
            return $getLeadCount;
        }
    } // end : getProposallist


    public function getLeadOpportunities($select = '*', $where = array())
    {
        $proposalData = array();
        try {
            $this->db->select($select);
            $this->db->from('lead_opportunity');
            //$this->db->join('company_template t2', 't1.parent_company_id = t2.company_id', 'left');
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
            $proposalData = $this->db->get();
            return $proposalData->result_array();
        } catch (Exception $e) {
            return $proposalData;
        }
    } // end : getProposallist


    public function getLeadOpportunitiesUsers($select = '*', $where = array())
    {
        $this->db->select($select);
        $this->db->from("bid b");
        $this->db->join("bid_worksheet bw", "b.b_id = bw.fk_b_id", "inner");
        $this->db->join("lead_opportunity lo", "b.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");
        $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");
        $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");
        $this->db->where($where);
        //print_r($this->db->get_compiled_select());exit;
        $CompanyLeadOppData = $this->db->get();
        return $CompanyLeadOppData->result_array();
    } // end : getProposallist


    public function getCompanyLeadOpp($select, $where, $autoC = null)
    {
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



    public function insertRfq($insertField)
    {

        try {

            $id = $this->db->insert($this->tableNameRfq, $insertField);

            $insert_id = $this->db->insert_id();

            return $insert_id;
        } catch (Exception $e) {

            return false;
        }
    } // end : insertCompany



    public function insertmail($insertField)
    {

        try {

            $id = $this->db->insert('bid_item_email', $insertField);

            $insert_id = $this->db->insert_id();

            return $insert_id;
        } catch (Exception $e) {

            return false;
        }
    } // end : insert mail sent



    public function insertIdRfqWorksheet($insertid)
    {

        try {

            $id = $this->db->insert($this->tableNameWorksheet, $insertid);

            $insert_id = $this->db->insert_id();

            return $insert_id;
        } catch (Exception $e) {

            return false;
        }
    } // end : insertCompany



    public function setStatus($insertField, $p_id)
    {

        // print_r($insertField);

        // print_r($p_id);exit;

        try {

            if ($p_id) {

                $this->db->where('b_id', $p_id);

                $this->db->update($this->tableNameRfq, $insertField);
            //  echo $this->db->last_query();die;

                // print_r($this->db->get_compiled_update());exit;

            }
        } catch (Exception $e) {

            return false;
        }
    }



    public function insertRfqWorksheet($insertField, $pw_id = null)
    {

        //print_r($insertField);

        try {

            if ($pw_id) {

                $this->db->where('bw_id', $pw_id);

                $this->db->update($this->tableNameWorksheet, $insertField);

                 //print_r($this->db->get_compiled_update());exit;

            } else {

                $id = $this->db->insert($this->tableNameWorksheet, $insertField);

                 //print_r($this->db->get_compiled_update());exit;

                $insert_id = $this->db->insert_id();

                return $insert_id;
            }
        } catch (Exception $e) {

            return false;
        }
    } // end : insertCompany



    public function insertRfqFormat($insertField, $p_id = null)
    {

        try {

            if ($p_id) {

                $this->db->where('bf_id', $p_id);

                $this->db->update($this->tableNameFormat, $insertField);
            } else {

                $id = $this->db->insert('bid_format', $insertField);

                $insert_id = $this->db->insert_id();

                return $insert_id;
            }
        } catch (Exception $e) {

            return false;
        }
    } // end : insertCompany



    function saveFilter($data)
    {

        $query = $this->db->insert('saved_filter', $data);
    }



    public function getSavedFilter($select, $where)
    {

        $getSavedFilter = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableSavedFilter);

            $this->db->where($where);

            $getSavedFilter = $this->db->get();

            return $getSavedFilter->result_array();
        } catch (Exception $e) {

            return $getSavedFilter;
        }
    } // end : getProposallist



    function getFilterById($postData)
    {

        $this->db->select('*');

        $this->db->from('saved_filter');

        $this->db->where('filter_id', $postData);



        $getfilterData = $this->db->get();

        return $getfilterData->result_array();
    }



    public function getGrid($select = '*', $where = array(), $order = null, $limit = null, $offset = null)
    {

        $CompanyData = array();

        try {

            $this->db->select($select);

            $this->db->from($this->tableGrid);

            if (!empty($where)) {

                $this->db->where($where);
            }



            if (!empty($order)) {

                $this->db->order_by($order);
            }



            if (!empty($limit)) {

                $this->db->limit($limit, $offset);
            }



            $CompanyData = $this->db->get();

            return $CompanyData->result_array();
        } catch (Exception $e) {

            return $CompanyData;
        }
    } // end : Get grid



    function exportCompany($newColumnString, $where = null)
    {



        $this->db->select($newColumnString);

        $this->db->from("bid b");

        $this->db->join("bid_worksheet bw", "b.b_id = bw.fk_b_id", "inner");

        $this->db->join("lead_opportunity lo", "b.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");

        $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");

        $this->db->join("company_template c", "c.company_id = u.fk_company_id", "inner");

        if (!empty($where)) {

            $this->db->where_in('b.b_id', $where);
        }

        $this->db->group_by("b.b_id");

        //print_r($this->db->get_compiled_select());exit;

        $CompanyData = $this->db->get();

        return $CompanyData->result_array();
    }



    public function insertGrid($insertFeild)
    {

        try {

            $id = $this->db->insert($this->tableGrid, $insertFeild);

            $id = $this->db->insert_id();

            return $id;
        } catch (Exception $e) {

            return false;
        }
    }



    public function deleterfq($p_id)
    {

        if ($p_id != '' && !empty($p_id)) {

            $this->db->where_in('b_id', $p_id);

            $this->db->delete($this->tableNameRfq);



            $this->db->where_in('fk_b_id', $p_id);

            $this->db->delete($this->tableNameWorksheet);



            return true;
        } else {

            return False;
        }
    }
    public function deleterfqDoc($id)
    {

        if ($id != '' && !empty($id)) {

            $this->db->where('id', $id);

            $this->db->delete($this->tableDocument);
            //  echo $this->db->last_query();die;

            // print_r($this->db->get_compiled_select());exit;


            return true;
        } else {

            return False;
        }
    }

    public function deleteitem($p_id)
    {

        if ($p_id != '' && !empty($p_id)) {



            $this->db->where_in('bw_id', $p_id);

            $this->db->delete($this->tableNameWorksheet);



            return true;
        } else {

            return False;
        }
    }



    public function getEmailIds($select = '*', $where = array())
    {

        $UserData = array();

        try {

            $this->db->select($select);

            $this->db->from("bid b");

            $this->db->join("lead_opportunity lo", "b.fk_lead_opportunity_id = lo.lead_opportunity_id", "inner");

            $this->db->join("users u", "u.user_id = lo.fk_user_id", "inner");

            $this->db->join("users_contacts uc", "uc.fk_user_id = u.user_id", "inner");

            $this->db->where('uc.contact_type', 'Email');

            if (!empty($where)) {

                $this->db->where_in('b.b_id', $where);
            }

            $Data = $this->db->get();

            return $Data->result_array();
        } catch (Exception $e) {

            return $Data;
        }
    }



    function updateRFQ($updateField = array(), $where)
    {
        $this->db->where($where);
        $data = $this->db->update($this->tableNameRfq, $updateField);
            // echo $this->db->last_query();die;

        return $data;
    }



    public function getItemBidPrice($fk_bw_id, $fk_user_id = null, $version = 0)

    {

        $this->db->select("bw.*, bwi.*, u.full_name, c.company_name");

        $this->db->from("bid_worksheet_item as bwi");

        $this->db->join("bid_worksheet bw", "bw.bw_id = bwi.fk_bw_id", "inner");

        $this->db->join("users u", "bwi.fk_user_id = u.user_id", "inner");

        $this->db->join("company_template c", "u.fk_company_id = c.company_id", "inner");

        $this->db->where('fk_bw_id', $fk_bw_id);

        $this->db->where('version', $version);

        if ($fk_user_id) {

            $this->db->where('fk_user_id', $fk_user_id);
        }

        //print_r($this->db->get_compiled_select());exit;

        $Data = $this->db->get();

        return $Data->result_array();
    }

    public function getItemBid($fk_bw_id, $fk_user_id = null, $version = 0)

    {

        $this->db->select("bw.*, bwi.*");

        $this->db->from("bid_worksheet_item as bwi");

        $this->db->join("bid_worksheet bw", "bw.bw_id = bwi.fk_bw_id");

        $this->db->where('fk_bw_id', $fk_bw_id);

        if ($fk_user_id) {

            $this->db->where('fk_user_id', $fk_user_id);
        }

        //print_r($this->db->get_compiled_select());exit;

        $Data = $this->db->get();

        return $Data->result_array();
    }


    public function deleteRFQDelete($fk_bw_id, $fk_user_id)
    {

        $this->db->where('fk_bw_id', $fk_bw_id);

        $this->db->where('fk_user_id', $fk_user_id);

        $this->db->delete('bid_worksheet_item');
    }



    public function insertRfqBidPrice($insertField)
    {

        try {

            $id = $this->db->insert('bid_worksheet_item', $insertField);

            $insert_id = $this->db->insert_id();

            return $insert_id;
        } catch (Exception $e) {

            return false;
        }
    } // end : rfq bid price



    public function updateRfqBidPrice($id, $updateField)
    {

        try {

            $this->db->where('bwi_id', $id);

            $this->db->update('bid_worksheet_item', $updateField);
        } catch (Exception $e) {

            return false;
        }
    } // end : rfq bid price



    function exportRfqItem($newColumnString, $where = null)
    {



        $this->db->select($newColumnString);

        $this->db->from($this->tableNameWorksheet);

        if (!empty($where)) {

            $this->db->where($where);
        }

        //print_r($this->db->get_compiled_select());exit;

        $ItemData = $this->db->get();

        return $ItemData->result_array();
    }



    public function getUserRole($user_id = null)

    {

        $this->db->select("u.fk_role_id, r.role_name");

        $this->db->from("users u");

        $this->db->join("roles r", "u.fk_role_id = r.role_id", "inner");

        $this->db->where('u.user_id', $user_id);

        //print_r($this->db->get_compiled_select());exit;

        $Data = $this->db->get();

        $resultData = $Data->result_array();

        return $resultData[0];
    }



    public function getMarkupValue($bw_id = null)

    {

        $this->db->select("b.markup_type, b.markup_type_value_ex_factory, b.markup_type_value_fabric, b.markup_type_value_leather");

        $this->db->from("bid_worksheet bw");

        $this->db->join("bid b", "bw.fk_b_id = b.b_id", "inner");

        $this->db->where('bw.bw_id', $bw_id);

        // print_r($this->db->get_compiled_select());exit;

        $Data = $this->db->get();

        $resultData = $Data->result_array();

        return $resultData[0];
    }



    function getRFQDetails($where = array())
    {



        $this->db->select('*');

        $this->db->from($this->tableNameRfq);

        if (!empty($where)) {

            $this->db->where($where);
        }

        //print_r($this->db->get_compiled_select());exit;

        $ItemData = $this->db->get();

        $result = $ItemData->result_array();

        return $result;
    }



    public function getRFQBidUserList($where = array())

    {

        $this->db->select("bwi.fk_user_id");

        $this->db->from("bid_worksheet_item bwi");

        $this->db->join("bid_worksheet bw", "bwi.fk_bw_id = bw.bw_id", "inner");

        $this->db->join("bid b", "bwi.fk_bw_id = bw.bw_id", "inner");

        if (!empty($where)) {

            $this->db->where($where);
        }

        $this->db->group_by('bwi.fk_user_id');

        // print_r($this->db->get_compiled_select());exit;

        $Data = $this->db->get();

        return $Data->result_array();
    }



    public function getRFQBidList($where = array())

    {

        $this->db->select("update_at, u.full_name, c.company_name, SUM(bwi.ex_factory_unit_price * bwi.ex_factory_quantity) as totalBid");

        $this->db->from("bid_worksheet_item bwi");

        $this->db->join("bid_worksheet bw", "bwi.fk_bw_id = bw.bw_id", "inner");

        $this->db->join("bid b", "bwi.fk_bw_id = bw.bw_id", "inner");

        $this->db->join("users u", "bwi.fk_user_id = u.user_id", "inner");

        $this->db->join("company_template c", "u.fk_company_id = c.company_id", "inner");

        if (!empty($where)) {

            $this->db->where($where);
        }

        //print_r($this->db->get_compiled_select());exit;

        $Data = $this->db->get();

        $resultData = $Data->result_array();

        return $resultData[0];
    }



    public function getOnlyRFQDetails($where = array())
    {

        try {

            $this->db->select('*');

            $this->db->from($this->tableNameRfq);

            if (!empty($where)) {

                $this->db->where($where);
            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data['result'] = $getPath->result_array();

            $data['count'] = $getPath->num_rows();

            return $data;
        } catch (Exception $e) {

            return $getPath;
        }
    }


    public function getRFQDoc($where = array())
    {

        try {

            $this->db->select('*');

            $this->db->from($this->tableDocument);

            if (!empty($where)) {

                $this->db->where($where);
            }



            // print_r($this->db->get_compiled_select());exit;

            $getPath = $this->db->get();

            $data['result'] = $getPath->result_array();

            // $data['count'] = $getPath->num_rows();

            return $data;
        } catch (Exception $e) {

            return $getPath;
        }
    }

    public function bidDocumentUpload($insertField)
    {

        try {

            $id = $this->db->insert('bid_document', $insertField);

            // print_r($this->db->get_compiled_update());exit;
            $insert_id = $this->db->insert_id();


            return $insert_id;
        } catch (Exception $e) {

            return false;
        }
    }



    public function dublicateBid($rfq, $version)

    {


        $this->db->select('b.*');

        $this->db->from('bid b');

        $this->db->where("b.b_id", $rfq);

        $this->db->where("b.version", $version);

        $obj = $this->db->get();

        $result = $obj->result_array();

        foreach ($result as $key => $value) {

            unset($value['b_id']);
            $value['parent_bid_id'] = $rfq;
            $value['version'] += 1;
            // echo "<pre>"; print_r($value);exit();
            $this->db->insert('bid', $value);
            $insert_B_id = $this->db->insert_id();

            // echo $this->db->last_query();die;
        }


        $this->db->select('bw.*');

        $this->db->from('bid_worksheet bw');

        $this->db->where("bw.fk_b_id", $rfq);

        $obj = $this->db->get();
        // echo $this->db->last_query();die;

        $result = $obj->result_array();

        foreach ($result as $key => $value) {

            unset($value['bw_id']);

            $value['fk_b_id'] = $insert_B_id;

            $this->db->insert('bid_worksheet', $value);
            $insert_Bw_id = $this->db->insert_id();

        }
        return  $insert_B_id;
    }

    public function dublicateBWI($rfq, $version)

    {


        $this->db->select('b.*');

        $this->db->from('bid b');

        $this->db->where("b.b_id", $rfq);

        $this->db->where("b.version", $version);

        $obj = $this->db->get();

        $result = $obj->result_array();

        foreach ($result as $key => $value) {

            unset($value['b_id']);
            $value['parent_bid_id'] = $rfq;
            $value['version'] += 1;
            // echo "<pre>"; print_r($value);exit();
            $this->db->insert('bid', $value);
            $insert_B_id = $this->db->insert_id();

            // echo $this->db->last_query();die;
        }


        $this->db->select('bw.*');

        $this->db->from('bid_worksheet bw');

        $this->db->where("bw.fk_b_id", $rfq);

        $obj = $this->db->get();
        // echo $this->db->last_query();die;

        $result = $obj->result_array();

        foreach ($result as $key => $value) {

            unset($value['bw_id']);

            $value['fk_b_id'] = $insert_B_id;

            $this->db->insert('bid_worksheet', $value);
            $insert_Bw_id = $this->db->insert_id();

        }
        return  $insert_B_id;
    }



    public function getLatestVersion($rfq)

    {

        $this->db->select('version');

        $this->db->from('bid b');

        $this->db->where("b.b_id", $rfq);

        $this->db->order_by('version', 'DESC');

        $obj = $this->db->get();

        $result = $obj->row_array();

        return $result['version'];
    }



    public function getItemBidItemPrice($fkbID, $version)

    {

        $this->db->select("bw.*, bwi.*, u.full_name, c.company_name");

        $this->db->from("bid_worksheet_item as bwi");

        $this->db->join("bid_worksheet bw", "bw.bw_id = bwi.fk_bw_id", "inner");

        $this->db->join("users u", "bwi.fk_user_id = u.user_id", "inner");

        $this->db->join("company_template c", "u.fk_company_id = c.company_id", "inner");

        $this->db->where_in('bwi_id', $fkbID);

        $this->db->where('version', $version);

        $Data = $this->db->get();

        return $Data->result_array();
    }



    public function updateLeadToJob($p_id)

    {

        $this->db->where('lead_opportunity_id', $p_id);

        $this->db->update('lead_opportunity', ['job_status' => 'converted']);
    }
}
