<?php

namespace App\Repositories;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class CategoryEloquent extends BaseController
{
    private $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function index()
    {
        $category = Category::get();
        return $this->sendResponse('all categories', CategoryResource::collection($category));
    }

    public function filter(array $data)
    {
        if (isset($data['name'])) {
            $category = Category::where('name', 'like', $data['name'])->get();
            return $this->sendResponse('all categories', CategoryResource::collection($category));
        }
        if (isset($data['date_of_registration'])) {
            $category = Category::where('date_of_registration', '=', $data['date_of_registration'])->get();
            return $this->sendResponse('all categories', CategoryResource::collection($category));
        }
    }

    public function store(array $data)
    {
        try {
            $num_of_product = null;
            $category = Category::create([
                'name' => $data['name'],
                'date_of_registration' => $data['date_of_registration']
            ]);
            return $this->sendResponse('add category successfully', new CategoryResource($category));

        } catch (\Exception $e) {
            // something went wrong
        }
    }

    public function update(array $data, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return $this->sendError(404, 'There is no Category has this id');
        } else {
            if (isset($data['name'])) {
                $category->name = $data['name'];
            }
            if (isset($data['date_of_registration'])) {
                $category->date_of_registration = $data['date_of_registration'];
            }
            $category->save();
            return $this->sendResponse('category updated success', new CategoryResource($category),);

        }
    }

    public function delete(array $data)
    {
        $category = Category::find($data['id']);
        if ($category) {
            $category->delete();
            return $this->sendResponse('delete Category successfully', []);
        } else {
            return $this->sendError('enter valid category id');
        }

    }
}
