<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecurityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('security',function(Blueprint $table){
            $table->increments('id');//主键id
            $table->integer('user_id')->commit('用户id');
            $table->integer('ques_id')->commit('密保问题id');
            $table->char('answer',50)->commit('密保答案');
            $table->timestamps();//自动维护更新时间
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('security');
    }
}
