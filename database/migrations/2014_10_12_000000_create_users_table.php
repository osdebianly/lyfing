<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->string('confirmation_code');
            $table->boolean('confirmed')->default(config('access.users.confirm_email') ? false : true);
            //python ss
            $table->integer('port')->unique();
            $table->string('method', 64)->default('aes-128-cfb');
            $table->string('passwd'); //method password
            $table->integer('t')->default(0);     //最后使用ss时间
            $table->bigInteger('u')->default(0);
            $table->bigInteger('d')->default(0);
            $table->bigInteger('transfer_enable');
            $table->tinyInteger('switch')->default(1);
            $table->tinyInteger('enable')->default(1);
            $table->tinyInteger('type')->default(1);
            $table->integer('last_get_gift_time')->default(0);
            $table->integer('last_check_in_time')->default(0);  //签到时间
            $table->integer('last_rest_pass_time')->default(0);
            $table->tinyInteger('invite_num')->default(0);

            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
