<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutMeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_me', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->nullable();
            $table->string('email',100)->unique()->nullable();
            $table->string('phone',20)->unique()->nullable();
            $table->string('social_links',100)->nullable();
            $table->string('websites',50)->nullable();
            $table->string('address',50)->nullable();
            $table->string('company',50)->nullable();
            $table->string('position',50)->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('marital_status')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('nationality',20)->nullable();
            $table->string('religion',20)->nullable();
            $table->string('interests',100)->nullable();
            $table->string('hobbies',100)->nullable();
            $table->string('strengths',100)->nullable();
            $table->string('achievements',100)->nullable();
            $table->string('skills',100)->nullable();
            $table->string('languages',100)->nullable();
            $table->string('about_me',191)->nullable();
            $table->string('photo',100)->nullable();
            $table->string('photo_url',100)->nullable();
            $table->string('references',191)->nullable();
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
        Schema::dropIfExists('about_me');
    }
}
