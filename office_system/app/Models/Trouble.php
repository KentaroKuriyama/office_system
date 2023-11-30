<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trouble extends Model
{
    use HasFactory;

    protected $fillable = [
        'function',
        'occurred_at',
        'phenomenon',
        'reproduction_steps',
        'cause',
        'cause_type',
        'cause_process',
        'corresponding_user_id',
        'corresponding_limit',
        'priority',
        'remarks',
        'status',
        'register_type',
        'create_user',
        'update_user',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function setTroubleReportFillable()
    {
        $this->fillable = [
            'function',
            'occurred_at',
            'phenomenon',
            'reproduction_steps',
            'priority',
            'status',
            'register_type',
            'create_user',
            'created_at',
            'updated_at'
        ];
    }

}
