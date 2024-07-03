@extends('layouts.primary')

@section('title', 'ویرایش قطعه کد')

@section('content')
<form method="post" action="{{ route('code-piceces.update', ['id' => $codePiece->id]) }}" class="row post-type-row">
    @csrf
    @method('PUT')
    <div class="col-lg-8 col-xl-10">
        <div class="card">
            <div class="card-body">
                <div class="row mb-10">
                    <div class="col-6">
                        <label for="title" class="required form-label">عنوان</label>
                        <input type="text" id="title" name="title" class="form-control" placeholder="عنوان را وارد کنید" value="{{ old('title', $codePiece->title) }}" />
                    </div>
                    <div class="col-6">
                        <label for="url" class="form-label">فقط صفحه خاص (خالی برای همه صفحات)</label>
                        <input type="url" id="url" name="url" class="form-control" placeholder="ادرس صفحه را وارد کنید" value="{{ old('url', $codePiece->url) }}" />
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-6">
                        <div class="">
                            <label for="placement" class="form-label">مکان قرارگیری</label>
                            <select name="placement" id="placement" class="form-control">
                                <option value="header_start" {{ $codePiece->placement === 'header_start' ? 'selected' : '' }}>ابتدای هدر</option>
                                <option value="header_end" {{ $codePiece->placement === 'header_end' ? 'selected' : '' }}>انتهای هدر</option>
                                <option value="body_start" {{ $codePiece->placement === 'body_start' ? 'selected' : '' }}>ابتدای بدنه</option>
                                <option value="body_end" {{ $codePiece->placement === 'body_end' ? 'selected' : '' }}>انتهای بدنه</option>
                                <option value="footer_start" {{ $codePiece->placement === 'footer_start' ? 'selected' : '' }}>ابتدای فوتر</option>
                                <option value="footer_end" {{ $codePiece->placement === 'footer_end' ? 'selected' : '' }}>انتهای فوتر</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="priority" class="form-label">اولویت</label>
                        <input type="number" id="priority" name="priority" class="form-control" placeholder="اولویت را وارد کنید" value="{{ old('priority', $codePiece->priority) }}" />
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label">ویرایشگر کد</label>
                    <input type="hidden" name="code" id="code" value="{{ old('code', $codePiece->code) }}">
                    <div id="code-editor" style="height: 300px">{{ old('code', $codePiece->code) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xl-2 mt-5 mt-lg-0">
        <!-- START:STATUS -->
        <div class="card card-flush py-4 mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h4>وضعیت</h4>
                </div>
            </div>
            <div class="card-body pt-0">
                <select name="status" class="form-select mb-2">
                    <option value="published" {{ $codePiece->status === 'published' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ $codePiece->status === 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                </select>
                <div class="text-muted fs-7">وضعیت قطعه کد را تنظیم کنید.</div>
            </div>
            <div class="card-footer text-end">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                    <button type="submit" class="btn btn-sm btn-success">ذخیره تغییرات</button>
                </div>
            </div>
        </div>
        <!-- END:STATUS -->
    </div>
</form>
@endsection

@section('script-before')
<script src="{{ asset('js/ace.js') }}"></script>
<script src="{{ asset('js/theme-clouds.js') }}"></script>
@endsection

@section('scripts')
<script>
    var editor = ace.edit("code-editor");
    editor.setTheme("ace/theme/clouds");
    editor.getSession().on('change', function() {
        var code = editor.getValue();
        $("#code").val(code);
    });
</script>
@endsection
