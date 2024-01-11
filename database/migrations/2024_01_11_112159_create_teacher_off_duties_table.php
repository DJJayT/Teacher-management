<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teacher_off_duties', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->date('from');
            $table->date('until');
            $table->integer('teaching_days');
            $table->foreignId('reason_type_id')
                ->constrained('exemption_off_duty_reasons')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_off_duties');
    }
};
