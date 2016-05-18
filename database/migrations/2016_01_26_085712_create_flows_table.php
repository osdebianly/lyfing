<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');  //用户id
            $table->bigInteger('flow');   //用户流量
            $table->bigInteger ( 'up' );   //
            $table->bigInteger ( 'down' );   //
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
        Schema::drop('flows');
    }
}
