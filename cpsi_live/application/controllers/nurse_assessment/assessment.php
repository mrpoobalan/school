<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Assessment Controller
 *
 * @package	Assessment Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.0.0-pre
 */
require APPPATH . '/libraries/aah_controller.php';

class Assessment extends AAH_Controller {

    // number of records per page
    private $limit = 10;
    private $acl_table;
    private $sif = "123456";

    function __construct() {
        parent::__construct();
        $this->is_logged_in();
        // no page caching
        $this->output->nocache();
        // bootstrap dashboard and access control model
        $this->load->model("assessment_model", "", TRUE);
        $this->load->model("appraisal_model", "", TRUE);
        $this->load->model("schoolhealth_model", "", TRUE);
        $this->load->model("adminui_model", "", TRUE);
        // bootstrap acess control module
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
        $user = $this->adminui_model->get_by_user($user = $this->session->userdata("username"))->row();
        return $user;
    }

    function check_form_status() {
        // check if logged_in user has a form in progress
        $form_status = $this->assessment_model->get_form_status($user = $this->session->userdata("username"));
        return $form_status;
    }

    public function user_manager() {
        // get user manager and notify manager(s) of form modification
        $direct_report = $this->adminui_model->get_managed_users($user_id = $this->session->userdata("user_id"))->result();
        return $direct_report[0]->manage_by;
    }

    //User Changes
    public function view_assessment2($wizard_num, $auditid, $limit) {

        $unique_sif = $this->uri->segment(7);
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizardData = $this->GetWizardData('wiz01');
        $wizard_num = end(explode("_", $wizard_num));
        //Get wizard data (1)
        $wizard01 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz01_" . $wizard_num, $access = $user_role->level, $auditid, $limit);
        $data["wiz01"] = $wizard01;
        //Get wizard data (2)
        $wizard02 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz02_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz02"] = $wizard02;
        //Get wizard data (3)
        $wizard03 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz03_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz03"] = $wizard03;

        //Get wizard data (4)
        $wizard04 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz04_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz04"] = $wizard04;
        //Get wizard data (5)
        $wizard05 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz05_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz05"] = $wizard05;
        //Get wizard data (6)
        $wizard06 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz06_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz06"] = $wizard06;
        //Get wizard data (7)
        $wizard07 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz07_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz07"] = $wizard07;
        //Get wizard data (8)
        $wizard08 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz08_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz08"] = $wizard08;
        //Get wizard data (9)
        $wizard09 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz09_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz09"] = $wizard09;
        //Get wizard data (10)
        $wizard10 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz10_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz10"] = $wizard10;
        //Get wizard data (11)
        $wizard11 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz11_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz11"] = $wizard11;
        //Get wizard data (12)
        $wizard12 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz12_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz12"] = $wizard12;
        //Get wizard data (13)
        $wizard13 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz13_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz13"] = $wizard13;
        //Get wizard data (14)
        $wizard14 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz14_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz14"] = $wizard14;
        //Get wizard data (15)
        $wizard15 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz15_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz15"] = $wizard15;
        //Get wizard data (16)
        $wizard16 = $this->assessment_model->wizard_get_update($get_wizard_num = "assessment_wiz16_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz16"] = $wizard16;

//        echo "<pre>";
//        print_r($user_role);
//        echo $this->uri->segment(9);
//        echo "</pre>";
//        exit;
        $is_report = $this->uri->segment(9);
        // If the records empty need to view all the records
        if (empty($data["wiz01"]) && empty($data["wiz02"]) && empty($data["wiz03"]) && empty($data["wiz04"]) && empty($data["wiz05"]) && empty($data["wiz06"]) && empty($data["wiz07"]) && empty($data["wiz08"]) && empty($data["wiz09"]) &&
                empty($data["wiz10"]) && empty($data["wiz11"]) && empty($data["wiz12"]) &&
                empty($data["wiz13"]) && empty($data["wiz14"]) && empty($data["wiz15"]) && empty($data["wiz16"]) && empty($is_report)) {
            $wizardData->sif = $wizard_num;
            $unique_sifnumber = $unique_sif;

            //Get wizard data (1)
            $wizard01 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz01"] = json_decode($wizard01);
            //Get wizard data (2)
            $wizard02 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz02_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz02"] = json_decode($wizard02);
            //Get wizard data (3)
            $wizard03 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz03_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz03"] = json_decode($wizard03);
            //Get wizard data (4)
            $wizard04 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz04_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz04"] = json_decode($wizard04);
            //Get wizard data (5)
            $wizard05 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz05_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz05"] = json_decode($wizard05);
            //Get wizard data (6)
            $wizard06 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz06_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz06"] = json_decode($wizard06);
            //Get wizard data (7)
            $wizard07 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz07_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz07"] = json_decode($wizard07);
            //Get wizard data (8)
            $wizard08 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz08_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz08"] = json_decode($wizard08);
            //Get wizard data (9)
            $wizard09 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz09_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz09"] = json_decode($wizard09);
            //Get wizard data (10)
            $wizard10 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz10_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz10"] = json_decode($wizard10);
            //Get wizard data (11)
            $wizard11 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz11_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz11"] = json_decode($wizard11);
            //Get wizard data (12)
            $wizard12 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz12_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz12"] = json_decode($wizard12);
            //Get wizard data (13)
            $wizard13 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz13_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz13"] = json_decode($wizard13);
            //Get wizard data (14)
            $wizard14 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz14_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz14"] = json_decode($wizard14);
            //Get wizard data (15)
            $wizard15 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz15_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz15"] = json_decode($wizard15);
            //Get wizard data (16)
            $wizard16 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz16_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
            $data["wiz16"] = json_decode($wizard16);
        }

        $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
        $data['assessment_actions'] = "";
        $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
        // TODO: what's the hand off, once the action is processed, what happens (redirect)?
        if ($user_role->level != NURSE) {
            if ($currentUserHasAccessToAssessment) {
                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
        }

        $data['footerData'] = array('readOnlyViewing' => array(
                '#assessment.healthform :input[type=text]',
                '#assessment.healthform :input[type=radio]',
                '#assessment.healthform :input[type=checkbox]',
        ));
        // load view
        $data['assessment_actions'] = "";

        $data["forms"] = "forms_view/print/assessment/assessment_history";
        $this->load->view("forms/template", $data);
    }

    //Autosave for form datas
    public function autosave() {
        $value = $_GET;
        $val = json_encode($value);

        $data = $this->assessment_model->insert_autosave($val);
    }

    public function view_assessment3($unique_sifnumber = NULL) {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizardData = $this->GetWizardData('wiz01');
        $unique_sifnumber = end(explode("-", $this->uri->segment(4)));
        $sifnumber = explode("-", $this->uri->segment(4));
        $wizardData->sif = end(explode("_", $sifnumber[0]));

        //Check form stauts Rejected / Esclated
        $check_wizars_status = $this->assessment_model->check_wizard_status($wizardData->sif);
        $data['staus_comments'] = $check_wizars_status;
        //Get wizard data (1)
        $wizard01 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz01"] = json_decode($wizard01);
        //Get wizard data (2)
        $wizard02 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz02_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz02"] = json_decode($wizard02);
        //Get wizard data (3)
        $wizard03 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz03_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz03"] = json_decode($wizard03);
        //Get wizard data (4)
        $wizard04 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz04_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz04"] = json_decode($wizard04);
        //Get wizard data (5)
        $wizard05 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz05_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz05"] = json_decode($wizard05);
        //Get wizard data (6)
        $wizard06 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz06_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz06"] = json_decode($wizard06);
        //Get wizard data (7)
        $wizard07 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz07_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz07"] = json_decode($wizard07);
        //Get wizard data (8)
        $wizard08 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz08_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz08"] = json_decode($wizard08);
        //Get wizard data (9)
        $wizard09 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz09_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz09"] = json_decode($wizard09);
        //Get wizard data (10)
        $wizard10 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz10_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz10"] = json_decode($wizard10);
        //Get wizard data (11)
        $wizard11 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz11_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz11"] = json_decode($wizard11);
        //Get wizard data (12)
        $wizard12 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz12_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz12"] = json_decode($wizard12);
        //Get wizard data (13)
        $wizard13 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz13_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz13"] = json_decode($wizard13);
        //Get wizard data (14)
        $wizard14 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz14_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz14"] = json_decode($wizard14);
        //Get wizard data (15)
        $wizard15 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz15_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz15"] = json_decode($wizard15);
        //Get wizard data (16)
        $wizard16 = $this->assessment_model->wizard_get_new($get_wizard_num = "assessment_wiz16_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz16"] = json_decode($wizard16);
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['assessment_actions'] = "<ul>";
                    if ($user_role->level != NURSE_SUPERVISOR):
                        $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber . "/" . $unique_sifnumber, "Approve") . "</li>";
                    endif;
                    $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber . "/" . $unique_sifnumber, "Reject for Edits") . "</li>";
                    if ($user_role->level != PROGRAM_MANAGER):
                        $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber . "/" . $unique_sifnumber, "Escalate") . "</li>";
                    endif;
                    $data['assessment_actions'] .= "</ul>";
                }
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        }
        elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['assessment_actions'] = "<ul>";
                    if ($user_role->level != NURSE_SUPERVISOR):
                        $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber . "/" . $unique_sifnumber, "Save Edits & Approve") . "</li>";
                    endif;
                    $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber . "/" . $unique_sifnumber, "Reject for Edits") . "</li>";
                    $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber . "/" . $unique_sifnumber, "Save Edits & Escalate") . "</li>";
                    $data['assessment_actions'] .= "</ul>";
                }
            }
        }
        // load view
        $data['assessment_actions'] = "";
        $data["forms"] = "forms_view/print/assessment/assessment_view";
        $this->load->view("forms/template", $data);
    }

    public function view_assessment($unique_sifnumber) {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizardData = $this->GetWizardData('wiz01');
        //Check form stauts Rejected / Esclated
        $check_wizars_status = $this->assessment_model->check_wizard_status($wizardData->sif);
        $data['staus_comments'] = $check_wizars_status;

        //Get wizard data (1)
        $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz01"] = json_decode($wizard01);
        //Get wizard data (2)
        $wizard02 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz02_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz02"] = json_decode($wizard02);
        //Get wizard data (3)
        $wizard03 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz03_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz03"] = json_decode($wizard03);
        //Get wizard data (4)
        $wizard04 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz04_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz04"] = json_decode($wizard04);
        //Get wizard data (5)
        $wizard05 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz05_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz05"] = json_decode($wizard05);
        //Get wizard data (6)
        $wizard06 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz06_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz06"] = json_decode($wizard06);
        //Get wizard data (7)
        $wizard07 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz07_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz07"] = json_decode($wizard07);
        //Get wizard data (8)
        $wizard08 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz08_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz08"] = json_decode($wizard08);
        //Get wizard data (9)
        $wizard09 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz09_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz09"] = json_decode($wizard09);
        //Get wizard data (10)
        $wizard10 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz10_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz10"] = json_decode($wizard10);
        //Get wizard data (11)
        $wizard11 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz11_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz11"] = json_decode($wizard11);
        //Get wizard data (12)
        $wizard12 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz12_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz12"] = json_decode($wizard12);
        //Get wizard data (13)
        $wizard13 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz13_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz13"] = json_decode($wizard13);
        //Get wizard data (14)
        $wizard14 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz14_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz14"] = json_decode($wizard14);
        //Get wizard data (15)
        $wizard15 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz15_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz15"] = json_decode($wizard15);
        //Get wizard data (16)
        $wizard16 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz16_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz16"] = json_decode($wizard16);
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {

            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['assessment_actions'] = "<ul>";
                    if ($user_role->level != NURSE_SUPERVISOR):
                        $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber . "/" . $unique_sifnumber, "Approve") . "</li>";
                    endif;
                    $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber . "/" . $unique_sifnumber, "Reject for Edits") . "</li>";
                    if ($user_role->level != PROGRAM_MANAGER):
                        $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber . "/" . $unique_sifnumber, "Escalate") . "</li>";
                    endif;
                    $data['assessment_actions'] .= "</ul>";
                }
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        }
        elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['assessment_actions'] = "<ul>";
                    $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Save Edits & Approve") . "</li>";
                    $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Save Edits & Escalate") . "</li>";
                    $data['assessment_actions'] .= "</ul>";
                }
            }
        }

        // load view
        $data['assessment_actions'] = "";
        $data["forms"] = "forms_view/print/assessment/assessment_view";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_01() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard01 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz01");
        $data["wiz01"] = json_decode($wizard01);

        $wizard02 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz02");
        $data["wiz02"] = json_decode($wizard02);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_02");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_01";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_02() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard03 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz03");
        $data["wiz03"] = json_decode($wizard03);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_03");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_01");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_02";

        $this->load->view("forms/template", $data);
    }

    public function assessment_print_03() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard04 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz04");
        $data["wiz04"] = json_decode($wizard04);

        $wizard05 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz05");
        $data["wiz05"] = json_decode($wizard05);

        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_04");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_02");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_03";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_04() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }

        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard05 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz05");
        $data["wiz05"] = json_decode($wizard05);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_05");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_03");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_04";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_05() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard06 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz06");
        $data["wiz06"] = json_decode($wizard06);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_06");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_04");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_05";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_06() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard07 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz07");
        $data["wiz07"] = json_decode($wizard07);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_07");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_05");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_06";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_07() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard08 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz08");
        $data["wiz08"] = json_decode($wizard08);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_08");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_06");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_07";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_08() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard09 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz09");
        $data["wiz09"] = json_decode($wizard09);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_09");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_07");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_08";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_09() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard10 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz10");
        $data["wiz10"] = json_decode($wizard10);

        $wizard11 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz11");
        $data["wiz11"] = json_decode($wizard11);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_10");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_08");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_09";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_10() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard11 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz11");
        $data["wiz11"] = json_decode($wizard11);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_11");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_09");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_10";
        $this->load->view("forms/template", $data);
    }

    public function assessment_print_11() {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment Print Page";
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get data wizards
        $wizard12 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz12");
        $data["wiz12"] = json_decode($wizard12);

        $wizard13 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz13");
        $data["wiz13"] = json_decode($wizard13);

        $wizard14 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz14");
        $data["wiz14"] = json_decode($wizard14);

        $wizard15 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz15");
        $data["wiz15"] = json_decode($wizard15);

        $wizard16 = $this->assessment_model->wizard_get($wizard_num = "assessment_wiz16");
        $data["wiz16"] = json_decode($wizard16);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/assessment_print_12");
        $data["link_back"] = site_url("nurse_assessment/assessment/assessment_print_10");
        // load view
        $data["forms"] = "forms_view/print/assessment/assessment_11";
        $this->load->view("forms/template", $data);
    }

    public function wizard_01() {
//        exit('come');
        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // set common properties
        $data["subtitle"] = "New Nursing Assessment";
        $school_type = $this->schoolhealth_model->get_schooltype();
        $data["schooltype_array"] = $school_type;
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");

        // let's grab any saved entry
        $currentWizard = 'wiz01';
        $action = $this->input->get('action');
        if ($action <> 'add'):
            $wizardData = $this->GetWizardData($currentWizard);
        endif;

        if ($pageWasRefreshed) {
            $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        } else {
            $sql = $this->assessment_model->delete_autosave();
        }

        //if ((!empty($copy) && $copy == "copy")) {
        //if ((empty($copy))) {
        // echo "copy";
        //Unset session data of unique number and copy_assigned_unique_number for copy option
        //$this->session->unset_userdata('unique_number'); // Unset the unique number here
        $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
        // }

        if (!empty($wizardData)) {
            if (is_numeric($copy)):
                $wizardData->unique_number = $copy;
            endif;
            if (!empty($copy_unumber)):
                $wizardData->unique_number = $copy_unumber;
            endif;

            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard01)):
                $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
        }
        if (!empty($wizard01)) {
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
            $data["wiz01"] = json_decode($wizard01);
        } else {
            $wizard01 = (object) array(
                        'sif' => "",
                        'statenum' => "",
                        'fname' => "",
                        'lname' => "",
                        'nickname' => "",
                        'dob' => "",
                        'parentname' => "",
                        'cellphone' => "",
                        'street' => "",
                        'homephone' => "",
                        'city' => "",
                        'workphone' => "",
                        'zip' => "",
                        'addtnlcontact' => "",
                        'addtnlcellphone' => "",
                        'addtnlhomephone' => "",
                        'addtnlworkphone' => "",
                        'private' => "",
                        'mchp' => "",
                        'other' => "",
                        'medicaid' => "",
                        'none_text' => "",
                        'preferred_hospital' => "",
                        'dnrorder' => "",
                        'schoolplan' => "",
                        'immunization' => "",
                        'immunocompromised' => "",
                        'religious' => "",
                        'medical' => "",
                        'medical_reason' => "",
                        'contactattempt1' => "",
                        'schoolID' => ""
            );
            $data["wiz01"] = $wizard01;
        }
        $obj = json_decode(json_encode($data["wiz01"]), true);
        $obj['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $obj['dob'])));
        $obj['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $obj['contactattempt1'])));
        $this->session->set_userdata('sifnumber', $obj['sif']);
        $this->session->set_userdata('formdet', $obj);
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        $data["user"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["lastname"] = $user->last_name;
        //URLS
        if (!empty($copy) && $copy == "copy"):
            $data["subtitle"] = "Copy Nursing Assessment";
            $data["action"] = site_url("nurse_assessment/assessment/wizard_02/copy/" . $copy_unumber);
        else:
            if (is_numeric($copy)):
                $data["action"] = site_url("nurse_assessment/assessment/wizard_02/" . $copy);
            else:

                $data["action"] = site_url("nurse_assessment/assessment/wizard_02");
            endif;
            $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_02");
        endif;
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['assessment_actions'] = "<ul>";
                    if ($user_role->level != NURSE_SUPERVISOR):
                        $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                    endif;
                    if ($user_role->level != PROGRAM_MANAGER):
                        $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                    endif;
                    $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                    $data['assessment_actions'] .= "</ul>";
                }
            }


            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        }
        elseif (!$wizardData->viewOnly == true) {

            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
//            exit($currentUserHasAccessToAssessment);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }


        if (!empty($copy) && !is_numeric($copy) && $copy == "copy") {

            $unum = $this->uri->segment(5);
            $this->session->set_userdata('copy_assigned_unique_number', $unum);
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');

        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
        }

        $data['autosave'] = array();
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data['assessment_actions'] = "";
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_01";
        $this->load->view("forms/template", $data);
    }

    public function wizard_02() {
        $sifnum = $this->input->post('sif');
        $copy = $this->uri->segment(4);

        if (!empty($copy) && is_numeric($copy)) {
            $this->session->set_userdata('unique_number', $copy);
        }

        $unique_session_value = $this->session->userdata('unique_number');
        if (empty($unique_session_value)):
            $unique_number = $this->assessment_model->count_form_sessions($sifnum);
            $unique_number = $unique_number + 1;
            $this->session->set_userdata('unique_number', $unique_number);
        endif;
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        $_POST['reevaldate'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('reevaldate'))));
        $_POST['previousdate'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('previousdate'))));
        $contactattempt = '';
        foreach ($_POST['contactattempt'] as $contacts) {
            $contactattempt .= date('Y-m-d', strtotime(str_replace('-', '/', $contacts))) . ',';
        }
        $contactattempt = substr_replace($contactattempt, "", -1);
        //Additional contact
        $addtnlcontact = $relationship = $addtnlcellphone = $addtnlhomephone = $addtnlworkphone = array();
        $addtnlcontact = $_POST['sheepItForm1_addtnlcontact'];
        $relationship = $_POST['sheepItForm1_relationship'];
        $addtnlcellphone = $_POST['sheepItForm1_addtnlcellphone'];
        $addtnlhomephone = $_POST['sheepItForm1_addtnlhomephone'];
        $addtnlworkphone = $_POST['sheepItForm1_addtnlworkphone'];
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $previousWizardData = $this->input->post(NULL, TRUE);
            $previousWizardData['unique_number'] = $this->session->userdata('unique_number');
            $this->SaveWizardData('wiz01', $previousWizardData);
            $data['sif_num'] = $this->input->post('sif');
        }
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // let's grab any saved entry
        $wizardData = $this->GetWizardData('wiz01');
//        echo "<pre>";
//        print_r($wizardData);
//        exit;
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');

        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        // echo "1";
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        //echo "2";
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        // echo "3";
        endif;

        if (!empty($wizardData)) {
            // echo "1<br>";
            $wizard02 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz02_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard02)):
                //echo "2<br>";
                $wizard02 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz02_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                //echo "3";
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            //$data["wizardData"] = json_decode($wizard02);
            $data['sif_num'] = $wizardData->sif;
        }
//        echo "<pre>";
//        print_r($wizard01);
//        exit;

        $obj = json_decode($wizard01);
        if (!empty($wizard02)) {
            $data["wiz_02"] = json_decode($wizard02);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard02 = (object) array(
                        'assessment' => "",
                        'edustatus' => $this->input->post("edustatus"),
                        'edustatus2_regular' => "",
                        'edustatus2_iep' => "",
                        'edustatus2_504' => "",
                        'grade' => "",
                        'othergrade' => "",
                        'assistant' => "",
                        'eduservices_occupational' => "",
                        'eduservices_physical' => "",
                        'eduservices_speech' => "",
                        'eduservices_counseling' => "",
                        'eduservices_pe' => "",
                        'offlocation_hospital' => "",
                        'offlocation_home' => "",
                        'reevaldate' => "",
                        'assist_tech' => "",
                        'assist_tech_lt' => "",
                        'accomodations' => "",
                        'accomodations_lt' => "",
                        'ihp' => "",
                        'diagnosis1' => "",
                        'birthweight' => "",
                        'gestation' => "",
                        'birthtype' => "",
                        'milestone' => "",
                        'describe_milestones' => "",
                        'complications' => "",
                        'emergencies' => "",
                        'previousdate' => "",
                        'narrative' => "",
                        //Assessment 15th form add(Transportation status)
                        'hide16' => "",
                        'trans_method_walker' => "",
                        'trans_method_car' => "",
                        'trans_method_bus' => "",
                        'trans_method_lift' => "",
                        'bus_services_assist' => "",
                        'bus_services_aide' => "",
                        'bus_services_nursing' => "",
                        'bus_services_equip' => "",
                        'bus_meds' => "",
                        'list_bus_meds' => "",
                        'med_bus_selfadmin' => "",
                        'med_bus_selfmed' => "",
                        'med_bus_aideadmin' => "",
                        'bus_snacks' => "",
                        'bus_mod' => "",
                        'bus_mod_list' => "",
                        'trans_comments' => "",
                        'describe_Snacks' => ""
            );
            $data["wiz_02"] = $wizard02;
        }

        $wizard_01 = array(
            'sif' => $this->input->post("sif"),
            'unique_number' => $this->session->userdata('unique_number'),
            'statenum' => $this->input->post("statenum"),
            'fname' => $this->input->post("fname"),
            'lname' => $this->input->post("lname"),
            'nickname' => $this->input->post("nickname"),
            'schoolID' => $this->input->post("schoolID"),
            'school' => $this->input->post("school"),
            'dob' => date("m-d-Y", strtotime($this->input->post("dob"))),
            'parentname' => $this->input->post("parentname"),
            'cellphone' => $this->input->post("cellphone"),
            'street' => $this->input->post("street"),
            'homephone' => $this->input->post("homephone"),
            'city' => $this->input->post("city"),
            'workphone' => $this->input->post("workphone"),
            'zip' => $this->input->post("zip"),
            'addtnlcontact' => $addtnlcontact,
            'relationship' => $relationship,
            'addtnlcellphone' => $addtnlcellphone,
            'addtnlhomephone' => $addtnlhomephone,
            'addtnlworkphone' => $addtnlworkphone,
            'private' => $this->input->post("private"),
            'mchp' => $this->input->post("mchp"),
            'other' => $this->input->post("other"),
            'medicaid' => $this->input->post("medicaid"),
            'medicaid' => $this->input->post("medicaid"),
            'none' => $this->input->post("none"),
            'none_text' => $this->input->post("none_text"),
            'preferred_hospital' => $this->input->post("preferred_hospital"),
            'dnrorder' => $this->input->post("dnrorder"),
            'schoolplan' => $this->input->post("schoolplan"),
            'immunization' => $this->input->post("immunization"),
            'immunocompromised' => $this->input->post("immunocompromised"),
            'religious' => $this->input->post("religious"),
            'medical' => $this->input->post("medical"),
            'medical_reason' => $this->input->post("medical_reason"),
            'is_applicable' => $this->input->post("is_applicable"),
            'contactattempt1' => $contactattempt
        );
        $array2json = json_encode($wizard_01);
        // Create form session wizard01
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'wizard_num' => 'assessment_wiz01_' . $this->input->post("sif"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $this->input->post("statenum"),
            'first_name' => $this->input->post("fname"),
            'unique_number' => $this->session->userdata('unique_number'),
            'student_school' => $this->input->post("school"),
            'last_name' => $this->input->post("lname"),
            'birth_date' => $this->input->post("dob")
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // check if save & exit was submitted
            if (isset($_POST['assessment_save'])) {
                //Count of data forms filled against sif
                $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
                $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
                if (empty($create_user_name)) {
                    if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                        $wizard_data['wizard_status'] = IN_PROGRESS;
                    } else if ($counts >= 14 && $user_role->level == NURSE) {
                        $wizard_data['wizard_status'] = IN_PROGRESS;
                    } else if ($counts < 14) {
                        $wizard_data['wizard_status'] = IN_PROGRESS;
                    }
                } else {
                    $wizard_data['wizard_status'] = ESCALATED;
                }
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz01_" . $data['sif_num']);
                $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
                unset($wizard_data['wizard_data']);
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
                $wiznum = $wizardData->{'sif'};
                $this->adminui_model->delete_record($wiznum);
                $sql = $this->assessment_model->delete_autosave();
                $this->session->unset_userdata('unique_number'); // Unset the unique number here
                $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
                // after posting data, redirect to logout
                redirect("search/student_search");
            } elseif (isset($_POST['assessment_resave'])) {
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz01_" . $data['sif_num']);
                $wizard_data['wizard_status'] = IN_PROGRESS;
                $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
                unset($wizard_data['wizard_data']);
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
                $wiznum = $wizardData->{'sif'};
                $this->adminui_model->delete_record($wiznum);
                $sql = $this->assessment_model->delete_autosave();
                $this->session->unset_userdata('unique_number'); // Unset the unique number here
                $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
                // after posting data, redirect to logout
                redirect("search/student_search");
            }
            // Click Save Edits & Approve button
            elseif (isset($_POST['appsubmit'])) {
                $wizardNumber = "assessment_wiz01_" . $data['sif_num'];
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz01_" . $data['sif_num']);
                $wizard_data['wizard_status'] = COMPLETED;
                $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
                unset($wizard_data['wizard_data']);
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
                $wiznum = $wizardData->{'sif'};
                $this->adminui_model->delete_record($wiznum);
                $sql = $this->assessment_model->delete_autosave();
                $this->session->unset_userdata('unique_number'); // Unset the unique number here
                $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
                redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
            }
            // Click Save Edits & Escalate button
            elseif (isset($_POST['escsubmit'])) {
                $wizardNumber = "assessment_wiz01_" . $data['sif_num'];
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz01_" . $data['sif_num']);
                $wizard_data['wizard_status'] = ESCALATED;
                $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
                unset($wizard_data['wizard_data']);
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
                $wiznum = $wizardData->{'sif'};
                $this->adminui_model->delete_record($wiznum);
                $sql = $this->assessment_model->delete_autosave();
                $this->session->unset_userdata('unique_number'); // Unset the unique number here
                $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
                redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
            }
            // Click Save Edits & Reject button
            elseif (isset($_POST['rejsubmit'])) {
                $wizardNumber = "assessment_wiz01_" . $data['sif_num'];
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz01_" . $data['sif_num']);
                $wizard_data['wizard_status'] = REJECTED;
                $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
                unset($wizard_data['wizard_data']);
                $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
                $wiznum = $wizardData->{'sif'};
                $this->adminui_model->delete_record($wiznum);
                $sql = $this->assessment_model->delete_autosave();
                $this->session->unset_userdata('unique_number'); // Unset the unique number here
                $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
                redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
            } else {
                if ($user_role->{'level'} == 50):

                    $wizard_data['wizard_status'] = IN_PROGRESS;
                    $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz01_" . $data['sif_num']);
                else:
                    $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz01_" . $data['sif_num']);
                endif;
            }
        }
        // check if save & exit was submitted
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif ($_POST['assessment2']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {

            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }


            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {

            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";

            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data['sif_num'] = $data['sif_num'];
        $data["search_action"] = site_url("search/student_search/find_student");
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "copy"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_03/copy");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_03");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_03");
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_02";
        if (is_numeric($copy)):
            $data["link_back"] = anchor("nurse_assessment/assessment/wizard_01/" . $copy, "<button type='button' class='previous'>Previous</button>");
        else:
            $data["link_back"] = anchor("nurse_assessment/assessment/wizard_01/datas", "<button type='button' class='previous'>Previous</button>");
        endif;
        $data['assessment_actions'] = "";
//        echo "<pre>";
//        print_r($data);
//        exit;
        $this->load->view("forms/template", $data);
    }

    public function wizard_03() {

        $copy = $this->uri->segment(4);
        $_POST['reevaldate'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('reevaldate'))));
        $_POST['release_exp1'] = $this->input->post('release_exp1');
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        //Add health care plan
        $diagnosis = '';
        foreach ($_POST['newdiagnosis'] as $val) {
            $diagnosis .= $val . ',';
        }
        $diagnosis = substr_replace($diagnosis, "", -1);
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        // parse user details
        $user = $this->user_info();
        $data["subtitle"] = "New Nursing Assessment";
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // let's grab any saved entry
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard03 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz03_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard03)):
                $wizard03 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz03_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard03)) {
            $data["wiz_03"] = json_decode($wizard03);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard03 = (object) array(
                        'primary' => "",
                        'lastexam1' => "",
                        'nextexam1' => "",
                        'phone1' => "",
                        'fax1' => "",
                        'release1' => "",
                        'release_exp1' => "",
                        'specialist1' => "",
                        'lastexam2' => "",
                        'nextexam2' => "",
                        'phone2' => "",
                        'fax2' => "",
                        'release2' => "",
                        'release_exp2' => "",
                        'hide1' => "",
                        'dentist' => "",
                        'dentalexam' => "",
                        'dentalhistory' => "",
                        'dentalrelease' => "",
                        'hearing' => "",
                        'hearingexam' => "",
                        'hearinghistory' => "",
                        'hearingrelease' => "",
                        'vision' => "",
                        'visionexam' => "",
                        'visionhistory' => "",
                        'visionrelease' => "",
                        'hide2' => "",
                        'name1' => "",
                        'agencyphone1' => "",
                        'agencyfax1' => "",
                        'agencyrelease1' => ""
            );
            $data["wiz_03"] = $wizard03;
        }
        if (!empty($_POST['hide366'])):
            $diagnosis = "";
        endif;
        $wizard_02 = array(
            'assessment' => $this->input->post("assessment"),
            //Educational status
            'edustatus' => $this->input->post("edustatus"),
            'edustatus2_regular' => $this->input->post("edustatus2_regular"),
            'edustatus2_iep' => $this->input->post("edustatus2_iep"),
            'edustatus2_504' => $this->input->post("edustatus2_504"),
            'grade' => $this->input->post("grade"),
            'othergrade' => $this->input->post("othergrade"),
            'assistant' => $this->input->post("assistant"),
            'eduservices_occupational' => $this->input->post("eduservices_occupational"),
            'eduservices_physical' => $this->input->post("eduservices_physical"),
            'eduservices_speech' => $this->input->post("eduservices_speech"),
            'eduservices_counseling' => $this->input->post("eduservices_counseling"),
            'eduservices_pe' => $this->input->post("eduservices_pe"),
            'offlocation_hospital' => $this->input->post("offlocation_hospital"),
            'offlocation_home' => $this->input->post("offlocation_home"),
            'reevaldate' => $_POST['reevaldate'],
            'assist_tech' => $this->input->post("assist_tech"),
            'assist_tech_lt' => $this->input->post("assist_tech_lt"),
            'accomodations' => $this->input->post("accomodations"),
            'accomodations_lt' => $this->input->post("accomodations_lt"),
            // Educational status end
            'ihp' => $this->input->post("ihp"),
            'birthweight' => $this->input->post("birthweight"),
            'gestation' => $this->input->post("gestation"),
            'birthtype' => $this->input->post("birthtype"),
            'milestone' => $this->input->post("milestone"),
            'describe_milestones' => $this->input->post("describe_milestones"),
            'complications' => $this->input->post("complications"),
            'describe_complications' => $this->input->post("describe_complications"),
            'emergencies' => $this->input->post("emergencies"),
            'describe_emergencies' => $this->input->post("describe_emergencies"),
            'previousdate' => $_POST['previousdate'],
            'narrative' => $this->input->post("narrative"),
            //Transportation form (assessment 15) added here
            'trans_method_walker' => $this->input->post("trans_method_walker"),
            'trans_method_car' => $this->input->post("trans_method_car"),
            'trans_method_bus' => $this->input->post("trans_method_bus"),
            'trans_method_lift' => $this->input->post("trans_method_lift"),
            'bus_services_assist' => $this->input->post("bus_services_assist"),
            'bus_services_aide' => $this->input->post("bus_services_aide"),
            'bus_services_nursing' => $this->input->post("bus_services_nursing"),
            'bus_services_equip' => $this->input->post("bus_services_equip"),
            'bus_meds' => $this->input->post("bus_meds"),
            'list_bus_meds' => $this->input->post("list_bus_meds"),
            'med_bus_selfadmin' => $this->input->post("med_bus_selfadmin"),
            'med_bus_selfmed' => $this->input->post("med_bus_selfmed"),
            'med_bus_aideadmin' => $this->input->post("med_bus_aideadmin"),
            'bus_snacks' => $this->input->post("bus_snacks"),
            'bus_mod' => $this->input->post("bus_mod"),
            'bus_mod_list' => $this->input->post("bus_mod_list"),
            'trans_comments' => $this->input->post("trans_comments"),
            'trans_field' => $this->input->post("trans_field"),
            'describe_Snacks' => $this->input->post("describe_Snacks"),
            'hide366' => $this->input->post("hide366"),
            'diagnosis1' => $diagnosis
        );
        $array2json = json_encode($wizard_02);
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz02_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        // check if save & exit was submitted
        if (isset($_POST['assessment_save'])) {

            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);

            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }

//            echo  $wizard_data['wizard_status']; exit;

            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz02_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz02_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz02_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment2']) {

            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz02_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";

                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }

            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";

            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);

            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            //Unset Agency case manager
            $data['wiz_03']->name1 = "";
            $data['wiz_03']->agname1 = "";
            $data['wiz_03']->cashman1 = "";
            $data['wiz_03']->agencyphone1 = "";
            $data['wiz_03']->agencyrelease1 = "";
        }
        //URLS
        if (!empty($copy) && $copy == "copy"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_04/copy");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_04");
        endif;

        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_04");
        //echo "<pre>"; print_r(); exit;
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_03";
        if (is_numeric($copy)):
            $data["link_back"] = anchor("nurse_assessment/assessment/wizard_02/" . $copy, "<button type='button' class='previous'>Previous</button>");
        else:
            $data["link_back"] = anchor("nurse_assessment/assessment/wizard_02/datas", "<button type='button' class='previous'>Previous</button>");
        endif;
        $data['assessment_actions'] = "";
//        echo "<pre>";
//        print_r($data);
//        exit;
        $this->load->view("forms/template", $data);
    }

    public function wizard_04() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        $_POST['release_exp1'] = $this->input->post('release_exp1');
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        //Agency cash manager
        $name = $_POST['sheepItForm_name'];
        $agname = $_POST['sheepItForm_agname'];
        $cashman = $_POST['sheepItForm_cashman'];
        $phone = $_POST['sheepItForm_phone'];
        $fax = $_POST['sheepItForm_fax'];
        $maxcount = max(count($name), count($phone), count($fax));
        $sheepItForm_release = array();
        for ($i = 0; $i < $maxcount; $i++) {
            $sheepItForm_release[] = $_POST['sheepItForm_release' . $i];
        }
        $specialist = $_POST['sheepItForm1_specialist'];
        $type = $_POST['sheepItForm1_type'];
        $lastexam = $_POST['sheepItForm1_lastexam'];
        $nextexam = $_POST['sheepItForm1_nextexam'];
        $releaseexp = $_POST['sheepItForm1_releaseexp'];
        $releaseexpdesc = $_POST['sheepItForm1_describe_sheepItForm'];
        $phone1 = $_POST['sheepItForm1_phone'];
        $fax1 = $_POST['sheepItForm1_fax'];
        $maxcount1 = max(count($specialist), count($lastexam), count($nextexam), count($releaseexp));
        $sheepItForm1_release = array();
        for ($i = 0; $i < $maxcount1; $i++) {
            $sheepItForm1_release[] = $_POST['sheepItForm1_release' . $i];
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data['sif_num'] = $this->input->post('sif');
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard04 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz04_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            //For copy appraisal form
            if (empty($wizard04)):
                $wizard04 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz04_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
        }
        //Decode the json code
        $obj = json_decode($wizard01);
        if (!empty($wizard04)) {
            $data["wiz_04"] = json_decode($wizard04);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard04 = (object) array(
                        'hide3' => "",
                        'med1' => "",
                        'dose1' => "",
                        'time1' => "",
                        'route1' => "",
                        'taken1_school' => "",
                        'taken1_home' => "",
                        'hide4' => "",
                        'prnmed1' => "",
                        'prndose1' => "",
                        'prntime1' => "",
                        'prnroute1' => "",
                        'prntaken1_school' => "",
                        'prntaken1_home' => "",
                        'prntaken1_emergency' => ""
            );
            $data["wiz_04"] = $wizard04;
        }
//Section values pass if checked
        if (!empty($_POST['hide1'])):
            $_POST['dentist'] = "";
            $_POST['dentalexam'] = "";
            $_POST['dentalhistory'] = "";
            $_POST['dentalrelease'] = "";
            $_POST['hearing'] = "";
            $_POST['hearingexam'] = "";
            $_POST['hearinghistory'] = "";
            $_POST['hearingrelease'] = "";
            $_POST['vision'] = "";
            $_POST['visionexam'] = "";
            $_POST['visionhistory'] = "";
            $_POST['visionrelease'] = "";
        endif;

        if (!empty($_POST['hide2'])):
            $name = "";
            $agname = "";
            $cashman = "";
            $phone = "";
            $fax = "";
            $sheepItForm_release = "";
        endif;

        //Posting wizard 3 data
        $wizard_03 = array(
            'primary' => $this->input->post("primary"),
            'lastexam1' => $this->input->post("lastexam1"),
            'nextexam1' => $this->input->post("nextexam1"),
            'phone1' => $this->input->post("phone1"),
            'fax1' => $this->input->post("fax1"),
            'release1' => $this->input->post("release1"),
            'describe_release1' => $this->input->post("describe_release1"),
            'release_exp1' => $_POST['release_exp1'],
            'specialist1' => $specialist,
            'type1' => $type,
            'lastexam2' => $lastexam,
            'nextexam2' => $nextexam,
            'phone2' => $phone1,
            'fax2' => $fax1,
            'release2' => $sheepItForm1_release,
            'describe_sheepItForm' => $releaseexpdesc,
            'release_exp2' => $releaseexp,
            'hide1' => $this->input->post("hide1"),
            'dentist' => $this->input->post("dentist"),
            'dentalexam' => $this->input->post("dentalexam"),
            'dentalhistory' => $this->input->post("dentalhistory"),
            'dentalrelease' => $this->input->post("dentalrelease"),
            'hearing' => $this->input->post("hearing"),
            'hearingexam' => $this->input->post("hearingexam"),
            'hearinghistory' => $this->input->post("hearinghistory"),
            'hearingrelease' => $this->input->post("hearingrelease"),
            'vision' => $this->input->post("vision"),
            'visionexam' => $this->input->post('visionexam'),
            'visionhistory' => $this->input->post("visionhistory"),
            'visionrelease' => $this->input->post("visionrelease"),
            'hide2' => $this->input->post("hide2"),
            'name1' => $name,
            'agname1' => $agname,
            'cashman1' => $cashman,
            'agencyphone1' => $phone,
            'agencyfax1' => $fax,
            'agencyrelease1' => $sheepItForm_release
        );

        $array2json = json_encode($wizard_03);
        // create form session wizard03
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz03_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        // check if save & exit was submitted
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz03_" . $data['sif_num']); //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz03_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz03_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz03_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz03_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz03_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz03_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz03_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment3']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz03_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }

            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_04'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "copy"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_05/copy");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_05");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_05");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_04";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_03/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_05() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $med1 = $_POST['sheepItForm_med'];
        $dose1 = $_POST['sheepItForm_dos'];
        $route1 = $_POST['sheepItForm_route'];
        $time1 = $_POST['sheepItForm_time'];

        $maxcount = max(count($med1), count($dose1), count($route1));
        $sheepItForm_school = array();
        $sheepItForm_home = array();
        for ($i = 0; $i < $maxcount; $i++) {
            $sheepItForm_school[] = $_POST['sheepItForm_school' . $i];
            $sheepItForm_home[] = $_POST['sheepItForm_home' . $i];
        }
        $prnmed1 = $_POST['sheepItForm1_prnmed'];
        $prndose1 = $_POST['sheepItForm1_prndos'];
        $prnroute1 = $_POST['sheepItForm1_prntime'];
        $prntime1 = $_POST['sheepItForm1_prnroute'];

        $maxcount1 = max(count($prnmed1), count($prndose1), count($prnroute1));
        $sheepItForm1_school = array();
        $sheepItForm1_home = array();
        $sheepItForm1_emerg = array();
        for ($i = 0; $i < $maxcount1; $i++) {
            $sheepItForm1_school[] = $_POST['sheepItForm1_prnschool' . $i];
            $sheepItForm1_home[] = $_POST['sheepItForm1_prnhome' . $i];
            $sheepItForm1_emerg[] = $_POST['sheepItForm1_prnemerg' . $i];
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard05 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz05_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            //For copy appraisal form
            if (empty($wizard05)):
                $wizard05 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz05_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard05)) {

            $data["wiz_05"] = json_decode($wizard05);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard05 = (object) array(
                        'hide5' => "",
                        'treatment1' => "",
                        'frequency1' => "",
                        'performed1_school' => "",
                        'performed1_home' => "",
                        'person1' => "",
                        'hide6' => "",
                        'allergy1' => "",
                        'reaction1' => "",
                        'deadly1' => "",
                        'sensitivity1_touch' => "",
                        'sensitivity1_ingest' => "",
                        'sensitivity1_air' => "",
                        'treatment1_epi' => "",
                        'treatment1_antihistamine' => "",
                        'ah1' => "",
                        'diagnosed1' => "",
                        'lastevent1' => "",
                        'addtnlcomments1' => ""
            );
            $data["wiz_05"] = $wizard05;
        }
        //Section values pass if checked
        if (!empty($_POST['hide3'])):
            $med1 = "";
            $dose1 = "";
            $time1 = "";
            $route1 = "";
            $sheepItForm_school = "";
            $sheepItForm_home = "";
        endif;
        if (!empty($_POST['hide4'])):
            $prnmed1 = "";
            $prndose1 = "";
            $prntime1 = "";
            $prnroute1 = "";
            $sheepItForm1_school = "";
            $sheepItForm1_home = "";
            $sheepItForm1_emerg = "";
        endif;
        //Posting the data of wizard 4
        $wizard_04 = array(
            'hide3' => $this->input->post("hide3"),
            'med1' => $med1,
            'dose1' => $dose1,
            'time1' => $time1,
            'route1' => $route1,
            'taken1_school' => $sheepItForm_school,
            'taken1_home' => $sheepItForm_home,
            'hide4' => $this->input->post("hide4"),
            'prnmed1' => $prnmed1,
            'prndose1' => $prndose1,
            'prntime1' => $prntime1,
            'prnroute1' => $prnroute1,
            'prntaken1_school' => $sheepItForm1_school,
            'prntaken1_home' => $sheepItForm1_home,
            'prntaken1_emergency' => $sheepItForm1_emerg
        );


//        echo "<pre>";
//        print_r($wizard_04);
//        echo "</pre>";
//        exit;
        $array2json = json_encode($wizard_04);
        // create form session wizard04
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz04_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        // check if save & exit was submitted
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz04_" . $data['sif_num']);
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz04_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }

        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz04_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz04_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz04_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz04_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz04_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz04_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment4']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz04_" . $data['sif_num']);
        }

        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }

            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_05'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "copy"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_06/copy");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_06");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_06");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_05";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_04/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_06() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        //Treatments
        $treatment1 = $_POST['sheepItForm1_treatment'];
        $frequency1 = $_POST['sheepItForm1_frequency'];
        $person1 = $_POST['sheepItForm1_person'];
        $sheepItForm1_performed_school = array();
        for ($i = 0; $i < count($treatment1); $i++) {
            $sheepItForm1_performed_school[] = $_POST['sheepItForm1_' . $i . '_performed_school'];
        }
        //Alergies
        $allergy1 = $_POST['sheepItForm_allergy'];
        $reaction1 = $_POST['sheepItForm_reaction'];
//        $ah1 = $_POST['sheepItForm_ah'];
        $addtnlcomments1 = $_POST['sheepItForm_addtnlcomments'];
        $lastevent1 = $_POST['sheepItForm_lastevent'];
        //Intiliaize the Array values
        $sheepItForm_deadly = array();
        $sheepItForm_diagnosed = array();
        $sheepItForm_touch = array();
        $sheepItForm_ingest = array();
        $sheepItForm_air = array();
        $sheepItForm_epi = array();
        $sheepItForm_antihistamine = array();
        for ($i = 0; $i < count($allergy1); $i++) {
            $sheepItForm_deadly[] = $_POST['sheepItForm_' . $i . '_deadly'];
            $sheepItForm_diagnosed[] = $_POST['sheepItForm_' . $i . '_diagnosed'];
            $sheepItForm_touch[] = $_POST['sheepItForm_' . $i . '_touch'];
            $sheepItForm_ingest[] = $_POST['sheepItForm_' . $i . '_ingest'];
            $sheepItForm_air[] = $_POST['sheepItForm_' . $i . '_air'];
            $sheepItForm_sting[] = $_POST['sheepItForm_' . $i . '_sting'];
            $sheepItForm_epi[] = $_POST['sheepItForm_' . $i . '_epi'];
            $sheepItForm_antihistamine[] = $_POST['sheepItForm_' . $i . '_antihistamine'];
        }
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {

            $wizard06 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz06_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            //For copy appraisal form
            if (empty($wizard06)):
                $wizard06 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz06_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
        }

        $obj = json_decode($wizard01);

        if (!empty($wizard06)) {
            $data["wiz_06"] = json_decode($wizard06);

            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard06 = (object) array(
                        'hide7' => "",
                        'need_type_verbal' => "",
                        'need_type_nonverbal' => "",
                        'need_type_speech' => "",
                        'need_type_audiology' => "",
                        'need_type_vision' => "",
                        'need_type_signs' => "",
                        'need_type_expressions' => "",
                        'need_type_cries' => "",
                        'need_type_pictures' => "",
                        'need_type_nocommunication' => "",
                        'devices' => "",
                        'device_describe' => "",
                        'devicelist_glasses' => "",
                        'devicelist_hearingaid' => "",
                        'devicelist_cochlear' => "",
                        'devicelist_fm' => "",
                        'hearing_screening' => "",
                        'vision_screening' => "",
                        'communication_comments' => "",
                        'hide8' => "",
                        'seizures' => "",
                        'seizure_type' => "",
                        'last_seizure_exam' => "",
                        'onset_age' => "",
                        'shunt' => "",
                        'shunt_type' => "",
                        'shunt_placement' => "",
                        'last_revision' => "",
                        'last_seizure' => "",
                        'usual_duration' => "",
                        'seizure_frequency' => "",
                        'status_epilecticus' => "",
                        'triggers' => "",
                        'ketogenic' => "",
                        'treatment_diastat' => "",
                        'treatment_oxygen' => "",
                        'treatment_vagal' => "",
                        'treatment_medication' => "",
                        'post_seizure' => "",
                        'aura' => "",
                        'aura_description' => "",
                        'seizure_comments' => ""
            );
            $data["wiz_06"] = $wizard06;
        }
        //Section values pass if checked
        if (!empty($_POST['hide502'])):
            $treatment1 = "";
            $frequency1 = "";
            $sheepItForm1_performed_school = "";
            $person1 = "";
        endif;
        if (!empty($_POST['hide6'])):
            $allergy1 = "";
            $reaction1 = "";
            $sheepItForm_deadly = "";
            $sheepItForm_touch = "";
            $sheepItForm_ingest = "";
            $sheepItForm_air = "";
            $sheepItForm_sting = "";
            $sheepItForm_epi = "";
            $sheepItForm_antihistamine = "";
            $ah1 = "";
            $sheepItForm_diagnosed = "";
            $lastevent1 = "";
            $addtnlcomments1 = "";
        endif;
        //Posting the value of wizard 5
        $wizard_05 = array(
            'hide502' => $this->input->post("hide502"),
            'treatment1' => $treatment1,
            'frequency1' => $frequency1,
            'performed_school1' => $sheepItForm1_performed_school,
            'person1' => $person1,
            'hide6' => $this->input->post("hide6"),
            'allergy1' => $allergy1,
            'reaction1' => $reaction1,
            'deadly1' => $sheepItForm_deadly,
            'sensitivity1_touch' => $sheepItForm_touch,
            'sensitivity1_ingest' => $sheepItForm_ingest,
            'sensitivity1_air' => $sheepItForm_air,
            'sensitivity1_sting' => $sheepItForm_sting,
            'treatment1_epi' => $sheepItForm_epi,
            'treatment1_antihistamine' => $sheepItForm_antihistamine,
            'ah1' => $ah1,
            'diagnosed1' => $sheepItForm_diagnosed,
            'lastevent1' => $lastevent1,
            'addtnlcomments1' => $addtnlcomments1
        );
        $array2json = json_encode($wizard_05);
        // create form session wizard05
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz05_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        // check if save & exit was submitted
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz05_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz05_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz05_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz05_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz05_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz05_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz05_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz05_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment5']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz05_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_06'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "copy"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_07/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_07");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_07");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_06";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_05/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_07() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }

        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
//        echo $wizardData->unique_number;
//        exit;
        if (!empty($wizardData)) {
            $wizard07 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz07_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
        }

        $obj = json_decode($wizard01);
        if (!empty($wizard07)) {
            $data["wiz_07"] = json_decode($wizard07);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard07 = (object) array(
                        'hide9' => "",
                        'elimination_independent' => "",
                        'elimination_scheduled' => "",
                        'elimination_prompted' => "",
                        'elimination_diapered' => "",
                        'continence_continent' => "",
                        'continence_incontinent_bowel' => "",
                        'continence_incontinent_bladder' => "",
                        'toilet' => "",
                        'other_toilet' => "",
                        'toileted' => "",
                        'toileted_student' => "",
                        'regime' => "",
                        'constipation' => "",
                        'constipation_mgmnt' => "",
                        'colostomy' => "",
                        'colostomy_mgmnt' => "",
                        'bladder' => "",
                        'bladder_mgmnt' => "",
                        'catheter' => "",
                        'self_catheter' => "",
                        'cath_size' => "",
                        'cath_freq' => "",
                        'menstruation' => "",
                        'menstruation_mgmt' => "",
                        'stoma' => "",
                        'diabetic' => "",
                        'br_privileges' => "",
                        'elimination_addtnl' => ""
            );
            $data["wiz_07"] = $wizard07;
        }
        //Section values pass if checked
        if (!empty($_POST['hide7'])):
            $_POST['need_type_verbal'] = "";
            $_POST['need_type_nonverbal'] = "";
            $_POST['dentalhistory'] = "";
            $_POST['need_type_speech'] = "";
            $_POST['need_type_audiology'] = "";
            $_POST['need_type_vision'] = "";
            $_POST['need_type_signs'] = "";
            $_POST['need_type_expressions'] = "";
            $_POST['need_type_cries'] = "";
            $_POST['need_type_pictures'] = "";
            $_POST['need_type_nocommunication'] = "";
            $_POST['devices'] = "";
            $_POST['device_describe'] = "";
            $_POST['devicelist_glasses'] = "";
            $_POST['devicelist_hearingaid'] = "";
            $_POST['devicelist_cochlear'] = "";
            $_POST['devicelist_fm'] = "";
            $_POST['hearing_screening'] = "";
            $_POST['vision_screening'] = "";
            $_POST['communication_comments'] = "";
        endif;

        if (!empty($_POST['hide8'])):
            $_POST['seizures'] = "";
            $_POST['seizure_type'] = "";
            $_POST['last_seizure_exam'] = "";
            $_POST['onset_age'] = "";
            $_POST['shunt'] = "";
            $_POST['shunt_type'] = "";
            $_POST['shunt_placement'] = "";
            $_POST['last_revision'] = "";
            $_POST['last_seizure'] = "";
            $_POST['usual_duration'] = "";
            $_POST['seizure_frequency'] = "";
            $_POST['status_epilecticus'] = "";
            $_POST['triggers'] = "";
            $_POST['ketogenic'] = "";
            $_POST['treatment_diastat'] = "";
            $_POST['treatment_oxygen'] = "";
            $_POST['treatment_vagal'] = "";
            $_POST['treatment_medication'] = "";
            $_POST['aura'] = "";
            $_POST['post_seizure'] = "";
            $_POST['aura_description'] = "";
            $_POST['seizure_comments'] = "";
        endif;

        //Posting the data of wizard 63
        $wizard_06 = array(
            'hide7' => $this->input->post("hide7"),
            'need_type_verbal' => $this->input->post("need_type_verbal"),
            'need_type_nonverbal' => $this->input->post("need_type_nonverbal"),
            'need_type_speech' => $this->input->post("need_type_speech"),
            'need_type_audiology' => $this->input->post("need_type_audiology"),
            'need_type_vision' => $this->input->post("need_type_vision"),
            'need_type_signs' => $this->input->post("need_type_signs"),
            'need_type_expressions' => $this->input->post("need_type_expressions"),
            'need_type_cries' => $this->input->post("need_type_cries"),
            'need_type_pictures' => $this->input->post("need_type_pictures"),
            'need_type_nocommunication' => $this->input->post("need_type_nocommunication"),
            'devices' => $this->input->post("devices"),
            'device_describe' => $this->input->post("device_describe"),
            'devicelist_glasses' => $this->input->post("devicelist_glasses"),
            'devicelist_hearingaid' => $this->input->post("devicelist_hearingaid"),
            'devicelist_cochlear' => $this->input->post("devicelist_cochlear"),
            'devicelist_fm' => $this->input->post("devicelist_fm"),
            'hearing_screening' => $this->input->post("hearing_screening"),
            'vision_screening' => $this->input->post("vision_screening"),
            'communication_comments' => $this->input->post("communication_comments"),
            'hide8' => $this->input->post("hide8"),
            'seizures' => $this->input->post("seizures"),
            'seizure_type' => $this->input->post("seizure_type"),
            'last_seizure_exam' => $this->input->post("last_seizure_exam"),
            'onset_age' => $this->input->post("onset_age"),
            'shunt' => $this->input->post("shunt"),
            'shunt_type' => $this->input->post("shunt_type"),
            'shunt_placement' => $this->input->post("shunt_placement"),
            'last_revision' => $this->input->post("last_revision"),
            'last_seizure' => $this->input->post("last_seizure"),
            'usual_duration' => $this->input->post("usual_duration"),
            'seizure_frequency' => $this->input->post("seizure_frequency"),
            'status_epilecticus' => $this->input->post("status_epilecticus"),
            'triggers' => $this->input->post("triggers"),
            'ketogenic' => $this->input->post("ketogenic"),
            'treatment_diastat' => $this->input->post("treatment_diastat"),
            'treatment_oxygen' => $this->input->post("treatment_oxygen"),
            'treatment_vagal' => $this->input->post("treatment_vagal"),
            'treatment_medication' => $this->input->post("treatment_medication"),
            'post_seizure' => $this->input->post("post_seizure"),
            'aura' => $this->input->post("aura"),
            'aura_description' => $this->input->post("aura_description"),
            'seizure_comments' => $this->input->post("seizure_comments")
        );

        $array2json = json_encode($wizard_06);
        // create form session wizard06
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz06_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);

            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz06_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            // after posting data, redirect to logout
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz06_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz06_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz06_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz06_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz06_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz06_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz06_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment6']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz06_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_07'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_08/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_08");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_08");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        exit;
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_07";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_06/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_08() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard08 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz08_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard08)) {
            $data["wiz_08"] = json_decode($wizard08);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard08 = (object) array(
                        'hide10' => "",
                        'cardiac_history' => trim(""),
                        'restrictions' => "",
                        'restrict_list' => "",
                        'baseline' => "",
                        'distress_pain' => "",
                        'distress_breath' => "",
                        'distress_palpitations' => "",
                        'distress_diaphoresis' => "",
                        'distress_fatigue' => "",
                        'distress_dyspnea' => "",
                        'distress_fainting' => "",
                        'distress_other' => "",
                        'symptom_other' => "",
                        'pacemaker' => "",
                        'defib' => "",
                        'aed' => "",
                        'skin_color_normal' => "",
                        'skin_color_cyanosis' => "",
                        'skin_color_jaundice' => "",
                        'skin_color_pallor' => "",
                        'skin_color_erythema' => "",
                        'skin_color_other' => "",
                        'skin_color_comment' => trim(""),
                        'cardiac_addtnl' => ""
            );
            $data["wiz_08"] = $wizard08;
        }
        if (empty($_POST['hide9'])):
            //Posting the the value of wizard 7
            $wizard_07 = array(
                'hide9' => $this->input->post("hide9"),
                'elimination_independent' => $this->input->post("elimination_independent"),
                'elimination_scheduled' => $this->input->post("elimination_scheduled"),
                'elimination_prompted' => $this->input->post("elimination_prompted"),
                'elimination_diapered' => $this->input->post("elimination_diapered"),
                'continence_continent' => $this->input->post("continence_continent"),
                'continence_incontinent_bowel' => $this->input->post("continence_incontinent_bowel"),
                'continence_incontinent_bladder' => $this->input->post("continence_incontinent_bladder"),
                'toilet' => $this->input->post("toilet"),
                'other_toilet' => $this->input->post("other_toilet"),
                'toileted' => $this->input->post("toileted"),
                'toileted_student' => $this->input->post("toileted_student"),
                'regime' => $this->input->post("regime"),
                'constipation' => $this->input->post("constipation"),
                'constipation_mgmnt' => $this->input->post("constipation_mgmnt"),
                'colostomy' => $this->input->post("colostomy"),
                'colostomy_mgmnt' => $this->input->post("colostomy_mgmnt"),
                'bladder' => $this->input->post("bladder"),
                'bladder_mgmnt' => $this->input->post("bladder_mgmnt"),
                'catheter' => $this->input->post("catheter"),
                'self_catheter' => $this->input->post("self_catheter"),
                'cath_size' => $this->input->post("cath_size"),
                'cath_freq' => $this->input->post("cath_freq"),
                'menstruation' => $this->input->post("menstruation"),
                'menstruation_mgmt' => $this->input->post("menstruation_mgmt"),
                'stoma' => $this->input->post("stoma"),
                'diabetic' => $this->input->post("diabetic"),
                'br_privileges' => $this->input->post("br_privileges"),
                'elimination_addtnl' => $this->input->post("elimination_addtnl")
            );
        else:
            $wizard_07 = array();
        endif;
        $array2json = json_encode($wizard_07);
        // create form session wizard07
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz07_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz07_" . $data['sif_num']); //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            // after posting data, redirect to logout
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz07_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz07_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz07_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz07_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz07_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz07_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz07_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment7']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz07_" . $data['sif_num']);
        }

        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_08'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_09/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_09");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_09");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_08";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_07/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_09() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard09 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz09_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard09)) {
            $data["wiz_09"] = json_decode($wizard09);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard09 = (object) array(
                        'hide11' => "",
                        'asthma' => "",
                        'other_diagnosis' => "",
                        'diagnosis_age' => "",
                        'last_year' => "",
                        'meds_last_year' => "",
                        'doctor_last_year' => "",
                        'ed_last_year' => "",
                        'num_ed_visits' => "",
                        'triggers_smoke' => "",
                        'triggers_animals' => "",
                        'triggers_dust' => "",
                        'triggers_colds' => "",
                        'triggers_weather' => "",
                        'triggers_exercise' => "",
                        'triggers_mold' => "",
                        'triggers_grass' => "",
                        'triggers_perfumes' => "",
                        'triggers_stress' => "",
                        'triggers_food' => "",
                        'triggers_other' => "",
                        'other_trigger' => "",
                        'usual_symptoms_wheezing' => "",
                        'usual_symptoms_breath' => "",
                        'usual_symptoms_breathing' => "",
                        'usual_symptoms_throat' => "",
                        'usual_symptoms_cough' => "",
                        'usual_symptoms_chest' => "",
                        'usual_symptoms_irritability' => "",
                        'usual_symptoms_waking' => "",
                        'usual_symptoms_stomachache' => "",
                        'usual_symptoms_other' => "",
                        'other_usual_symptoms' => "",
                        'day_symptoms' => "",
                        'night_symptoms' => "",
                        'season_fall' => "",
                        'season_winter' => "",
                        'season_spring' => "",
                        'season_summer' => "",
                        'pe' => "",
                        'pe_explain' => ""
            );
            $data["wiz_09"] = $wizard09;
        }
        if (empty($_POST['hide10'])):
            $wizard_08 = array(
                'hide10' => $this->input->post("hide10"),
                'cardiac_history' => trim($this->input->post("cardiac_history")),
                'restrictions' => $this->input->post("restrictions"),
                'restrict_list' => $this->input->post("restrict_list"),
                'baseline' => $this->input->post("baseline"),
                'distress_pain' => $this->input->post("distress_pain"),
                'distress_breath' => $this->input->post("distress_breath"),
                'distress_palpitations' => $this->input->post("distress_palpitations"),
                'distress_diaphoresis' => $this->input->post("distress_diaphoresis"),
                'distress_fatigue' => $this->input->post("distress_fatigue"),
                'distress_dyspnea' => $this->input->post("distress_dyspnea"),
                'distress_fainting' => $this->input->post("distress_fainting"),
                'distress_other' => $this->input->post("distress_other"),
                'symptom_other' => $this->input->post("symptom_other"),
                'pacemaker' => $this->input->post("pacemaker"),
                'defib' => $this->input->post("defib"),
                'aed' => $this->input->post("aed"),
                'skin_color_normal' => $this->input->post("skin_color_normal"),
                'skin_color_cyanosis' => $this->input->post("skin_color_cyanosis"),
                'skin_color_jaundice' => $this->input->post("skin_color_jaundice"),
                'skin_color_pallor' => $this->input->post("skin_color_pallor"),
                'skin_color_erythema' => $this->input->post("skin_color_erythema"),
                'skin_color_other' => $this->input->post("skin_color_other"),
                'skin_color_comment' => trim($this->input->post("skin_color_comment")),
                'cardiac_addtnl' => $this->input->post("cardiac_addtnl")
            );
        else:
            $wizard_08 = array();
        endif;
        $array2json = json_encode($wizard_08);
        // create form session wizard08
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz08_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            //print "about to save and exit"; exit;
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz08_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }

            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz08_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz08_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz08_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz08_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz08_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz08_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz08_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment8']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz08_" . $data['sif_num']);
        }

        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_09'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_10/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_10");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_10");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_09";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_08/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_10() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;

        if (!empty($wizardData)) {
            $wizard10 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz10_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard10)) {
            $data["wiz_10"] = json_decode($wizard10);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard10 = (object) array(
                        'miss_school' => "",
                        'missed_times' => "",
                        'med_delivery' => "",
                        'med_freq' => "",
                        'student_admin' => "",
                        'self_mdi' => "",
                        'mdi' => "",
                        'spacer' => "",
                        'spacer_type' => "",
                        'peak' => "",
                        'peak_best' => "",
                        'pulm_vest' => "",
                        'vest_freq' => "",
                        'chest_pt' => "",
                        'chest_pt_freq' => "",
                        'standard' => "",
                        'action' => "",
                        'ihp' => "",
                        'ed_asthma' => "",
                        'num_visits' => "",
                        'resp_addtnl' => ""
            );
            $data["wiz_10"] = $wizard10;
        }
        if (empty($_POST['hide11'])):
            $wizard_09 = array(
                'hide11' => $this->input->post("hide11"),
                'asthma' => $this->input->post("asthma"),
                'other_diagnosis' => $this->input->post("other_diagnosis"),
                'diagnosis_age' => $this->input->post("diagnosis_age"),
                'last_year' => $this->input->post("last_year"),
                'meds_last_year' => $this->input->post("meds_last_year"),
                'doctor_last_year' => $this->input->post("doctor_last_year"),
                'ed_last_year' => $this->input->post("ed_last_year"),
                'num_ed_visits' => $this->input->post("num_ed_visits"),
                'triggers_smoke' => $this->input->post("triggers_smoke"),
                'triggers_animals' => $this->input->post("triggers_animals"),
                'triggers_dust' => $this->input->post("triggers_dust"),
                'triggers_colds' => $this->input->post("triggers_colds"),
                'triggers_weather' => $this->input->post("triggers_weather"),
                'triggers_exercise' => $this->input->post("triggers_exercise"),
                'triggers_mold' => $this->input->post("triggers_mold"),
                'triggers_grass' => $this->input->post("triggers_grass"),
                'triggers_perfumes' => $this->input->post("triggers_perfumes"),
                'triggers_stress' => $this->input->post("triggers_stress"),
                'triggers_food' => $this->input->post("triggers_food"),
                'triggers_other' => $this->input->post("triggers_other"),
                'other_trigger' => $this->input->post("other_trigger"),
                'usual_symptoms_wheezing' => $this->input->post("usual_symptoms_wheezing"),
                'usual_symptoms_breath' => $this->input->post("usual_symptoms_breath"),
                'usual_symptoms_breathing' => $this->input->post("usual_symptoms_breathing"),
                'usual_symptoms_throat' => $this->input->post("usual_symptoms_throat"),
                'usual_symptoms_cough' => $this->input->post("usual_symptoms_cough"),
                'usual_symptoms_chest' => $this->input->post("usual_symptoms_chest"),
                'usual_symptoms_irritability' => $this->input->post("usual_symptoms_irritability"),
                'usual_symptoms_waking' => $this->input->post("usual_symptoms_waking"),
                'usual_symptoms_stomachache' => $this->input->post("usual_symptoms_stomachache"),
                'usual_symptoms_other' => $this->input->post("usual_symptoms_other"),
                'other_usual_symptoms' => $this->input->post("other_usual_symptoms"),
                'day_symptoms' => $this->input->post("day_symptoms"),
                'night_symptoms' => $this->input->post("night_symptoms"),
                'season_fall' => $this->input->post("season_fall"),
                'season_winter' => $this->input->post("season_winter"),
                'season_spring' => $this->input->post("season_spring"),
                'season_summer' => $this->input->post("season_summer"),
                'pe' => $this->input->post("pe"),
                'pe_explain' => $this->input->post("pe_explain"),
                'miss_school' => $this->input->post("miss_school"),
                'missed_times' => $this->input->post("missed_times"),
                'med_delivery' => $this->input->post("med_delivery"),
                'med_freq' => $this->input->post("med_freq"),
                'student_admin' => $this->input->post("student_admin"),
                'self_mdi' => $this->input->post("self_mdi"),
                'mdi' => $this->input->post("mdi"),
                'spacer' => $this->input->post("spacer"),
                'spacer_type' => $this->input->post("spacer_type"),
                'peak' => $this->input->post("peak"),
                'peak_best' => $this->input->post("peak_best"),
                'pulm_vest' => $this->input->post("pulm_vest"),
                'vest_freq' => $this->input->post("vest_freq"),
                'chest_pt' => $this->input->post("chest_pt"),
                'chest_pt_freq' => $this->input->post("chest_pt_freq"),
                'standard' => $this->input->post("standard"),
                'action' => $this->input->post("action"),
                'ihp' => $this->input->post("ihp"),
                'ed_asthma' => $this->input->post("ed_asthma"),
                'num_visits' => $this->input->post("num_visits"),
                'resp_addtnl' => $this->input->post("resp_addtnl")
            );
        else:
            $wizard_09 = array();
        endif;
        $array2json = json_encode($wizard_09);
        // create form session wizard09
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz09_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz09_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz09_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }


        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz09_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz09_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz09_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz09_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz09_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz09_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment9']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz09_" . $data['sif_num']);
            if (!empty($copy) && $copy == "clear"):
                $path = base_url() . 'nurse_assessment/assessment/wizard_11/clear';
            else:
                $path = base_url() . 'nurse_assessment/assessment/wizard_11';
            endif;
            redirect($path);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_10'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_11/copy");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_11");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_11");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_11";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_09/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_11() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;

        if (!empty($wizardData)) {
            $wizard11 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz11_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }

        $obj = json_decode($wizard01);

        if (!empty($wizard11)) {
            $data["wiz_11"] = json_decode($wizard11);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard11 = (object) array(
                        'resp_assess_continuous' => "",
                        'resp_assess_intermittant' => "",
                        'resp_assess_signal' => "",
                        'baseline_assess' => "",
                        'distress_sign' => "",
                        'ventilation' => "",
                        'where_home' => "",
                        'where_school' => "",
                        'where_sleep' => "",
                        'where_as_needed' => "",
                        'vent_depend_dependent' => "",
                        'vent_depend_assist' => "",
                        'vent_assist' => "",
                        'vent_set' => "",
                        'vent_contact' => "",
                        'vent_co' => "",
                        'oxygen_cont' => "",
                        'oxygen_inter' => "",
                        'oximetry' => "",
                        'ox_freq' => "",
                        'ox_param' => "",
                        'ox_route_nasal' => "",
                        'ox_route_trach' => "",
                        'ox_route_mask' => "",
                        'ox_source_tank' => "",
                        'ox_source_liquid' => "",
                        'ox_source_concentrator' => "",
                        'trach_size' => "",
                        'cuffed' => "",
                        'thermo' => "",
                        'muir' => "",
                        'co2' => "",
                        'co2_freq' => "",
                        'co2_param' => "",
                        'addtnl_vent' => "",
                        'suction' => "",
                        'suction_drain' => "",
                        'trach_type_o' => "",
                        'trach_type_n' => "",
                        'trach_type_e' => "",
                        'cath_y' => "",
                        'cath_f' => "",
                        'cath_size' => "",
                        'cath_freq' => "",
                        'cath_color' => "",
                        'suction_equip' => "",
                        'other_equip' => "",
                        'equip_check' => "",
                        'evac' => "",
                        'oxy_addtnl' => "",
            );
            $data["wiz_11"] = $wizard11;
        }

        $wizard_10 = array(
            'miss_school' => $this->input->post("miss_school"),
            'missed_times' => $this->input->post("missed_times"),
            'med_delivery' => $this->input->post("med_delivery"),
            'med_freq' => $this->input->post("med_freq"),
            'student_admin' => $this->input->post("student_admin"),
            'self_mdi' => $this->input->post("self_mdi"),
            'mdi' => $this->input->post("mdi"),
            'spacer' => $this->input->post("spacer"),
            'spacer_type' => $this->input->post("spacer_type"),
            'peak' => $this->input->post("peak"),
            'peak_best' => $this->input->post("peak_best"),
            'pulm_vest' => $this->input->post("pulm_vest"),
            'vest_freq' => $this->input->post("vest_freq"),
            'chest_pt' => $this->input->post("chest_pt"),
            'chest_pt_freq' => $this->input->post("chest_pt_freq"),
            'standard' => $this->input->post("standard"),
            'action' => $this->input->post("action"),
            'ihp' => $this->input->post("ihp"),
            'ed_asthma' => $this->input->post("ed_asthma"),
            'num_visits' => $this->input->post("num_visits"),
            'resp_addtnl' => $this->input->post("resp_addtnl")
        );
        $array2json = json_encode($wizard_10);
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz10_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            //print "about to save and exit"; exit;
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz10_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }

            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz10_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);

            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }

        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz10_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz10_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz10_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz10_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz10_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz10_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment10']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz10_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }

            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";

            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);

            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_11'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_12/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_12");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_12");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_11";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_09/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_12() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard12 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz12_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard12)) {
            $data["wiz_12"] = json_decode($wizard12);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard12 = (object) array(
                        'hide122' => "",
                        'mobility_amb' => "",
                        'mobility_ind' => "",
                        'mobility_ns' => "",
                        'mobility_uw' => "",
                        'mobility_gt' => "",
                        'mobility_wheel' => "",
                        'wc_mi' => "",
                        'wc_ma' => "",
                        'wc_pi' => "",
                        'wc_pa' => "",
                        'wc_so' => "",
                        'sc' => "",
                        'equip_provider' => "",
                        'c_info' => "",
                        'scoliosis' => "",
                        'sco_last' => "",
                        'sco_treat' => "",
                        'hip' => "",
                        'hip_last' => "",
                        'hip_treat' => "",
                        'pt' => "",
                        'pt_where' => "",
                        'mobi_text' => "",
                        'orth' => "",
                        'splint_hand' => "",
                        'splint_ankle' => "",
                        'splint_knee' => "",
                        'splint_leg' => "",
                        'lift_one' => "",
                        'lift_two' => "",
                        'lift_hoyer' => "",
                        'pos_plan' => "",
                        'pos_plan_desc' => "",
                        'mobi_addtnl' => ""
            );
            $data["wiz_12"] = $wizard12;
        }
        if (empty($_POST['hide122'])):
            $wizard_11 = array(
                'hide122' => $this->input->post("hide122"),
                'resp_assess_continuous' => $this->input->post("resp_assess_continuous"),
                'resp_assess_intermittant' => $this->input->post("resp_assess_intermittant"),
                'resp_assess_signal' => $this->input->post("resp_assess_signal"),
                'baseline_assess' => $this->input->post("baseline_assess"),
                'distress_sign' => $this->input->post("distress_sign"),
                'ventilation' => $this->input->post("ventilation"),
                'where_home' => $this->input->post("where_home"),
                'where_school' => $this->input->post("where_school"),
                'where_sleep' => $this->input->post("where_sleep"),
                'where_as_needed' => $this->input->post("where_as_needed"),
                'vent_depend_dependent' => $this->input->post("vent_depend_dependent"),
                'vent_depend_assist' => $this->input->post("vent_depend_assist"),
                'vent_assist' => $this->input->post("vent_assist"),
                'vent_set' => $this->input->post("vent_set"),
                'vent_contact' => $this->input->post("vent_contact"),
                'vent_co' => $this->input->post("vent_co"),
                'oxygen_cont' => $this->input->post("oxygen_cont"),
                'oxygen_inter' => $this->input->post("oxygen_inter"),
                'oximetry' => $this->input->post("oximetry"),
                'ox_freq' => $this->input->post("ox_freq"),
                'ox_param' => $this->input->post("ox_param"),
                'ox_route_nasal' => $this->input->post("ox_route_nasal"),
                'ox_route_trach' => $this->input->post("ox_route_trach"),
                'ox_route_mask' => $this->input->post("ox_route_mask"),
                'ox_source_tank' => $this->input->post("ox_source_tank"),
                'ox_source_liquid' => $this->input->post("ox_source_liquid"),
                'ox_source_concentrator' => $this->input->post("ox_source_concentrator"),
                'trach_size' => $this->input->post("trach_size"),
                'cuffed' => $this->input->post("cuffed"),
                'thermo' => $this->input->post("thermo"),
                'muir' => $this->input->post("muir"),
                'co2' => $this->input->post("co2"),
                'co2_freq' => $this->input->post("co2_freq"),
                'co2_param' => $this->input->post("co2_param"),
                'addtnl_vent' => $this->input->post("addtnl_vent"),
                'suction' => $this->input->post("suction"),
                'suction_drain' => $this->input->post("suction_drain"),
                'trach_type_o' => $this->input->post("trach_type_o"),
                'trach_type_n' => $this->input->post("trach_type_n"),
                'trach_type_e' => $this->input->post("trach_type_e"),
                'cath_y' => $this->input->post("cath_y"),
                'cath_f' => $this->input->post("cath_f"),
                'cath_y2' => $this->input->post("cath_y2"),
                'cath_f2' => $this->input->post("cath_f2"),
                'cath_y3' => $this->input->post("cath_y3"),
                'cath_f3' => $this->input->post("cath_f3"),
                'cath_size' => $this->input->post("cath_size"),
                'cath_freq' => $this->input->post("cath_freq"),
                'cath_color' => $this->input->post("cath_color"),
                'suction_equip' => $this->input->post("suction_equip"),
                'other_equip' => $this->input->post("other_equip"),
                'equip_check' => $this->input->post("equip_check"),
                'cath_size2' => $this->input->post("cath_size2"),
                'cath_freq2' => $this->input->post("cath_freq2"),
                'cath_color2' => $this->input->post("cath_color2"),
                'suction_equip2' => $this->input->post("suction_equip2"),
                'other_equip2' => $this->input->post("other_equip2"),
                'equip_check2' => $this->input->post("equip_check2"),
                'cath_size3' => $this->input->post("cath_size3"),
                'cath_freq3' => $this->input->post("cath_freq3"),
                'cath_color3' => $this->input->post("cath_color3"),
                'suction_equip3' => $this->input->post("suction_equip3"),
                'other_equip3' => $this->input->post("other_equip3"),
                'equip_check3' => $this->input->post("equip_check3"),
                'evac' => $this->input->post("evac"),
                'oxy_addtnl' => $this->input->post("oxy_addtnl")
            );
        else:
            $wizard_11 = array();
        endif;
        $array2json = json_encode($wizard_11);
        // create form session wizard10
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz11_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz11_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }

            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz11_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }

        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz11_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz11_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz11_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz11_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz11_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz11_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment11']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz11_" . $data['sif_num']);
        }

        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";

            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_12'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear"):
            $data["action"] = site_url("nurse_assessment/assessment/wizard_13/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_13");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_13");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_12";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_11/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_13() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard13 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz13_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard13)) {
            $data["wiz_13"] = json_decode($wizard13);

            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard13 = (object) array(
                        'hide14' => "",
                        'diet' => $this->input->post("diet"),
                        'food_texture' => "",
                        'prepare_parent' => "",
                        'prepare_school' => "",
                        'food_restriction' => "",
                        'fluid_restriction' => "",
                        'feeding_assist' => "",
                        'feeding_type_total' => "",
                        'feeding_type_assess' => "",
                        'feeding_type_open' => "",
                        'feeding_type_cutting' => "",
                        'feeding_tubeval' => "",
                        'feeding_tube_mic' => "",
                        'feeding_tube_peg' => "",
                        'feeding_tube_jtube' => "",
                        'feeding_tube_ng' => "",
                        'feeding_tube_gj' => "",
                        'gtube_size' => "",
                        'tube_type' => "",
                        'inst_dislodged' => "",
                        'tube_feedings_bolus' => "",
                        'tube_feedings_pump' => "",
                        'feed_freq' => "",
                        'water_flush' => "",
                        'free_water' => "",
                        'fundo' => "",
                        'swallow_vfss' => "",
                        'swallow_endo' => "",
                        'swallow_study_date' => "",
                        'swallow_study_loc' => "",
                        'reflux' => "",
                        'reflux_tx' => "",
                        'ordering_doc' => "",
                        'clinic' => "",
                        'clinic_details' => "",
                        'smart_team' => "",
                        'smart_manager' => "",
                        'meal_care' => "",
                        'nutr_comments' => ""
            );
            $data["wiz_13"] = $wizard13;
        }
        if (empty($_POST['hide13'])):
            $wizard_12 = array(
                'hide13' => $this->input->post("hide13"),
                'mobility_amb' => $this->input->post("mobility_amb"),
                'mobility_ind' => $this->input->post("mobility_ind"),
                'mobility_ns' => $this->input->post("mobility_ns"),
                'mobility_uw' => $this->input->post("mobility_uw"),
                'mobility_gt' => $this->input->post("mobility_gt"),
                'mobility_wheel' => $this->input->post("mobility_wheel"),
                'wc_mi' => $this->input->post("wc_mi"),
                'wc_ma' => $this->input->post("wc_ma"),
                'wc_pi' => $this->input->post("wc_pi"),
                'wc_pa' => $this->input->post("wc_pa"),
                'wc_so' => $this->input->post("wc_so"),
                'sc' => $this->input->post("sc"),
                'equip_provider' => $this->input->post("equip_provider"),
                'c_info' => $this->input->post("c_info"),
                'scoliosis' => $this->input->post("scoliosis"),
                'sco_last' => $this->input->post("sco_last"),
                'sco_treat' => $this->input->post("sco_treat"),
                'hip' => $this->input->post("hip"),
                'orth_desc' => $this->input->post("orth_desc"),
                'hip_last' => $this->input->post("hip_last"),
                'hip_treat' => $this->input->post("hip_treat"),
                'pt' => $this->input->post("pt"),
                'pt_where' => $this->input->post("pt_where"),
                'mobi_text' => $this->input->post("mobi_text"),
                'orth' => $this->input->post("orth"),
                'splint_hand' => $this->input->post("splint_hand"),
                'splint_ankle' => $this->input->post("splint_ankle"),
                'splint_knee' => $this->input->post("splint_knee"),
                'splint_leg' => $this->input->post("splint_leg"),
                'lift_one' => $this->input->post("lift_one"),
                'lift_two' => $this->input->post("lift_two"),
                'lift_hoyer' => $this->input->post("lift_hoyer"),
                'pos_plan' => $this->input->post("pos_plan"),
                'pos_plan_desc' => $this->input->post("pos_plan_desc"),
                'mobi_addtnl' => $this->input->post("mobi_addtnl")
            );
        else:
            $wizard_12 = array();
        endif;
        $array2json = json_encode($wizard_12);
        // create form session wizard12
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz12_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }

        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz12_" . $data ['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data ['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz12_" . $data ['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data ['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }

        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz12_" . $data ['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz12_" . $data ['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data ['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz12_" . $data ['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz12_" . $data ['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data ['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz12_" . $data ['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz12_" . $data ['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data ['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment12']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz12_" . $data ['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_13'] = "";
        }
//URLS
        if (!empty($copy) && $copy == "clear") :
            $data["action"] = site_url("nurse_assessment/assessment/wizard_14/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_14");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_14");
//autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));

// load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_13";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_12/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_14() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
// check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
// parse user details
        $user = $this->user_info();
// let's save the post data
// note, when calling back using the back link, sometimes, we will not have post data available
// in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard14 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz14_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        if (!empty($wizard14)) {
            $data["wiz_14"] = json_decode($wizard14);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard14 = (object) array(
                        'hide15' => "",
                        'gluc_test' => "",
                        'test_when_arrival' => "",
                        'test_when_breakfast' => "",
                        'test_when_blunch' => "",
                        'test_when_alunch' => "",
                        'test_when_bpe' => "",
                        'test_when_ape' => "",
                        'test_when_snack' => "",
                        'test_when_dismissal' => "",
                        'test_when_prn' => "",
                        'test_ind_outhr' => "",
                        'test_ind_inhr' => "",
                        'test_ind_super' => "",
                        'test_ind_assist' => "",
                        'test_ind_dep' => "",
                        'test_assist' => "",
                        'target' => "",
                        'insulin_type' => "",
                        'insulin_type_pump' => "",
                        'insulin_manu' => "",
                        'insulin_school' => "",
                        'type_ins_school' => "",
                        'dose_correct' => "",
                        'dose_standard' => "",
                        'dose_slide' => "",
                        'dose_pump' => "",
                        'before_lunch' => "",
                        'lunch_correction' => "",
                        'insulin_snack' => "",
                        'counts_carbs' => "",
                        'lunch_carb' => "",
                        'snack_carb' => "",
                        'after_lunch_reason' => "",
                        'school_breakfast' => "",
                        'break_carb' => "",
                        'school_glucagon' => "",
                        'glucagon_order' => "",
                        'hypo_treatment' => "",
                        'emer_kit_hr' => "",
                        'emer_kit_class' => "",
                        'emer_kit_carry' => "",
                        'kit_contents_glucose_gel' => "",
                        'kit_contents_glucose_tabs' => "",
                        'kit_contents_juice' => "",
                        'kit_contents_snacks' => "",
                        'emer_snacks' => "",
                        'hyper_treatment' => "",
                        'insulin_key' => "",
                        'insulin_key_order' => "",
                        'discrete' => "",
                        'discretionary_list' => "",
                        'home_insulin_order' => "",
                        'lockdown' => "",
                        'diabetes_additional' => ""
            );
            $data["wiz_14"] = $wizard14;
        }
        if (empty($_POST['hide144'])):
            $wizard_13 = array(
                'hide144' => $this->input->post("hide144"),
                'diet' => $this->input->post("diet"),
                'food_texture' => $this->input->post("food_texture"),
                'prepare_parent' => $this->input->post("prepare_parent"),
                'prepare_school' => $this->input->post("prepare_school"),
                'food_restriction' => $this->input->post("food_restriction"),
                'fluid_restriction' => $this->input->post("fluid_restriction"),
                'feeding_assist' => $this->input->post("feeding_assist"),
                'feeding_type_total' => $this->input->post("feeding_type_total"),
                'feeding_type_assess' => $this->input->post("feeding_type_assess"),
                'feeding_type_open' => $this->input->post("feeding_type_open"),
                'feeding_type_cutting' => $this->input->post("feeding_type_cutting"),
                'feeding_tubeval' => $this->input->post("feeding_tubeval"),
                'feeding_tube_mic' => $this->input->post("feeding_tube_mic"),
                'feeding_tube_peg' => $this->input->post("feeding_tube_peg"),
                'feeding_tube_jtube' => $this->input->post("feeding_tube_jtube"),
                'feeding_tube_ng' => $this->input->post("feeding_tube_ng"),
                'feeding_tube_gj' => $this->input->post("feeding_tube_gj"),
                'gtube_size' => $this->input->post("gtube_size"),
                'tube_type' => $this->input->post("tube_type"),
                'inst_dislodged' => $this->input->post("inst_dislodged"),
                'tube_feedings_bolus' => $this->input->post("tube_feedings_bolus"),
                'tube_feedings_pump' => $this->input->post("tube_feedings_pump"),
                'feed_freq' => $this->input->post("feed_freq"),
                'water_flush' => $this->input->post("water_flush"),
                'free_water' => $this->input->post("free_water"),
                'fundo' => $this->input->post("fundo"),
                'swallow_vfss' => $this->input->post("swallow_vfss"),
                'swallow_endo' => $this->input->post("swallow_endo"),
                'swallow_study_date' => $this->input->post("swallow_study_date"),
                'swallow_study_loc' => $this->input->post("swallow_study_loc"),
                'reflux' => $this->input->post("reflux"),
                'reflux_tx' => $this->input->post("reflux_tx"),
                'ordering_doc' => $this->input->post("ordering_doc"),
                'clinic' => $this->input->post("clinic"),
                'clinic_details' => $this->input->post("clinic_details"),
                'smart_team' => $this->input->post("smart_team"),
                'smart_manager' => $this->input->post("smart_manager"),
                'meal_care' => $this->input->post("meal_care"),
                'nutr_comments' => $this->input->post("nutr_comments")
            );
        else:
            $wizard_13 = array();
        endif;
        $array2json = json_encode($wizard_13);
        // create form session wizard13
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz13_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz13_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            //Change the status against total count of the form
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz13_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz13_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz13_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz13_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz13_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz13_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz13_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment13']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz13_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                $data['assessment_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                $data['assessment_actions'] .= "</ul>";
            }

            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_14'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear") :
            $data["action"] = site_url("nurse_assessment/assessment/wizard_15/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_15");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_15");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_14";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_13/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_15() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();

        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["subtitle"] = "New Nursing Assessment";
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard15 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz15_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $data['sif_num'] = $wizardData->sif;
        }

        $obj = json_decode($wizard01);

        if (!empty($wizard15) && empty($copy)) {
            $data["wiz_15"] = json_decode($wizard15);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard15 = (object) array(
                        'hide16' => "",
                        'trans_method_walker' => "",
                        'trans_method_car' => "",
                        'trans_method_bus' => "",
                        'trans_method_lift' => "",
                        'bus_services_assist' => "",
                        'bus_services_aide' => "",
                        'bus_services_nursing' => "",
                        'bus_services_equip' => "",
                        'bus_meds' => "",
                        'list_bus_meds' => "",
                        'med_bus_selfadmin' => "",
                        'med_bus_selfmed' => "",
                        'med_bus_aideadmin' => "",
                        'bus_snacks' => "",
                        'bus_mod' => "",
                        'bus_mod_list' => "",
                        'trans_comments' => ""
            );
            $data["wiz_15"] = $wizard15;
        }
        //Diabetes Management
        if (!empty($_POST['hide15'])):
            $_POST['gluc_test'] = "";
            $_POST['test_when_arrival'] = "";
            $_POST['test_when_breakfast'] = "";
            $_POST['test_when_blunch'] = "";
            $_POST['test_when_alunch'] = "";
            $_POST['test_when_bpe'] = "";
            $_POST['test_when_ape'] = "";
            $_POST['test_when_snack'] = "";
            $_POST['test_when_dismissal'] = "";
            $_POST['test_when_prn'] = "";
            $_POST['test_when_other'] = "";
            $_POST['othertest'] = "";
            $_POST['test_ind_outhr'] = "";
            $_POST['test_ind_inhr'] = "";
            $_POST['test_ind_super'] = "";
            $_POST['test_ind_assist'] = "";
            $_POST['test_ind_dep'] = "";
            $_POST['test_assist'] = "";
            $_POST['target'] = "";
            $_POST['insulin_type'] = "";
            $_POST['insulin_type_pump'] = "";
            $_POST['insulin_type_syringe'] = "";
            $_POST['insulin_type_pen'] = "";
            $_POST['insulin_type_pod'] = "";
            $_POST['insulin_type_other'] = "";
            $_POST['otherins'] = "";
            $_POST['insulin_manu'] = "";
            $_POST['insulin_school'] = "";
            $_POST['type_ins_school'] = "";
            $_POST['dose_correct'] = "";
            $_POST['dose_standard'] = "";
            $_POST['dose_slide'] = "";
            $_POST['dose_pump'] = "";
            $_POST['before_lunch'] = "";
            $_POST['lunch_correction'] = "";
            $_POST['insulin_snack'] = "";
            $_POST['counts_carbs'] = "";
            $_POST['lunch_carb'] = "";
            $_POST['snack_carb'] = "";
            $_POST['after_lunch_reason'] = "";
            $_POST['school_breakfast'] = "";
            $_POST['break_carb'] = "";
            $_POST['school_glucagon'] = "";
            $_POST['glucagon_order'] = "";
            $_POST['hypo_treatment'] = "";
            $_POST['emer_kit_hr'] = "";
            $_POST['emer_kit_class'] = "";
            $_POST['emer_kit_carry'] = "";
            $_POST['kit_contents_glucose_gel'] = "";
            $_POST['kit_contents_glucose_tabs'] = "";
            $_POST['kit_contents_juice'] = "";
            $_POST['kit_contents_snacks'] = "";
            $_POST['emer_snacks'] = "";
            $_POST['hyper_treatment'] = "";
            $_POST['insulin_key'] = "";
            $_POST['insulin_key_order'] = "";
            $_POST['discrete'] = "";
            $_POST['discretionary_list'] = "";
            $_POST['home_insulin_order'] = "";
            $_POST['lockdowndesc'] = "";
            $_POST['diabetes_additional'] = "";
        endif;
        //Adrenal Insufficiency
        if (!empty($_POST['hide334'])):
            $_POST['ageofdia'] = "";
            $_POST['crisis_ex'] = "";
            $_POST['crisis_date'] = "";
            $_POST['crisis_symptoms'] = "";
            $_POST['hydro'] = "";
            $_POST['solu'] = "";
            $_POST['troher'] = "";
            $_POST['healthroom'] = "";
            $_POST['classroom'] = "";
            $_POST['carried'] = "";
            $_POST['bracelet'] = "";
            $_POST['sickday'] = "";
            $_POST['lockdown'] = "";
            $_POST['addcomments'] = "";
        endif;
        //Other Diagnosis
        if (!empty($_POST['hide335'])):
            $_POST['health_concern'] = "";
            $_POST['timedia'] = "";
            $_POST['od_sym'] = "";
            $_POST['od_often'] = "";
            $_POST['routine'] = "";
            $_POST['od_when'] = "";
            $_POST['od_lvisit'] = "";
            $_POST['or_surg'] = "";
            $_POST['od_times'] = "";
            $_POST['od_times2'] = "";
            $_POST['od_timelast'] = "";

            $_POST['od_desc'] = "";
            $_POST['o_supp'] = "";
            $_POST['o_supp_desc'] = "";
            $_POST['o_cdue'] = "";
            $_POST['o_cdue_desc'] = "";
            $_POST['o_res'] = "";
            $_POST['o_res_desc'] = "";
            $_POST['od_add_info'] = "";
        endif;

        //Educational status
        if (!empty($_POST['hide367'])):
            $_POST['edustatus'] = "";
            $_POST['edustatus2_regular'] = "";
            $_POST['edustatus2_iep'] = "";
            $_POST['edustatus2_504'] = "";
            $_POST['grade'] = "";
            $_POST['othergrade'] = "";
            $_POST['assistant'] = "";
            $_POST['eduservices_occupational'] = "";
            $_POST['eduservices_physical'] = "";
            $_POST['eduservices_speech'] = "";
            $_POST['eduservices_counseling'] = "";
            $_POST['eduservices_pe'] = "";
            $_POST['offlocation_hospital'] = "";
            $_POST['offlocation_home'] = "";
            $_POST['reevaldate'] = "";
            $_POST['assist_tech'] = "";
            $_POST['assist_tech_lt'] = "";
            $_POST['accomodations'] = "";
            $_POST['accomodations_lt'] = "";
        endif;

        //Transportation status
        if (!empty($_POST['hide16'])):
            $_POST['trans_method_walker'] = "";
            $_POST['trans_method_car'] = "";
            $_POST['trans_method_bus'] = "";
            $_POST['trans_method_lift'] = "";
            $_POST['bus_services_assist'] = "";
            $_POST['bus_services_aide'] = "";
            $_POST['bus_services_nursing'] = "";
            $_POST['bus_services_equip'] = "";
            $_POST['bus_meds'] = "";
            $_POST['od_needschool'] = "";
            $_POST['list_bus_meds'] = "";
            $_POST['med_bus_selfadmin'] = "";
            $_POST['med_bus_selfmed'] = "";
            $_POST['med_bus_aideadmin'] = "";
            $_POST['bus_snacks'] = "";
            $_POST['bus_mod'] = "";
            $_POST['bus_mod_list'] = "";
            $_POST['trans_comments'] = "";
            $_POST['trans_field'] = "";
            $_POST['describe_Snacks'] = "";
        endif;


        $wizard_14 = array(
            //Diabetes Management
            'hide15' => $this->input->post("hide15"),
            'gluc_test' => $this->input->post("gluc_test"),
            'test_when_arrival' => $this->input->post("test_when_arrival"),
            'test_when_breakfast' => $this->input->post("test_when_breakfast"),
            'test_when_blunch' => $this->input->post("test_when_blunch"),
            'test_when_alunch' => $this->input->post("test_when_alunch"),
            'test_when_bpe' => $this->input->post("test_when_bpe"),
            'test_when_ape' => $this->input->post("test_when_ape"),
            'test_when_snack' => $this->input->post("test_when_snack"),
            'test_when_dismissal' => $this->input->post("test_when_dismissal"),
            'test_when_prn' => $this->input->post("test_when_prn"),
            'test_when_other' => $this->input->post("test_when_other"),
            'othertest' => $this->input->post("othertest"),
            'test_ind_outhr' => $this->input->post("test_ind_outhr"),
            'test_ind_inhr' => $this->input->post("test_ind_inhr"),
            'test_ind_super' => $this->input->post("test_ind_super"),
            'test_ind_assist' => $this->input->post("test_ind_assist"),
            'test_ind_dep' => $this->input->post("test_ind_dep"),
            'test_assist' => $this->input->post("test_assist"),
            'target' => $this->input->post("target"),
            'insulin_type' => $this->input->post("insulin_type"),
            'insulin_type_pump' => $this->input->post("insulin_type_pump"),
            'insulin_type_syringe' => $this->input->post("insulin_type_syringe"),
            'insulin_type_pen' => $this->input->post("insulin_type_pen"),
            'insulin_type_pod' => $this->input->post("insulin_type_pod"),
            'insulin_type_other' => $this->input->post("insulin_type_other"),
            'otherins' => $this->input->post("otherins"),
            'insulin_manu' => $this->input->post("insulin_manu"),
            'insulin_school' => $this->input->post("insulin_school"),
            'type_ins_school' => $this->input->post("type_ins_school"),
            'dose_correct' => $this->input->post("dose_correct"),
            'dose_standard' => $this->input->post("dose_standard"),
            'dose_slide' => $this->input->post("dose_slide"),
            'dose_pump' => $this->input->post("dose_pump"),
            'before_lunch' => $this->input->post("before_lunch"),
            'lunch_correction' => $this->input->post("lunch_correction"),
            'insulin_snack' => $this->input->post("insulin_snack"),
            'counts_carbs' => $this->input->post("counts_carbs"),
            'lunch_carb' => $this->input->post("lunch_carb"),
            'snack_carb' => $this->input->post("snack_carb"),
            'after_lunch_reason' => $this->input->post("after_lunch_reason"),
            'school_breakfast' => $this->input->post("school_breakfast"),
            'break_carb' => $this->input->post("break_carb"),
            'school_glucagon' => $this->input->post("school_glucagon"),
            'glucagon_order' => $this->input->post("glucagon_order"),
            'hypo_treatment' => $this->input->post("hypo_treatment"),
            'emer_kit_hr' => $this->input->post("emer_kit_hr"),
            'emer_kit_class' => $this->input->post("emer_kit_class"),
            'emer_kit_carry' => $this->input->post("emer_kit_carry"),
            'kit_contents_glucose_gel' => $this->input->post("kit_contents_glucose_gel"),
            'kit_contents_glucose_tabs' => $this->input->post("kit_contents_glucose_tabs"),
            'kit_contents_juice' => $this->input->post("kit_contents_juice"),
            'kit_contents_snacks' => $this->input->post("kit_contents_snacks"),
            'emer_snacks' => $this->input->post("emer_snacks"),
            'hyper_treatment' => $this->input->post("hyper_treatment"),
            'hypergly_treatment' => $this->input->post("hypergly_treatment"),
            'insulin_key' => $this->input->post("insulin_key"),
            'insulin_key_order' => $this->input->post("insulin_key_order"),
            'discrete' => $this->input->post("discrete"),
            'discretionary_list' => $this->input->post("discretionary_list"),
            'home_insulin_order' => $this->input->post("home_insulin_order"),
            'lockdowndesc' => $this->input->post("lockdowndesc"),
            'diabetes_additional' => $this->input->post("diabetes_additional"),
            //Adrenal Insufficiency
            'hide334' => $this->input->post("hide334"),
            'ageofdia' => $this->input->post("ageofdia"),
            'crisis_ex' => $this->input->post("crisis_ex"),
            'crisis_date' => $this->input->post("crisis_date"),
            'crisis_symptoms' => $this->input->post("crisis_symptoms"),
            'hydro' => $this->input->post("hydro"),
            'solu' => $this->input->post("solu"),
            'troher' => $this->input->post("troher"),
            'healthroom' => $this->input->post("healthroom"),
            'classroom' => $this->input->post("classroom"),
            'carried' => $this->input->post("carried"),
            'bracelet' => $this->input->post("bracelet"),
            'sickday' => $this->input->post("sickday"),
            'lockdown' => $this->input->post("lockdown"),
            'addcomments' => $this->input->post("addcomments"),
            //Other Diagnosis
            'hide335' => $this->input->post("hide335"),
            'health_concern' => $this->input->post("health_concern"),
            'timedia' => $this->input->post("timedia"),
            'od_sym' => $this->input->post("od_sym"),
            'od_often' => $this->input->post("od_often"),
            'routine' => $this->input->post("routine"),
            'od_when' => $this->input->post("od_when"),
            'od_lvisit' => $this->input->post("od_lvisit"),
            'or_surg' => $this->input->post("or_surg"),
            'od_times' => $this->input->post("od_times"),
            'od_times2' => $this->input->post("od_times2"),
            'od_timelast' => $this->input->post("od_timelast"),
            'od_desc' => $this->input->post("od_desc"),
            'o_supp' => $this->input->post("o_supp"),
            'o_supp_desc' => $this->input->post("o_supp_desc"),
            'o_cdue' => $this->input->post("o_cdue"),
            'o_cdue_desc' => $this->input->post("o_cdue_desc"),
            'o_res' => $this->input->post("o_res"),
            'o_res_desc' => $this->input->post("o_res_desc"),
            'od_add_info' => $this->input->post("od_add_info"),
            //Educational status
            'hide367' => $this->input->post("hide367"),
            'edustatus' => $this->input->post("edustatus"),
            'edustatus2_regular' => $this->input->post("edustatus2_regular"),
            'edustatus2_iep' => $this->input->post("edustatus2_iep"),
            'edustatus2_504' => $this->input->post("edustatus2_504"),
            'grade' => $this->input->post("grade"),
            'othergrade' => $this->input->post("othergrade"),
            'assistant' => $this->input->post("assistant"),
            'eduservices_occupational' => $this->input->post("eduservices_occupational"),
            'eduservices_physical' => $this->input->post("eduservices_physical"),
            'eduservices_speech' => $this->input->post("eduservices_speech"),
            'eduservices_counseling' => $this->input->post("eduservices_counseling"),
            'eduservices_pe' => $this->input->post("eduservices_pe"),
            'offlocation_hospital' => $this->input->post("offlocation_hospital"),
            'offlocation_home' => $this->input->post("offlocation_home"),
            'reevaldate' => $_POST['reevaldate'],
            'assist_tech' => $this->input->post("assist_tech"),
            'assist_tech_lt' => $this->input->post("assist_tech_lt"),
            'accomodations' => $this->input->post("accomodations"),
            'accomodations_lt' => $this->input->post("accomodations_lt"),
            // Educational status end
            //Transportation form (assessment 15) added here
            'hide16' => $this->input->post("hide16"),
            'trans_method_walker' => $this->input->post("trans_method_walker"),
            'trans_method_car' => $this->input->post("trans_method_car"),
            'trans_method_bus' => $this->input->post("trans_method_bus"),
            'trans_method_lift' => $this->input->post("trans_method_lift"),
            'bus_services_assist' => $this->input->post("bus_services_assist"),
            'bus_services_aide' => $this->input->post("bus_services_aide"),
            'bus_services_nursing' => $this->input->post("bus_services_nursing"),
            'bus_services_equip' => $this->input->post("bus_services_equip"),
            'bus_meds' => $this->input->post("bus_meds"),
            'od_needschool' => $this->input->post("od_needschool"),
            'list_bus_meds' => $this->input->post("list_bus_meds"),
            'med_bus_selfadmin' => $this->input->post("med_bus_selfadmin"),
            'med_bus_selfmed' => $this->input->post("med_bus_selfmed"),
            'med_bus_aideadmin' => $this->input->post("med_bus_aideadmin"),
            'bus_snacks' => $this->input->post("bus_snacks"),
            'bus_mod' => $this->input->post("bus_mod"),
            'bus_mod_list' => $this->input->post("bus_mod_list"),
            'trans_comments' => $this->input->post("trans_comments"),
            'trans_field' => $this->input->post("trans_field"),
            'describe_Snacks' => $this->input->post("describe_Snacks")
        );
        $array2json = json_encode($wizard_14);
//        echo "<pre>";
//        print_r($wizard_14);
//        echo "</pre>";
//        exit;
        // create form session wizard14
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz14_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{'fname'},
            'unique_number' => $obj->{'unique_number'},
            'last_name' => $obj->{'lname'},
            'birth_date' => $obj->{'dob'}
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz14_" . $data['sif_num']);
            //Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz14_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }
        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz14_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz14_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz14_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz14_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz14_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz14_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment14']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz14_" . $data['sif_num']);
            redirect("nurse_assessment/assessment/wizard_16");
        }

        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }

            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        }
        elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";
            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR) :
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_15'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear") :
            $data["action"] = site_url("nurse_assessment/assessment/wizard_16/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/wizard_16");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/wizard_16");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_16";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_14/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function wizard_16() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        $_POST['hcap_seizure_review'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_seizure_review'))));
        $_POST['hcap_seizure_dist'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_seizure_dist'))));
        $_POST['hcap_hypo_review'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_hypo_review'))));
        $_POST['hcap_hypo_dist'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_hypo_dist'))));
        $_POST['hcap_allergy_review'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_allergy_review'))));
        $_POST['hcap_allergy_dist'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_allergy_dist'))));
        $_POST['hcap_gtube_review'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_gtube_review'))));
        $_POST['hcap_gtube_dist'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_gtube_dist'))));
        $_POST['hcap_cardiac_review'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_cardiac_review'))));
        $_POST['hcap_cardiac_dist'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_cardiac_dist'))));
        $_POST['hcap_resp_review'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_resp_review'))));
        $_POST['hcap_resp_dist'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_resp_dist'))));
        $_POST['hcap_emer_review'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_emer_review'))));
        $_POST['hcap_emer_dist'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('hcap_emer_dist'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $user = $this->user_info();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard16 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz16_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
        }

        $obj = json_decode($wizard01);

        if (!empty($wizard16) && empty($copy)) {
            $data["wiz_16"] = json_decode($wizard16);
            $data["subtitle"] = "Edit Nursing Assessment";
            $data['editaction'] = "yes";
        } else {
            $data["subtitle"] = "New Nursing Assessment";
            $wizard16 = (object) array(
                        'hide17' => "",
                        'cultural_info' => "",
                        'hide18' => "",
                        'hcap_seizure_teacher' => "",
                        'hcap_seizure_bus' => "",
                        'hcap_seizure_hr' => "",
                        'hcap_seizure_review' => "",
                        'hcap_seizure_dist' => "",
                        'hcap_hypo_teacher' => "",
                        'hcap_hypo_bus' => "",
                        'hcap_hypo_hr' => "",
                        'hcap_hypo_review' => "",
                        'hcap_hypo_dist' => "",
                        'hcap_allergy_teacher' => "",
                        'hcap_allergy_bus' => "",
                        'hcap_allergy_hr' => "",
                        'hcap_allergy_review' => "",
                        'hcap_allergy_dist' => "",
                        'hcap_gtube_teacher' => "",
                        'hcap_gtube_bus' => "",
                        'hcap_gtube_hr' => "",
                        'hcap_gtube_review' => "",
                        'hcap_gtube_dist' => "",
                        'hcap_cardiac_teacher' => "",
                        'hcap_cardiac_bus' => "",
                        'hcap_cardiac_hr' => "",
                        'hcap_cardiac_review' => "",
                        'hcap_cardiac_dist' => "",
                        'hcap_resp_teacher' => "",
                        'hcap_resp_bus' => "",
                        'hcap_resp_hr' => "",
                        'hcap_resp_review' => "",
                        'hcap_resp_dist' => "",
                        'hcap_emer_teacher' => "",
                        'hcap_emer_bus' => "",
                        'hcap_emer_hr' => "",
                        'hcap_emer_review' => "",
                        'hcap_emer_dist' => "",
                        'hide19' => "",
                        'delegatable' => "",
                        'non_delegatable' => "",
                        'parents_provide' => "",
                        'school_provide' => ""
            );
            $data["wiz_16"] = $wizard16;
        }

        $wizard_15 = array(
            'hide16' => $this->input->post("hide16"),
            'trans_method_walker' => $this->input->post("trans_method_walker"),
            'trans_method_car' => $this->input->post("trans_method_car"),
            'trans_method_bus' => $this->input->post("trans_method_bus"),
            'trans_method_lift' => $this->input->post("trans_method_lift"),
            'bus_services_assist' => $this->input->post("bus_services_assist"),
            'bus_services_aide' => $this->input->post("bus_services_aide"),
            'bus_services_nursing' => $this->input->post("bus_services_nursing"),
            'bus_services_equip' => $this->input->post("bus_services_equip"),
            'bus_meds' => $this->input->post("bus_meds"),
            'list_bus_meds' => $this->input->post("list_bus_meds"),
            'med_bus_selfadmin' => $this->input->post("med_bus_selfadmin"),
            'med_bus_selfmed' => $this->input->post("med_bus_selfmed"),
            'med_bus_aideadmin' => $this->input->post("med_bus_aideadmin"),
            'bus_snacks' => $this->input->post("bus_snacks"),
            'bus_mod' => $this->input->post("bus_mod"),
            'bus_mod_list' => $this->input->post("bus_mod_list"),
            'trans_comments' => $this->input->post("trans_comments")
        );
//$this->assessment_model->print_post_keys($_POST);exit;
//$this->schoolhealth_model->pretty_print($step_15);exit;

        $array2json = json_encode($wizard_15);

// create form session wizard13

        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz15_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $wizardData->{'statenum'},
            'first_name' => $obj->{ 'fname'},
            'unique_number' => $obj->{ 'unique_number'},
            'last_name' => $obj->{ 'lname'},
            'birth_date' => $obj->{ 'dob'},
            'student_school' => $obj->{ 'student_school'},
        );
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};
        }
        if (isset($_POST['assessment_save'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz15_" . $data['sif_num']);
//Count of data forms filled against sif
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }

            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        } elseif (isset($_POST['assessment_resave'])) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz15_" . $data['sif_num']);
            $wizard_data['wizard_status'] = IN_PROGRESS;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }

        // Click Save Edits & Approve button
        elseif (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz15_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz15_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz15_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz15_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizardNumber = "assessment_wiz15_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz15_" . $data['sif_num']);
            $wizard_data['wizard_status'] = REJECTED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment15']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz15_" . $data['sif_num']);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";

            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);

            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                if ($user_role->level != PROGRAM_MANAGER):
                    $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="rejsubmit" value="Reject for Edits"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }

            $data['footerData'] = array('readOnlyViewing' => array(
                    '#assessment.healthform :input[type=text]',
                    '#assessment.healthform :input[type=radio]',
                    '#assessment.healthform :input[type=checkbox]',
            ));
        }
        elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "assessment_wiz01_" . $wizardData->sif;
            $data['assessment_actions'] = "";

            $currentUserHasAccessToAssessment = $this->assessment_model->validate_user_access($wizardNumber);
// TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {

                $data['assessment_actions'] = "<ul>";
                if ($user_role->level != NURSE_SUPERVISOR):
                    $data['assessment_actions'] .= '<input type="submit" name="appsubmit" value="Save Edits & Approve"  class="assessmentaction">';
                endif;
                $data['assessment_actions'] .= '<input type="submit" name="escsubmit" value="Save Edits & Escalate"  class="assessmentaction">';
                $data['assessment_actions'] .= "</ul>";
            }
        }
        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['wiz_16'] = "";
        }
        //URLS
        if (!empty($copy) && $copy == "clear"):
            $data ["action"] = site_url("nurse_assessment/assessment/final_step/clear");
        else:
            $data["action"] = site_url("nurse_assessment/assessment/final_step");
        endif;
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/final_step");
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $data["forms"] = "forms_view/assessment/new_assessment_wizard_16";
        $data["link_back"] = anchor("nurse_assessment/assessment/wizard_14/datas", "<button type='button' class='previous'>Previous</button>");
        $data['assessment_actions'] = "";
        $this->load->view("forms/template", $data);
    }

    public function final_step() {
        $copy = $this->uri->segment(4);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        //Add more Emergency plan
        //7
        $sheepItForm_seizure_plan7 = array();
        $sheepItForm_hcap_emer_teacher = array();
        $sheepItForm_hcap_emer_bus = array();
        $sheepItForm_hcap_emer_hr = array();

        $hcap_seizure_review1 = $_POST['datereview1'];
        $hcap_seizure_dist1 = $_POST['datedist1'];

        $hcap_hypo_review1 = $_POST['datereview2'];
        $hcap_hypo_dist1 = $_POST['datedist2'];

        $hcap_allergy_review1 = $_POST['datereview3'];
        $hcap_allergy_dist1 = $_POST['datedist3'];

        $hcap_gtube_review1 = $_POST['datereview4'];
        $hcap_gtube_dist1 = $_POST['datedist4'];

        $hcap_cardiac_review1 = $_POST['datereview5'];
        $hcap_cardiac_dist1 = $_POST['datedist5'];

        $hcap_resp_review1 = $_POST['datereview6'];
        $hcap_resp_dist1 = $_POST['datedist6'];

        $hcap_emer_review1 = $_POST['sheepItForm1_hcap_emer_review'];
        $hcap_emer_dist1 = $_POST['sheepItForm1_hcap_emer_dist'];
        $newpalnname = $_POST['sheepItForm1_newplanname'];

        //1
        $sheepItForm_hcap_seizure_teacher = $_POST['teacher1'];
        $sheepItForm_hcap_seizure_bus = $_POST['bus1'];
        $sheepItForm_hcap_seizure_hr = $_POST['hr1'];
        //2
        $sheepItForm_hcap_hypo_teacher = $_POST['teacher2'];
        $sheepItForm_hcap_hypo_bus = $_POST['bus2'];
        $sheepItForm_hcap_hypo_hr = $_POST['hr2'];
        //3
        $sheepItForm_hcap_allergy_teacher = $_POST['teacher3'];
        $sheepItForm_hcap_allergy_bus = $_POST['bus3'];
        $sheepItForm_hcap_allergy_hr = $_POST['hr3'];
        //4
        $sheepItForm_hcap_gtube_teacher = $_POST['teacher4'];
        $sheepItForm_hcap_gtube_bus = $_POST['bus4'];
        $sheepItForm_hcap_gtube_hr = $_POST['hr4'];
        //5
        $sheepItForm_hcap_cardiac_teacher = $_POST['teacher5'];
        $sheepItForm_hcap_cardiac_bus = $_POST['bus5'];
        $sheepItForm_hcap_cardiac_hr = $_POST['hr5'];
        //6
        $sheepItForm_hcap_resp_teacher = $_POST['teacher6'];
        $sheepItForm_hcap_resp_bus = $_POST['bus6'];
        $sheepItForm_hcap_resp_hr = $_POST['hr6'];


        for ($i = 0; $i < count($hcap_emer_review1); $i++) {
            //7
            $sheepItForm_seizure_plan7[] = $_POST['sheepItForm1_' . $i . '_seizure_planname7'];
            $sheepItForm_hcap_emer_teacher[] = $_POST['sheepItForm1_' . $i . '_hcap_emer_teacher'];
            $sheepItForm_hcap_emer_bus[] = $_POST['sheepItForm1_' . $i . '_hcap_emer_bus'];
            $sheepItForm_hcap_emer_hr[] = $_POST['sheepItForm1_' . $i . '_hcap_emer_hr'];
        }
// get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

        $user = $this->user_info();
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data['sif_num'] = $this->input->post('sif');
        }

        $data["subtitle"] = "New Nursing Assessment";
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_action"] = site_url("search/student_search/find_student");
        //Additional Information/Specific Cultural Beliefs
        if (!empty($_POST['hide17'])):
            $_POST['cultural_info'] = "";
        endif;
        if (!empty($_POST['hide115'])):
            $_POST['ihp'] = "";
        endif;
        if (!empty($_POST['hide19'])):
            $_POST['delegatable'] = "";
            $_POST['non_delegatable'] = "";
            $_POST['parents_provide'] = "";
            $_POST['school_provide'] = "";
        endif;
        //Additional Information/Specific Cultural Beliefs
        if (!empty($_POST['hide188'])):
            $_POST['planname1'] = "";
            $_POST['planname2'] = "";
            $_POST['planname3'] = "";
            $_POST['planname4'] = "";
            $_POST['planname5'] = "";
            $_POST['planname6'] = "";
            $sheepItForm_seizure_plan7 = "";
            $sheepItForm_hcap_seizure_teacher = "";
            $sheepItForm_hcap_seizure_bus = "";
            $sheepItForm_hcap_seizure_hr = "";
            $hcap_seizure_review1 = "";
            $hcap_seizure_dist1 = "";

            $sheepItForm_hcap_hypo_teacher = "";
            $sheepItForm_hcap_hypo_bus = "";
            $sheepItForm_hcap_hypo_hr = "";
            $hcap_hypo_review1 = "";
            $hcap_hypo_dist1 = "";

            $sheepItForm_hcap_allergy_teacher = "";
            $sheepItForm_hcap_allergy_bus = "";
            $sheepItForm_hcap_allergy_hr = "";
            $hcap_allergy_review1 = "";
            $hcap_allergy_dist1 = "";

            $sheepItForm_hcap_gtube_teacher = "";
            $sheepItForm_hcap_gtube_bus = "";
            $sheepItForm_hcap_gtube_hr = "";
            $hcap_gtube_review1 = "";
            $hcap_gtube_dist1 = "";

            $sheepItForm_hcap_cardiac_teacher = "";
            $sheepItForm_hcap_cardiac_bus = "";
            $sheepItForm_hcap_cardiac_hr = "";
            $hcap_cardiac_review1 = "";
            $hcap_cardiac_dist1 = "";

            $sheepItForm_hcap_resp_teacher = "";
            $sheepItForm_hcap_resp_bus = "";
            $sheepItForm_hcap_resp_hr = "";
            $hcap_resp_review1 = "";
            $hcap_resp_dist1 = "";

            $sheepItForm_hcap_emer_teacher = "";
            $sheepItForm_hcap_emer_bus = "";
            $sheepItForm_hcap_emer_hr = "";
            $hcap_emer_review1 = "";
            $hcap_emer_dist1 = "";
            $newpalnname = "";

        endif;




        $wizard_16 = array(
            'hide17' => $this->input->post("hide17"),
            'cultural_info' => $this->input->post("cultural_info"),
            'hide188' => $this->input->post("hide188"),
            'planname1' => $_POST['planname1'],
            'planname2' => $_POST['planname2'],
            'planname3' => $_POST['planname3'],
            'planname4' => $_POST['planname4'],
            'planname5' => $_POST['planname5'],
            'planname6' => $_POST['planname6'],
            'planname7' => $sheepItForm_seizure_plan7,
            'hcap_seizure_teacher' => $sheepItForm_hcap_seizure_teacher,
            'hcap_seizure_bus' => $sheepItForm_hcap_seizure_bus,
            'hcap_seizure_hr' => $sheepItForm_hcap_seizure_hr,
            'hcap_seizure_review' => $hcap_seizure_review1,
            'hcap_seizure_dist' => $hcap_seizure_dist1,
            'hcap_hypo_teacher' => $sheepItForm_hcap_hypo_teacher,
            'hcap_hypo_bus' => $sheepItForm_hcap_hypo_bus,
            'hcap_hypo_hr' => $sheepItForm_hcap_hypo_hr,
            'hcap_hypo_review' => $hcap_hypo_review1,
            'hcap_hypo_dist' => $hcap_hypo_dist1,
            'hcap_allergy_teacher' => $sheepItForm_hcap_allergy_teacher,
            'hcap_allergy_bus' => $sheepItForm_hcap_allergy_bus,
            'hcap_allergy_hr' => $sheepItForm_hcap_allergy_hr,
            'hcap_allergy_review' => $hcap_allergy_review1,
            'hcap_allergy_dist' => $hcap_allergy_dist1,
            'hcap_gtube_teacher' => $sheepItForm_hcap_gtube_teacher,
            'hcap_gtube_bus' => $sheepItForm_hcap_gtube_bus,
            'hcap_gtube_hr' => $sheepItForm_hcap_gtube_hr,
            'hcap_gtube_review' => $hcap_gtube_review1,
            'hcap_gtube_dist' => $hcap_gtube_dist1,
            'hcap_cardiac_teacher' => $sheepItForm_hcap_cardiac_teacher,
            'hcap_cardiac_bus' => $sheepItForm_hcap_cardiac_bus,
            'hcap_cardiac_hr' => $sheepItForm_hcap_cardiac_hr,
            'hcap_cardiac_review' => $hcap_cardiac_review1,
            'hcap_cardiac_dist' => $hcap_cardiac_dist1,
            'hcap_resp_teacher' => $sheepItForm_hcap_resp_teacher,
            'hcap_resp_bus' => $sheepItForm_hcap_resp_bus,
            'hcap_resp_hr' => $sheepItForm_hcap_resp_hr,
            'hcap_resp_review' => $hcap_resp_review1,
            'hcap_resp_dist' => $hcap_resp_dist1,
            'hcap_emer_teacher' => $sheepItForm_hcap_emer_teacher,
            'hcap_emer_bus' => $sheepItForm_hcap_emer_bus,
            'hcap_emer_hr' => $sheepItForm_hcap_emer_hr,
            'hcap_emer_review' => $hcap_emer_review1,
            'hcap_emer_dist' => $hcap_emer_dist1,
            'newplanname' => $newpalnname,
            'hide19' => $this->input->post("hide19"),
            'hide115' => $this->input->post("hide115"),
            'delegatable' => $this->input->post("delegatable"),
            'non_delegatable' => $this->input->post("non_delegatable"),
            'parents_provide' => $this->input->post("parents_provide"),
            'school_provide' => $this->input->post("school_provide"),
            'ihp' => $this->input->post("ihp")
        );
        // get wizard data (if one exists)
        $wizardData = $this->GetWizardData('wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');


        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number');
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
        }

        $array2json = json_encode($wizard_16);
        $obj = json_decode($wizard01);
        $data['unuque_number'] = $obj->unique_number;
        // create form session wizard16
        $obj->{'dob'} = date('Y-m-d', strtotime(str_replace('-', '/', $obj->{'dob'})));
        $wizard_data = array(
            'wizard_by' => $this->session->userdata("username"),
            'direct_report' => $this->user_manager(),
            'form_type' => 'Assessment',
            'wizard_num' => 'assessment_wiz16_' . $data['sif_num'],
            'wizard_data' => $array2json,
            'wizard_status' => IN_PROGRESS,
            'is_completed' => 1,
            'wizard_sif_num' => $data['sif_num'],
            'wizard_state_num' => $obj->{'statenum'},
            'first_name' => $obj->{ 'fname'},
            'unique_number' => $obj->{ 'unique_number'},
            'last_name' => $obj->{ 'lname'},
            'birth_date' => $obj->{ 'dob'},
            'student_school' => $obj->{ 'school'}
        );
        $data['wizdata'] = $wizard_data;
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number');
        if (!empty($new_assigned_unique_number)) {
            $wizard_data['unique_number'] = $new_assigned_unique_number;
            $wizard_details = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
            $obj2 = json_decode($wizard_details);
            $wizard_data['first_name'] = $obj2->{'fname'};
            $wizard_data['last_name'] = $obj2->{'lname'};


            /* sri
             * Goto final step update common fields
             *  */
            /*
              //$date = date_create($wizard_data['birth_date']);
              $wizard_data['student_school'] = $obj2->{'school'};
              $this->assessment_model->final_step_update($wizard_data['first_name'], $wizard_data['last_name'], $wizard_data['student_school'], $wizard_data['wizard_sif_num'], $wizard_data['unique_number']);
             */
        }
        if (isset($_POST['assessment_save'])) {
            $counts = $this->assessment_model->get_forms_count_sif($data['sif_num'], $wizard_data['unique_number']);
            $create_user_name = $this->assessment_model->create_assessment_form($data['sif_num'], $wizard_data['unique_number'], $user_role->level);
            if (empty($create_user_name)) {
                if ($counts >= 14 && $user_role->level <= NURSE_SUPERVISOR) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts >= 14 && $user_role->level == NURSE) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                } else if ($counts < 14) {
                    $wizard_data['wizard_status'] = IN_PROGRESS;
                }
            } else {
                $wizard_data['wizard_status'] = ESCALATED;
            }
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            //For delete the session record for edit section
            $wiznum = $wizardData->{'sif'};
            $sql = $this->assessment_model->delete_autosave();
            $this->adminui_model->delete_record($wiznum);
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            // after posting data, redirect to logout
            redirect("search/student_search");
        }

        // Click Save Edits & Approve button
        if (isset($_POST['appsubmit'])) {
            $wizardNumber = "assessment_wiz16_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wizard_data['wizard_status'] = COMPLETED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/approve/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Escalate button
        elseif (isset($_POST['escsubmit'])) {
            $wizardNumber = "assessment_wiz16_" . $data['sif_num'];
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wizard_data['wizard_status'] = ESCALATED;
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/escalate/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        }
        // Click Save Edits & Reject button
        elseif (isset($_POST['rejsubmit'])) {
            $wizard_data['wizard_num'] = 'assessment_wiz16_' . $this->input->post("sif");
            unset($wizard_data['wizard_data']);
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
            $wiznum = $wizardData->{'sif'};
            $this->adminui_model->delete_record($wiznum);
            $sql = $this->assessment_model->delete_autosave();
            $this->session->unset_userdata('unique_number'); // Unset the unique number here
            $this->session->unset_userdata('copy_assigned_unique_number'); // Unset the unique number here
            redirect("access_control/admin/reject/" . $wizardNumber . "/" . $wizard_data['unique_number']);
        } elseif ($_POST['assessment16']) {
            $this->assessment_model->wizard_post($wizard_data, $wizard_num = "assessment_wiz16_" . $data['sif_num']);
        }

        //For change title and remove edit option here
        $copy_session_value = $this->session->userdata('copy_assigned_unique_number');
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Nursing Assessment";
            $data['editaction'] = "";
            $data['unuque_number'] = $this->session->userdata('unique_number');
        }

        $reviewvalue = $this->session->userdata('reviewassesment');
        if (!empty($reviewvalue) && $this->uri->segment(4) <> "" && $this->uri->segment(5) <> ""):
            $sifval = $this->uri->segment(4);
            $unumberval = $this->uri->segment(5);
        elseif (empty($reviewvalue) && $this->uri->segment(4) <> "" && $this->uri->segment(5) <> ""):
            $sifval = $this->uri->segment(4);
            $unumberval = $this->uri->segment(5);
        else:
            $sifval = $this->input->post('sif');
            $unumberval = $data['unuque_number'];
        endif;


        //Check created user
        $create_user_name = $this->assessment_model->create_assessment_form($sifval, $unumberval, $user_role->level);

        $create_user_id = $this->assessment_model->get_userid_against_uname($create_user_name);
        // get user role
        $create_user_role = $this->adminui_model->get_user_role($acct_id = $create_user_id);
        //User level of whose create the assessment
        $data['created_user_level'] = $create_user_role->level;

        //Escalate Link click
        $data['forminfo'] = $this->assessment_model->get_form_details($sifval, $unumberval);
        //URLS
        $data["action"] = site_url("nurse_assessment/assessment/final_step");
        $data["attr_FormSubmit_assessment"] = site_url("nurse_assessment/final_step");
        // load view
        $data["forms"] = "forms_view/assessment/assessment_complete";

        $this->load->view("forms/template", $data);
    }

    public function check_exists() {
        $sel = $this->assessment_model->check_exists_value($_POST['sifnum']);
        echo $sel;
    }

    public function nurse_escalate_form() {
        $sif = $this->uri->segment(4);
        $unum = $this->uri->segment(5);
        $wiznum = 'assessment_wiz16_' . $sif;
//        $status = $this->assessment_model->escalate_status_update($sif, $unum);
        redirect("access_control/admin/escalate/" . $wiznum . "/" . $unum . "/back");
    }

    public function nurse_reject_form() {
        $sif = $this->uri->segment(4);
        $unum = $this->uri->segment(5);
        $wiznum = 'assessment_wiz16_' . $sif;
        redirect("access_control/admin/reject/" . $wiznum . "/" . $unum . "/back");
    }

    public function ns_complete_form() {
        $sif = $this->uri->segment(4);
        $unum = $this->uri->segment(5);
        $wiznum = 'assessment_wiz16_' . $sif;
//        $status = $this->assessment_model->complete_status_update_assessment($sif, $unum);
        redirect("access_control/admin/approve/" . $wiznum . "/" . $unum . "/back");
    }

}
