<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;


echo "*** PHP R-MQ RECEIVER ***\n\n";
//error_reporting(E_ERROR | E_PARSE);
function type_of($var)
{
    if (is_array($var)) return "array";
    if (is_bool($var)) return "boolean";
    if (is_float($var)) return "float";
    if (is_int($var)) return "integer";
    if (is_null($var)) return "NULL";
    if (is_numeric($var)) return "numeric";
    if (is_object($var)) return "object";
    if (is_resource($var)) return "resource";
    if (is_string($var)) return "string";
    return "unknown type";
}
function write_message_to_file($message)
{
    $myFile = "./logs/logs.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    @fwrite($fh,"\n". $message); 
    @fclose($fh);
}



try{

	//create a connection
	$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
	$channel = $connection->channel();

	
	//channel declaration
	$channel->queue_declare('hello', true, false, false, false);
	echo " [*] Waiting for messages. To exit press CTRL+C\n";
	sleep(5);
	//NOTE: server is sending messages in async
	$callback = function ($msg) {

		//convert msgreceived to object
		$MSG_OBJ = json_decode($msg->body,true);
		echo "\n[ MSG ]".$MSG_OBJ['msg'] ."\n";
		write_message_to_file(date('Y-m-d H:i:s a')." \n[ SMG ] : ".$MSG_OBJ['msg']."\n");
	  	
	};

	//note: we may receive to a channel wen the producer did not publish 
	$channel->basic_consume('hello', '', false, true, false, false, $callback);

	while (count($channel->callbacks)) {
	    $channel->wait();
	}

}
catch(Exception $x){
	write_message_to_file(date('Y-m-d H:i:s a')." \n[ ERROR ] : ".$x->getMessage()."\n");

	//r-mq server is down
	echo "[ R-MQ ERROR ]";
	echo "Message:". $x->getMessage();

	
}




?>