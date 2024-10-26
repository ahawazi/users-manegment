<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('size')->unsigned();
            $table->foreignId('user_id')->constrained('users')->OnDelete('null');
            $table->string('project_name')->required();
            $table->foreignId('commoditie_id')->constrained('commodities')->OnDelete('null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raw_materials');
    }
};
