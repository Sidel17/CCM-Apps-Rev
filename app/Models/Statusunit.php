<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statusunit extends Model
{
    use HasFactory;
    protected $table = 'statusunit';
    protected $fillable = ['name'];
}
