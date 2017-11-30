<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_contents', function(Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->primary('id');
            $table->string('sender');
            $table->string('receive_time');
            $table->string('subject');
            $table->longText('body_text');
            $table->longText('body_html')->nullable();
            $table->text('structure');
            $table->integer('status');
            $table->integer('sequence');
            $table->integer('account_id')->unsigned()->nullable();
            $table->foreign('account_id')->references('id')->on('imap_accounts');
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
        Schema::drop('email_contents');
    }
}
