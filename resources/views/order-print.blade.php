@extends('layouts.free')

@section('title', '')

@section('content')
<style>
    .container {
        min-height: 100%;
    }

    .header-item-wrapper {
        border: 1px solid #000;
        width: 100%;
        height: 100%;
        background: #eee;
        display: flex;
        align-content: center;
    }

    .header-table td {
        padding: 0;
        vertical-align: top;
    }

    .header-table {
        table-layout: fixed;
        border-spacing: 0;
    }

    .portait {
        transform: rotate(-90deg) translate(0, 40%);
        text-align: center;
    }

    thead,
    tfoot {
        background: #eee;
    }

    .content-table td,
    th {
        border: 1px solid #000;
        text-align: center;
        padding: 0.1cm;
        font-weight: normal;
    }

    .font-small {
        font-size: 8pt;
    }

    .grow {
        width: 100%;
        height: 100%;
    }

    .bordered {
        border: 1px solid #000;
        padding: 0.12cm;
    }

    .flex {
        display: flex;
    }

    .flex-grow {
        flex-grow: 10000000;
    }

    .flex>* {
        float: left;
    }

    .font-medium {
        font-size: 10pt;
    }

    h3 {
        font-size: 16px;
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
        color: #000;
        opacity: 0.6;
    }

    @page {
        size: landscape;
        padding: 0;
        margin: 0;
    }

    table {
        width: 1700px;
    }

    @media screen and (min-width: 992px) {
        table {
            width: 100%;
        }
    }

    @media print {

        body,
        .container {
            max-width: 100vw;
            max-height: 100vh;
            break-inside: avoid;
        }

        * {
            font-size: 7pt;
        }

        table {
            width: 100%;
        }

        .font-medium {
            font-size: 7pt;
        }

        .firsttitle {
            display: none !important;
        }
    }
</style>
<div class="container">
    <div class="tw-flex tw-items-center tw-justify-between firsttitle tw-mb-6">
        <h1 class="">صورت حساب</h1>
        <button class="tw-px-4 tw-py-2 tw-bg-brand-500 tw-text-base tw-outline-none tw-border-none tw-text-white tw-rounded-xl" onclick="print()">پرینت</button>
    </div>
    <div class="page">
        <table class="header-table">
            <tbody>
                <tr>
                    <td style="width: 1.8cm; height: 2.5cm;vertical-align: middle;padding-bottom: 4px;">
                        <div class="header-item-wrapper">
                            <div class="portait" style="margin:5px">حق‌العمل کار</div>
                        </div>
                    </td>
                    <td style="padding: 0 4px 4px;height: 2cm;">
                        <div class="bordered grow header-item-data">
                            <table class="grow centered">
                                <tbody>
                                    <tr>
                                        <td style="width: 7cm">
                                            <span class="label">فروشنده:</span> شركت نوآوران فن‌آوازه (سهامی خاص)
                                        </td>
                                        <td style="width: 5cm">
                                            <span class="label">شناسه ملی:</span> ۱۰۳۲۰۸۴۵۸۵۷
                                        </td>
                                        <td>
                                            <span class="label">شماره ثبت:</span> ۴۳۳۸۴۵
                                        </td>
                                        <td>
                                            <span class="label">شماره اقتصادی:</span> ۴۱۱۴۱۹۱۳۶۵۱۱
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span class="label">نشانی شرکت:</span>تهران - گاندی جنوبی - نبش خیابان بیست و
                                            یکم - پلاک ۲۸
                                        </td>
                                        <td>
                                            <span class="label">کدپستی:</span> ۱۵۱۷۸۶۳۳۳۲
                                        </td>
                                        <td>
                                            <span class="label">تلفن و فکس:</span> ۰۲۱۶۱۹۳۰۰۰۰
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td style="width: 7cm; height: 2cm; padding: 0 4px 4px 0;">
                        <div class="bordered" style="text-align: center; height: 100%; padding: 0.4cm 0.2cm;">
                            <div class="flex">
                                <div class="font-small">شماره فاکتور:</div>
                                <div class="flex-grow" style="text-align: left">۲۱۹۵۶۳۸۸</div>
                            </div>
                            <div class="flex">
                                <div>تاریخ:</div>
                                <div class="flex-grow" style="text-align: left">۱۴۰۱/۱۲/۰۷</div>
                            </div>
                            <div class="flex" style="margin-bottom: 4px;">
                                <div>پیگیری:</div>
                                <div class="flex-grow font-medium" style="text-align: left">۱۹۲۳۳۷۴۰۴</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 1.8cm; height: 2cm;vertical-align: center; padding: 0 0 4px">
                        <div class="header-item-wrapper">
                            <div class="portait" style="margin: 20px">خریدار</div>
                        </div>
                    </td>
                    <td style="height: 2cm;vertical-align: center; padding: 0 4px 4px">
                        <div class="bordered header-item-data tw-h-full">
                            <table style="height: 100%" class="centered">
                                <tbody>
                                    <tr>
                                        <td style="width: 6.7cm">
                                            <span class="label">خریدار:</span> فرهاد باقری
                                        </td>
                                        <td style="width: 6.7cm">
                                            <span class="label">شماره‌اقتصادی / شماره‌ملی:</span> ۲۲۸۳۶۷۹۰۲۸
                                        </td>
                                        <td>
                                            <span class="label">شناسه ملی:</span> ۲۲۸۳۶۷۹۰۲۸
                                        </td>
                                        <td>
                                            <span class="label">شماره ثبت:</span> -
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <span class="label">نشانی:</span> شیراز - صدرا - فاز ۲ - بلوار ارتش - خیابان نیما - کوچه ۸ - پلاک ۵۹۶, پلاک ۵۹۶
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <span class="label">شماره تماس:</span>
                                        </td>
                                        <td colspan="2">
                                            <span class="label">کد پستی:</span> ۷۱۹۹۶۶۵۶۶۷
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td style="width: 7cm;padding: 0 4px 4px 0;height: 100%;">
                        <div class="bordered" style="text-align: center; height: 100%;height:100%">
                            <div class="flex" style="margin-bottom: 4px;">
                                <div>شماره مالیاتی:</div>
                                <div class="flex-grow font-medium" style="text-align: left">A۱۱RFO۰۴BD۶۰۰۰۱۴F۰۷۲۴۱</div>
                            </div>
                            <div class="flex" style="margin-bottom: 4px;">
                                <div>سریال حافظه مالیاتی:</div>
                                <div class="flex-grow font-medium" style="text-align: left">S۰۵۴۰۰۱۰۰۰۰۰۰۱۰۰</div>
                            </div>
                            <div class="flex" style="margin-bottom: 4px;">
                                <div>سریال پایانه فروشگاهی:</div>
                                <div class="flex-grow font-medium" style="text-align: left">A۰۵۴۰۰۱۰۰۰۰۰۰۱۹۰</div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="content-table">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>شناسه کالا یا خدمت</th>
                    <th style="width:30%">شرح کالا یا خدمت</th>
                    <th>تعداد</th>
                    <th style="width: 2.3cm;">مبلغ واحد (ریال)</th>
                    <th style="width: 2.3cm;">مبلغ کل (ریال)</th>
                    <th style="width: 2.3cm;">تخفیف (ریال)</th>
                    <th style="width: 2.3cm;">مبلغ کل پس از تخفیف (ریال)</th>
                    <th style="width: 2.3cm;"> جمع مالیات و عوارض ارزش افزوده (ریال)</th>
                    <th style="width: 2.3cm;"> جمع کل پس از تخفیف و مالیات و عوارض (ریال)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>۱</td>
                    <td>۳۲۱۳۴۰۲۲</td>
                    <td>
                        <div class="title">پرده زبرا طرح مخملی | رنگ نقره ای</div>
                        <div class="serials">0FA5F8E9</div>
                    </td>
                    <td><span class="ltr">۱</span></td>
                    <td><span class="ltr">
                            ۶۲,۹۰۰,۰۰۰
                        </span></td>

                    <td><span class="ltr">
                            ۶۲,۹۰۰,۰۰۰
                        </span></td>

                    <td><span class="ltr">
                            ۰
                        </span></td>

                    <td><span class="ltr">
                            ۶۲,۹۰۰,۰۰۰
                        </span></td>

                    <td><span class="ltr">
                            ۰
                        </span></td>

                    <td><span class="ltr">
                            ۶۲,۹۰۰,۰۰۰
                        </span></td>

                </tr>
                <tr>
                    <td>۲</td>
                    <td>۲۵۴۲۹۲۰۷</td>
                    <td>
                        <div class="title">رو تختی بچگانه | طرح اسپایدرمن</div>
                        <div class="serials">90935C41</div>
                    </td>
                    <td><span class="ltr">۱</span></td>
                    <td><span class="ltr">
                            ۳,۲۸۰,۰۰۰
                        </span></td>

                    <td><span class="ltr">
                            ۳,۲۸۰,۰۰۰
                        </span></td>

                    <td><span class="ltr">
                            ۰
                        </span></td>

                    <td><span class="ltr">
                            ۳,۲۸۰,۰۰۰
                        </span></td>

                    <td><span class="ltr">
                            ۰
                        </span></td>

                    <td><span class="ltr">
                            ۳,۲۸۰,۰۰۰
                        </span></td>

                </tr>

                <tr>
                    <td colspan="3">
                        <b>جمع کل</b>
                    </td>
                    <td>۲</td>
                    <td><span class="ltr">۶۶,۱۸۰,۰۰۰</span></td>
                    <td><span class="ltr">۶۶,۱۸۰,۰۰۰</span></td>
                    <td>
                        <span class="ltr">۰</span>
                    </td>
                    <td>
                        <span class="ltr">
                            ۶۶,۱۸۰,۰۰۰
                        </span>
                    </td>
                    <td><span class="ltr">۰</span></td>
                    <td>
                        <span class="ltr">
                            ۶۶,۱۸۰,۰۰۰
                        </span>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                    </td>
                    <td colspan="3" class="font-small">
                        جمع کل پس از کسر تخفیف با احتساب مالیات و عوارض (ریال):
                    </td>

                    <td><span class="ltr">
                            ۶۶,۱۸۰,۰۰۰
                        </span></td>
                </tr>
                <tr>
                    <td colspan="4">
                        اعتبار مالیاتی قابل استفاده توسط خریدار
                    </td>
                    <td colspan="7" class="font-small">
                    </td>
                </tr>
                <tr style="background: #fff">
                    <td colspan="11" style="height: 2.5cm;vertical-align: top">
                        <div class="flex">
                            <div class="flex-grow">مهر و امضای فروشنده:</div>
                            <div class="flex-grow">تاریخ تحویل:</div>
                            <div class="flex-grow">ساعت تحویل:</div>

                            <div class="flex-grow">روش‌های پرداخت:</div>

                            <div class="flex-grow">مهر و امضای خریدار:</div>

                            <div class="flex-grow" style="width: 1.8cm"></div>
                        </div>
                        <div class="flex">
                            <div class="flex-grow">
                                <img class="footer-img uk-align-center" width="150px" src="https://api.digikala.com/static/files/acb0d08c.jpg">
                            </div>
                            <div class="flex-grow">۹ اسفند ۱۴۰۱</div>
                            <div class="flex-grow">۹ -
                                ۲۲</div>

                            <div class="flex-grow">
                                <ul>
                                    <li style="text-align: right">
                                        اعتباری : ۶۶,۱۸۰,۰۰۰
                                    </li>
                                </ul>
                            </div>
                            <div class="flex-grow"></div>

                            <div style="display: flex; align-items: center; justify-content: center; margin-top: 4px; margin-left: 10px;">
                                <img class="footer-img uk-align-center" style="width: 1.5cm; margin-left: 4px;" src="https://api.digikala.com/static/files/40417d6f.jpg">
                            </div>
                        </div>
                        <h3> به هنگام ارسال در سامانه معاملات فصلی ( ماده 169 مکرر) گزینه خرید از طریق حق العمل کار را انتخاب کنید
                        </h3>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection