<?php

namespace App\Http\Middleware;

use App\CoachingDetails;
use App\TeacherStudentDetail;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistrationFeesPaid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if($user->Role_Type == 'C')
        {
            $institute = CoachingDetails::where('Inst_Email',$user->email)->first();

            if($institute->Inst_Fee_Paid_YN == 'N')
                return redirect('institution/dashboard')->with('message','Pay registration fee first!');
        }
        elseif($user->Role_Type == 'T')
        {
            $teacher = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();

            $fees_paid = DB::table('registration_fees')->where([['Reg_User_Id',$teacher->id],['Reg_Fee_Paid_YN','Y']])->first();
            if(!$fees_paid)
                return redirect('teacher/dashboard')->with('message','Pay registration fee first!');
        }
        else
        {
            $student = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();

            $fees_paid = DB::table('registration_fees')->where([['Reg_User_Id',$student->id],['Reg_Fee_Paid_YN','Y']])->first();
            if(!$fees_paid)
                return redirect('student/dashboard')->with('message','Pay registration fee first!');
        }

        return $next($request);
    }
}
