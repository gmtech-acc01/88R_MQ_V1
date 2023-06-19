<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Payment extends El_Model{
	protected $table = "payments";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "payment_for","track_no","awb_ref","customer_id","received_by_worker","amount","invoice_no","payment_ref","created_at",
        "source"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    


    public function customer(){
        return $this->belongsTo('App\Models\Php\Customer','customer_id')->select(['id','company_name','is_company','first_name','last_name','phone_no']);
    }

    public function worker(){
        return $this->belongsTo('App\Models\Php\Worker','received_by_worker')->select(['id','full_name']);
    }

}



?>