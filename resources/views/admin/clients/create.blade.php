@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="text-center">@lang('site.register_cat')</h1>
    </section>
    <section class="content">
        @include('admin.partials._errors')
        <form action="{{ route('dashboard.clients.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="client_name">@lang('site.name')</label>
                <input type="text" name="name" id="client_name" class="form-control" value="{{ old('name') }}">
            </div>
            @for ($i = 0; $i < 2; $i++)
                <div class="form-group">
                    <label for="phone">@lang('site.phone')</label>
                    <input type="text" name="phone[]" class="form-control" id="phone"}}">
                </div>
            @endfor

            <div class="form-group">
                <label for="address">@lang('site.address')</label>
                <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> @lang('site.add')</button>
            </div>
        </form>
    </section>
@endsection
