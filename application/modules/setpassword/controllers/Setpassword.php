<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setpassword extends CI_Controller {

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
        $this->page->setFooterJs(base_url()."assets/custom/js/setpassword.js");
        
        // load layout
        $page['contain'] = 'setpassword';

        $this->page->getLoginLayout($page);
    } // end : index Action

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function authenticate() {
        $post = $this->input->post();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('hash', 'Password', 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            echo "<div class='alert-login-danger'>
                    <strong>Alert!</strong><br/><br/>".
                    validation_errors().
                "</div>";
        } else {
            try {
                $email       = $post['email'];
                $password   = md5($post['hash']);

                $select = 'user_contact_id, fk_user_id';
                $where = array('contact_info' => $email);

                $CheckLogin = $this->loginModel->checkUsercontact($select, $where);

                $select = 'user_login_id';
                $where = array('fk_user_id' => $CheckLogin['result'][0]['fk_user_id']);

                $CheckUserLogin = $this->loginModel->checkUserlogin($select, $where);

                if ($CheckUserLogin['count'] == 1) {
                    $updateArray = array(
                        'password' => $password,
                    );
                    $where = array('fk_user_id' => $CheckLogin['result'][0]['fk_user_id']);
                    $setPass = $this->loginModel->setPass($updateArray, $where);
                    // $this->session->set_userdata('user_id',$CheckLogin['result'][0]['fk_user_id']);
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
}

