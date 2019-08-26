<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReturningColumnToWagonsTable extends Migration
{
    public function up()
    {
        Schema::table('wagons', function (Blueprint $table) {
            $table->boolean('returning')->after('inw')->default(false);
        });
    }

    public function down()
    {
        Schema::table('wagons', function (Blueprint $table) {
            $table->dropColumn('returning');
        });
    }
}
