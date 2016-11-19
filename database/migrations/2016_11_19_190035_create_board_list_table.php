<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_list', function (Blueprint $table) {
            $table->integer('board_id')->unsigned()->index();
            $table->integer('list_id')->unsigned()->index();

            $table->primary(['board_id', 'list_id']);
            $table->foreign('board_id')->references('id')->on('boards')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
