<?php

namespace App\Repositories;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductEloquent
    extends BaseController
{

    private $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function index()
    {
        //   $product = Product::where('category_id', $data['category_id'])->get();
        $product = Product::get();
        return $this->sendResponse('all product', ProductResource::collection($product));
    }

    public function filter(array $data)
    {
        if (isset($data['name'])) {
            $product = Product::where('name', 'like', $data['name'])->get();
            return $this->sendResponse('all Product', ProductResource::collection($product));
        }
        if (isset($data['price'])) {
            $product = Product::where('price', '=', $data['price'])->get();
            return $this->sendResponse('all Product', ProductResource::collection($product));
        }
        if (isset($data['serial_number'])) {
            $product = Product::where('serial_number', '=', $data['serial_number'])->get();
            return $this->sendResponse('all Product', ProductResource::collection($product));
        }
        if (isset($data['category_name'])) {
            $product = Product::where('category_name', 'like', $data['category_name'])->get();
            return $this->sendResponse('all Product', ProductResource::collection($product));
        }
    }

    public function store(array $data)
    {
        try {
            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'serial_number' => $data['serial_number'],
                'category_id' => $data['category_id'],
            ]);
            $product->category_name = $product->category->name;
            $product->save();
            return $this->sendResponse('add product successfully', new ProductResource($product));
        } catch (\Exception $e) {
            // something went wrong
        }
    }

    public function update(array $data, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->sendError(404, 'There is no product has this id');
        } else {
            $product->update($data);
            return $this->sendResponse('update product successfully', new ProductResource($product));
        }
    }

}
