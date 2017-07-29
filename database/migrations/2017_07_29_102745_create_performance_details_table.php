<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('Per_User_Id')->nullable();
            $table->unsignedInteger('Per_Batch_Id')->nullable();
            $table->string('Per_Subject');
            $table->integer('Per_Marks');
            $table->integer('Per_Tot_Marks')->nullable();
            $table->string('Role_Type');
            $table->string('Ent_Type')->default('I');
            $table->timestamps();
        });

        Schema::table('performance_details', function (Blueprint $table) {
            $table->foreign('Per_User_Id')->references('id')->on('teacher_student_details')->onDelete('cascade');
            $table->foreign('Per_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_details');
    }
}
