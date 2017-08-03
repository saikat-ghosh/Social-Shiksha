<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeBoardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_board_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('NB_Heading');
            $table->string('NB_Content',1000);
            $table->unsignedInteger('NB_T_Id')->nullable();
            $table->unsignedInteger('NB_Inst_Id')->nullable();
            $table->dateTime('NB_Date');
            $table->string('Role_Type');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('notice_board_details', function (Blueprint $table) {
            $table->foreign('NB_T_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('NB_Inst_Id')->references('id')->on('coaching_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notice_board_details');
    }
}
