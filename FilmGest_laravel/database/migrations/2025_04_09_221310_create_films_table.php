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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->year('release_year')->nullable();
            $table->string('poster')->nullable(); // For storing image path
            $table->foreignId('genre_id')->constrained()->onDelete('cascade'); // FK to genres
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
