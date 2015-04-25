<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Dave\Services\Validators\CategoryValidator;
use App\Dave\Services\Repositories\ICategoryRepository;
use \Request as Request;

class CategoryController extends Controller {

	protected $validator;
	protected $repository;

	function __construct(CategoryValidator $validator, ICategoryRepository $repository)
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

		$categorias = $this->repository->categories($total, $search);

		$loadedCategory = null;

		return view('categories.index')->with(compact('categorias', 'loadedCategory', 'search'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->saveCategory();
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

		$categories = $this->repository->categories(10, $search);

		$loadedCategory = $this->repository->show($id);

		return view('categories.index')->with(compact('categories', 'loadedCategory', 'search'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function update($id)
	{
		return $this->saveCategory($id);
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
			return redirect()->route('category.index')->with('error', 'Categoria não localizada');
		}

		if($response)
		{
			return redirect()->route('category.index')->with('success', 'Categoria excluida com sucesso!');
		}

		return redirect()->route('category.index')->with('error', 'Erro ao excluir categoria');
	}

	public function projects($id)
	{
		$category = $this->repository->show($id);

		$projects = $category->projects;

		return view('categories.projects')->with(compact('category', 'projects'));
	}

	protected function saveCategory($id = null)
	{
		if(!$this->validator->passes())
		{
			return redirect()->route('category.index')->withErrors($this->validator->getErrors())->withInput();
		}

		$input = Request::all();

		if(!is_null($id))
		{
			$response = $this->repository->update($input, $id);
			$successMessage = 'Categoria atualizada com sucesso!';
		} else {
			$response = $this->repository->store($input);
			$successMessage = 'Categoria criada com sucesso!';
		}

		return redirect()->route('category.index')->with('success', $successMessage);

	}
}
