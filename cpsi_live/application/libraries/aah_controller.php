<?php

// only attempt to define this class if hasn't already been defined 
if (!class_exists ('AAH_Controller'))
{
	
	/**
	 * AA-SchoolHealth Controller Extender
	 *
	 * @package	AA Health Base Controller
	 * @author	Elton Carr, II
	 * @link	http://avizium.com/
	 * @version 2.0.0-pre
	 */
	
	class AAH_Controller extends CI_Controller
	{
		function __construct()
		{
			if (session_status() == PHP_SESSION_NONE)
			{
				session_start();
			}
	
			parent::__construct();
		}
	
		function SaveWizardData($wizardName, $wizardData)
		{
			// TODO: obfuscate the session name used & encrypt everything saved
			$wizardJsonEncodedData = json_encode($wizardData);
	              
			// save the encoded data (encrypted)
			$_SESSION[ AA_SESSION_NAME ][ AA_WIZARD_SESSION_DATA_NAME ] [ $wizardName ] = $this->Encrypt($wizardJsonEncodedData);
		}
	
		function GetWizardData($wizardName)
		{
			// get the saved wizard data from session
			$wizardEncryptedData = null;
                       // echo $_SESSION[ AA_SESSION_NAME ][ AA_WIZARD_SESSION_DATA_NAME ] [ $wizardName ]
			if (isset($_SESSION[ AA_SESSION_NAME ][ AA_WIZARD_SESSION_DATA_NAME ] [ $wizardName ]) )
			{
				$wizardEncryptedData = $_SESSION[ AA_SESSION_NAME ][ AA_WIZARD_SESSION_DATA_NAME ] [ $wizardName ];

			}
	
			// decrypt & decode it
			return json_decode($this->Decrypt($wizardEncryptedData));
		}
	
		function ResetWizard()
		{
			$_SESSION[ AA_SESSION_NAME ][ AA_WIZARD_SESSION_DATA_NAME ] = array();
		}
	
		function Encrypt($jsonData)
		{
			//TODO: implement an appropriate encryption algorithm
			return $jsonData;
		}
	
		function Decrypt($encryptedData)
		{
			// TODO: implement an appropriate decyrption algorithm
			return $encryptedData;
		}
	}
}