<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewVisitingRequest extends Model
{
    use HasFactory;

    // Table name if not following Laravel's pluralization conventions
    protected $table = 'new_visiting_requests';

    // Primary key
    protected $primaryKey = 'id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'visitor_id',
        'requested_date',
        'status',
        'approved_by',
        'prisoner_firstname',
        'prisoner_middlename',
        'prisoner_lastname',
        'prison_id',
        'note',
    ];

    // Timestamps are enabled by default (created_at, updated_at)
    public $timestamps = true;

    // Relationships

    /**
     * Define a relationship with the Visitor model.
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, 'visitor_id');
    }

    /**
     * Define a relationship with the Account (User) model for approved_by.
     */
    public function approvedBy()
    {
        return $this->belongsTo(Account::class, 'approved_by');
    }

    /**
     * Define a relationship with the Prison model.
     */
    public function prison()
    {
        return $this->belongsTo(Prison::class, 'prison_id');
    }
}
