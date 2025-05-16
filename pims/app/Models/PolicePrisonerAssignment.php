<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicePrisonerAssignment extends Model
{
    use HasFactory;

    protected $table = 'police_prisoner_assignment';
    protected $primaryKey = 'assignment_id';

    protected $fillable = [
        'officer_id',
        'prisoner_id',
        'prison_id',
        'assignment_date',
        'assigned_by',
        'created_at',
        'updated_at',
    ];

    // Officer who was assigned (from accounts table)
    public function officer()
    {
        return $this->belongsTo(Account::class, 'officer_id', 'user_id');
    }

    // Assigned by user (also from accounts table)
    public function assignedBy()
    {
        return $this->belongsTo(Account::class, 'assigned_by', 'user_id');
    }

    // Prisoner being assigned
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id');
    }

    // Prison involved
    public function prison()
    {
        return $this->belongsTo(Prison::class, 'prison_id');
    }
}
