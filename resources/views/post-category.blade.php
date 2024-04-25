<!-- This blade is used for writing and editing a post -->
@extends('layouts.primary')
@if({{ request()->get('action')}} === "edit")
    @section('title', 'ویرایش دسته')
@else
@section('title', 'دسته بندی')


@section('content')