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
class Schoolhealth_model extends CI_model {

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
    private $schools = "schools";
    private $status_types = "status_types";

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
    //public function get_all_users() {
    //$users = $this->db->get($this->_config->table["admin_user"]);
    //return ($users->num_rows() > 0) ? $users->result() : FALSE;
    //}

    public function list_all()
    {
        $this->db->order_by("user_id", "asc");
        return $this->db->get($this->admin_user);
    }

    public function get_paged_list($limit = 1, $offset = 0, $search_param, $user_role)
    {
        $query = array();
        //Manager user lsit
        $limitToUserID = null;
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $flip = array_flip($managedUsers);
        $nur = $this->session->userdata('username');
//        if (in_array($nur, $managedUsers)):
//            unset($flip[$nur]);
//        endif;
        $managedUserList_new = array_flip($flip);
        $managedUserList = "'" . implode("','", $managedUserList_new) . "'";
        if ($user_role == 50):
            $managedUserList = $managedUsers[0];
        endif;
        //Manager user lsit end
        if ($user_role <= 20)
        {

            $query = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE wizard_sif_num != 0 AND wizard_sif_num = '" . $search_param . "'  GROUP BY `unique_number` ORDER BY `unique_number` Desc");

            return $query;
        }
        elseif (is_numeric($search_param) && $user_role <> 50)
        {

            $query = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE wizard_sif_num != 0 AND wizard_sif_num = '" . $search_param . "'    GROUP BY `unique_number` ORDER BY `unique_number` Desc");

            return $query;
        }
        elseif (is_numeric($search_param) || !is_numeric($search_param) && $user_role == 50)
        {

            $query = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE wizard_sif_num != 0 AND wizard_sif_num = '" . $search_param . "'  GROUP BY `unique_number` ORDER BY `unique_number` Desc");
//            echo $this->db->last_query();
//            exit;
            return $query;
        }
        else
        {

            $query = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE wizard_sif_num != 0 AND wizard_sif_num = 'ssss' and  `wizard_by` IN
                                        (" . $managedUserList . ")  GROUP BY `unique_number` ORDER BY `unique_number` Desc");
//            echo $this->db->last_query();
//            exit;
            return $query;
        }
    }

    //Get total count against SIF
    public function getcount($sif, $unum, $formtype, $userrole)
    {
        $sel = $this->db->query("Select * from form_sessions where wizard_sif_num = '" . $sif . "' and unique_number = '" . $unum . "'   order by wizard_id desc ");
        $res = $sel->result_array();
//        echo "<pre>";
//        print_r($res);
//        echo "</pre>";
//        exit;
        $count = $sel->num_rows();
        if ($formtype == "Assessment"):
            if ($count >= 14 && $res[0]['wizard_status'] == 35):
                return ESCALATED;
            elseif ($count >= 14 && $userrole == "Nurse" && $res[0]['wizard_status'] <> 25 && $res[0]['wizard_status'] <> 45 && $res[0]['wizard_status'] == 15):
                return PENDING;
            elseif ($count >= 14 && $userrole == "Nurse" && $res[0]['wizard_status'] == 25):
                return REJECTED;
            elseif ($count >= 14 && $userrole == "Nurse"):
                return IN_PROGRESS;
            elseif ($count >= 14 && $userrole == "Nurse" && $res[0]['wizard_status'] == 45):
                return COMPLETED;
            elseif ($count >= 14 && $userrole == "Nurse Supervisor" && $res[0]['wizard_by'] <> $this->session->userdata('username') && $res[0]['wizard_status'] <> 25 && $res[0]['wizard_status'] <> 45):
                return PENDING;
            elseif ($count >= 14 && $userrole == "Nurse Supervisor" && $res[0]['wizard_status'] <> 25 && $res[0]['wizard_status'] <> 35 && $res[0]['wizard_by'] == $this->session->userdata('username')):
                return COMPLETED;
            elseif ($count >= 14 && $userrole == "Nurse Supervisor" && $res[0]['wizard_status'] == 25):
                return REJECTED;
            elseif ($count >= 14 && $userrole == "Nurse Supervisor" && $res[0]['wizard_status'] == 45):
                return COMPLETED;
            else:
                return IN_PROGRESS;
            endif;
        else:
            if ($count >= 5 && $formtype == "Appraisal" && $res[0]['wizard_status'] == 45):
                return COMPLETED;
            elseif ($res[0]['wizard_status'] == 35):
                return ESCALATED;
            elseif ($res[0]['wizard_status'] == 25):
                return REJECTED;
            else:
                return IN_PROGRESS;
            endif;
        endif;
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

    // advanced search filter
    function advance_search_list($limit = null, $offset = 0, $search_opt, $username)
    {
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $user_name = $user_role->username;

        //Manager user lsit
        $limitToUserID = null;
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $flip = array_flip($managedUsers);
        $nur = $this->session->userdata('username');
//        if (in_array($nur, $managedUsers)):
//            unset($flip[$nur]);
//        endif;
        $managedUserList_new = array_flip($flip);
        $managedUserList = "'" . implode("','", $managedUserList_new) . "'";
        if ($user_role == 50):
            $managedUserList = $managedUsers[0];
        endif;
        //Manager user lsit end

        if ($user_role->{'level'} == NURSE && $search_opt['filter1_type'] == "first_name")
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        elseif ($user_role->{'level'} == NURSE && $search_opt['filter1_type'] == "last_name")
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }



        //If search only by filter 2
        if (empty($search_opt['filter1']))
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT * FROM (`form_sessions`)
                                       WHERE " . $search_opt['filter2_type'] . " = '" . $search_opt['filter2'] . "' 
                                        GROUP BY `unique_number` ORDER BY `unique_number` Desc");
            else:
                $query = $this->db->query("SELECT * FROM (`form_sessions`)
                                       WHERE " . $search_opt['filter2_type'] . " = '" . $search_opt['filter2'] . "' AND `wizard_by` IN
                                        (" . $managedUserList . ")  GROUP BY `unique_number` ORDER BY `unique_number` Desc");
            endif;


            return $query;
        }
        //IF complted status
        elseif (empty($search_opt['filter2']) && $search_opt['filter1_type'] == "wizard_status" && $search_opt['filter1'] == 45)
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE wizard_status=45
                                       GROUP BY wizard_sif_num,unique_number  ");
            else:
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE  wizard_by in  (" . $managedUserList . ") AND (wizard_status=45)  
                                       GROUP BY wizard_sif_num,unique_number  ");
            endif;


            return $query;
        }
        //IF in progress status
        elseif (empty($search_opt['filter2']) && $search_opt['filter1_type'] == "wizard_status" && $search_opt['filter1'] == 5)
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT *, count(*) AS totcount FROM form_sessions 
                                        WHERE  form_type = 'Appraisal' 
                                        GROUP BY wizard_sif_num,unique_number HAVING totcount < 5 AND wizard_status = 5  UNION
                                        SELECT *, count(*) AS totcount FROM form_sessions 
                                        WHERE  form_type = 'Assessment'
                                        GROUP BY wizard_sif_num,unique_number HAVING totcount < 14 AND wizard_status = 5 and wizard_sif_num <> 0 ");

            else:
                $query = $this->db->query("SELECT *, count(*) AS totcount FROM form_sessions 
                                        WHERE  (form_type = 'Appraisal') and wizard_by in  (" . $managedUserList . ") 
                                        GROUP BY wizard_sif_num,unique_number HAVING totcount < 5 AND wizard_status = 5  UNION
                                        SELECT *, count(*) AS totcount FROM form_sessions 
                                        WHERE  (form_type = 'Assessment')  and wizard_by in  (" . $managedUserList . ")
                                        GROUP BY wizard_sif_num,unique_number HAVING totcount < 14 AND wizard_status = 5 and wizard_sif_num <> 0 ");

            endif;

            return $query;
        }
        //IF Rejected status
        elseif (empty($search_opt['filter2']) && $search_opt['filter1_type'] == "wizard_status" && $search_opt['filter1'] == 25)
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE  wizard_status=25
                                       GROUP BY wizard_sif_num,unique_number  ");
            else:
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE  wizard_by in  (" . $managedUserList . ") AND (wizard_status=25)  
                                       GROUP BY wizard_sif_num,unique_number  ");
            endif;

//            echo $this->db->last_query();
//            exit;
            return $query;
        }
        //IF Escalated status
        elseif (empty($search_opt['filter2']) && $search_opt['filter1_type'] == "wizard_status" && $search_opt['filter1'] == 35)
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE   wizard_status=35  
                                       GROUP BY wizard_sif_num,unique_number  ");
            else:
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE   wizard_by in  (" . $managedUserList . ")  AND (wizard_status=35)  
                                       GROUP BY wizard_sif_num,unique_number  ");
            endif;
            return $query;
        }
        //IF Pending status
        elseif (empty($search_opt['filter2']) && $search_opt['filter1_type'] == "wizard_status" && $search_opt['filter1'] == 15)
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE  wizard_status=15  
                                       GROUP BY wizard_sif_num,unique_number  ");
            else:
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE  wizard_by in  (" . $managedUserList . ")  AND (wizard_status=15)  
                                       GROUP BY wizard_sif_num,unique_number  ");
            endif;


            return $query;
        }
        elseif ((empty($search_opt['filter2']) && $search_opt['filter1_type'] == "wizard_status") && ($search_opt['filter1'] <> 5 || $search_opt['filter1'] <> 15 || $search_opt['filter1'] <> 25 || $search_opt['filter1'] <> 35 || $search_opt['filter1'] <> 45 && $search_opt['filter1_type'] == "wizard_status"))
        {


            $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE  wizard_by in  (" . $managedUserList . ")  AND (wizard_status=100)  
                                       GROUP BY wizard_sif_num,unique_number  ");
            return $query;
        }

        //IF filter form
        elseif (empty($search_opt['filter2']) && $search_opt['filter1_type'] == "form")
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE form_type = '" . $search_opt['filter1'] . "'
                                       and wizard_sif_num <> 0
                                       GROUP BY wizard_sif_num,unique_number  ");
            else:
                $query = $this->db->query("SELECT * FROM form_sessions 
                                       WHERE  wizard_by in  (" . $managedUserList . ") AND form_type = '" . $search_opt['filter1'] . "'
                                       and wizard_sif_num <> 0
                                       GROUP BY wizard_sif_num,unique_number  ");
            endif;

            return $query;
        }
        elseif (empty($search_opt['filter2']) && ($search_opt['filter1_type'] <> "wizard_status" || $search_opt['filter1_type'] <> "form"))
        {
//            exit('f');
            if ($user_role <= 20):
                $query = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE " . $search_opt['filter1_type'] . " = '" . $search_opt['filter1'] . "'
                                           GROUP BY `unique_number` ORDER BY `unique_number` Desc");
            else:
                $query = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE " . $search_opt['filter1_type'] . " = '" . $search_opt['filter1'] . "' AND `wizard_by` IN
                                        (" . $managedUserList . ")  GROUP BY `unique_number` ORDER BY `unique_number` Desc");
            endif;

            return $query;
        }
        elseif (!empty($search_opt['filter1']) && !empty($search_opt['filter2']))
        {
            if ($user_role <= 20):
                $query = $this->db->query("SELECT * FROM (`form_sessions`)
                                       WHERE " . $search_opt['filter1_type'] . " = '" . $search_opt['filter1'] . "' AND 
                                        " . $search_opt['filter2_type'] . " = '" . $search_opt['filter2'] . "' 
                                            GROUP BY `unique_number` ORDER BY `unique_number` Desc");
            else:
                $query = $this->db->query("SELECT * FROM (`form_sessions`)
                                       WHERE " . $search_opt['filter1_type'] . " = '" . $search_opt['filter1'] . "' AND 
                                        " . $search_opt['filter2_type'] . " = '" . $search_opt['filter2'] . "' AND `wizard_by` IN
                                        (" . $managedUserList . ")  GROUP BY `unique_number` ORDER BY `unique_number` Desc");
            endif;

            return $query;
        }
    }

    function advance_search_count($limit = 10, $offset = 0, $search_opt, $username)
    {
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        if ($user_role->{'level'} == NURSE && $search_opt['filter1_type'] == "first_name")
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        elseif ($user_role->{'level'} == NURSE && $search_opt['filter1_type'] == "last_name")
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
            ;
        }
        if ($search_opt['filter1_type'] == "wizard_sif_num"):
            $limit = 1;
        endif;
        if (empty($search_opt['filter1']))
        {
            $this->db->where($search_opt['filter2_type'], $search_opt['filter2']);
            $this->db->order_by("wizard_id", "DESC");
            $this->db->group_by(array("wizard_sif_num"));
            return $this->db->get($this->students, $limit, $offset);
        }
        elseif (empty($search_opt['filter2']))
        {
            if ($search_opt['filter1_type'] == "wizard_status")
            {
                $limit = 10;
                $this->db->group_by("wizard_sif_num");
            }
            else
            {
                $limit = 1;
            }
            $this->db->where($search_opt['filter1_type'], $search_opt['filter1']);
            $this->db->order_by("wizard_id", "Desc");
            $query = $this->db->get($this->students);
            $count = $query->num_rows();
            return $count;
        }
        elseif (!empty($search_opt['filter1']) && !empty($search_opt['filter2']))
        {
            $this->db->where($search_opt['filter1_type'], $search_opt['filter1']);
            $this->db->where($search_opt['filter2_type'], $search_opt['filter2']);
            $this->db->order_by("wizard_id", "asc");
            $this->db->group_by(array("wizard_sif_num"));
            return $this->db->get($this->students, $limit, $offset);
        }
    }

    public function count_all($search_param)
    {
        if (!is_numeric($search_param))
        {
            $this->db->like("last_name", $search_param);
            $this->db->where("last_name");
            $this->db->group_by(array("last_name", "first_name"));
        }
        elseif (is_numeric($search_param))
        {
            $this->db->like("wizard_sif_num", $search_param);
            $this->db->where("wizard_sif_num");
            $this->db->where("wizard_by", $this->session->userdata("username"));
            $this->db->group_by("wizard_sif_num");
        }
        return $this->db->count_all_results($this->students);
    }

    public function get_by_id($user_id)
    {
        $this->db->where("user_id", $user_id);
        return $this->db->get($this->admin_user);
    }

    function get_group()
    {
        $admin_role[""] = "Select admin role";
        $this->db->order_by("name", "asc");
        $query = $this->db->get($this->role_manager);

        foreach ($query->result_array() as $row)
        {
            $admin_role[$row["role_id"]] = $row["name"];
        }
        return $admin_role;
    }

    function user_current_group()
    {
        $this->db->order_by("name", "asc");
        return $this->db->get($this->role_manager);
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
    public function get_user_by($field, $value)
    {
        $this->db->where($field, $value);
        return $this->get_all_users();
    }

    /**
     * get user details
     *
     * @param	int		$user_id	the unique identifier for the user to get
     * @return	object	a CodeIgniter row object for user
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_user($user_id)
    {
        $user = $this->get_user_by("user_id", $user_id);
        return ($user !== FALSE) ? $user[0] : FALSE;
    }

    function get_by_user($user)
    {
        $this->db->where("username", $user);
        return $this->db->get($this->admin_user);
    }

    /**
     * add user to database
     *
     * @param	assoc_array	$data	associative array of data to add into `user` table
     * @return	boolean		TRUE/FALSE - whether or not addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    function admin_add_user()
    {
        // check valid admin user table private method
        $response = $this->check_admin_user();

        if ($response == DUPLICATE_ADMIN)
        {
            return DUPLICATE_ADMIN;
        }
        else
        {
            // check for duplicate user before inserting new request...
            $this->db->where("username", $this->input->post("username"));
            $this->db->where("email_address", $this->input->post("email_address"));
            $query = $this->db->get($this->admin_request);

            if ($query->num_rows != 1)
            {
                // no duplicate record(s) found...
                $new_admin = array("first_name" => $this->input->post("first_name"),
                    "last_name" => $this->input->post("last_name"),
                    "username" => $this->input->post("username"),
                    "password" => md5($this->input->post("password")),
                    "password_reset" => 1,
                    "email_address" => $this->input->post("email_address"),
                    "status" => 1,
                    "date_created" => date("Y-m-d H:i:s"));

                $insert = $this->db->insert($this->admin_user, $new_admin);
                return $insert;
            }
            else
            {
                return DUPLICATE_REG;
            }
        }
    }

    // check registration table for duplicate username or/and email
    private function check_admin_user()
    {
        $this->db->where("username", $this->input->post("username"));
        $this->db->where("email_address", $this->input->post("email_address"));
        $query = $this->db->get($this->admin_user);
        if ($query->num_rows == 1)
        {
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
    public function del_user($user_id)
    {
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
    function account_update($user_id, $acct)
    {
        $this->db->where("user_id", $user_id);
        $this->db->update($this->admin_user, $acct);
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
    public function get_user_roles($user_id)
    {
        $this->db->select($this->_config->table["role"] . ".*")
                ->from($this->_config->table["user_role"])
                ->where("user_id", $user_id)
                ->join($this->_config->table["role"], $this->_config->table["role"] . ".role_id = " . $this->_config->table["user_role"] . ".role_id", "inner");

        $role = $this->db->get();
        return ($role->num_rows() > 0) ? $role->result() : FALSE;
    }

    public function get_user_role($user_id)
    {
        $this->db->select("role.`name` 
				FROM user_role INNER JOIN role 
				ON user_role.role_id = role.role_id 
				WHERE user_role.user_id = $user_id");
        $role = $this->db->get();

        return ($role->num_rows() > 0) ? $role->result() : FALSE;
    }

    /**
     * assign user to role
     *
     * @param	int		$user_id	the unique identifier for the user to assign
     * @param	int		$role_id	the unique identifier for the role to assign
     * @return	boolean	TRUE/FALSE - whether or not the assignment was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function add_user_role($user_id, $role_id)
    {
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
    public function del_user_role($user_id, $role_id)
    {
        $this->db->delete($this->_config->table["user_role"], array(
            "user_id" => $user_id,
            "role_id" => $role_id
        ));
        return ($this->db->affected_rows() == 1);
    }

    public function edit_user_roles($user_id, $role_array)
    {
        // bulk delete permissions for the role
        $this->db->delete($this->_config->table["user_role"], array("user_id" => $user_id));
        // assume permissions all fail to set
        $rtn = TRUE;
        // add permissions provided in array
        foreach ($role_array as $item => $role_id)
        {
            if (!$this->add_user_role($user_id, $role_id))
            {
                $rtn = FALSE;
            }
        }
        // return TRUE if all permissions set
        return $rtn;
    }

    /**
     * password changed by admin
     *
     * @param	int		$user_id	the unique identifier for the user
     * @param	int		$role_id	the unique identifier for the role
     * @return	boolean	TRUE/FALSE - whether or not the removal was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    function update_password_prompt($user_id, $acct)
    {
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
    public function get_all_roles()
    {
        $roles = $this->db->get($this->_config->table["role"]);
        return ($roles->num_rows() > 0) ? $roles->result() : FALSE;
    }

    public function count_all_roles()
    {
        return $this->db->count_all($this->role_manager);
    }

    public function get_role_paged_list($limit = 10, $offset = 0)
    {
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
    public function get_role_by($field, $value)
    {
        $this->db->where($field, $value);
        return $this->get_all_roles();
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
    public function get_role($role_id)
    {
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
    public function add_role($data)
    {
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
    public function del_role($role_id)
    {
        $this->db->insert($this->_config->table["role"], array("role_id" => $role_id));
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
    public function edit_role($role_id, $data)
    {
        return $this->db->update($this->_config->table["role"], $data, array("role_id" => $role_id));
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
    public function get_role_perms($role_id)
    {
        $this->db->select($this->_config->table["perm"] . ".*")
                ->from($this->_config->table["role_perm"])
                ->where("role_id", $role_id)
                ->join($this->_config->table["perm"], $this->_config->table["perm"] . ".perm_id = " . $this->_config->table["role_perm"] . ".perm_id");
        $perms = $this->db->get();
        return ($perms->num_rows() > 0) ? $perms->result() : FALSE;
    }

    /**
     * add permission to role
     *
     * @param	int		$role_id	the unique identifier for the role
     * @param	int		$perm_id	the unique identifier for the permission
     * @return	boolean	TRUE/FALSE - whether or not addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function add_role_perm($role_id, $perm_id)
    {
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
    public function del_role_perm($role_id, $perm_id)
    {
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
    public function edit_role_perms($role_id, $perm_array)
    {
        // bulk delete permissions for the role
        $this->db->delete($this->_config->table["role_perm"], array("role_id" => $role_id));
        // assume permissions all fail to set
        $rtn = TRUE;
        // add permissions provided in array
        foreach ($perm_array as $item => $perm_id)
        {
            if (!$this->add_role_perm($role_id, $perm_id))
            {
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
    public function get_all_perms()
    {
        $perms = $this->db->get($this->_config->table["perm"]);
        return ($perms->num_rows() > 0) ? $perms->result() : FALSE;
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
    public function get_perm_by($field, $value)
    {
        $this->db->where($field, $value);
        return $this->get_all_perms();
    }

    /**
     * get a specific permissions
     *
     * @param	int	$perm_id	the unique identifier for the permission (id not value)
     * @return	object	a CodeIgniter row object for permission
     * @see		http://ellislab.com/codeigniter/user-guide/database/results.html Documentation for CodeIgniter row object
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function get_perm($perm_id)
    {
        $perm = $this->get_perm_by("perm_id", $perm_id);
        return ($perm !== FALSE) ? $perm[0] : FALSE;
    }

    /**
     * add a permission
     *
     * @param	assoc_array	$data	the new permissions data
     * @return	boolean		TRUE/FALSE - whether addition was successful
     * @author	Patrick Johnson <patrick.johnson@avizium.com>
     */
    public function add_perm($data)
    {
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
    public function del_perm($perm_id)
    {
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
    public function edit_perm($perm_id, $data)
    {
        return $this->db->update($this->_config->table["perm"], $data, array("perm_id" => $perm_id));
//		return ($this->db->affected_rows() == 1);
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
    public function get_user_perms($user_id)
    {
        // hold on tight... this is a complicated one... and will be 
        // rolled into a single sql query if possible at a later date w/ diff logic. (might be possible)
        $rtn = array();

        // get users roles
        $role_list = $this->get_user_roles($user_id);

        // check role(s) set
        // for each role get its perms and add them to return array
        if (is_array($role_list))
            foreach ($role_list as $role)
            {
                // get role perms
                $perm_list = $this->get_role_perms($role->role_id);
                // check perms assigned to role
                if (is_array($perm_list))
                    foreach ($perm_list as $perm)
                    {
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
    public function user_has_perm($user_id, $slug)
    {
        $user_perms = $this->get_user_perms($user_id);
        // chek the user has some permissions
        // loop through users permissions and check for the slug
        if (is_array($user_perms))
            foreach ($user_perms as $perm)
            {
                // if slug is found then return TRUE
                if ($perm->slug == $slug)
                {
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
    public function user_has_role($user_id, $slug)
    {
        $user_roles = $this->get_user_roles($user_id);

        if (is_array($user_roles))
            foreach ($role_list as $role)
            {
                if ($role->slug == $slug)
                {
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
    public function get_paged_list_pendrequest($limit = 10, $offset = 0)
    {
        $this->db->order_by("user_id", "asc");
        return $this->db->get($this->admin_request, $limit, $offset);
    }

    public function get_by_id_pendrequest($user_id)
    {
        $this->db->where("user_id", $user_id);
        return $this->db->get($this->admin_request);
    }

    public function delete_approved_request($user_id)
    {
        // after request has been approved, delete from pending table
        $this->db->where("user_id", $user_id);
        return $this->db->delete($this->admin_request);
    }

    public function approve_request($user_id, $new_acct)
    {
        // check if this request has been previously approved before inserting
        $this->db->where("username", $this->input->post("username"));
        $this->db->where("email_address", $this->input->post("email_address"));
        $query = $this->db->get($this->admin_user);
        if ($query->num_rows != 1)
        {
            $insert = $this->db->insert($this->admin_user, $new_acct);
            return $insert;
        }
        else
        {
            return DUPLICATE_ADMIN;
        }
    }

    public function count_all_pendrequest()
    {
        return $this->db->count_all($this->admin_request);
    }

    function get_logs()
    {
        $this->db->select("uri, method, ip_address");
        $this->db->from("logs");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function get_schooltype()
    {
        return $this->db->get($this->schooltype);
    }

    public function get_schools($school_id)
    {
        $this->db->select("Name");
        $this->db->where("SchoolTypeID", $school_id);
        $this->db->from($this->schools);
        $query = $this->db->get();
        $schools = array();
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $schools[] = $row;
            }
            return $schools;
        }
    }

    public function get_students($sifnum)
    {
        //Manager user lsit
        $limitToUserID = null;
        $managedUsers = $this->get_managed_users($admin_user_field_name = "username", $limitToUserID);
        $flip = array_flip($managedUsers);
        $nur = $this->session->userdata('username');
        $managedUserList_new = array_flip($flip);
        $managedUserList = "'" . implode("','", $managedUserList_new) . "'";
        if ($user_role == 50):
            $managedUserList = $managedUsers[0];
        endif;
        //Manager user lsit end
        $sif = $_POST['term'];
        $students = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE wizard_sif_num != 0 AND wizard_sif_num like  '%$sif%' and  `wizard_by` IN
                                        (" . $managedUserList . ")  GROUP BY `wizard_sif_num` ORDER BY `unique_number` Desc");
        if ($user_role <= 20):
            $students = $this->db->query("SELECT *, MAX(`wizard_id`) AS wizard_id FROM (`form_sessions`)
                                       WHERE wizard_sif_num != 0 AND wizard_sif_num like  '%$sif%'  GROUP BY `wizard_sif_num` ORDER BY `unique_number` Desc");
        endif;
        return $students;
    }

    // nurse search by SIF only
    public function get_sif($nurse_data)
    {
        $this->db->select("wizard_id, wizard_sif_num");
        $this->db->like('wizard_sif_num', $nurse_data['sif']);
        $this->db->group_by("wizard_sif_num");
        $this->db->from($this->students);
        $sif = $this->db->get();
        foreach ($sif->result_array() as $row)
        {
            $data[] = $row;
        }
        return $sif;
    }

    //check_form_status
    public function check_form_status($formtype, $sif, $unum)
    {
        $this->db->select("wizard_status");
        $this->db->from($this->students);
        if ($formtype == "Assessment"):
            $this->db->where('wizard_num', "assessment_wiz16_" . $sif);
        else:
            $this->db->where('wizard_num', "appraisal_wiz06_" . $sif);
        endif;
        $this->db->where('unique_number', $unum);
        $sql = $this->db->get();
        if ($sql->num_rows() >= 1):
            $res = $sql->row_array();
            return $res['wizard_status'];
        else:
            return FALSE;
        endif;
    }

    public function pretty_print($post_array)
    {
        $post = array();
        foreach ($post_array as $key => $value)
        {
            echo $key . "&nbsp;&nbsp;=>&nbsp;&nbsp;" . $this->input->post($key) . "<br>";
        }
    }

    public function form_status($status)
    {
        $this->db->select("status_types.display_name");
        $this->db->join($this->students, $this->students . ".wizard_status = " . $this->status_types . ".`value`", "inner");
        $this->db->where($this->status_types . ".`value`", $status);
        $this->db->group_by($this->students . ".wizard_status");
        $query = $this->db->get($this->status_types);
        if ($query->num_rows > 0)
        {
            return $query->row("display_name");
        }
    }

    public function get_user_manager($user)
    {
        $this->db->select($this->_config->table["user_manager"] . ".*");
        $this->db->where("manage_by", $user);
        return $this->db->get($this->_config->table["user_manager"]);
    }

    public function check_nursedata($sif,$unum)
    {
        $sql = $this->db->select('*')
                ->from('form_sessions')
                ->where('wizard_sif_num', $sif)
                ->where('unique_number', $unum)
                ->where('wizard_by', $this->session->userdata("username"))
                ->group_by('wizard_sif_num')
                ->get();

        $count = $sql->num_rows();
        if ($count >= 1):
            return $count;
        else:
            return 0;
        endif;
    }
    public function check_basic_details($sif,$unum,$form)
    {
        $sql = $this->db->select('birth_date,student_school')
                ->from('form_sessions')
                ->where('wizard_sif_num', $sif)
                ->where('unique_number', $unum)
                ->order_by('wizard_sif_num')
                ->get();

        $count = $sql->num_rows();
        if ($count >= 1):
            $res = $sql->row_array(); 
            return $res;
        else:
            return 0;
        endif;
    }

    public function check_assessment_comments($sif, $unum)
    {
        $sql = $this->db->select('user_id')
                ->from('assessment_comments')
                ->where('sif', $sif)
                ->where('sif_unique_number', $unum)
                ->order_by('last_changed', 'DESC')
                ->get();
//         echo $this->db->last_query();
//         echo '<br>';
//        exit;
        $count = $sql->num_rows();
        if ($count >= 1):
            return $sql->row("user_id");
        else:
            return FALSE;
        endif;
    }

    public function check_forms($user)
    {
        // check pending forms submitted
        $this->db->select("form_sessions.wizard_status, form_sessions.wizard_sif_num, form_sessions.wizard_state_num,
				form_sessions.first_name, form_sessions.last_name, form_sessions.wizard_by, admin_user.user_id");
        $this->db->join($this->_config->table["admin_user"], $this->students . ".wizard_by = " . $this->_config->table["admin_user"] . ".username", "inner");
        $this->db->where($this->students . ".wizard_status", PENDING);
        $this->db->group_by($this->students . ".wizard_sif_num");
        $query = $this->db->get($this->students);
        if ($query->num_rows > 0)
        {
            foreach ($query->result() as $row)
            {
                $manager = $this->get_user_manager($user)->result();
                foreach ($manager as $key => $value)
                {
                    echo $manager[$key]->manage_id;
                }
                if ($row["user_id"] == $manager)
                {
                    echo $manager->row("manage_id") . " match found...<br/>";
                }
                else
                {
                    echo "no match found...<br/>";
                }
            }
        }
    }
    
    public function get_user_forms($username)
    {

        $status = '5,15,25,35,45';

        $sql = "SELECT * FROM form_sessions where wizard_by in ('" . $username . "') AND wizard_status in (" . $status . ") group by wizard_sif_num,unique_number  order by wizard_created DESC ";

        $query = $this->db->query($sql, array((int) $offset, (int) $limit));
        
//        echo $this->db->last_query();
//        exit;

        return $query->result();
    }

}

/* End of file acl_model.php */
/* Location: ./application/models/acl_model.php */