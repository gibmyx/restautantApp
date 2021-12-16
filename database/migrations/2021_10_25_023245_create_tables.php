<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable("tables")) return;

        Schema::create('tables', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code');
            $table->string('state');
            $table->integer('max_people');
            $table->integer('min_people');
            $table->string('description');
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
        Schema::dropIfExists('tables');
    }
}
