<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Logout Controller
 *
 * @package Login Controller
 * @author Patrick K. Johnson Jr.
 * @link http://avizium.com/
 * @version 2.0.0-pre
 */
class Logout extends CI_Controller {

    function index()
    {
        $this->load->model("assessment_model", "", TRUE);
        $this->session->unset_userdata("is_logged_in");
        $sql = $this->assessment_model->delete_autosave();
        session_destroy();
        redirect("auth/login");
    }

}