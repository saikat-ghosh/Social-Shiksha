<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    protected $table = 'admin_details';
    protected $fillable = ['Admin_User_Id','Admin_Pswd','Role_Type','Ent_Type'];
    protected $hidden = ['Admin_Pswd'];
}
