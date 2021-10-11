<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'../vendor/autoload.php';
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;


class Outlook extends CI_Controller {

	public function __construct() {
		parent::__construct();
    $user_id = $this->session->userdata('user_id');
    if (!isset($user_id) || $user_id=='') {
        $this->session->sess_destroy();
        redirect('login');
    }
		$this->load->library(array('Outlook_library' => 'outlook'));	
    $this->load->model(array('Activity_model' => 'leadActivityModel'));
	}

	public function index()
	{
		$this->outlook->signin();
	}

	public function token()
	{

	  	$this->outlook->token($_GET['code'],$_GET['state']);
	}

	public function calender()
	{
		if (session_status() == PHP_SESSION_NONE) {
	      	session_start();
	    }

    	$graph = new Graph();
  		$graph->setAccessToken($this->outlook->getAccessToken());

  		// get user info
  		$user = $graph->createRequest('GET', '/me')
                ->setReturnType(Model\User::class)
                ->execute();
//-------------------------------------------------------------------------------
      $select = "t1.activity_type as title, t1.activity_date as start,t1.description,t1.activity_time_from,t1.follow_up_date,t1.status,u3.user_id,u3.full_name, activity_start_datetime, activity_end_datetime, follow_up_datetime, t1.activity_title as activity_title";
      $where = array('t2.fk_sales_people_id' => $this->session->userdata('user_id'));
      $activityDataList = $this->leadActivityModel->getActivity($select, $where);
// echo "<pre>";
// print_r($activityDataList);exit;
      foreach ($activityDataList as $key => $value) {

        $activityDataList[$key]['start'] = $activityDataList[$key]['activity_start_datetime'];
        $activityDataList[$key]['end'] = $activityDataList[$key]['activity_end_datetime'];
        
        //$activityDataList[$key]['start'] = date("Y-m-d", strtotime($activityDataList[$key]['activity_start_datetime']))."T00:00";
        // if (isset($activityDataList[$key]['activity_time_from']) && $activityDataList[$key]['activity_time_from'] !='') {
        //   $activityDataList[$key]['start'] = date("Y-m-d", strtotime($activityDataList[$key]['start']))."T".$activityDataList[$key]['activity_time_from'];
        // }
        // if (isset($activityDataList[$key]['activity_time_to']) && $activityDataList[$key]['activity_time_to'] !='') {
        //   $activityDataList[$key]['end'] = date("Y-m-d", strtotime($activityDataList[$key]['start']))."T".$activityDataList[$key]['activity_time_to'];
        // } else {
        // 	$activityDataList[$key]['end'] = $activityDataList[$key]['start'];
        // }
 //print_r($activityDataList[$key]['start']);exit;
        $setEventPost['subject'] = $activityDataList[$key]['activity_title'];
        $setEventPost['body']['contentType'] = "HTML";
        $setEventPost['body']['content'] = $activityDataList[$key]['description'];
        $setEventPost['start']['dateTime'] = $activityDataList[$key]['start'];
        $setEventPost['start']['timeZone'] = "INDIA STANDARD TIME";
        $setEventPost['end']['dateTime'] = $activityDataList[$key]['end']; 
        $setEventPost['end']['timeZone'] = "INDIA STANDARD TIME";
        $setEventPost['location']['displayName'] = '';
        
        $eventPost = json_encode($setEventPost);
        //print_r(expression)
//------------------------------------------------------------------------------
        // set events
        // $eventPost = '{
        //     "subject": "testing from Atithi",
        //     "body": { 
        //       "contentType": "HTML",
        //       "content": "Testing in progress"
        //     },
        //     "start": {
        //         "dateTime": "2019-10-01T12:00:00",
        //         "timeZone": "UTC"
        //     },
        //     "end": {
        //         "dateTime": "2019-10-01T14:00:00",
        //         "timeZone": "UTC"
        //     },
        //     "location":{
        //         "displayName":"Sagar Kodalkar"
        //     },
        //     "attendees": [
        //       {
        //         "emailAddress": {
        //           "address":"dev1@hozpitality.com",
        //           "name": "Sagar Kodalkar"
        //         },
        //         "type": "required"
        //       }
        //     ]
        //   }';
// echo "<pre>";
// print_r($eventPost);exit;
		$getEventsUrl = '/me/events';
  		$events = $graph->createRequest('POST', $getEventsUrl)
  					->attachBody($eventPost)
                  	// ->setReturnType(Model\Event::class)
                  	->execute();




        // get event
  		$eventsQueryParams = array (
    		// // Only return Subject, Start, and End fields
		    "\$select" => "subject,start,end",
		    // Sort by Start, oldest first
		    "\$orderby" => "Start/DateTime",
		    // Return at most 10 results
		    "\$top" => "100"
  		);

  		$getEventsUrl = '/me/calendar/events?'.http_build_query($eventsQueryParams);
  		$events = $graph->createRequest('GET', $getEventsUrl)
                  ->setReturnType(Model\Event::class)
                  ->execute();
      }
        // echo '<pre>';
        // print_r($events);
      //redirect('dashboard/index');
//echo $this->session->userdata('role_id');exit;
      if ($this->session->userdata('role_id') == '5') {
        redirect('lead/index');
      } else {
        redirect('dashboard/index');
      }

	}


}
