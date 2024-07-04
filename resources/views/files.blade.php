@section('css-before')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title', 'مدیریت فایل ها')

@extends('layouts.primary')

@section('content')
<div id="fm" style="height: 600px;"></div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection