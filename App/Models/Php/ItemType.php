<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class ItemType extends El_Model{
	protected $table = "items_types";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "name",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>