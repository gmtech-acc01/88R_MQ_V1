<?php

require_once("./vendor/autoload.php");
//require_once __DIR__."./local_autoload.php";
use App\Workers\Email\MailWorker;

/////init sample



$app = new MailWorker();
$htm1 = "<table style='width:98%; margin-left:1%; margin-top:20px; background-color:#eb8c39;'>
<tr style='border:1px red; background-color:#f5c5dd;'><td align='center' colspan='11' style='border:1px red; height:50px;'>
<a style='text-decoration:none; color:blue; font-weight:bold; font-size:14px;'>MAXOFFICE ALERTS IN THE PAST HOUR::</a></td></tr>
<tr style='border:1px red; background-color:#eb8c39;'>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>payment_reference</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>receipt_no</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>amount</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>transaction_status</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>new_balance</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>DepositStatus</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>ServiceType</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>comments</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>Retailer_Name</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>CreditLimit</a></td>
<td align='center' style='border:1px red;'><a style='text-decoration:none; color:blue; font-weight:bold; font-size:13px;'>receipt_date</a></td>
</tr></table>";

$app->send(["deograciousngereza@gmail.com"],"MAX-TEST",$htm1);
//$app->send();



//$mail = new PHPMailer;





?>