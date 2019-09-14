<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnInDetainersTable extends Migration
{
    public function up()
    {
        Schema::table('detainers', function (Blueprint $table) {
            $table->renameColumn('long_detain_event', 'idle_start_event');
        });
    }

    public function down()
    {
        Schema::table('detainers', function (Blueprint $table) {
            $table->renameColumn('idle_start_event', 'long_detain_event');
        });
    }
}
