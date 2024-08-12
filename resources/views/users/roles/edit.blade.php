@extends('layouts.primary')

@section('title', 'ویرایش نقش')

@section('content')

<form action="{{ route('users.roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">اطلاعات نقش</h4>
                </div>
                <div class="card-body">
                    <div class="form-group col-6">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $role->title) }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-6 mt-2">
                        <label for="display_name" class="required form-label">نام نمایشی</label>
                        <input name="display_name" id="display_name" class="form-control" value="{{ old('display_name', $role->display_name) }}">
                        @error('display_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">دسترسی‌ها</h4>
                </div>

                <div class="card-body">
                    @foreach($permissions as $permission)
                        @php
                            $currentAccess = $role->permissions->find($permission->id)->pivot ?? null;
                            $readOwn = $currentAccess && $currentAccess->read_own;
                            $readSameRole = $currentAccess && $currentAccess->read_same_role;
                            $readAll = $currentAccess && $currentAccess->read_all;
                            $writeOwn = $currentAccess && $currentAccess->write_own;
                            $writeSameRole = $currentAccess && $currentAccess->write_same_role;
                            $writeAll = $currentAccess && $currentAccess->write_all;
                        @endphp
                        <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                            <div class="col">
                                <label class="form-label">{{ $permission->title }}</label>
                            </div>
                            <div class="col-12">
                                <div class="form-check m-5">
                                    <input type="checkbox" name="access_code[{{ $permission->id }}][read_own]" class="form-check-input" id="read_own-{{ $permission->id }}" value="1" {{ $readOwn ? 'checked' : '' }}>
                                    <label class="form-check-label" for="read_own-{{ $permission->id }}">خواندن فقط خود</label>
                                </div>
                                <div class="form-check m-5">
                                    <input type="checkbox" name="access_code[{{ $permission->id }}][read_same_role]" class="form-check-input" id="read_same_role-{{ $permission->id }}" value="1" {{ $readSameRole ? 'checked' : '' }}>
                                    <label class="form-check-label" for="read_same_role-{{ $permission->id }}">خواندن نقش مشابه</label>
                                </div>
                                <div class="form-check m-5">
                                    <input type="checkbox" name="access_code[{{ $permission->id }}][read_all]" class="form-check-input" id="read_all-{{ $permission->id }}" value="1" {{ $readAll ? 'checked' : '' }}>
                                    <label class="form-check-label" for="read_all-{{ $permission->id }}">خواندن همه</label>
                                </div>
                                <div class="form-check m-5">
                                    <input type="checkbox" name="access_code[{{ $permission->id }}][write_own]" class="form-check-input" id="write_own-{{ $permission->id }}" value="1" {{ $writeOwn ? 'checked' : '' }}>
                                    <label class="form-check-label" for="write_own-{{ $permission->id }}">نوشتن فقط خود</label>
                                </div>
                                <div class="form-check m-5">
                                    <input type="checkbox" name="access_code[{{ $permission->id }}][write_same_role]" class="form-check-input" id="write_same_role-{{ $permission->id }}" value="1" {{ $writeSameRole ? 'checked' : '' }}>
                                    <label class="form-check-label" for="write_same_role-{{ $permission->id }}">نوشتن نقش مشابه</label>
                                </div>
                                <div class="form-check m-5">
                                    <input type="checkbox" name="access_code[{{ $permission->id }}][write_all]" class="form-check-input" id="write_all-{{ $permission->id }}" value="1" {{ $writeAll ? 'checked' : '' }}>
                                    <label class="form-check-label" for="write_all-{{ $permission->id }}">نوشتن همه</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-2">ذخیره تغییرات</button>

</form>

@endsection
