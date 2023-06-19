<?php
namespace App\Workers\Email;
use App\Modules\GMailerModule;
use App\Modules\GoDaddyMailerModule;
use App\Modules\GSuiteMailerModule;


/*BOOTING*/
require_once("./../../../vendor/autoload.php");
use App\Models\Php\Database;
//Initialize Illuminate Database Connection
new Database("grand_queue_manager");




use App\Models\Core\AccountMail;



class MailWorker{


	public function __construct() {
    }


    public function send($acc_name,$g_list,$g_cc_list,$g_bcc_list,$header,$sub,$body,$isHTML = true){
    	$account = AccountMail::where('acc_no',$acc_name)->first();

    	if($account != null){
            //
            if($account->provider == "GODADDY"){
                $mail_worker = new GoDaddyMailerModule();
                $mail_worker->SEND_MAIL($account,$g_list,$g_cc_list,$g_bcc_list,$header,$sub,$body,$isHTML);
            }
            else if($account->provider == "GSUITE"){
                $mail_worker = new GSuiteMailerModule();
                $mail_worker->SEND_MAIL($account,$g_list,$g_cc_list,$g_bcc_list,$header,$sub,$body,$isHTML);
            }
            else{
                $mail_worker = new GMailerModule();
                $mail_worker->SEND_MAIL($account,$g_list,$g_cc_list,$g_bcc_list,$header,$sub,$body,$isHTML);
            }

    		
    	}else{
    		//$mail_worker = new GMailerModule();
    		//$mail_worker->SEND_MAIL(AccountMail::default_mail(),$g_list,$g_cc_list,$g_bcc_list,$header,$sub,$body,$isHTML);
    	}
    }


    //

    
}





