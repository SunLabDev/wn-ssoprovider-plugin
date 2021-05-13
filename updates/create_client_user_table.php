<?php namespace SunLab\SSOProvider\Updates;

use Schema;
use Winter\Storm\Database\Schema\Blueprint;
use Winter\Storm\Database\Updates\Migration;

class CreateClientUserTable extends Migration
{
    public function up()
    {
        Schema::create('sunlab_ssoprovider_client_user', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('client_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sunlab_ssoprovider_client_user');
    }
}
