<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('abbreviation', 10)
                ->after('name')
                ->comment('Abbreviation of the user\'s name, e.g. "hil"');
            $table->boolean('dark_mode')
                ->after('email')
                ->default(false)
                ->comment('Whether the user prefers dark mode');
        });
    }

    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            //
        });
    }
};
