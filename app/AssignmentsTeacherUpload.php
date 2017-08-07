<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentsTeacherUpload extends Model
{
    protected $table = 'assignments_teacher_uploads';

    protected $fillable = ['ATU_User_Id','ATU_Batch_Id','ATU_File_Name','ATU_Subject','ATU_Upload_Date','Role_Type','Ent_Type'];
}
