<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',50)->nullable();
            $table->date('joined_date');
            $table->date('resigned_date');
            $table->string('position',30)->nullable();
            $table->string('about_job',191)->nullable();
            $table->string('duties',100)->nullable();
            $table->string('projects',100)->nullable();
            $table->string('achievements',100)->nullable();
            $table->string('company_email',50)->unique();
            $table->string('company_phone',30)->unique();
            $table->string('company_address',50)->nullable();
            $table->string('company_websites',50)->nullable();
            $table->date('company_established')->nullable();
            $table->string('about_company',191)->nullable();
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
        Schema::dropIfExists('experiences');
    }
}
