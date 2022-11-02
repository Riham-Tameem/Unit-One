<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Repositories\ProductEloquent;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(ProductEloquent $productEloquent)
    {
        $this->product = $productEloquent;
    }

    public function index()
    {
        return $this->product->index();
    }

    public function filter(Request $request)
    {
        return $this->product->filter($request->all());
    }

    public function store(Request $request)
    {
        return $this->product->store($request->all());
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->product->update($request->all(), $id);
    }
}
