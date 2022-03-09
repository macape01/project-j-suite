<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('users');
            });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function(Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
        Schema::dropIfExists('chats');
    }
}