<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime', // Laravel lo convertirá automáticamente a Carbon/DateTime
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
