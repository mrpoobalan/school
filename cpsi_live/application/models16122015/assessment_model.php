<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * APIv2 SchoolHealth Model
 *
 * @package AdminAccess Model
 * @author Patrick K. Johnson Jr.
 * @link http://avizium.com/
 * @version 2.0.0-pre
 */
class Assessment_model extends CI_model {

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
    private $students = "form_sessions";
    private $schooltype = "schooltypes";
    private $sif = "123456";
    private $schools = "schools";
    private $assessment_tbl = "Assessments";
    private $assessment_wiz01 = "assessment_wiz01";
    private $assessment_wiz02 = "assessment_wiz02";
    private $assessment_wiz03 = "assessment_wiz03";
    private $assessment_wiz04 = "assessment_wiz04";
    private $assessment_wiz05 = "assessment_wiz05";
    private $assessment_wiz06 = "assessment_wiz06";
    private $assessment_wiz07 = "assessment_wiz07";
    private $assessment_wiz08 = "assessment_wiz08";
    private $assessment_wiz09 = "assessment_wiz09";
    private $assessment_wiz10 = "assessment_wiz10";
    private $assessment_wiz11 = "assessment_wiz11";
    private $assessment_wiz12 = "assessment_wiz12";
    private $assessment_wiz13 = "assessment_wiz13";
    private $assessment_wiz14 = "assessment_wiz14";
    private $assessment_wiz15 = "assessment_wiz15";
    private $assessment_wiz16 = "assessment_wiz16";
    private $form_sessions = "form_sessions";
    private $status_types = "status_types";
    private $assessment_comments = "assessment_comments";

    /**
     * constructor
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->_config = (object) $this->config->item("acl");
        $this->db = $this->load->database("default", TRUE);
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
    /**
     * STEP 1 methods
     * All getters and setters for step one
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     */

    /**
     * 
     * Get nurse supervisor id and email
     */
    public function get_nursehead_mail($userid)
    {
        //Get nurse supervisor Id here
        $query = $this->db->select('manage_by')
                ->from('user_manager')
                ->where('manage_id', $userid)
                ->get();
        $exe = $query->row_array();
        $supervisid = $exe['manage_by'];
        //Get Nurse Supervisor mail 
        $query = $this->db->select('*')
                ->from('admin_user')
                ->where('user_id', $supervisid)
                ->get();
        $res = $query->row_array();
        $rows = $query->num_rows();
        if ($rows >= 1):
            return $res;
        else:
            return False;
        endif;
    }

    public function check_exists_value($sif)
    {
        $sel = $this->db->query("select count(*) as counts from form_sessions where wizard_sif_num = '" . $sif . "'");
        $res = $sel->row_array();
        if ($res['counts'] >= 1)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function prep_db_id($user_id)
    {
        // Insert this id into all relevant tables...
        $tables = $this->db->list_tables();
        foreach ($tables as $table)
        {
            if ($this->db->field_exists('sif', $table))
            {
                echo " TABLENAME " . $table . " has SIF <br>";
            }
        }
    }

    public function get_paged_list($limit = null, $offset = 0)
    {
        $this->db->order_by("form_type", "asc");
        $this->db->where("wizard_by", $this->session->userdata("username"));
        return $this->db->get($this->form_sessions, $limit, $offset);
    }

    // TODO: move this to adminui_model (it seems like a more appropriate location)
    public function get_user_management_chain($userID, $limitToUserID = null, $includeSelf = true, $limit = null, $offset = null, $isAdminUser = false)
    {
        if ($limitToUserID == "particulars"):
            $limitToUserID = "";
        endif;
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
        //Order By ID
        $sql .= " order by au.user_id DESC";
        $query = $this->db->query($sql, $parameters);
//        echo $this->db->last_query();
//        exit;
        return $query->result();
    }

    // For total count
    public function get_user_management_count($userID, $limitToUserID = null, $includeSelf = true, $limit = null, $offset = null, $isAdminUser = false)
    {
        // this is the user management chain (including the current user)
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
        $querycount = $this->db->query($sql, $parameters);
        $count = $querycount->num_rows();
        return $count;
    }

    public function get_forms_awaiting($limit = null, $offset = 0, $limitToUserID = null, $user_role, $highername)
    {

//        echo "<pre>";
//        print_r($user_id);
//        echo "</pre>";
//        exit;
        // this limits the waiting forms to only those made by the user
        // this needs to be driven by the acl requirements instead
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $flip = array_flip($managedUsers);
        $nur = ucwords($this->session->userdata('username'));
//        if (in_array($nur, $flip)):
////            unset($flip[$nur]);
//        endif;

        $managedUserList_new = array_flip($flip);
        $managedUserList = "'" . implode("','", $managedUserList_new) . "'";
        if ($user_role == 50):
            $managedUserList = $managedUsers[0];
        endif;
        if ($user_role == 40)
        {
            $status = '15,35,25';
        }
        if ($user_role == 30)
        {
            $status = 35;
        }
        if ($user_role == 50)
        {
            $status = '25,5';
        }

        if ($user_role < 30)
        {
            $status = '5,15,25,35,45';
        }


        // this is the user management chain (including the current user)
        if ($user_role <> 50):
            $sql = "SELECT * FROM form_sessions where wizard_by in (" . $managedUserList . ",'" . $highername . "') AND wizard_status in (" . $status . ") group by wizard_sif_num,unique_number  order by wizard_created DESC ";

//             $sql = "SELECT * FROM form_sessions AS A
//                    LEFT JOIN assessment_comments AS B ON B.sif = A.wizard_sif_num
//                    where A.wizard_by in (" . $managedUserList . "," . $highername . ") AND A.wizard_status in (" . $status . ") 
//                        group by A.wizard_sif_num,A.unique_number order by A.wizard_created DESC ";


        else:
            if (!empty($managedUserList)):
                $sql = "SELECT * FROM form_sessions AS A
                    LEFT JOIN assessment_comments AS B ON B.sif = A.wizard_sif_num
                    where A.wizard_by in ('" . $managedUserList . "','" . $highername . "') AND A.wizard_status in (" . $status . ") 
                        group by A.wizard_sif_num,A.unique_number order by A.wizard_created DESC ";
            else:
                $sql = "SELECT * FROM form_sessions AS A
                    LEFT JOIN assessment_comments AS B ON B.sif = A.wizard_sif_num
                        group by A.wizard_sif_num,A.unique_number order by A.wizard_created DESC ";
            endif;
            

        endif;

        $query = $this->db->query($sql, array((int) $offset, (int) $limit));
        
//        echo $this->db->last_query();
//        exit;

        return $query->result();
    }

    public function get_forms_awaiting_selected($limit = null, $offset = 0, $limitToUserID = null, $user_role)
    {
        // this limits the waiting forms to only those made by the user
        // this needs to be driven by the acl requirements instead
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $flip = array_flip($managedUsers);
        $nur = $this->session->userdata('username');
        if (in_array($nur, $managedUsers)):
            unset($flip[$nur]);
        endif;
        $managedUserList_new = array_flip($flip);
        $managedUserList = "'" . implode("','", $managedUserList_new) . "'";
        if ($user_role == 40)
        {
            $status = 15;
        }
        if ($user_role == 30)
        {
            $status = 35;
        }
        if ($user_role == 50)
        {
            $status = '5 or wizard_status = 25';
        }
        // this is the user management chain (including the current user)
        $sql = "SELECT * FROM form_sessions where wizard_by in (" . $managedUserList . ") AND wizard_status = $status group by wizard_sif_num  order by wizard_id DESC limit ?, ?";
        $query = $this->db->query($sql, array((int) $offset, (int) $limit));
        return $query->result();
    }

    public function get_forms_totcount($limit = 10, $offset = 0, $limitToUserID = null, $status = NULL, $access = NULL)
    {
        // this limits the waiting forms to only those made by the user
        // this needs to be driven by the acl requirements instead
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $managedUserList = "'" . implode("','", $managedUsers) . "'";
        // this is the user management chain (including the current user)
        if ($access <> "nurse")
        {
            $sql = "SELECT max(wizard_status) as wizstatus FROM form_sessions where wizard_by in (" . $managedUserList . ")  group by wizard_sif_num order by wizard_id DESC";
        }
        else
        {
            $sql = "SELECT max(wizard_status) as wizstatus FROM form_sessions where wizard_by in (" . $managedUserList . ")  group by wizard_sif_num order by wizard_id DESC";
        }
        $query = $this->db->query($sql);
        $res = $query->result_array();
        $counts = 0;
        foreach ($res as $key => $val)
        {
            if ($access == "nurse")
            {
                if ($val['wizstatus'] == 5 || $val['wizstatus'] == 25)
                {
                    $counts++;
                }
            }
            elseif ($access == "sup_nurse")
            {
                if ($val['wizstatus'] == 15)
                {
                    $counts++;
                }
            }
            elseif ($access == "program_manager")
            {
                if ($val['wizstatus'] == 35)
                {
                    $counts++;
                }
            }
        }
        $totcount = $counts;
        return $totcount;
    }

    public function get_forms_count($limit = 10, $offset = 0, $limitToUserID = null)
    {
        // this limits the waiting forms to only those made by the user
        // this needs to be driven by the acl requirements instead
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $managedUserList = "'" . implode("','", $managedUsers) . "'";
        // this is the user management chain (including the current user)
        $sql = "SELECT * FROM form_sessions where wizard_by in (" . $managedUserList . ") group by wizard_sif_num,wizard_by order by wizard_id DESC ";
        $query = $this->db->query($sql, array((int) $offset, (int) $limit));
        return $query->result();
    }

    public function get_users_count($limit = 10, $offset = 0, $limitToUserID = null)
    {
        // this limits the waiting forms to only those made by the user
        // this needs to be driven by the acl requirements instead
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $managedUserList = "'" . implode("','", $managedUsers) . "'";
        // this is the user management chain (including the current user)
        $sql = "SELECT * FROM form_sessions where wizard_by in (" . $managedUserList . ") group by wizard_sif_num,wizard_by order by wizard_id DESC ";
        $query = $this->db->query($sql, array((int) $offset, (int) $limit));
        return $query->result();
    }

    public function count_forms_awaiting()
    {
        $this->db->group_by("wizard_sif_num");
        return $this->db->count_all_results($this->form_sessions);
    }

    public function get_form_status_name($type)
    {
        $this->db->where("value", $type);
        return $this->db->get($this->status_types)->row();
    }

    public function wizard_status_update($sif, $status)
    {
        return $this->db->query("update form_sessions set wizard_status = '" . COMPLETED . "' where wizard_sif_num = '" . $sif . "'");
    }

    public function wizard_post($wizard_data, $wizard_num)
    {
        $unique_number = $wizard_data['unique_number'];
        if (empty($unique_number)):
            $unique_number = $this->session->userdata('resubmit_unique_number');
            $wizard_data['unique_number'] = $unique_number;
        endif;
        $x = 1;
        $this->db->where("wizard_num", $wizard_num);
        $this->db->where("unique_number", $unique_number);
        $query = $this->db->get($this->form_sessions);

        if ($query->row("wizard_num") == $wizard_num && $query->row("unique_number") == $unique_number)
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
            if ($x == 1):
                $initial_post = $this->db->insert($this->form_sessions, $wizard_data);
                $this->db->where("wizard_by", $this->session->userdata("username"));
                $this->db->where("wizard_num", $wizard_num);
                $this->db->where("unique_number", $unique_number);
                $initial_ver = $this->db->update($this->form_sessions, $version);
                $x = 0;
            endif;
            $x = 0;
        }
    }

    public function wizard_get_new($get_wizard_num, $access, $unique_number)
    {
        $unum = end(explode('-', $unique_number));

        $wizard_date = $this->uri->segment(5);
        $wizby = $this->uri->segment(6);
        if (is_numeric($wizard_date)):
            $wizard_date = $this->uri->segment(8);
            $wizby = $this->uri->segment(9);
        endif;
        $wizard_by = str_replace("_", " ", $wizby);
        $this->db->where("wizard_num", $get_wizard_num);
        $this->db->where("unique_number", $unum);
        $this->db->where("wizard_status", 45);
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

    public function wizard_get($get_wizard_num, $access, $unique_number)
    {
        $this->db->where("wizard_num", $get_wizard_num);
        $this->db->where("unique_number", $unique_number);
        if (empty($access)):
            $this->db->where("wizard_id", $this->session->userdata('wizardid'));
        endif;
        if ($get_wizard_num == PENDING)
        {
            $this->db->where("wizard_status", PENDING);
        }
        $query = $this->db->get($this->form_sessions);
        if ($query->num_rows() > 0)
        {
            $res = array();
            $array1 = $query->row("wizard_data");
            $array1 = json_decode($array1);
            $array1 = json_decode(json_encode($array1), true);
            $array2 = array('sif' => $query->row('wizard_sif_num'));
            $array3 = array('wizard_by' => $query->row('wizard_by'));
            $array_merge = array_merge($array1, $array2, $array3);
            $res = json_encode($array_merge);
            return $res;
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

    public function wizard_get_update($get_wizard_num, $access, $auditid, $limit)
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
        $pre_result = json_decode($pre_result['wizard_data']);
        $pre_result = $this->convert_array($pre_result);
        //Compare the results with keys
        $result_to_compare = (!empty($pre_date) && !empty($pre_wizard_by)) ? $this->check_with_keys($pre_date_result, $pre_result, array()) : $pre_result;
        $this->db->select('*');
        $this->db->from('form_sessions_audit');
        $this->db->where('wizard_num', $get_wizard_num);
        $this->db->where('unique_number', $unique_sif);
        $this->db->where("DATE_FORMAT(wizard_modified, '%m-%d-%y') = '$current_date'");
        $this->db->where('wizard_by', $wizard_by);
        $this->db->order_by('audit_id', 'asc');
        $sql = $this->db->get();
        // Get the count
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

    public function post_wizard_01($wizard_01)
    {
        $this->db->delete($this->assessment_wiz01, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz01, $wizard_01);
        return $insert;
    }

    public function post_wizard_02($wizard_02)
    {
        $this->db->delete($this->assessment_wiz02, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz02, $wizard_02);
        return $insert;
    }

    public function post_wizard_03($wizard_03)
    {
        $this->db->delete($this->assessment_wiz03, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz03, $wizard_03);
        return $insert;
    }

    public function post_wizard_04($wizard_04)
    {
        $this->db->delete($this->assessment_wiz04, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz04, $wizard_04);
        return $insert;
    }

    public function post_wizard_05($wizard_05)
    {
        $this->db->delete($this->assessment_wiz05, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz05, $wizard_05);
        return $insert;
    }

    public function post_wizard_06($wizard_06)
    {
        $this->db->delete($this->assessment_wiz06, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz06, $wizard_06);
        return $insert;
    }

    public function post_wizard_07($wizard_07)
    {
        $this->db->delete($this->assessment_wiz07, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz07, $wizard_07);
        return $insert;
    }

    public function post_wizard_08($wizard_08)
    {
        $this->db->delete($this->assessment_wiz08, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz08, $wizard_08);
        return $insert;
    }

    public function post_wizard_09($wizard_09)
    {
        $this->db->delete($this->assessment_wiz09, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz09, $wizard_09);
        return $insert;
    }

    public function post_wizard_10($wizard_10)
    {
        $this->db->delete($this->assessment_wiz10, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz10, $wizard_10);
        return $insert;
    }

    public function post_wizard_11($wizard_11)
    {
        $this->db->delete($this->assessment_wiz11, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz11, $wizard_11);
        return $insert;
    }

    public function post_wizard_12($wizard_12)
    {
        $this->db->delete($this->assessment_wiz12, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz12, $wizard_12);
        return $insert;
    }

    public function post_wizard_13($wizard_13)
    {
        $this->db->delete($this->assessment_wiz13, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz13, $wizard_13);
        return $insert;
    }

    public function post_wizard_14($wizard_14)
    {
        $this->db->delete($this->assessment_wiz14, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz14, $wizard_14);
        return $insert;
    }

    public function post_wizard_15($wizard_15)
    {
        $this->db->delete($this->assessment_wiz15, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz15, $wizard_15);
        return $insert;
    }

    public function post_wizard_16($wizard_16)
    {
        $this->db->delete($this->assessment_wiz16, array('sif' => $this->sif));
        $insert = $this->db->insert($this->assessment_wiz16, $wizard_16);
        return $insert;
    }

    public function get_wizard_01($sif)
    {
        $this->db->get_where($this->assessment_wiz01, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz01)->row();
    }

    public function get_wizard_02($sif)
    {
        $this->db->get_where($this->assessment_wiz02, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz02)->row();
    }

    public function get_wizard_03($sif)
    {
        $this->db->get_where($this->assessment_wiz03, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz03)->row();
    }

    public function get_wizard_04($sif)
    {
        $this->db->get_where($this->assessment_wiz04, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz04)->row();
    }

    public function get_wizard_05($sif)
    {
        $this->db->get_where($this->assessment_wiz05, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz05)->row();
    }

    public function get_wizard_06($sif)
    {
        $this->db->get_where($this->assessment_wiz06, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz06)->row();
    }

    public function get_wizard_07($sif)
    {
        $this->db->get_where($this->assessment_wiz07, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz07)->row();
    }

    public function get_wizard_08($sif)
    {
        $this->db->get_where($this->assessment_wiz08, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz08)->row();
    }

    public function get_wizard_09($sif)
    {
        $this->db->get_where($this->assessment_wiz09, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz09)->row();
    }

    public function get_wizard_10($sif)
    {
        $this->db->get_where($this->assessment_wiz10, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz10)->row();
    }

    public function get_wizard_11($sif)
    {
        $this->db->get_where($this->assessment_wiz11, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz11)->row();
    }

    public function get_wizard_12($sif)
    {
        $this->db->get_where($this->assessment_wiz12, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz12)->row();
    }

    public function get_wizard_13($sif)
    {
        $this->db->get_where($this->assessment_wiz13, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz13)->row();
    }

    public function get_wizard_14($sif)
    {
        $this->db->get_where($this->assessment_wiz14, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz14)->row();
    }

    public function get_wizard_15($sif)
    {
        $this->db->get_where($this->assessment_wiz15, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz15)->row();
    }

    public function get_wizard_16($sif)
    {
        $this->db->get_where($this->assessment_wiz16, array('sif' => $sif));
        return $this->db->get($this->assessment_wiz16)->row();
    }

    //END OF STEP ONE	
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

    // check form status
    public function get_form_details($sif, $unum)
    {
//        exit('model');
        $this->db->where("wizard_num", "assessment_wiz16_" . $sif);
        $this->db->where("unique_number", $unum);
        $query = $this->db->get($this->form_sessions);
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        }
    }

    // check form status
    public function get_form_details_appraisal($sif, $unum)
    {
//        exit('model');
        $this->db->where("wizard_num", "appraisal_wiz01_" . $sif);
        $this->db->where("unique_number", $unum);
        $query = $this->db->get($this->form_sessions);
        if ($query->num_rows() > 0)
        {
            return $query->row_array();
        }
    }

    // Escalate status update against nurse
    public function escalate_status_update($sif, $unum)
    {
        $version = array('wizard_status' => 35);
        $wizard_num = 'assessment_wiz16_' . $sif;
        $this->db->where("wizard_num", $wizard_num);
        $this->db->where("unique_number", $unum);
        return $this->db->update($this->form_sessions, $version);
    }

    // complete status update against nurse
    public function complete_status_update_appraisal($sif, $unum)
    {
        $version = array('wizard_status' => 45);
        $wizard_num1 = 'appraisal_wiz01_' . $sif;
        $wizard_num2 = 'appraisal_wiz06_' . $sif;
        $this->db->where("wizard_num", $wizard_num1);
        $this->db->where("wizard_num", $wizard_num2);
        $this->db->where("unique_number", $unum);
        return $this->db->update($this->form_sessions, $version);
    }

    // complete status update against nurse
    public function complete_status_update_assessment($sif, $unum)
    {
        $version = array('wizard_status' => 45);
        $wizard_num1 = 'assessment_wiz01_' . $sif;
        $wizard_num2 = 'assessment_wiz16_' . $sif;
        $this->db->where("wizard_num", $wizard_num1);
        $this->db->where("wizard_num", $wizard_num2);
        $this->db->where("unique_number", $unum);
        return $this->db->update($this->form_sessions, $version);
    }

    // check form status
    public function get_form_status()
    {
        $this->db->where("wizard_by", $this->session->userdata("username"));
        $query = $this->db->get($this->form_sessions);
        if ($query->num_rows() > 0)
        {

            return $query->row("wizard_status");
        }
    }

    // check form status
    public function check_wizard_status($sifnum)
    {
        // Fetch form session for form status
        $sifunique_number = $this->uri->segment(4);
        if (!is_numeric($sifunique_number)):
            $sifunique_number = end(explode('-', $sifunique_number));
        endif;
        $this->db->where("sif", $sifnum);
        $this->db->where("sif_unique_number", $sifunique_number);
        $this->db->order_by("last_changed", 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->assessment_comments);
//        echo $this->db->last_query();
//        exit;
        if ($query->num_rows() > 0)
        {
            return $query->row("commentText");
        }
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

    //Insert data for autosave
    public function insert_autosave($data)
    {
        $sql = $this->db->query("select *  from autosave where user_id = '" . $this->session->userdata('user_id') . "'");
        $count = $sql->num_rows();
        if ($count == 0):
            $sql = $this->db->query("insert into autosave(wizard_data,user_id) values ('" . $data . "','" . $this->session->userdata('user_id') . "')");
        else:
            $sql = $this->db->query("update autosave set wizard_data = '" . $data . "' where user_id = '" . $this->session->userdata('user_id') . "' ");
        endif;
    }

    public function get_autosave()
    {
        $sql = $this->db->query("select wizard_data  from autosave where user_id = '" . $this->session->userdata('user_id') . "'");
        $res = $sql->row_array();
        $count = $sql->num_rows();
        if ($count >= 1):
            $resval = json_decode($res['wizard_data']);

            return $resval;
        else:
            return FALSE;
        endif;
    }

    public function delete_autosave()
    {
        $sql = $this->db->query("select *  from autosave where user_id = '" . $this->session->userdata('user_id') . "'");
        $count = $sql->num_rows();
        if ($count >= 1):
            $sql = $this->db->query("delete from autosave where user_id = '" . $this->session->userdata('user_id') . "'");
        endif;
    }

    /*
     * Get for count against sif and sif unique number
     */

    public function get_forms_count_sif($sif, $uniquenumber)
    {
        $sql = $this->db->query("select * from form_sessions where wizard_sif_num = '" . $sif . "' and unique_number = '" . $uniquenumber . "' ");
        $count = $sql->num_rows();
        if ($count >= 1):
            return $count;
        else:
            return FALSE;
        endif;
    }

    public function count_form_sessions($sif)
    {
        $default = 0;
        $sql = $this->db->query("select unique_number from form_sessions where wizard_sif_num = '" . $sif . "' ORDER BY unique_number DESC ");
        $count = $sql->num_rows();
        if ($count >= 1):
            $res = $sql->row_array();
            return $res['unique_number'];
        else:
            return $default;
        endif;
    }

    /*
     * Get wizard_by against sif & unique
     */

    public function create_assessment_form($sif, $uniquenumber, $user_level)
    {

        if ($user_level <= 40)
        {
            if ($user_level == 40)
            {
                $sql = $this->db->query("select wizard_by from form_sessions_audit where wizard_sif_num = '" . $sif . "' and unique_number = '" . $uniquenumber . "' order by wizard_id ASC");
//                echo $this->db->last_query();

                $count = $sql->num_rows();
                if ($count >= 1):
                    $res = $sql->row_array();
                    return $res['wizard_by'];
                else:
                    return FALSE;
                endif;
            }
            if ($user_level == 30)
            {
                $sql = $this->db->query("SELECT user_id FROM assessment_comments WHERE sif = '" . $sif . "' AND sif_unique_number = '" . $uniquenumber . "'");
                $count = $sql->num_rows();
                if ($count >= 1):
                    $res = $sql->row_array();
                    $userid = $res['user_id'];
                    $sql = $this->db->query("SELECT username FROM admin_user WHERE user_id = '" . $userid . "'");
                    $res = $sql->row_array();
                    return $res['username'];
                else:
                    return FALSE;
                endif;
            }
        }
    }

    /*
     * Get user ID against sif and unique number
     */

    public function get_userid_against_uname($username)
    {
        $sql = $this->db->query("SELECT user_id FROM admin_user WHERE username =  '" . $username . "' ");
        $count = $sql->num_rows();
        if ($count >= 1):
            $res = $sql->row_array();
            return $res['user_id'];
        else:
            return FALSE;
        endif;
    }

    public function get_managedby($userid)
    {
        $sql = $this->db->query("SELECT * FROM user_manager
                                INNER JOIN admin_user ON admin_user.user_id = user_manager.manage_by
                                WHERE user_manager.manage_id = $userid");
        $count = $sql->num_rows();

        if ($count >= 1):
            $res = $sql->row_array();
            return $res['username'];
        else:
            return FALSE;
        endif;
    }

}