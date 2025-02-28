<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manpower extends Model
{
    use HasFactory;
    protected $table = 'manpower';
    protected $fillable = ['name'];

    public function reports()
    {
        return $this->belongsToMany(Report::class, 'manpower_report', 'manpower_id', 'report_id')->withTimestamps();
    }
}
