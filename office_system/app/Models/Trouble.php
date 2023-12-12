<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Trouble extends Model
{
    use HasFactory;
    use Sortable;
    use SoftDeletes;

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

    /**
     * 障害報告内容をDBに保存する際の制限
     *
     * @return void
     */
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

    public function user()
    {
        return $this->belongsTo(User::class, 'corresponding_user_id', 'id');
    }
}
