<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    /**
    * Login Page for this controller.
    *
    * Maps to the following URL
    *      http://DomainName/login
    *
    * @author Sagar Kodalkar
    */

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Login_model' => 'loginModel'));
    }

    /**
    * index action of Login controller
    * @author Sagar Kodalkar
    * @param
    */

    public function index()
    {
        // set title
        $this->page->setTitle('Login');
        // set head style
        $this->page->setHeadStyle(base_url()."assets/custom/css/login.css");
        $this->page->setHeadStyle("https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css");
        //set footer js
        $this->page->setFooterJs("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js");
        $this->page->setFooterJs("https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js");
        $this->page->setFooterJs(base_url()."assets/custom/js/login.js");
        // load layout
        $page['contain'] = 'login';
        $this->page->getLoginLayout($page);
    } // end : index Action


    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function authenticate() {
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        // $this->form_validation->set_rules('hash', 'Password', 'required|alpha_numeric');
        if ($this->form_validation->run() == FALSE) {
            echo "<div class='alert-login-danger'>
            <strong>Alert!</strong><br/><br/>".
            validation_errors().
            "</div>";
        } else {
            try {
                $email      = $post['username'];
                $password   = $post['password'];
                $password   = md5($password);

                $select = 'user_login_id,fk_user_id';
                $where = array('username' => $email, 'password' => $password);
                $CheckLogin = $this->loginModel->checkUser($select, $where);
                if ($CheckLogin['count'] == 1) {
                    $selectUser = "CONCAT(u.first_name,' ',u.last_name) as name,u.fk_role_id, u.user_type,GROUP_CONCAT(uc.contact_info) as emails,u.admin_access as admin_access";
                    $whereUser = array('u.user_id' => $CheckLogin['result'][0]['fk_user_id'], 'uc.contact_type' => 'Email');
                    $getUserInfo = $this->loginModel->getUserInfo($selectUser, $whereUser);
                    $selectPermissions = 'fk_role_id,permissions';
                    $selectNotifications = 'fk_role_id,email_notifications';
                    $wherePermissions = array('fk_user_id' => $CheckLogin['result'][0]['fk_user_id']);
                    $permissions = $this->loginModel->getUserPermissions($selectPermissions, $wherePermissions);
                    $notifications = $this->loginModel->getUserNotifications($selectNotifications, $wherePermissions);
                    if (empty($permissions['resultUser'][0]['permissions']) || $permissions['resultUser'][0]['permissions'] == '') {
                        $response['code'] = 400;
                        $response['message'] = 'No Access';
                        echo json_encode($response);
                        exit;
                    }
                    $this->session->set_userdata('user_id',$CheckLogin['result'][0]['fk_user_id']);
                    $this->session->set_userdata('user_name',$getUserInfo['resultUser'][0]['name']);
                    $this->session->set_userdata('user_type',$getUserInfo['resultUser'][0]['user_type']);
                    $this->session->set_userdata('adminAccess',$getUserInfo['resultUser'][0]['admin_access']);
                    $this->session->set_userdata('role_id',$getUserInfo['resultUser'][0]['fk_role_id']);
                    $this->session->set_userdata('emails',$getUserInfo['resultUser'][0]['emails']);
                    $this->session->set_userdata('user_permissions',$permissions['resultUser'][0]['permissions']);
                    if (isset($notifications['resultUser'][0]['email_notifications'])) {
                        $this->session->set_userdata('user_notifications',$notifications['resultUser'][0]['email_notifications']);
                    }
                    // Last Login Update
                    date_default_timezone_set('Asia/Kolkata');
                    $updateArray = array(
                        'last_login' => date('d-M-Y h:i A')
                    );
                    $whereUser = array('user_id' => $CheckLogin['result'][0]['fk_user_id']);
                    $setLastLogin = $this->loginModel->updateLastLogin($updateArray, $whereUser);

                    // Fetch Current Rate Of USD
                    $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
                    $response_json = file_get_contents($req_url);
                    if(false !== $response_json) {
                        try {
                            $response_object = json_decode($response_json);
                            $AED_price = $response_object->rates->AED;
                        }
                        catch(Exception $e) {
                            // Handle JSON parse error...
                        }
                    } else {
                        $AED_price = 3.67;
                    }
                    $this->session->set_userdata('aed_price',$AED_price);
                    $response['code'] = 200;
                    $response['message'] = 'Success';
                } else {
                    $response['code'] = 500;
                    $response['message'] = 'Failure';
                }
            } catch(Exception $E) {
                $response['code'] = 500;
                $response['message'] = 'Failure';
            }
            echo json_encode($response);
        }
    }

    public function forgotpassword() {
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            echo "<div class='alert-login-danger'>
            <strong>Alert!</strong><br/><br/>".
            validation_errors().
            "</div>";
        } else {
            try {
                $email['u2.contact_info']       = $post['email'];
                $email['u2.contact_type']       = 'Email';
                $CheckLogin = $this->loginModel->checkValidEmail($email);
                if ($CheckLogin['count'] == 1) {
                    // Email Code
                    $mail_message ='<html>
                    <head><title>Mail from Hozpitality CRM</title></head>
                    <body>
                    Hello User,<br/>Please click on the below link to reset your password.<br/><br/>
                    <table style="width: 700px; font-family: arial; font-size: 14px;" border="0">
                    <tr style="height: 32px; background-color:#f0f0f0;">
                    <th align="left" style="width:250px; padding-right:5px;">Password Reset Link:</th>
                    <td align="left" style="padding-left:5px; line-height: 20px;"><a href="https://crm.specxnet.com/setpassword/">Click Here</a></td>
                    </tr>
                    </table>
                    </body>
                    </html>';

                    //Load email library
                    $this->load->library('email');
                    $config = array(
                        'protocol'  => 'smtps',
                        'smtp_host' => 'ssl://smtp.live.com',
                        'smtp_port' => 25,
                        'smtp_user' => 'crm@hozpitality.com',
                        'smtp_pass' => 'Tak32071',
                        'mailtype'  => 'html',
                        'charset'   => 'utf-8'
                    );

                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");
                    $this->email->from('crm@hozpitality.com', 'Hozpitality CRM');
                    $this->email->to($post['email']);
                    $this->email->subject('Forgot Password');
                    $this->email->message($mail_message);

                    //Send email
                    if($this->email->send()) {
                        $response['code'] = 200;
                        $response['message'] = 'Success';
                    } else {
                        $response['code'] = 500;
                        $response['message'] = 'Failure';
                    }
                } else {
                    $response['code'] = 404;
                    $response['message'] = 'Failure';
                }

            } catch(Exception $E) {
                $response['code'] = 500;
                $response['message'] = 'Failure';
            }
            echo json_encode($response);
        }
    }
}

?>
