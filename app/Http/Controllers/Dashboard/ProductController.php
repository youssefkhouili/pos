<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function($q) use ($request) {

            return $q->whereTranslationLike('name', 'like', '%' . $request->search . '%');

        })->when($request->category_id, function($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);


        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $rules = [
            'category_id'   => 'required'
        ];

        foreach(config('translatable.locales') as $locale) {
            $rules += [$locale . '.name'        => 'required'];
            $rules += [$locale . '.description' => 'required' ];
        }

        $rules += [
            'purchase_price' => 'required',
            'sale_price'     => 'required',
            'stock'          => 'required'
        ];

        $request->validate($rules);

        $request_data = $request->all();
        if ($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        Product::create($request_data);
        session()->flash('success', 'site.prod_add_success');

        return redirect()->route('dashboard.products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id'   => 'required'
        ];

        foreach(config('translatable.locales') as $locale) {
            $rules += [$locale . '.name'        => 'required'];
            $rules += [$locale . '.description' => 'required' ];
        }

        $rules += [
            'purchase_price' => 'required',
            'sale_price'     => 'required',
            'stock'          => 'required'
        ];

        $request->validate($rules);

        $request_data = $request->all();
        if ($request->image) {
            if ($product->image != 'default_product.png') {
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        $product->update($request_data);
        session()->flash('success', 'site.cat_update');

        return redirect()->route('dashboard.products.index');
    }

    public function destroy(Product $product)
    {
        if ($product->image != 'default_product.png') {
            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
        }
        $product->delete();
        session()->flash('success', 'site.deleted_success');

        return redirect()->route('dashboard.products.index');

    }
}
