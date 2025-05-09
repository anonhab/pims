<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Report extends Model
{
    protected $fillable = ['generated_by', 'report_type', 'content'];

    public function user()
    {
        return $this->belongsTo(Account::class, 'generated_by');
    }
}