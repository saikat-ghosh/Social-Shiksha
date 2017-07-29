<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionForumDetails extends Model
{
    protected $table = 'discussion_forum_details';

    protected $fillable = ['DFD_Topic_Id','DFD_Details','DFD_Date','DFD_User_Id','Role_Type','Ent_Type'];

}
