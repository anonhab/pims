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
        'id', 
        'lawyer_id', 
        'user_id', 
        'request_type', 
        'status', 
        'approved_by', 
        'request_details', 
        'prisoner_id'
    ];

    /**
     * Relationship with Lawyer
     */
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'lawyer_id');
    }

    /**
     * Relationship with Account (User)
     */
    public function user()
    {
        return $this->belongsTo(Account::class, 'user_id', 'user_id');
    }

    /**
     * Relationship with Prisoner
     */
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }
    public function approvedBy()
    {
        return $this->belongsTo(Account::class, 'approved_by', 'user_id');
    }
}
 