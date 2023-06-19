<?php
namespace App\Models;

use \Illuminate\Database\Eloquent\Model as El_Model;


class CashRequest extends El_Model{
	protected $table = "cash_requests";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "purpose","purpose_description","customer_id","for_worker_id","amt_requested","amt_given","approved","given","given_by","approved_by","approved_date","given_date","track_no","awb_ref","ref_no","created_at","updated_at",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>