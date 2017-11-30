<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('task_name');
            $table->string('status');
            $table->string('description');
            $table->string('reservation_time');
            $table->string('date');
            $table->string('time');
            $table->string('from_equal');
            $table->string('from_contains');
            $table->string('from_start');
            $table->string('from_end');
            $table->string('from_regex');
            $table->string('recipient_equal');
            $table->string('recipient_contains');
            $table->string('recipient_start');
            $table->string('recipient_end');
            $table->string('recipient_regex');
            $table->string('subject_equal');
            $table->string('subject_contains');
            $table->string('subject_start');
            $table->string('subject_end');
            $table->string('subject_regex');
            $table->string('body_equal');
            $table->string('body_contains');
            $table->string('body_start');
            $table->string('body_end');
            $table->string('body_regex');
            $table->string('status');
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
        //
    }
}
