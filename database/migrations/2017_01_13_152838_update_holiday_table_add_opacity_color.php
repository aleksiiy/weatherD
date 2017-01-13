<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHolidayTableAddOpacityColor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('holidays', function (Blueprint $table) {
            $table->enum('date_color', ['#000000', '#ffffff', '#929292', '#ff0000', '#a1d623', '#20b1f5'])->default('#000000')->after('floating');
            $table->enum('name_color', ['#000000', '#ffffff', '#929292', '#ff0000', '#a1d623', '#20b1f5'])->default('#000000')->after('date_color');;
            $table->decimal('opacity', 5, 2)->default(1)->after('name_color');;
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
            $table->dropColumn('date_color');
            $table->dropColumn('name_color');
            $table->dropColumn('opacity');
        });
    }
}
