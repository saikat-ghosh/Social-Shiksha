<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_material_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('SM_User_Id')->nullable();
            $table->unsignedInteger('SM_Batch_Id')->nullable();
            $table->string('SM_File_Name');
            $table->string('SM_Subject');
            $table->date('SM_Upload_Date');
            $table->string('Role_Type');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('study_material_details', function (Blueprint $table) {
            $table->foreign('SM_User_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('SM_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_material_details');
    }
}
