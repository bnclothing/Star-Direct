<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checks', function (Blueprint $table) {
            $table->id('id_check');
            $table->unsignedBigInteger('id_magazine');
            $table->string('num_check');
            $table->double('montant_check');
            $table->string('user_name');
            $table->timestamps();
            // Add foreign key constraint if needed
            $table->foreign('id_magazine')->references('id')->on('magazines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checks');
    }
}
