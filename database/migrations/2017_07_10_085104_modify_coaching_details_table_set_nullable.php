<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCoachingDetailsTableSetNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coaching_details', function (Blueprint $table) {
            $table->string('Inst_File_Name')->nullable()->change();
            $table->string('Inst_Addr')->nullable()->change();
            $table->string('Inst_Exam_Type')->nullable()->change();
            $table->string('Inst_Fee_Paid_YN')->default('N')->change();
            $table->string('Role_Type')->default('C')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coaching_details', function (Blueprint $table) {
            //
        });
    }
}
