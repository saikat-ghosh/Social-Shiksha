<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyMaterialDetails extends Model
{
    protected $table = 'study_material_details';

    protected $fillable = ['SM_User_Id','SM_Batch_Id','SM_File_Name','SM_Subject','SM_Upload_Date','Role_Type','Ent_Type'];
}
