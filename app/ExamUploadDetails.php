<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamUploadDetails extends Model
{
    protected $table = 'exam_upload_details';

    protected $fillable = ['EU_User_Id','EU_Batch_Id','EU_Name','EU_Duration','EU_No_of_Q','EU_Instr','EU_Upload_Date','Role_Type','Ent_Type'];
}
