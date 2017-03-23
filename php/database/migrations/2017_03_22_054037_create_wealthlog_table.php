<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWealthlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('wealthlog',function (Blueprint $table){
            //自增 主键 ID
            $table->increments('id');
            //用户ID
            $table->integer('user_id');
            //用户名
            $table->string('username', 100);
            //金额
            $table->decimal('price')->default(0)->commit('金额');
            //账户余额
            $table->decimal('money')->default(0)->commmit('账户余额');
            //订单号
            $table->string('order_code',100)->commit("订单号");
            //创建时间
            $table->integer('maketime');
            //备注
            $table->text('remark')->nullable()->commit('备注');
            //类型 1：充值，0：提现,2：消费
            $table->tinyInteger('type')->commit('类型');
            //状态 0：未完成，1完成
            $table->tinyInteger('state')->default(0)->commit('状态');
            //支付账号
            $table->string('payment',100)->commit('支付方式');
            //账号类型
            $table->integer('paytype')->commit('支付方式');
            //URL
            $table->text('url')->nullable()->commit('链接地址');
            //标题
            $table->string('title',100)->commit('标题');
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
        Schema::drop('wealthlog');
    }
}
