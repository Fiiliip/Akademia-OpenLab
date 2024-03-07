<?php namespace TeamGrid\Projects\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProjectSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('teamgrid_project_subscribers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->primary(['project_id', 'subscriber_id']);

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('teamgrid_projects_projects')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('subscriber_id')->unsigned();
            $table->foreign('subscriber_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teamgrid_project_subscribers');
    }
}
