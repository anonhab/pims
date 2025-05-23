<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'Notifications';
    protected $primaryKey = 'id';

    protected $fillable = [
        'recipient_id',
        'recipient_role',
        'related_table',
        'related_id',
        'title',
        'message',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeForUser($query, $userId)
    {
        return $query->where('recipient_id', $userId);
    }
}