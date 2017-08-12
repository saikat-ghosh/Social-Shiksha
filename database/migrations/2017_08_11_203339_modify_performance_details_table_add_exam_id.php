<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyPerformanceDetailsTableAddExamId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('performance_details', function (Blueprint $table) {
            $table->unsignedInteger('Per_Exam_Id')->nullable();
            $table->foreign('Per_Exam_Id')->references('id')->on('exam_upload_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('performance_details', function (Blueprint $table) {
            //
        });
    }
}
