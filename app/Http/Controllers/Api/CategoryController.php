<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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
        return $this->category->index();
    }

    public function filter(Request $request)
    {
        return $this->category->filter($request->all());
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
        return $this->category->delete($request->all());
    }
}
