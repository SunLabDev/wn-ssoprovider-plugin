<?php namespace SunLab\SSOProvider\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_ssoprovider_clients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('splash_image')->nullable();
            $table->string('host');
            $table->string('callback_url');
            $table->string('token_url_param');
            $table->string('secret');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sunlab_ssoprovider_clients');
    }
}
