<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnInDetainersTable extends Migration
{
    public function up()
    {
        Schema::table('detainers', function (Blueprint $table) {
            $table->string('idle_start_event', 30)->change();
        });
    }

    public function down()
    {
        Schema::table('detainers', function (Blueprint $table) {
            $table->string('idle_start_event', 20)->change();
        });
    }
}
