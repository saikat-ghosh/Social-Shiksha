<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamUploadDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_upload_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('EU_User_Id')->nullable();
            $table->unsignedInteger('EU_Batch_Id')->nullable();
            $table->string('EU_Name');
            $table->unsignedSmallInteger('EU_Duration');
            $table->unsignedInteger('EU_No_of_Q');
            $table->string('EU_Instr')->nullable();
            $table->date('EU_Upload_Date');
            $table->string('Role_Type');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('exam_upload_details', function (Blueprint $table) {
            $table->foreign('EU_User_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('EU_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_upload_details');
    }
}
