<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImapConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imap_accounts', function(Blueprint $table) {
            $table->increments('id')->primary('id');
            $table->string('fqdn')->unique();
            $table->integer('port')->default(993);
            $table->string('username');
            $table->string('password');
            $table->enum('protocol', array('SSL', 'TLS'));
            $table->string('folder_name');
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
        Schema::drop('imap_config');
    }
}
