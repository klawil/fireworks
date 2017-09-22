<?php

namespace App\Policies;

use App\User;
use App\Show;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShowPolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the show.
   *
   * @param  \App\User  $user
   * @param  \App\Show  $show
   * @return mixed
   */
  public function view(User $user, Show $show)
  {
    // Get the show users
    return $show
      ->users
      ->contains($user);
  }

  /**
   * Determine whether the user can update the show.
   *
   * @param  \App\User  $user
   * @param  \App\Show  $show
   * @return mixed
   */
  public function update(User $user, Show $show)
  {
    return $show
      ->users
      ->where('pivot.is_owner', True)
      ->contains($user);
  }

  /**
   * Determine whether the user can delete the show.
   *
   * @param  \App\User  $user
   * @param  \App\Show  $show
   * @return mixed
   */
  public function delete(User $user, Show $show)
  {
    return $show
      ->users
      ->where('pivot.is_owner', True)
      ->contains($user);
  }
}
