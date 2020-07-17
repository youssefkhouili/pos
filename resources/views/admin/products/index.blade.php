@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <h1 class="text-center">@lang('site.products')</h1>
    </section>
    @if ($products->count() > 0)

    <section class="content mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-3">@lang('site.products') [<small>{{ $products->total() }}</small>]</h3>
                <form action="{{ route('dashboard.products.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" placeholder="@lang('site.search')" class="form-control" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_products'))
                                <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.add')</a>
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
                            <th>@lang('site.product_name')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.purchase_price')</th>
                            <th>@lang('site.sale_price')</th>
                            <th>@lang('site.stock')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index=>$category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td><img alt="image_product" src="" /></td>
                            <td>{{ $category->purchase_price }}</td>
                            <td>{{ $category->sale_price }}</td>
                            <td>{{ $category->stock }}</td>
                            <td>
                                @if (auth()->user()->hasPermission('update_products'))
                                    <a href="{{ route('dashboard.products.edit', $category->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> @lang('site.edit')</a>
                                @else
                                    <button class="btn btn-secondary btn-sm disabled"><i class="fas fa-edit"></i> @lang('site.edit')</button>
                                @endif
                                @if (auth()->user()->hasPermission('delete_products'))
                                    <form action="{{ route('dashboard.products.destroy', $category->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="confirm('@lang('site.confirm')')" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> @lang('site.delete')</button>
                                    </form>
                                @else
                                    <button class="btn btn-danger btn-sm disabled"><i class="fas fa-trash"></i> @lang('site.delete')</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </section>


    @else
        <div class="alert alert-info">
            <h3>@lang('site.no_data_found')</h3>
            <a href="{{ route('dashboard.products.index') }}" class="btn btn-primary" style="text-decoration: none">@lang('site.back')</a>
            <a href="{{ route('dashboard.products.create') }}" class="btn btn-secondary" style="text-decoration: none">@lang('site.product_register')</a>
        </div>
    @endif

@endsection
