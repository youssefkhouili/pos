@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.register_cat')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <div class="row">
            <div class="col-sm-6">
            <div id="accordion" class="myaccordion">
                @foreach ($categories as $category)
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0">
                        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#{{ str_replace(' ', '-', $category->name) }}" aria-expanded="false" aria-controls="{{ str_replace(' ', '-', $category->name) }}">
                            {{ $category->name }}
                        </button>
                        </h2>
                    </div>
                    <div id="{{ str_replace(' ', '-', $category->name) }}" class="collapse" aria-labelledby="first" data-parent="#accordion">
                        <div class="card-body">
                            @if ($category->product->count() > 0)
                                <table class="table table-hover">
                                    <tr>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.stock')</th>
                                        <th>@lang('site.price')</th>
                                        <th>@lang('site.add')</th>
                                    </tr>
                                    @foreach ($category->product as $product)
                                        <tr>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->stock }}</td>
                                            <td>{{ $product->sale_price }}</td>
                                            <td>
                                                <a href=""
                                                   id="product-{{ $product->id }}"
                                                   data-name="{{ $product->name }}"
                                                   data-id="{{ $product->id }}"
                                                   data-price="{{ $product->sale_price }}"
                                                   class="btn btn-success btn-sm add-product-btn"
                                                   >
                                                   <i class="fas fa-plus-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <h5>@lang('site.no_data_found')</h5>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h2>@lang('site.orders')</h2>
                        <form action="" method="post">
                            @csrf
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                </thead>
                                <tbody class="order-list">

                                </tbody>
                            </table>
                            <h4>@lang('site.total') :<span class="total-price">0</span></h4>
                            <button class="btn btn-primary btn-block disabled" id="add-order-form-btn">@lang('site.add')</button>
                        </form>
                        {{-- <div class="row my-4">
                            <div class="col-sm-4">@lang('site.product')</div>
                            <div class="col-sm-4">@lang('site.quantity')</div>
                            <div class="col-sm-4">@lang('site.price')</div>
                        </div>
                        <div class="mb-2">@lang('site.total')</div>
                        <a href="" class="btn btn-secondary btn-block">@lang('site.add')</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
