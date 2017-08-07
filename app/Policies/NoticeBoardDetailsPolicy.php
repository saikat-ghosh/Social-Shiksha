<?php

namespace App\Policies;

use App\User;
use App\TeacherStudentDetail;
use App\NoticeBoardDetails;
use Illuminate\Auth\Access\HandlesAuthorization;

class NoticeBoardDetailsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the NoticeBoardDetails.
     *
     * @param  \App\User  $user
     * @param  \App\NoticeBoardDetails  $noticeBoardDetails
     * @return mixed
     */
    public function view(User $user, NoticeBoardDetails $noticeBoardDetails)
    {
        //
    }

    /**
     * Determine whether the user can create NoticeBoardDetails.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //Only Teacher can add notices
        return $user->Role_Type == 'T';
    }

    /**
     * Determine whether the user can update the NoticeBoardDetails.
     *
     * @param  \App\User  $user
     * @param  \App\NoticeBoardDetails  $NoticeBoardDetails
     * @return mixed
     */
    public function update(User $user, NoticeBoardDetails $noticeBoardDetails)
    {
        //only Author of the Notice can edit
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();

        return $noticeBoardDetails->NB_T_Id == $author->id;
    }

    /**
     * Determine whether the user can delete the NoticeBoardDetails.
     *
     * @param  \App\User  $user
     * @param  \App\NoticeBoardDetails  $NoticeBoardDetails
     * @return mixed
     */
    public function delete(User $user, NoticeBoardDetails $noticeBoardDetails)
    {
        //only Author of the Notice can delete
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();
        
        return $noticeBoardDetails->NB_T_Id == $author->id;
    }
}
