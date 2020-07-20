@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <h1 class="text-center">@lang('site.categories')</h1>
    </section>
    @if ($categories->count() > 0)

    <section class="content mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-3">@lang('site.categories') [<small>{{ $categories->total() }}</small>]</h3>
                <form action="{{ route('dashboard.categories.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" placeholder="@lang('site.search')" class="form-control" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_categories'))
                                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.add')</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.category_name')</th>
                            <th>@lang('site.action')</th>
                            <th>@lang('site.prod_count')</th>
                            <th>@lang('site.related_prod')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index=>$category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if (auth()->user()->hasPermission('update_categories'))
                                    <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> @lang('site.edit')</a>
                                @else
                                    <button class="btn btn-secondary btn-sm disabled"><i class="fas fa-edit"></i> @lang('site.edit')</button>
                                @endif
                                @if (auth()->user()->hasPermission('delete_categories'))
                                    <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirm('@lang('site.confirm')')" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> @lang('site.delete')</button>
                                    </form>
                                @else
                                    <button class="btn btn-danger btn-sm disabled"><i class="fas fa-trash"></i> @lang('site.delete')</button>
                                @endif
                            </td>
                            <td>{{ $category->product->count() }}</td>
                            <td><a href="{{ route('dashboard.products.index', ['category_id' => $category->id]) }}" class="btn btn-primary btn-sm">@lang('site.related_prod')</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>
    </section>


    @else
        <div class="alert alert-info">
            <h3>@lang('site.no_data_found')</h3>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary" style="text-decoration: none">@lang('site.back')</a>
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-secondary" style="text-decoration: none">@lang('site.category_register')</a>
        </div>
    @endif

@endsection
