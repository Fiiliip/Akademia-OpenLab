<?php namespace Fiiliip\VideoManager\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVideoTagsTable extends Migration
{
    public function up()
    {
        Schema::create('fiiliip_videomanager_video_tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('video_id')->unsigned();
            $table->foreign('video_id')->references('id')->on('fiiliip_videomanager_videos')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('fiiilip_videomanager_tags')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiiliip_videomanager_video_tags');
    }
}
