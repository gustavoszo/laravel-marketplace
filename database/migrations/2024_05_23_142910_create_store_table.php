<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');
            $table->string('phone');
            $table->string('mobile_phone');
            $table->string('slug');
            
            // Quando chama $table->foreignId('user_id')->constrained();, o Laravel entende que você está criando uma chave estrangeira chamada user_id que faz referência à coluna id na tabela users, seguindo as convenções de nomenclatura padrão do Laravel.
            $table->foreignId('user_id')->constrained();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
