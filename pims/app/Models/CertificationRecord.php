<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationRecord extends Model
{
    use HasFactory;

    protected $table = 'certification_records';

    protected $primaryKey = 'id';

    protected $fillable = [
        'prisoner_id',
        'issued_by',
        'certification_type',
        'certification_details',
        'issued_date',
        'status',
    ];

    protected $casts = [
        'issued_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'certification_type' => 'string',
        'status' => 'string',
    ];

    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }

    public function issuedBy()
    {
        return $this->belongsTo(Account::class, 'issued_by', 'user_id');
    }
}