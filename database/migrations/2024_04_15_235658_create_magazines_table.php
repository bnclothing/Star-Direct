<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->id('id_magazine');
            $table->string('code_magazine');
            $table->string('magazine_name');
            $table->string('magazine_adresse');
            $table->integer('magazine_type');
            $table->unsignedBigInteger('id_primary_magazine')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->timestamps();

            $table->foreign('id_primary_magazine')->references('id_magazine')->on('magazines')->onDelete('cascade');
            $table->foreign('responsable_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magazines');
    }
}
