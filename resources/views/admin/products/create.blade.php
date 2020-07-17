@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.product_register')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>@lang('site.categories')</label>
                <select name="category_id" class="form-control">
                    <option value="" disabled>@lang('site.categories')</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-flex flex-column">
                <label for="image">@lang('site.image')</label>
                <input type="file" name="image" id="image-input">
            </div>
            <div class="form-group">
                <img id="image" src="{{ asset('uploads/users_images/default_product.png') }}" style="width: 100px" class="img-thumbnail" alt="">
            </div>
            @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label for="product_name">@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" id="product_name" class="form-control" value="{{ old($locale . 'name') }}">
                </div>
                <div class="form-group">
                    <label for="desc">@lang('site.' . $locale . '.description')</label>
                    <textarea name="{{ $locale }}[description]" id="desc" class="ckeditor">{{ old($locale . 'description') }}</textarea>
                </div>
            @endforeach
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.add')</button>
            </div>
        </form>
    </section>
@endsection
