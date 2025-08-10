<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('artigos', function (Blueprint $table) {
        $table->date('data_publicacao')->nullable()->after('slug');
    });
}

public function down()
{
    Schema::table('artigos', function (Blueprint $table) {
        $table->dropColumn('data_publicacao');
    });
}

};
