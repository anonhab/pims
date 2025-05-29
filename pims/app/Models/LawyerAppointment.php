<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerAppointment extends Model
{
    use HasFactory;

    protected $table = 'lawyer_appointments';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'prisoner_id',
        'lawyer_id',
        'appointment_date',
        'status',
        'notes',
        'created_by',
        'prison_id'
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

    // Relationship with Account (Lawyer)
    public function lawyer()
    {
        return $this->belongsTo(Account::class, 'lawyer_id', 'user_id');
    }

    // Relationship with Account (Created By)
    public function createdBy()
    {
        return $this->belongsTo(Account::class, 'created_by', 'user_id');
    }
}
