<?php

Route::group(['middleware' => 'auth'], function()
{
    Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    Route::group(['prefix' => 'projeto'], function()
    {
      Route::get('', ['as' => 'project.index', 'uses' => 'ProjectController@index']);
    });

    Route::group(['prefix' => 'categoria'], function()
    {
      Route::get('', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
      Route::post('salvar', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
      Route::get('{id}/editar', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
      Route::post('{id}/atualizar', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
      Route::get('{id}/excluir', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
    });

    Route::group(['prefix' => 'usuario'], function()
    {
      Route::get('', ['as' => 'user.index', 'uses' => 'UserController@index']);
      Route::post('salvar', ['as' => 'user.store', 'uses' => 'UserController@store']);
      Route::get('{id}/editar', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
      Route::post('{id}/atualizar', ['as' => 'user.update', 'uses' => 'UserController@update']);
      Route::get('{id}/excluir', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
    });

    Route::get('perfil', ['as' => 'profile.index', 'uses' => 'ProfileController@profile']);
    Route::get('perfil/editar', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::post('perfil/atualizar', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::get('senha', ['as' => 'password.index', 'uses' => 'ProfileController@password']);
    Route::post('senha/atualizar', ['as' => 'password.update', 'uses' => 'ProfileController@passwordUpdate']);
});











Route::get('/', function()
{
    return redirect()->route('dashboard.index');
});

Route::get('/home', function()
{
    return redirect()->route('dashboard.index');
});

/**
* Implementacao nativa do Laravel para Login
*/
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
