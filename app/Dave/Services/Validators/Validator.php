<?php namespace App\Dave\Services\Validators;

/**
* Source: http://culttt.com/2013/07/29/creating-laravel-4-validation-services/
*/
abstract class Validator {

  protected $input;

  protected $errors;

  public function __construct($input = NULL)
  {
    $this->input = $input ?: \Input::all();
  }

  public function passes()
  {
    $messages = [];

    /**
    * Se o array $messages foi setado na classe filha, usa-o
    */
    if(isset(static::$messages))
    {
      $messages = static::$messages;
    }

    $validation = \Validator::make($this->input, static::$rules, $messages);

    if($validation->passes())
    {
      return true;
    }

    /**
    * Se erros foram gerados, associa à var $errors local
    */
    $this->errors = $validation->messages();

    return false;
  }

  public function getErrors()
  {
    return $this->errors;
  }

}