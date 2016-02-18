<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Appraisal Model
 *
 * @package Appraisal Model
 * @author Patrick K. Johnson Jr.
 * @link http://avizium.com/
 * @version 2.0.0-pre
 */
class Appraisal_model extends CI_model {

    /**
     * acl config shortcut
     *
     * @var object
     */
    private $_config;
    private $admin_user = "admin_user";
    private $admin_request = "admin_request";
    private $request_assistance = "request_assistance";
    private $role_manager = "role";
    private $students = "student_lookup";
    private $schooltype = "schooltypes";
    private $schools = "schools";
    private $appraisal_tbl = "Assessments";
    private $appraisal_wiz01 = "appraisal_wiz01";
    private $appraisal_wiz02 = "appraisal_wiz02";
    private $appraisal_wiz03 = "appraisal_wiz03";
    private $appraisal_wiz04 = "appraisal_wiz04";
    private $appraisal_wiz05 = "appraisal_wiz05";
    private $appraisal_wiz06 = "appraisal_wiz06";
    private $form_sessions = "form_sessions";

    /**
     * constructor
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->_config = (object) $this->config->item("acl");
        $this->db = $this->load->database("default", TRUE);

        $this->load->model("adminui_model", "", TRUE);
    }

    /*
      | -------------------------------------------------------------------
      |  user specific methods
      | -------------------------------------------------------------------
     */

    /**
     * get all users details
     *
     * @return	array	an array of CodeIgniter row objects for user
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    //public function get_all_users() {
    //$users = $this->db->get($this->_config->table["admin_user"]);
    //return ($users->num_rows() > 0) ? $users->result() : FALSE;
    //}

    /**
     * STEP 1 methods
     * All getters and setters for step one
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     */
    public function wizard_post($wizard_data, $wizard_num)
    {
        $unique_number = $wizard_data['unique_number'];
        $this->db->where("wizard_num", $wizard_num);
        $this->db->where("unique_number", $unique_number);
        $query = $this->db->get($this->form_sessions);
        if ($query->row("wizard_num") == $wizard_num)
        {
            $this->db->where("wizard_num", $wizard_num);
            $this->db->where("unique_number", $unique_number);
            $version = array('wizard_modified' => date("Y-m-d H:i:s"));
            $data_update = $this->db->update($this->form_sessions, $wizard_data);
            return array($data_update, $ver_update);
        }
        else
        {
            $version = array(
                'wizard_created' => date("Y-m-d H:i:s"),
                'wizard_modified' => date("Y-m-d H:i:s")
            );
            $initial_post = $this->db->insert($this->form_sessions, $wizard_data);
            $this->db->where("wizard_by", $this->session->userdata("username"));
            $this->db->where("wizard_num", $wizard_num);
            $this->db->where("unique_number", $unique_number);
            $initial_ver = $this->db->update($this->form_sessions, $version);
            return array($initial_post);
        }
    }

    public function wizard_get($get_wizard_num, $access, $unique_number)
    {
        $this->db->select("wizard_data");
        $this->db->where("wizard_num", $get_wizard_num);
        $this->db->where("unique_number", $unique_number);
        if ($get_wizard_num == PENDING)
        {
            $this->db->where("wizard_status", PENDING);
        }
        $query = $this->db->get($this->form_sessions);
        if ($query->num_rows() > 0)
        {
            return $query->row("wizard_data");
        }
    }

    // TODO: move this to adminui_model (it seems like a more appropriate location)
    public function get_user_management_chain($userID, $limitToUserID = null, $includeSelf = true, $limit = null, $offset = null, $isAdminUser = false)
    {
        // this is the user management chain (including the current user)
        $parameters = array();
        // check if the user is an admin, if so, simply return all users
        if ($isAdminUser)
        {
            $sql = "select au.*,r.role_id, r.name as roleName, r.description as roleDescription
					from admin_user au inner join user_role ur on au.user_id=ur.user_id
					inner join role r on r.role_id = ur.role_id
					left join user_manager um on um.manage_id=au.user_id";
        }
        else
        {
            $sql = "select au.*,r.role_id, r.name as roleName, r.description as roleDescription
					from admin_user au inner join user_role ur on au.user_id=ur.user_id
					inner join role r on r.role_id = ur.role_id
					left join user_manager um on um.manage_id=au.user_id
			
					where au.user_id in (
					select manage_id from user_manager where manage_by=?
					union
					select manage_id from user_manager where manage_by in (select manage_id from user_manager where manage_by=?)
				)";
            # setup the parameters
            $parameters = array((int) $userID, (int) $userID);
        }
        $userLimiter = $userID;
        if ($limitToUserID != null)
        {
            $userLimiter = $limitToUserID;
            $sql .= " and au.user_id=?";
            $parameters[] = (int) $userLimiter;
        }
        elseif ($includeSelf)
        {
            $sql .= " or au.user_id=?";
            $parameters[] = (int) $userLimiter;
        }
        # conditionally impose paging (in case we are expecting a big dataset)
        // TODO: shift to active record
        if ($limit != null)
        {
            $sql .= " limit ?,?";
            $parameters[] = (int) $offset;
            $parameters[] = (int) $limit;
        }
        $query = $this->db->query($sql, $parameters);
        return $query->result();
    }

    // get a list of users within the management chain of the currently logged in user
    // TODO: verify managed users
    public function get_managed_users($admin_user_field_name, $limitToUserID = null)
    {
        $userId = $this->session->userdata("user_id");
        $recs = $this->get_user_management_chain($userId, $limitToUserID);
        $managedUsers = array();
        foreach ($recs as $record)
        {
            $managedUsers[] = $record->{$admin_user_field_name};
        }

        return $managedUsers;
    }

    // this function validates a user access to the specific wizard
    // basically it is intended to verify that the user can view/edit/approve/reject/escalate a submitted assessment
    public function validate_user_access($wizard_num)
    {
        // assume the current user doesn't have access to the workflow actions for this wizard
        $validated = false;
        // 1. get the creator of the assessment
        $query = $this->db->select('*')->where("wizard_num", $wizard_num)->get($this->form_sessions);
        if ($query->num_rows() > 0)
        {
            // we have some data (ideally, we should get only one)
            $results = $query->result();
            $wizard_by = $results[0]->wizard_by;
            // 2. determine if the ID of that user is within the management chain of the currently logged in user
            $managedUsers = $this->get_managed_users($admin_user_field_name = 'username');
            $validated = in_array($wizard_by, $managedUsers);
        }
        return $validated;
    }

    public function get_form_status()
    {
        // search form session for form status
        $this->db->where("wizard_by", $this->session->userdata("username"));
        $query = $this->db->get($this->form_sessions);
        if ($query->num_rows() > 0)
        {
            return $query->row("wizard_status");
        }
    }

    public function pretty_print($post_array)
    {
        $post = array();
        foreach ($post_array as $key => $value)
        {
            echo $key . "&nbsp;&nbsp;=>&nbsp;&nbsp;" . $this->input->post($key) . "<br>";
        }
    }

    public function pretty_post($post_array)
    {
        foreach ($post_array as $key => $value)
        {
            echo "'$key'=>\$this->input->post(\"$key\"), <br>";
        }
    }

    public function print_post_keys($post_array)
    {
        foreach ($post_array as $key => $value)
        {
            echo $key . " ";
        }
    }

    public function convert_array($arr)
    {
        $mod_arr = array();
        foreach ($arr as $key => $value)
        {
            if (is_array($value))
            {
                $mod_arr[$key] = implode(",", $value);
            }
            else
            {
                $mod_arr[$key] = $value;
            }
        }
        return $mod_arr;
    }

    /*
     * Get the view dettails against data and user id
     */

    public function wizard_get_new($get_wizard_num, $access, $unique_number=null)
    {
        $unique_number = $this->uri->segment(4);
        $unum = end(explode('-', $unique_number));
        $wizard_date = $this->uri->segment(5);
        $wizby = $this->uri->segment(6);
         if(is_numeric($wizard_date)):
            $unum = $this->uri->segment(7);
            $wizard_date = $this->uri->segment(8);
            $wizby = $this->uri->segment(9);
        endif;
        $wizard_by = str_replace("_", " ", $wizby);
        $this->db->where("wizard_num", $get_wizard_num);
        $this->db->where("unique_number", $unum);
        $this->db->where("DATE_FORMAT(wizard_modified, '%m-%d-%y') = '$wizard_date'");
        $this->db->where('wizard_by', $wizard_by);
        if (empty($access)):
            $this->db->where("wizard_id", $this->session->userdata('wizardid'));
        endif;
        if ($get_wizard_num == PENDING)
        {
            $this->db->where("wizard_status", PENDING);
        }
        $this->db->order_by("audit_id", 'desc');
        $this->db->limit(1);
        $query = $this->db->get('form_sessions_audit');
//        echo $this->db->last_query();
//        exit;
        if ($query->num_rows() > 0)
        {
            $res = array();
            $array1 = $query->row("wizard_data");
            $array1 = json_decode($array1);
            $array1 = json_decode(json_encode($array1), true);
            $array2 = array('sif' => $query->row('wizard_sif_num'));
            $array_merge = array_merge($array1, $array2);
            $res = json_encode($array_merge);
            return $res;
        }
        else
        {
            return FALSE;
        }
    }

    //Health appraisal

    public function wizard_health_audit($get_wizard_num, $access, $auditid, $limit)
    {
        $unique_sif = $this->uri->segment(7);
        $current_date = $this->uri->segment(8);
        $wizard_by = str_replace("_", " ", $this->uri->segment(9));
        $pre_date = $this->uri->segment(10);
        $pre_wizard_by = str_replace("_", " ", $this->uri->segment(11));
        //GET insert data
        $operation1 = "insert";
        $operation2 = "Update";
        if (!empty($pre_date) && !empty($pre_wizard_by))
        {
            $this->db->select('*');
            $this->db->from('form_sessions_audit');
            $this->db->where('wizard_num', $get_wizard_num);
            $this->db->where('unique_number', $unique_sif);
            $this->db->where("DATE_FORMAT(wizard_modified, '%m-%d-%y') = '$pre_date'");
            $this->db->where('wizard_by', $pre_wizard_by);
            $this->db->order_by('audit_id', 'DESC');
            $this->db->limit(1);
            $sql = $this->db->get();
            $pre_date_result = $sql->row_array();
            $pre_date_result = json_decode($pre_date_result['wizard_data']);
            $pre_date_result = $this->convert_array($pre_date_result);
        }
        $this->db->select('*');
        $this->db->from('form_sessions_audit');
        $this->db->where('wizard_num', $get_wizard_num);
        $this->db->where('unique_number', $unique_sif);
        $this->db->order_by('audit_id', 'asc');
        $this->db->limit(1);
        $sql = $this->db->get();
        $pre_result = $sql->row_array();
        //Json value decode here
        $pre_result = json_decode($pre_result['wizard_data']);
        $pre_result = $this->convert_array($pre_result);
        //Compare the result here
        $result_to_compare = (!empty($pre_date) && !empty($pre_wizard_by)) ? $this->check_with_keys($pre_date_result, $pre_result, array()) : $pre_result;
        $this->db->select('*');
        $this->db->from('form_sessions_audit');
        $this->db->where('wizard_num', $get_wizard_num);
        $this->db->where('unique_number', $unique_sif);
        $this->db->where("DATE_FORMAT(wizard_modified, '%m-%d-%y') = '$current_date'");
        $this->db->where('wizard_by', $wizard_by);
        $this->db->order_by('audit_id', 'asc');
        $sql = $this->db->get();
        //Get the count 
        $count = $sql->num_rows;
        if ($count >= 1):
            $result = $sql->result_array();
            $pre_array = array();
            $orgdata = array();
            foreach ($result as $res)
            {
                if (!empty($pre_result))
                {
                    $obj = json_decode($res['wizard_data']);
                    $resarray = json_decode(json_encode($obj), true);
                    $resarray = $this->convert_array($resarray);
                    $res_arr = $this->check_with_keys($resarray, $pre_result, $orgdata);
                    $pre_result = $resarray;
                    //Delete the json value
                    unset($res['wizard_data']);
                    $orgdata = $res_arr;
                }
            }
        else:
            $orgdata = array();
        endif;
        //Check value with keys 
        $orgdata = $this->check_with_keys($orgdata, $result_to_compare, array());
        $orgdata = json_decode(json_encode($orgdata), FALSE);
        return $orgdata;
    }

    public function check_with_keys($arr1, $arr2, $orgdata)
    {
        foreach ($arr1 as $key => $value)
        {
            if ($arr1[$key] != $arr2[$key])
            {
                $val_arr = explode(",", $arr1[$key]);
                $orgdata[$key] = (count($val_arr) > 1) ? $val_arr : $arr1[$key];
            }
        }
        return $orgdata;
    }

}

/* End of file acl_model.php */
/* Location: ./application/models/acl_model.php */