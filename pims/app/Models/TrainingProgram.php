<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class TrainingProgram extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $table = 'training_programs';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'title', 
        'description', 
        'created_by', 
        'prison_id',
    ];

    // Cast datetime fields to Carbon instances
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // Relationship with Account (Created By)
    public function createdBy()
    {
        return $this->belongsTo(Account::class, 'created_by', 'user_id');
    }
}
