<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachingDetails extends Model
{
    protected $table = 'coaching_details';
    protected $fillable = [
                            'Inst_File_Name',
                            'Inst_Name',
                            'Inst_No',
                            'Inst_Email',
                            'Inst_Addr',
                            'Inst_Exam_Type',
                            'Inst_Fee_Paid_YN',
                            'Inst_User_Id',
                            'Inst_Pswd',
                            'Role_Type',
                            'Ent_Type'
                            ];
}
