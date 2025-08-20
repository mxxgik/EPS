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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patientId')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctorId')->constrained('doctors')->onDelete('cascade');
            $table->dateTime('appointment_date_time');
            $table->string('reason')->nullable();
            $table->enum('status', ['scheduled','cancelled','finished'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
