<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('nome', 40)->nullable(false);
            $table->string('sobre_nome', 150)->nullable(false);
            $table->string('email', 150)->unique()->nullable(false);
            $table->string('documento', 14)->unique()->nullable();
            $table->enum('tipo_pessoa', ['PF','PJ'])->nullable(false)->comment('PF: Pessoa Física, PJ: Pessoa Jurídica');
            $table->enum('sexo', ['M','F','T'])->nullable(false)->comment('M: MASCULINE, F: FEMININE, F: TRANS');
            $table->string('image_photo', 150)->nullable();
            $table->date('data_nascimento')->nullable(false);
            $table->char('rg', 11)->nullable();
            $table->date('data_emissao_rg')->nullable();
            $table->string('orgao_emissor_rg')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('inscricao_estadual')->nullable();
            $table->date('data_constituicao')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('intagran_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->enum('status', ['A','I'])->nullable(false)->default('I')->comment('A: active, I: inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
