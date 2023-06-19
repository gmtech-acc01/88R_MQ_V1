<?php
namespace App\Modules; 

require_once("./../../vendor/autoload.php");
use AfricasTalking\SDK\AfricasTalking;

class AfriTalkSMS{

	private $account_sid = "";
	private $auth_token = "53ddc9119e9d0529a597e519b0e73db1804d041aa2d1d2ee90a5d262726bdd8b";


	public function __construct(){
		
	}

	public function send_sms(){
		$username = 'sandbox'; // use 'sandbox' for development in the test environment
		$apiKey   = $this->auth_token; // use your sandbox app API key for development in the test environment
		$AT       = new AfricasTalking($username, $apiKey);

		// Get one of the services
		$sms      = $AT->sms();

		// Use the service
		$result   = $sms->send([
		    'to'      => '+255688059688',
		    'message' => 'Hellow GMTech Consult LTD'
		]);

		print_r($result);
	}


}

$m = new AfriTalkSMS();
$m->send_sms();