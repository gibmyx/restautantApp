<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableReservationAddState extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservation', function (Blueprint $table) {

            if (! Schema::hasColumn("reservation", "state"))
                $table->text('state')->after('date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('reservation', function (Blueprint $table) {

            if (Schema::hasColumn("reservation", "state"))
                $table->dropColumn('state');

        });
    }
}
