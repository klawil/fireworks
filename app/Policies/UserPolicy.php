<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the user.
   *
   * @param  \App\User  $user
   * @param  \App\User  $user
   * @return mixed
   */
  public function view(User $user, User $userToAccess)
  {
    // Check for the user being the user requested
    if ($user->id === $userToAccess->id) {
      return true;
    }

    // Check for the user being in the able to view list
    return $userToAccess
      ->canSeeUser
      ->contains($user);
  }

  /**
   * Determine whether the user can update the user.
   *
   * @param  \App\User  $user
   * @param  \App\User  $user
   * @return mixed
   */
  public function update(User $user, User $userToAccess)
  {
    // Check for the user being the user requested
    if ($user->id === $userToAccess->id) {
      return true;
    }

    // Check for the user being in the able to view list
    return $userToAccess
      ->canSeeUser
      ->where('pivot.can_edit', true)
      ->contains($user);
  }

  /**
   * Determine whether the user can delete the user.
   *
   * @param  \App\User  $user
   * @param  \App\User  $user
   * @return mixed
   */
  public function delete(User $user, User $userToAccess)
  {
    // Check for the user being the user requested
    if ($user->id === $userToAccess->id) {
      return true;
    }

    // Check for the user being in the able to view list
    return $userToAccess
      ->canSeeUser
      ->where('pivot.can_edit')
      ->contains($user);
  }
}
