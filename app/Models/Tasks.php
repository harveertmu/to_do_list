<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $table = 'tasks';

    // Define which attributes are mass assignable
    protected $fillable = ['title', 'description', 'completed'];

}
