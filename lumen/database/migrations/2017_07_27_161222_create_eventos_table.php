<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_id_usuario')->unsigned();
            $table->string('nome');
            $table->string('cidade');
            $table->string('estado');
            $table->string('abertura_portoes');
            $table->string('local');
            $table->string('produtor_responsavel');
            $table->enum('status', ['Confirmado','À confirmar','Realizado']);
            $table->timestamps();
        });
        
        Schema::table('eventos', function(Blueprint $table){
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
        Schema::dropIfExists('eventos');
    }
}
