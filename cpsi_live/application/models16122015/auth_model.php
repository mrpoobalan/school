<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth AdminUI Database Controller
 *
 * @package	CI Controller
 * @category Database Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.0.0-pre
 */
class Auth_model extends CI_Model {

    private $admin_user = "admin_user";
    private $admin_request = "admin_request";
    private $request_assistance = "request_assistance";
    private $group_manager = "role";

    function __construct() {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }

    function validate() {
        $this->db->where("username", $this->input->post("username"));
        $this->db->where("password", md5($this->input->post("password")));
        $this->db->where("status", "1");
        $query = $this->db->get($this->admin_user);
        if ($query->num_rows == 1 && $query->row("password_reset") != 1) {
            return AUTH_PASS;
        } elseif ($query->row("password_reset") == 1) {
            return PASS_RESET_REQUIRED;
        }
    }

    // check registration table for duplicate username or/and email
    private function check_admin_user() {
        $this->db->where("username", $this->input->post("username"));
        $this->db->where("email_address", $this->input->post("email_address"));
        $query = $this->db->get($this->admin_user);

        if ($query->num_rows == 1) {
            return DUPLICATE_ADMIN;
        }
    }

    function admin_request() {
        // check valid admin user table private method
        $response = $this->check_admin_user();

        if ($response == DUPLICATE_ADMIN) {
            return DUPLICATE_ADMIN;
        } else {
            // check for duplicate user before inserting new request...
            $this->db->where("username", $this->input->post("username"));
            $this->db->where("email_address", $this->input->post("email_address"));
            $query = $this->db->get($this->admin_request);
            if ($query->num_rows != 1) {
                // no duplicate record(s) found...
                $new_user = array(
                    "first_name" => $this->input->post("first_name"),
                    "last_name" => $this->input->post("last_name"),
                    "email_address" => strtolower($this->input->post("email_address")),
                    "username" => strtolower($this->input->post("username")),
                    "password" => md5($this->input->post("password")),
                    "password_reset" => "0",
                    "status" => "0",
                    "date_requested" => date("Y-m-d H:i:s")
                );

                $insert = $this->db->insert($this->admin_request, $new_user);
                return $insert;
            } else {
                return DUPLICATE_REG;
            }
        }
    }

    function create_admin() {
        // check for duplicate user before inserting new request...
        $this->db->where("username", $this->input->post("username"));
        $this->db->where("email_address", $this->input->post("email_address"));
        $query = $this->db->get($this->admin_user);
        if ($query->num_rows != 1) {
            // no duplicate record(s) found...
            $new_user = array(
                "first_name" => $this->input->post("first_name"),
                "last_name" => $this->input->post("last_name"),
                "email_address" => $this->input->post("email_address"),
                "username" => $this->input->post("username"),
                "password" => md5($this->input->post("password")),
                "password_reset" => "0",
                "status" => "0",
                "date_created" => date("Y-m-d H:i:s")
            );
            $insert = $this->db->insert($this->admin_user, $new_user);
            return $insert;
        } else {
            return DUPLICATE_ADMIN;
        }
    }

    function list_all() {
        $this->db->order_by("user_id", "asc");
        return $this->db->get($this->admin_user);
    }

    function list_all_pendrequest() {
        $this->db->order_by("user_id", "asc");
        return $this->db->get($this->admin_request);
    }

    function count_all() {
        return $this->db->count_all($this->admin_user);
    }

    function get_by_id($user_id) {
        $this->db->where("user_id", $user_id);
        return $this->db->get($this->admin_user);
    }

    function get_by_user($user) {

        $this->db->where("username", $user);
        return $this->db->get($this->admin_user);
    }

    function save($acct) {
        $this->db->insert($this->admin_user, $acct);
        return $this->db->insert_id();
    }

    function delete($user_id) {
        $this->db->where("user_id", $user_id);
        $this->db->delete($this->admin_user);
    }

    function passreset($email) {
        $this->db->where("email_address", $email);
        return $this->db->get($this->admin_user);
    }

    function update_password($user_id, $acct) {
        $this->db->where("user_id", $user_id);
        $this->db->update($this->admin_user, $acct);
    }

    function update_password_prompt($user_id, $acct) {

        $this->db->where("user_id", $user_id);
        $this->db->update($this->admin_user, $acct);
    }

    function update_password_details($user_id, $acct) {

        $this->db->where("user_id", $user_id);
        $this->db->update($this->admin_user, $acct);
    }

    function reg_error_message($data) {
        $insert = $this->db->insert($this->request_assistance, $data);
        return $insert;
    }

    function password_check($userid) {
        $sel = $this->db->query("select password_changed from admin_user where user_id = '" . $userid . "'");
        $res = $sel->row_array();
        return $res['password_changed'];
    }

    //sridhar Implementation
    public function get_loginTime($ip) {
        $query = $this->db->query("select max(loginTime) as loginTime
					from user_log where ip_addr = '{$ip}'");
        return $query->row_array();
    }

    public function get_logData($user_id, $loginTime) {
        $query = $this->db->query("select count(*) as count,is_active from user_log
							where usr_id = '{$user_id}' and loginTime = '{$loginTime}'");
        return $query->row_array();
    }

    public function get_logCount($user_id) {
        $query = $this->db->query("select count(*) as count,max(loginTime) as loginTime from user_log
						where usr_id = '{$user_id}' and loginSuccess = 0 ");
        return $query->row_array();
    }

    public function get_endTime($user_id) {
        $query = $this->db->query("select max(endTime) as endTime
						from user_log where usr_id = '{$user_id}'");
        return $query->row_array();
    }

    public function insert_log($user_id, $username, $initialTime, $ip, $is_active, $endTime, $success) {

        $data = array('usr_id' => $user_id,
            'user_name' => $username,
            'loginTime' => $initialTime,
            'ip_addr' => $ip,
            'is_active' => $is_active,
            'loginSuccess' => $success,
            'endTime' => $endTime
        );
        $this->db->insert('user_log', $data);
    }

    public function update_logData($user_id, $endTime) {
        $query = $this->db->query("update user_log set is_active = 0
					where endTime = '{$endTime}' and usr_id = '{$user_id}'");
    }

    public function get_username_count($username) {
        $query = $this->db->query("select username from admin_user where username = '" . $username . "' ");
        $count = $query->num_rows();
        if ($count == 0):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    public function get_email_against_username($username) {
        $query = $this->db->query("select * from admin_user where username = '" . $username . "' ");
        $count = $query->num_rows();
        if ($count == 0):
            return FALSE;
        else:
            $res = $query->row_array();
            return $res;
        endif;
    }

    public function check_passcode($passcode_qstring, $username_passcode) {
        $query = $this->db->query("select * from admin_user where username = '" . $username_passcode . "' AND passcode='" . $passcode_qstring . "'");
        $count = $query->num_rows();
        if ($count == 0):
            return FALSE;
        else:
            return TRUE;
        endif;
    }

    public function update_passcode($passcode_qstring, $username_passcode) {
        $query = $this->db->query("update admin_user set passcode = 0 where username = '" . $username_passcode . "' AND passcode='" . $passcode_qstring . "'");
    }

    public function update_admin($pass_code, $user_id) {
        $query = $this->db->query("update admin_user set passcode = '{$pass_code}' where user_id = '{$user_id}'");
    }

}
