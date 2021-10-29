<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Start Company Route
$route['company/deleteCompany'] = 'company/deleteCompany';
$route['company/sendBulkEmail'] = 'company/sendBulkEmail';
$route['company/getEmailIds'] = 'company/getEmailIds';
$route['company/savefilter'] = 'company/savefilter';
$route['company/(:any)'] = 'company/index/$1';
$route['company/form/(:any)/(:num)'] = 'company/displayForm/$1/$2';
$route['company/form/(:any)'] = 'company/displayForm/$1';
$route['company/create/company/(:num)'] = 'company/createCompany/$1';
$route['company/create/company'] = 'company/createCompany';
$route['company/get/companies'] = 'company/getCompanies';
$route['company/result/(:any)'] = 'company/result/$1';
$route['company/get/companies/(:any)'] = 'company/getCompanies/$1';
$route['company/getCompanyIdentifier/(:any)'] = 'company/getCompanyIdentifier/$1';
$route['company/filter/companies/(:any)'] = 'company/result/';
$route['company/create/gridview/(:num)'] = 'company/createGrid/$1';
$route['company/create/gridview'] = 'company/createGrid';
$route['company/delete/file'] = 'company/deleteAttachFile';
$route['company/myprofile/(:any)'] = 'company/myProfileForm/$1';
$route['company/create/myprofile/(:num)'] = 'company/createMyProfile/$1';
$route['company/activity/getActivityNotification'] = 'activity/getActivityNotification';
// End Company Route

// Start User Route
$route['user/deleteUser'] = 'users/deleteUser';
$route['user/sendBulkEmail'] = 'users/sendBulkEmail';
$route['user/getEmailIds'] = 'users/getEmailIds';
$route['user/savefilter'] = 'users/savefilter';
$route['user/(:any)'] = 'users/index/$1';
$route['user/form/(:any)/(:num)'] = 'users/displayForm/$1/$2';
$route['user/form/(:any)'] = 'users/displayForm/$1';
$route['user/create/user/(:num)'] = 'users/createUser/$1';
$route['user/create/user'] = 'users/createUser';
$route['user/get/users'] = 'users/getUsers';
$route['user/get/users/(:any)'] = 'users/getUsers/$1';
$route['user/create/gridview/(:num)'] = 'users/createGrid/$1';
$route['user/create/gridview'] = 'users/createGrid';
$route['user/filter/users/(:any)'] = 'users/result/';
$route['user/getSavedFilterDropdown'] = 'users/getSavedFilterDropdown';
$route['user/activity/getActivityNotification'] = 'activity/getActivityNotification';
// End User Route

$route['lead/deleteOpportunity'] = 'lead/deleteOpportunity';
$route['lead/getUcontData'] = 'lead/getUcontData';
$route['lead/sendBulkEmail'] = 'lead/sendBulkEmail';
$route['lead/getEmailIds'] = 'lead/getEmailIds';
$route['lead/savefilter'] = 'lead/savefilter';
$route['lead'] = 'lead/index';
$route['lead/form'] = 'lead/displayForm';
$route['lead/form/(:any)'] = 'lead/displayForm/$1';
$route['lead/form/(:any)/(:num)'] = 'lead/displayForm/$1/$2';
$route['lead/form/(:any)'] = 'lead/displayForm/$1';
$route['lead/update/(:any)/(:num)'] = 'lead/displayUpdateForm/$1/$2';
$route['lead/create/leadopportunity'] = 'lead/createLead';
$route['lead/create/leadopportunity/(:num)'] = 'lead/createLead/$1';
$route['lead/get/leadopportunity'] = 'lead/getLead';
$route['lead/create/gridview/(:num)'] = 'lead/createGrid/$1';
$route['lead/create/gridview'] = 'lead/createGrid';
$route['lead/user/(:any)'] = 'lead/displayUser/$1';
$route['lead/get/Activity'] = 'lead/getActivity';
$route['lead/get/proposal'] = 'lead/getProposal';
$route['lead/set/status/(:any)'] = 'lead/setStatus/$1';
$route['lead/set/Notes'] = 'lead/addNotes';
$route['lead/convertToJob'] = 'lead/leadConvertToJob';

// End PreSale Route
$route['activity/deleteUActivity'] = 'activity/deleteUActivity';
$route['activity/sendBulkEmail'] = 'activity/sendBulkEmail';
$route['activity/getEmailIds'] = 'activity/getEmailIds';
$route['activity/savefilter'] = 'activity/savefilter';
$route['activity'] = 'activity/index';
$route['activity/form'] = 'activity/displayForm';
$route['activity/form/(:any)'] = 'activity/displayForm/$1';
$route['activity/form/(:any)/(:num)'] = 'activity/displayForm/$1/$2';
$route['activity/email/(:any)/(:num)'] = 'activity/displaySendEmailForm/$1/$2';
$route['activity/addform/(:any)/(:num)'] = 'activity/displayFormAddActivity/$1/$2';
$route['activity/form/(:any)'] = 'activity/displayForm/$1';
$route['activity/get/leadactivity'] = 'activity/getActivity';
$route['activity/create/leadactivity'] = 'activity/createActivity';
$route['activity/calendar/leadactivity'] = 'activity/createActivityCalendar';
$route['activity/create/gridview/(:num)'] = 'activity/createGrid/$1';
$route['activity/create/gridview'] = 'activity/createGrid';
$route['activity/table/getActivities'] = 'activity/getActivity';
$route['activity/get/files'] = 'activity/getFiles';
$route['activity/send/email'] = 'activity/sendLeadEmail';
$route['activity/comment/(:any)'] = 'activity/displayComment/$1';


// @Sagar Kodalkar
// Proposal routes
$route['proposal'] = 'proposal/index';
$route['proposal/get/list'] = 'proposal/getProposals';
$route['prop/form'] = 'proposal/displayForm';
$route['prop/form/(:any)'] = 'proposal/displayForm/$1';
$route['prop/form/approve/(:any)'] = 'proposal/displayApproveForm/$1';
$route['prop/form/(:any)/(:num)'] = 'proposal/displayForm/$1/$2';
$route['proposal/create/worksheet'] = 'proposal/addWorksheet';
$route['prop/getItem'] = 'proposal/getItem';
$route['Proposal/Format/add'] = 'proposal/addFormat';
$route['Proposal/table/getItemList'] = 'proposal/getItemList';
$route['Proposal/get/leadOpportunity'] = 'proposal/getLeadOpportunityList';
$route['Proposal/set/status/(:any)'] = 'proposal/setStatus/$1';
$route['proposal/filter/add'] = 'proposal/addFilter';
$route['proposal/filter/get'] = 'proposal/getFilter';
$route['proposal/importData'] = 'proposal/importData';
$route['proposal/get/company'] = 'proposal/getCompany';
$route['proposal/getComment'] = 'proposal/getComment';
$route['proposal/addComment'] = 'proposal/addComment';
$route['proposal/addPO'] = 'proposal/addPO';
$route['proposal/save'] = 'proposal/saveProposal';
$route['proposal/table/getProposal'] = 'proposal/getProposals';

// @Sagar Kodalkar
// RFQ routes
$route['rfq'] = 'rfq/index';
$route['rfq/get/list'] = 'rfq/getRfq';
$route['rf/form'] = 'rfq/displayForm';
$route['rf/form/(:any)'] = 'rfq/displayForm/$1';
$route['rf/form/(:any)/(:num)'] = 'rfq/displayForm/$1/$2';
$route['rfq/create/worksheet'] = 'rfq/addWorksheet';

$route['rfq/updateRFQStatus'] = 'rfq/updateRFQStatus';
$route['rf/getItem'] = 'rfq/getItem';
$route['rfq/Format/add'] = 'rfq/addFormat';
$route['rfq/table/getItemList'] = 'rfq/getItemList';
$route['rfq/get/leadOpportunity'] = 'rfq/getLeadOpportunityList';
$route['rfq/set/status/(:any)'] = 'rfq/setStatus/$1';
$route['rfq/filter/add'] = 'rfq/addFilter';
$route['rfq/filter/get'] = 'rfq/getFilter';
//$route['rfq/importData'] = 'rfq/importData';
$route['rfq/get/company'] = 'rfq/getCompany';
$route['rfq/sent/mail'] = 'rfq/get_item_email';
$route['rfq/save'] = 'rfq/saverfq';
$route['rfq/create/gridview'] = 'rfq/createGrid';
$route['rfq/bidupload/(:num)'] = 'rfq/uploadBid/$1';
$route['rfq/biddetails/(:num)'] = 'rfq/bidDetails/$1';
$route['rfq/viewbid/(:num)'] = 'rfq/viewBid/$1';
$route['rfq/viewbidtable/(:num)'] = 'rfq/viewBidTable/$1';
$route['rfq/bid/price'] = 'rfq/addBidPrice';
$route['rf/response/(:num)'] = 'rfq/displayResponses/$1';
$route['rf/approveRFQ/(:num)'] = 'rfq/rfqApproval/$1';

// @Shruthi Kumar
// Release Invoice routes
$route['invoice'] = 'invoice/index';
$route['invoice/get/list'] = 'invoice/getInvoice';
$route['invoice/form'] = 'invoice/displayForm';
$route['invoice/form/(:any)'] = 'invoice/displayForm/$1';
$route['invoice/form/approve/(:any)'] = 'invoice/displayApproveForm/$1';
$route['invoice/form/(:any)/(:num)'] = 'invoice/displayForm/$1/$2';
$route['invoice/create/worksheet'] = 'invoice/addWorksheet';
$route['invoice/getItem'] = 'invoice/getItem';
$route['invoice/Format/add'] = 'invoice/addFormat';
$route['invoice/table/getItemList'] = 'invoice/getItemList';
$route['invoice/get/leadOpportunity'] = 'invoice/getLeadOpportunityList';
$route['invoice/set/status/(:any)'] = 'invoice/setStatus/$1';
$route['invoice/filter/add'] = 'invoice/addFilter';
$route['invoice/filter/get'] = 'invoice/getFilter';
$route['invoice/importData'] = 'invoice/importData';
$route['invoice/get/company'] = 'invoice/getCompany';
$route['invoice/getComment'] = 'invoice/getComment';
$route['invoice/addComment'] = 'invoice/addComment';
$route['invoice/save'] = 'invoice/saveInvoice';

// @Shruthi Kumar
// Release PO routes
$route['purchase_order'] = 'purchase_order/index';
$route['purchase_order/get/list'] = 'purchase_order/getPO';
$route['purchase_order/get_POpreview'] = 'purchase_order/get_POpreview';
// $route['purchase_order/get_InvoicePreview'] = 'purchase_order/get_InvoicePreview';
// @Shruthi Kumar
// Release PO routes
$route['invoice'] = 'invoice/index';
$route['invoice/get/list'] = 'invoice/getInvoice';
$route['invoice/get_InvoicePreview'] = 'invoice/get_InvoicePreview';
// $route['invoice/get_InvoicePreview'] = 'invoice/get_InvoicePreview';

$route['analysis'] = 'analysis/index';
$route['analysis/get/list'] = 'analysis/getAnalysis';
$route['analysis/form'] = 'analysis/displayForm';
$route['analysis/form/(:any)'] = 'analysis/displayForm/$1';
$route['analysis/form/(:any)/(:num)'] = 'analysis/displayForm/$1/$2';
$route['analysis/create/worksheet'] = 'analysis/addWorksheet';
$route['analysis/getItem'] = 'analysis/getItem';
$route['analysis/Format/add'] = 'analysis/addFormat';
$route['analysis/table/getItemList'] = 'analysis/getItemList';
$route['analysis/get/leadOpportunity'] = 'analysis/getLeadOpportunityList';
$route['analysis/set/status/(:any)'] = 'analysis/setStatus/$1';
$route['analysis/filter/add'] = 'analysis/addFilter';
$route['analysis/filter/get'] = 'analysis/getFilter';
//$route['analysis/importData'] = 'analysis/importData';
$route['analysis/get/company'] = 'analysis/getCompany';
$route['analysis/sent/mail'] = 'analysis/get_item_email';
$route['analysis/save'] = 'analysis/saveanalysis';
$route['analysis/create/gridview'] = 'analysis/createGrid';
$route['analysis/bidupload/(:num)'] = 'analysis/uploadBid/$1';
// $route['analysis/bidApply/(:any)'] = 'analysis/bidApply/$1';
$route['analysis/bid/price'] = 'analysis/addBidPrice';

// $route['role/deleteUActivity'] = 'role/deleteUActivity';
// $route['role/sendBulkEmail'] = 'role/sendBulkEmail';
// $route['role/savefilter'] = 'role/savefilter';
$route['role'] = 'role/index';
$route['role/form'] = 'role/displayForm';
$route['role/form/(:any)'] = 'role/displayForm/$1';
$route['role/form/(:any)/(:num)'] = 'role/displayForm/$1/$2';
// $route['role/form/(:any)'] = 'role/displayForm/$1';
$route['role/permission'] = 'role/dropdown/getIndustry';
$route['role/notify'] = 'role/Notify';
$route['role/get/role'] = 'role/getRole';
// $route['role`/create/roleAdd/(:num)'] = 'role/createRole/$1';
$route['role/create/roleAdd'] = 'role/createRole';
// $route['role/create/gridview/(:num)'] = 'role/createGrid/$1';

$route['job/get/jobs'] = 'jobs/getJob';


$route['dropdown'] = 'dropdowns/index';
$route['dropdown/form'] = 'dropdowns/displayForm';
$route['dropdown/get/role'] = 'dropdowns/getDropdown';
$route['dropdown/getIndustry'] = 'dropdowns/getIndustryData';
$route['dropdown/getDivision'] = 'dropdowns/getDivisionData';
$route['dropdown/getDepartment'] = 'dropdowns/getDepartmentData';
$route['dropdown/getSources'] = 'dropdowns/getSourcesData';
$route['dropdown/getJobType'] = 'dropdowns/getJobTypeData';
$route['dropdown/setModuleData'] = 'dropdowns/setModuleData';
$route['dropdown/deleteData'] = 'dropdowns/deleteData';

$route['opportunities'] = 'opportunities/index';
$route['opportunity/get/title'] = 'opportunities/gettitle';
$route['opportunity/form'] = 'opportunities/displayForm';
$route['opportunity/form/(:any)'] = 'opportunities/displayForm/$1';
$route['opportunity/create/title'] = 'opportunities/create_opportunity';

$route['shedule/create/schedule'] = 'schedule/create';
$route['shedule/get/calendar'] = 'schedule/getEvents';
$route['shedule/get/gantt'] = 'schedule/getGantChartData';
$route['shedule/edit/schedule/(:any)'] = 'schedule/create/$1';
$route['schedule/form'] = 'schedule/form';
$route['schedule/form/(:any)'] = 'schedule/form/$1';
$route['schedule/(:any)'] = 'schedule/index/$1';
$route['shedule/create/schedule/note'] = 'schedule/createNote';
$route['shedule/create/schedule/note/(:any)'] = 'schedule/createNote/$1';
$route['shedule/get/schedules/(:any)'] = 'schedule/get/$1';
$route['shedule/upload/schedule/(:num)'] = 'schedule/uploadDocument/$1';
$route['shedule/phase/schedule/(:num)'] = 'schedule/schedulePhase/$1';

$route['todo/create/todo'] = 'todo/create';
$route['todo/edit/todo/(:any)'] = 'todo/create/$1';
$route['todo/form'] = 'todo/form';
$route['todo/form/(:any)'] = 'todo/form/$1';
$route['todo/get/todo/(:any)'] = 'todo/get/$1';
$route['todo/(:any)'] = 'todo/index/$1';

$route['test'] = 'users/test';

