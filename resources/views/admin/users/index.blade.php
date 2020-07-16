@extends('admin.layouts.app')

@section('content')

    <section class="content-header">
        <h1 class="text-center">@lang('site.users')</h1>
    </section>
    @if ($users->count() > 0)

    <section class="content mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-3">@lang('site.users') [<small>{{ $users->total() }}</small>]</h3>
                <form action="{{ route('dashboard.users.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" placeholder="@lang('site.search')" class="form-control" value="{{ request()->search }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_users'))
                                <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.add')</a>
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
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index=>$user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td><img src="{{ $user->image_path }}" style="width: 70px" class="img-thumbnail" alt="user_profile"></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (auth()->user()->hasPermission('update_users'))
                                    <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> @lang('site.edit')</a>
                                @else
                                    <button class="btn btn-secondary btn-sm disabled"><i class="fas fa-edit"></i> @lang('site.edit')</button>
                                @endif
                                @if (auth()->user()->hasPermission('delete_users'))
                                    <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="post" style="display: inline-block">
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
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </section>


    @else
        <div class="alert alert-info">
            <h3>@lang('site.no_data_found')</h3>
            <a href="{{ route('dashboard.users.index') }}" class="btn btn-primary" style="text-decoration: none">@lang('site.back')</a>
            <a href="{{ route('dashboard.users.create') }}" class="btn btn-secondary" style="text-decoration: none">@lang('site.user_register')</a>
        </div>
    @endif

@endsection
