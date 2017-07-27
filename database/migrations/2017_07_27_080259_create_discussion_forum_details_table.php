<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionForumDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_forum_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('DFD_User_Id')->nullable();
            $table->unsignedInteger('DFD_Topic_Id')->nullable();
            $table->string('DFD_Details',500);
            $table->dateTime('DFD_Date');
            $table->string('Role_Type');
            $table->string('Ent_Type');
            $table->timestamps();
        });

        Schema::table('discussion_forum_details', function (Blueprint $table) {
            $table->foreign('DFD_User_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
            $table->foreign('DFD_Topic_Id')->references('id')->on('discussion_forum_topics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussion_forum_details');
    }
}
