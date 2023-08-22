<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AllUser extends Authenticatable
{
    use HasApiTokens,Notifiable, HasFactory;
    protected $table = 'alluser';
    protected $fillable = [
        "role",
        "name",
        "gender",
        "email",
        "phone",
        "address",
        "password",
        "semester",
        "sem_fk_id"
    ];
}
