<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyDetailsToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('cover')->nullable();
            $table->longText('address')->nullable();
            $table->string('contact')->nullable();
            $table->longText('brief')->nullable();
            $table->boolean('premium')->default(false);
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->dropColumn('website');
            $table->dropColumn('facebook');
            $table->dropColumn('twitter');
            $table->dropColumn('instagram');
            $table->dropColumn('youtube');
            $table->dropColumn('linkedin');
            $table->dropColumn('cover');
            $table->dropColumn('address');
            $table->dropColumn('contact');
            $table->dropColumn('brief');
            $table->dropColumn('premium');
            $table->dropColumn('type');
        });
    }
}
