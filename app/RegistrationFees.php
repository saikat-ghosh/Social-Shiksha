<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationFees extends Model
{
   protected $table = 'registration_fees';

   protected $fillable = ['Reg_User_Id','Reg_Fee_Paid_YN','Reg_Pay_Date','Role_Type','Ent_Type'];
}
