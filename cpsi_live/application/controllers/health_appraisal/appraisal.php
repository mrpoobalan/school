<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Assessment Controller
 *
 * @package	Health Appraisal Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.0.0-pre
 */
require APPPATH . '/libraries/aah_controller.php';

class Appraisal extends AAH_Controller {

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
        $this->load->model("appraisal_model", "", TRUE);
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

    public function user_info() {
        // get user details
        $user = $this->schoolhealth_model->get_by_user($user = $this->session->userdata("username"))->row();
        return $user;
    }

    public function check_form_status() {
        // check if logged_in user has a form in progress
        $form_status = $this->appraisal_model->get_form_status($user = $this->session->userdata("username"));
        return $form_status;
    }

    public function user_manager() {
        // get user manager and notify manager(s) of form modification
        $direct_report = $this->adminui_model->get_managed_users($user_id = $this->session->userdata("user_id"))->result();
        return $direct_report[0]->manage_by;
    }

    public function wizard_01() {
        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            //$this->load->view("access_denied");
            redirect("access_control/admin/access_denied/");
        }
        // set common properties
        $data["subtitle"] = "New Health Appraisal";
        $school_type = $this->schoolhealth_model->get_schooltype();
        $data["schooltype_array"] = $school_type;
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        // let's grab any saved entry
        $currentWizard = 'wiz01';
        $action = $this->input->get('action');
        if ($action != 'add'):
            $wizardData = $this->GetWizardData($currentWizard);
        endif;

        if ($pageWasRefreshed) {
            $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        } else {
            $sql = $this->assessment_model->delete_autosave();
        }
        if (!empty($wizardData)) {
            if (is_numeric($copy)):
                $wizardData->unique_number = $copy;
            endif;
            if (!empty($copy_unumber)):
                $wizardData->unique_number = $copy_unumber;
            endif;
            $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
            if (!empty($new_assigned_unique_number) && empty($copy_unumber)) {
                $wizardData->unique_number = $new_assigned_unique_number;
            }
            $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard01)):
                $wizard01 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data["subtitle"] = "Edit Health Appraisal";
        }

        if (!empty($wizard01)) {
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
                        'none_text' => "",
                        'preferred_hospital' => "",
                        'medical_reason' => "",
                        'contactattempt1' => "",
                        'assessment' => "");
            $data["wiz01"] = $wizard01;
        };
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        if (!empty($copy) && $copy == "copy"):
            $data["subtitle"] = "Copy Health Appraisal";
            $data["action"] = site_url("health_appraisal/appraisal/wizard_02/copy/" . $copy_unumber);
        else:
            if (is_numeric($copy)):
                $data["action"] = site_url("health_appraisal/appraisal/wizard_02/" . $copy);
            else:

                $data["action"] = site_url("health_appraisal/appraisal/wizard_02");
            endif;
        endif;
        $data["search_action"] = site_url("search/student_search/find_student");
        $data["attr_FormSubmit_appraisal"] = site_url("health_appraisal/appraisal/wizard_02");
        // if we have a readonly view, let's specify the inputs that should be hidden
        // reference the elements via jquery
        // conditionally switch to readonly view
        $data['footerData'] = ""; // move to a common function that should be called by each controller fx. that way we get a unified setting of default vars
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#appraisal.healthform :input[type=text]',
                    '#appraisal.healthform :input[type=radio]',
                    '#appraisal.healthform :input[type=checkbox]',
                    '#appraisal.healthform :option[value=""]',
            ));
        }
        //For change title and remove edit option here
        if (!empty($copy) && !is_numeric($copy) && $copy == "copy") {
            $unum = $this->uri->segment(5);
            $this->session->set_userdata('copy_assigned_unique_number_appraisal', $unum);
        }
        if (!empty($copy_session_value)) {
            $data["subtitle"] = "Copy Health Appraisal";
            $data['editaction'] = "";
        }
        // load view

        $data["forms"] = "forms_view/appraisal/new_appraisal_wizard_01";
        $this->load->view("forms/template", $data);
    }

    public function wizard_02() {
        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        //Assign Sif unique number here
        $sifnum = $this->input->post('sif');
        if (!empty($copy) && is_numeric($copy)) {
            $this->session->set_userdata('unique_number_appraisal', $copy);
        }
        $unique_session_value = $this->session->userdata('unique_number_appraisal');
        if (empty($unique_session_value)):
            $unique_number = $this->assessment_model->count_form_sessions($sifnum);
            $unique_number = $unique_number + 1;
            $this->session->set_userdata('unique_number_appraisal', $unique_number);
        endif;
        $contactattempt = '';
        foreach ($_POST['contactattempt1'] as $contacts) {
            $contactattempt .= date('Y-m-d', strtotime(str_replace('-', '/', $contacts))) . ',';
        }
        $_POST['contactattempt1'] = $contactattempt;

        //Additional contact
        $addtnlcontact = $relationship = $addtnlcellphone = $addtnlhomephone = $addtnlworkphone = array();
        $addtnlcontact = $_POST['sheepItForm1_addtnlcontact'];
        $relationship = $_POST['sheepItForm1_relationship'];
        $addtnlcellphone = $_POST['sheepItForm1_addtnlcellphone'];
        $addtnlhomephone = $_POST['sheepItForm1_addtnlhomephone'];
        $addtnlworkphone = $_POST['sheepItForm1_addtnlworkphone'];

        $previousWizardData1 = array(
            'addtnlcontact' => $addtnlcontact,
            'relationship' => $relationship,
            'addtnlcellphone' => $addtnlcellphone,
            'addtnlhomephone' => $addtnlhomephone,
            'addtnlworkphone' => $addtnlworkphone
        );
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            redirect("access_control/admin/access_denied/");
        }
        // only save wiz01 if we have post data (not when we are returning from wiz03
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $previousWizardData2 = $this->input->post(NULL, TRUE);
            $previousWizardData = array_merge($previousWizardData1, $previousWizardData2);
            $this->SaveWizardData('wiz01', $previousWizardData);
            $data['sif_num'] = $this->input->post('sif');
        }
        // set common properties
        $data["subtitle"] = "New Health Appraisal";
        $school_type = $this->schoolhealth_model->get_schooltype();
        $data["schooltype_array"] = $school_type;
        // let's save the post data
        // note, when calling back using the back link, sometimes, we will not have post data available
        // in that case, do not overwrite the wiz01 data
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $previousWizardData2 = $this->input->post(NULL, TRUE);
            $previousWizardData = array_merge($previousWizardData1, $previousWizardData2);

            $this->SaveWizardData('appraisal_wiz01', $previousWizardData);
            $data['sif_num'] = $this->input->post('sif');
            $wizard_01 = $previousWizardData;
            $array2json = json_encode($wizard_01);
            $wizard_data = array(
                'wizard_by' => $this->session->userdata("username"),
                'direct_report' => $this->user_manager(),
                'form_type' => 'Appraisal',
                'wizard_num' => 'appraisal_wiz01_' . $this->input->post("sif"),
                'wizard_data' => $array2json,
                'wizard_status' => IN_PROGRESS,
                'wizard_sif_num' => $this->input->post("sif"),
                'wizard_state_num' => $this->input->post("statenum"),
                'first_name' => $this->input->post("fname"),
                'last_name' => $this->input->post("lname"),
                'student_school' => $this->input->post("school"),
                'birth_date' => $this->input->post("dob")
            );
            $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
            if (!empty($new_assigned_unique_number)) {
                $wizard_data['unique_number'] = $new_assigned_unique_number;
            }
            // check if save & exit was submitted
            if (isset($_POST['appraisal_save'])) {

                $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz01_" . $data['sif_num']);
                $wiznum = $wizardData->{'sif'};
                $this->adminui_model->delete_record($wiznum);
                $sql = $this->assessment_model->delete_autosave();
                // after posting data, redirect to logout
                //unset sif number in session
                $this->session->unset_userdata('sifnumberval');
                $this->session->unset_userdata('unique_number_appraisal'); // Unset the unique number here
                redirect("search/student_search");
            } elseif ($_POST['appraisal']) {
                $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz01_" . $data['sif_num']);
            }
        }
        // let's grab any saved entry
        $wizardData = $this->GetWizardData('appraisal_wiz01');
        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // get data wizard01 (if one exists)
        if (!empty($wizardData)) {
            $wizard02 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz02_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard02)):
                $wizard02 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz02_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number_appraisal');
                $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data["wizardData"] = json_decode($wizard02);
            $data['sif_num'] = $wizardData->sif;
        }
        $obj = json_decode($wizard01);
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data['sif_num'] = $data['sif_num'];
        $data["forms"] = "forms_view/appraisal/new_appraisal_wizard_02";
        if (!empty($copy) && $copy == "copy"):
            $data["subtitle"] = "Copy Health Appraisal";
            $data["action"] = site_url("health_appraisal/appraisal/wizard_03/copy/" . $copy_unumber);
        else:
            if (is_numeric($copy)):
                $data["action"] = site_url("health_appraisal/appraisal/wizard_03/" . $copy);
            else:
                $data["action"] = site_url("health_appraisal/appraisal/wizard_03");
            endif;
        endif;
        $data["search_action"] = site_url("search/student_search/find_student");
        if (is_numeric($copy)):
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_01/" . $copy, "<button type='button' class='previous'>Previous</button>");
        else:
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_01/datas", "<button type='button' class='previous'>Previous</button>");
        endif;
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // load view
        $this->load->view("forms/template", $data);
    }

    public function wizard_03() {

        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        //Add health cate plan
        $newdiagnosis = '';
        foreach ($_POST['newdiagnosis'] as $val) {
            $newdiagnosis .= str_replace('-', '/', $val) . ',';
        }
        $_POST['newdiagnosis'] = $newdiagnosis;
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data['sif_num'] = $this->input->post('sif');
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            redirect("access_control/admin/access_denied/");
        }
        // let's grab any saved entry for wizard 1 & 3
        $wizardData = $this->GetWizardData('appraisal_wiz01');

        // Copy option here
        $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard03 = "";
            $wizard03 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz03_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard03)):
                $wizard03 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz03_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number_appraisal');
                $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;

            $data["wizardData"] = json_decode($wizard03);
            $data['sif_num'] = $wizardData->sif;
            $obj = json_decode($wizard01);
            // if wizard 2 is posted, collect the data and save it
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // collect any post data from wizard 2
                $wizard_02 = $this->input->post(NULL, TRUE);
                $wizard_02['wizard'] = "02";
                $array2json = json_encode($wizard_02);
                $wizard_data = array(
                    'wizard_by' => $this->session->userdata("username"),
                    'direct_report' => $this->user_manager(),
                    'form_type' => 'Appraisal',
                    'wizard_num' => 'appraisal_wiz02_' . $obj->sif,
                    'wizard_data' => $array2json,
                    'wizard_status' => IN_PROGRESS,
                    'wizard_sif_num' => $obj->sif,
                    'wizard_state_num' => $obj->{'statenum'},
                    'first_name' => $obj->{'fname'},
                    'last_name' => $obj->{'lname'},
                    'student_school' => $obj->{'school'},
                    'birth_date' => $obj->{'dob'}
                );

                $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
                if (!empty($new_assigned_unique_number)) {
                    $wizard_data['unique_number'] = $new_assigned_unique_number;
                }
                // check if save & exit was submitted
                if (isset($_POST['appraisal_save'])) {
                    // only save wiz01 if we have post data (not when we are returning from wiz03
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz02_" . $obj->sif);
                    //For delete the session record for edit section
                    $wiznum = $wizardData->{'sif'};
                    $sql = $this->assessment_model->delete_autosave();
                    $this->adminui_model->delete_record($wiznum);
                    //unset sif number in session
                    $this->session->unset_userdata('sifnumberval');
                    // after posting data, redirect to logout
                    redirect("search/student_search");
                } elseif ($_POST['appraisal2']) {
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz02_" . $obj->sif);
                }
            }
        }
//        echo "<pre>";
//        print_r($data['wizardData']);
//        exit;
        // set common properties
        $data["subtitle"] = "New Health Appraisal";
        $school_type = $this->schoolhealth_model->get_schooltype();
        $data["schooltype_array"] = $school_type;
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        $data["forms"] = "forms_view/appraisal/new_appraisal_wizard_03";
        $data["action"] = site_url("health_appraisal/appraisal/wizard_04");
        $data["search_action"] = site_url("search/student_search/find_student");
        if (is_numeric($copy)):
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_02/datas", "<button type='button' class='previous'>Previous</button>");
        else:
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_02/datas", "<button type='button' class='previous'>Previous</button>");
        endif;
        // load view
//        echo "<pre>";
//        print_r($data);
//        exit;
        $this->load->view("forms/template", $data);
    }

    public function wizard_04() {
        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            redirect("access_control/admin/access_denied/");
        }
        //Treatments for cloning
        $treatment1 = $_POST['sheepItForm5_treatment'];
        $frequency1 = $_POST['sheepItForm5_frequency'];
        $person1 = $_POST['sheepItForm5_person'];
        $maxcount5 = max(count($treatment1), count($frequency1), count($person1));
        $sheepItForm1_performed_school = array();
        for ($i = 0; $i < count($maxcount5); $i++) {
            $sheepItForm5_performed_school[] = $_POST['sheepItForm5_performed_school' . $i];
        }
        ## Specialist form cloning
        $specialist = $_POST['sheepItForm1_specialist'];
        $lastexam = $_POST['sheepItForm1_lastexam'];
        $nextexam = $_POST['sheepItForm1_nextexam'];
        $releaseexp = $_POST['sheepItForm1_releaseexp'];
        $phone1 = $_POST['sheepItForm1_phone'];
        $releasedesc = $_POST['describe_sheepItForm'];
        $fax1 = $_POST['sheepItForm1_fax'];
        $maxcount1 = max(count($specialist), count($lastexam), count($nextexam), count($releaseexp));
        $sheepItForm1_release = array();
        for ($i = 0; $i < $maxcount1; $i++) {
            $sheepItForm1_release[] = $_POST['sheepItForm1_release' . $i];
        }
        $_POST['specialistRelease'] = $sheepItForm1_release;
        ## End to specialist form cloning
        ## Add agency or case manager cloning
        $name = $_POST['sheepItForm_name'];
        $phone = $_POST['sheepItForm_phone'];
        $fax = $_POST['sheepItForm_fax'];
        $maxcount = max(count($name), count($phone), count($fax));
        $sheepItForm_release = array();
        for ($i = 0; $i < $maxcount; $i++) {
            $sheepItForm_release[] = $_POST['sheepItForm_release' . $i];
        }
        $_POST['sheepItForm_release'] = $sheepItForm_release;
        ## End to Add agency or case manager cloning
        ## Daily meditation cloning
        $med1 = $_POST['sheepItForm2_med'];
        $dose1 = $_POST['sheepItForm2_dos'];
        $route1 = $_POST['sheepItForm2_time'];
        $time1 = $_POST['sheepItForm2_route'];
        $maxcount = max(count($med1), count($dose1), count($route1));
        $sheepItForm2_school = array();
        $sheepItForm2_home = array();
        for ($i = 0; $i < $maxcount; $i++) {
            $sheepItForm2_school[] = $_POST['sheepItForm2_school' . $i];
            $sheepItForm2_home[] = $_POST['sheepItForm2_home' . $i];
        }
        $_POST['sheepItForm2_school'] = $sheepItForm2_school;
        $_POST['sheepItForm2_home'] = $sheepItForm2_home;
        ## End to meditation cloning
        ## Prn medication Cloning
        $prnmed1 = $_POST['sheepItForm3_prnmed'];
        $prndose1 = $_POST['sheepItForm3_prndos'];
        $prnroute1 = $_POST['sheepItForm3_prnroute'];
        $prntime1 = $_POST['sheepItForm3_prntime'];
        $maxcount1 = max(count($prnmed1), count($prndose1), count($prnroute1));
        $sheepItForm3_school = array();
        $sheepItForm3_home = array();
        $sheepItForm3_emerg = array();
        for ($i = 0; $i < $maxcount1; $i++) {
            $sheepItForm3_school[] = $_POST['sheepItForm3_prnschool' . $i];
            $sheepItForm3_home[] = $_POST['sheepItForm3_prnhome' . $i];
            $sheepItForm3_emerg[] = $_POST['sheepItForm3_prnemerg' . $i];
        }
        $_POST['sheepItForm3_prnschool'] = $sheepItForm3_school;
        $_POST['sheepItForm3_prnhome'] = $sheepItForm3_home;
        $_POST['sheepItForm3_prnemerg'] = $sheepItForm3_emerg;
        ## End Prn medication Cloning
        ## Add allergy cloning
        $allergy1 = $_POST['sheepItForm4_allergy'];
        $reaction1 = $_POST['sheepItForm4_reaction'];
        $ah1 = $_POST['sheepItForm4_ah'];
        $addtnlcomments1 = $_POST['sheepItForm4_addtnlcomments'];
        $lastevent1 = $_POST['sheepItForm4_lastevent'];
        $sheepItForm4_deadly = array();
        $sheepItForm4_diagnosed = array();
        $sheepItForm4_touch = array();
        $sheepItForm4_ingest = array();
        $sheepItForm4_air = array();
        $sheepItForm4_sting = array();
        $sheepItForm4_epi = array();
        $sheepItForm4_antihistamine = array();
        for ($i = 0; $i < count($allergy1); $i++) {
            $sheepItForm4_deadly[] = $_POST['sheepItForm4_' . $i . '_deadly'];
            $sheepItForm4_diagnosed[] = $_POST['sheepItForm4_' . $i . '_diagnosed'];
            $sheepItForm4_ingest[] = $_POST['sheepItForm4_' . $i . '_ingest'];
            $sheepItForm4_air[] = $_POST['sheepItForm4_' . $i . '_air'];
            $sheepItForm4_sting[] = $_POST['sheepItForm4_' . $i . '_sting'];
            $sheepItForm4_epi[] = $_POST['sheepItForm4_' . $i . '_epi'];
            $sheepItForm4_touch[] = $_POST['sheepItForm4_' . $i . '_touch'];
            $sheepItForm4_antihistamine[] = $_POST['sheepItForm4_' . $i . '_antihistamine'];
        }
        $_POST['sheepItForm4_deadly'] = $sheepItForm4_deadly;
        $_POST['sheepItForm4_diagnosed'] = $sheepItForm4_diagnosed;
        $_POST['sheepItForm4_ingest'] = $sheepItForm4_ingest;
        $_POST['sheepItForm4_air'] = $sheepItForm4_air;
        $_POST['sheepItForm4_sting'] = $sheepItForm4_sting;
        $_POST['sheepItForm4_epi'] = $sheepItForm4_epi;
        $_POST['sheepItForm4_touch'] = $sheepItForm4_touch;
        $_POST['sheepItForm4_antihistamine'] = $sheepItForm4_antihistamine;
        ## End to add allergy cloning
        // let's grab any saved entry for wizard 1 & 3
        $wizardData = $this->GetWizardData('appraisal_wiz01');
        $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
        if (!empty($new_assigned_unique_number) || !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
            if (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas") {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard04 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz04_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard04)):
                $wizard04 = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz04_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number_appraisal');
                $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data["wizardData"] = json_decode($wizard04);
            $data['sif_num'] = $wizardData->sif;
            $wizard1Obj = json_decode($wizard01);
            // if wizarddata is posted, collect the data and save it
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // collect any post data from wizard 2
                $wizard_03 = $this->input->post(NULL, TRUE);
                $wizard_03['wizard'] = "03";
                $array2json = json_encode($wizard_03);
                $wizard_data = array(
                    'wizard_by' => $this->session->userdata("username"),
                    'direct_report' => $this->user_manager(),
                    'form_type' => 'Appraisal',
                    'wizard_num' => 'appraisal_wiz03_' . $wizard1Obj->sif,
                    'wizard_data' => $array2json,
                    'wizard_status' => IN_PROGRESS,
                    'wizard_sif_num' => $wizard1Obj->sif,
                    'wizard_state_num' => $wizard1Obj->{'confirmstatenum'},
                    'first_name' => $wizard1Obj->{'fname'},
                    'last_name' => $wizard1Obj->{'lname'},
                    'student_school' => $wizard1Obj->{'school'},
                    'birth_date' => $wizard1Obj->{'dob'}
                );
                $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
                if (!empty($new_assigned_unique_number)) {
                    $wizard_data['unique_number'] = $new_assigned_unique_number;
                }
                // check if save & exit was submitted
                if (isset($_POST['appraisal_save'])) {
                    // only save wiz01 if we have post data (not when we are returning from wiz03
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz03_" . $wizard1Obj->sif);
                    //For delete the session record for edit section
                    $wiznum = $wizardData->{'sif'};
                    $sql = $this->assessment_model->delete_autosave();
                    $this->adminui_model->delete_record($wiznum);
                    //unset sif number in session
                    $this->session->unset_userdata('sifnumberval');
                    $this->session->unset_userdata('unique_number_appraisal'); // Unset the unique number here
                    // after posting data, redirect to logout
                    redirect("search/student_search");
                } elseif (isset($_POST['appraisal3'])) {
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz03_" . $wizard1Obj->sif);
                }
            }
        }
        // set common properties
        $data["subtitle"] = "New Health Appraisal";
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
        $data['sif_num'] = $wizard1Obj->sif;
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        $data["forms"] = "forms_view/appraisal/new_appraisal_wizard_04";
        if (!empty($copy) && $copy == "copy"):
            $data["subtitle"] = "Copy Health Appraisal";
            $data["action"] = site_url("health_appraisal/appraisal/wizard_05/copy/" . $copy_unumber);
        else:
            if (is_numeric($copy)):
                $data["action"] = site_url("health_appraisal/appraisal/wizard_05/" . $copy);
            else:
                $data["action"] = site_url("health_appraisal/appraisal/wizard_05");
            endif;
        endif;
        $data["search_action"] = site_url("search/student_search/find_student");
        if (is_numeric($copy)):
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_03/" . $copy, "<button type='button' class='previous'>Previous</button>");
        else:
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_03/datas", "<button type='button' class='previous'>Previous</button>");
        endif;
        // load view
        $this->load->view("forms/template", $data);
    }

    public function wizard_05() {
        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            redirect("access_control/admin/access_denied/");
        }
        // let's grab any saved entry for wizard 1 & 3
        $wizardData = $this->GetWizardData('appraisal_wiz01');
        $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
        if (!empty($new_assigned_unique_number) && !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $currentWizardData = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz05_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($currentWizardData)):
                $currentWizardData = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz05_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number_appraisal');
                $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data["wizardData"] = json_decode($currentWizardData);
            $data['sif_num'] = $wizardData->sif;
            $wizard1Obj = json_decode($wizard01);
            // if wizarddata is posted, collect the data and save it
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // collect any post data from wizard 2
                $previousWizardData = $this->input->post(NULL, TRUE);
                $previousWizardData['wizard'] = "04";
                $array2json = json_encode($previousWizardData);
                $wizard_data = array(
                    'wizard_by' => $this->session->userdata("username"),
                    'direct_report' => $this->user_manager(),
                    'form_type' => 'Appraisal',
                    'wizard_num' => 'appraisal_wiz04_' . $wizard1Obj->sif,
                    'wizard_data' => $array2json,
                    'wizard_status' => IN_PROGRESS,
                    'wizard_sif_num' => $wizard1Obj->sif,
                    'wizard_state_num' => $wizard1Obj->{'confirmstatenum'},
                    'first_name' => $wizard1Obj->{'fname'},
                    'last_name' => $wizard1Obj->{'lname'},
                    'student_school' => $wizard1Obj->{'school'},
                    'birth_date' => $wizard1Obj->{'dob'}
                );
                $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
                if (!empty($new_assigned_unique_number)) {
                    $wizard_data['unique_number'] = $new_assigned_unique_number;
                    $wizard_details = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
                    $obj2 = json_decode($wizard_details);
                    $wizard_data['first_name'] = $obj2->{'fname'};
                    $wizard_data['last_name'] = $obj2->{'lname'};
                }
                // check if save & exit was submitted
                if (isset($_POST['appraisal_save'])) {
                    // only save wiz01 if we have post data (not when we are returning from wiz03
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz04_" . $wizard1Obj->sif);
                    //For delete the session record for edit section
                    $wiznum = $wizardData->{'sif'};
                    $sql = $this->assessment_model->delete_autosave();
                    $this->adminui_model->delete_record($wiznum);
                    //unset sif number in session
                    $this->session->unset_userdata('sifnumberval');
                    $this->session->unset_userdata('unique_number_appraisal'); // Unset the unique number here
                    // after posting data, redirect to logout
                    redirect("search/student_search");
                } elseif ($_POST['appraisal4']) {
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz04_" . $wizard1Obj->sif);
                    // after posting data, redirect to another page6
                    redirect("health_appraisal/appraisal/wizard_06");
                }
            }
        }
        // set common properties
        $data["subtitle"] = "New Health Appraisal";
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
        $data['sif_num'] = $wizard1Obj->sif;
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        $data["forms"] = "forms_view/appraisal/new_appraisal_wizard_06";
        if (!empty($copy) && $copy == "copy"):
            $data["subtitle"] = "Copy Health Appraisal";
            $data["action"] = site_url("health_appraisal/appraisal/wizard_06/copy/" . $copy_unumber);
        else:
            if (is_numeric($copy)):
                $data["action"] = site_url("health_appraisal/appraisal/wizard_06/" . $copy);
            else:

                $data["action"] = site_url("health_appraisal/appraisal/wizard_06");
            endif;
        endif;
        $data["search_action"] = site_url("search/student_search/find_student");
        if (is_numeric($copy)):
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_04/" . $copy, "<button type='button' class='previous'>Previous</button>");
        else:
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_04/datas", "<button type='button' class='previous'>Previous</button>");
        endif;
        // load view
        $this->load->view("forms/template", $data);
    }

    public function wizard_06() {
        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            redirect("access_control/admin/access_denied/");
        }
        // let's grab any saved entry for wizard 1 & 3
        $wizardData = $this->GetWizardData('appraisal_wiz01');
        $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
        if (!empty($new_assigned_unique_number) && !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');

        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;

        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $currentWizardData = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz06_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($currentWizardData)):
                $currentWizardData = $this->assessment_model->wizard_get($get_wizard_num = "assessment_wiz06_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number_appraisal');
                $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data["wizardData"] = json_decode($currentWizardData);
            $data['sif_num'] = $wizardData->sif;
            $wizard1Obj = json_decode($wizard01);
            // if wizarddata is posted, collect the data and save it
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // collect any post data from wizard 2
                $previousWizardData = $this->input->post(NULL, TRUE);
                $previousWizardData['wizard'] = "05";
                $array2json = json_encode($previousWizardData);
                $wizard_data = array(
                    'wizard_by' => $this->session->userdata("username"),
                    'direct_report' => $this->user_manager(),
                    'form_type' => 'Appraisal',
                    'wizard_num' => 'appraisal_wiz05_' . $wizard1Obj->sif,
                    'wizard_data' => $array2json,
                    'wizard_status' => IN_PROGRESS,
                    'wizard_sif_num' => $wizard1Obj->sif,
                    'wizard_state_num' => $wizard1Obj->{'confirmstatenum'},
                    'first_name' => $wizard1Obj->{'fname'},
                    'last_name' => $wizard1Obj->{'lname'},
                    'student_school' => $wizard1Obj->{'school'},
                    'birth_date' => $wizard1Obj->{'dob'}
                );
                $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
                if (!empty($new_assigned_unique_number)) {
                    $wizard_data['unique_number'] = $new_assigned_unique_number;
                    $wizard_details = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
                    $obj2 = json_decode($wizard_details);
                    $wizard_data['first_name'] = $obj2->{'fname'};
                    $wizard_data['last_name'] = $obj2->{'lname'};
                }
                // check if save & exit was submitted
                if (isset($_POST['appraisal_save'])) {
                    // only save wiz01 if we have post data (not when we are returning from wiz03
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz05_" . $wizard1Obj->sif);
                    //For delete the session record for edit section
                    $wiznum = $wizardData->{'sif'};
                    $sql = $this->assessment_model->delete_autosave();
                    $this->adminui_model->delete_record($wiznum);
                    //unset sif number in session
                    $this->session->unset_userdata('sifnumberval');
                    $this->session->unset_userdata('unique_number_appraisal'); // Unset the unique number here
                    // after posting data, redirect to logout
                    redirect("search/student_search");
                } elseif ($_POST['appraisal5']) {
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz05_" . $wizard1Obj->sif);
                }
            }
        }
        // set common properties
        $data["subtitle"] = "New Health Appraisal";
        $school_type = $this->schoolhealth_model->get_schooltype();
        $data["schooltype_array"] = $school_type;
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $user = $this->user_info();
        //autosave
        $data['autosave'] = $this->assessment_model->get_autosave($this->session->userdata('user_id'));
        // setup form data
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data['sif_num'] = $wizardData->sif;
        $data["forms"] = "forms_view/appraisal/new_appraisal_wizard_06";
        if (!empty($copy) && $copy == "copy"):
            $data["subtitle"] = "Copy Health Appraisal";
            $data["action"] = site_url("health_appraisal/appraisal/complete_appraisal/copy/" . $copy_unumber);
        else:
            if (is_numeric($copy)):
                $data["action"] = site_url("health_appraisal/appraisal/complete_appraisal/" . $copy);
            else:

                $data["action"] = site_url("health_appraisal/appraisal/complete_appraisal/datas");
            endif;
        endif;
        $data["search_action"] = site_url("search/student_search/find_student");
        if (is_numeric($copy)):
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_04/" . $copy, "<button type='button' class='previous'>Previous</button>");
        else:
            $data["link_back"] = anchor("health_appraisal/appraisal/wizard_04/datas", "<button type='button' class='previous'>Previous</button>");
        endif;
        // load view
        $this->load->view("forms/template", $data);
    }

    //View all the details against data and user
    public function view_appraisal3($wizard_num, $auditid, $limit) {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // set common properties
        $data["subtitle"] = "New Nursing Appraisal Print Page";
        //TODO UNCOMMENT userrole during production
        // get user details
        // get user role
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
        $unique_sifnumber = "";
        $unique_sifnumber = end(explode("-", $this->uri->segment(4)));
        $sifnumber = explode("-", $this->uri->segment(4));
        $wizard_num = end(explode("_", $sifnumber[0]));

        $wizard01 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz01_" . $wizard_num, $access = $user_role->level, $auditid, $limit);
        $data["wiz01"] = $wizard01;
        if (empty($data["wiz01"])) {
            $data["wiz01"] = array();
        }
        $data["wiz01"] = json_decode($data["wiz01"]);
        //Get Wizard data (2)
        $wizard02 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz02_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz02"] = $wizard02;
        if (empty($data["wiz02"])) {
            $data["wiz02"] = array();
        }
        $data["wiz02"] = json_decode($data["wiz02"]);
        //Get Wizard data (3)
        $wizard03 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz03_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz03"] = $wizard03;
        if (empty($data["wiz03"])) {
            $data["wiz03"] = array();
        }
        $data["wiz03"] = json_decode($data["wiz03"]);
        //Get Wizard data (4)
        $wizard04 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz04_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz04"] = $wizard04;
        if (empty($data["wiz04"])) {
            $data["wiz04"] = array();
        }
        $data["wiz04"] = json_decode($data["wiz04"]);
        //Get Wizard data (5)
        $wizard05 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz05_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz05"] = $wizard05;
        if (empty($data["wiz05"])) {
            $data["wiz05"] = array();
        }
        $data["wiz05"] = json_decode($data["wiz05"]);
        //Get Wizard data (6)
        $wizard06 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz06_" . $wizard_num, $access = $user_role->level, '', $limit);
        $data["wiz06"] = $wizard06;
        if (empty($data["wiz06"])) {
            $data["wiz06"] = array();
        }
        $data["wiz06"] = json_decode($data["wiz06"]);
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "appraisal_wiz01_" . $wizardData->sif;
            $data['appraisal_actions'] = "";
            $currentUserHasAccessToAppraisal = $this->appraisal_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAppraisal) {
                    $data['appraisal_actions'] = "<ul>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                    $data['appraisal_actions'] .= "</ul>";
                }
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#appraisal.healthform :input[type=text]',
                    '#appraisal.healthform :input[type=radio]',
                    '#appraisal.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "appraisal_wiz01_" . $wizardData->sif;
            $data['appraisal_actions'] = "";
            $currentUserHasAccessToAppraisal = $this->appraisal_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['appraisal_actions'] = "<ul>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Save Edits & Approve") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Save Edits & Escalate") . "</li>";
                    $data['appraisal_actions'] .= "</ul>";
                }
            }
        }
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        exit;
        $data["forms"] = "forms_view/print/appraisal/appraisal_view";
        $this->load->view("forms/template", $data);
    }

    public function view_appraisal2($wizard_num, $auditid, $limit) {
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // set common properties
        $data["subtitle"] = "New Nursing Appraisal Print Page";
        //TODO UNCOMMENT userrole during production
        // get user details
        // get user role
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
//        $wizard01 = $this->appraisal_model->wizard_health_audit($get_wizard_num = "appraisal_wiz01_" . $wizard_num, $access = $user_role->level, $auditid, $limit);
//        $data["wiz01"] = $wizard01;
//        if (empty($data["wiz01"]))
//        {
//            $data["wiz01"] = array();
//        }
//        //Get Wizard data (2)
//        $wizard02 = $this->appraisal_model->wizard_health_audit($get_wizard_num = "appraisal_wiz02_" . $wizard_num, $access = $user_role->level, '', $limit);
//        $data["wiz02"] = $wizard02;
//        if (empty($data["wiz02"]))
//        {
//            $data["wiz02"] = array();
//        }
//        //Get Wizard data (3)
//        $wizard03 = $this->appraisal_model->wizard_health_audit($get_wizard_num = "appraisal_wiz03_" . $wizard_num, $access = $user_role->level, '', $limit);
//        $data["wiz03"] = $wizard03;
//        if (empty($data["wiz03"]))
//        {
//            $data["wiz03"] = array();
//        }
//        //Get Wizard data (4)
//        $wizard04 = $this->appraisal_model->wizard_health_audit($get_wizard_num = "appraisal_wiz04_" . $wizard_num, $access = $user_role->level, '', $limit);
//        $data["wiz04"] = $wizard04;
//        if (empty($data["wiz04"]))
//        {
//            $data["wiz04"] = array();
//        }
//        //Get Wizard data (5)
//        $wizard05 = $this->appraisal_model->wizard_health_audit($get_wizard_num = "appraisal_wiz05_" . $wizard_num, $access = $user_role->level, '', $limit);
//        $data["wiz05"] = $wizard05;
//        if (empty($data["wiz05"]))
//        {
//            $data["wiz05"] = array();
//        }
//        //Get Wizard data (6)
//        $wizard06 = $this->appraisal_model->wizard_he alth_audit($get_wizard_num = "appraisal_wiz06_" . $wizard_num, $access = $user_role->level, '', $limit);
//        $data["wiz06"] = $wizard06;
//        if (empty($data["wiz06"]))
//        {
//            $data["wiz06"] = array();
//        }


        if (empty($data["wiz01"]) && empty($data["wiz02"]) && empty($data["wiz03"]) &&
                empty($data["wiz04"]) && empty($data["wiz05"]) && empty($data["wiz06"])) {

            $wizard01 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz01_" . $wizard_num, $access = $user_role->level, $auditid, $limit);
            $data["wiz01"] = $wizard01;
            if (empty($data["wiz01"])) {
                $data["wiz01"] = array();
            }
            $data["wiz01"] = json_decode($data["wiz01"]);
            //Get Wizard data (2)
            $wizard02 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz02_" . $wizard_num, $access = $user_role->level, '', $limit);
            $data["wiz02"] = $wizard02;
            if (empty($data["wiz02"])) {
                $data["wiz02"] = array();
            }
            $data["wiz02"] = json_decode($data["wiz02"]);
            //Get Wizard data (3)
            $wizard03 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz03_" . $wizard_num, $access = $user_role->level, '', $limit);
            $data["wiz03"] = $wizard03;
            if (empty($data["wiz03"])) {
                $data["wiz03"] = array();
            }
            $data["wiz03"] = json_decode($data["wiz03"]);
            //Get Wizard data (4)
            $wizard04 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz04_" . $wizard_num, $access = $user_role->level, '', $limit);
            $data["wiz04"] = $wizard04;
            if (empty($data["wiz04"])) {
                $data["wiz04"] = array();
            }
            $data["wiz04"] = json_decode($data["wiz04"]);
            //Get Wizard data (5)
            $wizard05 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz05_" . $wizard_num, $access = $user_role->level, '', $limit);
            $data["wiz05"] = $wizard05;
            if (empty($data["wiz05"])) {
                $data["wiz05"] = array();
            }
            $data["wiz05"] = json_decode($data["wiz05"]);
            //Get Wizard data (6)
            $wizard06 = $this->appraisal_model->wizard_get_new($get_wizard_num = "appraisal_wiz06_" . $wizard_num, $access = $user_role->level, '', $limit);
            $data["wiz06"] = $wizard06;
            if (empty($data["wiz06"])) {
                $data["wiz06"] = array();
            }
            $data["wiz06"] = json_decode($data["wiz06"]);
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "appraisal_wiz01_" . $wizardData->sif;
            $data['appraisal_actions'] = "";
            $currentUserHasAccessToAppraisal = $this->appraisal_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAppraisal) {
                    $data['appraisal_actions'] = "<ul>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Approve") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber, "Reject for Edits") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Escalate") . "</li>";
                    $data['appraisal_actions'] .= "</ul>";
                }
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#appraisal.healthform :input[type=text]',
                    '#appraisal.healthform :input[type=radio]',
                    '#appraisal.healthform :input[type=checkbox]',
            ));
        } elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "appraisal_wiz01_" . $wizardData->sif;
            $data['appraisal_actions'] = "";
            $currentUserHasAccessToAppraisal = $this->appraisal_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['appraisal_actions'] = "<ul>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Save Edits & Approve") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Save Edits & Escalate") . "</li>";
                    $data['appraisal_actions'] .= "</ul>";
                }
            }
        }
        $data["forms"] = "forms_view/print/appraisal/appraisal_history";
        $this->load->view("forms/template", $data);
    }

    public function view_appraisal($unique_sifnumber) {
//        echo $unique_sifnumber;
//        exit;
        // check roles and permissions
        if (!$this->schoolhealth_model->user_has_perm($this->session->userdata("user_id"), "view_forms")) {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // set common properties
        $data["subtitle"] = "New Nursing Appraisal Print Page";
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));

//        $check_wizars_status = $this->assessment_model->check_wizard_status($wizardData->sif);
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
        //Get Wizard data (1)
        $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz01"] = json_decode($wizard01);
        if (empty($data["wiz01"])) {
            $data["wiz01"] = array();
        }
        //Get Wizard data (2)
        $wizard02 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz02_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz02"] = json_decode($wizard02);
        if (empty($data["wiz02"])) {
            $data["wiz02"] = array();
        }
        //Get Wizard data (3)
        $wizard03 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz03_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz03"] = json_decode($wizard03);
        if (empty($data["wiz03"])) {
            $data["wiz03"] = array();
        }
        //Get Wizard data (4)
        $wizard04 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz04_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz04"] = json_decode($wizard04);
        if (empty($data["wiz04"])) {
            $data["wiz04"] = array();
        }
        //Get Wizard data (5)
        $wizard05 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz05_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz05"] = json_decode($wizard05);
        if (empty($data["wiz05"])) {
            $data["wiz05"] = array();
        }
        //Get Wizard data (6)
        $wizard06 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz06_" . $wizardData->sif, $access = $user_role->level, $unique_sifnumber);
        $data["wiz06"] = json_decode($wizard06);
        if (empty($data["wiz06"])) {
            $data["wiz06"] = array();
        }
        // conditionally switch to readonly view
        if (property_exists($wizardData, 'viewOnly') && $wizardData->viewOnly == true) {
            // this option is only available to nurse managers+ and must be activated only for users in their management chain
            // validate that access here
            // this is enough for ViewOnly access to an assessment
            // TODO: support these assessment actions in edit mode
            $wizardNumber = "appraisal_wiz01_" . $wizardData->sif;
            $data['appraisal_actions'] = "";
            $currentUserHasAccessToAppraisal = $this->appraisal_model->validate_user_access($wizardNumber);
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAppraisal) {
                    $data['appraisal_actions'] = "<ul>";
                    if ($user_role->level != NURSE_SUPERVISOR):
                        $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber . "/" . $unique_sifnumber, "Approve") . "</li>";
                    endif;
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/reject/" . $wizardNumber . "/" . $unique_sifnumber, "Reject for Edits") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber . "/" . $unique_sifnumber, "Escalate") . "</li>";
                    $data['appraisal_actions'] .= "</ul>";
                }
            }
            $data['footerData'] = array('readOnlyViewing' => array(
                    '#appraisal.healthform :input[type=text]',
                    '#appraisal.healthform :input[type=radio]',
                    '#appraisal.healthform :input[type=checkbox]',
            ));
        }
        elseif (!$wizardData->viewOnly == true) {
            $wizardNumber = "appraisal_wiz01_" . $wizardData->sif;
            $data['appraisal_actions'] = "";
            $currentUserHasAccessToAppraisal = $this->appraisal_model->validate_user_access($wizardNumber);
            // TODO: what's the hand off, once the action is processed, what happens (redirect)?
            if ($user_role->level != NURSE) {
                if ($currentUserHasAccessToAssessment) {
                    $data['appraisal_actions'] = "<ul>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/approve/" . $wizardNumber, "Save Edits & Approve") . "</li>";
                    $data['appraisal_actions'] .= "<li>" . anchor("access_control/admin/escalate/" . $wizardNumber, "Save Edits & Escalate") . "</li>";
                    $data['appraisal_actions'] .= "</ul>";
                }
            }
        }
        $data["forms"] = "forms_view/print/appraisal/appraisal_view";
        $this->load->view("forms/template", $data);
    }

    public function complete_appraisal() {
        $copy = $this->uri->segment(4);
        $copy_unumber = $this->uri->segment(5);
        $_POST['dob'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('dob'))));
        $_POST['contactattempt1'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->input->post('contactattempt1'))));
        //Add health cate plan
        $newdiagnosis = '';
        foreach ($_POST['newdiagnosis'] as $val) {
            $newdiagnosis .= str_replace('-', '/', $val) . ',';
        }
        $_POST['newdiagnosis'] = $newdiagnosis;
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_form")) {
            redirect("access_control/admin/access_denied/");
        }
        //Add more Emergency plan
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
        // let's grab any saved entry for wizard 1 & 3
        $wizardData = $this->GetWizardData('appraisal_wiz01');
        $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
        if (!empty($new_assigned_unique_number) && !empty($copy) && $copy == "datas") {
            $wizardData->unique_number = $new_assigned_unique_number;
        } else {
            $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
            if (!empty($copy_assigned_unique_number)) {
                $wizardData->unique_number = $copy_assigned_unique_number;
            }
        }
        $copy_assigned_unique_number = $this->session->userdata('copy_assigned_unique_number_appraisal');
//        $data['copy_assigned_unum'] = $copy_assigned_unique_number;
        if (empty($copy_assigned_unique_number)):
            $wizardData->unique_number = $new_assigned_unique_number;
        elseif (!empty($copy_assigned_unique_number) && !empty($copy) && $copy == "datas"):
            $wizardData->unique_number = $new_assigned_unique_number;
        else:
            $wizardData->unique_number = $copy_assigned_unique_number;
        endif;
        if (!empty($wizardData)) {
            $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            if (empty($wizard01)):
                $wizardData->unique_number = $this->session->userdata('unique_number_appraisal');
                $wizard01 = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizardData->unique_number);
            endif;
            $data['sif_num'] = $wizardData->sif;
            $wizard1Obj = json_decode($wizard01);
            // if wizarddata is posted, collect the data and save it
            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                // collect any post data from wizard 2
                $previousWizardData1 = $this->input->post(NULL, TRUE);
                $previousWizardData2 = array(
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
                    'newplanname' => $newpalnname
                );
                $previousWizardData = array_merge($previousWizardData1, $previousWizardData2);
                $previousWizardData['wizard'] = "06";
                $array2json = json_encode($previousWizardData);
                $wizard_data = array(
                    'wizard_by' => $this->session->userdata("username"),
                    'direct_report' => $this->user_manager(),
                    'form_type' => 'Appraisal',
                    'wizard_num' => 'appraisal_wiz06_' . $wizard1Obj->sif,
                    'wizard_data' => $array2json,
                    'wizard_status' => IN_PROGRESS,
                    'wizard_sif_num' => $wizard1Obj->sif,
                    'wizard_state_num' => $wizard1Obj->{'confirmstatenum'},
                    'first_name' => $wizard1Obj->{'fname'},
                    'is_completed' => 1,
                    'last_name' => $wizard1Obj->{'lname'},
                    'student_school' => $wizard1Obj->{'school'},
                    'birth_date' => $wizard1Obj->{'dob'}
                );


                $new_assigned_unique_number = $this->session->userdata('unique_number_appraisal');
                if (!empty($new_assigned_unique_number)) {
                    $wizard_data['unique_number'] = $new_assigned_unique_number;
                    $wizard_details = $this->appraisal_model->wizard_get($get_wizard_num = "appraisal_wiz01_" . $wizardData->sif, $access = $user_role->level, $wizard_data['unique_number']);
                    $obj2 = json_decode($wizard_details);
                    $wizard_data['first_name'] = $obj2->{'fname'};
                    $wizard_data['last_name'] = $obj2->{'lname'};
                }
                // check if save & exit was submitted
                if (isset($_POST['appraisal_save'])) {
                    // only save wiz01 if we have post data (not when we are returning from wiz03
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz06_" . $wizard1Obj->sif);
                    //For delete the session record for edit section
                    $wiznum = $wizardData->{'sif'};
                    $sql = $this->assessment_model->delete_autosave();
                    $this->adminui_model->delete_record($wiznum);
                    //unset sif number in session
                    $this->session->unset_userdata('sifnumberval');
                    $this->session->unset_userdata('unique_number_appraisal'); // Unset the unique number here
                    // after posting data, redirect to logout
                    redirect("search/student_search");
                } elseif ($_POST['appraisal6']) {
                    $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz06_" . $wizard1Obj->sif);
                }
//                $this->appraisal_model->wizard_post($wizard_data, $wizard_num = "appraisal_wiz06_" . $wizard1Obj->sif);
                //For delete the session record for edit section
                $wiznum = $wizardData->{'sif'};
                $sql = $this->assessment_model->delete_autosave();
                $this->adminui_model->delete_record($wiznum);
                //unset sif number in session
                $this->session->unset_userdata('sifnumberval');
//                $this->session->unset_userdata('unique_number_appraisal'); // Unset the unique number here
                $this->session->unset_userdata('copy_assigned_unique_number_appraisal'); // Unset the unique number here
            }
        }
        $data['unuque_number'] = $this->session->userdata('unique_number_appraisal');
        $reviewvalue = $this->session->userdata('reviewappraisal');
        //Approve Link click
        if (!empty($reviewvalue) && $this->uri->segment(4) <> "" && $this->uri->segment(5) <> ""):
            $sifval = $this->uri->segment(4);
            $unumberval = $this->uri->segment(5);
        else:
            $sifval = $this->input->post('sif');
            $unumberval = $data['unuque_number'];
        endif;
        $data['forminfo'] = $this->assessment_model->get_form_details_appraisal($sifval, $unumberval);
//        echo '<pre>';
//        print_r($data['forminfo']);
//        exit;
        // set common properties
        $data["subtitle"] = "New Health Appraisal";
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
        $data['sif_num'] = $this->input->post('sif');

        $data["forms"] = "forms_view/appraisal/appraisal_complete";
        $data["search_action"] = site_url("search/student_search/find_student");
        // load view
        $this->load->view("forms/template", $data);
    }

    public function appraisal_complete_form() {
        $sif = $this->uri->segment(4);
        $unum = $this->uri->segment(5);
        $wiznum = 'appraisal_wiz01_' . $sif;
//        $status = $this->assessment_model->complete_status_update_appraisal($sif, $unum);
        redirect("access_control/admin/approve/" . $wiznum . "/" . $unum . "/back");
    }

}
