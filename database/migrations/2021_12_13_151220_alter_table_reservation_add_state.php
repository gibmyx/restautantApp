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
                $table->string('state', 255)->after('date');

            if (! Schema::hasColumn("reservation", "code_table"))
                $table->string('code_table', 255)->after('state');

            if (! Schema::hasColumn("reservation", "user_name"))
                $table->string('user_name', 255)->after('code_table');

            if (! Schema::hasColumn("reservation", "code"))
                $table->string('code')->after('id');

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

            if (Schema::hasColumn("reservation", "code_table"))
                $table->dropColumn('code_table');

            if (Schema::hasColumn("reservation", "user_name"))
                $table->dropColumn('user_name');

            if (Schema::hasColumn("reservation", "code"))
                $table->dropColumn('code');

        });
    }
}
