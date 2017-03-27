<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('message',function (Blueprint $table){
           $table->increments('id')->commit('ID');
           //消息标题
           $table->string('title',50)->commit('消息标题');
           //消息内容
           $table->text('message')->commit('消息内容');
           //作者
           $table->string('author',50)->nullable()->commit('作者');
           //接收ID
           $table->integer('receive')->commit('接收者ID');
           //是否已读，1为已读，默认0未读
           $table->tinyInteger('read')->default(0)->commit('状态');
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
        //
    }
}
