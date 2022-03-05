<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return $user->id === (int) $post->user_id
            ? Response::allow()
            : Response::deny('You do not own this post.');
    }

    public function before(User $user)
    {
        return $user->login === 'wagner.castro';
    }
}
