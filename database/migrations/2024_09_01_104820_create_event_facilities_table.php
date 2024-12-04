<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_facilities', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('facility_id');
            $table->integer('number');
            $table->timestamps();
            $table->softDeletes();

            $table->index('number');

            $table->foreign('event_id')
                ->references('id')
                ->on('events');

            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_facilities');
    }
}
