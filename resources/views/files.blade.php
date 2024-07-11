@extends('layouts.primary')

@section('title', 'مدیریت فایل ها')

@extends('layouts.primary')

@section('title', 'مدیریت فایل ها')

@section('css-before')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('content')
<div id="fm" style="height: 600px;"></div>
<div class="input-group">
    <input type="text" id="image_label" class="form-control" name="image" aria-label="Image" aria-describedby="button-image">
    <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="button-image">Select</button>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var fmDiv = document.getElementById('fm');
        fmDiv.innerHTML = '<iframe src="/file-manager/fm-button" style="width: 100%; height: 100%; border: none;"></iframe>';

    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById('button-image').addEventListener('click', (event) => {
            event.preventDefault();

            window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
        });
    });

</script>
@endsection
