<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id', 'brand_id', 'unitmodel_id', 'hm', 'location_id',
        'problem_desc', 'groupcomponent_id', 'componentdetail_id',
        'date_start', 'date_finish', 'statusunit_id',
        'activity_report', 'backlog_outstanding', 'manpower_id'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class);
    }

    public function unitModel()
    {
        return $this->belongsTo(UnitModels::class, 'unitmodel_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function groupComponent()
    {
        return $this->belongsTo(GroupCompnent::class, 'groupcomponent_id');
    }

    public function componentDetail()
    {
        return $this->belongsTo(ComponentDetail::class, 'componentdetail_id');
    }

    public function statusUnit()
    {
        return $this->belongsTo(StatusUnit::class, 'statusunit_id');
    }

    public function manpower()
    {
        return $this->belongsTo(Manpower::class);
    }
}
