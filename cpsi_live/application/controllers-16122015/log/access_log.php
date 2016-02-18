<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

require APPPATH . '/libraries/aah_controller.php';
class Access_log extends AAH_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model("adminui_model", "", TRUE);
        $this->acl_conf = (object) $this->config->item("acl");
        $this->acl_table = & $this->acl_conf->table;
    }

    public function user_info()
    {
        // get user details
        $user = $this->adminui_model->get_by_user($user = $this->session->userdata("username"))->row();
        return $user;
    }

    function log_details()
    {
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["search_content"] = "access_log/log_details";
        $this->load->view("search/template", $data);
        $this->showLogForm();
    }

    function showLogForm()
    {
    	$this->table->set_empty("&nbsp;");
        $table_setup = array("table_open" => "<table id=\"results\" style=\"margin-left: 0%;\" class=\"tablesorter\">");
        $this->table->set_heading("LogId", "UserName","Date/Time","IP","Message");
        $view = array("class" => "btn btn-success btn-sm", "type" => "button");
        $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
        $delete = array("class" => "btn btn-danger btn-sm", "type" => "button",
            "data-toggle" => "confirmation");

        foreach ($forms as $form)
        {
        	if (!empty($form))
            {
            	 $this->table->add_row("1","ss","12","23","s");
            }
        }

        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
    }

}
