<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerformanceDetails extends Model
{
    protected $table = 'performance_details';

    protected $fillable = ['Per_User_Id','Per_Batch_Id','Per_Subject','Per_Marks','Per_Tot_Marks','Role_Type','Ent_Type'];
}
