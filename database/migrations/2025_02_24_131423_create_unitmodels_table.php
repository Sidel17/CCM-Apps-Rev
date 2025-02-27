<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('unitmodels', function (Blueprint $table) {
            $table->id(); // Kolom id (primary key)
            $table->integer('brand_id'); // Kolom brand_id (foreign key)
            $table->string('name'); // Kolom name
            $table->timestamps(); // Kolom created_at dan updated_at

            // Definisikan foreign key
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unitmodels');
    }
};
