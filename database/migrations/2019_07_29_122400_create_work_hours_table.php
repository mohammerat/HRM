<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('start_hour');
            $table->string('end_hour');
            $table->integer('max_overtime_hour');
            $table->integer('promotions_hour');
            $table->timestamps();
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onDelete('cascade');

            $table->foreign('work_hour_id')
                ->references('id')->on('work_hours')
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
        Schema::dropIfExists('work_hours');
    }
}
