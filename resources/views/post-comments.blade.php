@extends('layouts.primary')

@section('title', 'دیدگاه‌ها')

@section('content')
<!-- START:TABLE -->
<div class="card">
    <div class="card-body">
        <form class="d-flex align-items-center justify-content-end" action="" method="get">
            @csrf
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span class="path2"></span></i>
                <input name="s" value="{{ request()->get('s') ?? '' }}" type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="جست و جو" />
            </div>
        </form>
        <form method="post" action="{{ route('comments.bulk_action') }}" id="action_form">
            @csrf
            <div class="d-flex tw-items-center tw-justify-start tw-w-full gap-4 mb-3">
                <select class="form-select form-select-solid tw-w-max" name="action" id="bulk_action">
                    <option>عملیات</option>
                    <option value="delete">حذف</option>
                </select>
                <button class="btn btn-primary" type="submit">اجرا</button>
            </div>

            <table id="comments_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#comments_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">نویسنده</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">نوشته</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">تاریخ ثبت</th>
                        <th class="cursor-pointer px-0 min-w-175px text-start">وضعیت</th> <!-- ستون جدید برای وضعیت -->
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="checked_rows[]" value="{{ $comment->id }}" />
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('comments.edit', ['id' => $comment->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $comment->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('post.edit', ['id' => $comment->post_id]) }}">{{ $comment->post->title }}</a>
                        </td>
                        <td>
                            <span>{{ $comment->dateShamsi }}</span>
                        </td>
                        <td>
                            @if ($comment->status == "pendding")
                                <span class="badge bg-warning text-dark">در انتظار انتشار</span>
                            @elseif ($comment->status == "approved")
                                <span class="badge bg-success">منتشر شده</span>
                            @elseif ($comment->status == "rejected")
                                <span class="badge bg-danger">رد شده</span>
                            @else
                                <span class="badge bg-secondary">نامشخص</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-info btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                                عملیات
                                <span class="svg-icon fs-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) rotate(-180.000000) translate(-12.000003, -11.999999)"></path>
                                        </g>
                                    </svg>
                                </span>
                            </a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-info fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#replyModal" data-id="{{ $comment->id }}" data-bs-whatever="{{ $comment->name }}" class="nav-link menu-link px-3">
                                        پاسخ
                                    </button>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('comments.approve', $comment->id) }}" class="menu-link px-3">تایید کردن</a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('comments.reject', $comment->id) }}" class="menu-link px-3">رد کردن</a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('comments.edit', ['id' => $comment->id]) }}" class="menu-link px-3">
                                        ویرایش
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-primary">
                                        حذف
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <!--end::Group actions-->

        {{ $comments->links('vendor.pagination.custom-pagination') }}
    </div>
</div>
<!-- END:TABLE -->

<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="post" action="{{ route('comments.reply') }}">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">پاسخ به</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">پیام :</label>
                    <textarea class="form-control form-control-solid" id="message-text" rows="8" name="message"></textarea>
                </div>
                <input type="hidden" name="comment_id" id="comment-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">ارسال</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script-before')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const exampleModal = document.getElementById('replyModal');
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const recipient = button.getAttribute('data-bs-whatever');
                const commentId = button.getAttribute('data-id');

                const modalTitle = exampleModal.querySelector('.modal-title');
                const modalBodyInput = exampleModal.querySelector('.modal-body input[name="comment_id"]');

                modalTitle.textContent = `پاسخ به ${recipient}`;
                modalBodyInput.value = commentId;
            });
        }
    });
</script>
@endsection
