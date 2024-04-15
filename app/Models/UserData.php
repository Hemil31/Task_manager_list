<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;


    public $table = 'user_data_tabel';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact',
        'password',
    ];



}
