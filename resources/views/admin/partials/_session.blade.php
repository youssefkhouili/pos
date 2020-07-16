@if (session('success'))


    <div class="alert alert-info">
        @lang(session('success'))
    </div>


@endif
