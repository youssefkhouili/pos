@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.register_cat')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <form action="{{ route('dashboard.categories.store') }}" method="post">
            @csrf
            @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label for="category_name">@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" id="category_name" class="form-control" value="{{ old($locale . 'name') }}">
                </div>
            @endforeach
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.add')</button>
            </div>
        </form>
    </section>
@endsection
