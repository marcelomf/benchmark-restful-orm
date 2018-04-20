<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_id_evento')->unsigned();
            $table->integer('fk_id_usuario')->unsigned();
            $table->string('nome');
            $table->mediumText('texto');
            $table->timestamps();
        });
        
        Schema::table('topicos', function(Blueprint $table){
            $table->foreign('fk_id_evento')->references('id')->on('eventos')->onDelete('cascade');
            $table->foreign('fk_id_usuario')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topicos');
    }
}
