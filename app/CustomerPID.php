<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CustomerID;

class CustomerPID extends Model
{
    protected $table = 'customer_pid';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_customer',
        'pid'
    ];

    public function customerID(){
        return $this->hasOne(CustomerID::class,'id','id_customer');
    }
}
