<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class security_guards extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

   

    protected $fillable =[
        'id',
        'name',
        'lastName',
        'email',
    ];
}
