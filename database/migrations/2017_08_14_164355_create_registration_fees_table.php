<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_fees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('Reg_User_Id')->nullable();
            $table->string('Reg_Fee_Paid_YN',5)->default('N');
            $table->dateTime('Reg_Pay_Date');
            $table->string('Role_Type',2);
            $table->string('Ent_Type',2)->default('I');
            $table->timestamps();
        });

        Schema::table('registration_fees', function (Blueprint $table) {
            $table->foreign('Reg_User_Id')->references('id')->on('teacher_student_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_fees');
    }
}
