<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->integer('id');
            $table->primary('id');
            $table->string('name');
            $table->integer('category');
            $table->json('authors');
            $table->integer('stock')->default(1);
            $table->timestamps();
            $table->string('detials');
            $table->foreign('category')->references('id')->on('categories');
            // $table->foreign('author')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
