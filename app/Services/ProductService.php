<?php

namespace App\Services;

use App\Product;

class ProductService
{
    public function storeProduct(ProductFormRequest $request)
    {
        $product = Product::create($request->all());

        foreach($request->categories as $categoryId)
            $product->categories()->attach($categoryId);
    }

    public function updateProduct(ProductFormRequest $request, Product $product)
    {
        $product->update($request->all());

        foreach($request->categories as $categoryId)
            $product->categories()->sync($categoryId);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function restore(int $id)
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        $product->restore();
    }

    public function destroy(int $id)
    {
        $product = Product::onlyTrashed()->whereId($id)->first();
        $product->forceDelete();
    }
}
