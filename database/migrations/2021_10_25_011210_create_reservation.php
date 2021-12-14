<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable("reservation")) return;

        Schema::create('reservation', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('table_id');
            $table->integer('user_id');
            $table->integer('peoples');
            $table->dateTime('date');
            $table->timestamps();

            $table->primary("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
    }
}
