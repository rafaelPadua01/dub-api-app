<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
		$table->string('product_name'); // nome do produto
		$table->string('product_image')->nullable(); //armazena nome da imagm
		$table->decimal('product_price'); //armazena o preço
		$table->text('description_product'); //armazena a descrição
		$table->integer('product_quantity'); //armazena a quantidade
	//	$table->foreignId('user_id')->references('id')->on('users');
		$table->foreignId('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
