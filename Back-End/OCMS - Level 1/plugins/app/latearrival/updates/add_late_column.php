<?php namespace App\LateArrival\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class AddLateColumn extends Migration
{
    public function up()
    {
        Schema::table('app_arrival_arrivals', function (Blueprint $table) {
            $table->boolean('is_late')->default(false);
        });
    }

    public function down()
    {
        Schema::table('app_arrival_arrivals', function (Blueprint $table) {
            $table->dropColumn('is_late');
        });
    }
}