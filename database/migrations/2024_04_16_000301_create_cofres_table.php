<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCofresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cofres', function (Blueprint $table) {
            $table->id('id_cofre');
            $table->string('type')->nullable();
            $table->unsignedBigInteger('id_magazine');
            $table->double('montant_espece');
            $table->timestamps();

            $table->foreign('id_magazine')->references('id_magazine')->on('magazines')->onDelete('RESTRICT');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cofres');
    }
}
