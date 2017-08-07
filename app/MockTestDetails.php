<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockTestDetails extends Model
{
    protected $table = 'mock_test_details';

    protected $fillable = ['MT_User_Id','MT_Batch_Id','MT_File_Name','MT_Subject','MT_Upload_Date','Role_Type','Ent_Type'];
}
