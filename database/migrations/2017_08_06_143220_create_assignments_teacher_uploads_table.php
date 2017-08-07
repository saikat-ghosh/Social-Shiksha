<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTeacherUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments_teacher_uploads', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('ATU_User_Id')->nullable();
            $table->unsignedInteger('ATU_Batch_Id')->nullable();
            $table->string('ATU_File_Name');
            $table->string('ATU_Subject');
            $table->date('ATU_Upload_Date');
            $table->string('Role_Type');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('assignments_teacher_uploads', function (Blueprint $table) {
            $table->foreign('ATU_User_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('ATU_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments_teacher_uploads');
    }
}
