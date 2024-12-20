<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = [
        'forum_thread_id',
        'username',
        'text'
    ];

    // Define relationship
    public function forumThread()
    {
        return $this->belongsTo(ForumThread::class);
    }
}
