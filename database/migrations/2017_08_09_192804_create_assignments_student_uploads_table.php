<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsStudentUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_student_uploads', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('ASU_User_Id')->nullable();
            $table->unsignedInteger('ASU_Batch_Id')->nullable();
            $table->string('ASU_File_Name');
            $table->string('ASU_Subject');
            $table->date('ASU_Upload_Date');
            $table->string('Role_Type')->default('S');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('assignments_student_uploads', function (Blueprint $table) {
            $table->foreign('ASU_User_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('ASU_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments_student_uploads');
    }
}
