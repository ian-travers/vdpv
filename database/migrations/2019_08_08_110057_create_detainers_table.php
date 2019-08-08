<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetainersTable extends Migration
{
    public function up()
    {
        Schema::create('detainers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('long_detain_event', 20);
        });
    }

    public function down()
    {
        Schema::dropIfExists('detainers');
    }
}
