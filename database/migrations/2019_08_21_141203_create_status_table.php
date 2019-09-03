<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('parent_status_id')->default(0);
            $table->unsignedBigInteger('next_status_id')->nullable();
            $table->unsignedInteger('role_id');
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::table('statuses', function (Blueprint $table) {
            $table->foreign('role_id')
                ->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });
        Schema::dropIfExists('statuses');
    }
}
