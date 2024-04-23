<?php namespace Fiiliip\VideoManager\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('fiiliip_videomanager_videos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('fiiliip_videomanager_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->time('duration');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiiliip_videomanager_videos');
    }
}
