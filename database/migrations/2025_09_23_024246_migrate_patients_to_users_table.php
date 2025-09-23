<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Migrate patient data to users table
        DB::statement("
            INSERT INTO users (name, email, password, entity_id, last_name, identification, dob, genero, phone, role, specialty_id, created_at, updated_at)
            SELECT first_name, email, '', entity_id, last_name, identification, dob, gender, phone, 'patient', NULL, created_at, updated_at
            FROM patients
        ");

        // Rename patientId to patient_user_id and update foreign key
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['patientId']);
            $table->renameColumn('patientId', 'patient_user_id');
            $table->foreign('patient_user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Update patient_user_id to reference the new user ids
        DB::statement("
            UPDATE appointments
            SET patient_user_id = (
                SELECT u.id
                FROM users u
                INNER JOIN patients p ON u.identification = p.identification
                WHERE p.id = appointments.patient_user_id
                LIMIT 1
            )
            WHERE patient_user_id IS NOT NULL
        ");

        // Drop patients table
        Schema::dropIfExists('patients');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate patients table
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('identification')->unique();
            $table->date('dob');
            $table->enum('genero', ['M', 'F', 'Otro']);
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamps();
        });

        // Add entity_id to patients
        Schema::table('patients', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable()->after('id');
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('set null');
        });

        // Migrate data back from users to patients
        DB::statement("
            INSERT INTO patients (id, entity_id, first_name, last_name, identification, dob, gender, phone, email, created_at, updated_at)
            SELECT id, entity_id, name, last_name, identification, dob, genero, phone, email, created_at, updated_at
            FROM users
            WHERE role = 'patient'
        ");

        // Add patientId back to appointments
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['patient_user_id']);
            $table->renameColumn('patient_user_id', 'patientId');
            $table->foreign('patientId')->references('id')->on('patients')->onDelete('cascade');
        });

        // Update appointments back
        DB::statement("
            UPDATE appointments
            SET patientId = (
                SELECT p.id
                FROM patients p
                INNER JOIN users u ON p.identification = u.identification
                WHERE u.id = appointments.patient_user_id AND u.role = 'patient'
                LIMIT 1
            )
            WHERE patient_user_id IS NOT NULL
        ");

        // Delete patients from users table
        DB::table('users')->where('role', 'patient')->delete();
    }
};
