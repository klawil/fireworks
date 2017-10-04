<?php

namespace App;

class Model extends \Illuminate\Database\Eloquent\Model
{
  /**
   * Override the incrementing variable for primary keys
   * @var Boolean
   */
  public $incrementing = False;

  /**
   * Register a function to create the ID that is not auto incrementing
   */
  protected static function boot()
  {
    // Call the parent function
    parent::boot();

    static::creating(function($model) {
      $model->{$model->getKeyName()} = (string)$model->generateNewId();
    });
  }

  /**
   * Generate a new unique ID
   * @return String
   */
  public function generateNewId()
  {
    return uniqid();
  }
}
