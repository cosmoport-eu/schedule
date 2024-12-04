<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->date('date');
//            $table->string('time_start', 7);
//            $table->string('time_end', 7);
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->text('description')->nullable();
            $table->integer('duration')->default(0);
            $table->integer('type_id');
            $table->integer('status_id');
            $table->integer('departure_gate_id');
            $table->integer('arrival_gate_id');
            $table->integer('people_limit')->default(0);
            $table->integer('contestants')->default(0);
            $table->float('cost')->default(0.00);
            $table->timestamps();
            $table->softDeletes();

            $table->index('date');
            $table->index('time_start');
            $table->index('time_end');
            $table->index('duration');
            $table->index('description');
            $table->index('people_limit');
            $table->index('contestants');
            $table->index('cost');

            $table->foreign('type_id')
                ->references('id')
                ->on('types');

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');

            $table->foreign('departure_gate_id')
                ->references('id')
                ->on('gates');

            $table->foreign('arrival_gate_id')
                ->references('id')
                ->on('gates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
