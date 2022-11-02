<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryEloquent;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(CategoryEloquent $categoryEloquent)
    {
        $this->category = $categoryEloquent;
    }
    public function index()
    {
        $categories = Category::get();
        return view('category.index')->with(['categories' => $categories]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function filter(array $data)
    {
        if (isset($data['name'])) {
            $categories = Category::where('name', 'like', $data['name'])->get();
            return view('category.index')->with(['categories' => $categories]);
        }
        if (isset($data['date_of_registration'])) {
            $categories = Category::where('date_of_registration', '=', $data['date_of_registration'])->get();
            return view('category.index')->with(['categories' => $categories]);
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit')->with(['category'=>$category]);
    }

    public function store(CategoryRequest $request)
    {
        return $this->category->store($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->category->update($request->all(), $id);
    }

    public function delete(Request $request)
    {
        $data = $request->all();
        $category = Category::find($data['id']);
        if ($category) {
            $category->delete();
            return redirect()->route('viewCategory')->with('message', 'category deleted successfully');
        }

    }

}
