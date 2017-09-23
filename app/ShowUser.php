<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ShowUser extends Pivot
{
  protected $table = 'show_user';

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
