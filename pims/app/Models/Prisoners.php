<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prisoners extends Model
{
    use HasFactory;

    // Table name
protected $primaryKey = 'prisoner_id'; 
    protected $table = 'Prisoner';

    // Fillable fields (allow mass assignment)
    protected $fillable = [
        'prison_id',
        'first_name',
        'middle_name',
        'last_name',
        'dob',
        'sex',
        'address',
        'marital_status',
        'crime_committed',
        'status',
        'time_serve_start',
        'time_serve_end',
        'emergency_contact_name',
        'emergency_contact_relation',
        'emergency_contact_number',
        'inmate_image',
    ];

    // If you want to cast dates to Carbon instances (e.g., for date fields)
    protected $dates = [
        'dob',
        'time_serve_start',
        'time_serve_end',
    ];

    // Accessors & Mutators (if needed)
}
