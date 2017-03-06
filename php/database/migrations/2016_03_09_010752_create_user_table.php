<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            // 主键, 自增, 用户 id
            $table->increments('id');

            // 用户名, 唯一
            $table->string('username', 100)->unique();

            // 邮箱, 唯一
            $table->string('user_Eail', 100)->nullable();

            // 密码, hash 值
            $table->string('password', 60);

            // 邮箱验证状态, 0 或 1
            $table->tinyInteger('email_validate')->unsigned()->default(0);

            // 头像图片的 md5, 35位
            $table->char('user_avatar', 35)->nullable();

            //公司名称
            $table->string('company_name',100)->nullable();

            // 昵称
            $table->string('nickname', 30)->nullable();

            //联系人
            $table->string('contact_person',30)->nullable();

            // 性别 0女, 1男
            $table->tinyInteger('gender')->default(1);


            // 移动电话, 固话
            $table->char('user_phone',15)->unique()->nullable()->index();

        /*    // 微信号
            $table->string('wechat', 20)->nullable();*/

            // QQ
            $table->integer('user_QQ')->nullable();

            // 用户角色
            $table->tinyInteger('role')->default(1)->index();

            // 锁定/启动用户
            $table->tinyInteger('lock')->default(0)->index();

            // 记住用户 token
            $table->rememberToken();

            //是否同意协议
            $table->tinyInteger('confirm')->default(1)->index();

            //是否设置密保
            $table->tinyInteger('security')->default(0)->index()->commit('是否设置密码：1为true,0为false');
            //用户证件（身份证）
            $table->char('User_ID',35)->nulltable()->commit('用户证件（身份证）');

            // 创建的管理员
            $table->integer('created_by')->unsigned()->default(0);

            $table->string('remarks', 100)->nullable();
            // 自动维护的创建修改时间
            $table->timestamps();
            // 软删除
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
        Schema::drop('user');
    }
}
