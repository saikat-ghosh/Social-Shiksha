<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamQuestionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_question_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('EQ_EU_Id')->nullable();
            $table->unsignedInteger('EQ_No_of_Q');
            $table->unsignedInteger('EQ_Q_Number');
            $table->string('EQ_Q_Type');
            $table->string('EQ_Q');
            $table->unsignedSmallInteger('Marks');
            $table->string('EQ_Op1')->nullable();
            $table->string('EQ_Op2')->nullable();
            $table->string('EQ_Op3')->nullable();
            $table->string('EQ_Op4')->nullable();
            $table->string('EQ_Ans',500);
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('exam_question_details', function (Blueprint $table) {
            $table->foreign('EQ_EU_Id')->references('id')->on('exam_upload_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_question_details');
    }
}
