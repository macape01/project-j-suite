<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->string('description',255);
            //$table->integer('author_id');
            $table->integer('asset_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_id');
            $table->foreign('assigned_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function(Blueprint $table){
            $table->dropForeign(['assigned_id']);
            $table->dropColumn('assigned_id');
        });
        Schema::dropIfExists('tickets');
    }
}
