<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    /**
    * Login Page for this controller.
    *
    * Maps to the following URL
    *      http://DomainName/dashboard
    *
    * @author Sagar Kodalkar
    */

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if (!isset($user_id) || $user_id=='') {
            $this->session->sess_destroy();
            redirect('login');
            exit;
        }

        $this->load->model(array('Login_model' => 'loginModel'));
        $this->load->model(array('User_model' => 'userModel'));
        $this->load->model(array('Company_model' => 'companyMondel'));
        $this->load->model(array('Activity_model' => 'leadActivityModel'));
        $this->load->model(array('Lead_model' => 'leadOpportunityModel'));
        $this->load->library(array('Permissions_library' => 'permission'));

    }

    /**
    * index action of Dashboard controller
    * @author Sagar Kodalkar
    * @param
    */

    public function index($module_name = null, $parameter = null)
    {
        $this->page->setHeadStyle(base_url()."assets/demo/default/base/style-2.css");
        $this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");
        $this->page->setFooterJs(base_url()."assets/custom/js/custom.js");
        $select1 = 'last_login';
        $where1= array('user_id'=> $this->session->userdata('user_id'));
        $data['last_login'] = $this->userModel->getUserData($select1,$where1);
        //------ Leads Created Vs Completed -------------------------
        $selectLead = "str_created_date";
        $whereLead = array('status' => 'Completed');
        $completed = $this->leadOpportunityModel->getLeadOpportunityStatusCount($selectLead,$whereLead);
        $jan = 0;$feb = 0;$mar = 0;$apr = 0;$may = 0;$jun = 0;$jul = 0;$aug = 0;$sep = 0;$oct = 0;
        $nov = 0;$dec = 0;
        foreach ($completed as $completedkey => $completedvalue) {
            //print_r($completedvalue);exit;
            $year  = date('Y',$completedvalue['str_created_date']);
            if ($year == '2019') {
                $month  = date('m',$completedvalue['str_created_date']);
                if ($month == '01') {
                    $jan++;
                }
                if ($month == '02') {
                    $feb++;
                }
                if ($month == '03') {
                    $mar++;
                }
                if ($month == '04') {
                    $apr++;
                }
                if ($month == '05') {
                    $may++;
                }
                if ($month == '06') {
                    $jun++;
                }
                if ($month == '07') {
                    $jul++;
                }
                if ($month == '08') {
                    $aug++;
                }
                if ($month == '09') {
                    $sep++;
                }
                if ($month == '10') {
                    $oct++;
                }
                if ($month == '11') {
                    $nov++;
                }
                if ($month == '12') {
                    $dec++;
                }
            }
            //echo $year;echo "<br/>";
        }

        $selectLead = "str_created_date";
        $whereLead = array('status !=' => 'Completed');
        $completed = $this->leadOpportunityModel->getLeadOpportunityStatusCount($selectLead,$whereLead);
        $jan1 = 0;$feb1 = 0;$mar1 = 0;$apr1 = 0;$may1 = 0;$jun1 = 0;$jul1 = 0;$aug1 = 0;$sep1 = 0;$oct1 = 0;
        $nov1 = 0;$dec1 = 0;
        foreach ($completed as $completedkey => $completedvalue) {
            //print_r($completedvalue);exit;
            $year  = date('Y',$completedvalue['str_created_date']);
            if ($year == '2019') {
                $month  = date('m',$completedvalue['str_created_date']);
                if ($month == '01') {
                    $jan1++;
                }
                if ($month == '02') {
                    $feb1++;
                }
                if ($month == '03') {
                    $mar1++;
                }
                if ($month == '04') {
                    $apr1++;
                }
                if ($month == '05') {
                    $may1++;
                }
                if ($month == '06') {
                    $jun1++;
                }
                if ($month == '07') {
                    $jul1++;
                }
                if ($month == '08') {
                    $aug1++;
                }
                if ($month == '09') {
                    $sep1++;
                }
                if ($month == '10') {
                    $oct1++;
                }
                if ($month == '11') {
                    $nov1++;
                }
                if ($month == '12') {
                    $dec1++;
                }
            }
            //echo $year;echo "<br/>";
        }

        $ar = array(
            array('day' => 'Jan', 'created'=>$jan, 'completed' => $jan1),
            array('day' => 'Feb', 'created'=>$feb, 'completed' => $feb1),
            array('day' => 'Mar', 'created'=>$mar, 'completed' => $mar1),
            array('day' => 'Apr', 'created'=>$apr, 'completed' => $apr1),
            array('day' => 'May', 'created'=>$may, 'completed' => $may1),
            array('day' => 'Jun', 'created'=>$jun, 'completed' => $jun1),
            array('day' => 'Jul', 'created'=>$jul, 'completed' => $jul1),
            array('day' => 'Aug', 'created'=>$aug, 'completed' => $aug1),
            array('day' => 'Sep', 'created'=>$sep, 'completed' => $sep1),
            array('day' => 'Oct', 'created'=>$oct, 'completed' => $oct1),
            array('day' => 'Nov', 'created'=>$nov, 'completed' => $nov1),
            array('day' => 'Dec', 'created'=>$dec, 'completed' => $dec1)
        );

        $data['leadCompanrison'] = json_encode($ar);

        //------- Client Count ---------
        $selectLead = "count(u1.user_id) as client_count, u.full_name, u.user_id";
        $whereLead = array('u1.user_type' => 'Customer');
        $group_by = 'u1.created_by';
        $data['clientCount'] = $this->leadOpportunityModel->getClientCountByUSer($selectLead,$whereLead,$group_by);
        //------ Client Count End ---------


        //--------- Lead Opportunity --------------
        $selectLead = "count(lo.lead_opportunity_id) as lead_count, u.full_name, u.user_id";
        $whereLead = array();
        $group_by = 'lo.created_by';
        $data['leadCount'] = $this->leadOpportunityModel->getLeadCountByUSer($selectLead,$whereLead,$group_by);
        $selectSalesPerson = "u1.user_id as sales_people_id, u1.full_name, u1.user_id";
        $whereSalesPerson = array('r.role_name' => 'Sales Person');
        $data['salesPerson'] = $this->leadOpportunityModel->getSalesPersons($selectSalesPerson, $whereSalesPerson);
        //------- Lead Opportunity End --------------



        //---------- Lead Activity -------------
        $selectActivity = "t1.*, GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info, CONCAT(u4.full_name, ' (', c.company_name, ')') as client_name";
        $whereActivity = array('t1.activity_date' => date('d-m-Y'), 't1.created_by' => $this->session->userdata('user_id'));
        $activityList = $this->leadActivityModel->getActivity($selectActivity,$whereActivity);
        foreach ($activityList as $key => $value) {
            $userInfo = explode(",", $value['user_info']);
            $activityList[$key]['phone'] = '---';
            $activityList[$key]['email'] = '---';
            if(isset($userInfo)){
                foreach ($userInfo as $userkey => $uservalue) {
                    $userData = explode('_', $uservalue);
                    if (!empty($userData)){
                        if ( ! isset($userData[1])) {
                            $userData[1] = "--";
                        }
                        if($userData[1] == 'Phone'){
                            $activityList[$key]['phone'] = $userData[0];
                        } else if ($userData[1] == 'Email'){
                            $activityList[$key]['email'] = $userData[0];
                        }
                    }
                }
            }
        }

        $data['activities'] = $activityList;
        $selectActivityCount = "count(la.activity_type) as activity_type_count,la.activity_type";
        $whereActivityCount = array();
        $group_by = 'la.activity_type';
        $activityList = $this->leadActivityModel->getActivityCountByUSer($selectActivityCount,$whereActivityCount,$group_by);
        $composeEmail = 0;
        $phoneCall = 0;
        $scheduleMeeting = 0;
        $cTask = 0;
        foreach ($activityList as $actkey => $actvalue) {
            // $newlist[] = array($actvalue['activity_type'], $actvalue['activity_type_count']);
            if ($actvalue['activity_type'] == 'Compose Email') {
                $composeEmail = $actvalue['activity_type_count'];
            } else if ($actvalue['activity_type'] == 'Phone Call') {
                $phoneCall = $actvalue['activity_type_count'];
            } else if ($actvalue['activity_type'] == 'Schedule Meeting') {
                $scheduleMeeting = $actvalue['activity_type_count'];
            } else if ($actvalue['activity_type'] == 'Create Task') {
                $cTask = $actvalue['activity_type_count'];
            }
        }
        $arr = array('composeEmail' => $composeEmail, 'phoneCall' => $phoneCall, 'sMeeting' => $scheduleMeeting, 'cTask' => $cTask);
        $data['activityCountList'] = $arr;

        //-------- Activity Performed --------------
        $selectActivityStatusCount = "count(status) as activity_status,status";
        $whereActivityStatusCount = array();
        $status_group_by = 'status';
        $activityStatusList = $this->leadActivityModel->getActivityStatusCount($selectActivityStatusCount,$whereActivityStatusCount,$status_group_by);
        $complete = 0;
        $pending = 0;
        $past_due = 0;
        $not_complete = 0;
        foreach ($activityStatusList as $actkey => $actvalue) {
            // $newlist[] = array($actvalue['activity_type'], $actvalue['activity_type_count']);
            if ($actvalue['status'] == 'Not Complete') {
                $not_complete = $actvalue['activity_status'];
            } else if ($actvalue['status'] == 'Past Due') {
                $past_due = $actvalue['activity_status'];
            } else if ($actvalue['status'] == 'Pending') {
                $pending = $actvalue['activity_status'];
            } else if ($actvalue['status'] == 'Complete') {
                $complete = $actvalue['activity_status'];
            }
        }
        $arr2 = array('not_complete' => $not_complete, 'past_due' => $past_due, 'pending' => $pending, 'complete' => $complete);
        $data['activityStatusCountList'] = $arr2;

        //---------- Lead Activity End ------------
        $this->load->view('pages/dashboard', $data);

    }



    public function get($module_name = null, $parameter = null, $parameter2 = null)

    {

        $this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");

        $this->page->setFooterJs(base_url()."assets/custom/js/custom.js");



        $selectSalesPerson = "u1.user_id as sales_people_id, u1.full_name";

        $whereSalesPerson = array('r.role_name' => 'Sales Person');

        $data['salesPerson'] = $this->leadOpportunityModel->getSalesPersons($selectSalesPerson, $whereSalesPerson);



        $select1 = 'last_login';

        $where1= array('user_id'=> $this->session->userdata('user_id'));

        $data['last_login'] = $this->userModel->getUserData($select1,$where1);



        //--------------------------Leads Created Vs Completed-----------------------------------------------------------------

        $setYear = date('Y');

        if ($module_name == 'compare') {

            $setYear = $parameter;

            $data['comparison_parameter'] = $parameter;

        }

        $selectLead = "str_created_date";

        $whereLead = array('status' => 'Completed');

        $completed = $this->leadOpportunityModel->getLeadOpportunityStatusCount($selectLead,$whereLead);

        $jan = 0;$feb = 0;$mar = 0;$apr = 0;$may = 0;$jun = 0;$jul = 0;$aug = 0;$sep = 0;$oct = 0;

        $nov = 0;$dec = 0;

        foreach ($completed as $completedkey => $completedvalue) {

            //print_r($completedvalue);exit;

            $year  = date('Y',$completedvalue['str_created_date']);

            if ($year == $setYear) {

                $month  = date('m',$completedvalue['str_created_date']);

                if ($month == '01') {

                    $jan++;

                }

                if ($month == '02') {

                    $feb++;

                }

                if ($month == '03') {

                    $mar++;

                }

                if ($month == '04') {

                    $apr++;

                }

                if ($month == '05') {

                    $may++;

                }

                if ($month == '06') {

                    $jun++;

                }

                if ($month == '07') {

                    $jul++;

                }

                if ($month == '08') {

                    $aug++;

                }

                if ($month == '09') {

                    $sep++;

                }

                if ($month == '10') {

                    $oct++;

                }

                if ($month == '11') {

                    $nov++;

                }

                if ($month == '12') {

                    $dec++;

                }



            }



            //echo $year;echo "<br/>";

        }



        $selectLead = "str_created_date";

        $whereLead = array('status !=' => 'Completed');

        $completed = $this->leadOpportunityModel->getLeadOpportunityStatusCount($selectLead,$whereLead);

        $jan1 = 0;$feb1 = 0;$mar1 = 0;$apr1 = 0;$may1 = 0;$jun1 = 0;$jul1 = 0;$aug1 = 0;$sep1 = 0;$oct1 = 0;

        $nov1 = 0;$dec1 = 0;

        foreach ($completed as $completedkey => $completedvalue) {

            //print_r($completedvalue);exit;

            $year  = date('Y',$completedvalue['str_created_date']);

            if ($year == '2019') {

                $month  = date('m',$completedvalue['str_created_date']);

                if ($month == '01') {

                    $jan1++;

                }

                if ($month == '02') {

                    $feb1++;

                }

                if ($month == '03') {

                    $mar1++;

                }

                if ($month == '04') {

                    $apr1++;

                }

                if ($month == '05') {

                    $may1++;

                }

                if ($month == '06') {

                    $jun1++;

                }

                if ($month == '07') {

                    $jul1++;

                }

                if ($month == '08') {

                    $aug1++;

                }

                if ($month == '09') {

                    $sep1++;

                }

                if ($month == '10') {

                    $oct1++;

                }

                if ($month == '11') {

                    $nov1++;

                }

                if ($month == '12') {

                    $dec1++;

                }



            }



            //echo $year;echo "<br/>";

        }



        $ar = array(

            array('day' => 'Jan', 'created'=>$jan, 'completed' => $jan1),

            array('day' => 'Feb', 'created'=>$feb, 'completed' => $feb1),

            array('day' => 'Mar', 'created'=>$mar, 'completed' => $mar1),

            array('day' => 'Apr', 'created'=>$apr, 'completed' => $apr1),

            array('day' => 'May', 'created'=>$may, 'completed' => $may1),

            array('day' => 'Jun', 'created'=>$jun, 'completed' => $jun1),

            array('day' => 'Jul', 'created'=>$jul, 'completed' => $jul1),

            array('day' => 'Aug', 'created'=>$aug, 'completed' => $aug1),

            array('day' => 'Sep', 'created'=>$sep, 'completed' => $sep1),

            array('day' => 'Oct', 'created'=>$oct, 'completed' => $oct1),

            array('day' => 'Nov', 'created'=>$nov, 'completed' => $nov1),

            array('day' => 'Dec', 'created'=>$dec, 'completed' => $dec1)

        );

        $data['leadCompanrison'] = json_encode($ar);



        //--------------------------Client Count End-------------------------------------------------------------



        date_default_timezone_set('Asia/Kolkata');

        if (date('D')!='Mon')

        {

            //take the last monday

            $staticstart = date('d-m-Y',strtotime('last Monday'));



        } else {

            $staticstart = date('d-m-Y');

        }

        //always next saturday

        if (date('D')!='Sat')

        {

            $staticfinish = date('d-m-Y',strtotime('next Saturday'));

        } else {



            $staticfinish = date('d-m-Y');

        }



        //------------------------------------------------------Client Data--------------------------------------------------------------------------------

        $selectLead = "count(u1.user_id) as client_count, u.full_name, u.user_id";

        $whereLead = array();

        $group_by = 'u1.created_by';

        $data['clientCount'] = $this->leadOpportunityModel->getClientCountByUSer($selectLead,$whereLead,$group_by);

        // echo $parameter;exit;

        if ($module_name == 'client') {

            $selectLead = "count(u1.user_id) as client_count, u.full_name, u.user_id";

            if ($parameter == 'yesterday') {

                $datetime = new DateTime('yesterday');

                $tomorrow = $datetime->format('d-m-Y');

                $whereLead = array('u1.str_created_date' => strtotime($tomorrow), 'u1.user_type' => 'Customer');

                $group_by = 'u1.created_by';

            } else if ($parameter == 'this_week') {

                $whereLead = array('u1.str_created_date >=' => strtotime($staticstart), 'u1.str_created_date <=' => strtotime($staticfinish), 'u1.user_type' => 'Customer');

                $group_by = 'u1.created_by';

            } else if ($parameter == 'this_month') {

                $first_day_this_month = strtotime(date('01-m-Y'));

                $last_day_this_month  = strtotime(date('t-m-Y'));

                $whereLead = array('u1.str_created_date >=' => $first_day_this_month, 'u1.str_created_date <=' => $last_day_this_month, 'u1.user_type' => 'Customer');

                $group_by = 'u1.created_by';

            } else if ($parameter == 'today') {

                $whereLead = array('u1.str_created_date' => strtotime(date('d-m-Y')), 'u1.user_type' => 'Customer');

                $group_by = 'u1.created_by';

            } else {

                $whereLead = array('u1.user_type' => 'Customer');

                $group_by = 'u1.created_by';

            }



            $data['clientCount_parameter'] = $parameter;

            $data['clientCount'] = $this->leadOpportunityModel->getClientCountByUSer($selectLead,$whereLead,$group_by);



            // print_r($data['leadCount']);exit;

        }

        //------------------------------------------------------Client Data End--------------------------------------------------------------------------------



        //------------------------------------------------------Lead Opportunity--------------------------------------------------------------------------------

        $selectLead = "count(lo.lead_opportunity_id) as lead_count, u.full_name, u.user_id";

        $whereLead = array();

        $group_by = 'lo.created_by';

        $data['leadCount'] = $this->leadOpportunityModel->getLeadCountByUSer($selectLead,$whereLead,$group_by);



        if ($module_name == 'lead') {

            $selectLead = "count(lo.lead_opportunity_id) as lead_count, u.full_name, u.user_id";

            if ($parameter == 'yesterday') {

                $datetime = new DateTime('yesterday');

                $tomorrow = $datetime->format('d-m-Y');

                $whereLead = array('lo.str_created_date' => strtotime($tomorrow));

                $group_by = 'lo.created_by';

            } else if ($parameter == 'this_week') {

                $whereLead = array('lo.str_created_date >=' => strtotime($staticstart), 'lo.str_created_date <=' => strtotime($staticfinish));

                $group_by = 'lo.created_by';

            } else if ($parameter == 'this_month') {

                $first_day_this_month = strtotime(date('01-m-Y'));

                $last_day_this_month  = strtotime(date('t-m-Y'));

                $whereLead = array('lo.str_created_date >=' => $first_day_this_month, 'lo.str_created_date <=' => $last_day_this_month);

                $group_by = 'lo.created_by';

            } else if ($parameter == 'today') {

                $whereLead = array('lo.str_created_date' => strtotime(date('d-m-Y')));

                $group_by = 'lo.created_by';

            } else {

                $whereLead = array();

                $group_by = 'lo.created_by';

            }



            $data['leadCount_parameter'] = $parameter;

            $data['leadCount'] = $this->leadOpportunityModel->getLeadCountByUSer($selectLead,$whereLead,$group_by);



            // print_r($data['leadCount']);exit;

        }

        //------------------------------------------------------Lead Opportunity End--------------------------------------------------------------------------------





        //------------------------------------------------------Lead Activity--------------------------------------------------------------------------------

        if ($module_name == 'activities') {

            $selectActivity = "t1.*, GROUP_CONCAT(CONCAT(uc.contact_info,'_',uc.contact_type)) as user_info, CONCAT(u4.full_name, ' (', c.company_name, ')') as client_name";

            if ($parameter == 'tomorrow') {

                $datetime = new DateTime('tomorrow');

                $tomorrow = $datetime->format('d-m-Y');

                $whereActivity = array('t1.activity_date' => $tomorrow, 't1.created_by' => $this->session->userdata('user_id'));

            } else if ($parameter == 'this_week') {

                $whereActivity = array('t1.created_by' => $this->session->userdata('user_id'));

            } else {

                $whereActivity = array('t1.activity_date' => date('d-m-Y'), 't1.created_by' => $this->session->userdata('user_id'));

            }



            $data['activityParameter'] = $parameter;

            $activityList = $this->leadActivityModel->getActivity($selectActivity,$whereActivity);



            foreach ($activityList as $key => $value) {

                if ($parameter == 'this_week') {

                    if ((strtotime($staticstart) <= strtotime($value['activity_date'])) || (strtotime($value['activity_date']) <= strtotime($staticfinish))) {

                        $userInfo = explode(",", $value['user_info']);

                        $activityList[$key]['phone'] = '---';

                        $activityList[$key]['email'] = '---';

                        if(isset($userInfo)){

                            foreach ($userInfo as $userkey => $uservalue) {

                                $userData = explode('_', $uservalue);

                                if (!empty($userData)){

                                    if ( ! isset($userData[1])) {

                                        $userData[1] = "--";

                                    }

                                    if($userData[1] == 'Phone'){

                                        $activityList[$key]['phone'] = $userData[0];

                                    }else if ($userData[1] == 'Email'){

                                        $activityList[$key]['email'] = $userData[0];

                                    }

                                }

                            }

                        }

                    }

                } else {

                    $userInfo = explode(",", $value['user_info']);

                    $activityList[$key]['phone'] = '---';

                    $activityList[$key]['email'] = '---';

                    if(isset($userInfo)){

                        foreach ($userInfo as $userkey => $uservalue) {

                            $userData = explode('_', $uservalue);

                            if (!empty($userData)){

                                if ( ! isset($userData[1])) {

                                    $userData[1] = "--";

                                }

                                if($userData[1] == 'Phone'){

                                    $activityList[$key]['phone'] = $userData[0];

                                }else if ($userData[1] == 'Email'){

                                    $activityList[$key]['email'] = $userData[0];

                                }

                            }

                        }

                    }

                }

            }

            $data['activities'] = $activityList;

        }

        //--------------------------------------Activity Performed----------------------------------------

        if ($module_name == 'activity') {

            if ($parameter == 'yesterday') {

                $datetime = new DateTime('yesterday');

                $tomorrow = $datetime->format('d-m-Y');

                if ($parameter2 == 'all') {

                    $whereActivityCount = array('la.str_created_date' => strtotime($tomorrow));

                } else {

                    $whereActivityCount = array('la.str_created_date' => strtotime($tomorrow), 'la.created_by' => $parameter2);

                }

            } else if ($parameter == 'this_week') {

                if ($parameter2 == 'all') {

                    $whereActivityCount = array('la.str_created_date >=' => strtotime($staticstart), 'la.str_created_date <=' => strtotime($staticfinish));

                } else {

                    $whereActivityCount = array('la.str_created_date >=' => strtotime($staticstart), 'la.str_created_date <=' => strtotime($staticfinish), 'la.created_by' => $parameter2);

                }

            } else if ($parameter == 'this_month') {

                $first_day_this_month = strtotime(date('01-m-Y'));

                $last_day_this_month  = strtotime(date('t-m-Y'));



                if ($parameter2 == 'all') {

                    $whereActivityCount = array('la.str_created_date >=' => $first_day_this_month, 'la.str_created_date <=' => $last_day_this_month);

                } else {

                    $whereActivityCount = array('la.str_created_date >=' => $first_day_this_month, 'la.str_created_date <=' => $last_day_this_month, 'la.created_by' => $parameter2);

                }

            } else if ($parameter == 'today') {

                if ($parameter2 == 'all') {

                    $whereActivityCount = array('la.str_created_date' => strtotime(date('d-m-Y')));

                } else {

                    $whereActivityCount = array('la.str_created_date' => strtotime(date('d-m-Y')), 'la.created_by' => $parameter2);

                }

            } else {

                $whereActivityCount = array();

                if ($parameter2 == 'all') {

                    $whereActivityCount = array();

                } else {

                    $whereActivityCount = array('la.created_by' => $parameter2);

                }

            }



            $selectActivityCount = "count(la.activity_type) as activity_type_count,la.activity_type";

            $group_by = 'la.activity_type';

            $activityList = $this->leadActivityModel->getActivityCountByUSer($selectActivityCount,$whereActivityCount,$group_by);

            //$newlist[] = array('Task', 'Activity Performed');



            //print_r($activityList);exit;

            $composeEmail = 0;

            $phoneCall = 0;

            $scheduleMeeting = 0;

            $cTask = 0;



            foreach ($activityList as $actkey => $actvalue) {

                // $newlist[] = array($actvalue['activity_type'], $actvalue['activity_type_count']);

                if ($actvalue['activity_type'] == 'Compose Email') {

                    $composeEmail = $actvalue['activity_type_count'];

                } else if ($actvalue['activity_type'] == 'Phone Call') {

                    $phoneCall = $actvalue['activity_type_count'];

                } else if ($actvalue['activity_type'] == 'Schedule Meeting') {

                    $scheduleMeeting = $actvalue['activity_type_count'];

                } else if ($actvalue['activity_type'] == 'Create Task') {

                    $cTask = $actvalue['activity_type_count'];

                }

            }



            if ($composeEmail == 0 && $phoneCall == 0 && $scheduleMeeting == 0 && $cTask == 0) {

                $data['noData'] = 'No Data Available';

            }



            $arr = array('composeEmail' => $composeEmail, 'phoneCall' => $phoneCall, 'sMeeting' => $scheduleMeeting, 'cTask' => $cTask);

            $data['activityCountList'] = $arr;

            $data['activityCount_parameter'] = $parameter;

            $data['activityUser_parameter'] = $parameter2;

        } else {

            $selectActivityCount = "count(la.activity_type) as activity_type_count,la.activity_type";

            $whereActivityCount = array();

            $group_by = 'la.activity_type';

            $activityList = $this->leadActivityModel->getActivityCountByUSer($selectActivityCount,$whereActivityCount,$group_by);



            $composeEmail = 0;

            $phoneCall = 0;

            $scheduleMeeting = 0;

            $cTask = 0;

            foreach ($activityList as $actkey => $actvalue) {

                // $newlist[] = array($actvalue['activity_type'], $actvalue['activity_type_count']);

                if ($actvalue['activity_type'] == 'Compose Email') {

                    $composeEmail = $actvalue['activity_type_count'];

                } else if ($actvalue['activity_type'] == 'Phone Call') {

                    $phoneCall = $actvalue['activity_type_count'];

                } else if ($actvalue['activity_type'] == 'Schedule Meeting') {

                    $scheduleMeeting = $actvalue['activity_type_count'];

                } else if ($actvalue['activity_type'] == 'Create Task') {

                    $cTask = $actvalue['activity_type_count'];

                }

            }





            $arr = array('composeEmail' => $composeEmail, 'phoneCall' => $phoneCall, 'sMeeting' => $scheduleMeeting, 'cTask' => $cTask);



            $data['activityCountList'] = $arr;

        }



        //-----------------------Activity Status-----------------------------------------



        if ($module_name == 'activityStatus') {

            $selectActivityStatusCount = "count(status) as activity_status,status";

            $whereActivityStatusCount = array('created_by' => $parameter);

            $status_group_by = 'status';

            $activityStatusList = $this->leadActivityModel->getActivityStatusCount($selectActivityStatusCount,$whereActivityStatusCount,$status_group_by);



            $complete = 0;

            $pending = 0;

            $past_due = 0;

            $not_complete = 0;



            foreach ($activityStatusList as $actkey => $actvalue) {

                // $newlist[] = array($actvalue['activity_type'], $actvalue['activity_type_count']);

                if ($actvalue['status'] == 'Not Complete') {

                    $not_complete = $actvalue['activity_status'];

                } else if ($actvalue['status'] == 'Past Due') {

                    $past_due = $actvalue['activity_status'];

                } else if ($actvalue['status'] == 'Pending') {

                    $pending = $actvalue['activity_status'];

                } else if ($actvalue['status'] == 'Complete') {

                    $complete = $actvalue['activity_status'];

                }

            }



            $arr2 = array('not_complete' => $not_complete, 'past_due' => $past_due, 'pending' => $pending, 'complete' => $complete);



            $data['activityStatusCountList'] = $arr2;

            $data['activityStatusUser_parameter'] = $parameter;

        } else {

            $selectActivityStatusCount = "count(status) as activity_status,status";

            $whereActivityStatusCount = array();

            $status_group_by = 'status';

            $activityStatusList = $this->leadActivityModel->getActivityStatusCount($selectActivityStatusCount,$whereActivityStatusCount,$status_group_by);

            $complete = 0;

            $pending = 0;

            $past_due = 0;

            $not_complete = 0;



            foreach ($activityStatusList as $actkey => $actvalue) {

                // $newlist[] = array($actvalue['activity_type'], $actvalue['activity_type_count']);

                if ($actvalue['status'] == 'Not Complete') {

                    $not_complete = $actvalue['activity_status'];

                } else if ($actvalue['status'] == 'Past Due') {

                    $past_due = $actvalue['activity_status'];

                } else if ($actvalue['status'] == 'Pending') {

                    $pending = $actvalue['activity_status'];

                } else if ($actvalue['status'] == 'Complete') {

                    $complete = $actvalue['activity_status'];

                }

            }



            if ($not_complete == 0 && $past_due == 0 && $pending == 0 && $complete == 0) {

                $data['activity_status_Data'] = 'No Data Available';

            }



            $arr2 = array('not_complete' => $not_complete, 'past_due' => $past_due, 'pending' => $pending, 'complete' => $complete);



            $data['activityStatusCountList'] = $arr2;

            //print_r($arr2);exit;

        }



        //------------------------------------------------------Lead Activity End--------------------------------------------------------------------------------



        $this->load->view('pages/dashboard', $data);

    }

}
