<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teacher_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('training_id')
                ->constrained('trainings')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->date('from');
            $table->date('until');
            $table->float('duration', 4,1)
                ->comment('In days, half days are possible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_trainings');
    }
};
