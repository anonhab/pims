<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use OwenIt\Auditing\Contracts\Auditable;

class JobAssignment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use HasFactory;

    protected $table = 'job_assignments';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'prisoner_id', 'assigned_by', 'job_title', 'job_description', 'assigned_date', 'status','end_date'
    ];

    protected $casts = [
        'end_date' => 'date',
        'assigned_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Prisoner
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }

    // Relationship with Account (Assigned By)
    public function assignedBy()
    {
        return $this->belongsTo(Account::class, 'assigned_by', 'user_id');
    }
}
