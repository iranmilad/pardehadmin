{{-- resources/views/users/roles/edit.blade.php --}}

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
                        <div class="row tw-justify-between tw-items-center tw-border-b tw-border-0 tw-border-gray-200 tw-border-solid py-5">
                            <div class="col">
                                <label for="permission-{{ $permission->id }}" class="form-label">{{ $permission->title }}</label>
                            </div>
                            <div class="col-2">
                                <select name="access_code[{{ $permission->id }}]" id="permission-{{ $permission->id }}" class="form-control">
                                    <option value="0" {{ isset($role->permissions->find($permission->id)->pivot->access_code) && $role->permissions->find($permission->id)->pivot->access_code == 0 ? 'selected' : '' }}>عدم دسترسی</option>
                                    <option value="1" {{ isset($role->permissions->find($permission->id)->pivot->access_code) && $role->permissions->find($permission->id)->pivot->access_code == 1 ? 'selected' : '' }}>خواندنی</option>
                                    <option value="2" {{ isset($role->permissions->find($permission->id)->pivot->access_code) && $role->permissions->find($permission->id)->pivot->access_code == 2 ? 'selected' : '' }}>خواندنی و نوشتنی</option>
                                </select>
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
