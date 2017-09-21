<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'files';

  /**
   * The user that created the file
   * @return User The user that created the file
   */
  public function user() {
    return $this->belongsTo('App\User');
  }
}
