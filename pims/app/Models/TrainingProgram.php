<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    use HasFactory;

    protected $table = 'training_programs';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'name', 
        'description', 
        'created_by', 
        'start_date', 
        'end_date',
        'prison_id',
    ];

    // Cast datetime fields to Carbon instances
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    // Relationship with Account (Created By)
    public function createdBy()
    {
        return $this->belongsTo(Account::class, 'created_by', 'user_id');
    }
}
