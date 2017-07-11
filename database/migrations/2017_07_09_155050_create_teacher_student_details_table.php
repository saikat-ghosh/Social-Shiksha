<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_student_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('T_Stu_File_Name');
            $table->string('T_Stu_Name');
            $table->string('T_Stu_No');
            $table->string('T_Stu_Email')->unique();
            $table->string('T_Stu_Addr');
            $table->unsignedInteger('Batch_Id')->nullable();
            $table->string('T_Stu_User_Id')->unique();
            $table->string('T_Stu_Pswd');
            $table->string('Role_Type');
            $table->string('Ent_Type');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('teacher_student_details', function (Blueprint $table) {
            $table->foreign('Batch_Id')->references('id')->on('batch_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_student_details');
    }
}
