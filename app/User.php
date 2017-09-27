<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
  use Notifiable;
  use SoftDeletes;

  /**
   * The attributes that are not mass assignable.
   * @var array
   */
  protected $guarded = [
    'remember_token',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The shows the user belongs to and their permissions
   * @return App\Show The shows the user has access to
   */
  public function shows() {
    return $this
      ->belongsToMany('App\Show')
      ->using('App\ShowUser')
      ->withPivot('payment', 'is_owner', 'is_shooter', 'is_driver', 'is_assistant');
  }

  /**
   * The users that this user can see
   * @return App\User The users that this user can see
   */
  public function userCanSee() {
    return $this
      ->belongsToMany('App\User', 'user_user', 'viewer_id', 'user_id')
      ->withPivot('can_edit')
      ->withTimestamps();
  }

  /**
   * The users that can see this user
   * @return App\User The users that can see this user
   */
  public function canSeeUser() {
    return $this
      ->belongsToMany('App\User', 'user_user', 'user_id', 'viewer_id')
      ->withPivot('can_edit')
      ->withTimestamps();
  }

  /**
   * The licenses the user has (shooter, driver, etc)
   * @return App\License The licenses the user has
   */
  public function licenses() {
    return $this
      ->hasMany('App\License');
  }
}
