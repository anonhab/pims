<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['generated_by', 'report_type', 'content', 'prison_id'];

    public function user()
    {
        return $this->belongsTo(Account::class, 'generated_by');
    }

    public function prison()
    {
        return $this->belongsTo(Prison::class, 'prison_id');
    }
}