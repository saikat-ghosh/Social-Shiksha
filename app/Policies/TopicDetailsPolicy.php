<?php

namespace App\Policies;

use App\TeacherStudentDetail;
use App\User;
use App\DiscussionForumDetails;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicDetailsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the discussionForumDetails.
     *
     * @param  \App\User  $user
     * @param  \App\DiscussionForumDetails  $discussionForumDetails
     * @return mixed
     */
    public function view(User $user, DiscussionForumDetails $discussionForumDetails)
    {
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();
        return $discussionForumDetails->DFD_User_Id == $author->id;
    }

    /**
     * Determine whether the user can create discussionForumDetails.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->Role_Type != 'C';
    }

    /**
     * Determine whether the user can update the discussionForumDetails.
     *
     * @param  \App\User  $user
     * @param  \App\DiscussionForumDetails  $discussionForumDetails
     * @return mixed
     */
    public function update(User $user, DiscussionForumDetails $discussionForumDetails)
    {
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();
        return $discussionForumDetails->DFD_User_Id == $author->id;
    }

    /**
     * Determine whether the user can delete the discussionForumDetails.
     *
     * @param  \App\User  $user
     * @param  \App\DiscussionForumDetails  $discussionForumDetails
     * @return mixed
     */
    public function delete(User $user, DiscussionForumDetails $discussionForumDetails)
    {
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();
        return $discussionForumDetails->DFD_User_Id == $author->id;
    }
}
