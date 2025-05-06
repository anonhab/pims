<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerPrisonerAssignment extends Model
{
    use HasFactory;

    protected $table = 'police_prisoner_assignment';
    protected $primaryKey='assignment_id';

    protected $fillable = [
        'lawyer_id',
        'prisoner_id',
        'assignment_date',
        'assigned_by',
        'created_at',
        'updated_at',
        'prison_id',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id');
    }

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(Account::class, 'assigned_by');
    }
}
