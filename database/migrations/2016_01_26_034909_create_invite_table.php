<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInviteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ss_invite_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('user_id');  //生成的用户id
            $table->integer('reg_id');   //注册使用的用户id
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
        Schema::drop('ss_invite_code');
    }
}
