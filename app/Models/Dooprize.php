<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dooprize extends Model
{
    use HasFactory;
    protected $table = 'dooprize';
    protected $fillable = [
        'name',
        'status'
    ];
}
