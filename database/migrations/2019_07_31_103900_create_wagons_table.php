<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWagonsTable extends Migration
{
    public function up()
    {
        Schema::create('wagons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('inw', 8);
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('detained_at')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->timestamp('departed_at')->nullable();
            $table->string('detained_by');
            $table->string('reason');
            $table->string('cargo');
            $table->string('forwarder');
            $table->string('ownership');
            $table->string('departure_station');
            $table->string('destination_station');
            $table->text('taken_measure');
            $table->boolean('is_empty')->default(false);
            $table->timestamps();

            $table->index('arrived_at');
            $table->index('detained_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wagons');
    }
}
