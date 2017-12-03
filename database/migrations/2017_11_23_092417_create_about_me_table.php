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
            $table->string('email',100)->unique();
            $table->string('phone',20)->unique();
            $table->text('social_links')->nullable();
            $table->text('websites')->nullable();
            $table->string('address',50)->nullable();
            $table->string('company',50)->nullable();
            $table->string('position',50)->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('marital_status')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('nationality',20)->nullable();
            $table->string('religion',20)->nullable();
            $table->text('interests')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('strengths')->nullable();
            $table->text('achievements')->nullable();
            $table->text('skills')->nullable();
            $table->text('languages')->nullable();
            $table->text('about_me')->nullable();
            $table->string('photo',100)->nullable();
            $table->string('photo_url',100)->nullable();
            $table->text('references')->nullable();
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
