<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->string('imagem_capa')->nullable()->after('data_publicacao');
        });
    }

    public function down(): void
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->dropColumn('imagem_capa');
        });
    }
};
