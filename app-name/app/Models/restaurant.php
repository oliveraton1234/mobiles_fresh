<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    protected $fillable = ['name', 'type', 'description', 'image', 'address'];
    use HasFactory;
}
