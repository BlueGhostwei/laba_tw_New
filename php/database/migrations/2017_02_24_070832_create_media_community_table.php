<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *"media_type"=>"required",
     * "documents_type"=>"required",
     * "media_name"=>"required|min:2|max:20|unique:".$this->getTable(),
     * "network"=>"required",
     * "Entrance_level"=>"required",
     * "Entrance_form"=>"required",
     * "coverage"=>"required",
     * "channel"=>"required",
     * "principal"=>"required|min:2",
     * "user_Eail"=>"required|email",
     * "user_QQ"=>"required",
     * "address"=>"required",
     * "Zip_code"=>"required",
     * "documents_img"=>"required",
     * "Website_Description"=>"required",
     * "media_md5"=>"required",
     * "pf_price"=>"required",
     * "px_price"=>"required",
     * "mb_price"=>"required",
     * @return void
     */
    public function up()
    {
        Schema::create('media_community', function (Blueprint $table) {
            $table->increments('id');//主键id
            $table->tinyInteger('media_type')->default(0)->comment('媒体类型');
            $table->tinyInteger('documents_type')->nullable()->comment('证件类型，0位经营执照，1位身份证');
            $table->string('media_name',20)->unique()->nullable()->comment('媒体名称');
            $table->tinyInteger('network')->nullable()->comment('网络类型');
            $table->tinyInteger('Entrance_level')->nullable()->comment('入口级别');
            $table->tinyInteger('Entrance_form')->nullable()->comment('入口形式');
            $table->char('coverage',20)->nullable()->comment('覆盖区域');
            $table->tinyInteger('channel')->nullable()->comment('频道类型');
            $table->string('principal',20)->nullable()->comment('媒体负责人');
            $table->char('mobile_number',15)->nullable()->comment('媒体负责人联系电话');
            $table->string('user_Eail',30)->nullable()->comment('邮箱');
            $table->string('user_QQ',15)->nullable()->comment('QQ');
            $table->string('address',200)->nullable()->comment('联系地址');
            $table->string('Zip_code',10)->nullable()->comment('邮编地址 ');
            $table->string('documents_img',150)->nullable()->comment('证件照片');
            $table->string('Website_Description',500)->nullable()->comment('媒体简介');
            $table->string('media_md5',150)->nullable()->comment('媒体logo');
            $table->integer('pf_price')->nullable()->comment('平台价格');
            $table->integer('px_price')->nullable()->comment('代理价格');
            $table->integer('mb_price')->nullable()->comment('会员价格');
            //自动维护的创建修改时间
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
        Schema::drop('media_community');
    }
}
