<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('departament')->after('name');
            $table->string('phone')->after('email');
            $table->dropColumn(['edad', 'f_nac']);
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->integer('edad');
            $table->date('f_nac');
            $table->dropColumn(['departament', 'phone']);
        });
    }
};
