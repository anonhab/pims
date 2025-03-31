<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    // Define which fields are mass assignable
    protected $fillable = [
        'request_type', 
        'request_details', 
        'prisoner_id', 
        'status', 
        'evaluation', 
        'penalty'
    ];
}
