<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    //public $fillable = ['name','email','otp','password'];

    protected $fillable = ['name', 'email', 'otp', 'password'];


    protected $attributes = ["otp"=>'0'];

    use HasFactory;
}
