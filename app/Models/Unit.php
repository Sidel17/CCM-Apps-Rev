<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['codeunit', 'brand_id', 'unitmodel_id'];

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }

    public function unitmodel()
    {
        return $this->belongsTo(UnitModels::class, 'unitmodel_id');
    }
}
