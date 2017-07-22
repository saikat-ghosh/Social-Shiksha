<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTSBatchRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_s_batch_relations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('TSB_T_Stu_Id')->nullable();
            $table->unsignedInteger('TSB_Batch_Id')->nullable();
            $table->string('Role_Type');
            $table->string('Ent_Type')->default('I');
            $table->timestamp('created_at');
        });

        Schema::table('t_s_batch_relations', function (Blueprint $table) {
            $table->foreign('TSB_T_Stu_Id')->references('id')->on('teacher_student_details')->onDelete('cascade');
            $table->foreign('TSB_Batch_Id')->references('id')->on('batch_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_s_batch_relations');
    }
}
