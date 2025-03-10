<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'requester_id', 'request_type', 'status', 'approved_by', 'request_details', 'prisoner_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Account (Requester)
    public function requester()
    {
        return $this->belongsTo(Account::class, 'requester_id', 'user_id');
    }

    // Relationship with Account (Approved By)
    public function approvedBy()
    {
        return $this->belongsTo(Account::class, 'approved_by', 'user_id');
    }

    // Relationship with Prisoner
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }
}
