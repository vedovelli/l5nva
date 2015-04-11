<?php


Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);


Route::group(['prefix' => 'categoria'], function()
{
  Route::get('', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
  Route::post('salvar', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
  Route::get('{id}/editar', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
  Route::post('{id}/atualizar', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
  Route::get('{id}/excluir', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
});

Route::get('/', 'WelcomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
