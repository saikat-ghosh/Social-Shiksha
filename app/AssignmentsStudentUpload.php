<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentsStudentUpload extends Model
{
    protected $table = 'assignments_student_uploads';

    protected $fillable = ['ASU_User_Id','ASU_Batch_Id','ASU_File_Name','ASU_Subject','ASU_Upload_Date','Role_Type','Ent_Type'];
}
