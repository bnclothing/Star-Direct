<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCofresTableNullableIdCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cofres', function (Blueprint $table) {
            // Make the id_check column nullable
            $table->unsignedBigInteger('id_check')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cofres', function (Blueprint $table) {
            // If you ever need to rollback, you can make it non-nullable again
            $table->unsignedBigInteger('id_check')->nullable(false)->change();
        });
    }
}
