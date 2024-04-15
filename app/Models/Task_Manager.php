<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task_Manager extends Model
{
    use HasFactory;

    public $table = 'user_task_manager';
    
    protected $fillable = [
        'task_name',
        'description',
        'due_date',
    ];
}
