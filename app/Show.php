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
   * Get the site plan for the show
   * @return File The file object for the site plan
   */
  public function sitePlan() {
    return $this->hasOne('App\File', 'id', 'site_plan');
  }

  /**
   * Get the permit application for the show
   * @return File The file object for the permit application
   */
  public function permitApplication() {
    return $this->hasOne('App\File', 'id', 'permit_application');
  }

  /**
   * Get the permit for the show
   * @return File The file object for the permit
   */
  public function permitFile() {
    return $this->hasOne('App\File', 'id', 'permit_file');
  }

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
