<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComponentDetail extends Model
{
    use HasFactory;

    protected $table = 'componentdetail';
    protected $fillable = [
        'groupcomponent_id',
        'name',
    ];

    public function groupcomponent()
    {
        return $this->belongsTo(GroupCompnent::class, 'groupcomponent_id');
    }
}
