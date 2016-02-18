<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Search Controller
 *
 * @package	Search Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.0.0-pre
 */
class Student_search extends CI_Controller {

    // number of records per page
    private $limit = 10;
    private $acl_table;

    function __construct() {
        parent::__construct();

        $this->is_logged_in();
        // no page caching
        $this->output->nocache();

        // bootstrap dashboard and access control model
        $this->load->model("schoolhealth_model", "", TRUE);
        $this->load->model("adminui_model", "", TRUE);
        $this->acl_conf = (object) $this->config->item("acl");
        $this->acl_table = & $this->acl_conf->table;
    }

    // check if login at all times
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

    // pending form
    public function check_form_status() {
        $manager = $this->schoolhealth_model->get_user_manager($user = $this->session->userdata("user_id"))->result();
        return $manager;
    }

    // load search view
    public function index($offset = 0) {
        $form_check = $this->check_form_status();
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // load search index view
        $data['message'] = "";
        $data['pagination'] = "";
        $data['table'] = "";
        $data["search_content"] = "search_view/search_index";
        $this->load->view("search/template", $data);
    }

    function find_student($offset = 0) {
        $uri_segment = 4;
        if ($viewModeUserID != null) {
            $uri_segment++;
        }
        $offset = $this->uri->segment($uri_segment);
        $students = array();
        $search_param = "";
        if ($_POST['filter1_type'] == "wizard_status") {
            $_POST['filter1'] = strtoupper($_POST['filter1']);
//            exit;
        }
        if ($_POST['filter2-type'] == "wizard_status") {
            $_POST['filter2'] = strtoupper($_POST['filter2']);
        }
        if (isset($_POST['filter1']) && $_POST['filter1'] == "PENDING" && $_POST['filter1_type'] == "wizard_status"):
            $_POST['filter1'] = 15;
        endif;
        if (isset($_POST['filter1']) && $_POST['filter1'] == "COMPLETED" && $_POST['filter1_type'] == "wizard_status"):
            $_POST['filter1'] = 45;
        endif;
        if (isset($_POST['filter1']) && $_POST['filter1'] == "ESCALATE" && $_POST['filter1_type'] == "wizard_status"):
            $_POST['filter1'] = 35;
        endif;
        if (isset($_POST['filter1']) && $_POST['filter1'] == "IN PROGRESS" && $_POST['filter1_type'] == "wizard_status"):
            $_POST['filter1'] = 5;
        endif;
        if (isset($_POST['filter1']) && $_POST['filter1'] == "REJECTED" && $_POST['filter1_type'] == "wizard_status"):
            $_POST['filter1'] = 25;
        endif;
        if (isset($_POST['filter1']) && $_POST['filter1_type'] == "birth_date"):
            $_POST['filter1'] = date('Y/m/d', strtotime($_POST['filter1']));
        endif;
        //check user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

        if ($this->input->post("filter1") || $this->input->post("filter2")) {
            $search_opt = array(
                'filter1_type' => $this->input->post("filter1_type"),
                'filter1' => $this->input->post("filter1"),
                'filter2_type' => $this->input->post("filter2_type"),
                'filter2' => $this->input->post("filter2")
            );
            if (empty($search_opt['filter2_type']) || empty($search_opt['filter2'])):
                $search_opt['filter2_type'] = "";
                $search_opt['filter2'] = "";
            endif;
            // get user role
            $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
            if ($user_role->{'level'} == NURSE && $search_opt['filter1_type'] == "first_name") {
                show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
            } elseif ($user_role->{'level'} == NURSE && $search_opt['filter1_type'] == "last_name") {
                show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
                ;
            }
            $students = $this->schoolhealth_model->advance_search_list($this->limit, $offset, $search_opt, $user_role->name)->result();
            //  echo $this->db->last_query();
            //  exit;
        } elseif ($this->input->post("lastname")) {

            // get user role
            $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

            if ($user_role->{'level'} == NURSE) {
                $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

                $usertype = $user_role->{'slug'};
                $search_param = $this->input->post("sif");
                $students = $this->schoolhealth_model->get_paged_list($this->limit, $offset, $search_param, $usertype)->result();
            } else {
                // load data
                $search_param = $this->input->post("sif");
                $students = $this->schoolhealth_model->get_paged_list($this->limit, $offset, $search_param, $user_role->level)->result();
            }
        } elseif ($this->input->post("sif")) {
            $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
            $usertype = $user_role->{'slug'};
            $search_param = $this->input->post("sif");
            $students = $this->schoolhealth_model->get_paged_list($this->limit, $offset, $search_param, $user_role->level)->result();
            // generate pagination
            $config["base_url"] = site_url("search/student_search/index/");
            $config["total_rows"] = $this->schoolhealth_model->count_all($search_param);
            $config["per_page"] = $this->limit;
            $config["uri_segment"] = $uri_segment;
            $config["anchor_class"] = "class=\"btn btn-primary btn-sm\"";
            $this->pagination->initialize($config);
        }
        $formtype = 'Assessment';
        $formtype2 = 'Appraisal';

        // generate table data
        $this->table->set_empty("&nbsp;");
        $table_setup = array("table_open" => "<table id=\"results\"  class=\"tablesorter\">");
        $this->table->set_heading("Action", "Status", "SIF", "F.Name", "L.Name", "DOB", "School", "C.Owner", "L.Version", "copy", "P-Versions");
        $i = 0 + $offset;
        $view = array("type" => "button");
        $update = array("type" => "button");
        $user_roles = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $check_sif = array();
//        echo "<pre>";
//        print_r($students);
//        exit;
        foreach ($students as $list) {
            $formstatus = $this->schoolhealth_model->check_form_status($list->form_type, $list->wizard_sif_num, $list->unique_number);
            if (!empty($formstatus)):
                $list->wizard_status = $formstatus;
            endif;
            $sif = $list->wizard_sif_num;
            $current_owner = "";
            //Get currnt responsible user status
            $form_staus = $list->wizard_status;
            if ($form_staus == 45):
                $current_owner = 'N/A';
            else:
                $current_user_id = $this->schoolhealth_model->check_assessment_comments($list->wizard_sif_num, $list->unique_number);

                if (!empty($current_user_id) && $list->wizard_status <> 15 && $list->wizard_status <> 5):
                    $user_details = $this->adminui_model->get_user_role($current_user_id);
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                elseif (empty($current_user_id) && $user_role->{'name'} == Nurse && $list->form_type <> "Appraisal" && $list->wizard_by == $this->session->userdata('username')):
//                    exit($list->direct_report);
                    $current_user_id = $list->direct_report;
                    $user_details = $this->adminui_model->get_user_role($current_user_id);
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;

//                    echo $this->session->userdata('username');
//                    exit;
                else:
//                    exit($list->wizard_by);
//                    $current_user_id = $this->session->userdata('userid');
                    $user_details = $this->adminui_model->get_by_user($list->wizard_by)->row();
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                endif;
            endif;
            $submitter = $this->schoolhealth_model->get_by_user($user = $list->wizard_by)->row();
            $sel = $this->schoolhealth_model->check_nursedata($list->wizard_sif_num, $list->unique_number);
            $sele = $this->schoolhealth_model->getcount($list->wizard_sif_num, $list->form_type, $user_role->name);
            $sifnum = $signum . $list->wizard_sif_num;
            $sifnumber = end(explode("_", $list->wizard_num));
            $uname = $user_role->first_name . " " . $user_role->last_name;
            $checkuname = $submitter->first_name . " " . $submitter->last_name;
            if ($list->wizard_status == 5 && !empty($current_user_id)):
//                 exit($current_user_id);
                $user_details = $this->adminui_model->get_user_role($current_user_id);
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;
            if ($list->wizard_status == 5 && $list->wizard_by == $this->session->userdata('username')):

                $current_user_id = $this->session->userdata('user_id');
                $user_details = $this->adminui_model->get_user_role($current_user_id);
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;
            if ($list->wizard_status == 35):
//                    $user_details = $this->adminui_model->get_user_role($list->direct_report);
                $pm_id = $this->adminui_model->get_pm_id($current_user_id);
                $current_user_id = $pm_id;
                $user_details = $this->adminui_model->get_user_role($current_user_id);
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;
            if ($list->wizard_status == 25):
                $manageuser_id = $this->adminui_model->get_manageuser_id($current_user_id);
                $user_details = $this->adminui_model->get_user_role($manageuser_id);
//                $userdet = $this->adminui_model->get_by_user($list->wizard_by)->row();
                $current_user_id = $manageuser_id;
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;

            $latest_assessment = $this->adminui_model->get_latest_assessment();
            //$latest_appraisal = $this->adminui_model->get_latest_appraisal();
            //$latest_assessment = array_merge($latest_assessment, $latest_appraisal);

            $latest_assessment_sif = array();
            $latest_unique_number = array();
//Removed based on the current user only edit the forms
//            if (empty($current_user_id)):
//                $current_user_id = $this->session->userdata('user_id');
//            endif;

            foreach ($latest_assessment as $copysif) {
                $latest_assessment_sif[] = $copysif->wizard_sif_num;
                $latest_unique_number[] = $copysif->unique_number;
//                $wizard_status[] = $copysif->wizard_status;
                $latest_wizards_id[] = $copysif->wizard_id;
            }
            $wiz_id = $list->wizard_id;

            echo "<pre>";
            print_r($list->wizard_id);
            //exit;
            echo "<pre>";
            print_r($wiz_id);
            echo "<pre>";
            print_r($latest_wizards_id);
            echo $list->wizard_status;
            //exit;


            if ($list->birth_date == '1970-01-01' || $list->birth_date == '') {
                $dob_date = 'N/A';
            } else {
                $dob_date = date("m/d/y", strtotime($list->birth_date));
            }
// || $list->form_type == "Assessment"
            if ($user_role->{'name'} == Nurse && ($list->form_type == "Appraisal")):
                if (in_array($wiz_id, $latest_wizards_id) && $list->wizard_status == 45):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-1")
                    );

                elseif ($list->wizard_status == 5 && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-2")
                    );
                else:
//                    . "|" .
//                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit")
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-3")
                    );
                endif;

            elseif ($sel <> 0 || $user_role->{'name'} <> Nurse):
                if (in_array($wiz_id, $latest_wizards_id) && $list->wizard_status == 45):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-4")
                    );
                elseif ($list->wizard_status == 5 && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-5")
                    );

                elseif ($list->wizard_status <> 45 && $user_role->{'name'} == Nurse && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified))
                            . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" .
                                    $list->unique_number . "/res", "View All-6")
                    );

                elseif ($list->wizard_status == 45 && $user_role->{'name'} == Nurse && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified))
                            . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" .
                                    $list->unique_number . "/res", "View All-7")
                    );
                //&& $current_user_id == $this->session->userdata('user_id')
                elseif ($list->wizard_status <> 45 && $list->wizard_status <> 5 && $user_role->{'name'} <> Nurse && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified))
                            . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" .
                                    $list->unique_number . "/res", "View All-8")
                    );

                else:
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-9")
                    );
                endif;

            elseif (in_array($wiz_id, $latest_wizards_id) && $list->wizard_status == 45):

                $this->table->add_row(
                        anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-10")
                );
            else:
                $this->table->add_row(
                        anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, $dob_date, $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, "N/A", anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All-11")
                );
            endif;
            $check_sif[] = $sifnumber;
//            if (array_search($sifnumber, $check_sif) && $list->form_type <> "Appraisal") {
//                $xcount = 1;
//            } else {
//                $xcount = 0;
//            }
        }

        //exit;
        $data["pagination"] = $this->pagination->create_links();
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
        $data['message'] = "";
        $config["base_url"] = site_url("search/student_search/find_student/");
        $config["total_rows"] = $this->schoolhealth_model->count_all($search_param);
        $config["per_page"] = $this->limit;
        $config["uri_segment"] = $uri_segment;
        $config["anchor_class"] = "class=\"btn btn-primary btn-sm\"";
        $this->pagination->initialize($config);
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $data["search_content"] = "search_view/find_student";
        $this->load->view("search/template", $data);
    }

    public function students() {

        $sifval = $sifval . $this->input->get('sifnum', TRUE);
        //log_message('debug', 'Value of student is '+$this->input->post("student"));
        $data['response'] = 'false'; //Set default response
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        if ($user_role->{'level'} == NURSE) {

            $nurse_data = array(
                'sif' => $sifval,
                'user' => $this->session->userdata("username")
            );
            if ($sif->num_rows() > 0) {
                $data['response'] = 'true'; //Set response
                $data['message'] = array(); //Create array
                foreach ($sif->result() as $row) {
                    //print_r($row->wizard_sif_num); exit;
                    $data['message'][] = array('label' => $row->wizard_sif_num, 'value' => $row->wizard_sif_num); //Add a row to array
                }
            }
            // Populate the dropdown options here
            echo json_encode($data);
        } else {
            //exit('come');
            $lastname = $this->input->post("student");
            $students = $this->schoolhealth_model->get_students($lastname);
            if ($students->num_rows() > 0) {
                $data['response'] = 'true'; //Set response
                $data['message'] = array(); //Create array
                foreach ($students->result() as $row) {
                    $data['message'][] = array('label' => $row->wizard_sif_num, 'value' => $row->wizard_sif_num); //Add a row to array
                }
            }
            // Populate the dropdown options here
            echo json_encode($data);
        }
    }

    public function schools() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "search_record")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Return to previous page..."'));
        }
        $school_id = $this->input->post("schoolID");
        $schools = array();
        $schools = $this->schoolhealth_model->get_schools($school_id);
        // Populate the dropdown options here
        echo json_encode($schools);
    }

    public function get_allforms_user($offset = 0) {
        $uri_segment = 4;
        if ($viewModeUserID != null) {
            $uri_segment++;
        }
        $offset = $this->uri->segment($uri_segment);
        $students = array();
        $search_param = "";
        //check user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $offset);
        $students = $this->schoolhealth_model->get_user_forms($user_role->username);
        $formtype = 'Assessment';
        $formtype2 = 'Appraisal';
        $latest_assessment = $this->adminui_model->get_latest_assessment();
        $latest_assessment_sif = $latest_assessment->wizard_sif_num;
        $latest_unique_number = $latest_assessment->unique_number;
        $wizard_status = $latest_assessment->wizard_status;
        // generate table data
        $this->table->set_empty("&nbsp;");
        $table_setup = array("table_open" => "<table id=\"results\"  class=\"tablesorter\">");
        $this->table->set_heading("Action", "Status", "SIF", "F.Name", "L.Name", "DOB", "School", "C.Owner", "L.Version", "copy", "P-Versions");
        $i = 0 + $offset;
        $view = array("type" => "button");
        $update = array("type" => "button");
        $user_roles = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));


        foreach ($students as $list) {
            $formstatus = $this->schoolhealth_model->check_form_status($list->form_type, $list->wizard_sif_num, $list->unique_number);
            if (!empty($formstatus)):
                $list->wizard_status = $formstatus;
            endif;
            $sif = $list->wizard_sif_num;
            $current_owner = "";
            //Get currnt responsible user status
            $form_staus = $list->wizard_status;
            if ($form_staus == 45):
                $current_owner = 'N/A';
            else:
                $current_user_id = $this->schoolhealth_model->check_assessment_comments($list->wizard_sif_num, $list->unique_number);

                if (!empty($current_user_id) && $list->wizard_status <> 15 && $list->wizard_status <> 5):
                    $user_details = $this->adminui_model->get_user_role($current_user_id);
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                elseif (empty($current_user_id) && $user_role->{'name'} == Nurse && $list->form_type <> "Appraisal" && $list->wizard_by == $this->session->userdata('username')):
                    $current_user_id = $list->direct_report;
                    $user_details = $this->adminui_model->get_user_role($current_user_id);
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                else:
                    $user_details = $this->adminui_model->get_by_user($list->wizard_by)->row();
                    $current_owner = $user_details->first_name . " " . $user_details->last_name;
                endif;
            endif;
            $submitter = $this->schoolhealth_model->get_by_user($user = $list->wizard_by)->row();
            $sel = $this->schoolhealth_model->check_nursedata($list->wizard_sif_num, $list->unique_number);
            $sele = $this->schoolhealth_model->getcount($list->wizard_sif_num, $list->form_type, $user_role->name);
            $sifnum = $signum . $list->wizard_sif_num;
            $sifnumber = end(explode("_", $list->wizard_num));
            $uname = $user_role->first_name . " " . $user_role->last_name;
            $checkuname = $submitter->first_name . " " . $submitter->last_name;
            if ($list->wizard_status == 5 && !empty($current_user_id)):
//                 exit($current_user_id);
                $user_details = $this->adminui_model->get_user_role($current_user_id);
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;
            if ($list->wizard_status == 5 && $list->wizard_by == $this->session->userdata('username')):

                $current_user_id = $this->session->userdata('user_id');
                $user_details = $this->adminui_model->get_user_role($current_user_id);
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;
            if ($list->wizard_status == 35):
//                    $user_details = $this->adminui_model->get_user_role($list->direct_report);
                $pm_id = $this->adminui_model->get_pm_id($current_user_id);
                $current_user_id = $pm_id;
                $user_details = $this->adminui_model->get_user_role($current_user_id);
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;
            if ($list->wizard_status == 25):
                $manageuser_id = $this->adminui_model->get_manageuser_id($current_user_id);
                $user_details = $this->adminui_model->get_user_role($manageuser_id);
//                $userdet = $this->adminui_model->get_by_user($list->wizard_by)->row();
                $current_user_id = $manageuser_id;
                $current_owner = $user_details->first_name . " " . $user_details->last_name;
            endif;
//                echo $current_user_id;
//                exit;

            if ($user_role->{'name'} == Nurse && $list->form_type == "Appraisal"):
                if ($sifnumber == $latest_assessment_sif && $list->unique_number == $latest_unique_number && $list->wizard_status == 45):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                    );
                elseif ($list->wizard_status == 5 && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                    );
                else:
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") .
                            " ", $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                    );
                endif;

            elseif ($sel <> 0 || $user_role->{'name'} <> Nurse):

                if ($sifnumber == $latest_assessment_sif && $list->unique_number == $latest_unique_number && $list->wizard_status == 45):

                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                    );
                elseif ($list->wizard_status == 5 && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                    );

                elseif ($list->wizard_status <> 45 && $user_role->{'name'} == Nurse && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified))
                            . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" .
                                    $list->unique_number . "/res", "View All")
                    );
                elseif ($list->wizard_status == 45 && $user_role->{'name'} == Nurse && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified))
                            . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" .
                                    $list->unique_number . "/res", "View All")
                    );
                elseif ($list->wizard_status <> 45 && $list->wizard_status <> 5 && $user_role->{'name'} <> Nurse && $current_user_id == $this->session->userdata('user_id')):
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . " | " .
                            anchor("access_control/admin/form_update/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "Edit"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified))
                            . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" .
                                    $list->unique_number . "/res", "View All")
                    );

                else:
                    $this->table->add_row(
                            anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, 'N/A', anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                    );
                endif;
            elseif ($sifnumber == $latest_assessment_sif && $list->unique_number == $latest_unique_number && $list->wizard_status == 45):
                $this->table->add_row(
                        anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View"), $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, anchor("access_control/admin/form_copy/assessment_wiz16_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Assessment") . " " . anchor("access_control/admin/form_copy/appraisal_wiz06_" . $sifnumber . "-" . $list->wizard_id . "-" . $list->unique_number, "Appraisal"), anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                );
            else:

                $this->table->add_row(
                        anchor("access_control/admin/form_view/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number, "View") . "  ", $this->schoolhealth_model->form_status($status = $list->wizard_status), $list->wizard_sif_num, $list->first_name, $list->last_name, date("m/d/y", strtotime($list->birth_date)), $list->student_school, $current_owner, date("m/d/y", strtotime($list->wizard_modified)) . " - " . $submitter->first_name . " " . $submitter->last_name . " - " . $list->form_type, "N/A", anchor("access_control/admin/audit_trail/" . $list->wizard_num . "-" . $list->wizard_id . "-" . $list->unique_number . "/res", "View All")
                );
            endif;
        }
        $data["pagination"] = $this->pagination->create_links();
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
        $data['message'] = "";
        $config["base_url"] = site_url("search/student_search/find_student/");
        $config["total_rows"] = $this->schoolhealth_model->count_all($search_param);
        $config["per_page"] = $this->limit;
        $config["uri_segment"] = $uri_segment;
        $config["anchor_class"] = "class=\"btn btn-primary btn-sm\"";
        $this->pagination->initialize($config);
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $data["search_content"] = "search_view/find_student";
        $this->load->view("search/template", $data);
    }

}
