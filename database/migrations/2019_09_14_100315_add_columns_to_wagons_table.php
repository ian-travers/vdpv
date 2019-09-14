<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToWagonsTable extends Migration
{
    public function up()
    {
        Schema::table('wagons', function (Blueprint $table) {
            $table->timestamp('removed_at')->nullable()->after('departed_at');
            $table->timestamp('delivered_at')->nullable()->after('departed_at');
            $table->timestamp('cargo_operation_finished_at')->nullable()->after('departed_at');
        });
    }

    public function down()
    {
        Schema::table('wagons', function (Blueprint $table) {
            $table->dropColumn('delivered_at');
            $table->dropColumn('removed_at');
            $table->dropColumn('cargo_operation_finished_at');
        });
    }
}
