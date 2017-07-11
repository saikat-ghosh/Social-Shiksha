<?php

namespace App\Http\Controllers\Auth;

use App\CoachingDetails;
use App\TeacherStudentDetail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'mobile' => 'required|digits:10',
            'user_id' =>'required|alpha_dash|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //dd($data);
        if($data['role']== 'C')
            $user = CoachingDetails::create([
                        'Inst_File_Name'=>null,
                        'Inst_Name'=> $data['name'],
                        'Inst_No'=> $data['mobile'],
                        'Inst_Email'=> $data['email'],
                        'Inst_Addr'=> null,
                        'Inst_Exam_Type'=> null,
                        'Inst_Fee_Paid_YN'=> 'N',
                        'Inst_User_Id'=> $data['user_id'],
                        'Inst_Pswd'=> bcrypt($data['password']),
                        'Role_Type'=> 'C',
                        'Ent_Type'=> 'I'
                    ]);
        elseif($data['role']== 'T')
            $user = TeacherStudentDetail::create([
                        'T_Stu_File_Name'=>null,
                        'T_Stu_Name'=> $data['name'],
                        'T_Stu_No'=> $data['mobile'],
                        'T_Stu_Email'=> $data['email'],
                        'T_Stu_Addr'=> null,
                        'Batch_Id'=> null,
                        'T_Stu_User_Id'=> $data['user_id'],
                        'T_Stu_Pswd'=> bcrypt($data['password']),
                        'Role_Type'=> 'T',
                        'Ent_Type'=> 'I'
                    ]);
        else
            $user = TeacherStudentDetail::create([
                        'T_Stu_File_Name'=>null,
                        'T_Stu_Name'=> $data['name'],
                        'T_Stu_No'=> $data['mobile'],
                        'T_Stu_Email'=> $data['email'],
                        'T_Stu_Addr'=> null,
                        'Batch_Id'=> null,
                        'T_Stu_User_Id'=> $data['user_id'],
                        'T_Stu_Pswd'=> bcrypt($data['password']),
                        'Role_Type'=> 'S',
                        'Ent_Type'=> 'I'
                    ]);

        return User::create([
            'User_Id' => $data['user_id'],
            'Email' => $data['email'],
            'Password' => bcrypt($data['password']),
            'Role_Type'=> $data['role']
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if($user->Role_Type == 'C')
            return redirect('institution/dashboard');
        elseif($user->Role_Type == 'T')
            return redirect('teacher/dashboard');
        else
            return redirect('student/dashboard');
    }
}
