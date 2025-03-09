<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prisoner extends Model
{
    use HasFactory;

    protected $table = 'prisoners';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'first_name', 'middle_name', 'last_name', 'dob', 'gender', 'marital_status', 
        'crime_committed', 'status', 'time_serve_start', 'time_serve_end', 'address', 
        'emergency_contact_name', 'emergency_contact_relation', 'emergency_contact_number', 
        'inmate_image', 'prison_id', 'room_id', 'assigned_inspector'
    ];

    protected $casts = [
        'dob' => 'date',
        'time_serve_start' => 'date',
        'time_serve_end' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Prison
    public function prison()
    {
        return $this->belongsTo(Prison::class, 'prison_id', 'id');
    }

    // Relationship with Room (nullable)
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    // Relationship with Inspector (nullable)
    public function assignedInspector()
    {
        return $this->belongsTo(Account::class, 'assigned_inspector', 'user_id');
    }
}
