<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamResponseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_response_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('ER_EU_Id')->nullable();
            $table->unsignedInteger('ER_EQ_Id')->nullable();
            $table->unsignedInteger('ER_User_Id')->nullable();
            $table->string('ER_Q_Type',25);
            $table->string('ER_Q');
            $table->string('ER_Ans',500);
            $table->unsignedSmallInteger('ER_Marks_Obt')->nullable();
            $table->unsignedSmallInteger('ER_Max_Marks');
            $table->string('Role_Type')->default('S');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('exam_response_details', function (Blueprint $table) {
            $table->foreign('ER_EU_Id')->references('id')->on('exam_upload_details')->onDelete('cascade');
            $table->foreign('ER_EQ_Id')->references('id')->on('exam_question_details')->onDelete('cascade');
            $table->foreign('ER_User_Id')->references('id')->on('teacher_student_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_response_details');
    }
}
