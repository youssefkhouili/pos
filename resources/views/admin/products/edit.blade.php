@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.edit')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>@lang('site.categories')</label>
                <select name="category_id" class="form-control">
                    <option value="" disabled>@lang('site.categories')</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-flex flex-column">
                <label for="user_profile">@lang('site.image')</label>
                <input type="file" name="image" id="image-input">
            </div>
            <div class="form-group">
                <img id="user_profile" src="{{ $product->image_path }}" style="width: 100px" class="img-thumbnail" alt="">
            </div>
            <div class="form-group">
                <label for="purchase_price">@lang('site.purchase_price')</label>
                <input type="number" name="purchase_price" id="purchase_price" class="form-control" value="{{ $product->purchase_price }}">
            </div>
            <div class="form-group">
                <label for="sale_price">@lang('site.sale_price')</label>
                <input type="number" name="sale_price" id="sale_price" class="form-control" value="{{ $product->sale_price }}">
            </div>
            <div class="form-group">
                <label for="stock">@lang('site.stock')</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}">
            </div>
            @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label for="product_name">@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" id="product_name" class="form-control" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="desc">@lang('site.' . $locale . '.description')</label>
                    <textarea name="{{ $locale }}[description]" id="desc" class="ckeditor">{{ $product->description }}</textarea>
                </div>
            @endforeach
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.edit')</button>
            </div>
        </form>
    </section>
@endsection
