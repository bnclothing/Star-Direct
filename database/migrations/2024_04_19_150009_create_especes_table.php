<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coffre_id');
            $table->decimal('amount', 10, 2); // Amount of money in cash
            $table->timestamps();

            $table->foreign('coffre_id')->references('id_cofre')->on('cofres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especes');
    }
}
