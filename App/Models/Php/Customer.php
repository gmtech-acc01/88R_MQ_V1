<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Customer extends El_Model{
	protected $table = "customers";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "is_company","company_name","first_name","last_name","phone_no","email","address","password","status","sms_activated","email_activated","created_at","fcm_token","fcm_updated_at"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>