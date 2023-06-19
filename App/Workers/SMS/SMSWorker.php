<?php
namespace App\Workers\SMS;

use App\Modules\SMSNexmoModule;
use App\Modules\SMSFastHub;
use App\Modules\SMSMoveSms;
use App\Modules\SMSTwilioModule;

/*BOOTING*/
require_once("./../../../vendor/autoload.php");
use App\Models\Php\Database;
//Initialize Illuminate Database Connection
new Database("grand_queue_manager");

use App\Models\Core\AccountSms;


class SMSWorker{


	public function __construct() {
    }



    public function send_sms($acc_no,$receiver_phone,$sms_body){
    	//load account details to view the provider
    	$account = AccountSms::where('acc_no',$acc_no)->first();
    	if($account != null){
            //
            if($account->provider == "TWILIO"){
                $worker = new SMSTwilioModule();
                $worker->send_sms($account,$receiver_phone,$sms_body);
            }
            else if($account->provider == "NEXMO"){
                $worker = new SMSNexmoModule();
                $worker->send_sms($account,$receiver_phone,$sms_body);
            }
            else if($account->provider == "MOVESMS"){
                $worker = new SMSMoveSms();
                $worker->send_sms($account,$receiver_phone,$sms_body);
            }
            else{
            	//FASTHUB
                $worker = new SMSFastHub();
                $worker->send_sms($account,$receiver_phone,$sms_body);
            }

    		
    	}else{
    		//$worker = new SMSFastHub();
            //$worker->send_sms($account,$receiver_phone,$sms_body);
    	}
    }


    
}

/*
    Listener -> listen from a queue
    Listerner -> call -> worker
    worker -> call specific module(sms/email module)
*/
//$m = new SMSWorker;
//$m->send_sms("GMFH01","255788449030","Greetings Brother.\n@Gmtech Development Team");


?>





