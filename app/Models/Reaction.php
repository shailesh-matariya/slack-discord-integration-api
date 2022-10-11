<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'reactions';
    protected $guarded = [];
    protected $casts = [
        'users' => 'array'
    ];
}
