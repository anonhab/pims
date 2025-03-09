<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingAssignment extends Model
{
    use HasFactory;

    protected $table = 'training_assignments';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'prisoner_id', 'training_id', 'assigned_by', 'assigned_date', 'status'
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Prisoner
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }

    // Relationship with Training Program
    public function trainingProgram()
    {
        return $this->belongsTo(TrainingProgram::class, 'training_id', 'id');
    }

    // Relationship with Account (Assigned By)
    public function assignedBy()
    {
        return $this->belongsTo(Account::class, 'assigned_by', 'user_id');
    }
}
