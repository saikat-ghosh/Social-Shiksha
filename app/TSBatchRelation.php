<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TSBatchRelation extends Model
{
    protected $table = 't_s_batch_relations';
    protected $fillable = ['TSB_T_Stu_id','TSB_Batch_id','Ent_Type','Role_Type'];

}
