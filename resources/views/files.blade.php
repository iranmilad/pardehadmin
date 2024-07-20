@extends('layouts.primary')

@section('title', 'مدیریت فایل ها')

@extends('layouts.primary')

@section('title', 'مدیریت فایل ها')

@section('css-before')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('content')
<div id="fm" style="height: 600px;"></div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var fmDiv = document.getElementById('fm');
        fmDiv.innerHTML = '<iframe src="/file-manager/fm-button" style="width: 100%; height: 100%; border: none;"></iframe>';

    });
</script>
@endsection
