<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class CustomerAddress extends El_Model{
	protected $table = "customers_addresses";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "customer_id","country_id","region_id","district_id","name","location_id","specific_area","phone","address_for","updated_at",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){ 
    	return $this->fillable;
    }  
    

}



?>