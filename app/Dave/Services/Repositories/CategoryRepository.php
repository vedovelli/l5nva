<?php namespace App\Dave\Services\Repositories;

use App\Category as Category;

class CategoryRepository implements ICategoryRepository
{
    public function categories($total, $search = null)
    {
        if(!is_null($search) && $search != '')
        {
            $categories = Category::where('name', 'like', '%'.$search.'%')->paginate($total);
        } else {
            $categories = Category::paginate($total);
        }
        \Debugbar::log(['cats' => $categories]);

        return $categories;
    }


  public function categoriesForSelect()
  {
    $allCategories = [];

    $categoriesOriginal = $this->categories(null, false)->toArray(); // search == null && paginate == false

    foreach ($categoriesOriginal as $value) {
      $allCategories[$value['id']] = $value['name']; // formato para Form::select()
    }

    return $allCategories;
  }

  public function categoriesWithProjects()
  {
    $allCategories = [];

    /**
    * Seleciona todos os IDs de categorias associadas a projetos
    */
    $catsWithProjs = \DB::table('category_project')->distinct()->get(['category_id']);

    if(count($catsWithProjs) > 0)
    {
      /**
      * Reduz o array a apenas IDs
      */
      foreach ($catsWithProjs as $value) {
        $categories[] = $value->category_id;
      }

      /**
      * Obtem uma Collection de objetos Category
      */
      $categoriesOriginal = Category::whereIn('id', $categories)->get();

      /**
      * Formato amigável para Form::select()
      */
      foreach ($categoriesOriginal as $value) {
        $allCategories[$value['id']] = $value['name'];
      }
    }

    return $allCategories;
  }

    public function store($request)
    {
        $category = new Category();

        $category->fill($request);

        $category->save();

        return $category;
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(is_null($category))
        {
            return null;
        }

        return $category;
    }

    public function update($request, $id)
    {
        $category = Category::find($id);

        $category->fill($request);

        $category->save();

        return $category;
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(is_null($category))
        {
            return null;
        }

        return $category->delete();

    }
}