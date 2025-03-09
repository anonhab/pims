<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'description'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relationship with Account

    public function accounts()
{
    return $this->hasMany(Account::class); // A role can have many accounts
}
}

