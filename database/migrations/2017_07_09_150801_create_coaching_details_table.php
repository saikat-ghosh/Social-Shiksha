<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('Inst_File_Name');
            $table->string('Inst_Name');
            $table->string('Inst_No');
            $table->string('Inst_Email');
            $table->string('Inst_Addr');
            $table->string('Inst_Exam_Type');
            $table->string('Inst_Fee_Paid_YN');
            $table->string('Inst_User_Id');
            $table->string('Inst_Pswd');
            $table->string('Role_Type');
            $table->string('Ent_Type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coaching_details');
    }
}
