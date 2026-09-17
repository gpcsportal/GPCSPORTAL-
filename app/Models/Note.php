<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id',
        'branch',
        'semester',
        'year',
        'subject_name',
        'subject_code',
        'title',
        'description',
        'attachment_path',
        'original_name',
        'mime_type',
        'file_size',
        'file_hash',
        'fingerprint',
        'status',
        'rejection_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
