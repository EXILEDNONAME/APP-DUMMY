@extends('layouts.backend.default')
@section('title', 'File Manager')

@push('head')
<link rel="stylesheet" href="{{ env('APP_URL') }}/assets/backend/mix/css/file-manager.css">
@endpush

@section('content')
<div class="lg:col-span-3">
    <div class="grid">
        <div id="elfinder"></div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ env('APP_URL') }}/assets/backend/mix/js/file-manager.js"></script>
<script type="text/javascript" charset="utf-8">
    $().ready(function() {
        $('#elfinder').elfinder({
            customData: {
                _token: '{{ csrf_token() }}'
            },
            url: '{{ route("elfinder.connector") }}'
        });
    });
</script>
@endpush