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
        Schema::create('event_reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('review_title');
            $table->text('review');
            $table->Integer('rating');
            $table->foreignId('event_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_reviews');
    }
};
