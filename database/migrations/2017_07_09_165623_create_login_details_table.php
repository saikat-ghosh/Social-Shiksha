<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->time('Log_In_Time');
            $table->time('Log_Out_Time');
            $table->unsignedInteger('Log_T_Id')->nullable();
            $table->unsignedInteger('Log_Inst_Id')->nullable();
            $table->unsignedInteger('Log_Admin_Id')->nullable();
            $table->string('Role_Type');
            $table->string('Ent_Type');
            $table->timestamps();
        });

        Schema::table('login_details', function (Blueprint $table) {
            $table->foreign('Log_T_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('Log_Inst_Id')->references('id')->on('coaching_details')->onDelete('set null');
            $table->foreign('Log_Admin_Id')->references('id')->on('admin_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_details');
    }
}
