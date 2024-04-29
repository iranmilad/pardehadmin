@extends('layouts.primary')

@section('title', 'ویرایش کاربر')
@section('content')
<x-profile />
<form method="delete" action="{{route('user.sessions.save',['id' => 1])}}">
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
                            <th class="min-w-150px">ادرس ای پی</th>
                            <th class="min-w-150px">زمان</th>
                            <th class="text-end">عملیات</th>
                        </tr>
                    </thead>
                    <!--end::Thead-->
                    <!--begin::Tbody-->
                    <tbody class="fw-6 fw-semibold text-gray-600">
                        <tr>
                            <td>Chrome - Windows</td>
                            <td>236.125.56.78</td>
                            <td>دو دقیقه پیش</td>
                            <td class="text-end">
                                <button type="submit" value="1" name="session_id" class="btn btn-sm btn-light-primary">خارج شدن</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Safari - Mac OS</td>
                            <td>236.125.56.78</td>
                            <td>ده دقیقه پیش</td>
                            <td class="text-end">
                                <button type="submit" value="2" name="session_id" class="btn btn-sm btn-light-primary">خارج شدن</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Firefox - Windows</td>
                            <td>236.125.56.10</td>
                            <td>بیست دقیقه پیش</td>
                            <td class="text-end">
                                <button type="submit" value="3" name="session_id" class="btn btn-sm btn-light-primary">خارج شدن</button>
                            </td>
                        </tr>
                        <tr>
                            <td>iOS - iphone</td>
                            <td>236.125.56.54</td>
                            <td>سی دقیقه پیش</td>
                            <td class="text-end">
                                <button type="submit" value="4" name="session_id" class="btn btn-sm btn-light-primary">خارج شدن</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Samsung Noted 5- Android</td>
                            <td>236.100.56.50</td>
                            <td>چهل دقیقه پیش</td>
                            <td class="text-end">
                                <button type="submit" value="5" name="session_id" class="btn btn-sm btn-light-primary">خارج شدن</button>
                            </td>
                        </tr>
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