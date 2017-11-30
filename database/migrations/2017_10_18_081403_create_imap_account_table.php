<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImapAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('imap_accounts', function(Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id')->primary('id')->unsigned();
            $table->string('fqdn');
            $table->string('port');
            $table->string('username');
            $table->longText('password');
            $table->longText('protocol')->nullable();
            $table->text('folder_name');
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
