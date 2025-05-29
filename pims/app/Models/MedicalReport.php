<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalReport extends Model
{
    use HasFactory;

    protected $table = 'medical_reports';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'prisoner_id', 'doctor_id', 'diagnosis', 'treatment', 'medications', 'report_date', 'appointment_id', 'follow_up_date', 'notes', 'follow_up','prison_id'
    ];

    protected $casts = [
        'report_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'follow_up_date' => 'datetime',
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

    // Relationship with MedicalAppointment
    public function appointment()
    {
        return $this->belongsTo(MedicalAppointment::class, 'appointment_id', 'id');
    }
}