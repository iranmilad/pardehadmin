@extends('layouts.primary')

@section('title', 'سفارش‌ها')

@section("toolbar")
<a href="{{route('orders.create')}}" class="btn btn-primary">ایجاد سفارش</a>
@endsection

@section('content')
<!-- START:TABLE -->
<div class="card">
  <div class="card-body">
    <form class="d-flex align-items-center justify-content-between mb-5" action="" method="get">
      @csrf
      <div class="d-flex align-items-center position-relative my-1">
        <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
        <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
      </div>
      <div>
        <button type="submit" name="export_csv" class="btn btn-success d-none">خروجی csv</button>
      </div>
    </form>
    <form method="post" class="" id="action_form" action="{{ route('orders.bulk_action') }}">
      @csrf
      <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
        <div class="d-flex align-items-center gap-5">
          <select class="form-select form-select-solid tw-w-max" name="action" id="bulk_action">
            <option value="">عملیات</option>
            <option value="delete">حذف</option>
          </select>
          <button class="btn btn-primary" type="submit">اجرا</button>
        </div>
        <div>
          <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#filter_collapse">فیلتر</button>
        </div>
      </div>

      <div id="filter_collapse" class="collapse">
        <div class="d-flex align-items-end flex-wrap w-100 gap-10">
          <div>
            <label class="form-label" for="filter_date">از تاریخ</label>
            <input class="form-control form-control-solid" name="from_date" name="date_range" data-jdp type="text">
          </div>
          <div>
            <label class="form-label" for="">تا تاریخ</label>
            <input class="form-control form-control-solid" name="to_date" data-jdp type="text">
          </div>
          <div>
            <label class="form-label" for="filter_status">وضعیت</label>
            <select multiple class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="status[]" id="filter_status">
              <option value="pending">در انتظار بررسی</option>
              <option value="in_review">درحال بررسی</option>
              <option value="completed">انجام شده</option>
            </select>
          </div>
          <div>
            <label class="form-label" for="filter_payment">نوع پرداختی</label>
            <select multiple class="form-select form-select-solid" data-placeholder="انتخاب نوع پرداختی" data-control="select2" name="payment_type[]" id="filter_payment">
              <option value="card">کارت به کارت</option>
              <option value="gateway">درگاه بانکی</option>
              <option value="check">چک</option>
            </select>
          </div>
          <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
        </div>
      </div>

      <table id="orders_table" class="table gy-5 gs-7">
        <thead>
          <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
            <th class="w-10px">
              <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#orders_table .form-check-input" value="1" />
              </div>
            </th>
            <th class="cursor-pointer px-0 text-start">سفارش</th>
            <th class="cursor-pointer px-0 text-start">تاریخ</th>
            <th class="cursor-pointer px-0 text-start">وضعیت</th>
            <th class="px-0 text-start">مجموع</th>
            <th class="px-0 text-start">نوع پرداخت</th>
            <th class="text-end">عملیات</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>
              <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="ids[]" value="{{ $order->id }}" />
              </div>
            </td>
            <td>
              <a href="{{route('orders.edit', ['id' => $order->id])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">#{{ $order->id }} {{ $order->customer_name }}</a>
            </td>
            <td>
              <a href="{{route('orders.edit', ['id' => $order->id])}}">{{ $order->getCreatedAtShamsiAttribute() }}</a>
            </td>
            <td>
              <a class="badge badge-warning" href="{{route('orders.edit', ['id' => $order->id])}}">{{ $order->status }}</a>
            </td>
            <td>{{ number_format($order->total) }} تومان</td>
            <td>
              <a class="badge badge-primary" href="{{route('orders.edit', ['id' => $order->id])}}">{{ $order->payment_method }}</a>
            </td>
            <td class="text-end">
              <a href="{{route('orders.edit', ['id' => $order->id])}}" class="btn btn-light btn-sm">
                مشاهده
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </form>
    <!--end::Group actions-->

    <ul class="pagination">
      {{ $orders->links("vendor.pagination.custom-pagination") }}
    </ul>
  </div>
</div>
<!-- END:TABLE -->
@endsection

@section('script-before')
<script src="{{asset('plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('plugins/jalalidatepicker.min.js')}}"></script>
@endsection

@section("scripts")
<script>
  jalaliDatepicker.startWatch();
</script>
@endsection
