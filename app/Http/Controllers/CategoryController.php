<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request as R;

use App\Category as Category;

use \Request as Request;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();

		$loadedCategory = null;

		return view('categories.index')->with(compact('categories', 'loadedCategory'));
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
		$categories = Category::all();

		$loadedCategory = Category::find($id);

		return view('categories.index')->with(compact('categories', 'loadedCategory'));
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
		$category = Category::find($id);

		if(is_null($category))
		{
			return redirect()->route('category.index')->with('error', 'Categoria não localizada');
		}

		$response = $category->delete();

		if($response)
		{
			return redirect()->route('category.index')->with('success', 'Categoria excluida com sucesso!');
		}

		return redirect()->route('category.index')->with('error', 'Erro ao excluir categoria');
	}

	protected function saveCategory($id = null)
	{
		$rules = ['name' => 'required|min:10'];

		$messages = [
			'name.required' => 'O nome da categoria é obrigatório',
			'name.min' => 'O nome da categoria precisa ter pelo menos 10 caracteres',
		];

		$validator = \Validator::make(Request::all(), $rules, $messages);

		if($validator->passes())
		{
			$input = Request::all();

			if(!is_null($id))
			{
				$category = Category::find($id);
				$successMessage = 'Categoria atualizada com sucesso!';
			} else {
				$category = new Category();
				$successMessage = 'Categoria criada com sucesso!';
			}

			$category->fill($input);

			$category->save();

			return redirect()->route('category.index')->with('success', $successMessage);
		}

		return redirect()->route('category.index')->withErrors($validator)->withInput();
	}
}
