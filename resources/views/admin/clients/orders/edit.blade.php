@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.edit')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <form action="{{ route('dashboard.clients.update', $client->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="client_name">@lang('site.name')</label>
                <input type="text" name="name" id="client_name" class="form-control" value="{{ $client->name }}">
            </div>
            @for ($i = 0; $i < 2; $i++)
                <div class="form-group">
                        <label for="phone">@lang('site.phone')</label>
                        <input type="text" name="phone[]" class="form-control" id="phone" value="{{ $client->phone[$i] ?? __('site.dont_have_number') }}"">
                </div>
            @endfor

            <div class="form-group">
                <label for="address">@lang('site.address')</label>
                <textarea name="address" id="address" class="form-control">{{ $client->address }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> @lang('site.edit')</button>
            </div>
        </form>
    </section>
@endsection
