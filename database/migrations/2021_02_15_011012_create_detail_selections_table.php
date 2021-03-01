<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSelectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selection_id')->cascade();
            $table->foreignId('characteristic_id')->cascade();
            $table->string('tree_name');
            $table->float('score', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_selections');
    }
}
