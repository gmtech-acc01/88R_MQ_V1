<?php
namespace App\Models\Php;

use \Illuminate\Database\Eloquent\Model as El_Model;


class Manifest extends El_Model{
	protected $table = "manifests";
    protected $connection = 'default';
    public $timestamps = false;
    protected $fillable = [ 
        "track_no","awb_ref","customer_id","sch_date","sch_time","product_type","product_qty","description","product_est_weight","product_actual_weight","status","pickup_status","delivery_status","pickup_assigned_to","picked_date","picked_time","pickup_sign_img","img_pickup_proof","pickup_country_id","pickup_region_id","pickup_district_id","pickup_location_id","pickup_address","pickup_phone","sender","delivery_to","delivery_phone","delivery_country_id","delivery_region_id","delivery_district_id","delivery_location_id","delivery_address","delivery_assigned_to","payment_mode","  service_type","freight","notify_sms_on","notify_email_on","estimated_price","actual_price","processing_fee","paid_amount","exp_delivery_date","payment_status","invoice_no","creator_id","created_date","created_at",

            "storage_loc_pickup","delivered_time","delivered_date","delivery_sign_img","source"
    ];

    /*return db-fields structure*/
    public function tbl_fields(){
    	return $this->fillable;
    }
    
    public function customer(){
        return $this->belongsTo('App\Models\Php\Customer','customer_id')->select(['id','company_name','is_company','first_name','last_name','phone_no']);
    }
    public function company(){
        return $this->belongsTo('App\Models\Php\Customer','customer_id')->select(['id','company_name']);
    }
    public function delivery_covered_area(){
        return $this->belongsTo('App\Models\Php\CoveredArea','delivery_location_id')->select(['id','name']);
    }
    public function pickup_covered_area(){
        return $this->belongsTo('App\Models\Php\CoveredArea','pickup_location_id')->select(['id','name']);
    }
    

}



?>