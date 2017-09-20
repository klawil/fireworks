<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShowRole extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'show_roles';

  /**
   * Get the user the role is for
   * @return User The user
   */
  public function user() {
    return $this->hasOne('App\User', 'id', 'user_id');
  }

  /**
   * Get the role assigned to the user
   * @return Role The role
   */
  public function role() {
    return $this->hasOne('App\Role', 'id', 'role_id');
  }

  /**
   * Get the show the user/role is for
   * @return Show The show
   */
  public function show() {
    return $this->hasOne('App\Show', 'id', 'show_id');
  }
}
