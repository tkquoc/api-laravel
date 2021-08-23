<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product::all());
        return $this->sendResponse($products, 'Yêu cầu thành công!');
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        return $this->sendResponse($product, "Thêm thành công");
    }

    public function show($id)
    {
        $product = new ProductResource(Product::findOrFail($id));
        return $this->sendResponse($product, 'Yêu cầu thành công');
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return $this->sendResponse(new ProductResource($product), 'Cập nhật thành công');

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return $this->sendResponse(new ProductResource($product), 'Xóa thành công!');
    }
}
