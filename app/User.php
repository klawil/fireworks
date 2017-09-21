<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name', 'last_name', 'email', 'password', 'address', 'city', 'state', 'phone',
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
   * The shows the user has permissions for
   * @return ShowRole The shows and roles
   */
  public function shows() {
    return $this->belongsToMany('App\Show', 'show_roles', 'user_id', 'show_id')->withTimestamps();
  }

  /**
   * The users that this user can see
   * @return User The users that this user can see
   */
  public function userCanSee() {
    return $this
      ->belongsToMany('App\User', 'user_user', 'viewer_id', 'user_id')
      ->withPivot('type')
      ->withTimestamps();
  }

  /**
   * The users that can see this user
   * @return User The users that can see this user
   */
  public function canSeeUser() {
    return $this
      ->belongsToMany('App\User', 'user_user', 'user_id', 'viewer_id')
      ->withPivot('type')
      ->withTimestamps();
  }
}
