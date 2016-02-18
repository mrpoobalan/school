<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Pilot Admin Controller
 *
 * @package	Admin Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.1.0-pre
 */
require APPPATH . '/libraries/aah_controller.php';

class Admin extends AAH_Controller {

// number of records per page
    private $limit = 10;
    private $acl_table;

    public function __construct() {
        parent::__construct();
        $this->is_logged_in();
// no page caching
        $this->output->nocache();
// bootstrap dashboard and access control model
        $this->load->model("adminui_model", "", TRUE);
        $this->load->model("assessment_model", "", TRUE);
        $this->acl_conf = (object) $this->config->item("acl");
        $this->acl_table = & $this->acl_conf->table;
    }

    public function is_logged_in() {
        $is_logged_in = $this->session->userdata("is_logged_in");
        if (!isset($is_logged_in) || $is_logged_in != TRUE) {
            redirect("auth/login");
        }
    }

// get user info
    public function user_info() {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_students")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Return to previous page..."'));
        }
// get user details
        $user = $this->adminui_model->get_by_user($user = $this->session->userdata("username"))->row();
        return $user;
    }

// load users account view
    public function account_manager($offset = 0) {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_nurses")) {
            redirect("access_control/admin/access_denied/");
        }
//offset
        $uri_segment = 4;
        if ($viewModeUserID != null) {
            $uri_segment++;
        }
        $offset = $this->uri->segment($uri_segment);

// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

        $count = $this->adminui_model->count_assigned_user();
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
// load data
# fetch all users required for this view
        $isAdminUser = ($user_role->name != "Nurse Supervisor" && $user_role->name != "Program Manager");
        $users = $this->assessment_model->get_user_management_chain($user->user_id, null, false, $this->limit, $offset, $isAdminUser);
// generate table data
        $this->table->set_empty("&nbsp; ");
        $table_setup = array("table_open" => "<table id=\"results\" name=\"results\" class=\"tablesorter\">");
        $this->table->set_heading("Name", "User Level", "Nurse Supervisor", "Program Manager", "Actions");
        $i = 0 + $offset;
        $view = array("class" => "btn btn-success btn-sm", "type" => "button");
        $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
        $delete = array("class" => "btn btn-danger btn-sm", "type" => "button",
//        $add = array("class")
            "data-toggle" => "confirmation");
        foreach ($users as $acct) {
// echo "<pre>";
// print_r($acct);
// $acct is user list
// Reset variables
            $managed_by = "NONE";
            $manager = '';
            $nurse_supervisor = 'NA';
            $program_manager = 'NA';
// Get roles for the user
            $acct_role = $this->adminui_model->get_user_role($acct->user_id)->name;
//            exit;
// Who is this user managing? So get list of managed users (Program manager)
            $manage_list = $this->adminui_model->get_managed_users($acct->user_id)->result();
// Who is managing this user? Get this list as well
//Get program manager
            $manage_by_list = $this->adminui_model->get_user_managers($acct->user_id);

            if ((!empty($manage_list) || !empty($manage_by_list)) && ($manage_by_list[0]->user_id == $this->session->userdata('user_id'))) {
//Check the role of the listee and sort accordingly
                if ($acct_role == 'Nurse Supervisor') {
//Get this nurse supervisor's name
                    if (!empty($manage_by_list)) {

// This account may have a Program Manager so get the managed_by info
                        $program_manager = $manage_by_list[0]->first_name . " " . $manage_by_list[0]->last_name;
                    }
                } elseif ($acct_role == 'Nurse') {


                    if (!empty($manage_list)) {

                        $nurse_supervisor = $manage_by_list[0]->first_name . " " . $manage_by_list[0]->last_name;
// also find the Nurse Manager
                        $programManager = $this->adminui_model->get_user_managers($manage_by_list[0]->user_id);
                        $program_manager = $programManager[0]->first_name . " " . $programManager[0]->last_name;
                    }
                }
            } else {
//echo "<pre>";
// print_r($manage_list);
                $manage_by_list_ns = $this->adminui_model->get_manageby_id($manage_list[0]->manage_by)->row();

                $programManager = $this->adminui_model->get_user_managers($manage_by_list[0]->user_id);
//                echo $manage_by_list[0]->user_id;
//                echo '<br>';
//                 echo $acct->user_id;
//                 echo "<pre>";
//                print_r($programManager);
//                echo "</pre>";

                if ($user_role->level <= 20 && $acct_role == "Nurse Supervisor"):
                    $nurse_supervisor = $programManager[0]->first_name . " " . $programManager[0]->last_name; //. '==' . $manage_by_list[0]->user_id
                    $program_manager = $manage_by_list_ns->first_name . " " . $manage_by_list_ns->last_name; // . '===' . $manage_by_list_ns->user_id
                else:
                    $nurse_supervisor = $manage_by_list_ns->first_name . " " . $manage_by_list_ns->last_name; // . '==' . $manage_by_list_ns->user_id
                    $program_manager = $programManager[0]->first_name . " " . $programManager[0]->last_name; // . '==' . $programManager[0]->user_id
                endif;
            }
            $blockActivateUrl = anchor("access_control/admin/activate_user/" . $acct->user_id, "Activate");
            if ($acct->status) {
                $blockActivateUrl = anchor("access_control/admin/block_user/" . $acct->user_id, "Block");
            }

            $this->table->add_row("$acct->first_name $acct->last_name", $acct_role, $nurse_supervisor, $program_manager, anchor("access_control/nurse/nurse_view/" . $acct->user_id, "View") . " | " .
                    anchor("access_control/nurse/nurse_update/" . $acct->user_id, "Edit") . " | " .
                    $blockActivateUrl
            );
            $nurse_supervisor = 'NA';
            $program_manager = 'NA';
        }
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = "Account Manager";
        $data["panel_title"] = "AA-SchoolHealth Accounts";
        $data["action_passwd_chg"] = site_url("access_control/admin/password_change_process");
        $data["add_admin_process"] = site_url("access_control/admin/add_admin");
        $data["error"] = "";
        $data["roles"] = $this->adminui_model->get_group();
        $data["role_array"] = $this->adminui_model->user_current_group();
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
// load account view
        if ($user_role->name == "Nurse Supervisor") {
            $data["acl_content"] = "access_control_view/nurse_manager";
        } else {
            $data["acl_content"] = "access_control_view/account_manager";
        }
        $this->load->view("access_control/template", $data);
    }

    public function account_view($user_id) {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_users")) {
            $this->access_denied();
        }
        $role_type = $this->adminui_model->get_roletype();
        $data["roletype_array"] = $role_type;
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
// set common properties
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = "Account View";
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $data["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of users", array("type" => "button"));
// get person details
        $data["acct"] = $this->adminui_model->get_by_id($user_id);
// load view
        $data["acl_content"] = "access_control_view/account_view";
        $this->load->view("access_control/template", $data);
    }

    public function account_update($user_id) {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "edit_user")) {
            $this->access_denied();
        }
// set validation properties
        $this->_set_rules();
// prefill form values
        $acct = $this->adminui_model->get_by_id($user_id);
        $this->form_data = new stdClass();
        $this->form_data->user_id = $acct->user_id;
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $this->form_data->first_name = $acct->first_name;
        $this->form_data->last_name = $acct->last_name;
        $this->form_data->username = $this->session->userdata("username");
        $this->form_data->email_address = $acct->email_address;
        $this->form_data->status = strtoupper($acct->status);
        $this->form_data->date_created = date('m/d/Y', strtotime($acct->date_created));
        if ($this->adminui_model->get_managed_users($acct->user_id)->result()) {
            $manager = $this->adminui_model->get_managed_users($acct->user_id)->result();
            $this->form_data->managed_by = $manager[0]->first_name . " " . $manager[0]->last_name;
        } else {
            $this->form_data->managed_by = "NONE";
        }
        $data["user"] = new stdClass();
// set common properties
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = 'Modify Account';
        $data["roles"] = $this->adminui_model->get_group();
        $data["user"]->roles = $this->adminui_model->get_user_roles($user_id);
        $data["role_list"] = $this->adminui_model->get_all_roles();
        $data["message"] = "";
        $data["error"] = "";
        $data["success"] = "";
        $data["action"] = site_url("access_control/admin/account_modify");
        $data["action_passwd_chg"] = site_url("access_control/admin/password_change_process");
        $data["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of users", array("type" => "button"));
        if (is_array($data["user"]->roles)) {
            foreach ($data["role_list"] as &$role) {
                $role->set = in_array($role, $data["user"]->roles);
            }
        } else {
            foreach ($data["role_list"] as &$role) {
                $role->set = FALSE;
            }
        }
// load managed user method
        $data["manage_user"] = $this->user_managed_by($user_id);
// load view
        $data["acl_content"] = "access_control_view/account_modify";
        $this->load->view("access_control/template", $data);
    }

    public function account_delete($user_id) {
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "delete_user")) {
            $this->access_denied();
        }
// set validation properties
// $this->_set_rules();
// prefill form values
        $acct = $this->adminui_model->get_by_id($user_id)->row();
        $this->form_data->user_id = "$user_id";
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $this->form_data->first_name = $acct->first_name;
        $this->form_data->last_name = $acct->last_name;
        $this->form_data->username = $acct->username;
        $this->form_data->email_address = $acct->email_address;
        $this->form_data->status = strtoupper($acct->status);
        $this->form_data->date_created = date('m/d/Y', strtotime($acct->date_created));
        $data ["role_list"] = $this->adminui_model->get_all_roles();
        $data ["perm_list"] = $this->adminui_model->get_all_perms();
// set common properties
        $data ["title"] = "AA-SchoolHealth Dashboard";
        $data ["subtitle"] = 'YOU ARE ABOUT TO DELETE A USER ACCOUNT';
        $data ["del_account"] = site_url("access_control/admin/del_account_process/{$user_id}");
        $data ["action"] = site_url("access_control/admin/account_delete");
        $data ["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of users", array(
            "class" => "btn btn-primary",
            "type" => "button"
        ));
// load view
        $data ["acl_content"] = "access_control_view/account_delete";
        $this->load->view("access_control/template", $data);
    }

    public function account_modify() {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "edit_user")) {
            $this->access_denied();
        }
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
// set common properties
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = "Modify Account";
        $data["message"] = "";
        $data["passwd_message"] = "";
        $data["error"] = "";
        $data["passwd_error"] = "";
        $data["success"] = "";
        $data["passwd_success"] = "";
        $data["action"] = site_url("access_control/admin/account_modify");
        $data["action_passwd_chg"] = site_url("access_control/admin/password_change_process");
        $data["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of users", array("type" => "button"));
        $data["roles"] = $this->adminui_model->get_group();
        $data["role_array"] = $this->adminui_model->user_current_group();
// set empty default form field values
        $this->_set_fields();
// set validation properties
        $this->_set_rules();
// run validation
        if ($this->form_validation->run() == FALSE) {
            $data["message"] = "";
            $data["user"] = $this->adminui_model->get_user($user_id = $this->input->post("user_id"));
            $data["user"]->roles = $this->adminui_model->get_user_roles($user_id = $this->input->post("user_id"));
            $data["role_list"] = $this->adminui_model->get_all_roles();
        } else {
// save modification;
            if ($this->adminui_model->edit_user_roles($user_id = $this->input->post("user_id"), $this->input->post("roles"))) {
                $user_id = $this->input->post("user_id");

                $acct = array("first_name" => $this->input->post("first_name"),
                    "last_name" => $this->input->post("last_name"),
                    "username" => $this->session->userdata('username'),
                    "email_address" => $this->input->post("email_address"),
                    "password" => md5($this->input->post("password")),
                    "status" => $this->input->post("status"),
                    "modified_date" => date("Y-m-d H:i:s"),
                    "modified_by" => $this->session->userdata('username'));

                $this->adminui_model->account_update($user_id, $acct);
//TODO ADD MANAGE BY
// set user message
                $data["message"] = "Account successfully updated...";
            } else {
                show_error("Failed assign user.");
            }
        }
// prefill form values
        $acct = $this->adminui_model->get_by_id($user_id);
        $this->form_data->user_id = "$user_id";
        $data["success"] = "";
        $data["roles"] = $this->adminui_model->get_group();
        $data["user"]->roles = $this->adminui_model->get_user_roles($user_id);
        $data["role_list"] = $this->adminui_model->get_all_roles();
        $this->form_data->username = $acct->username;
        $this->form_data->first_name = $acct->first_name;
        $this->form_data->last_name = $acct->last_name;
        $this->form_data->status = strtoupper($acct->status);
        if (is_array($data["user"]->roles)) {
            foreach ($data["role_list"] as &$role) {
                $role->set = in_array($role, $data["user"]->roles);
            }
        } else {
            foreach ($data["role_list"] as &$role) {
                $role->set = FALSE;
            }
        }
// load managed user method
        $data["manage_user"] = $this->user_managed_by($user_id);
// load view
        $data["acl_content"] = "access_control_view/account_modify";
        $this->load->view("access_control/template", $data);
    }

//user password change
    public function user_password_change($user_id) {
// check roles and permissions

        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "change_password")) {
            $this->access_denied();
        }
        $this->session->unset_userdata('change_password_success_msg');
// set validation properties
        $this->_set_rules();
// prefill form values
        $this->form_data = new stdClass();
        $this->form_data->user_id = "$user_id";
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $data["message"] = "";
        $data["passwd_error"] = "";
        $data["passwd_success"] = "";
        $data["action_passwd_chg"] = site_url("access_control/admin/password_change_process");
        $data["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of users", array("type" => "button"));
// load view
        $data["acl_content"] = "access_control_view/user_pass_change";
        $this->load->view("access_control/template", $data);
    }

    public function create_user() {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_user")) {
            $this->access_denied();
        }
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $role_type = $this->adminui_model->get_roletype($user_role->level);
        $data["roletype_array"] = $role_type;
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $data["add_admin_process"] = site_url("access_control/admin/add_admin");
        $data["error"] = "";
        $data["acl_content"] = "access_control_view/create_user";
        $this->load->view("access_control/template", $data);
    }

    public function user_byjson() {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "access_acl")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Return to previous page..."'));
        }
        $users = $this->adminui_model->get_allusers_byjson($term = $this->input->post("term"));

        if ($users->num_rows() > 0) {
            foreach ($users->result() as $row) {
                $data[] = array('label' => $row->last_name . " " . $row->first_name, 'value' => $row->last_name . " " . $row->first_name); //Add a row to array
            }
        }
        echo json_encode($data);
    }

    public function resolveMgr() {
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post("uid")) {
            $userId = $this->input->post("uid");
            $resolvedUser = $this->adminui_model->get_user_managers($userId, true);
            print $resolvedUser->first_name . ' ' . $resolvedUser->last_name;
        }
    }

    public function nslist() {
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $userlevel = $user_role->level;
        if (!empty($_GET)) {
            $keyword = $_GET["term"];
            $user_level = $_GET['prof'];
        }
        if ($user_level == 6):
            $user_list = $this->adminui_model->list_all_against_role_nurse($userlevel)->result();
        else:
            $user_list = $this->adminui_model->list_all_against_role()->result();
        endif;

//        $user_list = $this->adminui_model->list_all()->result();
// get user role

        foreach ($user_list as $user) {
            if ($this->adminui_model->get_user_role($user->user_id, $keyword)->name == 'Nurse') {
//  echo "1";
                $nurse_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
                $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name);
            } elseif ($this->adminui_model->get_user_role($user->user_id, $keyword)->name == "Nurse Supervisor") {
//echo "2";
                $nurse_supervisor_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
                $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name, 'ids' => $user->user_id);
            } elseif ($this->adminui_model->get_user_role($user->user_id, $keyword)->name == "Program Manager") {
// echo "3";
                $program_manager_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
                $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name);
            }
        }
        echo json_encode($data['message']);
    }

    public function nslist_edit() {
        if (isset($_GET['term'])) {
            $keyword = strtolower($_GET['term']);
        }
        $user_list = $this->adminui_model->list_all_edit()->result();
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        foreach ($user_list as $user) {
            $nurse_supervisor_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
            $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name, 'ids' => $user->user_id);
        }
        echo json_encode($data['message']);
    }

    /*
     * Program manager list edited for auto complete
     * Added this function on 28/01/2016
     *
     */

    public function pmlist_edit() {
        if (isset($_GET['term'])) {
            $keyword = strtolower($_GET['term']);
        }
        $user_list = $this->adminui_model->list_all_editpm()->result();
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        foreach ($user_list as $user) {
            $nurse_supervisor_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
            $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name, 'ids' => $user->user_id);
        }
        echo json_encode($data['message']);
    }

    public function roles_select_ui() {
        $msg = "";
        $nurse_array = array();
        $nurse_supervisor_array = array();
        $program_manager_array = array();
        $user_list = $this->adminui_model->list_all()->result();
        $keyword = $_GET["term"];
//$keyword = "Dan";
        $roles_json = '';
        $role_id = $this->input->get("rid");
        $userEditMode = $this->input->post("uem");
        $editedUserId = $this->input->post("cid");
// get the management chain of the edited user
        $singleRec = true;
        $editedUserManager = $this->adminui_model->get_user_managers($editedUserId, $singleRec);
        if ($editedUserManager->user_id) {
            $editedUserManager2 = $this->adminui_model->get_user_managers($editedUserManager->user_id, $singleRec);
        }
// get the nurses assigned (if the edited user = Nurse Supervisor)
        $usersManagedByEditedUser = array();
        if ($role_id == "Nurse Supervisor" || $role_id == "Program Manager") {
            $result = $this->adminui_model->get_user_manage_by($editedUserId)->result();
            foreach ($result as $row) {
                $usersManagedByEditedUser[] = $row->manage_id;
            }
        }
        foreach ($user_list as $user) {
            if ($this->adminui_model->get_user_role($user->user_id, $keyword)->name == 'Nurse') {
                $nurse_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
                $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name);
            } elseif ($this->adminui_model->get_user_role($user->user_id, $keyword)->name == "Nurse Supervisor") {
                $nurse_supervisor_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
                $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name);
            } elseif ($this->adminui_model->get_user_role($user->user_id, $keyword)->name == "Program Manager") {
                $program_manager_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name, "user_id" => $user->user_id);
                $data['message'][] = array('label' => $user->first_name . " " . $user->last_name, 'value' => $user->first_name . " " . $user->last_name);
            }
        }
        if (($role_id == "Deputy Director") || ($role_id == "Director")) {

        } elseif ($role_id == "Program Manager") {
//            $msg .="<fieldset >
//                            <label>Select Nurse Supervisors </label>
//                            <section>
//                            <input type='text'  name='multi_nurse_supervisors[]' id='multi_nurse_supervisors'>
//                            </section>
//                            </fieldset>";
        } elseif ($role_id == "Nurse Supervisor") {
            $msg .="<fieldset >
                            <label>Select Program Manager</label>
                            <section>
                            <input type='text'  name='program_manager' id='program_manager'>
                            </section>
                            </fieldset>";

            $msg.= " <fieldset>
						<label>Vacant</label>
						<section>
							<select name='vacant'>
								<option value=''>Select an option</option>
								<option value='1'>Yes</option>
								<option value='0'>No</option>
							</select>
						</section>
					</fieldset>";

// Nurse List
//            $msg .="<fieldset >
//                            <label>Select Nurses (Ctrl+Click to make the selection)</label>
//                            <section>
//                            <input type='text'  name='multi_nurses[]' id='multi_nurses'>
//                            </section>
//                            </fieldset>";
        } elseif ($role_id == "Nurse") {



            $msg .="<fieldset >
                           <label>Select Nurse Supervisor</label>
                            <section>
                            <input type='text'  name='nurse_supervisor' id='nurse_supervisor'>
                            </section>
                            </fieldset>";
        }

        print_r($msg);
    }

// create admin account form
    public function add_admin() {

// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_user")) {
            $this->access_denied();
        }
        $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean");
        $this->form_validation->set_rules("last_name", "Last name", "trim|required|xss_clean");
        $this->form_validation->set_rules("username", "Username", "trim|required|min_length[4]|max_length[16]|xss_clean");
        $this->form_validation->set_rules("email_address", "Email Address", "trim|required|valid_email|xss_clean");

        if ($this->input->post("role") == 'Program Manager') {
            $this->input->post("role") == 4;
        }
        if ($this->input->post("role") == 'Nurse Supervisor') {
            $this->input->post("role") == 5;
        }
        if ($this->input->post("role") == 'Nurse') {
            $this->input->post("role") == 6;
        }
        if ($this->form_validation->run() == FALSE) {
// set common properties
            $this->session->set_flashdata('data', validation_errors());
            redirect("access_control/admin/create_user/?admin_error_message=error");
        } else {
// call admin model and process new admin
// First save the new admin and get the new id.
            $new_user_id = $this->adminui_model->admin_add_user();
            if ($this->input->post("role") == 4 || $this->input->post("role") == 'Program Manager') {
//Get nurse supervisor subordinate ids and make array
//                $managed_user_1 = array();
//                foreach ($this->input->post('multi_nurse_supervisors') as $nurse_sup) {
//                    $managed_user_1[] = array(
//                        'manage_id' => $new_user_id,
//                        'manage_by' => $this->session->userdata('user_id'),
//                            //'manage_by' => $nurse_sup,
//                    );
//                }
//
//                $this->adminui_model->managed_by($managed_user_1);
            }
//            elseif ($this->input->post("role") == 5 || $this->input->post("role") == 'Nurse Supervisor')
//            {
//                //Get manager details
//                $overseer = $this->adminui_model->get_by_user($this->input->post('program_manager'))->row();
//                //prepare array for user_manager table
//                // Array1  managed_id => self, managed_by => Program Manager
//                $managed_user_1 = array(
//                    array(
//                        'manage_by' => $this->session->userdata('user_id'),
//                        'manage_id' => $new_user_id
//                    )
//                );
//                //Save managed_user_1 to user_manager table
//                $this->adminui_model->managed_by($managed_user_1);
//
//            }
            elseif ($this->input->post("role") == 5 || $this->input->post("role") == 'Nurse Supervisor') {
//                exit('d');
//Get manager details
                $overseer = $this->adminui_model->get_by_user($this->input->post('program_manager'))->row();

                $pm_name = $this->input->post('program_manager');
                $pm_id = $this->adminui_model->get_by_user_name($pm_name);

//prepare array for user_manager table
// Array1  managed_id => self, managed_by => Program Manager
                $managed_user_1 = array(
                    array(
                        'manage_by' => $pm_id,
                        'manage_id' => $new_user_id
                    )
                );
//Save managed_user_1 to user_manager table
//echo "<pre>";
//print_r($managed_user_1);
                $this->adminui_model->managed_by($managed_user_1);
//echo $this->db->last_query();
//exit;
            } elseif ($this->input->post("role") == 6 || $this->input->post("role") == 'Nurse') {
                $nurse_supervisor_id = $this->adminui_model->get_nurse_supervisor_id_val($this->input->post('nurse_supervisor'));
                $overseer = $this->adminui_model->get_by_user($this->input->post('nurse_supervisor'))->row();
                $managed_user_1 = array(
                    array(
                        'manage_by' => $nurse_supervisor_id,
                        'manage_id' => $new_user_id
                    )
                );
                $this->adminui_model->managed_by($managed_user_1);
            }

            redirect("access_control/admin/account_manager");
        }
    }

    private function add_admin_process($managed_user) {
// validation complete
//Unset session message

        $response = $this->adminui_model->admin_add_user($managed_user);
        if ($response == NO_DUPLICATE_ADMIN) {
// if no duplicate admin account is found, send an email notification to the new admin
            $name = $this->input->post("first_name") . " " . $this->input->post("last_name");
            $email = $this->input->post("email_address");
            /* according to specs, only password should be sent to new user.
              | the user should already know their username according to organization standards
              |
             */
            $this->email->set_newline("\r\n");
            $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
            $this->email->to($email);
            $this->email->cc("" . APPROVAL_ADMIN . "");
            $this->email->subject("AA-SchoolHealth account created");
            $body = "
			<table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\">
				<tr>
					<td>Name</td>
					<td>{$name}</td>
				</tr>
				<tr>
					<td>Message</td>
					<td width=\"300\">
						{$name} has access to AA-SchoolHealth Dashboard.<br>
						Password: {$this->input->post("password2")}<br>
						Please " . anchor("" . base_url() . "auth/login", "Login") . " at your earliest convenience and change your password.
					</td>
				</tr>
			</table>";

            $this->email->message($body);
            if ($this->email->send()) {
// get user details
                $user = $this->adminui_model->get_by_user($user = $this->input->post("username"))->row();
                redirect("access_control/admin/account_manager/create_user/?success_message=true&user={$user->user_id}#add_admin");
            } else {
                show_error($this->email->print_debugger());
            }
        } elseif ($response == DUPLICATE_ADMIN) {
// redirect to password tab on duplicate admin error
            redirect("access_control/admin/account_manager/create_user/?admin_error_message=true#add_admin");
        } elseif ($response == DUPLICATE_REG) {
// redirect to password tab on registered user error
            redirect("access_control/admin/account_manager/create_user/?reg_error_message=true#add_admin");
        }
    }

// delete user
    public function del_account_process($user_id) {
// check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "delete_user")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $this->adminui_model->del_user($user_id);
        redirect("access_control/admin/account_manager/?del_success_message=success");
    }

// admin password change...
    public function password_change_process() {
// set default parameters
        $data["passwd_success"] = "";
        $data["passwd_error"] = "";
        $data["user"] = "";
// set empty default form field values
        $this->_set_passwd_fields();
// set validation properties
        $this->_set_passwd_rules();
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $data["userrole"] = $user_role;
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        if ($this->form_validation->run() == FALSE) {
            $data["message"] = "";
        } else {
// get authenticated user user_id
            $acct = $this->adminui_model->get_by_id($user_id = $this->input->post("user_id"));
            $this->form_data->user_id = $acct->user_id;
            $this->form_data->password = $acct->password;
// get user user_id post-back update
            $data["user_id"] = $acct->user_id;
            $data["email_address"] = $acct->email_address;

// process password change
            $new_password = md5($this->input->post("password"));
            $conf_password = md5($this->input->post("password2"));
            if ($new_password === $conf_password) {
// call the password change method
                $this->password_change_admin($this->form_data->user_id, $conf_password, $acct->email_address);
                $this->session->set_userdata('change_password_success_msg', 'Password changed successfully');
            } else {
// redirect password change profile tab with error message
                $this->session->set_flashdata('change_password_failiure', 'Invalid Password');
                redirect("access_control/admin/account_update/{$acct->user_id}/?PasswordChangeError=error#password-pills");
            }
        }
        $data["acl_content"] = "access_control_view/user_pass_change";
        $this->load->view("access_control/template", $data);
    }

// process password by super admin
    protected function password_change_admin($user_id, $conf_password, $email) {

        $acct = array("password" => $conf_password,
            "password_reset" => 0,
            "modified_date" => date("Y-m-d H:i:s"),
            "modified_by" => $this->session->userdata("username"));
// parse data array to update user table
        $this->adminui_model->update_password_prompt($user_id, $acct);
// prepare email notification
        $this->email->set_newline("\r\n");
        $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
        $this->email->to($email);
        $this->email->cc("" . CC_EMAIL . "", "" . CC_NAME . "");
        $this->email->subject("Password reset by admin");
        $this->email->message("You password has been changed to: <strong>" . $this->input->post("password2") . "</strong>. Please return to the " . anchor("" . base_url() . "login", "Login") . " page to verify");
        $this->email->send();
    }

// user managened by...
    protected function user_managed_by($user_id) {
// load data
        $emply = $this->adminui_model->get_managed_users($user_id)->result();
// generate table data
        $this->table->set_empty("&nbsp;");
        $tbl_init = array("table_open" => "<table id=\"results\" width=\"250\">");
        $this->table->set_heading("Supervisor", "Resource(s)");
        foreach ($emply as $emp) {
            $this->table->add_row($emp->first_name . " " . $emp->last_name);
        }
        $this->table->set_template($tbl_init);
        return $this->table->generate();
    }

// set empty default form field values
    protected function _set_fields() {
        $this->form_data->user_id = "";
        $this->form_data->first_name = "";
        $this->form_data->last_name = "";
        $this->form_data->email_address = "";
        $this->form_data->status = "";
        $this->form_data->username = "";
    }

// validation rules
    protected function _set_rules() {
        $this->form_validation->set_rules("first_name", "First Name", "trim|required|xss_clean");
        $this->form_validation->set_rules("last_name", "Last name", "trim|required|xss_clean");
        $this->form_validation->set_rules("status", "Account Status", "trim|required|xss_clean");
        $this->form_validation->set_rules("roles", "Roles", "required");
        $this->form_validation->set_rules("email_address", "Email Address", "trim|required|valid_email|xss_clean");
        $this->form_validation->set_message("required", "* required");
        $this->form_validation->set_message("isset", "* required");
        $this->form_validation->set_message("valid_date", "date format is not valid. dd-mm-yyyy");
        $this->form_validation->set_error_delimiters("<div class=\"alert alert-danger alert-dismissable\">
                                	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>", "</div>");
    }

// set empty default form field password values
    protected function _set_passwd_fields() {
        $this->form_data->password = "";
        $this->form_data->password2 = "";
    }

// validation rules
    protected function _set_passwd_rules() {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
        $this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]|max_length[32]|matches[password]');
        $this->form_validation->set_message("required", "* required");
        $this->form_validation->set_message("isset", "* required");
        $this->form_validation->set_message("valid_date", "date format is not valid. dd-mm-yyyy");
        $this->form_validation->set_error_delimiters("<div class=\"alert alert-danger alert-dismissable\">
                                	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>", "</div>");
    }

// load error message
    public function access_denied() {
        $this->load->view("custom_errors/access_denied");
    }

    public function form_view($wizardNumber) {
        $this->form_update($wizardNumber, true);
    }

// adding handler for form update (driven from user/student search)
    public function form_update($wizardNumber, $viewOnly = false) {
//Pass wizard id here
        /*
         * Assign session for editing the value
         */

        $form = $this->uri->segment(5);

        $sql = $this->assessment_model->delete_autosave();
        $wiz = explode("-", $wizardNumber);
        if (!empty($wiz[3])):
            $this->session->set_userdata('reviewassesment', $wiz[3]);
            $this->session->set_userdata('reviewappraisal', $wiz[3]);
        endif;
        if (!empty($wiz[1])):
            $wizardNum = end(explode("_", $wiz[0]));

            $this->session->set_userdata('sifnumberval', $wizardNum);
            $sql = $this->adminui_model->check_record($wizardNum);
            if ($sql == 0 || $sql > 0):
                $data = array("rec_value" => $wizardNum, "user_id" => $this->session->userdata('user_id'));
                $sql = $this->adminui_model->session_record($data);
            else:
                $this->session->set_flashdata('exist_user_check', 'Record already busy with another user!');
                redirect('/search/student_search/find_student');
            endif;
        endif;
        $wizardids = explode('-', $wizardNumber);
        $wizardid = $wizardids[1];
        $wizardval = $wizardids[0];
        $this->session->set_userdata('sifnumber', $wizardid);
// parse the wizard number for the parts we need
        $wizardNumberParts = explode('_', $wizardval);
// we are making implicit assumption that the wizard number is of the format {appraisal}_wiz02_{Sif}
        $formType = $wizardNumberParts[0];
        $sifNumber = $wizardNumberParts[2];
        $pseudoWizard = array('sif' => $sifNumber, 'wizard_id' => $wizardid, 'viewOnly' => $viewOnly);
// make sure our form type is lower case (thanks unix)
        $formType = strtolower($formType);
// re-direct now
        if ($formType == "appraisal") {
            $pseudoWizardName = "wiz01";

            if ($viewOnly) {
//$redirectPath = "/health_appraisal/appraisal/view_appraisal/" . $wiz[2];
                if (!empty($form) && $form == "form"):
                    $redirectPath = "/health_appraisal/appraisal/view_appraisal/" . $wiz[2] . "/form";
                elseif (!empty($form) && $form == "review"):
                    $redirectPath = "/health_appraisal/appraisal/view_appraisal/" . $wiz[2] . "/review";
                else:
                    $redirectPath = "/health_appraisal/appraisal/view_appraisal/" . $wiz[2];
                endif;
            }

            else {
                $redirectPath = "/health_appraisal/appraisal/wizard_01/" . $wiz[2];
            }
        } elseif ($formType == "assessment") {
            $pseudoWizardName = "wiz01";

            if ($viewOnly) {
                if (!empty($form) && $form == "form"):
                    $redirectPath = "/nurse_assessment/assessment/view_assessment/" . $wiz[2] . "/form";
                elseif (!empty($form) && $form == "review"):
                    $redirectPath = "/nurse_assessment/assessment/view_assessment/" . $wiz[2] . "/review";
                else:
                    $redirectPath = "/nurse_assessment/assessment/view_assessment/" . $wiz[2];
                endif;
            }
            else {
                $redirectPath = "/nurse_assessment/assessment/wizard_01/" . $wiz[2];
            }
        }
// save the pseudo wizard
        $this->SaveWizardData($pseudoWizardName, $pseudoWizard);
// redirect now
        redirect($redirectPath, 'location');
// not really necessary, but just in case...
        exit;
    }

// adding handler for form update (driven from user/student search)
    public function form_copy($wizardNumber, $viewOnly = false) {
//Pass wizard id here
        /*
         * Assign session for editing the value
         */
        $sql = $this->assessment_model->delete_autosave();
        $wiz = explode("-", $wizardNumber);
        if (!empty($wiz[1])):
            $wizardNum = end(explode("_", $wiz[0]));
            $this->session->set_userdata('sifnumberval', $wizardNum);
            $sql = $this->adminui_model->check_record($wizardNum);
            if ($sql == 0 || $sql > 0):
                $data = array("rec_value" => $wizardNum, "user_id" => $this->session->userdata('user_id'));
                $sql = $this->adminui_model->session_record($data);
            else:
                $this->session->set_flashdata('exist_user_check', 'Record already busy with another user!');
                redirect('/search/student_search/find_student');
            endif;
        endif;
        $wizardids = explode('-', $wizardNumber);
        $wizardid = $wizardids[1];
        $wizardval = $wizardids[0];
        $this->session->set_userdata('sifnumber', $wizardid);
// parse the wizard number for the parts we need
        $wizardNumberParts = explode('_', $wizardval);
// we are making implicit assumption that the wizard number is of the format {appraisal}_wiz02_{Sif}
        $formType = $wizardNumberParts[0];
        $sifNumber = $wizardNumberParts[2];
// save the sif number and hand off control/redirect to page 1 of the edit form
// that should autoload the data for review/edit
        $pseudoWizard = array('sif' => $sifNumber, 'wizard_id' => $wizardid, 'viewOnly' => $viewOnly);
// make sure our form type is lower case (thanks unix)
// re-direct now
        if ($formType == "appraisal") {
            $pseudoWizardName = "wiz01";
            if ($viewOnly) {
                $redirectPath = "/health_appraisal/appraisal/view_appraisal";
            } else {
                $redirectPath = "/health_appraisal/appraisal/wizard_01/copy/" . $wiz[2];
            }
        } elseif ($formType == "assessment") {
            $pseudoWizardName = "wiz01";
            if ($viewOnly) {
                $redirectPath = "/nurse_assessment/assessment/view_assessment";
            } else {
                $redirectPath = "/nurse_assessment/assessment/wizard_01/copy/" . $wiz[2];
            }
        }
// save the pseudo wizard
        $this->SaveWizardData($pseudoWizardName, $pseudoWizard);
// redirect now
        redirect($redirectPath, 'location');
// not really necessary, but just in case...
        exit;
    }

// view all versions
    public function view_all_versions($wizardNumber, $viewModeUserID = null) {
//offset
        $uri_segment = 4;
        $offset = $this->uri->segment($uri_segment);
// parse the wizard number for the parts we need
        $wizardNumberParts = explode('_', $wizardNumber);
// we are making implicit assumption that the wizard number is of the format {appraisal}_wiz02_{Sif}
        $formType = $wizardNumberParts[0];
        $sifNumber = $wizardNumberParts[2];
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $result_page = $this->uri->segment(5);
        if (!empty($result_page) && $result_page <> "res"):
// load data
            $version = $this->assessment_model->get_forms_awaiting($this->limit, $offset, $viewModeUserID, $user_role->level);
            $selected_version = $this->adminui_model->get_version_list($this->limit, $offset, $sifNumber)->row();
            foreach ($version as $defaultdata) {
                $defaultval = array("sif" => $selected_version->wizard_sif_num, "fname" => $selected_version->first_name,
                    "lname" => $selected_version->last_name, "dob" => $selected_version->birth_date, "school" => $selected_version->student_school);
            }
// generate table data
            $this->table->set_empty("&nbsp; ");
            $table_setup = array("table_open" => "<table id=\"results\" name=\"results\" class=\"tablesorter\">");
            $this->table->set_heading("Version", "View Form", "View Audit Trail");
            $i = 0 + $offset;
            $view = array("class" => "btn btn-success btn-sm", "type" => "button");
            $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
            $delete = array("class" => "btn btn-danger btn-sm", "type" => "button",
                "data-toggle" => "confirmation");
            $count = count($version);
            foreach ($version as $ver) {
                $submitter = $this->adminui_model->get_by_user($user = $ver->wizard_by)->row();
                if ($ver->form_type == "Assessment") {
                    $ver->wizard_num = "assessment_wiz16_" . $ver->wizard_sif_num;
                } else {
                    $ver->wizard_num = "appraisal_wiz06_" . $ver->wizard_sif_num;
                }
                $this->table->add_row(date("m/d/y", strtotime($ver->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $ver->form_type, anchor("access_control/admin/form_view/" . $ver->wizard_num . "-" . $ver->wizard_id . "-" . $ver->unique_number, "View"), anchor("access_control/admin/audit_trail/" . $ver->wizard_num . "-" . $ver->wizard_id . "-" . $ver->unique_number, "View All")
                );
            }
        else:
// load data
            $version = $this->adminui_model->get_version_list($this->limit, $offset, $sifNumber)->result();
            foreach ($version as $defaultdata) {
                $wizarddata = $defaultdata->wizard_data;
                $wizardobject = json_decode($wizarddata);
                $wizarddecode = json_decode(json_encode($wizardobject), true);

                $defaultval = array("sif" => $wizarddecode['sif'], "fname" => $wizarddecode['fname'],
                    "lname" => $wizarddecode['lname'], "dob" => $wizarddecode['dob'], "school" => $wizarddecode['school']);
            }
// generate table data
            $this->table->set_empty("&nbsp; ");
            $table_setup = array("table_open" => "<table id=\"results\" name=\"results\" class=\"tablesorter\">");
            $this->table->set_heading("Version", "View Form", "View Audit Trail");
            $i = 0 + $offset;
            $view = array("class" => "btn btn-success btn-sm", "type" => "button");
            $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
            $delete = array("class" => "btn btn-danger btn-sm", "type" => "button",
                "data-toggle" => "confirmation");
            $count = count($version);
            foreach ($version as $ver) {
                $submitter = $this->adminui_model->get_by_user($user = $ver->wizard_by)->row();
                if ($ver->form_type == "Assessment") {
                    $ver->wizard_num = "assessment_wiz16_" . $ver->wizard_sif_num;
                } else {
                    $ver->wizard_num = "appraisal_wiz06_" . $ver->wizard_sif_num;
                }
                $this->table->add_row(date("m/d/y", strtotime($ver->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $ver->form_type, anchor("access_control/admin/form_view/" . $ver->wizard_num . "-" . $ver->wizard_id . "-" . $ver->unique_number, "View"), anchor("access_control/admin/audit_trail/" . $ver->wizard_num . "-" . $ver->wizard_id . "-" . $ver->unique_number . "/res", "View All")
                );
            }
        endif;
// generate pagination
        $config["base_url"] = site_url("access_control/admin/view_all_versions/");
        $config["total_rows"] = $count;
        $config["per_page"] = $this->limit;
        $config["uri_segment"] = $uri_segment;
        $config["anchor_class"] = "class=\"btn btn-primary btn-sm\"";
        $this->pagination->initialize($config);
        $data["pagination"] = $this->pagination->create_links();
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = "View All Versions";
        $data["default"] = $defaultval;
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
        $data["acl_content"] = "access_control_view/view_versions";
        $this->load->view("access_control/template", $data);
    }

// start audit trail view
    public function audit_trail($wizardNumber) {
//echo date_default_timezone_get();
        $uri_segment = 4;
        $offset = $this->uri->segment($uri_segment);
// parse the wizard number for the parts we need
        $wizardNumberParts = explode('_', $wizardNumber);
// we are making implicit assumption that the wizard number is of the format {appraisal}_wiz02_{Sif}
        $formType = $wizardNumberParts[0];
        $sifNumber = $wizardNumberParts[2];
        $sif_split = explode("-", $sifNumber);
        $sifvalue = $sif_split[0];
        $unique_value = $sif_split[2];
        if ($formType == 'assessment'):
            $assessment_count = $this->adminui_model->get_assessment_count($sifvalue, $unique_value);
        else:
            $appraisal_count = $this->adminui_model->get_appraisal_count($sifvalue, $unique_value);
        endif;

// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
//$wizardNumber
        $orgdata = $this->adminui_model->get_audit_original($this->limit, $offset, $wizardNumber);

        if ($formType == "Appraisal" || $formType == "appraisal") {
            for ($i = 1; $i <= 5; $i++) {
                $wizardNumber = "appraisal_wiz" . str_pad($i, 2, 0, STR_PAD_LEFT) . "_" . $sifNumber;
                $updatedata = $this->adminui_model->get_audit_update($this->limit, $offset, $wizardNumber, $orgdata);
                if (empty($updatedata)) {
                    continue;
                } else {
                    break;
                }
            }
        } else {

            for ($i = 1; $i <= 14; $i++) {
                $wizardNumber = "assessment_wiz" . str_pad($i, 2, 0, STR_PAD_LEFT) . "_" . $sifNumber;
                $updatedata = $this->adminui_model->get_audit_update($this->limit, $offset, $wizardNumber, $orgdata);

                if (empty($updatedata)) {
                    continue;
                } else {
                    break;
                }
            }
        }
        $result_page = $this->uri->segment(5);
        if (empty($result_page) && $result_page <> "res") {
            //echo "1";
//  exit;
            $version = $this->assessment_model->get_forms_awaiting($this->limit, $offset, $viewModeUserID, $user_role->level);
            $selected_version = $this->adminui_model->get_version_list($this->limit, $offset, $sifNumber)->row();
            foreach ($version as $defaultdata) {
                $wizarddata = $defaultdata->wizard_data;
                $wizardobject = json_decode($wizarddata);
                $wizarddecode = json_decode(json_encode($wizardobject), true);
                $submitter = $this->adminui_model->get_by_user($user = $defaultdata->wizard_by)->row();
                $defaultval = array("sif" => $selected_version->wizard_sif_num, "fname" => $selected_version->first_name,
                    "lname" => $selected_version->last_name, "dob" => $selected_version->birth_date, "school" => $selected_version->student_school
                    , "wizard_by" => $defaultdata->wizard_by, "form_type" => $defaultdata->form_type,
                    "wizard_created" => $defaultdata->wizard_created, "first_name" => $submitter->first_name,
                    "last_name" => $submitter->last_name);
            }
        } else {
            //echo "2";
            $version = $this->adminui_model->get_version_list_audit($this->limit, $offset, $sifNumber)->result();
            //echo "<pre>";
            //print_r($version);
            $default_values = array();
            foreach ($version as $defaultdata) {
                $wizarddata = $defaultdata->wizard_data;
                $wizardobject = json_decode($wizarddata);
                $wizarddecode = json_decode(json_encode($wizardobject), true);
                $submitter = $this->adminui_model->get_by_user($user = $defaultdata->wizard_by)->row();

                $defaultval = array("sif" => $wizarddecode['sif'], "fname" => $wizarddecode['fname'],
                    "lname" => $wizarddecode['lname'], "dob" => $wizarddecode['dob'], "school" => $wizarddecode['school']
                    , "wizard_by" => $defaultdata->wizard_by, "form_type" => $defaultdata->form_type,
                    "wizard_created" => $defaultdata->wizard_created, "first_name" => $submitter->first_name,
                    "last_name" => $submitter->last_name);

                if ($defaultval['sif'] <> "" && $defaultval['fname'] <> "")
                    $default_values = $defaultval;
            }
        }
//endif;
// generate table data
        $this->table->set_empty("&nbsp; ");
        $table_setup = array("table_open" => "<table id=\"results\" name=\"results\" class=\"tablesorter\">");
        $this->table->set_heading("Version", "View Form", "View Audit Trail");
        $i = 0 + $offset;
        $view = array("class" => "btn btn-success btn-sm", "type" => "button");
        $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
        $delete = array("class" => "btn btn-danger btn-sm", "type" => "button", "data-toggle" => "confirmation");
        $user_name = array();
        $user_date = array();
        $version_data = json_decode(json_encode($version), true);

        $x = count($version_data);
        $totcount = count($version_data);
        if (count($version_data) <> 0 && ($assessment_count >= 1 || $appraisal_count >= 1 )):
            foreach ($version_data as $k => $ver) {
                $submitter = $this->adminui_model->get_by_users($user = $ver['wizard_by']);
                //echo "<pre>";
                //print_r($submitter);
// Fetch audit id
                $orgdata = $this->adminui_model->get_audit_original($this->limit, $offset, $ver['wizard_num']);
                if ($ver['form_type'] == "Appraisal") {
                    for ($i = 1; $i <= 6; $i++) {
                        $wizardNumber = "appraisal_wiz" . str_pad($i, 2, 0, STR_PAD_LEFT) . "_" . $ver['wizard_num'];
                        $updatedata = $this->adminui_model->get_audit_update($this->limit, $offset, $wizardNumber, $orgdata);
                        if (empty($updatedata)) {
                            continue;
                        } else {
                            break;
                        }
                    }
                } else {
                    for ($i = 1; $i <= 15; $i++) {
                        $wizardNumber = "assessment_wiz" . str_pad($i, 2, 0, STR_PAD_LEFT) . "_" . $ver['wizard_sif_num'];
                        $updatedata = $this->adminui_model->get_audit_update($this->limit, $offset, $wizardNumber, $orgdata);
                        if (empty($updatedata)) {
                            continue;
                        } else {
                            break;
                        }
                    }
                }
                //echo "<pre>";
                //print_r($updatedata);
                if (count($ver) >= 1):
                    if ($ver['form_type'] == "Appraisal"):
                        $ver['wizard_sif_num'] = "appraisal_wiz06_" . $ver['wizard_sif_num'];
                        $wizard_by = str_replace(" ", "_", $ver['wizard_by']);
                        $previous = $x + 1;
                        $pre_date = ($k > 0) ? date('m-d-y', strtotime($version_data[$k - 1]['wizard_modified'])) : "";
                        $pre_wizard = ($k > 0) ? str_replace(" ", "_", $version_data[$k - 1]['wizard_by']) : "";
                        $this->table->add_row(date("m/d/y", strtotime($ver['wizard_modified'])) . " - " . $submitter['first_name'] . " " . $submitter['last_name'] . " - " . $ver['form_type'], anchor("health_appraisal/appraisal/view_appraisal3/" . $ver['wizard_sif_num'] . "-" . $ver['wizard_id'] . "-" . $ver['unique_number'] . "/" . date("m-d-y", strtotime($ver['wizard_modified'])) . "/" . $wizard_by . "/", "View"), anchor("health_appraisal/appraisal/view_appraisal2/" . $ver['wizard_sif_num'] . "/" . $ver['audit_id'] . "/$x/" . $ver['unique_number'] . "/" . date("m-d-y", strtotime($ver['wizard_modified'])) . "/" . $wizard_by . "/" . $pre_date . "/" . $pre_wizard, "View")
                        );
                    else:
                        $ver['wizard_sif_num'] = "assessment_wiz16_" . $ver['wizard_sif_num'];
                        $wizard_by = str_replace(" ", "_", $ver['wizard_by']);
                        $previous = $x + 1;
                        $pre_date = ($k > 0) ? date('m-d-y', strtotime($version_data[$k - 1]['wizard_modified'])) : "";
                        $pre_wizard = ($k > 0) ? str_replace(" ", "_", $version_data[$k - 1]['wizard_by']) : "";
                        $this->table->add_row(date("m/d/y h:i:s", strtotime($ver['wizard_modified'])) . " - " . $submitter['first_name'] . " " . $submitter['last_name'] . " - " . $ver['form_type'], anchor("nurse_assessment/assessment/view_assessment3/" . $ver['wizard_sif_num'] . "-" . $ver['wizard_id'] . "-" . $ver['unique_number'] . "/" . date("m-d-y", strtotime($ver['wizard_modified'])) . "/" . $wizard_by . "/", "View"), anchor("nurse_assessment/assessment/view_assessment2/" . $ver['wizard_sif_num'] . "/" . $ver['audit_id'] . "/$x/" . $ver['unique_number'] . "/" . date("m-d-y", strtotime($ver['wizard_modified'])) . "/" . $wizard_by . "/" . $pre_date . "/" . $pre_wizard, "View")
                        );


                    endif;
                else:
                    echo "This form is still being edited";
                endif;
                $user_name[] = $ver['usernames'];
                $user_date[] = $ver['wizard_modified'];
                $x--;
            }
        else:
            $this->table->add_row('<p><h3><td style="float: left; font-weight: bold; font-size: 13px; margin-left: -298px;">This form is still being edited</td></h3></p>', '');
        endif;
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = "View All Versions";
        $data["default"] = $default_values;
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
// load account view
        $data["acl_content"] = "access_control_view/view_audit";
        $this->load->view("access_control/template", $data);
    }

    /*
     * WORK FLOW HANDLERS
     * Each workflow handler processes a specific workflow
     * doing DB updates, generating & sending email
     *
     */

// run the assessment/appraisal approval workflow
    public function approve($wizard_num) {

        $this->acceptReject('approve', $wizard_num, AA_WORKFLOW_APPROVE_TEMPLATE, null);
    }

// run the assessment/appraisal approval workflow
    public function reject($wizard_num) {
        $comment = null;
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post("mode") == 'submitComment') {
// capture the post data
            $commentData = $this->input->post(null, true);
            $commentText = $this->input->post("commentText");
// let's save the comment here
            $this->adminui_model->SaveComment($commentData);
// send off the comment text for addition to the email
            $this->acceptReject('reject', $wizard_num, AA_WORKFLOW_REJECTFOREDIT_TEMPLATE, $commentText);
        } else {
            $wizard_number_parts = explode('_', $wizard_num);
            $sif = $wizard_number_parts[2];
            $title = "Assessment Rejection Comment";
            $this->handleCommentSubmission($sif, $title);
        }
    }

// run the assessment/appraisal escalation workflow
    public function escalate($wizard_num) {
// this action will support two modes
// 1. collecting the comment (default: we check if the user is submitting a comment)
// 2. escalating
        $comment = null;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
// the only post data we care about here is the comment
            $comment = $this->input->post("comment");
        }
// TODO: remove (|| true) condition when the comment page is wired up
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post("mode") == 'submitComment') {
// the user has submitted the comment, so escalate
// get the wizard number parts
            $recordParts = $this->parseWizardNumber($wizard_num);
            $emailContent = $this->getEmailContent($templateName, $emailTemplateData);
// update the assessment : set wizard_status=35 (escalated)
            $this->adminui_model->escalate($recordParts[2]);
            $this->session->set_flashdata('message', 'Successfully Esclated');
// 2. get the managers for the current user (nurse supervisor)
            $user = $this->user_info();
//            $pm_id = $this->adminui_model->get_pm_id($user->user_id);
            $managers = $this->adminui_model->get_user_managers($userID = $user->user_id);
//            echo "<pre>";
//            print_r($managers);
//            echo "</pre>";
//            exit;
            $managersEmail = array();
            $managersName = array();
            foreach ($managers as $manager) {
                $managersEmail[] = $manager->email_address;
                $managersName[] = $manager->first_name . " " . $manager->last_name;
            }
            $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// 3. generate & send the email
            $emailTemplateData = array('comment' => $comment, 'name' => $user->first_name . " " . $user->last_name, 'sif' => $recordParts[2], 'managers' => implode(",", $managersName));
// capture the post data
            $commentData = $this->input->post(null, true);
            $commentText = $this->input->post("commentText");
// let's save the comment here
            $this->adminui_model->SaveComment($commentData, 'Escalate');
//Unset the session values here
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            $this->session->unset_userdata('reviewassesment');
            $sif = $this->uri->segment(4);
            $unum = $this->uri->segment(5);
            $wiznum = 'assessment_wiz16_' . $sif;
            $status = $this->assessment_model->escalate_status_update($sif, $unum);
            $this->load->library('email');
// It will work on clinet server
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.alwaysonline.net';
            $config['smtp_port'] = 25;
            $config['smtp_user'] = 'info@aa-schoolhealth.org';
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";

//It will work on demo server
            /*    $config['protocol'] = 'smtp';
              $config['smtp_host'] = 'ssl://smtp.gmail.com';
              $config['smtp_port'] = 465;
              $config['smtp_user'] = 'testmail5210@gmail.com';
              $config['smtp_pass'] = 'CGvak123';
              $config['charset'] = "utf-8";
              $config['mailtype'] = "html";
              $config['newline'] = "\r\n";
             */
            $this->email->initialize($config);
            $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
            $this->email->to($managersEmail[0]);
            $this->email->cc("" . APPROVAL_ADMIN . "");
            $this->email->subject("Nurse Assessment Escalated Notification");
            $body = "
                            <table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\">
                            <tr>
                            <td>Message</td>
                            <td width=\"300\">
                            Hello {$managersName[0]},<br>
                            {$user_role->first_name} {$user_role->last_name} has escalated your form for student <strong>{$recordParts[2]}</strong>. Please log in and review.<br>
                            </td>
                            </tr>
                            </table>";

            $this->email->message($body);
            $this->email->send();

// send the user back to the start point
            redirect("access_control/nurse/nurse_manager/");
        } else {
            $wizard_number_parts = explode('_', $wizard_num);
            $sif = $wizard_number_parts[2];
            $title = "Assessment Escalation Comment";
            $this->handleCommentSubmission($sif, $title);
        }
    }

    public function block_user($userId) {
        $this->updateUserStatus($userId, USERSTATUS_BLOCK);
        redirect($this->agent->referrer());
    }

    public function activate_user($userId) {
        $this->updateUserStatus($userId, USERSTATUS_ACTIVE);
        redirect($this->agent->referrer());
    }

    /*
     * Here comes the private supporting casts:
     * these functions provide support
     */

    private function updateUserStatus($userId, $userStatus) {
        $this->adminui_model->updateUserStatus($userId, $userStatus);
    }

// handle comment submission
    private function handleCommentSubmission($sif, $title) {
        $role_type = $this->adminui_model->get_roletype()->result();
        $data["roletype_array"] = $role_type;
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
// set common properties
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
// we can have multiple comment submission for a single assessment
        $data["comment"] = (object) array(
                    'cid' => '',
                    'sif' => $sif,
                    'Title' => $title,
                    'action' => current_url(),
                    'mode' => 'submitComment', // we may have the option to edit comment, in which case, we'd set the appropriate mode here
                    'commentText' => ''   // we can set the comment text (in case of edit mode here)
        );
        $data["acl_content"] = "forms_view/assessment/assessment_comment";
        $this->load->view("access_control/template", $data);
    }

// generic handler for accept & reject workflow actions
    private function acceptReject($workFlow, $wizard_num, $templateName, $comment = null) {
        $formtype = explode('_', $wizard_num);
        if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post("mode") == 'submitComment') {
// get the wizard number parts
            $recordParts = $this->parseWizardNumber($wizard_num);
            $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// 1. update the assessment/appraisal : set wizard_status=45
// this function handles approvals & rejections
            if ($templateName == AA_WORKFLOW_APPROVE_TEMPLATE) {
                $this->adminui_model->approve($recordParts[2]);
                $this->session->set_flashdata('message', 'Successfully Approved');
                $status = "approved";
            } else if ($templateName == AA_WORKFLOW_REJECTFOREDIT_TEMPLATE) {
                $this->adminui_model->reject($recordParts[2]);
                $this->session->set_flashdata('message', 'Successfully Rejected');
                $status = "rejected";
            }
// 2. email the nurse (wizard_by) of approval: details in spec doc -> (done for now)
            $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
            $recordData = $this->adminui_model->wizard_get($wizard_num, $access = $user_role->level);

            $nurse_id = $this->adminui_model->get_by_user($recordData->wizard_by)->row();
            $nsid = $nurse_id->user_id;


//Appraisal Complete staus
            $sif = $this->uri->segment(4);
            $sifnum = end(explode("_", $sif));
            $unum = $this->uri->segment(5);
            if ($formtype[0] == 'appraisal'):
//Appraisal
                $statusval = $this->assessment_model->complete_status_update_appraisal($sif, $unum);
// $this->assessment_model->test($sif, $unum);
            else:
//Assessment
                $statusval = $this->assessment_model->complete_status_update_assessment($sif, $unum);
//$this->assessment_model->complete_time($sif);
            endif;


//Unset the session values here
//Assessment
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            $this->session->unset_userdata('reviewassesment');
//Appraisal
            $this->session->unset_userdata('copy_assigned_unique_number_appraisal'); // Unset the unique number here
            $this->session->unset_userdata('unique_number_appraisal'); // Unset the unique number here
            $this->session->unset_userdata('sifunique_number'); // Unset the unique number here
            $this->session->unset_userdata('reviewappraisal'); // Unset the unique number here
            $this->session->unset_userdata('reviewassesment');
//If nurse supervisor
            if ($user_role->level == 40):


                $create_user_name = $this->assessment_model->create_assessment_form($sifnum, $unum, $user_role->level);
                $recipient = $this->adminui_model->get_by_user($user = $create_user_name)->row();
                $manager_name = $recipient->first_name . " " . $recipient->last_name;
                $this->load->library('email');
                if ($recipient->user_id <> $user_role->user_id):

//It will works on client server
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'smtp.alwaysonline.net';
                    $config['smtp_port'] = 25;
                    $config['smtp_user'] = 'info@aa-schoolhealth.org';
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['newline'] = "\r\n";
//It will work on demo server
                    /* $config['protocol'] = 'smtp';
                      $config['smtp_host'] = 'ssl://smtp.gmail.com';
                      $config['smtp_port'] = 465;
                      $config['smtp_user'] = 'testmail5210@gmail.com';
                      $config['smtp_pass'] = 'CGvak123';
                      $config['charset'] = "utf-8";
                      $config['mailtype'] = "html";
                      $config['newline'] = "\r\n";
                     */

                    $this->email->initialize($config);
                    $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
                    $this->email->to($recipient->email_address);
                    $this->email->cc("" . APPROVAL_ADMIN . "");
                    $this->email->subject("Nurse Assessment {$status} Notification");
                    $body = "
                        <table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\">
                        <tr>
                        <td>Message</td>
                        <td width=\"300\">
                        Hello {$manager_name},<br>
                        {$user_role->first_name} {$user_role->last_name} has {$status} your form for student <strong>{$recordParts[2]}</strong>. Please log in and review.<br>
                        </td>
                        </tr>
                        </table>";

                    $this->email->message($body);
                    $this->email->send();

                endif;
            endif;
//Program manager
            if ($user_role->level == 30):
                if ($status == "approved"):
//Get nurse id
                    $create_user_name = $this->assessment_model->create_assessment_form($sifnum, $unum, 40);
                    $recipient = $this->adminui_model->get_by_user($user = $create_user_name)->row();
                    $nurseid = $recipient->user_id;
//Get nurse supervisor id
                    $nsidval = $this->assessment_model->get_managedby($recipient->user_id);
                    $recipient = $this->adminui_model->get_by_user($user = $nsidval)->row();
                    $nsid = $recipient->user_id;
                    $rec = $this->adminui_model->get_by_id_multiple($nurseid, $nsid);


                    foreach ($rec as $key => $recipient):
                        $manager_name = $recipient->first_name . " " . $recipient->last_name;
                        $this->load->library('email');
                        if ($recipient->user_id <> $user_role->user_id):
//It will works on client server
                            $config['protocol'] = 'smtp';
                            $config['smtp_host'] = 'smtp.alwaysonline.net';
                            $config['smtp_port'] = 25;
                            $config['smtp_user'] = 'info@aa-schoolhealth.org';
                            $config['charset'] = "utf-8";
                            $config['mailtype'] = "html";
                            $config['newline'] = "\r\n";
//It will work on demo server
                            /*  $config['protocol'] = 'smtp';
                              $config['smtp_host'] = 'ssl://smtp.gmail.com';
                              $config['smtp_port'] = 465;
                              $config['smtp_user'] = 'testmail5210@gmail.com';
                              $config['smtp_pass'] = 'CGvak123';
                              $config['charset'] = "utf-8";
                              $config['mailtype'] = "html";
                              $config['newline'] = "\r\n";
                             */

                            $this->email->initialize($config);
                            $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
                            $this->email->to($recipient->email_address);
                            $this->email->cc("" . APPROVAL_ADMIN . "");
                            $this->email->subject("Nurse Assessment {$status} Notification");
                            $body = "
                        <table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\">
                        <tr>
                        <td>Message</td>
                        <td width=\"300\">
                        Hello {$manager_name},<br>
                        {$user_role->first_name} {$user_role->last_name} has {$status} your form for student <strong>{$recordParts[2]}</strong>. Please log in and review.<br>
                        </td>
                        </tr>
                        </table>";

                            $this->email->message($body);
                            $this->email->send();

                        endif;
                    endforeach;
                else:
                    $create_user_name = $this->assessment_model->create_assessment_form($sifnum, $unum, 40, $status);
//echo "<pre>";
                    print_r($create_user_name);
                    $recipient = $this->adminui_model->get_by_user($user = $create_user_name)->row();
// echo "<pre>";
// print_r($recipient);
// exit;
                    $manager_name = $recipient->first_name . " " . $recipient->last_name;
                    $this->load->library('email');

//It will works on client server
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'smtp.alwaysonline.net';
                    $config['smtp_port'] = 25;
                    $config['smtp_user'] = 'info@aa-schoolhealth.org';
                    $config['charset'] = "utf-8";
                    $config['mailtype'] = "html";
                    $config['newline'] = "\r\n";

                    /*
                      $config['protocol'] = 'smtp';
                      $config['smtp_host'] = 'ssl://smtp.gmail.com';
                      $config['smtp_port'] = 465;
                      $config['smtp_user'] = 'testmail5210@gmail.com';
                      $config['smtp_pass'] = 'CGvak123';
                      $config['charset'] = "utf-8";
                      $config['mailtype'] = "html";
                      $config['newline'] = "\r\n";
                     */

                    $this->email->initialize($config);
                    $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
                    $this->email->to($recipient->email_address);
                    $this->email->cc("" . APPROVAL_ADMIN . "");
                    $this->email->subject("Nurse Assessment {$status} Notification");
                    $body = "
                        <table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\">
                        <tr>
                        <td>Message</td>
                        <td width=\"300\">
                        Hello {$manager_name},<br>
                        {$user_role->first_name} {$user_role->last_name} has {$status} your form for student <strong>{$recordParts[2]}</strong>. Please log in and review.<br>
                        </td>
                        </tr>
                        </table>";

                    $this->email->message($body);
                    $this->email->send();
                endif;
            endif;
            redirect("access_control/nurse/nurse_manager/");
        }
        else {
            $wizard_number_parts = explode('_', $wizard_num);
            $sif = $wizard_number_parts[2];
            $title = ucfirst($wizard_number_parts[0]) . " Approve Comment";
            $this->handleCommentSubmission($sif, $title);
        }
    }

// handle all email templating and content generation
// handle all email templating and content generation
    private function getEmailContent($templateName, $emailTemplateData) {

# TODO:: generate the template grid
        $workflowEmailTemplates[AA_WORKFLOW_APPROVE_TEMPLATE]['subject'] = "Nurse Assessment Approval Notification";
        $workflowEmailTemplates[AA_WORKFLOW_APPROVE_TEMPLATE]['message'] = "<table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\"><tr><td>Message</td><td width=\"300\">Hello {form_owner},<br>{name} has approved your form for student <strong>{sif}</strong>. Please log in and review.<br></td></tr></table>";
        $workflowEmailTemplates[AA_WORKFLOW_REJECTFOREDIT_TEMPLATE]['subject'] = "Nurse Assessment Rejection Notification";
        $workflowEmailTemplates[AA_WORKFLOW_REJECTFOREDIT_TEMPLATE]['message'] = "<table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\"><tr><td>Message</td><td width=\"300\">Hello {form_owner},<br>{name} has rejected your form for student <strong>{sif}</strong> with the following comments:<br>{comment}<br>Please log in and review.<br></td></tr></table>";
        $workflowEmailTemplates[AA_WORKFLOW_ESCALATE_TEMPLATE]['subject'] = "Nurse Assessment Escalation Notification";
        $workflowEmailTemplates[AA_WORKFLOW_ESCALATE_TEMPLATE]['message'] = "<table border=\"1\" style=\"border-width: thin; border-spacing: 2px; border-style: none; border-color: #ccc;\"><tr><td>Message</td><td width=\"300\">Hello {managers},<br>{name} has escalated a form for student <strong>{sif}</strong>.  See comments below:<br>{comment}<br>Please log in and review.</td></tr></table>";
# make the necessary replacement
        foreach ($emailTemplateData as $replacementKey => $replacementValue) {
            $workflowEmailTemplates[$templateName]['message'] = str_replace("{" . $replacementKey . "}", $replacementValue, $workflowEmailTemplates[$templateName]['message']);
        }
        return $workflowEmailTemplates[$templateName];
    }

// parse the details of the wizard number
    private function parseWizardNumber($wizard_num) {
// extract the parts of the wizard number : we expect the format [recordType]_[recordStep]_[recordId]
        $recordParts = explode("_", $wizard_num);
        if (count($recordParts) != 3) {
// TODO: we may want to convert this to a constant
            throw "Invalid Record identifier";
        }
        return $recordParts;
    }

// generate and send a workflow email
// TODO: refactor - normalize function usage in terms of inputs from callers
    private function sendWorkFlowEmail($recipients, $comment, $recordParts, $templateName, $workFlow, $miscellaneousData) {
// get info for the current user
        $user = $this->user_info();
// 2. generate & send the email
        $emailTemplateData = array('comment' => $comment, 'name' => $user->first_name . " " . $user->last_name, 'sif' => $recordParts[2]);
        if ($templateName == AA_WORKFLOW_APPROVE_TEMPLATE || $templateName == AA_WORKFLOW_REJECTFOREDIT_TEMPLATE) {
            $emailTemplateData["form_owner"] = $miscellaneousData->first_name . " " . $miscellaneousData->last_name;
        } elseif ($templateName == AA_WORKFLOW_ESCALATE_TEMPLATE) {
            $emailTemplateData["managers"] = implode(", ", $miscellaneousData);
        }
        $emailContent = $this->getEmailContent($templateName, $emailTemplateData);
        $email_subject = $emailContent['subject'];
        $email_message = $emailContent['message'];
        $this->sendEmail($recipients, $email_subject, $email_message);
    }

// send mail to the appropriate contact when an appraisal/assessment is rejected for edit
    private function SendRejectEmail($user, $recordParts) {
// generate & send the email
        $emailTemplateData = array('comment' => $comment, 'name' => $user->first_name . " " . $user->last_name, 'SIF' => $recordParts[2]);
        $emailContent = $this->getEmailContent(AA_WORKFLOW_REJECTFOREDIT_TEMPLATE, $emailTemplateData);
        $email_subject = $emailContent['subject'];
        $email_message = $emailContent['message'];
        $recipients = implode(",", $managersEmail);
        $this->sendEmail($recipients, $email_subject, $email_message);
    }

// generic send email fx
    private function sendEmail($recipient, $email_subject, $email_message) {
// setup the email
        $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
        $this->email->to($recipient);
        $this->email->subject($email_subject);
        $this->email->message($email_message);
// send the email
        $this->email->send();
    }

    public function username_check() {
        $username = $this->input->post("username");
        $user_exist = $this->adminui_model->get_by_users($username);

        if (isset($user_exist) && (count($user_exist) > 0)) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

}
