<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_fees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('EF_User_Id')->nullable();
            $table->string('EF_Fee_Paid_YN',5)->default('N');
            $table->dateTime('EF_Pay_Date');
            $table->string('Role_Type',2);
            $table->string('Ent_Type',2)->default('I');
            $table->timestamps();
        });

        Schema::table('exam_fees', function (Blueprint $table) {
            $table->foreign('EF_User_Id')->references('id')->on('teacher_student_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_fees');
    }
}
