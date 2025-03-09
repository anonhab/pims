<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationRecord extends Model
{
    use HasFactory;

    protected $table = 'certification_records';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'prisoner_id', 'issued_by', 'certification_type', 'certification_details', 'issued_date', 'status'
    ];

    protected $casts = [
        'issued_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with Prisoner
    public function prisoner()
    {
        return $this->belongsTo(Prisoner::class, 'prisoner_id', 'id');
    }

    // Relationship with Account (Issued By)
    public function issuedBy()
    {
        return $this->belongsTo(Account::class, 'issued_by', 'user_id');
    }
}
