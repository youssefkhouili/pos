@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <h1 class="text-center">@lang('site.clients')</h1>
    </section>
    @if ($clients->count() > 0)

    <section class="content mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-3">@lang('site.clients') [<small>{{ $clients->total() }}</small>]</h3>
                <form action="{{ route('dashboard.clients.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" placeholder="@lang('site.search')" class="form-control" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_clients'))
                                <a href="{{ route('dashboard.clients.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.add')</a>
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
                            <th>@lang('site.name')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.add_order')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $index=>$client)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone[0] }}</td>
                            <td>{{ $client->address }}</td>
                            @if (auth()->user()->hasPermission('create_orders'))
                                <td><a class="btn btn-primary btn-sm" href="{{ route('dashboard.clients.orders.create', $client->id) }}">@lang('site.add_order')</a></td>
                            @else
                                <td><a class="btn btn-primary btn-sm disabled">@lang('site.add_order')</a></td>
                            @endif
                            <td>
                                @if (auth()->user()->hasPermission('update_clients'))
                                    <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> @lang('site.edit')</a>
                                @else
                                    <button class="btn btn-secondary btn-sm disabled"><i class="fas fa-edit"></i> @lang('site.edit')</button>
                                @endif
                                @if (auth()->user()->hasPermission('delete_clients'))
                                    <form action="{{ route('dashboard.clients.destroy', $client->id) }}" method="post" style="display: inline-block">
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
                {{ $clients->appends(request()->query())->links() }}
            </div>
        </div>
    </section>


    @else
        <div class="alert alert-info">
            <h3>@lang('site.no_data_found')</h3>
            <a href="{{ route('dashboard.clients.index') }}" class="btn btn-primary" style="text-decoration: none">@lang('site.back')</a>
            <a href="{{ route('dashboard.clients.create') }}" class="btn btn-secondary" style="text-decoration: none">@lang('site.client_register')</a>
        </div>
    @endif

@endsection
