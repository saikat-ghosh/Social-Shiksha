<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionForumTopic extends Model
{
    protected $table = 'discussion_forum_topics';

    protected $fillable = ['DFT_Topic','DFT_Date','DFT_User_Id','Role_Type','Ent_Type'];

    protected $hidden=['created_at','updated_at'];
}
