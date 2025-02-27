<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitModels extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model
    protected $table = 'unitmodels';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'brand_id',
        'name',
    ];

    public function brand()
    {
        return $this->belongsTo(Brands::class, 'brand_id');
    }
}
