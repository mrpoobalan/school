<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth AdminUI Model
 *
 * @package AdminAccess Model
 * @author Patrick K. Johnson Jr.
 * @link http://avizium.com/
 * @version 2.0.0-pre
 */
class Adminui_model extends CI_model {

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
    private $permission_manager = "perm";
    private $managed_user = "user_manager";
    private $form_versions = "form_sessions_audit";
    private $form_sessions = "form_sessions";

    /**
     * constructor
     *
     */
    public function __construct() {
        parent::__construct();

        $this->_config = (object) $this->config->item("acl");
        $this->db = $this->load->database("default", TRUE);

        $this->load->model("assessment_model", "", TRUE);
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

    /*
     * get auto complete for usertypes
     */
    public function get_roles($keyword, $level = NULL) {
        $this->db->select('role_id, name');
        $this->db->from('role');
        if ($level == 40) {
            $this->db->where('name', "Nurse");
        }
        if ($level == 30) {
            $this->db->where('name', "Nurse");
            $this->db->or_where('name', "Nurse Supervisor");
        }
        $this->db->like('name', $keyword);
        $this->db->order_by("name", "asc");
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $data[] = $row;
        }
        return $query;
    }

    public function list_all() {
//        echo "cal";
//        exit;
        $this->db->order_by("user_id", "asc");
        return $this->db->get($this->admin_user);
    }

    public function list_all_against_role() {
//        $nsid = $this->uri->segment(4);
        if (!empty($_GET['term'])):
            $keyword = $_GET['term'];
        endif;
        if (!empty($_GET['prof'])):
            $role = $_GET['prof'];
        endif;
        return $this->db->query("SELECT * FROM admin_user
                                INNER JOIN user_role ON user_role.user_id = admin_user.user_id
                                WHERE user_role.role_id = $role and CONCAT(first_name,'',last_name) like '" . "%" . $keyword . "%" . "' ");
    }

    public function list_all_against_role_nurse($userlevel) {

        $user_id = $this->session->userdata('user_id');
        if (!empty($_GET['term'])):
            $keyword = $_GET['term'];
        endif;
        if (!empty($_GET['prof'])):
            $role = $_GET['prof'];
        endif;
        if ($userlevel > 30):
            return $this->db->query("SELECT * FROM admin_user
                                INNER JOIN user_role ON user_role.user_id = admin_user.user_id
                                INNER JOIN user_manager ON user_manager.manage_id = admin_user.user_id
                                WHERE user_role.role_id = $role
                                and user_manager.manage_by = $user_id
                                and CONCAT(first_name,'',last_name) like '" . "%" . $keyword . "%" . "' ");
        else:
            return $this->db->query("SELECT * FROM admin_user
                                INNER JOIN user_role ON user_role.user_id = admin_user.user_id
                                INNER JOIN user_manager ON user_manager.manage_id = admin_user.user_id
                                WHERE user_role.role_id = $role  and CONCAT(first_name,'',last_name) like '" . "%" . $keyword . "%" . "' ");
        endif;
    }

    public function list_all_edit() {
        $nsid = $this->uri->segment(4);
        if (!empty($_GET['term'])):
            $keyword = $_GET['term'];
        endif;
        return $this->db->query("SELECT * FROM admin_user
                                INNER JOIN user_role ON user_role.user_id = admin_user.user_id
                                WHERE user_role.role_id = 5 and admin_user.user_id <> '" . $nsid . "' and CONCAT(first_name,'',last_name) like '" . "%" . $keyword . "%" . "' ");
    }

    public function get_paged_list($limit = 10, $offset = 0) {
        $this->db->order_by("user_id", "asc");
        return $this->db->get($this->admin_user, $limit, $offset);
    }

    public function get_version_list($limit = 10, $offset = 0, $sifNumber) {
        $sif_unum = $this->uri->segment(6);
        $this->db->where("wizard_sif_num", $sifNumber);
        $this->db->where("operation", "Update");
        $this->db->where("unique_number", $sif_unum);
        $this->db->order_by("audit_id", "asc");
        $this->db->group_by(array("wizard_sif_num", "operation"));
        return $this->db->get($this->form_versions, $limit, $offset);
    }

    public function get_version_list_audit($limit = 10, $offset = 0, $sifNumber) {
        $querystring = $this->uri->segment(4);
        $sif_unum = end(explode("-", $querystring));
        $seprate = (explode("_", $querystring));
        $gets = explode("-", $seprate[2]);
        $sifNumber = $gets[0];
        $sql = $this->db->query('SELECT  *  FROM (`form_sessions_audit`) WHERE
            `wizard_sif_num` = "' . $sifNumber . '" AND unique_number = "' . $sif_unum . '" AND `operation` = "Update"
                GROUP BY CONCAT(DATE_FORMAT(wizard_modified, "%Y-%m-%d"),"_", wizard_by)');

        return $sql;
    }

    /*
     * Get value against sifno
     */

    public function get_audit_original($limit = 10, $offset = 0, $wizardNumber) {
        $querystring = $this->uri->segment(4);
        $sif_unum = end(explode("-", $querystring));
        $seprate = (explode("_", $querystring));
        $formtype = $seprate[0];
        $gets = explode("-", $seprate[2]);
        $sif = $gets[0];
        $wnum = $seprate[0] . "_" . $seprate[1] . "_" . $sif;
        //find form type
        $sql = $this->db->query("SELECT form_type FROM form_sessions where wizard_sif_num = $sif AND unique_number = $sif_unum");
        $form_res = $sql->row_array();
        $form_name = $form_res['form_type'];
        if ($form_name == "Appraisal"):
            $sql = $this->db->query("SELECT * FROM form_sessions WHERE wizard_num = 'appraisal_wiz06_$sif' AND
        wizard_sif_num = $sif AND unique_number = $sif_unum AND is_completed = 1");
        else:
            $sql = $this->db->query("SELECT * FROM form_sessions WHERE wizard_num = 'assessment_wiz16_$sif' AND
        wizard_sif_num = $sif AND unique_number = $sif_unum  AND is_completed = 1");
        endif;
        $res = $sql->row_array();
        $totcounts = $sql->num_rows();
        if ($totcounts >= 1):
            $operation = "insert";
            $sql = $this->db->select('*')
                    ->from('form_sessions_audit')
                    ->where('wizard_num', $wnum)
                    ->where('operation', $operation)
                    ->where('unique_number', $sif_unum)
                    ->limit(1)
                    ->get();
            $count = $sql->num_rows;
            if ($count >= 1):
                $res = $sql->row_array();
                $obj = json_decode($res['wizard_data']);
                $resarray = json_decode(json_encode($obj), true);
                unset($resarray['ins']);
                //Delete the json value
                unset($res['wizard_data']);
                $res_merge = array_merge($res, $resarray);
                return $res_merge;
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    }

    public function convert_array($arr) {
        $mod_arr = array();
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $mod_arr[$key] = implode(",", $value);
            } else {
                $mod_arr[$key] = $value;
            }
        }
        return $mod_arr;
    }

    /*
     * Get value against sifno Update
     */

    public function get_audit_update($limit = 10, $offset = 0, $wizardNumber, $orgdata) {

        $querystring = $this->uri->segment(4);
        $sif_unum = end(explode("-", $querystring));
        $seprate = (explode("_", $querystring));
        $formtype = $seprate[0];
        $gets = explode("-", $seprate[2]);
        $sif = $gets[0];
        $wnum = $seprate[0] . "_" . $seprate[1] . "_" . $sif;
        //find form type
        $sql = $this->db->query("SELECT form_type FROM form_sessions where wizard_sif_num = $sif AND unique_number = $sif_unum");
        //echo "<br>";
        // echo $this->db->last_query();
        $form_res = $sql->row_array();
        $form_name = $form_res['form_type'];
        if ($form_name == "Appraisal"):
            $sql = $this->db->query("SELECT * FROM form_sessions WHERE wizard_num = 'appraisal_wiz06_$sif'  AND
        wizard_sif_num = $sif AND unique_number = $sif_unum AND is_completed = 1");
        else:
            $sql = $this->db->query("SELECT * FROM form_sessions WHERE wizard_num = 'assessment_wiz16_$sif' AND
        wizard_sif_num = $sif AND unique_number = $sif_unum AND is_completed = 1");
        endif;
        $res = $sql->row_array();
        //echo "<br>";
        //echo $this->db->last_query();
        $totcounts = $sql->num_rows();
        if ($totcounts >= 1):
            $operation = "update";
            $sql = $this->db->select('audit_id,wizard_by,form_type,wizard_num,wizard_data,wizard_modified,wizard_sif_num,audit_id')
                    ->from('form_sessions_audit')
                    ->where('wizard_num', $wnum)
                    ->where('operation', $operation)
                    ->where('unique_number', $sif_unum)
                    ->order_by('audit_id', 'DESC')
                    ->get();
            $count = $sql->num_rows;
            if ($count >= 1):
                $res = $sql->result_array();
                $previous_array = array();
                $x = 0;
                foreach ($res as $val):
                    $obj = json_decode($val['wizard_data']);
                    $json_array = json_decode(json_encode($obj), true);
                    unset($json_array['ins']);
                    unset($val['wizard_data']);
                    $res_merge = array_merge($val, $json_array);
                    $res_merge = $this->convert_array($res_merge);
                    if ($x == 0):
                        $res_modify = array_diff($res_merge, $orgdata);
                    else:
                        $res_modify = array_diff($res_merge, $previous_array);
                    endif;
                    unset($res_modify['wizard_modified']);
                    $previous_array = $res_merge;
                    $default = array('wizard_modified' => $val['wizard_modified'], 'audit_ids' => $val['audit_id'], 'usernames' => $val['wizard_by'], 'formtypes' => $val['form_type'], 'wizard_sif_num' => $val['wizard_sif_num']);
                    if (count($res_modify) >= 2) :
                        $res_modifydata[] = array_merge($res_modify, $default);
                    endif;
                    $x++;
                endforeach;
                if (count($res_modify) >= 1):
                    return $res_modifydata;
                endif;
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    }

    public function count_all() {
        return $this->db->count_all($this->admin_user);
    }

    public function count_assigned_user() {
        $sql = $this->db->query("select au.*,r.role_id, r.name as roleName, r.description as roleDescription from admin_user au inner join user_role ur on au.user_id=ur.user_id
                                inner join role r on r.role_id = ur.role_id
                                left join user_manager um on um.manage_id=au.user_id
                                where au.user_id in (
                                select manage_id from user_manager where manage_by in
                                (select manage_id from user_manager where manage_by='" . $this->session->userdata('user_id') . "') )
                                or au.user_id='" . $this->session->userdata('user_id') . "'");
        $count = $sql->num_rows();
        return $count;
    }

    public function count_all_versions($sifNumber) {
        $this->db->where("wizard_sif_num", $sifNumber);
        $this->db->where("operation", "Update");
        $this->db->group_by(array("wizard_sif_num", "operation"));
        return $this->db->count_all_results($this->form_versions);
    }

    public function get_audit_id($sifNumber) {
        $this->db->where("wizard_num", $sifNumber);
        $this->db->where("operation", "Update");
        $this->db->get($this->form_versions)->result();
        return $this->db->get($this->form_versions)->result();
    }

    public function get_by_id($user_id) {
        $this->db->where("user_id", $user_id);
        $sql = $this->db->get($this->admin_user)->row();
        return $sql;
    }

    public function get_by_id_multiple($nsid, $nurseid) {
        $ids = array($nsid, $nurseid);
        $this->db->where_in('user_id', $ids, false);
        $sql = $this->db->get($this->admin_user)->result();
        return $sql;
    }

    public function get_nurse_by_id($user_id) {
        $this->db->select('*');
        $this->db->where("user_id", $user_id);
        return $this->db->get($this->admin_user)->row();
    }

    function get_group() {
        $admin_role[""] = "Select admin role";
        $this->db->order_by("name", "asc");
        $query = $this->db->get($this->role_manager);
        foreach ($query->result_array() as $row) {
            $admin_role[$row["role_id"]] = $row["name"];
        }

        return $admin_role;
    }

    function user_current_group() {
        $this->db->order_by("name", "asc");
        $this->db->get($this->role_manager);
    }

    /**
     * get specific user details by constraint
     *
     * @param	string	$field	the field to constrain by
     * @param	mixed	$value	the required value of field
     * @return	array	an array of CodeIgniter row objects for user
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_user_by($field, $value) {
        $this->db->select($this->admin_user . ".*");
        $this->db->where($field, $value);
        return $this->db->get($this->admin_user)->row();
    }

    /**
     * get user details
     *
     * @param	int		$user_id	the unique identifier for the user to get
     * @return	object	a CodeIgniter row object for user
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_user($user_id) {
        $user = $this->get_user_by("user_id", $user_id);
        return ($user !== FALSE) ? $user : FALSE;
    }

    function get_by_user($user) {
        $this->db->where("username", $user);
        $sql = $this->db->get($this->admin_user);
//        echo $this->db->last_query();
//        exit;
        $res = $sql->row_array();
        return $sql;
    }

    function get_by_user_id($user, $sif, $unum) {
        $this->db->where("direct_report", $user);
        $this->db->where("wizard_sif_num", $sif);
        $this->db->where("unique_number", $unum);
        $sql = $this->db->get($this->form_sessions);
//        echo $this->db->last_query().'<br>';
//        exit;
        $res = $sql->row_array();
        return $sql;
    }

    function get_by_users($user) {
        $this->db->where("username", $user);
        $sql = $this->db->get($this->admin_user);
        $res = $sql->row_array();
        return $res;
    }

    function get_by_user_name($user) {
        $sql = $this->db->query("select user_id from admin_user where concat(first_name,' ',last_name) = '" . $user . "' ");
        $res = $sql->row_array();
        return $res['user_id'];
    }

    /**
     * add user to database
     *
     * @param	assoc_array	$data	associative array of data to add into `user` table
     * @return	boolean		TRUE/FALSE - whether or not addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    function admin_add_user() {
        $response = $this->check_admin_user();

        // check for duplicate user before inserting new request...
        $this->db->where("username", $this->input->post("username"));
        $query = $this->db->get($this->admin_request);
        if ($query->num_rows != 1) {
            // no duplicate record(s) found...
            $new_admin = array("first_name" => $this->input->post("first_name"),
                "last_name" => $this->input->post("last_name"),
                "username" => $this->input->post("username"),
                "password" => md5($this->input->post("password")),
                "password_reset" => 0,
                "email_address" => $this->input->post("email_address"),
                "status" => 1,
                "date_created" => date("Y-m-d H:i:s"));
            $insert = $this->db->insert($this->admin_user, $new_admin);
            $user_id = $this->db->insert_id();
            // add user role
            $role_id = $this->input->post("role");
            $this->add_user_role($user_id, $role_id);
            return $user_id;
        } else {
            return DUPLICATE_REG;
        }
    }

    // add managed user
    public function managed_by($managed_user) {
        $this->db->insert_batch($this->managed_user, $managed_user);
    }

    // check registration table for duplicate username or/and email
    private function check_admin_user() {
        $this->db->where("username", $this->input->post("username"));
        $query = $this->db->get($this->admin_user);

        if ($query->num_rows == 1) {
            return DUPLICATE_ADMIN;
        }
    }

    /**
     * delete user from database
     *
     * @param	int		$user_id	the unique identifier for the user to get
     * @return	boolean	TRUE/FALSE - whether or not the deletion was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function del_user($user_id) {
        $this->db->delete($this->_config->table["admin_user"], array("user_id" => $user_id));
        return ($this->db->affected_rows() == 1);
    }

    /**
     * update user details
     *
     * @param	int			$user_id	the unique identifier for the user to get
     * @param	assoc_array	$data		the new data for the user
     * @return	boolean		TRUE/FALSE - whether or not the changes were successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    function account_update($user_id, $acct) {
        $this->db->where("user_id", $user_id);
//        $this->db->update("au", $acct);
        return $this->db->update($this->admin_user, $acct);
    }

    /*
      | -------------------------------------------------------------------
      |  user role relations
      | -------------------------------------------------------------------
     */

    /**
     * get users roles
     *
     * @param	string	$user_id	the unique identifier for the user
     * @return	array	array of CodeIgniter row objects containing the user roles
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_user_roles($user_id) {
        $this->db->select($this->_config->table["role"] . ".*")
                ->from($this->_config->table["user_role"])
                ->where("user_id", $user_id)
                ->join($this->_config->table["role"], $this->_config->table["role"] . ".role_id = " . $this->_config->table["user_role"] . ".role_id", "inner");
        $role = $this->db->get();
//                echo $this->db->last_query();
//        exit;
        return ($role->num_rows() > 0) ? $role->result() : FALSE;
    }

    public function get_latest_assessment($formtype) {
        $this->db->select("wizard_sif_num,unique_number,wizard_status,form_type")
                ->from('form_sessions')
                ->where('wizard_status', 45)
                ->where('form_type', 'Assessment')
                ->group_by("wizard_sif_num")
                ->order_by("wizard_id,unique_number", 'Desc');
        $role = $this->db->get();
        return ($role->num_rows() > 0) ? $role->result() : FALSE;
    }

    public function get_pm_id($userid) {
        $this->db->select("manage_by")
                ->from('user_manager')
                ->where('manage_id', $userid);
        $role = $this->db->get();
        $res = $role->row_array();
        return $res['manage_by'];
    }

    public function get_manageuser_id($userid) {
        $this->db->select("manage_id")
                ->from('user_manager')
                ->where('manage_by', $userid);
        $role = $this->db->get();
        $res = $role->row_array();
        return $res['manage_id'];
    }

    public function get_nurse_supervisor_id($name) {
        $sql = $this->db->query("SELECT user_id,concat(first_name,' ',last_name) AS displayname FROM admin_user where concat(first_name,' ',last_name) = '" . $name . "'");
        //                echo $this->db->last_query();
//        exit;
        $res = $sql->row_array();
        return ($sql->num_rows() > 0) ? $res['first_name'] . " " . $res['last_name'] : FALSE;
    }

    public function get_nurse_supervisor_id_val($name) {
        $sql = $this->db->query("SELECT user_id,concat(first_name,' ',last_name) AS displayname FROM admin_user where concat(first_name,' ',last_name) = '" . $name . "'");
        //                echo $this->db->last_query();
//        exit;
        $res = $sql->row_array();
        return ($sql->num_rows() > 0) ? $res['user_id'] : FALSE;
    }

//    // get user role
//  public function get_user_role($acct_id, $keyword = NULL)
//    {
//      if(!empty($keyword)):
//        $user_id = $this->session->userdata('user_id');
//        $this->db->select("*")
//                ->from($this->_config->table["user_role"])
//                ->where("user_manager.manage_by", $user_id)
//                ->like("first_name", $keyword)
//                ->join($this->_config->table["role"], $this->_config->table["role"] . ".role_id = " . $this->_config->table["user_role"] . ".role_id", "inner")
//                ->join($this->_config->table["admin_user"], $this->_config->table["admin_user"] . ".user_id = " . $this->_config->table["user_role"] . ".user_id", "inner")
//                ->join('user_manager', 'user_manager.manage_id = admin_user.user_id', "inner");
//        $role = $this->db->get();
////        echo $this->db->last_query();
//
//        return ($role->num_rows() > 0) ? $role->row() : FALSE;
//        endif;
//    }
    public function get_user_role($acct_id, $keyword = NULL) {
        $this->db->select("*")
                ->from($this->_config->table["user_role"])
                ->where("admin_user.user_id", $acct_id)
                ->like("first_name", $keyword)
                ->join($this->_config->table["role"], $this->_config->table["role"] . ".role_id = " . $this->_config->table["user_role"] . ".role_id", "inner")
                ->join($this->_config->table["admin_user"], $this->_config->table["admin_user"] . ".user_id = " . $this->_config->table["user_role"] . ".user_id", "inner");
        $role = $this->db->get();
        return ($role->num_rows() > 0) ? $role->row() : FALSE;
    }

    /**
     * assign user to role
     *
     * @param	int		$user_id	the unique identifier for the user to assign
     * @param	int		$role_id	the unique identifier for the role to assign
     * @return	boolean	TRUE/FALSE - whether or not the assignment was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function add_user_role($user_id, $role_id) {
        if ($role_id == "Nurse") {
            $role_id = 6;
        }
        if ($role_id == "Nurse Supervisor") {
            $role_id = 5;
        }
        if ($role_id == "Program Manager") {
            $role_id = 4;
        }
        if ($role_id == "Deputy Director") {
            $role_id = 3;
        }
        if ($role_id == "Director") {
            $role_id = 2;
        }
        if ($role_id == "Administrator") {
            $role_id = 1;
        }

        $this->db->insert($this->_config->table["user_role"], array(
            "user_id" => $user_id,
            "role_id" => $role_id
        ));
        return ($this->db->affected_rows() == 1);
    }

    /**
     * remove user from role
     *
     * @param	int		$user_id	the unique identifier for the user
     * @param	int		$role_id	the unique identifier for the role
     * @return	boolean	TRUE/FALSE - whether or not the removal was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function del_user_role($user_id, $role_id) {
        $this->db->delete($this->_config->table["user_role"], array(
            "user_id" => $user_id,
            "role_id" => $role_id
        ));
        return ($this->db->affected_rows() == 1);
    }

    public function edit_user_roles($user_id, $role_array) {
        // Update user role
        $this->db->delete($this->_config->table["user_role"], array("user_id" => $user_id));
        //LOCKED... ONLY ONE ROLE PER USER
        $role = $role_array[0];
        $this->db->insert($this->_config->table["user_role"], array("user_id" => $user_id, "role_id" => $role));
        return($this->db->affected_rows());
    }

    /**
     * password changed by admin
     *
     * @param	int		$user_id	the unique identifier for the user
     * @param	int		$role_id	the unique identifier for the role
     * @return	boolean	TRUE/FALSE - whether or not the removal was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    function update_password_prompt($user_id, $acct) {
        $this->db->where("user_id", $user_id);
        $this->db->update($this->admin_user, $acct);
    }

    /*
      | -------------------------------------------------------------------
      |  role specific methods
      | -------------------------------------------------------------------
     */

    /**
     * get all roles details
     *
     * @return	array	an array of CodeIgniter row objects for role
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_all_roles() {
        $roles = $this->db->query("select * from role");
        return ($roles->num_rows() > 0) ? $roles->result() : FALSE;
    }

    public function count_all_roles() {
        return $this->db->count_all($this->role_manager);
    }

    public function get_role_paged_list($limit = 10, $offset = 0) {
        $this->db->order_by("role_id", "asc");
        return $this->db->get($this->role_manager, $limit, $offset);
    }

    /**
     * get roles by constraint
     *
     * @param	string	$field	the field to constrain
     * @param	mixed	$value	the required value of field
     * @return	object	a CodeIgniter row object for role
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_role_by($field, $value) {
        $this->db->select("*");
        $this->db->where($field, $value);
        return $this->db->get($this->role_manager)->result();
    }

    /**
     * get details of a role
     *
     * @param	int		$role_id	the unique identifier for the role
     * @return	object	a CodeIgniter row object for role
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     * @todo	return permissions associated w/ role as well
     */
    public function get_role($role_id) {
        $role = $this->get_role_by("role_id", $role_id);
        return ($role !== FALSE) ? $role[0] : FALSE;
    }

    /**
     * add new role to database
     *
     * @param	string	$data		the new roles data
     * @return	boolean	TRUE/FALSE - whether addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function add_role($data) {
        $this->db->insert($this->_config->table["role"], $data);
        return ($this->db->affected_rows() == 1);
    }

    /**
     * remove role from database
     *
     * @param	int		$role_id	the unique identifier for the role
     * @return	boolean	TRUE/FALSE - whether addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function del_role($role_id) {
        $this->db->delete($this->_config->table["role"], array("role_id" => $role_id));
        return ($this->db->affected_rows() == 1);
    }

    /**
     * update a roles data
     *
     * @param	int			$role_id	the unique identifier for the role
     * @param	assoc_array	$data		the new roles data
     * @return	boolean	TRUE/FALSE - whether update was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function edit_role($role_id, $data) {
        return $this->db->update($this->_config->table["role"], $data, array("role_id" => $role_id));
//		return ($this->db->affected_rows() == 1);
    }

    /*
      | -------------------------------------------------------------------
      |  role permission relations
      | -------------------------------------------------------------------
     */

    /**
     * get permission a role has
     *
     * @param	int		$role_id	the unique identifier for the role
     * @return	array	array of CodeIgniter row objects for role permissions
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_role_perms($role_id) {
        $this->db->select($this->_config->table["perm"] . ".*")
                ->from($this->_config->table["role_perm"])
                ->where("role_id", $role_id)
                ->join($this->_config->table["perm"], $this->_config->table["perm"] . ".perm_id = " . $this->_config->table["role_perm"] . ".perm_id");

        $perms = $this->db->get();
        return ($perms->num_rows() > 0) ? $perms->result() : FALSE;
    }

    /**
     * get permission ids assigned to a role
     *
     * @param	int		$role_id	the unique identifier for the role
     * @return	array	array of CodeIgniter row objects for role_perm
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_role_perms_keys($role_id) {
        $this->db->query("select * from role_perm");
        $this->db->where('role_id', $role_id);
        $perm_keys = $this->db->get($this->_config->table["role_perm"]);
        return ($perm_keys->num_rows() > 0) ? $perm_keys->result() : FALSE;
    }

    /**
     * add permission to role
     *
     * @param	int		$role_id	the unique identifier for the role
     * @param	int		$perm_id	the unique identifier for the permission
     * @return	boolean	TRUE/FALSE - whether or not addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function add_role_perm($role_id, $perm_id) {
        $this->db->insert($this->_config->table["role_perm"], array(
            "role_id" => $role_id,
            "perm_id" => $perm_id
        ));
        return ($this->db->affected_rows() == 1);
    }

    /**
     * remove permission from role
     *
     * @param	int		$role_id	the unique identifier for the role
     * @param	int		$perm_id	the unique identifier for the permission
     * @return	boolean	TRUE/FALSE - whether or not removal was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function del_role_perm($role_id, $perm_id) {
        $this->db->delete($this->_config->table["role_perm"], array(
            "role_id" => $role_id,
            "perm_id" => $perm_id
        ));
        return ($this->db->affected_rows() == 1);
    }

    /**
     * Edit role permissions
     *
     * Essensially this method assigns permissions to a role. This method will return FALSE
     * if **ANY** of the assignments fail.
     *
     * @param	int		$role_id	the unique identifier for the role
     * @param	array	$perm_array	an array of identifiers for the permissions to assign
     * @return	boolean	TRUE/FALSE - whether or not **ALL** assignments were successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     * @todo	rework to check for changes rather than bulk remove then add permissions each time
     * @todo	add in some better error reporting to detail which assignemnts fail and why
     */
    public function edit_role_perms($role_id, $perm_array) {
        // bulk delete permissions for the role
        $this->db->delete($this->_config->table["role_perm"], array("role_id" => $role_id));

        // assume permissions all fail to set
        $rtn = TRUE;

        // add permissions provided in array
        foreach ($perm_array as $item => $perm_id) {
            if (!$this->add_role_perm($role_id, $perm_id)) {
                $rtn = FALSE;
            }
        }

        // return TRUE if all permissions set
        return $rtn;
    }

    /*
      | -------------------------------------------------------------------
      |  permission specific methods
      | -------------------------------------------------------------------
     */

    /**
     * get all permissions
     *
     * @return	array	an array of CodeIgniter row objects for permission
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_all_perms() {
        $perms = $this->db->query("select * from perm");
        return ($perms->num_rows() > 0) ? $perms->result() : FALSE;
    }

    public function count_all_perms() {
        return $this->db->count_all($this->permission_manager);
    }

    /**
     * get permissions with pagination
     *
     * @return	array	an array of CodeIgniter row objects for permission
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_perm_paged_list($limit = 10, $offset = 0) {
        $this->db->order_by("perm_id", "asc");
        return $this->db->get($this->permission_manager, $limit, $offset);
    }

    /**
     * get permission by constraint
     *
     * @param	string	$field	the field to constrain
     * @param	mixed	$value	the value field should be
     * @return	array	an array of CodeIgniter row objects for permissions
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_perm_by($field, $value) {
        //TODO THIS NEEDS MINOR FIXING
        $this->db->where($field, $value);
        return $this->get_all_perms();
    }

    /**
     * get permission by constraint
     *
     * @param	string	$user_id of the account
     * @return	array	an array of CodeIgniter row strings for permissions
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_perm_by_userid($id) {
        //NOT IMPLEMENTED, REQUIRES new db table
        //return $this->db->where("user_id", $id);
    }

    /**
     * get a specific permissions
     *
     * @param	int	$perm_id	the unique identifier for the permission (id not value)
     * @return	object	a CodeIgniter row object for permission
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_perm($perm_id) {
        $this->db->select();
        $this->db->where('perm_id', $perm_id);
        $perm = $this->db->get('perm')->result();
        return ($perm !== FALSE) ? $perm[0] : FALSE;
    }

    /**
     * add a permission
     *
     * @param	assoc_array	$data	the new permissions data
     * @return	boolean		TRUE/FALSE - whether addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function add_perm($data) {
        $this->db->insert($this->_config->table["perm"], $data);
        return ($this->db->affected_rows() == 1);
    }

    /**
     * delete a permission
     *
     * @param	int		$perm_id	the unique identifier for the permission (id not value)
     * @return	boolean	TRUE/FALSE - whether addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function del_perm($perm_id) {
        $this->db->delete($this->_config->table["perm"], array("perm_id" => $perm_id));
        return ($this->db->affected_rows() == 1);
    }

    /**
     * update a permission
     *
     * @param	int			$perm_id	the unique identifier for the permission (id not value)
     * @param	assoc_array	$data		the new data for permission
     * @return	boolean		TRUE/FALSE - whether or not update successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function edit_perm($perm_id, $data) {
        return $this->db->update($this->_config->table["perm"], $data, array("perm_id" => $perm_id));
    }

    /*
      | -------------------------------------------------------------------
      |  user permission relation
      | -------------------------------------------------------------------
     */

    /**
     * get a users permissions based off those in users roles
     *
     * @param	int		$user_id	the unique identifier for the user
     * @return	array	an array of CodeIgniter row objects for permissions
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter result object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     * @todo	refactor code to use complex sql **instead** of rest of model, and multiple sql calls.
     */
    public function get_user_perms($user_id) {
        // hold on tight... this is a complicated one... and will be
        // rolled into a single sql query if possible at a later date w/ diff logic. (might be possible)
        $rtn = array();
        // get users roles
        $role_list = $this->get_user_roles($user_id);
        // check role(s) set
        // for each role get its perms and add them to return array
        if (is_array($role_list))
            foreach ($role_list as $role) {
                // get role perms
                $perm_list = $this->get_role_perms($role->role_id);
                // check perms assigned to role
                if (is_array($perm_list))
                    foreach ($perm_list as $perm) {
                        $rtn[] = $perm;
                    }
            }
        // return permission value total and return
        return $rtn;
    }

    /*
      | -------------------------------------------------------------------
      |  helper/utility methods for acl usage
      | -------------------------------------------------------------------
     */

    /**
     * user permission check
     *
     * Checks a user has the required permission.
     *
     * @param	string	$user_id	the user to check permission on
     * @param	string	$slug		the permission required
     * @return	boolean	TRUE/FALSE - whether or not user has permission
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     * @todo	add ability to accept arrays of permission slugs
     */
    public function user_has_perm($user_id, $slug) {

        $user_perms = $this->get_user_perms($user_id);
        // chek the user has some permissions
        // loop through users permissions and check for the slug
        if (is_array($user_perms))
            foreach ($user_perms as $perm) {
                // if slug is found then return TRUE
                //echo " SLUG IS ".$perm->slug."<br>".$slug;
                if ($perm->slug == $slug) {
                    return TRUE;
                }
            }
        // if we get here the user has no permissions
        return FALSE;
    }

    /**
     * user role check
     *
     * @param	int		$user_id	the unique identifier for the uer
     * @param	string	$slug		the role required
     * @return	boolean	TRUE/FALSE - whether or not the user has role
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     * @todo	add ability to accept arrays of role slugs
     */
    public function user_has_role($user_id, $slug) {
        $user_roles = $this->get_user_roles($user_id);
        if (is_array($user_roles))
            foreach ($role_list as $role) {
                if ($role->slug == $slug) {
                    return TRUE;
                }
            }
        return FALSE;
    }

    /**
     * pending admin request model methods
     *
     * @param	int		$user_id	the unique identifier for the uer
     * @param	string	$slug		the role required
     * @return	boolean	TRUE/FALSE - whether or not the user has role
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     *
     * @todo	add ability to accept arrays of role slugs
     */
    public function get_paged_list_pendrequest($limit = 10, $offset = 0) {
        $this->db->order_by("user_id", "asc");
        return $this->db->get($this->admin_request, $limit, $offset);
    }

    public function get_by_id_pendrequest($user_id) {
        $this->db->where("user_id", $user_id);
        $this->db->get($this->admin_request);
    }

    public function delete_approved_request($user_id) {
        // after request has been approved, delete from pending table
        $this->db->where("user_id", $user_id);
        return $this->db->delete($this->admin_request);
    }

    public function approve_request($user_id, $new_acct) {
        // check if this request has been previously approved before inserting
        $this->db->where("username", $this->input->post("username"));
        $this->db->where("email_address", $this->input->post("email_address"));
        $query = $this->db->get($this->admin_user);
        if ($query->num_rows != 1) {
            $insert = $this->db->insert($this->admin_user, $new_acct);
            return $insert;
        } else {
            return DUPLICATE_ADMIN;
        }
    }

    public function count_all_pendrequest() {
        return $this->db->count_all($this->admin_request);
    }

    function get_logs() {
        $this->db->select("uri, method, ip_address");
        $this->db->from("logs");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function get_roletype($userrole) {
        if ($userrole == 30):
            $this->db->where("role.level >", $userrole);
        endif;
        $this->db->order_by("role_id", "asc");
        return $this->db->get($this->role_manager);
    }

    public function get_allusers_byjson($term) {
        $this->db->select("user_id, last_name, first_name");
        $this->db->like('last_name', $term, 'after');
        $users = $this->db->get($this->admin_user);
        foreach ($users->result_array() as $row) {
            $data[] = $row;
        }
        return $users;
    }

    public function get_managed_users($user_id) {
        $this->db->select("admin_user.first_name, admin_user.last_name, user_manager.manage_id, user_manager.manage_by ");
        $this->db->where($this->_config->table["user_manager"] . ".manage_id", $user_id);
        $this->db->join($this->_config->table["admin_user"], $this->_config->table["user_manager"] . ".manage_id
				= " . $this->_config->table["admin_user"] . ".user_id", "inner");
        $this->db->order_by("user_alias", "asc");
        return $this->db->get($this->_config->table["user_manager"]);
    }

    //Get the user id of a subordinate's manager
    public function get_user_manager_id($subordinate) {
        $this->db->select('manage_by');
        $this->db->where('manage_id', $subordinate);
        return $this->db->get($this->_config->table["user_manager"]);
    }

    //Get the user ids of a manager's subordinates
    public function get_user_manage_by($manager) {
        $this->db->select('manage_id');
        $this->db->where('manage_by', $manager);
        return $this->db->get($this->_config->table["user_manager"]);
    }

    // get all details of the managers for a specific user (by userID)
    public function get_user_managers($userID, $singleRec = false) {
        $sql = "select * from admin_user where user_id in (select manage_by from user_manager where manage_id=?)";
        $query = $this->db->query($sql, $userID);
//        echo $this->db->last_query();
//        exit;
        $results = ($singleRec == true) ? $query->row() : $query->result();
        return $results;
    }

    function get_manageby_id($user_id) {
        $this->db->select("first_name, last_name, email_address");
        $this->db->where("user_id", $user_id);
        return $this->db->get($this->_config->table["admin_user"]);
    }

    /*
     * Mark an appraisal/assessment as 'reject for edit'
     */

    public function reject($SIF) {
        $data = array('wizard_status' => REJECTED);
        return $this->updateRecord($SIF, $data);
    }

    /*
     * Mark an appraisal/assessment as approved
     */

    public function approve($SIF) {
        $data = array('wizard_status' => COMPLETED);
        return $this->updateRecord($SIF, $data);
    }

    /*
     * Mark an appraisal/assessment as escalated
     */

    public function escalate($SIF) {
        $data = array('wizard_status' => ESCALATED);
        return $this->updateRecord($SIF, $data);
    }

    // generic record updates
    public function updateRecord($SIF, $data) {
        // TODO: verify if a sif be associated with both an assessment and appraisal??
        // TODO: how are errors handled?
        $unum = $this->uri->segment(5);
        $this->db->where('wizard_sif_num', $SIF);
        $this->db->where('unique_number', $unum);
        return $this->db->update('form_sessions', $data);
    }

    // this is basically a copy from assessment/appraisal -
    // TODO: move this to a single source instead of maintaining a separate copy here
    public function wizard_get($get_wizard_num, $access) {
        $this->db->select("*");
        if ($access == NURSE) {
            $this->db->where("wizard_by", $this->session->userdata("username"));
        }
        $this->db->where("wizard_num", $get_wizard_num);
        $query = $this->db->get('form_sessions');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return NULL;
        }
    }

    public function SaveComment($commentData) {
        $unique_sif_number = $this->uri->segment(5);
        // assemble the data
        $commentTableData = array('sif' => $commentData['sif'], 'sif_unique_number' => $unique_sif_number, 'commentText' => $commentData['commentText'], 'user_id' => $this->session->userdata('user_id'));
        //Check if the value already exists
        $this->db->where('sif', $commentData['sif']);
        $this->db->where('sif_unique_number', $unique_sif_number);
        $query = $this->db->get('assessment_comments');
        $rowcount = $query->num_rows();
//        echo $this->db->last_query();
//        exit;
        // check if we have a cid, in which case this must be an update
        if (!empty($rowcount)) {
            $res = $query->row_array();
            // update the record
            $this->db->where('cid', $res['cid']);
            $this->db->update('assessment_comments', $commentTableData);
        } else {
//            echo "come ins";
//            exit;
            // insert new record
            $this->db->insert('assessment_comments', $commentTableData);
        }
    }

    // Load all data necessary for editing a user
    public function LoadUserEditData($userID) {
        // get the main dat for the user being edited
        $sql = "SELECT au.first_name, au.last_name, au.status, au.username, au.email_address, r.role_id, r.name as roleName, r.description as roleDescription, um.manage_by
				FROM admin_user au inner join user_role ur on au.user_id=ur.user_id
				inner join role r on r.role_id = ur.role_id
				left join user_manager um on um.manage_id=au.user_id where au.user_id=?";

        $results = array('editedUser' => null, 'manager1' => array(), 'manager2' => array(), 'surbordinates' => array());
        $query = $this->db->query($sql, $userID);

        if ($query->num_rows() > 0) {
            $results['editedUser'] = $this->db->query($sql, $userID)->row();
            # get the manager for the specified UserID (Nurse Supervisor+)
            $results['manager1'] = $this->get_user_managers($userID);
            # check if the user is a nurse supervisor or program manager
            if (strtolower($results['editedUser']->roleName) == "nurse") {
                # get the manager for the manager (Program Manager+)
                foreach ($results['manager1'] as $row) {
                    $dataset = $this->get_user_managers($row->user_id);
                    foreach ($dataset as $row) {
                        $results['manager2'][] = $row;
                    }
                }
            } else { ##if(strtolower($results['editedUser']['roleName'])=="nurse supervisor")
                # get the nurses/nurse supervisors assigned to this user
                // TODO: the get_user_management_chain fx is crucial and should be moved to the adminui_model
                // and force everyone to call it instead
                $results['surbordinates'] = $this->assessment_model->get_user_management_chain($userID, null, false, null, null);
            }
        }

        return $results;
    }

    // update the user status : active | disabled
    public function updateUserStatus($userId, $userStatus) {
        // update the record
        $userStatusUpdate = array('status' => $userStatus);
        $this->account_update($userId, $userStatusUpdate);
    }

    // update the manage by association for the specified users
    public function updateUserManagedBy($newManagerUserId, $nursesToReassign, $update = false) {
        if (count($nursesToReassign) > 0) {
            // an association of manager and worker may not exist
            // if that is the case, create the association
            // needs improvement in the logic here
            // plan is to delete the existing association first
            // set new one
            // for nurses, remove old association (since a nurse can only have one association)
            // same logic applies for nurse supervisors (under PM) - in this case, we remove prior PMs for users specified
            $this->db->or_where_in('manage_id', $nursesToReassign);
            $this->db->delete('user_manager');

            // to get a clean slate, we also have to delete all existing accounts managed by the the new manager
            // this enforces a set permission
            if (!$update) {
                $this->db->where('manage_by', $newManagerUserId);
                $this->db->delete('user_manager');
            }

            // we need to insert some records (find out which one and insert)
            foreach ($nursesToReassign as $nurseToReassign) {
                // insert new record
                $record = array('manage_by' => (int) $newManagerUserId, 'manage_id' => $nurseToReassign);
                $this->db->insert('user_manager', $record);
            }
        }
    }

    // set the manager for a user
    public function SetUserManager($userId, $newUserManagerId) {
        // since a user can only have one manager, we must
        // 1. delete existing manager assignments for the user
        $this->db->where("manage_id", $userId);
        $this->db->delete("user_manager");

        // 2. insert new manager relationship
        $record = array('manage_by' => (int) $newUserManagerId, 'manage_id' => $userId);
        $this->db->insert('user_manager', $record);
    }

    // get the list of nurses currently assigned to the specified program manager (or above)
    public function getAvailableNurses($programManagerId) {
        $this->db->select('admin_user.*');
        $this->db->from('admin_user');
        $this->db->join('user_manager', 'admin_user.user_id = user_manager.manage_id');
        $this->db->join('user_role', 'user_role.user_id = admin_user.user_id');
        $this->db->join('role', 'role.role_id = user_role.role_id');
        $this->db->where('user_manager.manage_by', (int) $programManagerId);
//        $this->db->or_where('user_manager.manage_ns', (int) $programManagerId);
        $this->db->where('role.Name', 'Nurse');
        $query = $this->db->get();
//        echo $this->db->last_query();
//        exit;
        return $query->result();
    }

    public function GetUsersByRoleName($roleName) {
        $this->db->select('admin_user.*');
        $this->db->from('admin_user');
        $this->db->join('user_role', 'user_role.user_id = admin_user.user_id');
        $this->db->join('role', 'role.role_id = user_role.role_id');
        $this->db->where('role.Name', $roleName);
        $query = $this->db->get();
        return $query->result();
    }

    // get the userId of all users that are currently managed: assigned a manager
    public function GetManagedUsers() {
        $this->db->select('manage_id,manage_by');
        $this->db->from('user_manager');
        $query = $this->db->get();

        return $query->result();
    }

    //Insert session record for check edit section
    public function session_record($data) {
        $sql = $this->db->insert('session_record', $data);
        $insertid = $this->db->insert_id();
        if ($insertid >= 0):
            return true;
        else:
            return FALSE;
        endif;
    }

    //check inserted record for edit functionality
    public function check_record($data) {
        $sql = $this->db->select('*')
                ->from('session_record')
                ->where('rec_value', $data)
                ->get();
        $res = $sql->row_array();
        $count = $sql->num_rows();
        if ($count >= 1 && $res['user_id'] <> $this->session->userdata('user_id')):
            return $count;
        else:
            return FALSE;
        endif;
    }

    public function delete_record($wiznum) {
        return $this->db->delete('session_record', array('rec_value' => $wiznum));
    }

    //Updating User manger table
    function user_manager_update($data) {
//        exit('model');
        return $sql = $this->db->query("UPDATE user_manager SET manage_by = " . $data['new_user_id'] . " WHERE manage_id IN (" . $data['exist_nurse_id'] . ")");
    }

    //Updating form session tabel
    function form_session_ns_update($data) {
        $sql = $this->db->query("UPDATE form_sessions SET direct_report = " . $data['new_user_id'] . " WHERE wizard_by IN (" . $data['exist_nurse_uname'] . ")");

        $sql = $this->db->query("UPDATE form_sessions_audit SET direct_report = " . $data['new_user_id'] . " WHERE wizard_by IN (" . $data['exist_nurse_uname'] . ")");
    }

    //check inserted record for edit functionality
    public function get_assessment_count($sif, $unique) {

        $sql = $this->db->select('count(*) as countvalue')
                ->from('form_sessions')
                ->where('wizard_num', "assessment_wiz16_" . $sif)
                ->where('unique_number', $unique)
                ->where('wizard_status', 45)
                ->get();
        $res = $sql->row_array();
        return $res['countvalue'];
    }

    public function get_appraisal_count($sif, $unique) {

        $sql = $this->db->select('count(*) as countvalue')
                ->from('form_sessions')
                ->where('wizard_num', "appraisal_wiz06_" . $sif)
                ->where('unique_number', $unique)
                ->where('wizard_status', 45)
                ->get();
        $res = $sql->row_array();
        return $res['countvalue'];
    }

}

/* End of file acl_model.php */
/* Location: ./application/models/acl_model.php */