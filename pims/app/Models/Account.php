<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts'; // Specify table name if it's different from the default

    protected $primaryKey = 'user_id';
    
    public $incrementing = false; // Since we are using UUID

    protected $keyType = 'string'; // UUID is a string

    protected $fillable = [
        'user_id', 'username', 'password', 'role_id', 'prison_id', 'first_name', 'last_name',
        'email', 'user_image', 'phone_number', 'dob', 'gender', 'address'
    ];

    protected $casts = [
        'dob' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Automatically generate UUID for user_id when creating a new account
   

    // Accessor for the password attribute
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value; // DO NOT HASH AGAIN
    }
    

    // Relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id'); // 'role_id' is the foreign key in the 'accounts' table
    }

    // Relationship with Prison (nullable)
    public function prison()
    {
        return $this->belongsTo(Prison::class, 'prison_id', 'id'); // Account has a relationship with Prison
    }

    // Handling user image storage (optional)
    public function setUserImageAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['user_image'] = $value;  // If it's already a path or URL
        } else if ($value) {
            // Handle file upload
            $this->attributes['user_image'] = $value->store('user_images', 'public');
        }
    }
}
