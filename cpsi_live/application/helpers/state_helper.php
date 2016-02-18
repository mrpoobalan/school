<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * State Dropdown
 *
 * Returns HTML for a dropdown filled with state information
 *
 * @access public
 * @param string $name     Value of <select>'s name attribute
 * @param string $selected Value of <option> to be selected
 * @param string $id       Value of <select>'s id attribute (optional)
 * @param string $class    Value of <select>'s class attribute (optional)
 * @return string
 */
if (!function_exists('state_dropdown')) {

    function state_dropdown($name = 'state', $selected = NULL, $id = NULL, $class = NULL) {
        $CI = & get_instance();

        $CI->load->helper('form');

        $state_list = state_array();

        $extra = '';
        if (!is_null($id)) {
            $extra .= 'id="' . $id . '" ';
        }
        if (!is_null($class)) {
            $extra .= 'class="' . $class . '" ';
        }
        $extra = substr($extra, 0, -1);

        return form_dropdown($name, $state_list, $selected, $extra);
    }

}

/**
 * Convert from abbreviation
 *
 * Convert a state abbreviation to the full state name
 *
 * @access public
 * @param string $abbr Two-letter abbreviation
 * @return string
 */
if (!function_exists('abbr_to_name')) {

    function abbr_to_name($abbr) {
        $state_list = state_array();
        $abbr = strtoupper($abbr);

        return isset($state_list[$abbr]) ? $state_list[$abbr] : FALSE;
    }

}

/**
 * Convert to abbreviation
 *
 * Convert a full state name to the state abbreviation
 *
 * @access public
 * @param  string $name States full name
 * @return string/boolean Returns FALSE when not found
 */
if (!function_exists('name_to_abbr')) {

    function name_to_abbr($name) {
        $state_list = state_array();
        $camel_name = ucwords(strtolower($name));

        return array_search($camel_name, $state_list);
    }

}

/**
 * Check for valid state
 *
 * Check to see if a provided state exists
 *
 * @access public
 * @param  string $str Two-letter abbreviation OR full state name
 * @return boolean
 */
if (!function_exists('is_valid_state')) {

    function is_valid_state($str) {
        $state_list = state_array();
        $camel_str = ucwords(strtolower($str));

        return array_key_exists($str, $state_list) || in_array($camel_str, $state_list);
    }

}

/**
 * State array
 *
 * Return an array of states with their abbreviation as the key
 *
 * @access public
 * @return string
 */
if (!function_exists('get_states')) {

    function state_array() {
        $state_list = array(
            'AL' => 'Alabama',
            'AK' => 'Alaska',
            'AZ' => 'Arizona',
            'AR' => 'Arkansas',
            'CA' => 'California',
            'CO' => 'Colorado',
            'CT' => 'Connecticut',
            'DE' => 'Delaware',
            'DC' => 'District Of Columbia',
            'FL' => 'Florida',
            'GA' => 'Georgia',
            'HI' => 'Hawaii',
            'ID' => 'Idaho',
            'IL' => 'Illinois',
            'IN' => 'Indiana',
            'IA' => 'Iowa',
            'KS' => 'Kansas',
            'KY' => 'Kentucky',
            'LA' => 'Louisiana',
            'ME' => 'Maine',
            'MD' => 'Maryland',
            'MA' => 'Massachusetts',
            'MI' => 'Michigan',
            'MN' => 'Minnesota',
            'MS' => 'Mississippi',
            'MO' => 'Missouri',
            'MT' => 'Montana',
            'NE' => 'Nebraska',
            'NV' => 'Nevada',
            'NH' => 'New Hampshire',
            'NJ' => 'New Jersey',
            'NM' => 'New Mexico',
            'NY' => 'New York',
            'NC' => 'North Carolina',
            'ND' => 'North Dakota',
            'OH' => 'Ohio',
            'OK' => 'Oklahoma',
            'OR' => 'Oregon',
            'PA' => 'Pennsylvania',
            'RI' => 'Rhode Island',
            'SC' => 'South Carolina',
            'SD' => 'South Dakota',
            'TN' => 'Tennessee',
            'TX' => 'Texas',
            'UT' => 'Utah',
            'VT' => 'Vermont',
            'VA' => 'Virginia',
            'WA' => 'Washington',
            'WV' => 'West Virginia',
            'WI' => 'Wisconsin',
            'WY' => 'Wyoming'
        );

        return $state_list;
    }

}

function get_last_name($sif) {
    $res = '';
    $CI = & get_instance();

    $unum = $CI->uri->segment(4);
    $sifunum = end(explode("-", $unum));
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select first_name,last_name from form_sessions where wizard_sif_num = '" . $sif . "' and unique_number = '" . $sifunum . "'");
        $res = $sql->row_array();
//        echo "<pre>";
//        print_r($res);
//        exit;
//        echo $CI->db->last_query();
        return $res;
    endif;
}

function get_last_name_view($sif) {
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(4);
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select first_name,last_name from form_sessions where wizard_sif_num = '" . $sif . "' and unique_number = '" . $sifunum . "'");
        $res = $sql->row_array();
        // echo $CI->db->last_query();
        return $res;
    endif;
}

function check_form_status($sif) {
    if (!empty($sif) && strlen($sif) == 5):
        $sif = "0" . $sif;
    endif;
    $sifnum = 'assessment_wiz16_' . $sif;
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(4);
    $unum = end(explode('-', $sifunum));
    $sifunum = (is_numeric($sifunum)) ? $sifunum : $unum;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");
        $res = $sql->row_array();
        return $res;
    endif;
}

function check_form_status_firstrow($sif) {

    if (!empty($sif) && strlen($sif) == 5):
        $sif = "0" . $sif;
    endif;
    $sifnum = 'assessment_wiz01_' . $sif;
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(4);
    $unum = end(explode('-', $sifunum));
    $sifunum = (is_numeric($sifunum)) ? $sifunum : $unum;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");
//        echo $CI->db->last_query();
//        exit;
        $res = $sql->row_array();
        return $res;
    endif;
}

function check_created_assessment($sif) {

    if (!empty($sif) && strlen($sif) == 5):
        $sif = "0" . $sif;
    endif;
    $sifnum = 'assessment_wiz01_' . $sif;
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(4);
    $unum = end(explode('-', $sifunum));
    $sifunum = (is_numeric($sifunum)) ? $sifunum : $unum;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select wizard_by from form_sessions_audit where wizard_num = '$sifnum' and unique_number = $sifunum
            ORDER BY audit_id ASC ");
        $res = $sql->row_array();
        // echo $CI->db->last_query();
        return $res;
    endif;
}

function check_form_status_resubmit($sif) {
    $sifnum = 'assessment_wiz16_' . $sif;
    $res = '';
    $CI = & get_instance();
    $unum = $CI->session->userdata('resubmit_unique_number');
    $sql = $CI->db->query("select wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $unum ORDER BY wizard_modified DESC ");
    $res = $sql->row_array();
    return $res;
}

//Assessment History
function check_form_status_history($sif) {
    if (!empty($sif) && strlen($sif) == 5):
        $sif = "0" . $sif;
    endif;
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(7);
    $sifunum = end(explode('-', $sifunum));
    $sifnum = 'assessment_wiz16_' . $sif;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select first_name,last_name,student_school,birth_date,form_type,wizard_created,wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");
        $res = $sql->row_array();
        return $res;
    endif;
}

function check_form_status_history_firstrow($sif) {
    if (!empty($sif) && strlen($sif) == 5):
        $sif = "0" . $sif;
    endif;
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(7);
    $sifunum = end(explode('-', $sifunum));
    $sifnum = 'assessment_wiz01_' . $sif;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select first_name,last_name,student_school,birth_date,form_type,wizard_created,wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");
//        echo $CI->db->last_query();
//        exit;
        $res = $sql->row_array();
        return $res;
    endif;
}

//Appraisl History
function check_app_form_status_history($sif) {

    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(7);
    $sifunum = end(explode('-', $sifunum));
    $sifnum = 'appraisal_wiz06_' . $sif;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select first_name,last_name,student_school,birth_date,form_type,wizard_created,wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");
        $res = $sql->row_array();
        return $res;
    endif;
}

function check_app_form_status_history_firstrow($sif) {

    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(7);
    $sifunum = end(explode('-', $sifunum));
    $sifnum = 'appraisal_wiz01_' . $sif;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select first_name,last_name,student_school,birth_date,form_type,wizard_created,wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");
        $res = $sql->row_array();
        return $res;
    endif;
}

function count_form_sessions($sif) {
    $CI = & get_instance();
    $sql = $CI->db->query("select unique_number from form_sessions where wizard_sif_num = '" . $sif . "' ORDER BY unique_number DESC ");
    $res = $sql->row_array();
    if ($sql->num_rows()):
        return $res['unique_number'];
    else:
        return FALSE;
    endif;
}

function check_form_details($sif = NULL) {

    $sifnum = 'appraisal_wiz06_' . $sif;
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(4);
    $unum = end(explode('-', $sifunum));
    $sifunum = (is_numeric($sifunum)) ? $sifunum : $unum;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");
        $res = $sql->row_array();
        return $res;
    endif;
}

function check_form_details_firstrow($sif) {
    $sifnum = 'appraisal_wiz01_' . $sif;
    $res = '';
    $CI = & get_instance();
    $sifunum = $CI->uri->segment(4);
    $unum = end(explode('-', $sifunum));
    $sifunum = (is_numeric($sifunum)) ? $sifunum : $unum;
    if ($sifunum <> "" && $sifunum <> "datas" && $sifunum <> "clear" && $sifunum <> "copy"):
        $sql = $CI->db->query("select wizard_by,wizard_status,wizard_modified from form_sessions where wizard_num = '$sifnum' and unique_number = $sifunum ORDER BY wizard_modified DESC ");

        $res = $sql->row_array();
        return $res;
    endif;
}

function get_fullname($username) {
    $CI = & get_instance();
    $uname = "";
    $uname = $CI->uri->segment(6);
    if (!empty($uname)):
        $uname = str_replace("_", " ", $uname);
    endif;
    $usernamevalue = (!empty($uname) && $uname != 'reload') ? $uname : $username;
    $sql = $CI->db->query("select first_name,last_name from admin_user where username = '$usernamevalue' ");
    $res = $sql->row_array();
    return $res;
}

function get_fullname_history() {
    $CI = & get_instance();
    $username = str_replace("_", " ", $CI->uri->segment(9));
    $sql = $CI->db->query("select first_name,last_name from admin_user where username = '$username' ");
//    echo $CI->db->last_query();
//    exit;
    $res = $sql->row_array();
    return $res;
}

// get user role
function check_user_role($acct_id) {
    $role = '';
    $CI = & get_instance();
    $CI->db->select("*")
            ->from("user_role")
            ->where("admin_user.user_id", $acct_id)
            ->join("role", 'role.role_id = user_role.role_id', "inner")
            ->join("admin_user", 'admin_user.user_id = user_role.user_id', "inner");
    $role = $CI->db->get();
    return ($role->num_rows() > 0) ? $role->row() : FALSE;
}

?>
