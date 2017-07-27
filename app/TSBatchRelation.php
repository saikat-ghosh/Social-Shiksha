<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TSBatchRelation extends Model
{
    protected $table = 't_s_batch_relations';
    protected $fillable = ['TSB_T_Stu_Id','TSB_Batch_Id','Ent_Type','Role_Type'];

}
