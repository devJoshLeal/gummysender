<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class EmailTemplate extends Model
{
    protected $fillable = [
        'subject',
        'title',
        'content_html',
        'created_by',
    ];


    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

