<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artigo_desenvolvedor', function (Blueprint $table) {
            $table->foreignId('artigo_id')->constrained('artigos')->onDelete('cascade');
            $table->foreignId('desenvolvedor_id')->constrained('desenvolvedores')->onDelete('cascade');
            $table->primary(['artigo_id', 'desenvolvedor_id']); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artigo_desenvolvedor');
    }
};
