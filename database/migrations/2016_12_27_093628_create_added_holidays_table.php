<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddedHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('private_holidays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('user_id')->unsigned();
            $table->text('description')->nullable();
            $table->date('date');
            $table->enum('date_color', ['#000000', '#ffffff', '#929292', '#ff0000', '#a1d623', '#20b1f5'])->default('#000000');
            $table->enum('name_color', ['#000000', '#ffffff', '#929292', '#ff0000', '#a1d623', '#20b1f5'])->default('#000000');
            $table->string('image')->nullable();
            $table->decimal('opacity', 5 , 2)->default(1);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('private_holidays');
    }
}
