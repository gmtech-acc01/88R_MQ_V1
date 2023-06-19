<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class ItemMov extends El_Model{
	protected $table = "items_movs";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "track_no","awb_ref","worker_id","customer_id","status","description","created_at",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>