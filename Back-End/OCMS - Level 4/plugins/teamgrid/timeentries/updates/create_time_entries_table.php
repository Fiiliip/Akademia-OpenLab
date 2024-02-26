<?php namespace TeamGrid\TimeEntries\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTimeEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('teamgrid_timeentries_time_entries', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('teamgrid_tasks_tasks')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teamgrid_timeentries_time_entries');
    }
}
