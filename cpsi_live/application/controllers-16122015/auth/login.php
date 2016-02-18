<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Login Controller
 *
 * @package Login Controller
 * @author Patrick K. Johnson Jr.
 * @link http://avizium.com/
 * @version 2.0.0-pre
 */
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
// no page caching
        $this->output->nocache();
// bootstrap admin model
        $this->load->model("auth_model", "", TRUE);
    }

    function index($error_msg = NULL) {
        $this->load->library('captcha');
        $data['captcha'] = $this->captcha->main();
        $this->session->set_userdata('captcha_info', $data['captcha']);
// set default attributes
        $data ["subtitle"] = "AA-SchoolHealth AdminUI";
        $data ["action"] = "auth/login/validate_credentials";
        $data ["login_content"] = "login_view/login_form";
        if (!empty($error_msg)):
            $data ["error_msg"] = $error_msg;
        endif;
        $this->load->view("login/template", $data);
    }

    function verify_user($query, $captcha_info, $captcha_value) {

        $passcode_qstring = md5($this->uri->segment(4));
        $username_passcode = $this->input->post("username");
        if (!empty($passcode_qstring)):
            $passcode_count = $this->auth_model->check_passcode($passcode_qstring, $username_passcode);

        endif;
// If the user's credentials validate...
        if ($query == AUTH_PASS && $captcha_info['code'] == $captcha_value || $query == AUTH_PASS && $captcha_info['code'] == $captcha_value && isset($passcode_count) && $passcode_count == 1) {
// get user details
            $user = $this->auth_model->get_by_user($user = $this->input->post("username"))->row();
            $data = array(
                "username" => $this->input->post("username"),
                "is_logged_in" => TRUE,
                "user_id" => $user->user_id,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name
            );
            $this->session->set_userdata($data);
            $sql = $this->auth_model->password_check($data['user_id']);
            if ($sql == 1):
                $this->auth_model->update_passcode($passcode_qstring, $username_passcode);
                $this->session->unset_userdata('captcha_info');
                redirect("search/student_search/");
            else:
                $data ["action"] = site_url("auth/login/change_password");
                $data ["login_content"] = "login_view/change_password";
                $this->load->view("login/template", $data);
            endif;
        } elseif ($query == PASS_RESET_REQUIRED) {
            $this->password_change_req();
        } else {
            $error_msg = "Invalid Username or Password";
            $this->index($error_msg);
        }
    }

    function validate_credentials() {
        $captcha_info = $this->session->userdata('captcha_info');
        $captcha_value = $this->input->post('captcha');
        $this->form_validation->set_rules('captcha', 'captcha', 'trim|required|callback_captchaxss_clean');
        if ($captcha_info['code'] != $this->input->post('captcha')) {
            $this->form_validation->set_rules('captcha', 'captcha', 'trim|required|callback_captcha|xss_clean');
        }
        if ($this->form_validation->run() == FALSE) {
            $this->form_validation->set_rules('captcha', 'captcha', 'trim|required|callback_captcha|xss_clean');
        }
        $query = $this->auth_model->validate();
        $username = $this->input->post('username');
        $user_count = $this->auth_model->get_username_count($username);
        $log = $this->log_check($query, $captcha_info, $captcha_value, $user_count);

        $user = $this->auth_model->get_by_user($user = $this->input->post("username"))->row();
        if ($log == true) {
            $this->verify_user($query, $captcha_info, $captcha_value);
        } else {
            $log_time = $this->auth_model->get_endTime($user->user_id);
            date_default_timezone_set("Asia/Calcutta");
            $current_time = date("Y-m-d H:i:s", strtotime("now"));
            if ($current_time < $log_time['endTime']) {
                $error_msg = "You have been blocked for 30 minutes";
                $this->index($error_msg);
            } else {
                $this->auth_model->update_logData($user->user_id, $log_time['endTime']);
                $this->verify_user($query, $captcha_info, $captcha_value);
            }
        }
    }

//Sridhar Implements
    public function log_check($login_success, $captcha_info, $captcha_value, $user_count) {
        if (($login_success == AUTH_PASS || $login_success <> AUTH_PASS && !empty($user_count)) && ($captcha_info['code'] == $captcha_value)) {
// load database model
            $this->load->model("auth_model");

            $username = $this->input->post("username");
            $ip = $_SERVER['REMOTE_ADDR'];
            date_default_timezone_set("Asia/Calcutta");
            $initialTime = date("Y-m-d H:i:s"); //For Login Time
//get user Id
            $result = $this->auth_model->get_by_user($user = $this->input->post("username"))->row();
            if (empty($result->user_id)) {
                $user_id = 1;
            } else {
                $user_id = $result->user_id;
            }
//get Login Time
            $result = $this->auth_model->get_loginTime($ip);
            $loginTime = $result['loginTime'];
//Get user Log Data
            $log_value = $this->auth_model->get_logData($user_id, $loginTime);
            if ($log_value['is_active'] == 0) {
                if ($login_success != AUTH_PASS) {
                    $success = 0;
                } else {
                    $success = 1;
                }
                $time_arr = $this->auth_model->get_loginTime($ip);
//$endTime = $time_arr['endTime'];
                $log_count = $this->auth_model->get_logCount($user_id);
                if ($log_count['loginTime'] == null) {
                    $end = 0;
                    $currentTime = 0;
                } else {
                    $currentTime = date("Y-m-d H:i:s", strtotime("now"));
                    $end = date("Y-m-d H:i:s", strtotime($log_count['loginTime']) + 30);
                }
                if ($log_count['count'] == 0) {
                    $count = 1;
                }
                /* else if($currentTime > $endTime)
                  {
                  $count = 1;
                  } */ else {
                    $count = $log_count['count'] + 1;
                }
                if (($count % 5) == 0) {
                    $is_active = 1;
                    $username = $this->input->post('username');
                    $userdetails = $this->auth_model->get_email_against_username($username);
                    $passcode = $this->generate_random_password();
                    $fullname = $userdetails['first_name'] . " " . $userdetails['last_name'];
                    //Mail send
                    $maildata = array('email_address' => $userdetails['email_address'],
                        'username' => $fullname,
                        'passcode' => $passcode);
                    $sendmail = $this->email_send($maildata);
                    if ($sendmail) {
                        $this->auth_model->update_admin(md5($passcode), $userdetails['user_id']);
                    }
                    $endTime = date("Y-m-d H:i:s", strtotime("+30 minutes"));
                } else {
                    $is_active = 0;
                    $endTime = '';
                }
                $this->auth_model->insert_log($user_id, $username, $initialTime, $ip, $is_active, $endTime, $success);
                $log_in_check = true;
            } else {
                $log_in_check = false;
            }
            return $log_in_check;
        }
    }

    public function captcha($str) {
        $captcha_info = $this->session->userdata('captcha_info');
        if ($captcha_info['code'] != $str) {
            $this->form_validation->set_message('captcha', 'The %s was not input correctly');
            return false;
        }
        return true;
    }

    function change_password() {
        $user_id = $this->session->userdata('user_id');
        $acct = array(
            "password" => md5($_POST["password2"]),
            "password_changed" => 1,
            "password_reset" => "" . PASS_RESET_NOT_REQUIRED . "",
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata('username')
        );
// parse data array to update user table
        $this->auth_model->update_password_details($user_id, $acct);
        $data ["subtitle"] = "AA-SchoolHealth AdminUI";
        $data ["action"] = "auth/login/validate_credentials";
        $data ["login_content"] = "login_view/login_form";
        $this->load->view("login/template", $data);
    }

// password change required method
    function password_change_req() {
// set default parameters
        $data ["title"] = "Password Change Required";
        $data ["action"] = site_url("auth/login/password_change_process");
        $data ["success"] = "";
        $data ["error"] = "";
        $data ["user"] = $this->input->post("username");
// load view
        $data ["login_content"] = "login_view/password_change_req";
        $this->load->view("login/template", $data);
    }

    function password_change_process() {
// load database model
        $this->load->model("auth_model");
// set default parameters
        $data ["title"] = "Password Change Required";
        $data ["action"] = site_url("auth/login/password_change_process");
        $data ["success"] = "";
        $data ["error"] = "";
        $data ["user"] = "";
// set empty default form field values
        $this->_set_fields_login();
// set validation properties
        $this->_set_rules_login();
// run validation
        if ($this->form_validation->run() == FALSE) {
            $data ["message"] = "";
        } else {
// get authenticated user id
            $acct = $this->auth_model->get_by_user($user = $this->input->post("username"))->row();
            $this->form_data->user_id = $acct->user_id;
            $this->form_data->current_password = $acct->password;
            $this->form_data->password = $this->input->post("password");
            $this->form_data->password2 = $this->input->post("password2");
// get user id post-back update
            $data ["user_id"] = $acct->user_id;
// validate current password against the user table
            $current_pass = $this->form_data->current_password;
            $new_password = md5($this->form_data->password);
            $conf_password = md5($this->form_data->password2);
// get confirmed password and modify table
            $info = array(
                "confirmed_pass" => $conf_password,
                "user" => $acct->username
            );
            if (!empty($current_pass) && $new_password === $conf_password) {
// call the password change method
                $this->password_change_appld($this->form_data->user_id, $info);
// redirect to person list page
                redirect("auth/login/?PasswordChange=success");
            } else {
// set user message
                $data ["error"] = "<div class=\"alert alert-danger alert-dismissable\">
	                                	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
								 		suIncorrect current password
									</div>";
// load view
                $data ["login_content"] = "login_view/password_change_req";
                $this->load->view("login/template", $data);
            }
        }
    }

// process require password change request
    protected function password_change_appld($user_id, $info) {
        $acct = array(
            "password" => $info ["confirmed_pass"],
            "password_reset" => "" . PASS_RESET_NOT_REQUIRED . "",
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $info ["user"]
        );
// parse data array to update user table
        $this->auth_model->update_password_prompt($user_id, $acct);
// prepare email notification
        $this->email->set_newline("\r\n");
        $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
        $this->email->to($email);
        $this->email->cc("" . CC_EMAIL . "", "" . CC_NAME . "");
        $this->email->subject("Password reset");
        $this->email->message("Your password has been changed. Please return to the " . anchor("" . base_url() . "login", "Login") . " page to verify");
        $this->email->send();
    }

// set empty default form field values
    function _set_fields_login() {
        $this->form_data->user_id = "";
        $this->form_data->current_password = "";
        $this->form_data->password = "";
        $this->form_data->password2 = "";
    }

// validation rules
    function _set_rules_login() {
        $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|min_length[6]|max_length[32]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]|xss_clean');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]|max_length[32]|matches[password]|xss_clean');
        $this->form_validation->set_message("required", "* required");
        $this->form_validation->set_message("isset", "* required");
        $this->form_validation->set_message("valid_date", "date format is not valid. dd-mm-yyyy");
        $this->form_validation->set_error_delimiters("<div class=\"alert alert-danger alert-dismissable\">
                                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>", "</div>");
    }

    Public function email_send($maildata) {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'testmail5210@gmail.com';
        $config['smtp_pass'] = 'CGvak123';
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
        $this->email->to($maildata['email_address']);
        $this->email->cc("" . APPROVAL_ADMIN . "");
        $this->email->subject("Nurse Assessment Login Notification");
        $pass_code_url = base_url() . "auth/login/" . md5($maildata['passcode']);
        $body = "
                        <table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\">
                        <tr>
                        <td>Message</td>
                        <td width=\"300\">
                        Hello {$maildata['username']},<br><br>
                        You have logged in 5 unsuccessful attempts please click the link to login
                        <br><br>
                        <a href='{$pass_code_url}'>{$pass_code_url}</a>
                        <br><br>
                        </td>
                        </tr>
                        </table>";

        $this->email->message($body);
        //$this->email->send();
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    function generate_random_password($length = 8) {
        $caps = range('A', 'Z');
        $small = range('a', 'z');
        $numbers = range('0', '9');
        $final_array = array_merge($caps, $small, $numbers);
        $password = '';
        while ($length--) {
            $key = array_rand($final_array);
            $password .= $final_array[$key];
        }
        return $password;
    }

}
