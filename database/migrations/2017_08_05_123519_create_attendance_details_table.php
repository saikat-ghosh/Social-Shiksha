<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('Att_User_Id')->nullable();
            $table->unsignedInteger('Att_Batch_Id')->nullable();
            $table->string('Att_Present_YN');
            $table->date('Att_Date');
            $table->string('Role_Type')->default('S');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('attendance_details', function (Blueprint $table) {
            $table->foreign('Att_User_Id')->references('id')->on('teacher_student_details')->onDelete('cascade');
            $table->foreign('Att_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_details');
    }
}
