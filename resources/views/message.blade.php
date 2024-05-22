<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')

@section('title', 'اندازه گیری پرده')

@section("toolbar")
<div>
    <span class="btn btn-success">مدیریت</span>
    <span class="btn btn-danger">مهم</span>
</div>
@endsection

@section('content')

<div class="tw-relative tw-h-[calc(100vh-200px)] w-100">
    <x-chat />
</div>


@endsection

@section("script-before")
<script>
    window['msg-page'] = true;
</script>
@endsection