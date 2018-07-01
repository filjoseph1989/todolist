<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Generated todo model class
 *
 * @author Fil <filjoseph22@gmail.com>
 * @version 1.0.0
 * @date July 1, 2018
 */
class Todo extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'title', 'description', 'status'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }
}
