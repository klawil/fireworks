<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'files';

  /**
   * The user that created the file
   * @return App\User The user that created the file
   */
  public function user() {
    return $this
      ->belongsTo('App\User');
  }

  /**
   * The show(s) that the file belongs to
   * @return App\Show The show the file belongs to
   */
  public function show() {
    return $this
      ->belongsToMany('App\Show', 'show_file')
      ->using('App\ShowFile')
      ->withPivot('relationship', 'shooter_viewable', 'driver_viewable', 'assistant_viewable');
  }

  /**
   * The license the file belongs to
   * @return App\License The license the file belongs to
   */
  public function license() {
    return $this
      ->hasOne('App\License');
  }
}
