<?php
namespace App\Modules; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

 /*
 set_time_limit(0);
 ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(0);*/

function test(){
    echo "TEST";
}


class GMailerModule{
    public function __construct() {
    }


    public function SEND_BASIC_EMAIL(){
        echo "GMailerModule-- \n";
    	//C:\Program Files\app_certificates\
    	/*$ch = curl_init();
    	$certificate_location = "C:\Program Files (x86)\EasyPHP-Devserver-16.1\ca-bundle.crt"; // modify this lineaccordingly (may need to be absolute)
		curl_setopt($ch, CURLOPT_CAINFO, $certificate_location);
		curl_setopt($ch, CURLOPT_CAPATH, $certificate_location);
    	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_exec($ch);
		*/
		$mail = new PHPMailer;
		$mail->isSMTP();                            // Set mailer to use SMTP
		
	    $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
	    $mail->SMTPAuth = true;  // authentication enabled
	    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
	    $mail->SMTPAutoTLS = false;
	    $mail->Host = 'smtp.gmail.com';
	    $mail->Port = 587;

	    $mail->Username = 'grand123grand1@gmail.com';
        $mail->Password = 'Dangerboy@123';

		$mail->setFrom('grand123grand1@gmail.com', 'GMASTER_FRAMEWORK');
		$mail->addAddress('grand123grand1@gmail.com');   // Add a recipient
		$mail->isHTML(true);  // Set email format to HTML

		$bodyContent = '<h1>..HeY!,</h1>';
		$bodyContent .= '<p>This is a email that Grand send you From LocalHost using PHPMailer</p>';
		$mail->Subject = 'Email from Localhost by GrandMaster';
		$mail->Body    = $bodyContent;
		if(!$mail->send()) {
		  return "".$mail->ErrorInfo;
		} else {
		  return "Msg send";
		}
    }
    //
    public function SEND_MAIL($g_to_list,$g_subject,$g_body,$g_isHtml = true){
        echo "GMailerModule-- \n";
        $mail = new PHPMailer;
        $mail->isSMTP();                            // Set mailer to use SMTP

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        $mail->Host = 'smtp.gmail.com';//
        //$mail->Host = 'mail.dar-averi.com';//
        $mail->Port = 587;

        $mail->Username = 'grand123grand1@gmail.com';
        //mail->Username = 'deograciousngereza@dar-averi.com';
        $mail->Password = 'Dangerboy@123'; //emjeys.devs@12345
        $mail->setFrom('grand123grand1@gmail.com', 'Emjeys');
        
        for($i = 0; $i <sizeof($g_to_list);$i++){
            //$mail->addAddress('deograciousngereza@gmail.com');   // Add a recipient
            $mail->addAddress($g_to_list[$i]);
        }

        $mail->isHTML($g_isHtml);  // Set email format to HTML

        $bodyContent = $g_body;
        $mail->Subject = $g_subject;
        $mail->Body    = $bodyContent;
        if(!$mail->send()) {
          return "".$mail->ErrorInfo;
        } else {
          return "Msg send";
        }
    }


    public function any_SEND_MAIL($g_to_list,$g_subject,$g_body,$g_isHtml = true){
        echo "GMailerModule-- \n";
        $mail = new PHPMailer;
        $mail->isSMTP();                            // Set mailer to use SMTP

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->SMTPAutoTLS = false;
        //$mail->Host = 'smtp.gmail.com';//
        $mail->Host = 'mail.dar-averi.com';//
        $mail->Port = 587;

        //$mail->Username = 'grand123grand1@gmail.com';
        $mail->Username = 'deograciousngereza@dar-averi.com';
        $mail->Password = 'Dangerboy@123';
        $mail->setFrom('deograciousngereza@dar-averi.com', 'GMASTER_FRAMEWORK');
        
        for($i = 0; $i <sizeof($g_to_list);$i++){
            //$mail->addAddress('deograciousngereza@gmail.com');   // Add a recipient
            $mail->addAddress($g_to_list[$i]);
        }

        $mail->isHTML($g_isHtml);  // Set email format to HTML

        $bodyContent = $g_body;
        $mail->Subject = $g_subject;
        $mail->Body    = $bodyContent;
        if(!$mail->send()) {
          return "".$mail->ErrorInfo;
        } else {
          return "Msg send";
        }
    }





    public function xSEND_MAIL($g_from_name,$g_sub,$g_body,$g_abody,$g_astatus,$g_apath){
        $m = new PHPMailer;
    
        $m->isSMTP();
        $m->SMTPAuth = true;

        /*$m->Host = 'mail.maxcomafrica.com';
        $m->Username = 'noreply.recon@maxcomafrica.com';
        $m->Password = 'm@xcomd3v3l0per';*/
        $m->SMTPSecure = 'ssl';
        $m->Port = 587;
    
    
        $m->From = 'grand123grand1@gmail.com';
        $m->FromName = $g_from_name;
        $m->addReplyTo('grand123grand1@gmail.com');

        //add more addresses here
        $m->addAddress('grand123grand1@gmail.com', 'Grand Master');
        //$m->addAddress('boniphace.masselle@maxcomafrica.com', 'Bony Masselle');
        //
        
        $m->Subject = $g_sub;
    
        $m->Body = $g_body;
        $m->AltBody = $g_abody;
    
        if($g_astatus == 1){
           $m->addAttachment($g_apath);
        }
        //var_dump($m->send());
    }

};

    

   

?>