<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request as R;

use App\Category as Category;

use App\Dave\Services\Validators\CategoryValidator;

use \Request as Request;

class CategoryController extends Controller {

	protected $validator;

	function __construct(CategoryValidator $validator)
	{
		$this->validator = $validator;
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

		if(!is_null($search) && $search != '')
		{
			$categories = Category::where('name', 'like', '%'.$search.'%')->paginate($total);
		} else {
			$categories = Category::paginate($total);
		}

		$loadedCategory = null;

		return view('categories.index')->with(compact('categories', 'loadedCategory', 'search'));
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
		

		if(!$this->validator->passes())
		{
			return redirect()->route('category.index')->withErrors($this->validator->getErrors())->withInput();
		}

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
}
