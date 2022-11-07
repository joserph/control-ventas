<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'ventas';

    protected $fillable = ['date','identification','client','validity_id','service_id','status','total','payment_form','bank','modality','partner_id','sub_total','discount','aditional_price','user_id','user_update'];
	
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function validity(){
        return $this->belongsTo('App\Models\Vigencia', 'validity_id');
    }

    public function service(){
        return $this->belongsTo('App\Models\Servicio', 'service_id');
    }

    public function partner(){
        return $this->belongsTo('App\Models\Partner', 'partner_id');
    }
    
}
