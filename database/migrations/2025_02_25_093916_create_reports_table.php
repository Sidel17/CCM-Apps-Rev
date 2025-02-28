<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('unitmodel_id')->constrained('unitmodels')->onDelete('cascade');
            $table->integer('hm');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->mediumText('problem_desc');
            $table->foreignId('groupcomponent_id')->constrained('groupcomponent')->onDelete('cascade');
            $table->foreignId('componentdetail_id')->constrained('componentdetail')->onDelete('cascade');
            $table->timestamp('date_start');
            $table->timestamp('date_finish')->nullable();
            $table->foreignId('statusunit_id')->constrained('statusunit')->onDelete('cascade');
            $table->longText('activity_report');
            $table->longText('backlog_outstanding')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
