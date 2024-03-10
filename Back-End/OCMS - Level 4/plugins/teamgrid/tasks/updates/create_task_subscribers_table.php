<?php namespace TeamGrid\Tasks\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTaskSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('teamgrid_tasks_task_subscribers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->primary(['task_id', 'subscriber_id']);

            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('teamgrid_tasks_tasks')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('subscriber_id')->unsigned();
            $table->foreign('subscriber_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teamgrid_tasks_task_subscribers');
    }
}
