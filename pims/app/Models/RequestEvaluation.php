<?php

namespace App\Models;

use App\Models\RequestEvaluation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        'request_type',
        'status',
        'approved_by',
        'request_details',
        'prisoner_id',
        'lawyer_id',
        'user_id',
    ];

    // Optionally, if you have relationships (e.g., with a User or Prisoner model)
    // public function user() {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    // public function prisoner() {
    //     return $this->belongsTo(Prisoner::class, 'prisoner_id');
    // }
}
