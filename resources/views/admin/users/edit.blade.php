@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.edit')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="first_name">@lang('site.first_name')</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $user->first_name }}">
            </div>
            <div class="form-group">
                <label for="last_name">@lang('site.last_name')</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $user->last_name }}">
            </div>
            <div class="form-group">
                <label for="email">@lang('site.email')</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
            </div>
            <div class="form-group d-flex flex-column">
                <label for="image">@lang('site.image')</label>
                <input type="file" name="image" id="image-input">
            </div>
            <div class="form-group">
                <img id="user_profile" src="{{ $user->image_path }}" style="width: 100px" class="img-thumbnail" alt="">
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title p-3">@lang('site.permissions')</h3>
                    @php
                        $models = ['users', 'categories', 'products', 'clients', 'orders'];
                        $maps = ['read', 'create', 'update', 'delete'];
                    @endphp
                    <ul class="nav nav-pills p-2">
                        @foreach ($models as $index=>$model)
                            <li class="nav-item"><a class="nav-link {{ $index === 0 ? 'active' : '' }}" href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="card body">
                    <div class="tab-content">
                        @foreach ($models as $index=>$model)
                            <div class="tab-pane {{ $index === 0 ? 'active' : '' }}" id="{{ $model }}">
                                @foreach ($maps as $map)
                                    <input {{ $user->hasPermission($map . '_' . $model) ? 'checked' : '' }} type="checkbox" id="{{ $map }}" name="permissions[]" value="{{ $map . '_' . $model }}">
                                    <label  for="{{ $map }}">@lang('site.' . $map)</label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> @lang('site.edit')</button>
            </div>
        </form>
    </section>
@endsection
