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
        Schema::dropIfExists('doctors');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('specialty_id')->nullable();
            $table->string('identification')->unique();
            $table->enum('gender', ['M', 'F', 'Otro']);
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamps();

            $table->foreign('specialty_id')
                ->references('id')
                ->on('specialties')
                ->onDelete('set null');
        });
    }
};
