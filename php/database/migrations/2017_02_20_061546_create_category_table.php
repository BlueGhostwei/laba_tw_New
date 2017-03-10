<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            // 主键, id
            $table->increments('id');
            $table->string('name',20)->nullable()->commit('分类名称');
            $table->integer('media_id')->nullable()->commit('子分类id');
            $table->char('pt',20)->nullable()->commit('区分分类');
            // 自动维护的创建修改时间
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
        Schema::drop('category');
    }
}
