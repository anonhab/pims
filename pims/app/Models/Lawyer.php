<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $table = 'lawyers';
    protected $primaryKey='lawyer_id';

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'contact_info',
        'email',
        'password',
        'law_firm',
        'license_number',
        'cases_handled',
    ];

    protected $hidden = [
        'password',
    ];
    public function assignedPrisoners()
    {
        return $this->belongsToMany(Prisoner::class, 'lawyer_prisoner_assignment', 'lawyer_id', 'prisoner_id');
    }
        public function assignments()
    {
        return $this->hasMany(LawyerPrisonerAssignment::class, 'lawyer_id');
    }
}
