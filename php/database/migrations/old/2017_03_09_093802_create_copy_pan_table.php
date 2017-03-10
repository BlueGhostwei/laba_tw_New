<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopyPanTable extends Migration
{
    /**
     * Run the migrations
     * user_id 用户id
     * 'text_type'，文章类型
     * 'content',内容
     * 'number',字数
     * 'cycle',周期
     * 'article_price'价格
     * article_num 篇数
     * @return void
     */
    public function up()
    {
        Schema::table('copy_pan',function(Blueprint $table){
            $table->increments('id');
            $table->string('user_id',20)->unique()->commit('用户id');
            $table->tinyInteger('text_type')->commit('文章类型');
            $table->longText('content')->nullable()->commit('文章内容');
            $table->tinyInteger('number')->commit('字数');
            $table->tinyInteger('cycle')->commit('周期');
            $table->tinyInteger('article_num')->commit('篇数');
            $table->char('article_price',50)->nullable()->commit('价格');
            $table->timestamps();//自动维护时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('copy_pan');
    }
}
