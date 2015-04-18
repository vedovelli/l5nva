<?php namespace App\Dave\Services\Validators;

class UserValidator extends Validator
{
    public static $rules;

    public static $messages = [
        'name.required' => 'O nome do usuário é obrigatório',
        'email.required' => 'E-mail é obrigatório',
        'email.email' => 'E-mail precisa ter um formato válido',
        'email.unique' => 'E-mail já foi usado no sistema',
        'password.required' => 'A senha é obrigatória',
        'password.min' => 'A senha deve conter no mínimo 6 caracteres',
        'password_confirmation.same' => 'A confirmação do password não bate com o password',
    ];

    public function setup($action)
    {
        if($action == 'store')
        {
            static::$rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'password_confirmation' => 'same:password',
            ];
        } else {
            static::$rules = [
                'name' => 'required',
                'email' => 'required|email',
            ];
        }
    }
}