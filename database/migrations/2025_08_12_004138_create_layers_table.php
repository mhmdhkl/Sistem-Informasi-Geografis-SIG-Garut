<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layer')->unique();
            $table->string('deskripsi')->nullable();
            $table->longText('geojson_content'); 
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layers');
    }
};
