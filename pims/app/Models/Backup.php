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

    protected $fillable = ['initiated_by', 'backup_status'];

      public function user()
      {
          return $this->belongsTo(Account::class, 'initiated_by');
      }

  
}
