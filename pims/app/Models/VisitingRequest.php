<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitingRequest extends Model
{
    use HasFactory;

    protected $table = 'visiting_requests';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'prisoner_id', 'visitor_id', 'requested_date', 'status', 'approved_by'
    ];

    protected $casts = [
        'requested_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Prisoner
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }

    // Relationship with Visitor
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id', 'id');
    }

    // Relationship with Account (approved by)
    public function approvedBy()
    {
        return $this->belongsTo(Account::class, 'approved_by', 'user_id');
    }
}
