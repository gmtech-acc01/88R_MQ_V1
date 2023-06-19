<?php
/*

	MAIN 3 tasks
	1) filtering script (report script)
	2) draw UI with data
	3) send to mail

*/
namespace App\Schedules\Php\Orders;
require 'boot.php';

use App\Modules\MailerModule;

use App\Models\Php\Worker;
use App\Models\Php\Customer;
use App\Models\Php\CoveredArea;
use App\Models\Php\Manifest;
use App\Models\Php\Payment;
use App\Models\Php\POD;
use App\Models\Php\POP;


function send2Mail($data){
	/*send an email*/
	$mail_worker = new MailerModule();
    $mail_worker->SEND_MAIL(["deograciousngereza@gmail.com","komba.benjamin@gmail.com","simajnr@gmail.com"],"Order Reports",$data,true);

	/**/
}




function write_pop_not_submited(){
	$pop_not_submitted_cash = POP::select(['id','amount','track_no','picker_id','picked_date'])->where('amount','>',0)->where('cash_submitted',0)->with('worker')->get();
	$data = $pop_not_submitted_cash;
	$ui = "<table style='width:98%; margin-left:1%; margin-top:20px; background-color:#229B89;'>
		<tr style='border:1px #229B89; background-color:#229B89;'><td align='center' colspan='11' style='border:1px red; height:50px;'>
		<a style='text-decoration:none; color:white; font-weight:bold; font-size:19px;'>Emjeys POP cash to be collected. </a></td></tr>
		<tr style='border:1px white; background-color:#dd4646;color:white;padding:5px;font-size:15px;'>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; '>Date</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Track_no</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Amount</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Worker</a></td>
		</tr>";

	for($i = 0; $i < sizeof($data); $i++){
		$ui .= "<tr style='background-color:white;'>";
		$ui .= "<td>".$data[$i]->picked_date."</td>";
		$ui .= "<td>".$data[$i]->track_no."</td>";
		$ui .= "<td><b>".$data[$i]->amount."</b></td>";
		$ui .= "<td>".$data[$i]->worker->full_name."</td>";
		$ui .= "</tr>";
	}
 	$ui .= "</table>";
    
   	//echo $ui;
   	return ["data"=>$data,"ui"=>$ui ];
}
function write_pod_not_submited(){
	$pod_not_submitted_cash = POD::select(['id','amount','track_no','dropper_id','received_date'])->where('amount','>',0)->where('cash_submitted',0)->with('worker')->get();
	$data = $pod_not_submitted_cash;
	$ui = "<table style='width:98%; margin-left:1%; margin-top:20px; background-color:#229B89;'>
		<tr style='border:1px #229B89; background-color:#229B89;'><td align='center' colspan='11' style='border:1px red; height:50px;'>
		<a style='text-decoration:none; color:white; font-weight:bold; font-size:19px;'>Emjeys POD cash to be collected. </a></td></tr>
		<tr style='border:1px white; background-color:#dd4646;color:white;padding:5px;font-size:15px;'>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; '>Date</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Track_no</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Amount</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Worker</a></td>
		</tr>";

	for($i = 0; $i < sizeof($data); $i++){
		$ui .= "<tr style='background-color:white;'>";
		$ui .= "<td>".$data[$i]->received_date."</td>";
		$ui .= "<td>".$data[$i]->track_no."</td>";
		$ui .= "<td><b>".$data[$i]->amount."</b></td>";
		$ui .= "<td>".$data[$i]->worker->full_name."</td>";
		$ui .= "</tr>";
	}
 	$ui .= "</table>";
    
   	//echo $ui;
   	return ["data"=>$data,"ui"=>$ui ];
}


function write_todays_orders(){
	$todaysDate =date('Y-m-d');//
	$yesterdaysDate = date('Y-m-d', strtotime($todaysDate. ' - 1 days'));
	$dayB4YesterdaysDate = date('Y-m-d', strtotime($todaysDate. ' - 20 days'));
	$tomorrowsDate = date('Y-m-d', strtotime($todaysDate. ' + 1 days'));


    $Manifests = Manifest::where("created_at",">=",$dayB4YesterdaysDate)
    ->where("created_at","<=",$tomorrowsDate)
    //->with(['company'])
    ->orderBy('id','DESC')
    ->take(100)
    ->get();

    $data = $Manifests;

	$ui = "<table style='width:98%; margin-left:1%; margin-top:20px; background-color:#229B89;'>
		<tr style='border:1px #229B89; background-color:#229B89;'><td align='center' colspan='11' style='border:1px red; height:50px;'>
		<a style='text-decoration:none; color:white; font-weight:bold; font-size:19px;'>Emjeys Auto-report Recent Transactions </a></td></tr>
		<tr style='border:1px white; background-color:gray;color:white;'>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; font-size:13px;'>Date</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; font-size:13px;'>Track_no</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; font-size:13px;'>Status</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; font-size:13px;'>Paid</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; font-size:13px;'>Product</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; font-size:13px;'>Qty</a></td>
		</tr>";

	for($i = 0; $i < sizeof($data); $i++){
		$ui .= "<tr style='background-color:white;'>";
		$ui .= "<td>".$data[$i]->sch_date."</td>";
		$ui .= "<td>".$data[$i]->track_no."</td>";
		$ui .= "<td>".$data[$i]->status."</td>";
		$ui .= "<td>".$data[$i]->payment_status."</td>";
		$ui .= "<td>".$data[$i]->product_type."</td>";
		$ui .= "<td>".$data[$i]->product_qty."</td>";
		$ui .= "</tr>";
	}
 	$ui .= "</table>";
	

	//echo $ui;
   	return ["data"=>$data,"ui"=>$ui ];
	
}


function write_todays_sales(){
	$todaysStartDate =date('Y-m-d');//
	$todaysEndDate =date('Y-m-d');//
	$payments = Payment::with('customer')->get();//

	$data = $payments;


	$ui = "<table style='width:98%; margin-left:1%; margin-top:20px; background-color:#229B89;'>
		<tr style='border:1px #229B89; background-color:#ed652f;'><td align='center' colspan='11' style='border:1px red; height:50px;'>
		<a style='text-decoration:none; color:white; font-weight:bold; font-size:19px;'>Emjeys Todays Sales. </a></td></tr>
		<tr style='border:1px white; background-color:#229B89;color:white;padding:5px;font-size:15px;'>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; '>Date</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; '>For</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Track_no</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Amount</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Customer</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Invoice No</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Source</a></td>
		</tr>";

	for($i = 0; $i < sizeof($data); $i++){
		$ui .= "<tr style='background-color:white;'>";
		$ui .= "<td>".$data[$i]->created_at."</td>";
		$ui .= "<td>".$data[$i]->payment_for."</td>";
		$ui .= "<td>".$data[$i]->track_no."</td>";
		$ui .= "<td><b>".$data[$i]->amount."</b></td>";
		$ui .= "<td>".$data[$i]->customer->company_name."</td>";
		$ui .= "<td>".$data[$i]->invoice_no."</td>";
		$ui .= "<td>".$data[$i]->source."</td>";
		$ui .= "</tr>";
	}
 	$ui .= "</table>";

 		//echo $ui;
   	return ["data"=>$data,"ui"=>$ui ];
}

function write_footer(){
	$ui = "<br>";
	
	$ui .= "<br><br><center>Developed by: <span style='font-weight:bold;color:gray;'>Grand Technologies LTD</span><br>
	<span style='color:gray;'>www.</span>grandtech.co.tz</center>";
	//echo $ui;
   	return ["data"=>null,"ui"=>$ui ];
}

function write_header(){
	$ui = "<br>";
	$ui .= "<div style='margin-left:20px;'>";
	$ui .= "<br><br>Greetings  <span style='font-weight:bold;color:gray;'>Emjeys</span><br>

	<span>Please find Emjey's courier Report.</span><br>
	From: 
	<span style='color:gray;'>www.</span>grandtech.co.tz</center>";

	$ui .= "</div>";
		//echo $ui;
   	return ["data"=>null,"ui"=>$ui ];
}


//write your script over here
function config_script(){
	
	$todaysDate =date('Y-m-d');//
	$yesterdaysDate = date('Y-m-d', strtotime($todaysDate. ' - 1 days'));
	$dayB4YesterdaysDate = date('Y-m-d', strtotime($todaysDate. ' - 20 days'));
	$tomorrowsDate = date('Y-m-d', strtotime($todaysDate. ' + 1 days'));


    $Manifests = Manifest::where("created_at",">=",$dayB4YesterdaysDate)
    ->where("created_at","<=",$tomorrowsDate)
    //->with(['company'])
    ->orderBy('id','DESC')
    ->take(100)
    ->get();
	
	write_ui($Manifests);
}

function write_dashboard_summary(){
	//$todaysStartDate =date('Y-m-d') . " 00:00:01";//
	//$todaysEndDate =date('Y-m-d')." 23:59.59";//

	$todaysStartDate = "2019-01-01";
	$todaysEndDate = "2019-05-01";


	//todays total payments
	$sum_payments = Payment::where('created_at','>=',$todaysStartDate)
		->where('created_at','<=',$todaysEndDate)
		->sum('amount');
	
	$sum_pop_req = POP::where('created_at','>=',$todaysStartDate)
		->where('created_at','<=',$todaysEndDate)
		->where('amount','!=',0)
		->sum('amount');
	$sum_pop_submitted = POP::where('created_at','>=',$todaysStartDate)
		->where('created_at','<=',$todaysEndDate)
		->where('submitted_amount','!=',0)
		->where('cash_submitted',0)
		->sum('submitted_amount');
	$sum_pop_pending = $sum_pop_req - $sum_pop_submitted;

	$sum_pod_req = POD::where('created_at','>=',$todaysStartDate)
		->where('created_at','<=',$todaysEndDate)
		->where('amount','!=',0)
		->sum('amount');
	$sum_pod_submitted = POD::where('created_at','>=',$todaysStartDate)
		->where('created_at','<=',$todaysEndDate)
		->where('submitted_amount','!=',0)
		->where('cash_submitted',0)
		->sum('submitted_amount');
	$sum_pod_pending = $sum_pod_req - $sum_pod_submitted;


	$ui = "<table style='width:98%; margin-left:1%; margin-top:20px; background-color:#229B89;'>
		<tr style='border:1px #229B89; background-color:#ed652f;'><td align='center' colspan='11' style='border:1px red; height:50px;'>
		<a style='text-decoration:none; color:white; font-weight:bold; font-size:19px;'>Emjeys Summary</a></td>
		</tr>
		<tr>
			<div>
				POD : 
			</div>
		</tr>
		<tr style='border:1px white; background-color:#229B89;color:white;padding:5px;font-size:15px;'>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; '>Date</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none; font-weight:bold; '>For</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Track_no</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Amount</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Customer</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Invoice No</a></td>
			<td align='center' style='border:1px red;'><a style='text-decoration:none;  font-weight:bold; '>Source</a></td>
		</tr>";

	echo $ui;
	//var_dump($sum_pop_submitted);
}


//run
//config_script();

function init(){
	$ui_header = write_header()['ui'];
	$ui_sales = write_todays_sales()['ui'];
	$ui_orders = write_todays_orders()['ui'];
	$ui_pop_cash = write_pop_not_submited()['ui'];
	$ui_pod_cash = write_pod_not_submited()['ui'];
	$ui_footer = write_footer()['ui'];
	
	$ui = "";
	$ui .= $ui_header;
	$ui .= $ui_sales;
	$ui .= $ui_orders;
	$ui .= $ui_pop_cash;
	$ui .= $ui_pod_cash;
	$ui .= $ui_footer;
	

	//var_dump(write_todays_sales()['data']);
	write_dashboard_summary();

	//echo $ui;
	//send2Mail($ui);
}
init();


