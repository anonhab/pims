<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAppointment extends Model
{
    use HasFactory;

    protected $table = 'medical_appointments';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'prisoner_id', 'doctor_id', 'appointment_date', 'diagnosis', 'treatment', 'status', 'created_by','prison_id'
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Prisoner
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }

    // Relationship with Account (Doctor)
    public function doctor()
    {
        return $this->belongsTo(Account::class, 'doctor_id', 'user_id');
    }

    // Relationship with Account (Created By)
    public function createdBy()
    {
        return $this->belongsTo(Account::class, 'created_by', 'user_id');
    }
}
