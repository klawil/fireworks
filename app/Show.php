<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Show extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'shows';

  /**
   * The attributes that are not mass assignable.
   * @var Array
   */
  protected $guarded = ['user_id'];

  /**
   * The date rows on the table
   * @var Array
   */
  protected $dates = ['planned_date', 'rain_date'];

  /**
   * Get all of the files associated with the show
   * @return App\File The files associated with the show
   */
  public function files() {
    return $this
      ->belongsToMany('App\File', 'show_file')
      ->using('App\ShowFile')
      ->withPivot('relationship', 'shooter_viewable', 'driver_viewable', 'assistant_viewable');
  }

  /**
   * The users that belong to the show
   * @return App\User The users and their roles
   */
  public function users() {
    return $this
      ->belongsToMany('App\User')
      ->using('App\ShowUser')
      ->withPivot('payment', 'is_owner', 'is_shooter', 'is_driver', 'is_assistant')
      ->orderBy('last_name', 'asc')
      ->orderBy('first_name', 'asc');
  }

  /**
   * The contacts that belong to the show
   * @return App\Contact The contacts and their information
   */
  public function contacts() {
    return $this
      ->hasMany('App\Contact')
      ->orderBy('name', 'asc');
  }
}
