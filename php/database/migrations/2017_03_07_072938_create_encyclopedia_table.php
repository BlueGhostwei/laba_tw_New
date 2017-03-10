<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncyclopediaTable extends Migration
{
    /**
     * Run the migrations.
     *  媒体(media_id) 来源分类(source_category) 主题（theme） 描述（description），内容：content
     * @return void
     */
    public function up()
    {
       Schema::create('createEncyclopedia',function(Blueprint $table){
           

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
