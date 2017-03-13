<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEncyclopediaTable extends Migration
{
    /**
     * 百科全书
     * Run the migrations.
     *  媒体(media_id) 来源分类(source_category) 主题（theme） 描述（description），内容：content
     *  'media_id' => 'required',
     * 'title' => 'required|max:25',
     * 'Manuscripts' => 'required',
     * 'Manuscripts_attr' => 'required',
     * 'keyword' => 'required:min:2',
     * 'start_time' => 'required',
     * 'end_time' => 'required',
     * 'remark' => 'required',
     * @return void
     */
    public function up()
    {
        Schema::create('Encyclopedia', function (Blueprint $table) {
           
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
