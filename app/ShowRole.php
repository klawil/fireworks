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
    return $this->belongsTo('App\User');
  }

  /**
   * Get the role assigned to the user
   * @return Role The role
   */
  public function role() {
    return $this->belongsTo('App\Role');
  }

  /**
   * Get the show the user/role is for
   * @return Show The show
   */
  public function show() {
    return $this->belongsTo('App\Show');
  }
}
