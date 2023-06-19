<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class POD extends El_Model{
	protected $table = "pods";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "track_no","awb_ref","receiver_name","receiver_phone","received_date","received_time","dropper_id","e_signature_img","created_at","amount","cash_submitted","submitted_amount","submitted_date","source"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }

    public function worker(){
        return $this->belongsTo('App\Models\Php\Worker','dropper_id','id')->select(['id','full_name']);
    }
    

}



?>