<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;
 

class Worker extends El_Model{
	protected $table = "workers";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "full_name","phone","email","password","address","role","created_at","fcm_token","fcm_updated_at"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>