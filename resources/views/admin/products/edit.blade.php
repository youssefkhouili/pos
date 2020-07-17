@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.edit')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label for="category_name">@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" id="category_name" class="form-control" value="{{ $category->translate($locale)->name }}">
                </div>
            @endforeach
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> @lang('site.edit')</button>
            </div>
        </form>
    </section>
@endsection
