<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use App\Models\SliderImage;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        // ایجاد اسلایدر
        $slider = Slider::create(['name' => 'Slider 1']);

        // ایجاد تصاویر اسلایدر
        $slider->images()->createMany([
            [
                'image' => 'images/slider1.jpg',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],
            [
                'image' => 'images/slider2.jpg',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],
            [
                'image' => 'images/slider3.webp',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],
            [
                'image' => 'images/slider4.webp',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],
            [
                'image' => 'images/slider4.webp',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],


        ]);


        $slider = Slider::create(['name' => 'Slider 2']);
        // ایجاد تصاویر اسلایدر
        $slider->images()->createMany([
            [
                'image' => 'images/slider/banner1.webp',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],
            [
                'image' => 'images/slider/banner2.webp',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],
            [
                'image' => 'images/slider/banner3.webp',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ],
            [
                'image' => 'images/slider/banner4.webp',
                'link' => '',
                'title' => '',
                'caption' => '',
                'alt' => ''
            ]


        ]);

    }
}
