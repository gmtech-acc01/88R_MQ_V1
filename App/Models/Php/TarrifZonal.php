<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class TarrifZonal extends El_Model{
	protected $table = "tarrifs_zonal";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "weight_in_kg","zone_a","zone_b","zone_c","zone_d","zone_e","zone_f","zone_g","zone_h",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>