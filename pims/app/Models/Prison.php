<?php
// app/Models/Prison.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prison extends Model
{
    use HasFactory;

    // Define the table name if it differs from the plural form of the model
    protected $table = 'Prison';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'location',
        'capacity',
        'contact_phone',
        'contact_email',
        'additional_notes',
    ];
}
