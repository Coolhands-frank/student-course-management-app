<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'gender', 'date_of_birth', 'address'];

    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
}
