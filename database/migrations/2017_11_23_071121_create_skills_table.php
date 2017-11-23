<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('certificate_title',50)->nullable();
            $table->string('major',50)->nullable();
            $table->date('start_date',10)->nullable();
            $table->date('end_date',10)->nullable();
            $table->string('institution',50)->nullable();
            $table->string('board',50)->nullable();
            $table->string('score',10)->nullable();
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
        Schema::dropIfExists('skills');
    }
}
