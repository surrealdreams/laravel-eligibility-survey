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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            //ignore any error about an unexpected ':' - first name field definition works.
            $table->string('first_name', length: 150);
            $table->date('date_of_birth');
            $table->string('headache_frequency');
            $table->string('daily_frequency')->nullable(true);
            $table->boolean('eligible');
            $table->string('cohort')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
