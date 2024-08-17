@extends('layouts.primary')

@section('title', 'CSS سفارشی')

@section('content')

<form action="">
    @csrf
    <div class="card" x-data="{ showAdvancedSearch: true }">
        <div class="card-body">

            <!-- Advanced Search Section -->
            <div class="row mb-5">
                <div class="col-12 col-md-6 col-lg mb-4">
                    <x-advanced-search type="page" name="select-product" label="انتخاب صفحه" solid />
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

    $("[name='select-product']").on('select2:select', function(e) {
        var data = e.params.data;
        $.ajax('/api/custom-css',{
            method: 'POST',
            success: (result)=>{
                editor.setValue(result.css)
                $("#code").val(result.css)
            }
        })
    });
</script>
@endsection