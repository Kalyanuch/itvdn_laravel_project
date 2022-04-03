<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductFormRequest;
use App\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['categories'])->paginate();

        $trashedProducts = Product::onlyTrashed()->get();

        return view('admin.products.index', compact('products', 'trashedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);

        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');

        $productCategories = [];

        return view('admin.products.create', compact('categories', 'productCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $this->authorize('create', Product::class);

        $this->productService->storeProduct($request);

        return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update', Product::class);

        $categories = Category::all();
        $categories = $categories->pluck('name', 'id');

        $productCategories = $product->categories()->pluck('id');

        return view('admin.products.edit', compact('product','categories', 'productCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, Product $product)
    {
        $this->authorize('update', Product::class);

        $this->productService->updateProduct($request, $product);

        return redirect()->route('admin.products.index');
    }

    /**
     * Delete from specified resource from storage
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Product $product)
    {
        $this->authorize('delete', Product::class);

        $this->productService->delete($product);

        return redirect()->route('admin.products.index');
    }

    /**
     * Restore the specified resource in storage
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id)
    {
        $this->authorize('restore', Product::class);

        $this->productService->restore($id);

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $this->authorize('forceDelete', Product::class);

        $this->productService->destroy($id);

        return redirect()->route('admin.products.index');
    }
}
