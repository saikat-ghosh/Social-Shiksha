<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionForumTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_forum_topics', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('DFT_Topic');
            $table->dateTime('DFT_Date');
            $table->unsignedInteger('DFT_User_Id')->nullable();
            $table->string('Role_Type');
            $table->string('Ent_Type');
            $table->timestamps();
        });

        Schema::table('discussion_forum_topics', function (Blueprint $table) {
           $table->foreign('DFT_User_Id')->references('id')->on('teacher_student_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussion_forum_topics');
    }
}
