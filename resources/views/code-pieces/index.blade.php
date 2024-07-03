<!-- resources/views/code-pieces/index.blade.php -->

@extends('layouts.primary')

@section('title', 'قطعه کد ها')

@section("toolbar")
    <a href="{{ route('code-piceces.create') }}" class="btn btn-primary">قطعه کد جدید</a>
@endsection

@section('content')
    <!-- START:TABLE -->
    <div class="card">
        <div class="card-body">
            <!-- Your table code here -->
            <table id="snippets_table" class="table gy-5 gs-7">
                <thead>
                    <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                        <th class="w-10px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#snippets_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="cursor-pointer px-0 text-start">عنوان</th>
                        <th class="cursor-pointer px-0 text-start">جایگذاری</th>
                        <th class="cursor-pointer px-0 text-start">اولویت</th>
                        <th class="min-w-100px text-end">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codePieces as $codePiece)
                        <tr>
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="checked_row" value="{{ $codePiece->id }}" />
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('code-piceces.edit', ['id' => $codePiece->id]) }}" class="text-gray-800 text-hover-primary fs-6 fw-bolder mb-1">{{ $codePiece->title }}</a>
                            </td>
                            <td>
                                <a class="badge badge-dark" href="#">{{ $codePiece->placement }}</a>
                            </td>
                            <td>
                                <span>{{ $codePiece->priority }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('code-piceces.edit', ['id' => $codePiece->id]) }}" class="btn btn-light btn-sm">ویرایش</a>
                                <!-- Add delete button with form submission -->
                                <form action="{{ route('code-piceces.delete') }}" method="post" style="display: inline-block;">
                                    @csrf
                                    <input type="hidden" name="ids[]" value="{{ $codePiece->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END:TABLE -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#snippets_table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // You can customize DataTable options as needed
            });
        });
    </script>
@endsection
