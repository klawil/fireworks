<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ShowUser extends Pivot
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'show_user';

  /**
   * Get a string describing the roles the user has
   * @return string
   */
  public function getRoles() {
    $Roles = [];
    if ($this->is_owner) {
      $Roles[] = 'Owner';
    }
    if ($this->is_driver) {
      $Roles[] = 'Driver';
    }
    if ($this->is_shooter) {
      $Roles[] = 'Shooter';
    }
    if ($this->is_assistant) {
      $Roles[] = 'Assistant';
    }

    return implode($Roles, ', ');
  }
}
