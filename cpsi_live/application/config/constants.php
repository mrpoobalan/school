<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
 |--------------------------------------------------------------------------
| Admin UI constants...
|--------------------------------------------------------------------------
|
| Default configurations for mail processing...
|
*/

define('FROM_EMAIL', 'noreply@aa-schoolhealth.org');
define('FROM_NAME', 'aa-schoolhealth.');
define('CC_EMAIL', 'noreply@aa-schoolhealth.org');
define('CC_NAME', 'aa-schoolhealth.');
define('APPROVAL_ADMIN','noreply@aa-schoolhealth.org');

//
//define('FROM_EMAIL', 'testmail5210@gmail.com');
//define('FROM_NAME', 'Test mail.');
//define('CC_EMAIL', 'testmail5210@gmail.com');
//define('CC_NAME', 'Test Mail.');
//define('APPROVAL_ADMIN', 'testmail5210@gmail.com');

/*
|--------------------------------------------------------------------------
| Admin UI constants...
|--------------------------------------------------------------------------
|
| Default configurations for account management...
|
*/
define('PASS_RESET_REQUIRED', 1);
define('PASS_RESET_NOT_REQUIRED', 0);
define('AUTH_PASS', 2);
define('DUPLICATE_ADMIN', 'admin_in_use');
define('DUPLICATE_REG', 'reg_user_exist');
define('NO_DUPLICATE_ADMIN', 1);
define('ADMIN', '10');
define('DEPUTY DIRECTOR', '20');
define('DIRECTOR', '20');
define('PROGRAM_MANAGER', '30');
define('NURSE_SUPERVISOR', '40');
define('NURSE', '50');
/*
|--------------------------------------------------------------------------
| Form status
|--------------------------------------------------------------------------
|
| Default configurations for form status...
|
*/

define('IN_PROGRESS', 5);
define('PENDING', 15);
define('REJECTED', 25);
define('ESCALATED', 35);
define('COMPLETED', 45);


define('AA_SESSION_NAME', MD5('AA-Session'));
define('AA_WIZARD_SESSION_DATA_NAME', MD5('wizard'));

// workflow constants
define('AA_WORKFLOW_APPROVE_TEMPLATE', 'APPROVE');
define('AA_WORKFLOW_ESCALATE_TEMPLATE', 'ESCALATE');
define('AA_WORKFLOW_EDIT_TEMPLATE', 'EDIT');
define('AA_WORKFLOW_REJECTFOREDIT_TEMPLATE', 'REJECTEDIT');

// track supported user status
define('USERSTATUS_BLOCK', 0);
define('USERSTATUS_ACTIVE', 1);

/* End of file constants.php */
/* Location: ./application/config/constants.php */

