<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Region extends El_Model{
	protected $table = "regions";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "country_id","name","visible"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }

    public function districts(){
        return $this->hasMany('App\Models\Php\District','region_id');
    }
    

}



?>