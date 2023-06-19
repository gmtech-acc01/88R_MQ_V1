<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Company extends El_Model{
	protected $table = "companies";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "name","country","region","box_no","address_1","address_2","phone_1","phone_2","email_1","email_2","url","tin","vrn","inv_swift_code","inv_tzs_acc","inv_usd_acc","inv_bank_name","inv_bank_branch"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    
   


}



?>