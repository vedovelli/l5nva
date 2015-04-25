<?php

Route::group(['prefix' => 'api', 'middleware' => 'auth.basic'], function()
{
  Route::get('projetos', ['uses' => 'ProjectController@projectsForSelect']);
  Route::get('categorias', ['uses' => 'CategoryController@index']);
  Route::get('usuarios', ['uses' => 'UserController@index']);
  Route::get('usuario-logado', ['uses' => 'UserController@current']);
});

Route::group(['middleware' => 'auth'], function()
{
    Route::get('dashboard', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

    /**
    * Projetos
    */
    Route::group(['prefix' => 'projeto'], function()
    {
      /**
      * Project
      */
      Route::get('', ['as' => 'project.index', 'uses' => 'ProjectController@index']);
      Route::get('{id}/detalhes', ['middleware' => 'project', 'as' => 'project.show', 'uses' => 'ProjectController@show']);
      Route::get('novo', ['as' => 'project.create', 'uses' => 'ProjectController@create']);
      Route::post('salvar', ['as' => 'project.store', 'uses' => 'ProjectController@store']);
      Route::get('{id}/editar', ['as' => 'project.edit', 'uses' => 'ProjectController@edit']);
      Route::post('{id}/atualizar', ['as' => 'project.update', 'uses' => 'ProjectController@update']);

      /**
      * Section
      */
      Route::post('{id}/secao', ['as' => 'section', 'uses' => 'SectionController@store']);
      Route::get('{id}/secao/{section_id}/remover', ['as' => 'section.remove', 'uses' => 'SectionController@destroy']);

      /**
      * Criar nova pagina
      */
      Route::get('{project_id}/secao/{section_id}/pagina/criar', ['as' => 'page.create', 'uses' => 'PageController@create']);

    });

    Route::group(['prefix' => 'pagina'], function()
    {
      Route::post('{project_id}/secao/{section_id}/pagina/salvar', ['as' => 'page.save', 'uses' => 'PageController@store']);
      Route::get('{page_id}/editar', ['as' => 'page.edit', 'uses' => 'PageController@edit']);
      Route::post('{page_id}/atualizar', ['as' => 'page.update', 'uses' => 'PageController@update']);
      Route::get('{page_id}/remover', ['as' => 'page.remove', 'uses' => 'PageController@remove']);
      Route::get('{page_id}', ['as' => 'page.show', 'uses' => 'PageController@show']);
    });


    Route::group(['prefix' => 'categoria'], function()
    {
      Route::get('', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
      Route::post('salvar', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
      Route::get('{id}/editar', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
      Route::post('{id}/atualizar', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
      Route::get('{id}/excluir', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
      Route::get('{id}/projetos', ['as' => 'category.projects', 'uses' => 'CategoryController@projects']);
    });

    Route::group(['prefix' => 'usuario'], function()
    {
      Route::get('', ['as' => 'user.index', 'uses' => 'UserController@index']);
      Route::post('salvar', ['as' => 'user.store', 'uses' => 'UserController@store']);
      Route::get('{id}/editar', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
      Route::post('{id}/atualizar', ['as' => 'user.update', 'uses' => 'UserController@update']);
      Route::get('{id}/excluir', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
      Route::get('{id}/projetos', ['as' => 'user.projects', 'uses' => 'UserController@projects']);
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
