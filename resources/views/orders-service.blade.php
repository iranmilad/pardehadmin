@extends('layouts.primary')

@section('title', 'سفارشات خدمت')

@section("toolbar")
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_service_modal">افزودن خدمت برای سفارش</button>
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
        <button type="submit" name="export_csv" class="btn btn-success">خروجی csv</button>
      </div>
    </form>
    <form method="post" class="" id="action_form">
      <div class="d-flex tw-items-center tw-justify-between tw-w-full gap-4 mb-5">
        <div class="d-flex align-items-center gap-5">
          <select class="form-select form-select-solid tw-w-max" name="" id="">
            <option>عملیات</option>
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
            <label class="form-label" for="">از تاریخ</label>
            <input class="form-control form-control-solid" name="from_date" data-jdp type="text" placeholder="انتخاب کنید">
          </div>
          <div>
            <label class="form-label" for="">تا تاریخ</label>
            <input class="form-control form-control-solid" name="to_date" data-jdp type="text" placeholder="انتخاب کنید">
          </div>
          <div>
            <label class="form-label" for="">نوع</label>
            <select multiple class="form-select form-select-solid" data-placeholder="انتخاب وضعیت" data-control="select2" name="" id="">
              <option value="1">دوخت</option>
              <option value="2">طراحی</option>
              <option value="3">نصب</option>
            </select>
          </div>
          <div>
            <label class="form-label" for="">نوع پرداختی</label>
            <select multiple class="form-select form-select-solid" data-placeholder="انتخاب نوع پرداختی" data-control="select2" name="" id="">
              <option value="1">کارت به کارت</option>
              <option value="2">درگاه بانکی</option>
              <option value="3">چک</option>
            </select>
          </div>
          <button type="submit" name="filter" class="btn btn-primary tw-h-max">اجرا</button>
        </div>
      </div>

      <table id="global_table" class="table gy-5 gs-7">
        <thead>
          <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
            <th class="w-10px">
              <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#global_table .form-check-input" value="1" />
              </div>
            </th>
            <th class="cursor-pointer px-0 text-start">سفارش</th>
            <th class="cursor-pointer px-0 text-start">تاریخ</th>
            <th class="cursor-pointer px-0 text-start">نوع</th>
            <th class="px-0 text-start">مجموع</th>
            <th class="px-0 text-start">نوع پرداخت</th>
            <th class="text-end">عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="form-check form-check-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" name="checked_row" value="1" />
              </div>
            </td>
            <td>
              <a href="{{route('orders.edit',['id' => 1])}}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">#060 فرهاد باقری</a>
            </td>
            <td>
              <a href="{{route('orders.edit',['id' => 1])}}">12/12/1403</a>
            </td>
            <td>
              <a class="badge badge-warning" href="{{route('orders.edit',['id' => 1])}}">دوخت</a>
              <a class="badge badge-info" href="{{route('orders.edit',['id' => 1])}}">طراحی</a>
              <a class="badge badge-success" href="{{route('orders.edit',['id' => 1])}}">نصب</a>
            </td>
            <td>42,000,000 تومان</td>
            <td>
              <a class="badge badge-primary" href="{{route('orders.edit',['id' => 1])}}">درگاه بانکی</a>
            </td>
            <td class="text-end">
              <a href="{{route('orders.edit',['id' => 1])}}" class="btn btn-light btn-sm">
                مشاهده
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    <!--end::Group actions-->

    <ul class="pagination">
      <li class="page-item previous disabled"><a href="#" class="page-link"><i class="previous"></i></a></li>
      <li class="page-item active"><a href="#" class="page-link">1</a></li>
      <li class="page-item"><a href="#" class="page-link">2</a></li>
      <li class="page-item "><a href="#" class="page-link">3</a></li>
      <li class="page-item "><a href="#" class="page-link">4</a></li>
      <li class="page-item "><a href="#" class="page-link">5</a></li>
      <li class="page-item "><a href="#" class="page-link">6</a></li>
      <li class="page-item next"><a href="#" class="page-link"><i class="next"></i></a></li>
    </ul>
  </div>
</div>
<!-- END:TABLE -->

<div class="modal fade" id="add_service_modal" tabindex="-1" aria-labelledby="add_service_modal_label" aria-hidden="true" data-bs-focus="false">
  <div class="modal-dialog">
    <form class="modal-content" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">افزودن خدمت برای سفارش</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <x-advanced-search type="orders" label="شماره سفارش" name="order" solid />
        <div class="mt-5">
          <label for="" class="form-label">انتخاب نوع خدمت</label>
          <select name="service" id="" class="form-control form-control-solid" data-control="select2">
            <option value="">دوخت</option>
            <option value="">طراحی طرح</option>
            <option value="">نصب</option>
          </select>
        </div>
        <p class="mt-5 text-success fs-7">محاسبه قیمت به طور خودکار انجام میشود</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
        <button type="submit" class="btn btn-primary">افزودن</button>
      </div>
    </form>
  </div>
</div>
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
