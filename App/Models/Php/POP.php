<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class POP extends El_Model{
	protected $table = "pops";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "track_no","awb_ref","name","phone","amount","picker_id","e_signature_img","picked_date","picked_time","storage_loc","cash_submitted","submitted_amount","submitted_date","source"

    ];
    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }

    public function worker(){ 
        return $this->belongsTo('App\Models\Php\Worker','picker_id','id')->select(['id','full_name']);
    }
    

}



?>