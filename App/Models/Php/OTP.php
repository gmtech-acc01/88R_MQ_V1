<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class OTP extends El_Model{
	protected $table = "otps";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "secrete","service_name","valid_till","customer_id","worker_id","otp_for","created_at",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>