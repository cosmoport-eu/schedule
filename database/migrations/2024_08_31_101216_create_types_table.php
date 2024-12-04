<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('i18n_category_code');
            $table->string('i18n_name_code');
            $table->string('i18n_description_code');
            $table->integer('default_participants_number')->nullable(); // рекомендованное кол-во участников
            $table->integer('default_duration');
            $table->float('default_cost')->default(0.00);
            $table->timestamps();
            $table->softDeletes();

            $table->index('i18n_category_code');
            $table->index('parent_id');
            $table->index('i18n_name_code');
            $table->index('i18n_description_code');
            $table->index('default_participants_number');
            $table->index('default_duration');
            $table->index('default_cost');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
