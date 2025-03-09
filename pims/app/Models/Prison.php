<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prison extends Model
{
    use HasFactory;

    protected $table = 'prisons';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'name', 'location', 'capacity', 'created_by', 'system_admin_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Account (Created by)
    public function creator()
    {
        return $this->belongsTo(Account::class, 'created_by', 'user_id');
    }

    // Relationship with Account (System Admin)
    public function systemAdmin()
    {
        return $this->belongsTo(Account::class, 'system_admin_id', 'user_id');
    }

    // Relationship with Rooms
    public function rooms()
    {
        return $this->hasMany(Room::class, 'prison_id', 'id');
    }
}
