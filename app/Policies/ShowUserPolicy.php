<?php

namespace App\Policies;

use App\User;
use App\ShowUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShowUserPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the showUser.
   *
   * @param  \App\User  $user
   * @param  \App\ShowUser  $showUser
   * @return mixed
   */
  public function view(User $user, ShowUser $showUser)
  {
    //
  }

  /**
   * Determine whether the user can create showUsers.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    //
  }

  /**
   * Determine whether the user can update the showUser.
   *
   * @param  \App\User  $user
   * @param  \App\ShowUser  $showUser
   * @return mixed
   */
  public function update(User $user, ShowUser $showUser)
  {
    //
  }

  /**
   * Determine whether the user can delete the showUser.
   *
   * @param  \App\User  $user
   * @param  \App\ShowUser  $showUser
   * @return mixed
   */
  public function delete(User $user, ShowUser $showUser)
  {
    //
  }
}
