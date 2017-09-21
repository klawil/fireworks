<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'shows';

  /**
   * The date rows on the table
   * @var Array
   */
  protected $dates = ['planned_date', 'rain_date'];

  /**
   * Get all of the files associated with the show
   * @return File The files associated with the show
   */
  public function files() {
    return $this
      ->belongsToMany('App\File', 'show_files')
      ->withPivot('relationship', 'created_at', 'updated_at');
  }
}
