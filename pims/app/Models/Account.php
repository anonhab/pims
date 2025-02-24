<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory;

    protected $table = 'Account'; // Assuming the correct table name is 'accounts'
    protected $primaryKey = 'user_id'; // Adjust if necessary
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'role',
        'prison_id',
        'first_name',
        'middle_name', // Added middle name
        'last_name',
        'email',
        'phone_number',
        'dob',
        'gender',
        'address',
        'user_image', // Added user image
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['dob', 'created_at', 'updated_at'];
}
