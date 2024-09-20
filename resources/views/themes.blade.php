@extends('layouts.primary')

@section('title', 'قالب ها')

@section('content')
<form action="">
    @csrf
    <div class="row g-5">
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card card-flush border-2 border-success tw-border-solid">
                <img class="card-img-top" src="https://files-de.rtl-theme.com/attachments/2023/07/e91ad7104c276488c9494d607fc12681b576edc1848211-590x300.jpg">
                <div class="card-body">
                    <h5 class="card-title">قالب هما</h5>
                    <div class="w-100 tw-flex tw-items-center tw-justify-between mt-7 tw-flex-row-reverse">
                        <button type="button" name="disable" id="1" class="btn btn-sm btn-danger">غیر فعال کردن</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card card-flush">
                <img class="card-img-top" src="https://media.rtlcdn.com/2024/08/a0c0b60309671848f1f559191d2c3c1a96a059513114fb-590x300.jpg">
                <div class="card-body">
                    <h5 class="card-title">قالب شماره 2</h5>
                    <div class="w-100 tw-flex tw-items-center tw-justify-between mt-7 tw-flex-row-reverse">

                        <button type="button" name="enable" id="2" class="btn btn-sm btn-success" disabled>فعال کردن</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card card-flush">
                <img class="card-img-top" src="https://media.rtlcdn.com/2024/07/0787ef27d4669e445d3a846636ccf2bcc2b7591dc116c-590x300.png">
                <div class="card-body">
                    <h5 class="card-title">قالب شماره 3</h5>
                    <div class="w-100 tw-flex tw-items-center tw-justify-between mt-7 tw-flex-row-reverse">

                        <button type="submit" name="enable" id="3" class="btn btn-sm btn-success" disabled>فعال کردن</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
