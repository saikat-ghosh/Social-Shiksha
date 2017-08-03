<?php

namespace App\Policies;

use App\TeacherStudentDetail;
use App\User;
use App\DiscussionForumTopic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the discussionForumTopic.
     *
     * @param  \App\User  $user
     * @param  \App\DiscussionForumTopic  $discussionForumTopic
     * @return mixed
     */
    public function view(User $user, DiscussionForumTopic $discussionForumTopic)
    {
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();
        return $discussionForumTopic->DFT_User_Id == $author->id;
    }

    /**
     * Determine whether the user can create discussionForumTopics.
     *
     * @param  \App\User  $user
     * @return boolean
     */
    public function create(User $user)
    {
        return $user->Role_Type != 'C';
    }

    /**
     * Determine whether the user can update the discussionForumTopic.
     *
     * @param  \App\User  $user
     * @param  \App\DiscussionForumTopic  $discussionForumTopic
     * @return boolean
     */
    public function update(User $user, DiscussionForumTopic $discussionForumTopic)
    {
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();
        return $discussionForumTopic->DFT_User_Id == $author->id;
    }

    /**
     * Determine whether the user can delete the discussionForumTopic.
     *
     * @param  \App\User  $user
     * @param  \App\DiscussionForumTopic  $discussionForumTopic
     * @return boolean
     */
    public function delete(User $user, DiscussionForumTopic $discussionForumTopic)
    {
        $author = TeacherStudentDetail::where('T_Stu_Email',$user->email)->first();
        return $discussionForumTopic->DFT_User_Id === $author->id;
    }
}
