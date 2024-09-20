@extends('layouts.primary')

@section('title', 'مناطق حمل و نقل')

@section("toolbar")
<a href="{{ route('transports.create') }}" class="btn btn-primary">افزودن منطقه جدید</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="{{ route('transports.index') }}" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" class="" id="action_form" action="{{ route('transports.bulk_action') }}">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4">
                <select class="form-select form-select-solid tw-w-max" name="action" id="action_select">
                    <option value="">عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="global_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">روش ارسال</th>
                        <th class="cursor-pointer px-0 text-start">ناحیه ها</th>
                        <th class="cursor-pointer px-0 text-start">روش حمل و نقل</th>

                        <th class="cursor-pointer px-0 text-start">جزئیات هزینه</th>
                        <th class="text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transports as $transport)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_row[]" value="{{ $transport->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('transports.edit', ['id' => $transport->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $transport->title }}</a>
                        </td>
                        <td>
                            @if ($transport->regions)
                                @forelse ($transport->regions as $region)
                                <a class="badge badge-primary" href="{{ route('transports.edit', ['id' => $transport->id]) }}">{{ $region }}</a>
                                @empty
                                <a class="badge badge-primary" href="{{ route('transports.edit', ['id' => $transport->id]) }}">همه نواحی</a>
                                @endforelse
                            @else
                                <a class="badge badge-primary" href="{{ route('transports.edit', ['id' => $transport->id]) }}">همه نواحی</a>
                            @endif
                        </td>
                        <td>
                            <a class="text-primary" href="{{ route('transports.edit', ['id' => $transport->id]) }}">{{ $transport->cost_type }}</a>
                        </td>

                        <td>
                            <a href="{{ route('transports.edit', ['id' => $transport->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">
                                @switch($transport->cost_type)
                                    @case('fixed')
                                        هزینه ثابت: {{ $transport->price }}
                                        @break
                                    @case('percentage')
                                        درصد ارزش سبد: {{ $transport->percentage_of_cart_value }}%
                                        @break
                                    @case('weight')
                                        هزینه بر اساس وزن: {{ $transport->weight_based_cost }} تومان به ازای هر کیلوگرم
                                        @break
                                    @case('dimension')
                                        هزینه بر اساس ابعاد: {{ $transport->dimension_based_cost }} تومان به ازای هر واحد حجم
                                        @break
                                    @default
                                        نامشخص
                                @endswitch
                            </a>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('transports.edit', ['id' => $transport->id]) }}" class="btn btn-light btn-sm">
                                ویرایش
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>

        {{ $transports->links() }}
    </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection
