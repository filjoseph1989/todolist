<?php

namespace App\Traits;

use Hash;
use Auth;

/**
 * Written by Fil for common validation process
 *
 * @author Fil Joseph <filjoseph22@gmail.com>
 * @version 1.0
 * @date 09-28-2017
 * @date 07-01-2018 - updated
 */
trait ValidationTrait
{
  /**
   * New validation
   *
   * @param  object $object
   * @param  object $request
   * @param  string $options
   * @return void
   */
  public static function check(&$object, &$request)
  {
    if ($request->has('title')) {
      $data['title'] = 'required|string|max:255';
    }

    if ($request->has('description')) {
      $data['description'] = 'required|string|max:255';
    }

    $object->validate($request, $data);
  }
}
