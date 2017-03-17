<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order',function (Blueprint $table){
            //主键，自增，ID
            $table->increments('id');//标题
            //用户ID
            $table->integer('user_id')->commit('用户ID');
            //标题
            $table->string('title',100)->commit('标题');
            //类型
            $table->tinyInteger('type')->default(0)->commit('类型');
            //备注
            $table->text('remark')->nullable()->commit('备注');
            //订单号
            $table->string('number',30)->unique()->commit('订单号');
            //状态
            $table->tinyInteger('state')->default(0)->commit('状态');
            //金额
            $table->decimal('price')->default(0)->commit('金额');
            //维护时间戳
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
        Schema::drop('order');
    }
}
