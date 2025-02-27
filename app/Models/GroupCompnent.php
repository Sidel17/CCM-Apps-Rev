<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupCompnent extends Model
{
    use HasFactory;
    protected $table = 'groupcomponent';
    protected $fillable = ['name'];

}
