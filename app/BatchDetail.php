<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchDetail extends Model
{
    protected $table = 'batch_details';
    protected $fillable = ['Batch_Code','Batch_Subject','Ent_Type'];
}
