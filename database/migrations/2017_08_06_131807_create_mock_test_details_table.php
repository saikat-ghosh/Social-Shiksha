<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMockTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mock_test_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('MT_User_Id')->nullable();
            $table->unsignedInteger('MT_Batch_Id')->nullable();
            $table->string('MT_File_Name');
            $table->string('MT_Subject');
            $table->date('MT_Upload_Date');
            $table->string('Role_Type');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('mock_test_details', function (Blueprint $table) {
            $table->foreign('MT_User_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('MT_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mock_test_details');
    }
}
