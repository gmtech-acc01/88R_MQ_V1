<?php
namespace App\Workers\Email;
require_once("./../../../vendor/autoload.php");

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use App\Base\Listener;

use App\Workers\SMS\SMSWorker;

class SMSListener extends Listener{
	
    public function __construct() {	
    	$this->load_env();
    	echo "*** PHP R-MQ SMS RECEIVER ***\n\n";
    	echo "--".getenv('Q_NAME')."--\n";
    }

    public function log($m,$f='sms.txt'){
    	parent::log($m,$f);
    }

    private function load_env(){
    	//load env loader
    	$dotenv = \Dotenv\Dotenv::create(__DIR__);
		$dotenv->load();
    }

    public function check_inputs($data){
    	$truth = true;
    	if(!isset($data['account_no'])) $truth = false;
    	if(!isset($data['receiver_phone'])) $truth = false;
    	if(!isset($data['message'])) $truth = false;
    	return $truth;
    }


    public function listen(){ 
    	try{

			//create a connection
			$connection = new AMQPStreamConnection(getenv('HOST'), getenv('PORT'), getenv('USER'), getenv('PASSWORD'));
			$channel = $connection->channel();

			
			//channel declaration
			$channel->queue_declare(getenv('Q_NAME'), getenv('Q_PASSIVE_OPT'), getenv('Q_DURABLE_OPT'), getenv('Q_EXCLUSIVE_OPT'), getenv('Q_AUTODELETE_OPT'));
			//echo "--".getenv('QUEUE_NAME')."\n";
			echo "\n [*] Waiting for messages. To exit press CTRL+C\n";


			$channel->basic_qos(
	            null,//prefetch size - prefetch window size in octets, null meaning "no specific limit"
	            1,//prefetch count - prefetch window in terms of whole messages
	            null//global - global=null to mean that the QoS settings should apply per-consumer, global=true to mean that the QoS settings should apply per-channel
            );
			 

			//note: we may receive to a channel wen the producer did not publish 
			//$channel->basic_consume(getenv('Q_NAME'), '', false, true, false, false, $callback);
			$channel->basic_consume(
				getenv('Q_NAME'),
				'gmtech-'.getmypid(),//consumer tag - Identifier for the consumer, valid within the current channel. just string
	            false,//no local - TRUE: the server will not send messages to the connection that published them
	            false,//no ack, false - acks turned on, true - off.  send a proper acknowledgment from the worker, once we're done with a task
	            false,//exclusive - queues may only be accessed by the current connection
	            false,//no wait - TRUE: the server will not respond to the method. The client should not wait for a reply method
	            array($this, 'process') //callback
			); 

			while (count($channel->callbacks)) {
				echo ("\nWaiting for incoming messages");
			    $channel->wait();
			}

			$channel->close();
        	$connection->close();
		}
		catch(\Exception $x){
			$this->log(date('Y-m-d H:i:s a')." \n[ ERROR ] : ".$x->getMessage()."\n");

			//r-mq server is down
			echo "[ R-MQ ERROR ]";
			$this->listen();//recurr
			//echo "Message:". $x->getMessage();
		}
    }


     /**
     * process received request
     * 
     * @param AMQPMessage $msg
     */ 
    public function process(AMQPMessage $msg)
    {

        //convert msgreceived to object
		$MSG_OBJ = json_decode($msg->body,true);
		$fine = $this->check_inputs($MSG_OBJ);
		if($fine == false) { 
			echo "\nINVALID INPUTS\n";
			return ;
		}

		

		/*send sms*/
		$worker = new SMSWorker();
		$worker->send_sms($MSG_OBJ['account_no'],$MSG_OBJ['receiver_phone'],$MSG_OBJ['message']);
		/**/


		//echo "\n[ SMS ] ".$MSG_OBJ['subject'] ."\n";
		$this->log('['.getmypid().'-'.getenv('Q_NAME').'-'.$MSG_OBJ['account_no'].'] '. date('Y-m-d H:i:s')." \n[ SMS ] : ".$MSG_OBJ['receiver_phone']."","sms.txt");

        
        /**
         * If a consumer dies without sending an acknowledgement the AMQP broker 
         * will redeliver it to another consumer or, if none are available at the 
         * time, the broker will wait until at least one consumer is registered 
         * for the same queue before attempting redelivery
         */ 
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    }

 
}




/*START LISTENING*/
$listener = new SMSListener;//$listener->log('shutdown','email.txt');
try{
	echo "listener with ID: ".getmypid().' running...';
	$listener->log("RUN::[ ".getmypid()." ]",'sms.txt');
	$listener->listen();
}catch(\Exception $e){//SystemExit
	echo 'Script executed with success', PHP_EOL;
	$listener->log("SHUTDOWN::[ ".getmypid()." ]",'sms.txt');
}





?>