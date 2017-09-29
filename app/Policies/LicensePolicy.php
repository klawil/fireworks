<?php

namespace App\Policies;

use App\User;
use App\License;
use Illuminate\Auth\Access\HandlesAuthorization;

class LicensePolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the license.
   *
   * @param  \App\User  $user
   * @param  \App\License  $license
   * @return mixed
   */
  public function view(User $user, License $license)
  {
    // Authorize that the viewer can view user associated with the license
    return $user->can('view', $license->user);
  }

  /**
   * Determine whether the user can update the license.
   *
   * @param  \App\User  $user
   * @param  \App\License  $license
   * @return mixed
   */
  public function update(User $user, License $license)
  {
    // Authorize that the viewer can edit the user associated with the license
    return $user->can('edit', $license->user);
  }

  /**
   * Determine whether the user can delete the license.
   *
   * @param  \App\User  $user
   * @param  \App\License  $license
   * @return mixed
   */
  public function delete(User $user, License $license)
  {
    // Authorize that the viewer can edit the user associated with the license
    return $user->can('edit', $license->user);
  }
}
