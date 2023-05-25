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
        Schema::create('phases', function (Blueprint $table) {
            $table->id('code');
            $table->string('name');
            $table->longText('description');
            $table->string('budgetPercentage');
            $table->boolean('etat_facturation')->default(false);
            $table->boolean('etat_paiement')->default(false);
            $table->string('status')->default('Ongoing');
            $table->json('deliverables')->default('[]');
            $table->json('assignedEmployees')->default('[]');

            // change to start_date / end_date
             $table->date('startDate')->default(date('Y-m-d'));
             $table->date('endDate')->default(date('Y-m-d', strtotime('+15 days')));

            // Relationships
            $table->foreignId('project')->constrained('projects')->cascadeOnDelete()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phases');
    }
};
