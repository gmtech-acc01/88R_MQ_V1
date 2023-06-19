<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Country extends El_Model{
	protected $table = "countries";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "name","visible"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    
    
    public function regions(){
        return $this->hasMany('App\Models\Php\Region','country_id');
    }


}



?>