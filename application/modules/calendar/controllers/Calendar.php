<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Calendar extends CI_Controller {



	/**

	 * User Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://DomainName/users

	 *

	 * @author		 

	 */

	const USER_ARRAY = array('internal' => 'Internal User', 'Suppliers' => 'Suppliers', 'CustomerContact' => 'Customer');

	// const MODULE_NAME = 'user';



	public function __construct() {

		parent::__construct();

		$user_id = $this->session->userdata('user_id');

        if (!isset($user_id) || $user_id=='') {

            $this->session->sess_destroy();

            redirect('login');

        }

		$this->load->model(array('Activity_model' => 'leadActivityModel'));

		$this->load->model(array('Calendar_model' => 'CalendarModel'));

		$this->load->library(array('Permissions_library' => 'permission'));

		$this->load->model(array('Lead_model' => 'leadOpportunityModel'));

	}



	/**

	* index action of user controller

	* @author

	* @param

	* @param

	*/

	public function index($userType = 'internal')

	{

		$permissions = $this->permission->checkUserPermission(17);

		if (!$permissions) {

			redirect('page_not_found');exit;

		}



		$module_name = $this->uri->segment(1);

		// echo $userType; die; 

		$this->page->setTitle('Activity Calendar');

		

		// set head style

		$this->page->setHeadStyle(base_url()."assets/vendors/base/vendors.bundle.css");

		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style.bundle.css");
		
		$this->page->setHeadStyle(base_url()."assets/demo/default/base/style-2.css");

		//$this->page->setHeadStyle(base_url()."assets/vendors/custom/fullcalendar/fullcalendar.bundle.css");



		$this->page->setHeadStyle("//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css");

		$this->page->setHeadStyle("//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css");

	

		$this->page->setHeadStyle(base_url()."assets/custom/css/style.css");

		

		//set footer js

		$this->page->setFooterJs("//code.jquery.com/jquery-3.3.1.js");

		$this->page->setFooterJs("//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js");

		$this->page->setFooterJs(base_url()."assets/vendors/base/vendors.bundle.js");

		$this->page->setFooterJs(base_url()."assets/demo/default/base/scripts.bundle.js");



		//$this->page->setFooterJs(base_url()."assets/custom/js/datatable.js");

		$this->page->setFooterJs(base_url()."assets/custom/js/ajax.js");



		$this->page->setFooterJs(base_url()."assets/custom/js/custom.js");

		// $this->page->setFooterJs(base_url()."assets/vendors/custom/fullcalendar/fullcalendar.bundle.js");

		// $this->page->setFooterJs(base_url()."assets/demo/default/custom/components/calendar/basic.js");



		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js");

		$this->page->setFooterJs("//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js");



		$this->page->setFooterJs(base_url()."assets/activity_calendar/calendar.js");

		





		$page['contain'] = 'activityCalendar';

		$page['module_name'] = $module_name;

		



		$selectCountry = '*';

		$whereCountry= array();

		$page['activityType'] = $this->leadActivityModel->getActivityType($selectCountry,$whereCountry);



		$whereAcStatus = array('activity_type' => 'Phone Call');

		$page['phone_activity_status'] = $this->leadActivityModel->getActivityStatus('*', $whereAcStatus);



		$selectSalesPerson = "u.user_id, CONCAT(u.first_name, ' ', u.last_name) as name";

		$whereSalesPerson = array('Manager', 'Sales Executive', 'Sales Person', 'Administrator');

		//$whereSalesPerson = array('r.role_name' => 'Sales Person', 'r.role_name' => 'Sales Person');

		$page['salesPerson'] = $this->leadActivityModel->getSalesPersonsAndAdmins($selectSalesPerson,$whereSalesPerson);



		$whereAcStatus = array('activity_type' => 'Phone Call');

		$page['phone_activity_status'] = $this->leadActivityModel->getActivityStatus('*', $whereAcStatus);



		$whereAcStatus = array();

		$page['get_activity_status'] = $this->leadActivityModel->getActivityStatus('*', $whereAcStatus);



		$selectLead  = 'lo.lead_opportunity_id, lo.opportunity_title, u.full_name';

		$whereLead = array('activity_status' => 'active', 'job_status' => 'not_converted', 'created_by' => $this->session->userdata('user_id'));

		$page['lead_opportunity'] = $this->leadOpportunityModel->getLeadOpportunities('*', $whereAcStatus);

		$page['access'] = $this->session->userdata('adminAccess');
		

		//$page['setActivities'] = json_encode($activityDataList);

		// print_r($page['setActivities']);exit;

		$page['showOpportunity'] = $this->permission->checkUserPermission(17);

		$page['showActivity'] = $this->permission->checkUserPermission(22);

		$page['showActivityCalendar'] = $this->permission->checkUserPermission(17);

		$page['showRFQ'] = $this->permission->checkUserPermission(26);

		$page['showProposal'] = $this->permission->checkUserPermission(31);

		$page['showJobs'] = $this->permission->checkUserPermission(36);

		$page['showReleasePO'] = $this->permission->checkUserPermission(47);
		$page['showReleaseInvoice'] = $this->permission->checkUserPermission(48);


		$this->page->getLayout($page);

	}



	public function calendarData () {

		$select = "t1.lead_activity_id,t1.activity_start_datetime,t1.activity_end_datetime,t1.reminder,t1.activity_type as title,t1.initiated_by,t1.assigned_by,t1.description,t1.follow_up_datetime,t1.lead_activity_status,t1.activity_title, t1.activity_date as start,t1.description,t1.activity_time_from,t1.follow_up_date,t1.status,u3.user_id,u3.full_name,t2.opportunity_title";

		$activityDataList = $this->leadActivityModel->getActivity($select);

// print_r($activityDataList);exit;

		foreach ($activityDataList as $key => $value) {



			$status = '';

			$followUpDate = $activityDataList[$key]['follow_up_datetime'];

			$activity_date = $activityDataList[$key]['activity_start_datetime'];



			if (isset($activity_date) && $activity_date !='' && $status == '') {

				$activity_date = date('d-m-Y',strtotime($activity_date));

				$date = strtotime($activity_date);

				$now = strtotime(date('d-m-Y h:i A'));

				if($date < $now && $activityDataList[$key]['lead_activity_status'] !='Complete') {

				    // $companyList[$key]['status'] = "Not Complete";

				    // $status = 'Not Complete';

				    $activityDataList[$key]['status'] = "Past Due";

				    $status = 'Past Due';

				} else {

					$companyList[$key]['status'] = $activityDataList[$key]['lead_activity_status'];



					$updateArray = array(

						'status' => '',

					);

					$where = array('lead_activity_id' => $activityDataList[$key]['lead_activity_id']);

//print_r($updateArray);exit;

					$updateStatus = $this->leadActivityModel->updateStatus($updateArray, $where);

				}

				// else if ($activityDataList[$key]['lead_activity_status'] == 'Complete'){

				// 	$activityDataList[$key]['status'] = "Complete";

				//     $status = 'Complete';

				// } else {

				// 	$activityDataList[$key]['status'] = "Pending";

				//     $status = 'Pending';

				// }

				$activityDataList[$key]['activity_date'] = date('d-M-Y',strtotime($activity_date));

			}



			if ($activityDataList[$key]['status'] == 'Past Due') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-danger pastDue';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Save as draft') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success saveAsDraft';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Schedule') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success schedule';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Postpone') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success postpone';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'RNR') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success RNR';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Not Reachable') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success not_reachable';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Invalid Number') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success invalid_no';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Pending') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success pending';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Open') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success taskopen';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Close') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success taskclose';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Send Later') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success sendLater';

			} else if ($activityDataList[$key]['lead_activity_status'] == 'Complete') {

				$activityDataList[$key]['className'] = 'm-fc-event--light m-fc-event--solid-success';

			}





			$activityDataList[$key]['start'] = date("Y-m-d", strtotime($activityDataList[$key]['start']));

			if (isset($activityDataList[$key]['activity_time_from']) && $activityDataList[$key]['activity_time_from'] !='') {

				$activityDataList[$key]['start'] = date("Y-m-d", strtotime($activityDataList[$key]['start']))."T".$activityDataList[$key]['activity_time_from'];

			}

			if (isset($activityDataList[$key]['activity_time_to']) && $activityDataList[$key]['activity_time_to'] !='') {

				$activityDataList[$key]['end'] = date("Y-m-d", strtotime($activityDataList[$key]['start']))."T".$activityDataList[$key]['activity_time_to'];

			}

			

		}



		echo json_encode($activityDataList);



	}



	public function getType() {



		$post = $this->input->post();

		$type = $post['type'];

		if (isset($post['lead_activity_status'])) {

			$data['lead_activity_status'] = $post['lead_activity_status'];

		}

		

		$select='status';

		$where = array('activity_type' => $type);

		$data['getActivityStatus'] = $updateStatus = $this->leadActivityModel->getActivityStatus($select, $where);

		$getPage = $this->load->view('pages/getActivityType', $data);

		echo $getPage;

	}



}

