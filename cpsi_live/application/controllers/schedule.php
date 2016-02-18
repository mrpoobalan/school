<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

/**
 * AA-SchoolHealth Pilot Admin Controller
 *
 * @package	Admin Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.1.0-pre
 */
require APPPATH . '/libraries/aah_controller.php';

class schedule extends AAH_Controller {

    // number of records per page
    private $limit = 10;
    private $acl_table;

    public function __construct()
    {
        parent::__construct();

        $this->output->nocache();

        // bootstrap dashboard and access control model
        $this->load->model("schedule_model", "", TRUE);
        $this->load->model("adminui_model", "", TRUE);
        $this->load->model("schoolhealth_model", "", TRUE);
    }

    public function index()
    {

        //Send the mail for Nurse Supervisor (One week no changes)
        $sql = $this->schedule_model->email_to_nursesupervisor();
//        echo "<pre>";
//        print_r($sql);
//        echo "</pre>";
//        exit;
        $email_subject = "No changes in form";
        foreach ($sql as $val):
            $email_message = "Hello {$val['username']},<br><br>
                            <p>{$val['username']} has no changaes as last one week
                            </strong>. Please log in and review.</p><br>";
            $recipients = $val['email_address'] . "<br>";
            $this->sendEmail($recipients, $email_subject, $email_message);
        endforeach;
        //Send the mail for Program Manager (One Month no changes)
        $sql = $this->schedule_model->email_to_programmanager();
        $email_subject = "No changes in form as last one month";
        foreach ($sql as $val):
            $email_message = "Hello {$val['username']},<br><br>
                            <p>{$val['username']} has no changaes as last one month
                            </strong>. Please log in and review.</p><br>";
            $recipients = $val['email_address'] . "<br>";
            $this->sendEmail($recipients, $email_subject, $email_message);
        endforeach;
    }

    // generic send email fx
    private function sendEmail($recipient, $email_subject, $email_message)
    {
        // setup the email
        $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
        $this->email->to($recipient);
        $this->email->subject($email_subject);
        $this->email->message($email_message);
        // send the email
        $this->email->send();
    }

}

