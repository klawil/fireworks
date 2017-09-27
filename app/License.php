<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
  use SoftDeletes;
  
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'license';

  /**
   * The user that uploaded the file
   * @return App\User The user that uploaded the file
   */
  public function user() {
    return $this
      ->belongsTo('App\User');
  }

  /**
   * The file that contains the license
   * @return App\File The file that has the license
   */
  public function file() {
    return $this
      ->belongsTo('App\File');
  }
}
