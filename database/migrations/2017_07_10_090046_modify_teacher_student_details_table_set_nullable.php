<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTeacherStudentDetailsTableSetNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_student_details', function (Blueprint $table) {
            $table->string('T_Stu_File_Name')->nullable()->change();
            $table->string('T_Stu_Addr')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_student_details', function (Blueprint $table) {
            //
        });
    }
}
