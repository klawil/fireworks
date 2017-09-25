<?php

namespace App\Policies;

use App\User;
use App\File;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can view the file.
   *
   * @param  \App\User  $user
   * @param  \App\File  $file
   * @return mixed
   */
  public function view(User $user, File $file)
  {
    // Determine if this is from the show
    if ($file->show()->count() > 0) {
      // Get the show
      $show = $file
        ->show()
        ->first();

      // Check that the user has access to the show
      if (!$show->users->contains($user)) {
        return False;
      }

      // Get the show to the user
      $ShowUser = $show
        ->users()
        ->find($user->id);

      // Check for a show owner (they can access all files)
      if ($ShowUser->pivot->is_owner) {
        return True;
      }

      // Get the relationship between the file and the show
      $ShowFile = $file->show()->first();

      // Check for a shooter + shooter visibility
      if ($ShowFile->pivot->shooter_viewable && $ShowUser->pivot->is_shooter) {
        return True;
      }

      // Check for a driver + driver visibility
      if ($ShowFile->pivot->driver_viewable && $ShowUser->pivot->is_driver) {
        return True;
      }

      // Check for an assistant + assistant visibility
      if ($ShowFile->pivot->assistant_viewable && $ShowUser->pivot->is_assistant) {
        return True;
      }

      // If none of the above are true, don't allow access
      return False;
    } else {
      // Get the license
      $License = $file->license;

      // Check the license user is viewable
      return
        $License->user->id === $user->id ||
        $License->user->canSeeUser->contains($user);
    }
  }
}
