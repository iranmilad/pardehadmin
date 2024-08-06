@extends('layouts.primary')

@section('title', 'گزارش فرآیند 1242')


@section('content')
<div class="leader_container">
    <div class="leader_box" id="box1">
        <span>عنوان 1</span>
        <div class="leader_top-dots">
            <div class="leader_dot-container" data-dot="1" data-box="box1">
                <div class="leader_dot-text">نقطه 1</div>
                <div class="leader_dot"></div>
            </div>
            <div class="leader_dot-container" data-dot="2" data-box="box1">
                <div class="leader_dot-text">نقطه 2</div>
                <div class="leader_dot"></div>
            </div>
            <div class="leader_dot-container" data-dot="3" data-box="box1">
                <div class="leader_dot-text">نقطه 3</div>
                <div class="leader_dot"></div>
            </div>
        </div>
    </div>
    <div class="leader_box" id="box2">
        <span>عنوان 2</span>
        <div class="leader_bottom-dots">
            <div class="leader_dot-container" data-dot="1" data-box="box2">
                <div class="leader_dot"></div>
                <div class="leader_dot-text">نقطه 1</div>
            </div>
            <div class="leader_dot-container" data-dot="2" data-box="box2">
                <div class="leader_dot"></div>
                <div class="leader_dot-text">نقطه 2</div>
            </div>
            <div class="leader_dot-container" data-dot="3" data-box="box2">
                <div class="leader_dot"></div>
                <div class="leader_dot-text">نقطه 3</div>
            </div>
        </div>
        <div class="leader_top-dots">
            <div class="leader_dot-container" data-dot="1" data-box="box2">
                <div class="leader_dot-text">نقطه 1</div>
                <div class="leader_dot"></div>
            </div>
            <div class="leader_dot-container" data-dot="2" data-box="box2">
                <div class="leader_dot-text">نقطه 2</div>
                <div class="leader_dot"></div>
            </div>
            <div class="leader_dot-container" data-dot="3" data-box="box2">
                <div class="leader_dot-text">نقطه 3</div>
                <div class="leader_dot"></div>
            </div>
        </div>
    </div>
    <div class="leader_box" id="box3">
        <span>عنوان 3</span>
        <div class="leader_bottom-dots">
            <div class="leader_dot-container" data-dot="1" data-box="box3">
                <div class="leader_dot"></div>
                <div class="leader_dot-text">نقطه 1</div>
            </div>
            <div class="leader_dot-container" data-dot="2" data-box="box3">
                <div class="leader_dot"></div>
                <div class="leader_dot-text">نقطه 2</div>
            </div>
            <div class="leader_dot-container" data-dot="3" data-box="box3">
                <div class="leader_dot"></div>
                <div class="leader_dot-text">نقطه 3</div>
            </div>
        </div>
    </div>
</div>
<div class="card mt-10">
    <div class="card-header">
        <h4 class="card-title">لیست عملیات و شرط های اجرای شده</h4>
    </div>
    <div class="card-body">
        <div class="tw-flex tw-items-start tw-gap-4 bg-light p-2 mb-4">
            <div>
                <button class="btn btn-icon btn-sm btn-clear btn-success d-none d-md-block">
                    <i class="fa-regular fa-circle-dashed fs-6"></i>
                </button>
            </div>
            <div>
                <h5>ثبت نام کاربر</h5>
                <span>24/12/1403 12:59</span>
            </div>
        </div>
        <div class="tw-flex tw-items-start tw-gap-4 bg-light p-2 mb-4">
            <div>
                <button class="btn btn-icon btn-sm btn-clear btn-danger d-none d-md-block">
                    <i class="fa-regular fa-circle-dashed fs-6"></i>
                </button>
            </div>
            <div>
                <h5>ارسال کد تایید به کاربر</h5>
                <span>24/12/1403 12:59</span>
            </div>
        </div>
        <div class="tw-flex tw-items-start tw-gap-4 bg-light p-2 mb-4">
            <div>
                <button class="btn btn-icon btn-sm btn-clear btn-warning d-none d-md-block">
                    <i class="fa-regular fa-circle-dashed fs-6"></i>
                </button>
            </div>
            <div>
                <h5>پرداخت با کارت بانکی</h5>
                <span>24/12/1403 12:59</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-before')
<script src="{{asset('plugins/leader-line.min.js')}}"></script>
@endsection

@section("scripts")
<script>
function connectDots() {
    const dots = document.querySelectorAll('[data-dot]');
    const dotGroups = {};

    dots.forEach(dot => {
        const dotId = dot.getAttribute('data-dot');
        if (!dotGroups[dotId]) {
            dotGroups[dotId] = [];
        }
        dotGroups[dotId].push(dot);
    });

    Object.values(dotGroups).forEach(group => {
        for (let i = 0; i < group.length - 1; i++) {
            const currentBox = group[i].getAttribute('data-box');
            const nextBox = group[i + 1].getAttribute('data-box');

            if (currentBox !== nextBox) {
                new LeaderLine(
                    group[i].querySelector('.leader_dot'),
                    group[i + 1].querySelector('.leader_dot'),
                    {
                        startPlug: 'behind',
                        endPlug: 'arrow1',
                        color: '#047857',
                    }
                );
            }
        }
    });
}

connectDots();

</script>

@endsection