<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dave\Services\Validators\UserValidator;
use App\Dave\Services\Repositories\IUserRepository;
use \Request as Request;

class UserController extends Controller {

	protected $validator;
	protected $repository;

	function __construct(UserValidator $validator, IUserRepository $repository)
	{
		$this->validator = $validator;
		$this->repository = $repository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$total = 10;

		$search = Request::get('search');

		$users = $this->repository->users($total, $search);

		$loadedUser = null;

		return view('users.index')->with(compact('users', 'loadedUser', 'search'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->saveUser();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$search = null;

		$users = $this->repository->users(10, $search);

		$loadedUser = $this->repository->show($id);

		return view('users.index')->with(compact('users', 'loadedUser', 'search'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function update($id)
	{
		return $this->saveUser($id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$response = $this->repository->destroy($id);

		if(is_null($response))
		{
			return redirect()->route('user.index')->with('error', 'Usuário não localizado');
		}

		if($response)
		{
			return redirect()->route('user.index')->with('success', 'Usuário excluido com sucesso!');
		}

		return redirect()->route('user.index')->with('error', 'Erro ao excluir usuário');
	}

	protected function saveUser($id = null)
	{
		if(!is_null($id))
		{
			$this->validator->setup('update');
		} else {
			$this->validator->setup('store');
		}

		if(!$this->validator->passes())
		{
			return redirect()->route('user.index')->withErrors($this->validator->getErrors())->withInput();
		}

		$input = Request::all();

		if(!is_null($id))
		{
			$response = $this->repository->update($input, $id);
			$successMessage = 'Usuário atualizado com sucesso!';
		} else {
			$response = $this->repository->store($input);
			$successMessage = 'Usuário criado com sucesso!';
		}

		return redirect()->route('user.index')->with('success', $successMessage);

	}
}
