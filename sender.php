<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;



echo "*** PHP R-MQ SENDER ***\n\n";
error_reporting(E_ERROR | E_PARSE);


try{

	//create a connection
	$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
	$channel = $connection->channel();

	
	//channel declaration
	$channel->queue_declare('hello', true, false, false, false);



	//send a message 
	$s = json_encode(["msg"=>"Hellow world","status"=>"OK"]);
	$msg = new AMQPMessage($s);
	$channel->basic_publish($msg, '', 'hello');

	echo " [x] Msg Sent.'\n";


	$channel->close();
	$connection->close();

	echo " \n[ Other tasks ] ";

}
catch(Exception $x){
	//r-mq server is down
	echo "[ R-MQ ERROR ]";
	//echo "Message:". $x->getMessage();
}




?>