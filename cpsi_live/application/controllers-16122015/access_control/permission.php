<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Permissions Controller
 *
 * @package	Permission Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.0.0-pre
 */
class Permission extends CI_controller {

    // number of records per page
    private $limit = 10;
    private $acl_table;

    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        // bootstrap dashboard and access control model
        $this->load->model("adminui_model", "", TRUE);
        $this->acl_table = (object) $this->config->item("acl");
        $this->acl_table = & $this->acl_table->table;
    }
     

    public function is_logged_in()
    {
        $is_logged_in = $this->session->userdata("is_logged_in");
        if (!isset($is_logged_in) || $is_logged_in != TRUE)
        {
            echo "You don't have permission to access this page. " . anchor("/login", "Login Now");
            die();
        }
    }

    // get user info
    public function user_info()
    {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "access_acl"))
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Return to previous page..."'));
        }
        // get user details
        $user = $this->adminui_model->get_by_user($user = $this->session->userdata("username"))->row();
        return $user;
    }

    public function permission_manager($offset = 0)
    {
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_perms"))
        {
            show_error("Permission denied.", 401);
        }
        //offset
        $uri_segment = 4;
        $offset = $this->uri->segment($uri_segment);
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["action"] = site_url("search/student_search/find_student");
        // load data
        $perms = $this->adminui_model->get_perm_paged_list($this->limit, $offset)->result();
        // generate pagination
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = "Permissions Manager";
        $data["panel_title"] = "AdminUI Permissions";
        $config["base_url"] = site_url("access_control/permission/permission_manager/");
        $config["total_rows"] = $this->adminui_model->count_all_perms();
        $config["per_page"] = $this->limit;
        $data["add_perm"] = site_url("access_control/permission/add_perm");
        $config["uri_segment"] = $uri_segment;
        $config["anchor_class"] = "class=\"btn btn-primary btn-sm\"";
        $this->pagination->initialize($config);
        $data["pagination"] = $this->pagination->create_links();
        // generate table data
        $this->table->set_empty("&nbsp;");
        $table_setup = array("table_open" => "<table class=\"table table-striped table-bordered table-hover\">");
        $this->table->set_heading("#No", "Slug", "Name", "Description", "Actions");
        $i = 0 + $offset;
        $view = array("class" => "btn btn-success btn-sm", "type" => "button");
        $update = array("class" => "btn btn-warning btn-sm", "type" => "button");
        $delete = array("class" => "btn btn-danger btn-sm", "type" => "button",
            "data-toggle" => "confirmation");
        foreach ($perms as $perm)
        {
            $this->table->add_row(++$i, $perm->slug, $perm->name, $perm->description, anchor("access_control/permission/perm_view/" . $perm->perm_id, "<i class =\"fa fa-search\"></i>", $view) . " " .
                    anchor("access_control/permission/perm_update/" . $perm->perm_id, "<i class =\"fa fa-edit\"></i>", $update) . " " .
                    anchor("access_control/permission/perm_delete/" . $perm->perm_id, "<i class =\"fa fa-trash-o\"></i>", $delete)
            );
        }
        $this->table->set_template($table_setup);
        $data["table"] = $this->table->generate();
        // load account view
        $data["acl_content"] = "access_control_view/permission_manager";
        $this->load->view("access_control/template", $data);
    }

    public function add_perm()
    {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "add_perm"))
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $this->_set_perm_rules();
        //Add Validation Rules here..
        if ($this->form_validation->run() == FALSE)
        {
            // set common properties
            $this->session->set_flashdata('data', validation_errors());
            $data["title"] = "AA-SchoolHealth Dashboard";
            $data["subtitle"] = "Add Permission";
            $data["panel_title"] = "AdminUI Permissions";
            $data["link_back"] = anchor("access_control_view/permission/permission_manager/", " Back to list of permissions", array("type" => "button"));
            $data["add_perm"] = site_url("access_control/permission/permission_manager#add_permission");
            $data["acl_content"] = "access_control_view/permission_manager";
            redirect("access_control/permission/permission_manager#add_permission");
        }
        else
        {
            $new_perm = array(
                "name" => $this->input->post("name"),
                "slug" => $this->input->post("slug"),
                "description" => $this->input->post("description")
            );

            $this->adminui_model->add_perm($new_perm);
            redirect("access_control/permission/permission_manager/1/add_perm?success_message=success#add_permission");
        }
    }

    public function perm_view($perm_id)
    {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "view_perms"))
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["action"] = site_url("search/student_search/find_student");
        // set common properties
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = "Permission View";
        $data["link_back"] = anchor("access_control/permission/permission_manager/", " Back to list of permissions", array("type" => "button"));
        // get permission details
        $data["perm"] = $this->adminui_model->get_perm($perm_id);
        // load view
        $data["acl_content"] = "access_control_view/permission_view";
        $this->load->view("access_control/template", $data);
    }

    public function perm_update($perm_id)
    {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "edit_perm"))
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["action"] = site_url("search/student_search/find_student");
        // prefill form values
        $perm = $this->adminui_model->get_perm($perm_id);
        $this->form_data->perm_id = $perm_id;
        $this->form_data->name = $perm->name;
        $this->form_data->slug = $perm->slug;
        $this->form_data->description = $perm->description;
        // set common properties
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = 'Modify Permission';
        $data["action"] = site_url("access_control/permission/permission_modify");
        $data["link_back"] = anchor("access_control/permission/permission_manager/", " Back to list of permission", array("type" => "button"));
        // load view
        $data["acl_content"] = "access_control_view/permission_modify";
        $this->load->view("access_control/template", $data);
    }

    public function permission_modify()
    {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "edit_perm"))
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $perm_id = $this->input->post("perm_id");
        //set validation properties
        $this->_set_change_perm_rules();
        //Add Validation Rules here..
        if ($this->form_validation->run() == FALSE)
        {
            // set common properties
            $this->session->set_flashdata('data', validation_errors());
            $data["title"] = "AA-SchoolHealth Dashboard";
            $data["subtitle"] = "Add Permission";
            $data["panel_title"] = "AdminUI Permissions";
            $data["link_back"] = anchor("access_control_view/permission/permission_manager/", " Back to list of permissions", array("type" => "button"));
            $data["add_perm"] = site_url("access_control/permission/permission_modify");
            $data["acl_content"] = "access_control_view/permission_modify";
            redirect("access_control/permission/perm_update/{$perm_id}");
        }
        else
        {
            $perm_pdo = array(
                "perm_id" => $this->input->post("perm_id"),
                "name" => $this->input->post("name"),
                "slug" => $this->input->post("slug"),
                "description" => $this->input->post("description")
            );
            $data["title"] = "AA-SchoolHealth Dashboard";
            $data["subtitle"] = "Modify Permission";
            $data["panel_title"] = "AdminUI Permission";
            $this->form_data->perm_id = $perm_id;
            $this->form_data->name = $this->input->post("name");
            $this->form_data->slug = $this->input->post("slug");
            $this->form_data->description = $this->input->post("description");
            //Update the permission
            $data["action"] = site_url("access_control/permission/perm_update/{$perm_id}");
            $data["link_back"] = anchor("access_control/permission/permission_manager/", " Back to list of permissions", array("type" => "button"));
            $data["acl_content"] = "access_control_view/permission_modify";
            $this->adminui_model->edit_perm($perm_id, $perm_pdo);
            redirect("access_control/permission/perm_update/{$perm_id}/?UpdateSuccess=success");
        }
    }

    public function perm_delete($perm_id)
    {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "delete_perm"))
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        // get user role
        $user_role = $this->adminui_model->get_user_role($acct_id = $this->session->userdata("user_id"));
        // parse user details
        $user = $this->user_info();
        $data["username"] = $user->username;
        $data["firstname"] = $user->first_name;
        $data["lastname"] = $user->last_name;
        $data["userrole"] = $user_role;
        $data["action"] = site_url("search/student_search/find_student");
        // prefill form values
        $perm = $this->adminui_model->get_perm($perm_id);
        $data["perm"] = $perm;
        // set common properties
        $data["title"] = "AA-SchoolHealth Dashboard";
        $data["subtitle"] = 'YOU ARE ABOUT TO DELETE A PERMISSION';
        $data["del_perm"] = site_url("access_control/permission/del_perm_process/{$perm_id}");
        $data["action"] = site_url("access_control/permission/permission_delete");
        $data["link_back"] = anchor("access_control/permission/permission_manager/", " Back to list of permission", array("type" => "button"));
        // load view
        $data["acl_content"] = "access_control_view/permission_delete";
        $this->load->view("access_control/template", $data);
    }

    public function del_perm_process($perm_id)
    {
        // check roles and permissions
        if (!$this->adminui_model->user_has_perm($this->session->userdata("user_id"), "delete_perm"))
        {
            show_error("You do not have access to this section " . anchor($this->agent->referrer(), "Return", 'title="Go back to previous page"'));
        }
        $this->adminui_model->del_perm($perm_id);
        redirect("access_control/permission/permission_manager/?del_success_message=success");
    }

    // validation rules
    protected function _set_perm_rules()
    {
        // set empty default form field values
        $this->form_data->name = "";
        $this->form_data->slug = "";
        $this->form_data->description = "";
        $this->form_validation->set_rules("name", "Name", "trim|min_length[3]|required|is_unique[perm.name]|xss_clean");
        $this->form_validation->set_rules("slug", "Slug", "trim|min_length[3]|required|is_unique[perm.slug]|xss_clean");
        $this->form_validation->set_rules("description", "Description", "trim|required|xss_clean");
        $this->form_validation->set_message("required", "* required");
        $this->form_validation->set_message("isset", "* required");
        $this->form_validation->set_message("is_unique", "%s value has already been taken. Please try a different value.");
        $this->form_validation->set_error_delimiters("<div>
                                                    <button type=\"button\">&times;</button>", "</div>");
    }

    // validation rules
    protected function _set_change_perm_rules()
    {
        // set empty default form field values
        $this->form_data->name = "";
        $this->form_data->slug = "";
        $this->form_data->description = "";
        $perm_id = $this->input->post('perm_id');
        $perm_obj = $this->adminui_model->get_perm($perm_id);
        $new_name = $this->input->post('name');
        $new_slug = $this->input->post('slug');
        if ($perm_obj->name != $new_name)
        {
            $this->form_validation->set_rules("name", "Name", "trim|min_length[3]|required|is_unique[perm.name]|xss_clean");
        }
        if ($perm_obj->slug != $new_slug)
        {
            $this->form_validation->set_rules("slug", "Slug", "trim|min_length[3]|required|is_unique[perm.slug]|xss_clean");
        }
        $this->form_validation->set_rules("description", "Description", "trim|required|xss_clean");
        $this->form_validation->set_message("required", "* required");
        $this->form_validation->set_message("isset", "* required");
        $this->form_validation->set_message("is_unique", "%s value has already been taken. Please try a different value.");
        $this->form_validation->set_error_delimiters("<div>
                                                    <button type=\"button\">&times;</button>", "</div>");
    }

}
