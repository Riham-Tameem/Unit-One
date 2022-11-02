<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
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
        //   $product = Product::where('category_id', $data['category_id'])->get();
        $product = Product::get();
        return $this->sendResponse('all product', ProductResource::collection($product));
    }

    public function filter(Request $data)
    {
        if (isset($data['name'])) {
            $products = Product::where('name', 'like', $data['name'])->get();
            return view('product.index')->with(['products' => $products]);
        }
        if (isset($data['price'])) {
            $products = Product::where('price', '=', $data['price'])->get();
            return view('product.index')->with(['products' => $products]);
        }
        if (isset($data['serial_number'])) {
            $products = Product::where('serial_number', '=', $data['serial_number'])->get();
            return view('product.index')->with(['products' => $products]);
        }
        if (isset($data['category_name'])) {
            $products = Product::where('category_name', 'like', $data['category_name'])->get();
            return view('product.index')->with(['products' => $products]);
        }
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        return $this->product->store($request->all());
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit')->with(['product'=>$product]);
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->product->update($request->all(), $id);
    }
}
