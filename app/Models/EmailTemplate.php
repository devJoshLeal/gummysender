<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class EmailTemplate extends Model
{
    use SoftDeletes;
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

