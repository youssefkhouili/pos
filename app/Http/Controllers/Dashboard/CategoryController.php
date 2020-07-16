<?php

namespace App\Http\Controllers\Dashboard;

use App\category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::when($request->search, function($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => 'required'];
            $rules += [$locale . '.name' => [Rule::unique('category_translations,name')]];
        };
        $request->validate($rules);

        Category::create($request->all());
        session()->flash('success', 'site.cat_add_success');
        return redirect()->route('dashboard.categories.index');


    }

    public function edit(category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }


    public function update(Request $request, category $category)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => 'required'];
            $rules += [$locale . '.name' => [Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
        };
        $request->validate($rules);

        $category->update($request->all());
        session()->flash('success', 'site.updated_success');

        return redirect()->route('dashboard.categories.index');
    }


    public function destroy(category $category)
    {
        $category->delete();
        session()->flash('success', 'site.deleted_success');
        return redirect()->route('dashboard.categories.index');
    }
}
