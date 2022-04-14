<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('person_id')->nullable(false);
            $table->string('cep', 10)->nullable(false);
            $table->string('numero', 10)->nullable(false);
            $table->string('tpcomp1', 10)->nullable();
            $table->string('tpcomp2', 10)->nullable();
            $table->string('comp1', 10)->nullable();
            $table->string('comp2', 10)->nullable();
            $table->string('endereco', 10)->nullable(false);
            $table->string('bairro', 10)->nullable(false);
            $table->string('cidade', 10)->nullable(false);
            $table->char('uf', 2)->nullable(false);
            $table->enum('status', ['A','I'])->nullable(false)->default('I')->comment('A: active, I: inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('person_id')->references('id')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
