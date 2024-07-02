<div>
    <div class="row">
        @if (!empty($serviceDetails))
            @foreach ($selectedServicesType as $selectedService)
                @php
                    $serviceName = '';
                    switch ($selectedService) {
                        case 'sewing':
                            $serviceName = 'دوخت';
                            break;
                        case 'design':
                            $serviceName = 'طراحی';
                            break;
                        case 'installer':
                            $serviceName = 'نصب';
                            break;
                        default:
                            $serviceName = 'نامعلوم';
                            break;
                    }
                @endphp
                <h1>نوع سرویس: {{ $serviceName }}</h1>
                
            @endforeach

            @foreach ($serviceDetails as $index => $detail)
                <h1></h1>
                <div class="mb-5 col-xl-12">
                    <label for="holo_code_{{ $index }}" class="form-label">شناسه محصول</label>
                    <input type="text" wire:model.defer="serviceDetails.{{ $index }}.holo_code" class="form-control form-control-solid" id="holo_code_{{ $index }}">
                </div>
                <div class="mb-5 col-md-6">
                    <label for="normal_price_{{ $index }}" class="form-label">قیمت خدمت عادی :</label>
                    <input type="text" wire:model.defer="serviceDetails.{{ $index }}.normal_price" class="form-control form-control-solid" id="normal_price_{{ $index }}">
                </div>
                <div class="mb-5 col-md-6">
                    <label for="urgent_price_{{ $index }}" class="form-label">قیمت خدمت ویژه :</label>
                    <input type="text" wire:model.defer="serviceDetails.{{ $index }}.urgent_price" class="form-control form-control-solid" id="urgent_price_{{ $index }}">
                </div>
                <div class="mb-5 col-md-6">
                    <label for="sale_price_{{ $index }}" class="form-label">قیمت خدمت <b>اضطراری</b> :</label>
                    <input type="text" wire:model.defer="serviceDetails.{{ $index }}.sale_price" class="form-control form-control-solid" id="sale_price_{{ $index }}">
                </div>
                <div class="mb-5 col-md-6">
                    <label for="normal_duration_{{ $index }}" class="form-label">زمان انجام عادی :</label>
                    <div class="input-group">
                        <input dir="ltr" name="normal_duration_{{ $index }}" type="number" wire:model.defer="serviceDetails.{{ $index }}.normal_duration" class="form-control form-control-solid mb-2 mb-md-0" placeholder="زمان مورد نیاز را وارد کنید" />
                        <span class="input-group-text bg-white ms-0">ساعت</span>
                    </div>
                </div>
                <div class="mb-5 col-md-6">
                    <label for="urgent_duration_{{ $index }}" class="form-label">زمان انجام <b>اضطراری</b> :</label>
                    <div class="input-group">
                        <input dir="ltr" name="urgent_duration_{{ $index }}" type="number" wire:model.defer="serviceDetails.{{ $index }}.urgent_duration" class="form-control form-control-solid mb-2 mb-md-0" placeholder="زمان مورد نیاز را وارد کنید" />
                        <span class="input-group-text bg-white ms-0">ساعت</span>
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                <button type="button" wire:click="save" class="btn btn-primary">ذخیره</button>
            </div>

            {{-- نمایش پیام فلش --}}
            @if (session()->has('message'))
                <div class="alert alert-success mt-4">
                    {{ session('message') }}
                </div>
            @endif

        @else
            {{-- نمایش فرم انتخاب سرویس --}}
            <div class="col-md-6">
                <label class="form-label">انتخاب سرویس:</label>
                <select wire:model="selectedServiceType" class="form-control">
                    <option value="">انتخاب کنید</option>
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('sewing'))
                        <option value="sewing">دوخت</option>
                    @endif
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('design'))
                        <option value="design">طراحی</option>
                    @endif
                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('installer'))
                        <option value="installer">نصب</option>
                    @endif
                </select>
            </div>
            <div class="col-md-6 mt-8">
                <button type="button" wire:click="createService" class="btn btn-primary">ایجاد سرویس جدید</button>
            </div>
        @endif
    </div>
</div>
