<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teacher_sick_times', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->date('from');
            $table->date('until');
            $table->integer('teaching_days');
            $table->integer('total_days');
            $table->foreignId('reason_type_id')
                ->constrained('sick_time_reasons')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->boolean('certificate');
            $table->date('certificate_from')
                ->nullable();
            $table->boolean('hospital');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_sick_times');
    }
};
