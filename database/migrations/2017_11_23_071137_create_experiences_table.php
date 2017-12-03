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
            $table->text('about_job')->nullable();
            $table->text('duties')->nullable();
            $table->text('projects')->nullable();
            $table->text('achievements')->nullable();
            $table->string('company_email',50)->nullable();
            $table->string('company_phone',30)->nullable();
            $table->string('company_address',50)->nullable();
            $table->string('company_website',50)->nullable();
            $table->date('company_established')->nullable();
            $table->text('about_company')->nullable();
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
