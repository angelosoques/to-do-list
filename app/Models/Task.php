<?php

namespace App\Models;

use App\Constants\TaskConstants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'user_id'
    ];

    protected $casts = [
        'status'     => TaskConstants::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
