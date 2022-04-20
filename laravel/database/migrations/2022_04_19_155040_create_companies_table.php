<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('phone',12);
            $table->string('email',50);
            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedBigInteger('logo_id');
            $table->foreign('logo_id')->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['logo_id']);
            $table->dropColumn(['logo_id']);
        });
        Schema::dropIfExists('companies');
    }
}
