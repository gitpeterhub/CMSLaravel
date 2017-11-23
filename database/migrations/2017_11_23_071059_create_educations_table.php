<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('degree',50)->nullable();
            $table->string('major',50)->nullable();
            $table->string('graduation_year',10)->nullable();
            $table->string('institution',50)->nullable();
            $table->string('institution_address',50)->nullable();
            $table->string('board_or_university',50)->nullable();
            $table->string('score',10)->nullable();
            $table->string('achievements',100)->nullable();
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
        Schema::dropIfExists('educations');
    }
}
