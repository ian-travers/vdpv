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
            $table->unsignedBigInteger('creator_id');
            $table->string('inw', 8);
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('detained_at')->nullable();
            $table->timestamp('released_at')->nullable();
            $table->timestamp('departed_at')->nullable();
            $table->unsignedBigInteger('detainer_id');
            $table->string('reason');
            $table->string('cargo');
            $table->string('forwarder')->nullable();
            $table->string('ownership')->nullable();
            $table->string('departure_station');
            $table->string('destination_station');
            $table->text('taken_measure')->nullable();
            $table->string('operation', 10)->nullable();
            $table->string('park', 4)->nullable();
            $table->string('way', 4)->nullable();
            $table->string('nplf', 6)->nullable();
            $table->timestamps();

            $table->index('arrived_at');
            $table->index('detained_at');
            $table->index('released_at');
            $table->index('departed_at');

        });
    }

    public function down()
    {
        Schema::dropIfExists('wagons');
    }
}
