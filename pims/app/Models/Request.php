<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'requester_id', 'request_type', 'status', 'approved_by', 'request_details'
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
}
