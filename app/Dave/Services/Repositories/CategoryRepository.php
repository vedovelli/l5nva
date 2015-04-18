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

        return $categories;
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