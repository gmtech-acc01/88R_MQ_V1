<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Invoice extends El_Model{
	protected $table = "invoices";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "invoice_no","req_amt","paid_amt","due_amt","cleared","payment_mode","payment_ref","paid_date","remarks","created_by","received_by","customer_id","due_date","description",
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    

}



?>