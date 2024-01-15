<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')
                ->comment('Vorname des Lehrers');
            $table->string('lastname')
                ->comment('Nachname des Lehrers');
            $table->string('abbreviation')
                ->unique()
                ->comment('Lehrerkürzel, z.B. "sed"');
            $table->foreignId('gender_id')
                ->constrained('genders')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->date('entry');
            $table->date('exit')
                ->nullable();
            $table->foreignId('job_title_id')
                ->constrained('job_titles')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('salary_grade_id')
                ->comment('Besoldungsgruppe')
                ->constrained('salary_grades')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('status_type_id')
                ->comment('Status wie Beamter auf Lebenszeit')
                ->constrained('status_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->date('status_since');
            $table->date('last_assessment_at')
                ->comment('Datum der letzten Beurteilung')
                ->nullable();
            $table->foreignId('last_assessment_type_id')
                ->comment('Art der letzten Beurteilung')
                ->constrained('assessment_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('assessment_obstacle_id')
                ->nullable()
                ->constrained('assessment_obstacles')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->date('assessment_obstacle_ends_at')
                ->nullable();
            $table->date('expected_assessment_deadline');
            $table->date('fixed_assessment_deadline')
                ->nullable();
            $table->foreignId('next_assessment_type_id')
                ->comment('Art der nächsten Beurteilung')
                ->constrained('assessment_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
