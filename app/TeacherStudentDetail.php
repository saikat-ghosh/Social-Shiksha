<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherStudentDetail extends Model
{
    protected $table = 'teacher_student_details';
    protected $fillable = [
        'T_Stu_File_Name',
        'T_Stu_Name',
        'T_Stu_No',
        'T_Stu_Email',
        'T_Stu_Addr',
        'Batch_Id',
        'T_Stu_User_Id',
        'T_Stu_Pswd',
        'Role_Type',
        'Ent_Type'
    ];
}
