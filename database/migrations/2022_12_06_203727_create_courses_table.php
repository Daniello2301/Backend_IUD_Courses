<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('credits');
            $table->string('name_teacher');
            $table->string('pre_course');
            $table->integer('time_auto_work');
            $table->integer('time_direct_work');
            $table->unsignedBigInteger('semester_id');
            $table->foreign('semester_id')
                ->references('id')
                ->on('semesters');
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
        Schema::dropIfExists('courses');
    }
};
