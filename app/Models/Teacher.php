<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name', 'subject', 'department', 'email',
        'room', 'years', 'qualification', 'bio',
    ];

    protected function initials(): Attribute
    {
        return Attribute::get(function () {
            $parts = preg_split('/\s+/', trim($this->name));
            return mb_strtoupper(mb_substr($parts[0], 0, 1) . mb_substr(end($parts), 0, 1));
        });
    }
}