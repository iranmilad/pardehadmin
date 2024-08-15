@extends('layouts.primary')

@section('title', 'CSS سفارشی')

@section('content')

<form action="">
    @csrf
    <div class="card" x-data="{ showAdvancedSearch: true }">
        <div class="card-body">
            <div class="row tw-items-center mb-5">
                <div class="col-12 col-md-6 col-lg">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                            x-model="showAdvancedSearch">
                        <label class="form-check-label" for="flexCheckDefault">
                            اجرا در تمام سایت
                        </label>
                    </div>
                </div>
            </div>

            <!-- Advanced Search Section -->
            <div class="row mb-5" x-show="!showAdvancedSearch">
                <div class="col-12 col-md-6 col-lg mb-4">
                    <x-advanced-search type="page" name="page" label="انتخاب صفحه" solid />
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label">ویرایشگر کد</label>
                <input type="hidden" name="code" id="code">
                <div id="code-editor" style="height: 300px"></div>
            </div>
        </div>
    </div>

    <button class="btn btn-success tw-w-max tw-mt-10" type="submit">ذخیره</button>

</form>

@endsection
@section('script-before')
<script src="{{ asset('/js/ace.js') }}"></script>
<script src="{{ asset('/js/theme-clouds.js') }}"></script>
<script src="{{ asset('/js/mode-css.js') }}"></script>
@endsection

@section('scripts')
<script>
    var editor = ace.edit("code-editor");
    editor.setTheme("ace/theme/clouds");
    // editor change
    editor.getSession().on('change', function() {
        var code = editor.getValue();
        $("#code").val(code);
    });
</script>
@endsection