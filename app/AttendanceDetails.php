<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceDetails extends Model
{
    protected $table = 'attendance_details';

    protected $fillable = ['Att_User_Id','Att_Batch_Id','Att_Present_YN','Att_Date','Role_Type','Ent_Type'];
}
