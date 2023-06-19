<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class CoveredArea extends El_Model{
	protected $table = "covered_areas";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "district_id","region_id","country_id","name","zone",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>