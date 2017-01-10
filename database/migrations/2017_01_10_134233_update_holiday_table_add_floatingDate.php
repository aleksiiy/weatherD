<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHolidayTableAddFloatingDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holidays', function (Blueprint $table) {
            $table->boolean('floating')->default(false)->after('description_kz');
            $table->date('date_to')->nullable();
        });
        Schema::table('private_holidays', function (Blueprint $table) {
            $table->boolean('floating')->default(false)->after('description');
            $table->date('date_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('holidays', function (Blueprint $table) {
            $table->dropColumn('floating');
            $table->dropColumn('date_to');
        });
        Schema::table('private_holidays', function (Blueprint $table) {
            $table->dropColumn('floating');
            $table->dropColumn('date_to');
        });
    }
}
