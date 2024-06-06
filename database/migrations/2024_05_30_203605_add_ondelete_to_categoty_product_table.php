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
        Schema::table('category_product', function (Blueprint $table) {
            
            // Primeiro, soltar a chave estrangeira existente
            $table->dropForeign(['product_id']);
            $table->dropForeign(['category_id']);

            // Em seguida, adicionar novamente a chave estrangeira com a cláusula onDelete('cascade')
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('category', function (Blueprint $table) {
            
            // Primeiro, soltar a chave estrangeira adicionada na migração up()
            $table->dropForeign(['product_id']);
            $table->dropForeign(['category_id']);
    
            // Em seguida, adicionar novamente a chave estrangeira sem a cláusula onDelete('cascade')
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('categories');

        });
    }
};
