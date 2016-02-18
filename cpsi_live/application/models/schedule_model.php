<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth AdminUI Database Controller
 *
 * @package	CI Controller
 * @category Database Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.0.0-pre
 */
class schedule_model extends CI_Model {

    public $table = "form_sessions";
    private $admin_user = "admin_user";
    private $admin_request = "admin_request";
    private $request_assistance = "request_assistance";
    private $group_manager = "role";

    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }

    public function email_to_nursesupervisor()
    {
        $default = array();
        $totarray = array();
        $array_merge = array();
        $res_array = array();
        $sql = $this->db->query('SELECT form_sessions.wizard_sif_num as  wizard_sifnum,form_sessions.direct_report as userids,
        DATE_FORMAT(form_sessions.wizard_created,"%m/%d/%Y") AS cdate FROM form_sessions
        inner JOIN form_sessions_audit ON form_sessions_audit.wizard_sif_num = form_sessions.wizard_sif_num
        WHERE form_sessions_audit.operation = "insert" AND 
        DATE_FORMAT(form_sessions.wizard_created,"%m/%d/%Y") = DATE_FORMAT(curdate() + INTERVAL -7 DAY,"%m/%d/%Y") 
        GROUP BY form_sessions_audit.wizard_sif_num ');
        
        $result = $sql->result_array();
        $count = $sql->num_rows();
        if ($count >= 1):
            foreach ($result as $value):
                $sqlquery = $this->db->query("SELECT * FROM form_sessions_audit where form_sessions_audit.operation = 'update' and 
               wizard_sif_num = '" . $value['wizard_sifnum'] . "' and DATE_FORMAT(form_sessions_audit.wizard_modified,'%m/%d/%Y') =
                   '" . $value['cdate'] . "' group by wizard_sif_num");
                $res = $sqlquery->result_array();
                $update_count = $sqlquery->num_rows();
                if ($update_count == 0):
                    $res_array[] = array("sif" => $value['wizard_sifnum'], "user" => $value['userids']);
                else:
                    return False;
                endif;
           endforeach;
           exit;
        endif;

        $count = count($res_array);
        if ($count >= 1):
//            echo "come";
//            exit;
            foreach ($res_array as $val):

                $userid = $val['user'];
                $default[] = $val['sif'];
                $sql = $this->db->query('SELECT * FROM (`user_role`) WHERE user_id = ' . $userid . '');
                $res2 = $sql->row_array();
                $roleid = $res2['role_id'];
                $useridval = $res2['user_id'];
                $count2 = $sql->num_rows();
                if ($count2 >= 1):
                    if ($roleid == 6):
                        $sql = $this->db->query("select manage_by from user_manager where manage_id = '" . $useridval . "'");
                        $res31 = $sql->row_array();
                        $sql = $this->db->query("select user_id,username,email_address from admin_user where user_id = '" . $res31['manage_by'] . "'");
                        $res4 = $sql->row_array();
                        $result_merge[] = array_merge($res4, $default);
                        $default = "";
                    else:
                        $sql = $this->db->query("select user_id,username,email_address from admin_user where user_id = '" . $useridval . "'");
                        $res4 = $sql->row_array();
                        $result_merge[] = array_merge($res4, $default);
                        $default = "";
                    endif;
                endif;
            endforeach;
            if (count($result_merge) >= 1):
                return $result_merge;
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    }

    public function email_to_programmanager()
    {
        $default = array();
        $totarray = array();
        $array_merge = array();
        $res_array = array();
        $sql = $this->db->query('SELECT form_sessions.wizard_sif_num as  wizard_sifnum,form_sessions.direct_report as userids,
        DATE_FORMAT(form_sessions.wizard_created,"%m/%d/%Y") AS cdate FROM form_sessions
        inner JOIN form_sessions_audit ON form_sessions_audit.wizard_sif_num = form_sessions.wizard_sif_num
        WHERE form_sessions_audit.operation = "insert" AND 
        DATE_FORMAT(form_sessions.wizard_created,"%m/%d/%Y") = DATE_FORMAT(curdate() + INTERVAL -30 DAY,"%m/%d/%Y") 
        GROUP BY form_sessions_audit.wizard_sif_num ');
        $result = $sql->result_array();
        $count = $sql->num_rows();
        if ($count >= 1):
            foreach ($result as $value):
                $sqlquery = $this->db->query("SELECT * FROM form_sessions_audit where form_sessions_audit.operation = 'update' and 
               wizard_sif_num = '" . $value['wizard_sifnum'] . "' and DATE_FORMAT(form_sessions_audit.wizard_modified,'%m/%d/%Y') <>
                   '" . $value['cdate'] . "' group by wizard_sif_num");
                $res = $sqlquery->result_array();
                $update_count = $sqlquery->num_rows();
                if ($update_count == 0):
                    $res_array[] = array("sif" => $value['wizard_sifnum'], "user" => $value['userids']);
                endif;
            endforeach;
        endif;
        //Get the count here
        $count = count($res_array);
        if ($count >= 1):
            foreach ($res_array as $val):
                $userid = $val['user'];
                $default[] = $val['sif'];
                $sql = $this->db->query('SELECT * FROM (`user_role`) WHERE user_id = ' . $userid . '');
                $res2 = $sql->row_array();
                $roleid = $res2['role_id'];
                $useridval = $res2['user_id'];
                $count2 = $sql->num_rows();
                if ($count2 >= 1):
                    if ($roleid == 6):
                        $sql = $this->db->query("select manage_by from user_manager where manage_id = '" . $useridval . "'");
                        $res31 = $sql->row_array();
                        $sql = $this->db->query("select manage_by from user_manager where manage_id = '" . $res31 ['manage_by'] . "'");
                        $res3 = $sql->row_array();
                        $sql = $this->db->query("select user_id,username,email_address from admin_user where user_id = '" . $res3 ['manage_by'] . "'");
                        $res4 = $sql->row_array();
                        $result_merge[] = array_merge($res4, $default);
                        $default = "";
                    elseif ($roleid == 5):
                        $sql = $this->db->query("select manage_by from user_manager where manage_id = '" . $useridval . "'");
                        $res3 = $sql->row_array();
                        $sql = $this->db->query("select user_id,username,email_address from admin_user where user_id = '" . $res3 ['manage_by'] . "'");
                        $res4 = $sql->row_array();
                        $result_merge[] = array_merge($res4, $default);
                        $default = "";

                    elseif ($roleid == 4 || $roleid == 3 || $roleid == 2 || $roleid == 1):
                        $sql = $this->db->query("select user_id,username,email_address from admin_user where user_id = '" . $useridval . "'");
                        $res4 = $sql->row_array();
                        $result_merge[] = array_merge($res4, $default);

                        $default = "";
                    endif;
                endif;
            endforeach;


            if (count($result_merge) >= 1):
                return $result_merge;
            else:
                return FALSE;
            endif;
        else:
            return FALSE;
        endif;
    }

}
