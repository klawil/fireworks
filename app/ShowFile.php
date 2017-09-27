<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ShowFile extends Pivot
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'show_file';

  /**
   * Get a string describing the roles that can view the file
   * @return string
   */
  public function getRoles() {
    $Roles = ['Owner'];
    if ($this->driver_viewable) {
      $Roles[] = 'Driver';
    }
    if ($this->shooter_viewable) {
      $Roles[] = 'Shooter';
    }
    if ($this->assistant_viewable) {
      $Roles[] = 'Assistant';
    }

    return implode($Roles, ', ');
  }
}
