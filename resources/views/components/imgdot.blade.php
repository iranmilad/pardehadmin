<div class="tw-flex tw-items-start">
    <div class="tw-relative">
        <img class="tw-w-28 tw-h-28 tw-rounded-xl" src={{ asset($img) }} alt="عکس محصول" />
        @if(isset($discount))
        <span class="tw-absolute -tw-top-2 -tw-left-2 tw-w-max tw-rounded-md tw-text-white  tw-px-1 tw-bg-red-500">
            {{$discount ?? ''}}
        </span>
        @endif
    </div>
    <div class="tw-mr-5">
        <h5 class="tw-font-bold tw-text-lg tw-text-gray-800">
            {{$name ?? ''}}
        </h5>
        <div class="tw-flex tw-flex-col tw-items-start tw-space-y-1">
            <span class="{{ $discount ? 'tw-line-through tw-text-sm tw-text-gray-500' : 'tw-text-gray-800 tw-text-lg tw-font-bold' }}">
                {{$price ?? ''}} تومان
            </span>
            @if(isset($discounted_price))
            <span class="tw-text-gray-800 tw-text-lg tw-font-bold">
                {{$discounted_price}} تومان
            </span>
            @endif
            {{-- <span class="tw-text-xs tw-text-gray-500">
                <i class="fa-solid fa-star text-warning tw-ml-2"></i>
                4 امتیاز
            </span> --}}
        </div>
    </div>
</div>
