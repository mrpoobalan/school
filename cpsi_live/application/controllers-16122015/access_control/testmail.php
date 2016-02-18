<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Role Controller
 *
 * @package	Role Controller
 * @author	Patrick K. Johnson Jr.
 * @link	http://avizium.com/
 * @version 2.0.0-pre
 */
class Testmail extends CI_controller {

    // number of records per page
    private $limit = 10;
    private $acl_table;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }

    public function index()
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'testmail5210@gmail.com';
        $config['smtp_pass'] = 'CGvak123';
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        //Send Email to Nurse Supervisor
        $this->email->from("" . FROM_EMAIL . "", "" . FROM_NAME . "");
        $this->email->to('mahendran@cgvakindia.com ');
        $this->email->cc("" . APPROVAL_ADMIN . "");
        $this->email->subject('Reg:New Assesment Record.');
        $body = "testing";
        $this->email->message($body);
        if ($this->email->send()):
            echo 'Your email was sent Successfully.';
        else:
            show_error($this->email->print_debugger());
        endif;
        exit;
    }

}
