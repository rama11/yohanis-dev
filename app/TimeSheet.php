<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    //
    protected $table = 'time_sheet';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_customer',
        'id_pid',
        'id_user',
        'activity',
        'site',
        'duration',
        'duration_num',
        'status',
        'approved',
        'submited',
        'comment',
        'submited_at',
        'approved_at',
        'execute_at'
    ];

}
