<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class District extends El_Model{
	protected $table = "districts";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "region_id","country_id","name",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

    public function covered_areas(){
        return $this->hasMany('App\Models\Php\CoveredArea','district_id');
    }

}



?>