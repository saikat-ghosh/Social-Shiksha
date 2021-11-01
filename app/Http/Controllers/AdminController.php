<?php

namespace App\Http\Controllers;

use App\AdminDetail;
use App\BatchDetail;
use App\CoachingDetails;
use App\RegistrationFees;
use App\TeacherStudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /*
    |------------------------------------------------------------------------------
    | Method to login as admin
    |------------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        return view('admin.admin_login');
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $admin_user_id = $request->Admin_User_Id;
        $admin_pswd = $request->Admin_Pswd;

        if($admin_user_id == 'korak' && $admin_pswd == 'korak')
        {
            $adminDetails = AdminDetail::firstOrCreate([
                                'Admin_User_Id'=>$admin_user_id,
                                'Admin_Pswd'=>bcrypt($admin_pswd),
                                'Role_Type'=>'A',
                                'Ent_Type'=>'I'
                            ]);
            session(['Admin_User_Id'=>$admin_user_id]);

            return redirect('admin/dashboard');
        }
        else
            return back()->with('message','Invalid Admin Credentials!');
    }

    /*
    |------------------------------------------------------------------------------
    | Method to display Admin dashboard
    |------------------------------------------------------------------------------
    */

    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    /*
    |------------------------------------------------------------------------------
    | Method for Registration fees
    |------------------------------------------------------------------------------
    */

    public function selectUserType()
    {
        return view('admin.registration-fees.rf_select_user_type');
    }

    public function selectBatchForRegistrationFees()
    {
        $batches = BatchDetail::where('Ent_type','<>','D')->get();
        return view('admin.registration-fees.rf_select_batch')->with('batches',$batches);
    }

    public function showUnpaidUsers(Request $request)
    {
        $unpaidUsers = [];

        if($request->User_Type == 'C')
        {
            $allInstitutes = CoachingDetails::where('Ent_Type','<>','D')->get();

            foreach($allInstitutes as $institute)
            {
                if($institute->Inst_Fee_Paid_YN == 'N')
                    array_push($unpaidUsers,$institute);
            }
        }
        elseif($request->User_Type == 'T')
        {
            $allTeacher_Ids = TeacherStudentDetail::where([['Role_Type','=','T'],['Ent_Type','<>','D']])->pluck('id');

            foreach($allTeacher_Ids as $id)
            {
                $fees_paid = DB::table('registration_fees')->where([['Reg_User_Id',$id],['Reg_Fee_Paid_YN','Y']])->first();
                if(!$fees_paid)
                {
                    $unpaidTeacher = TeacherStudentDetail::find($id);
                    array_push($unpaidUsers,$unpaidTeacher);
                }
            }
        }
        else
        {
            $allStudent_Ids = TeacherStudentDetail::where([['Role_Type','=','S'],['Ent_Type','<>','D']])->pluck('id');

            foreach($allStudent_Ids as $id)
            {
                $fees_paid = DB::table('registration_fees')->where([['Reg_User_Id',$id],['Reg_Fee_Paid_YN','Y']])->first();
                if(!$fees_paid)
                {
                    $unpaidStudent = TeacherStudentDetail::find($id);
                    array_push($unpaidUsers,$unpaidStudent);
                }
            }
        }

        return view('admin.registration-fees.rf_show_unpaid_users')->with(['unpaidUsers'=>$unpaidUsers,'User_Type'=>$request->User_Type]);
    }

    public function payRegistrationFees($role_type,$user_id)
    {
        if($role_type == 'institution')
        {
            $institution = CoachingDetails::findOrFail($user_id);
            $institution->Inst_Fee_Paid_YN = 'Y';
            $institution->Ent_Type = 'E';

            if($institution->save())
                return redirect('admin/registration-fees')->with('message','Fees paid successfully!');
            else
                return redirect('admin/registration-fees')->with('message','Could not pay fees. Try again!');
        }
        else
        {
            $paying_teacher_student = RegistrationFees::firstOrCreate([
                                        'Reg_User_Id' => $user_id,
                                        'Reg_Fee_Paid_YN' => 'Y',
                                        'Reg_Pay_Date' => date('Y-m-d'),
                                        'Role_Type' => 'S'
            ]);

            if($role_type == 'teacher')
                $paying_teacher_student->Role_Type = 'T';

            if($paying_teacher_student->save())
                return redirect('admin/registration-fees')->with('message','Fees paid successfully!');
            else
                return redirect('admin/registration-fees')->with('message','Could not pay fees. Try again!');
        }
    }

    /*
    |------------------------------------------------------------------------------
    | Method to logout
    |------------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('admin');
    }
}
