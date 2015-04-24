<?php namespace App\Dave\Services\Validators;

class ProjectValidator extends Validator
{
  public static $rules = [
    'user_id' => 'required',
    'name' => 'required',
    'categories' => 'required',
    'members' => 'required',
    'description' => 'required|max:255',
  ];

  public static $messages = [
    'user_id.required' => 'É preciso selecionar o líder do projeto',
    'name.required' => 'O campo nome do projeto é obrigatório!',
    'categories.required' => 'Pelo menos uma categoria precisa ser selecionada',
    'members.required' => 'Pelo menos um membro precisa ser selecionado',
    'description.required' => 'O campo descrição é obrigatório!',
    'description.max' => 'A descrição não pode ter mais do que 255 caracteres',
  ];
}