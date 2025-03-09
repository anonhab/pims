<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $table = 'backups';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id', 'initiated_by', 'backup_date', 'backup_status'
    ];

    protected $casts = [
        'backup_date' => 'datetime',
    ];

    // Relationship with Account (Initiated By)
    public function initiatedBy()
    {
        return $this->belongsTo(Account::class, 'initiated_by', 'user_id');
    }
}
