<?php namespace App\Dave\Services\Validators;

class CategoryValidator extends Validator
{
    public static $rules = [
        'name' => 'required|min:10'
    ];

    public static $messages = [
        'name.required' => 'O titulo da categoria é obrigatório',
        'name.min' => 'O nome da categoria precisa ter pelo menos 10 caracteres',
    ];
}