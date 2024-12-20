<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;
    protected $table = 'forum_threads';

    // Fillable fields for mass assignment
    protected $fillable = [
        'username',
        'title',
        'text',
        'replies_count',
        'likes_count',
    ];
}
