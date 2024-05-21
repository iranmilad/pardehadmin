<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;


class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


            $content= '<div class="destination-section section pt-0">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="about-images">
                                        <img class="rounded-0 w-100 blur-up lazyload" data-src="/images/about/about4.jpg"
                                            src="/images/about/about4.jpg" alt="درباره ما" width="700" height="600" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <div class="about-details faqs-style faqs-style2 px-50">
                                        <h2 class="fs-3 mb-3">ما خدمات مستمر و مهربانی را برای مشتریان ارائه می دهیم</h2>
                                        <p>تنوع‌های زیادی از قسمت‌های لورم اپیسوم در دسترس است، اما اکثریت آن‌ها به نوعی دچار تغییر
                                            شده‌اند، با طنز تزریقی یا کلمات تصادفی که حتی کمی باورپذیر به نظر نمی‌رسند. اگر می‌خواهید از
                                            قسمتی از لورم اپیسوم استفاده کنید، باید مطمئن شوید که هیچ چیز شرم‌آوری در وسط متن پنهان نشده
                                            باشد.</p>
                                        <div class="accordion" id="accordionFaq">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="false"
                                                        aria-controls="collapseOne">مشتری سرویس</button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                                    data-bs-parent="#accordionFaq">
                                                    <div class="accordion-body">
                                                        <p>لورم ایپسوم به سادگی متن ساختگی صنعت چاپ و حروفچینی است. لورم ایپسوم از دهه
                                                            1500 به عنوان متن ساختگی استاندارد صنعت بوده است، زمانی که یک چاپگر ناشناخته
                                                            یک گالری از نوع را برداشت و آن را به هم زد تا یک کتاب نمونه بسازد. این نه
                                                            تنها پنج قرن باقی مانده است.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">آنلاین مشاوره</button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                                    data-bs-parent="#accordionFaq">
                                                    <div class="accordion-body">
                                                        <p>تنوع‌های زیادی از قسمت‌های لورم اپیسوم در دسترس است، اما اکثریت آن‌ها به شکلی
                                                            دچار تغییر شده‌اند، با طنز تزریقی یا کلمات تصادفی که حتی کمی باورپذیر به نظر
                                                            نمی‌رسند. اگر می خواهید از یک پاساژ لورم اپیسوم استفاده کنید.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">فروش مدیریت</button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse"
                                                    aria-labelledby="headingThree" data-bs-parent="#accordionFaq">
                                                    <div class="accordion-body">
                                                        <p>بر خلاف تصور رایج، لورم اپیسوم یک متن تصادفی نیست. این ریشه در یک قطعه از
                                                            ادبیات کلاسیک لاتین مربوط به 45 قبل از میلاد دارد و قدمت آن را به بیش از
                                                            2000 سال می رساند. ریچارد مک کلینتاک، استاد لاتین در کالج همپدن-سیدنی در
                                                            ویرجینیا، یکی از مبهم‌ترین واژه‌های لاتین کشف‌شده را جستجو کرد.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- بخش بنر مقابله -->
                    <div class="destination-section section section-color-light">
                        <div class="container">
                            <div class="row row-cols-lg-4 row-cols-md-4 row-cols-sm-2 row-cols-2 g-4 text-center">
                                <div class="counteup-items">
                                    <i class="icon anm anm-history fs-3 mb-3"></i>
                                    <p class="counterup-number"><span class="counterup" data-count="50">50</span><span
                                            class="ms-1 text">M+</span></p>
                                    <h5 class="counteup-title">سالهای تاسیس</h5>
                                </div>
                                <div class="counteup-items">
                                    <i class="icon anm anm-users-r fs-3 mb-3"></i>
                                    <p class="counterup-number"><span class="counterup" data-count="100">100</span><span
                                            class="ms-1 text">B+</span></p>
                                    <h5 class="counteup-title">اعضای ماهر شرایط</h5>
                                </div>
                                <div class="counteup-items">
                                    <i class="icon anm anm-handshake-l fs-3 mb-3"></i>
                                    <p class="counterup-number"><span class="counterup" data-count="80">80</span><span
                                            class="ms-1 text">M+</span></p>
                                    <h5 class="counteup-title">مشتریان خوشحال</h5>
                                </div>
                                <div class="counteup-items">
                                    <i class="icon anm anm-bar-chart-o fs-3 mb-3"></i>
                                    <p class="counterup-number"><span class="counterup" data-count="70">70</span><span
                                            class="ms-1 text">B+</span></p>
                                    <h5 class="counteup-title">سفارشات ماهانه</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- پایان بخش بنر Counterup -->'
            ;

            // ایجاد چندین نمونه صفحه
            $user = User::first(); // شما ممکن است نیاز به یافتن یک کاربر داشته باشید

            Page::create([
                'title' => 'درباره ما',
                'slug' => 'درباره ما',
                'content' => $content,
                'user_id' => $user->id,
                'status' => 'published',
                'url' => '/about-us',
                'summary' => 'خلاصه درباره ما...',
                'keywords' => 'درباره ما, تاریخچه, ماهیت',
            ]);


            $content='
                <!-- فرم تماس - جزئیات -->
                <div class="contact-form-details section pt-0">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                            {{-- contact form --}}
                            <livewire:LoadWidget blockId="block_25" />
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            {{-- contact info --}}
                            <livewire:LoadWidget blockId="block_26" />
                        </div>
                    </div>
                </div>
                <!-- پایان فرم تماس - جزئیات -->

                <!-- نقشه تماس -->
                <div class="contact-maps section p-0">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            {{-- google map --}}
                            <livewire:LoadWidget blockId="block_27" />
                        </div>
                    </div>
                </div>
                <!-- پایان نقشه تماس -->
            ';

            Page::create([
                'title' => 'تماس با ما',
                'slug' => 'تماس با ما',
                'content' => $content,
                'user_id' => $user->id,
                'status' => 'published',
                'url' => '/contact',
                'summary' => 'خلاصه تماس با ما...',
                'keywords' => 'تماس با ما, اطلاعات تماس, فرم تماس',
            ]);


            $content='
                    <div class="destination-section section pt-0">
                    <div class="container">
                        <div class="row align-items-center">

                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="about-details faqs-style faqs-style2 px-50">
                                    <h2 class="fs-3 mb-3">ما خدمات مستمر و مهربانی را برای مشتریان ارائه می دهیم</h2>
                                    <p>تنوع‌های زیادی از قسمت‌های لورم اپیسوم در دسترس است، اما اکثریت آن‌ها به نوعی دچار تغییر
                                        شده‌اند، با طنز تزریقی یا کلمات تصادفی که حتی کمی باورپذیر به نظر نمی‌رسند. اگر می‌خواهید از
                                        قسمتی از لورم اپیسوم استفاده کنید، باید مطمئن شوید که هیچ چیز شرم‌آوری در وسط متن پنهان نشده
                                        باشد.</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';

            Page::create([
                'title' => 'توضیحات قوانین و مقررات',
                'slug' => 'قوانین',
                'content' => $content,
                'user_id' => $user->id,
                'status' => 'published',
                'url' => '/terms',
                'summary' => 'خلاصه قوانین و مقررات',
                'keywords' => 'قوانین و مقررات',
            ]);

            // ایجاد نمونه‌های دیگر اگر نیاز دارید

    }
}
