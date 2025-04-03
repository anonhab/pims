<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prisoner extends Model
{
    use HasFactory;

    // Table associated with the model
    protected $table = 'prisoners';

    // Primary key field
    protected $primaryKey = 'id';

    // Disable auto-increment
    public $incrementing = false;

    // Set primary key type to string
    protected $keyType = 'string';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'id', 'first_name', 'middle_name', 'last_name', 'dob', 'gender', 'marital_status',
        'crime_committed', 'status', 'time_serve_start', 'time_serve_end', 'address',
        'emergency_contact_name', 'emergency_contact_relation', 'emergency_contact_number',
        'inmate_image', 'prison_id', 'room_id', 'assigned_inspector'
    ];

    // Type casting for attributes
    protected $casts = [
        'dob' => 'date',
        'time_serve_start' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with Prison
     * A prisoner belongs to one prison.
     */
    public function prison()
    {
        return $this->belongsTo(Prison::class, 'prison_id', 'id');
    }

    /**
     * Relationship with Room (nullable)
     * A prisoner belongs to one room (nullable relation).
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    /**
     * Relationship with Inspector (nullable)
     * A prisoner can have an assigned inspector.
     */
    public function assignedInspector()
    {
        return $this->belongsTo(Account::class, 'assigned_inspector', 'user_id');
    }

    /**
     * Relationship with Lawyers
     * A prisoner can have many assigned lawyers.
     */
    public function assignedLawyers()
    {
        return $this->belongsToMany(Lawyer::class, 'lawyer_prisoner_assignment', 'prisoner_id', 'lawyer_id');
    }

    /**
     * Relationship with Requests (optional)
     * A prisoner can have many requests.
     */
    public function requests()
    {
        return $this->hasMany(Requests::class, 'prisoner_id', 'id');
    }
}
