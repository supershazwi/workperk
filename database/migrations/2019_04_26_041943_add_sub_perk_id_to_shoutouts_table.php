<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubPerkIdToShoutoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shoutouts', function (Blueprint $table) {
            //
            $table->integer('sub_perk_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoutouts', function (Blueprint $table) {
            //
            $table->dropColumn('sub_perk_id');
        });
    }
}
