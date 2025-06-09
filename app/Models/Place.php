<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    // Campos permitidos para criação/edição em massa
    protected $fillable = [
        'name',
        'slug',
        'city',
        'state',
    ];
}
