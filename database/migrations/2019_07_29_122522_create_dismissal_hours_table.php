<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDismissalHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dismissal_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('start_hour');
            $table->string('end_hour');
            $table->unsignedBigInteger('demand_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dismissal_hours');
    }
}
