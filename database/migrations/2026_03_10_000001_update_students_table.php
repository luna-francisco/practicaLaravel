<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('year')->after('name');
            $table->string('dni')->unique()->after('email');
            $table->dropColumn(['edad', 'f_nac']);
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('edad');
            $table->date('f_nac');
            $table->dropColumn(['year', 'dni']);
        });
    }
};
