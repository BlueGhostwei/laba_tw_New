<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news',function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->commit('用户id');
            $table->char('news_type',20)->nullable()->index()->commit('新闻类型');
            $table->char('title')->unique()->commit('标题');
            $table->string('media_id',100)->nullable()->commit('选择的媒体类型id');
            $table->tinyInteger('Manuscripts_attr')->default(1)->commit('提交稿件类型');
            $table->string('Manuscripts',50)->nulable()->commit('提交的外部稿件');
            $table->char('url_line',80)->nullable()->commit('外部链接');
            $table->longText('content')->nullable()->commit('内容');
            $table->string('keyword',50)->nullable()->commit('关键字');
            $table->integer('start_time')->commit('开始时间');
            $table->integer('end_time')->commit('结束时间');
            $table->integer('price')->commit('价格');
            $table->string('order_code',20)->commit('订单号');
            $table->tinyInteger('status')->default(1)->commit('状态1为未支付，2为已支付');
            $table->tinyInteger('release_sta')->default(1)->commit('发布状态，1未发布，2退回，3已发布');
            $table->string('remark',200)->nullable()->commit('备注');
            $table->timestamps();
            $table->softDeletes();//软删除
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
