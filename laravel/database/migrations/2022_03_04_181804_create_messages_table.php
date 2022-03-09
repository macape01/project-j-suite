<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->timestamps();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('chat_id');
            $table->foreign('chat_id')->references('id')->on('chats');
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
        Schema::table('messages', function(Blueprint $table){
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
            $table->dropForeign(['chat_id']);
            $table->dropColumn('chat_id');
        });
        Schema::dropIfExists('messages');
    }
}