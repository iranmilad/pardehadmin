@extends('layouts.primary')

@section('title', 'ویرایش کاربر')
@section('content')

@include('partials.profile')
<form method="delete" action="{{ route('user.sessions.save', ['id' => $user->id]) }}">
    @csrf
    <!--begin::Login sessions-->
    <div class="card mb-5 mb-lg-10">
        <!--begin::کارت header-->
        <div class="card-header">
            <!--begin::Heading-->
            <div class="card-title">
                <h3>جلسات ورود به سیستم</h3>
            </div>
            <!--end::Heading-->
        </div>
        <!--end::کارت header-->
        <!--begin::کارت body-->
        <div class="card-body">
            <!--begin::Table wrapper-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9">
                    <!--begin::Thead-->
                    <thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
                        <tr>
                            <th class="min-w-150px">دستگاه</th>
                            <th class="min-w-150px">آدرس IP</th>
                            <th class="min-w-150px">زمان</th>
                            <th class="text-end">عملیات</th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-semibold text-gray-600">
                        @foreach ($user->loginSessions as $session)
                            <tr>
                                <td>{{ $session->device }}</td>
                                <td>{{ $session->ip_address }}</td>
                                <td>{{ $session->created_at->diffForHumans() }}</td>
                                <td class="text-end">
                                    <button type="submit" value="{{ $session->id }}" name="session_id" class="btn btn-sm btn-light-primary">خروج</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <!--end::Tbody-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table wrapper-->
        </div>
        <!--end::کارت body-->
    </div>
    <!--end::Login sessions-->
</form>

@endsection
