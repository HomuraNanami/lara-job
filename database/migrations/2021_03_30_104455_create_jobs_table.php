<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->string('company_name');
            $table->string('icon_path')->nullable();
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->unsignedBigInteger('administrator_id');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('administrator_id')->references('id')->on('administrators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
