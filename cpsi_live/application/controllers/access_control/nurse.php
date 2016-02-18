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

class Nurse extends AAH_Controller {

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
        $this->load->model("schoolhealth_model", "", TRUE);
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
        // get user details
        $user = $this->adminui_model->get_by_user($user = $this->session->userdata("username"))->row();
        return $user;
    }

    public function view_nurse_forms($userID, $offset = 0) {
        // TODO:: rename this method appropriately
        $this->showNurseForm($offset, $userID);
    }

    // load users account view
    public function nurse_manager($offset = 0) {
        $this->showNurseForm($offset);
    }

    public function nurse_view($user_id) {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_nurses")) {
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
        $data["subtitle"] = "Nurse View";
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        if ($user_role->name == "Nurse") {
            $data["link_back"] = anchor("access_control/nurse/nurse_manager/", "Back to list of nurses", array("type" => "button"));
        } else {
            $data["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of nurses", array("type" => "button"));
        }
        // get person details
        $data["acct"] = $this->adminui_model->get_nurse_by_id($user_id);
        // get the necessary data for viewing the user
        $data['userEditData'] = json_decode(json_encode($this->adminui_model->LoadUserEditData($user_id)), FALSE);
//        echo "<pre>";
//        print_r($data['userEditData']);
//        exit;
        $data["viewUserFormsLink"] = anchor("search/student_search/get_allforms_user/" . $user_id, "View Forms for User", array("class" => "button"));

        $data["acl_content"] = "access_control_view/nurse_view";
        $this->load->view("access_control/template", $data);
    }

    public function nurse_update($user_id) {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "edit_nurse")) {
            $this->access_denied();
        }
        // set validation properties
        $this->_set_rules();
        // parse user details
        $user = $this->user_info();
        // if this is a form update,handle it appropriately
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $edit_nurse_supervisor = $this->input->post("edit_nurse_supervisor");
            $selected_nurse = $this->input->post('selecednur');
            foreach ($selected_nurse as $val) {
                $res = explode(",", $val);
                $nurselist = $nurselist . $res[0] . ",";
                $nurse_uname = $nurse_uname . "'" . $res[1] . "',";
            }

            $selected_nurse_id = rtrim($nurselist, ",");
            $sel_nurse_uname = rtrim($nurse_uname, ",");
            if (!empty($edit_nurse_supervisor)) {
                $edit_ns_id = $this->adminui_model->get_by_user_name($edit_nurse_supervisor);
                $data = array('exist_user_id' => $this->input->post('user_id'),
                    'new_user_id' => $edit_ns_id,
                    'exist_nurse_id' => $selected_nurse_id);
                $user_manager_update = $this->adminui_model->user_manager_update($data);
                //Change Nurse suoervisor in form session table
                $data = array('exist_user_id' => $this->input->post('user_id'),
                    'new_user_id' => $edit_ns_id,
                    'exist_nurse_uname' => $sel_nurse_uname);
                $form_session_ns_update = $this->adminui_model->form_session_ns_update($data);
                $data["message"] = "Account successfully updated...";
                $this->session->set_flashdata('flash_success_message', "Account successfully updated...");
            }

            //Select Nurse Supervisor Start 29-01-2016
            $edit_program_manager = $this->input->post("edit_program_manager");
            $selected_nurse_supervisor = $this->input->post('selecednursup');
            foreach ($selected_nurse_supervisor as $val) {
                $res = explode(",", $val);
                $nurse_super_list = $nurse_super_list . $res[0] . ",";
                $nurse_super_uname = $nurse_super_uname . "'" . $res[1] . "',";
            }

            $selected_nursesuper_id = rtrim($nurse_super_list, ",");
            $sel_nursesuper_uname = rtrim($nurse_super_uname, ",");
            if (!empty($edit_program_manager)) {
                $edit_nsv_id = $this->adminui_model->get_by_user_name($edit_program_manager);
                $data = array('exist_user_id' => $this->input->post('user_id'),
                    'new_user_id' => $edit_nsv_id,
                    'exist_nurse_id' => $selected_nursesuper_id);
                $user_manager_update = $this->adminui_model->user_manager_update($data);
                //Change Nurse suoervisor in form session table
                $data = array('exist_user_id' => $this->input->post('user_id'),
                    'new_user_id' => $edit_nsv_id,
                    'exist_nurse_uname' => $sel_nursesuper_uname);
                $form_session_ns_update = $this->adminui_model->form_session_ns_update($data);
                $data["message"] = "Account successfully updated...";
                $this->session->set_flashdata('flash_success_message', "Account successfully updated...");
            }
            // Select nurse supervisor End  29-01-2016


            $edit_nurse_supervisor = $this->input->post("edit_nurse_supervisor");
            $selected_nurse = $this->input->post('selecednur');
            foreach ($selected_nurse as $val) {
                $res = explode(",", $val);
                $nurselist = $nurselist . $res[0] . ",";
                $nurse_uname = $nurse_uname . "'" . $res[1] . "',";
            }

            $selected_nurse_id = rtrim($nurselist, ",");
            $sel_nurse_uname = rtrim($nurse_uname, ",");
            if (!empty($edit_nurse_supervisor)) {
                $edit_ns_id = $this->adminui_model->get_by_user_name($edit_nurse_supervisor);
                $data = array('exist_user_id' => $this->input->post('user_id'),
                    'new_user_id' => $edit_ns_id,
                    'exist_nurse_id' => $selected_nurse_id);
                $user_manager_update = $this->adminui_model->user_manager_update($data);
                //Change Nurse suoervisor in form session table
                $data = array('exist_user_id' => $this->input->post('user_id'),
                    'new_user_id' => $edit_ns_id,
                    'exist_nurse_uname' => $sel_nurse_uname);
                $form_session_ns_update = $this->adminui_model->form_session_ns_update($data);
                $data["message"] = "Account successfully updated...";
                $this->session->set_flashdata('flash_success_message', "Account successfully updated...");
            }




            // Selsect nurse supervisor End
            // run validation
            if ($this->form_validation->run() == FALSE) {

                $data["user"] = $this->adminui_model->get_user($user_id = $this->input->post("user_id"));
                $data["user"]->roles = $this->adminui_model->get_user_roles($user_id = $this->input->post("user_id"));
                $data["role_list"] = $this->adminui_model->get_all_roles();
                $user_id = $this->input->post("user_id");
                $acct = array("first_name" => $this->input->post("first_name"),
                    "last_name" => $this->input->post("last_name"),
                    "username" => $this->input->post("username"),
                    "email_address" => $this->input->post("email_address"),
                    "status" => $this->input->post("status"),
                    "modified_date" => date("Y-m-d H:i:s"),
                    "modified_by" => $this->session->userdata("username"));

                // PROGRAM MANAGER: updating the program manager for the user
                $programManager = $this->input->post("program_manager");
                if ($programManager) {
                    // this is a managed_by entry: delete the existing entry & insert the new
                    $this->adminui_model->SetUserManager($user_id, $programManager);
                }

                $res = $this->adminui_model->account_update($user_id, $acct);
            } else {


                // save modification;
                if ($this->adminui_model->edit_user_roles($user_id = $this->input->post("user_id"), $this->input->post("roles"))) {
//                    $user_id = $this->input->post("user_id");
//                    $acct = array("first_name" => $this->input->post("first_name"),
//                        "last_name" => $this->input->post("last_name"),
//                        "username" => $this->input->post("username"),
//                        "email_address" => $this->input->post("email_address"),
//                        "status" => $this->input->post("status"),
//                        "modified_date" => date("Y-m-d H:i:s"),
//                        "modified_by" => $this->session->userdata("username"));
////                    echo "<pre>";
////                    print_r($acct);
////                    echo "</pre>";
////                    exit;
//                    $this->adminui_model->account_update($user_id, $acct);
//                    echo "call update";
//                    exit;
                    // NURSE SUPERVISOR: updating the nurse supervisor for the user
                    $nursSeupervisor = $this->input->post("nurse_supervisor");
                    if ($nurseSupervisor) {
                        // this is a managed_by entry: delete the existing entry & insert the new
                        $this->adminui_model->SetUserManager($user_id, $nurseSupervisor);
                    }
                    // PROGRAM MANAGER: updating the program manager for the user
                    $programManager = $this->input->post("program_manager");
                    //echo $programManager . '-yes';
                    if ($programManager) {
                        //echo "here";
                        // exit;
                        // this is a managed_by entry: delete the existing entry & insert the new
                        $this->adminui_model->SetUserManager($user_id, $programManager);
                    }
                    // ASSIGNED NURSES : updating the nurse assignment for the user
                    $nursesAssigned = $this->input->post("multi_nurses");
                    if ($nursesAssigned) {
                        // this is a managed_by entry: delete the existing entry & insert the new
                        $this->adminui_model->updateUserManagedBy($newManagerUserId = $user_id, $nursesToReassign = $nursesAssigned);
                    }
                    // VACANT : reassign all currenty assigned nurses from the nurse supervisor to the program manager
                    $isVacant = $this->input->post("vacant");
                    $reassign = array();
                    if ($isVacant == 1) {
                        // get all nurses currently assigned to the selected user
                        $subordinates = $this->adminui_model->get_user_manage_by($user_id)->result();
                        foreach ($subordinates as $subordinate) {
                            $reassign[] = $subordinate->manage_id;
                        }

                        if (count($reassign) > 0) {
                            $userManager = $this->adminui_model->get_user_manager_id($user_id)->row()->manage_by;
                            $this->adminui_model->updateUserManagedBy($newManagerUserId = $userManager, $nursesToReassign = $reassign, $update = true);
                        }
                    }
                    // PROGRAM MANAGER : updating Program Manager nurses
                    $programManagerNurseSupervisors = $this->input->post("multi_nurse_supervisors");
                    if ($programManagerNurseSupervisors) {
                        // this is a managed_by entry: delete the existing entry & insert the new
                        $this->adminui_model->updateUserManagedBy($newManagerUserId = $user_id, $nursesToReassign = $programManagerNurseSupervisors);
                    }
                    $data["message"] = "Account successfully updated...";
                } else {
                    show_error("Failed assign user.");
                }
            }
        }
        $ns_id = $this->uri->segment(4);
        # get the nurses that are available for assignment
        $data["availableNursesForAssignment"] = $this->adminui_model->getAvailableNurses($ns_id);
        // prefill form values
        $acct = $this->adminui_model->get_nurse_by_id($ns_id);

        $this->form_data = new stdClass();
        $this->form_data->user_id = $acct->user_id;
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
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
        // set common properties
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = 'Modify Nurse';
        $data["roles"] = $this->adminui_model->get_group();
        $data["user"] = new stdClass();
        $data["user"]->roles = $this->adminui_model->get_user_roles($user_id);
        $data["role_list"] = $this->adminui_model->get_all_roles();
        $data["message"] = "";
        $data["error"] = "";
        $data["success"] = "";
        $data["action"] = site_url("access_control/nurse/nurse_update/" . $user_id);
        $data["action_passwd_chg"] = site_url("access_control/admin/password_change_process");
        if ($user_role->name == "Nurse") {
            $data["link_back"] = anchor("access_control/nurse/nurse_manager/", "Back to list of nurses", array("type" => "button"));
        } else {
            $data["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of nurses", array("type" => "button"));
        }
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
        // get the necessary data for editing the user
        $data['userEditData'] = json_decode(json_encode($this->adminui_model->LoadUserEditData($user_id)), FALSE);
        $data["viewUserFormsLink"] = anchor("access_control/nurse/view_nurse_forms/" . $user_id, "View Forms for User", array("class" => "button"));
        $data['nurseSupervisors'] = json_decode(json_encode($this->adminui_model->GetUsersByRoleName("Nurse Supervisor")));
        $data['programManagers'] = json_decode(json_encode($this->adminui_model->GetUsersByRoleName("Program Manager")));
        // load view
        // $data["message"] = "Account successfully updated...";
        $this->session->set_flashdata('flash_success_message', "Account successfully updated...");
        if ($res <> ""):
            $data["message"] = "Account successfully updated...";
        endif;
        $data["acl_content"] = "access_control_view/nurse_modify";

        $this->load->view("access_control/template", $data);
    }

    public function nurse_block($user_id) {
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "block_nurse")) {
            //show_error ( "You do not have access to this section " . anchor ( $this->agent->referrer (), "Return", 'title="Go back to previous page"' ) );
            $this->access_denied();
        }
        // set validation properties
        // $this->_set_rules();
        // prefill form values
        $acct = $this->adminui_model->get_nurse_by_id($user_id);
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
        $data["acct"] = $acct;
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
        $data ["subtitle"] = 'Nurse Status';
        $data ["action"] = site_url("access_control/admin/nurse_block");
        $data ["block_nurse"] = site_url("access_control/admin/block_nurse_process/{$user_id}");
        if ($user_role->name == "Nurse") {
            $data["link_back"] = anchor("access_control/nurse/nurse_manager/", "Back to list of nurses", array("type" => "button"));
        } elseif ($user_role->name == "Nurse Supervisor") {
            $data["link_back"] = anchor("access_control/admin/account_manager/", "Back to list of nurses", array("type" => "button"));
        }
        // load view
        $data ["acl_content"] = "access_control_view/nurse_block";
        $this->load->view("access_control/template", $data);
    }

    //user password change
    public function user_password_change($user_id) {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "change_password")) {
            $this->access_denied();
        }
        // set validation properties
        $this->_set_rules();
        // prefill form values
        $acct = $this->adminui_model->get_by_id_pendrequest($user_id);
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
        // Populate the dropdown options here
        echo json_encode($data);
    }

    public function roles_select_ui() {
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "edit_nurse")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Return to previous page..."'));
        }
        $msg = "";
        $nurse_array = array();
        $nurse_supervisor_array = array();
        $program_manager_array = array();
        $user_list = $this->adminui_model->list_all()->result();
        $roles_json = '';
        $role_id = $this->input->get("rid");
        foreach ($user_list as $user) {
            if ($this->adminui_model->get_user_role($user->user_id)->name == 'Nurse') {
                $nurse_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name);
            } elseif ($this->adminui_model->get_user_role($user->user_id)->name == "Nurse Supervisor") {
                $nurse_supervisor_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name);
            } elseif ($this->adminui_model->get_user_role($user->user_id)->name == "Program Manager") {
                $program_manager_array[] = array("username" => $user->username, "first_name" => $user->first_name, "last_name" => $user->last_name);
            }
        }
        if (($role_id == "Deputy Director") || ($role_id == "Director")) {
            //Do nothing for now
        } elseif ($role_id == "Program Manager") {
            $msg = "<fieldset >
            <label>Select Nurse Supervisors </label>
            <section>
            <select id='multi_nurse_supervisors' name='multi_nurse_supervisors[]' height='" . count($nurse_supervisor_array) . "' multiple='multiple' >";
            foreach ($nurse_supervisor_array as $ns) {
                $msg.="<option value='" . $ns['username'] . "'>" . $ns['first_name'] . " " . $ns['last_name'] . "</option>";
            }
            $msg.="</select>
                    </section>
                    </fieldset>";
        } elseif ($role_id == "Nurse Supervisor") {
            $msg = "<br><fieldset >
                    <label>Select Program Manager (Select One) </label>
                    <section>
                    <select id='program_manager' name='program_manager'  class='form-control' >";
            foreach ($program_manager_array as $pm) {
                $msg.="<option value='" . $pm['username'] . "'>" . $pm['first_name'] . " " . $pm['last_name'] . "</option>";
            }
            $msg.= " </select>
                        </section>
			</fieldset>
			<fieldset>
                        <label>Select Nurses </label>
                        <section>
                        <select id='multi_nurses' name='multi_nurses[]'  class='form-control' size='" . count($nurse_array) . "' multiple = 'multiple' >";
            foreach ($nurse_array as $na) {
                if (!empty($na)) {
                    $msg.="<option value='" . $na['first_name'] . "'>" . $na['first_name'] . " " . $na['last_name'] . "</option>";
                }
            }
            $msg.="</select>
                    </section>
                    </fieldset>";
        } elseif ($role_id == "Nurse") {
            $msg = "<fieldset >
                    <label>Select Nurse Supervisor (Select One) </label>
                    <section>
                    <select id='nurse_supervisor' name='nurse_supervisor'  class='form-control' >";
            foreach ($nurse_supervisor_array as $ns) {
                $msg.="<option value='" . $ns['username'] . "'>" . $ns['first_name'] . " " . $ns['last_name'] . "</option>";
            }
            $msg.="</select>
                    </section>
                    </fieldset>";
        }
        print_r($msg);
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
        // run validation
        if ($this->form_validation->run() == FALSE) {
            $data["message"] = "";
        } else {
            // get authenticated user user_id
            $acct = $this->adminui_model->get_by_id($user_id = $this->input->post("user_id"))->row();
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
                // redirect password change profile tab with success message
                redirect("access_control/admin/account_update/{$acct->user_id}/?PasswordChangeSuccess=success#password-pills");
            } else {
                // redirect password change profile tab with error message
                redirect("access_control/admin/account_update/{$acct->user_id}/?PasswordChangeError=error#password-pills");
            }
        }
    }

    // process password by super admin
    protected function password_change_admin($user_id, $conf_password, $email) {
        $acct = array("password" => $conf_password,
            "password_reset" => "" . PASS_RESET_REQUIRED . "",
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
        $this->form_validation->set_rules("username", "Username", "trim|required|xss_clean");
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

    private function showNurseForm($offset, $viewModeUserID = null) {

        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_students")) {
            redirect("access_control/admin/access_denied/");
        }
        //offset
        $uri_segment = 4;
        $offset = $this->uri->segment($uri_segment);
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $created_user = $user_role->first_name . " " . $user_role->last_name;

        $highername = $this->assessment_model->get_managedby($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // load data
        $forms = $this->assessment_model->get_forms_awaiting($this->limit, $offset, $viewModeUserID, $user_role->level, $highername);

        if ($user_role->slug == "program_manager") {
            $status = 35;
        } elseif ($user_role->slug == "sup_nurse") {
            $status = 15;
        } elseif ($user_role->slug == "nurse") {
            $status = 'in(5,25)';
        }
        if ($user_role->name == "Nurse") {
            $data["subtitle"] = "Forms Awaiting My Edits";
        } elseif ($user_role->name == "Nurse Supervisor") {
            $data["subtitle"] = "Forms Awaiting My Approval";
        }
        if ($viewModeUserID) {
            $targetUser = $this->adminui_model->get_user($user_id = $viewModeUserID);
            $data["subtitle"] = "Forms created by " . $targetUser->first_name . " " . $targetUser->last_name;
        }
        $latest_assessment = $this->adminui_model->get_latest_assessment();
        $latest_assessment_sif = $latest_assessment->wizard_sif_num;
        $latest_unique_number = $latest_assessment->unique_number;
        $wizard_status = $latest_assessment->wizard_status;
        // generate table data
        $this->table->set_empty("&nbsp;");
        $table_setup = array("table_open" => "<table id=\"results\" style=\"margin-left: 0%;\" class=\"tablesorter\">");
        $this->table->set_heading("Action", "Status", "SIF", "F.Name", "L.Name", "DOB", "School", "C.Owner", "L.Version", "copy", "P.Versions");
        $i = 0 + $offset;
        $view = array("class" => "btn btn-success btn-sm", "type" => "button");
        $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
        $delete = array("class" => "btn btn-danger btn-sm", "type" => "button",
            "data-toggle" => "confirmation");

        foreach ($forms as $form) {
            $submitter = $this->schoolhealth_model->get_by_user($user = $form->wizard_by)->row();
            if (!empty($form)) {
                $escalate_to_ns = array();
                $escalate_to_pm = array();
                $sifnumber = end(explode("_", $form->wizard_num));
                $current_owner = "";
                $type = $this->assessment_model->get_form_status_name($form->wizard_status);
                $status = $this->schoolhealth_model->getcount($form->wizard_sif_num, $form->unique_number, $form->form_type, $user_role->{'name'});

                //Get currnt responsible user status
                $form_staus = $form->wizard_status;
                if (!empty($formstatus)):
                    $form->wizard_status = $formstatus;
                endif;

                if ($form_staus == 45):
                    $current_owner = 'N/A';
                    $current_user_id = "";
                else:
                    $current_user_id = $this->schoolhealth_model->check_assessment_comments($form->wizard_sif_num, $form->unique_number);
                    //send to correct user when reject the form
                    $rejected_id = $this->schoolhealth_model->check_assessment_rejected_comments($form->wizard_sif_num, $form->unique_number);
                    if (!empty($current_user_id) && $form->wizard_status == 35):
                        $user_type = $this->adminui_model->get_user_role($current_user_id);
                        //Escalate to NS
                        if ($user_type->level == 50):
                            $ns_id = $this->adminui_model->get_pm_id($current_user_id);
                            $user_details = $this->adminui_model->get_user_role($ns_id);
                            $current_owner = $user_details->first_name . " " . $user_details->last_name;
                            $escalate_to_ns[] = $form->wizard_sif_num;
                        //Escalate to PM
                        elseif ($user_type->level == 40 || $user_type->level == 30):
                            $pm_id = $this->adminui_model->get_pm_id($current_user_id);
                            $user_details = $this->adminui_model->get_user_role($pm_id);
                            $current_owner = $user_details->first_name . " " . $user_details->last_name;
                            $escalate_to_pm[] = $form->wizard_sif_num;
                        endif;
                    elseif (empty($current_user_id) && $form->wizard_status == 35):
                        $pm_id = $this->adminui_model->get_pm_id($form->direct_report);
                        $user_details = $this->adminui_model->get_user_role($pm_id);
                        $current_user_id = $pm_id;
                        $current_owner = $user_details->first_name . " " . $user_details->last_name;
                    elseif (!empty($current_user_id) && $form->wizard_status == 25):

                        //$manageuser_id = $this->adminui_model->get_manageuser_id($current_user_id);
                        //send to correct user when reject the form
                        if ($rejected_id->rejectto == 'Nurse') {
                            $manageuser_id = $rejected_id->nurseid;
                        } else {
                            $manageuser_id = $rejected_id->nursesupervisorid;
                        }
                        $current_user_id = $manageuser_id;

                        $user_details = $this->adminui_model->get_user_role($manageuser_id);
                        $current_owner = $user_details->first_name . " " . $user_details->last_name;
                    else:
                        $user_details = $this->adminui_model->get_user_role($form->direct_report);
                        $current_user_id = $form->direct_report;
                        $current_owner = $user_details->first_name . " " . $user_details->last_name;
                    endif;
                endif;
                $sifnum = array();
                $search = $form->wizard_sif_num . "," . $form->unique_number;
                if ($form->wizard_status == 35 && empty($current_user_id)):

                    $user_details = $this->adminui_model->get_user_role($current_user_id);
                    $pm_id = $this->adminui_model->get_pm_id($user_details->user_id);
                    $current_user_id = $pm_id;
                    $user_details = $this->adminui_model->get_user_role($pm_id);
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                endif;
                if ($form->wizard_status == 5 && $user_role->{'name'} == Nurse && $form->wizard_by == $this->session->userdata('username')):
                    $user_details = $this->adminui_model->get_user_role($this->session->userdata('user_id'));
                    $current_user_id = $this->session->userdata('user_id');
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                endif;
                if ($current_user_id == $this->session->userdata('user_id') && $form->wizard_status == 35):
                    $user_details = $this->adminui_model->get_user_role($this->session->userdata('user_id'));
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                endif;

                //echo "<pre>";
                // print_r($form);
                //exit;
//                   if ($form->wizard_sif_num == 777322):
//                    $current_user_id = $this->session->userdata('user_id');
//                endif;
//                echo "User role : " . $user_role->name . '<br>';
//                echo "Sif number : " . $form->wizard_sif_num . '<br>';
//                echo "Status : " . $status . '<br>';
//                echo "Current User Id: " . $current_user_id . '<br>';
//                echo '<br>';
//                echo $user_role->name . '<br>';
//
//
//                echo $status.'<br>';
//                echo $form->wizard_sif_num.'<br>';
//                echo $current_user_id.'<br>';
                //Date and Schhol name added here
                $result = $this->schoolhealth_model->check_basic_details($form->wizard_sif_num, $form->unique_number, $form->form_type);
                $form->birth_date = $result['birth_date'];
                $form->student_school = $result['student_school'];

                $created_username = $this->session->userdata('username');
//                echo 'created_user===>' . $created_username . '<br>';
//                echo 'Wizard_by===>' . $form->wizard_by . '<br>';
//                echo 'sifno===>' . $form->wizard_sif_num . '<br>';
//                echo 'current_userid==>' . $current_user_id . '<br>';
//                echo 'session_userid==>' . $this->session->userdata('user_id') . '<br>';
//                echo "<hr>";
                if ($form->birth_date == '1970-01-01') {
                    $dob_date = 'N/A';
                } else {
                    $dob_date = date("m/d/y", strtotime($form->birth_date));
                }


                if (!in_array($search, $sifnum)) {
                    $sifnum[] = $form->wizard_sif_num . "," . $form->unique_number;

                    if (($user_role->name == "Nurse") && ($status == 5 || $status == 25 && $form->form_type == "Assessment" && $current_user_id == $this->session->userdata('user_id'))) {
                        if ($sifnumber == $latest_assessment_sif && $form->unique_number == $latest_unique_number && $form->wizard_status == 45):
                            $this->table->add_row(
                                    anchor("access_control/admin/form_view/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "View") . " | " .
                                    anchor("access_control/admin/form_update/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "Edit"), $this->schoolhealth_model->form_status($status), $form->wizard_sif_num, $form->first_name, $form->last_name, $dob_date, $form->student_school, $current_owner, date("m/d/y", strtotime($form->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $form->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $form->wizard_id . "-" . $form->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $form->wizard_id . "-" . $form->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/res", "View All")
                            );
//                         elseif($created_username == $form->wizard_by && $status == 5 ):
//                            $this->table->add_row(
//                                    anchor("access_control/admin/form_view/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "View") . " | " .
//                                    anchor("access_control/admin/form_update/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "Edit"), $this->schoolhealth_model->form_status($status), $form->wizard_sif_num, $form->first_name, $form->last_name, date("m/d/y", strtotime($form->birth_date)), $form->student_school, $current_owner, date("m/d/y", strtotime($form->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $form->form_type, "N/A", anchor("access_control/admin/audit_trail/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/res", "View All")
//                            );
                        elseif ($created_username == $form->wizard_by || $status == 25):
                            //echo $status . '===stat<br>';
                            //echo $created_username . '==createduser<br>';
                            //echo $form->wizard_by . '=wizard<br>';
                            $this->table->add_row(
                                    anchor("access_control/admin/form_view/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "View") . " | " .
                                    anchor("access_control/admin/form_update/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "Edit"), $this->schoolhealth_model->form_status($status), $form->wizard_sif_num, $form->first_name, $form->last_name, $dob_date, $form->student_school, $current_owner, date("m/d/y", strtotime($form->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $form->form_type, "N/A", anchor("access_control/admin/audit_trail/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/res", "View All")
                            );

                        endif;
                        $x++;
                    }


                    elseif (($user_role->name == "Nurse Supervisor" && $current_user_id == $this->session->userdata('user_id') && $form->form_type == "Assessment") && ($status == 15 || $status == 25) || in_array($form->wizard_sif_num, $escalate_to_ns)) {

                        if ($sifnumber == $latest_assessment_sif && $form->unique_number == $latest_unique_number && $form->wizard_status == 45):
                            $this->table->add_row(
                                    anchor("access_control/admin/form_view/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/form", "View") . " | " .
                                    anchor("access_control/admin/form_update/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "Edit"), $this->schoolhealth_model->form_status($status), $form->wizard_sif_num, $form->first_name, $form->last_name, $dob_date, $form->student_school, $current_owner, date("m/d/y", strtotime($form->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $form->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $form->wizard_id . "-" . $form->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $form->wizard_id . "-" . $form->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/res", "View All")
                            );
                        else:
                            if ($user_role->name == "Nurse Supervisor"):
                                $this->table->add_row(
                                        anchor("access_control/admin/form_view/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/form", "View") . " | " .
                                        anchor("access_control/admin/form_update/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "Edit"), $this->schoolhealth_model->form_status($status), $form->wizard_sif_num, $form->first_name, $form->last_name, $dob_date, $form->student_school, $current_owner, date("m/d/y", strtotime($form->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $form->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/form", "View All")
                                );
                            endif;
                        endif;
                    }
                    elseif ($user_role->name == "Program Manager" && $form->form_type == "Assessment" && $status == 35) {
                        if ($sifnumber == $latest_assessment_sif && $form->unique_number == $latest_unique_number && $form->wizard_status == 45):
                            $this->table->add_row(
                                    anchor("access_control/admin/form_view/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "View") . " | " .
                                    anchor("access_control/admin/form_update/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "Edit"), $this->schoolhealth_model->form_status($status), $form->wizard_sif_num, $form->first_name, $form->last_name, $dob_date, $form->student_school, $current_owner, date("m/d/y", strtotime($form->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $form->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $form->wizard_id . "-" . $form->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/res", "View All")
                            );
                        else:

                            $this->table->add_row(
                                    anchor("access_control/admin/form_view/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "View") . " | " .
                                    anchor("access_control/admin/form_update/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number, "Edit"), $this->schoolhealth_model->form_status($status), $form->wizard_sif_num, $form->first_name, $form->last_name, $dob_date, $form->student_school, $current_owner, date("m/d/y", strtotime($form->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $form->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $form->wizard_num . "-" . $form->wizard_id . "-" . $form->unique_number . "/res", "View All")
                            );
                        endif;
                    }
                }
            }
        }
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["panel_title"] = "AA-SchoolHealth Nurse Accounts";
        $data["action_passwd_chg"] = site_url("access_control/admin/password_change_process");
        $data["add_admin_process"] = site_url("access_control/admin/add_admin");
        $data["error"] = "";
        $data["roles"] = $this->adminui_model->get_group();
        $data["role_array"] = $this->adminui_model->user_current_group();
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
        // load account view
        $data["acl_content"] = "access_control_view/nurse_form";
        $this->load->view("access_control/template", $data);
    }

    //show Log Details in Admin,Director (sridhar implementation) - 16-Dec-2015
    public function showLogDetails() {

        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_students")) {
            redirect("access_control/admin/access_denied/");
        }
        //offset
        $uri_segment = 4;
        $offset = $this->uri->segment($uri_segment);
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $created_user = $user_role->first_name . " " . $user_role->last_name;

        $highername = $this->assessment_model->get_managedby($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // load data
        $forms = $this->assessment_model->get_log_details();

        // generate table data
        $this->table->set_empty("&nbsp;");
        $table_setup = array("table_open" => "<table id=\"results\" style=\"margin-left: 0%;\" class=\"tablesorter\">");
        $this->table->set_heading("SI No", "UserName", "Date & Time", "IP Address", "Status");
        $view = array("class" => "btn btn-success btn-sm", "type" => "button");
        $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
        $delete = array("class" => "btn btn-danger btn-sm", "type" => "button",
            "data-toggle" => "confirmation");
        $key = 1;
        foreach ($forms as $form) {
            if ($form['loginSuccess'] == 1) {
                $message = 'Success';
            } else {
                $message = 'Failure';
            }
            $this->table->add_row($key, $form['user_name'], $form['loginTime'], $form['ip_addr'], $message);
            $key++;
        }
        //exit;
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["panel_title"] = "AA-SchoolHealth Nurse Accounts";
        $data["action_passwd_chg"] = site_url("access_control/admin/password_change_process");
        $data["add_admin_process"] = site_url("access_control/admin/add_admin");
        $data["error"] = "";
        $data["subtitle"] = "Access Logs";
        $data["roles"] = $this->adminui_model->get_group();
        $data["role_array"] = $this->adminui_model->user_current_group();
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
        // load account view
        $data["acl_content"] = "access_control_view/nurse_form";
        $this->load->view("access_control/template", $data);
    }

}
