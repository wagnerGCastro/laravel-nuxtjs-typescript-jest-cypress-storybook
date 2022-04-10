<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoaTable extends Migration
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
            $table->unsignedInteger('user_id')->nullable(false);
            $table->string('document', 14)->unique()->nullable();
            $table->string('type_person', 2)->nullable();
            $table->string('image_photo', 150)->nullable();
            $table->date('date_birth')->nullable(false);
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('intagran_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->timestamps();

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
