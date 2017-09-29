<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
  use SoftDeletes;

  /**
   * The table associated with the model
   *
   * @var string
   */
  protected $table = 'contact';

  /**
   * The show the contact belongs to
   */
  public function show() {
    return $this
      ->belongsTo('App\Show');
  }
}
