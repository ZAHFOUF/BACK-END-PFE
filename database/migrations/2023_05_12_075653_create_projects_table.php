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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('des');
            $table->string('budget');
            $table->float('progress');
            $table->string('status');


            // Relationships
            $table->foreignId('org')->constrained('organizations')->cascadeOnDelete();
            $table->foreignId('chef')->constrained('users')->cascadeOnDelete();

            // change to start_date / end_date
            $table->date('start_date');
            $table->date('end_date');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
