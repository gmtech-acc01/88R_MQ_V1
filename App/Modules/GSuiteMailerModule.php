<?php
namespace App\Modules; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


/**/
use App\Models\Core\AccountMail;





class GSuiteMailerModule{

    private $accountModel;//AccountMail instance

    public function __construct() {
    }


    public function SEND_MAIL($config_model,$g_to_list,$g_cc_list,$g_bcc_list,$g_header,$g_subject,$g_body,$g_isHtml = true){

        ignore_user_abort(true); // Ignore user aborts and allow the script to run forever
        set_time_limit(0); //to prevent the script from dying

        $this->accountModel = $config_model;


        //echo $this->accountModel->customer_code;

        echo "MailerModule-- \n";
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
        $mail->Host = $this->accountModel->host;
        $mail->Port = $this->accountModel->port;

        
        $mail->Username = $this->accountModel->sender_email;
        $mail->Password = $this->accountModel->sender_password;
        $mail->setFrom($this->accountModel->from, $g_header);
        

        for($i = 0; $i <sizeof($g_to_list);$i++){
            $mail->addAddress($g_to_list[$i]);
        }
        for($i = 0; $i <sizeof($g_bcc_list);$i++){
            $mail->AddBCC($g_bcc_list[$i]);
        }
        for($i = 0; $i <sizeof($g_cc_list);$i++){
            $mail->AddCC($g_cc_list[$i]);
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


};

    

   

?>