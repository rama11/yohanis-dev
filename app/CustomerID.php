<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerID extends Model
{
    protected $table = 'customer_id';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'code',
        'customer_name'
    ];
}
