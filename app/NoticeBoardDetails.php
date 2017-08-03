<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeBoardDetails extends Model
{
    protected $table = 'notice_board_details';

    protected $fillable = ['NB_Heading','NB_Content','NB_T_Id','NB_Date','NB_Inst_Id','Role_Type','Ent_Type'];
}
