<?php
namespace Database\Seeders;
// database/seeders/BannerSeeder.php

use Illuminate\Database\Seeder;
use App\Models\Banner;
use App\Models\BannerImage;

class BannerSeeder extends Seeder
{
    public function run()
    {
        // Create banners
        $banners = [
            ['name' => 'Banner 1'],
            ['name' => 'Banner 2'],
            // Add more banners as needed
        ];

        foreach ($banners as $bannerData) {
            $banner = Banner::create(['name' => $bannerData['name']]);

            // Attach images to banners
            $images = [
                [
                    'image' => '/images/banner1.jpg',
                    'hover_image' => '',
                    'link' => 'https://example.com',
                    'title' => 'Image 1',
                    'caption' => 'Caption for image 1',
                    'alt' => 'Alt text for image 1',
                ],
                [
                    'image' => '/images/banner2.jpg',
                    'hover_image' => '',
                    'link' => 'https://example.com',
                    'title' => 'Image 2',
                    'caption' => 'Caption for image 2',
                    'alt' => 'Alt text for image 2',
                ],
                // Add more images as needed
            ];

            foreach ($images as $imageData) {
                $banner->images()->create($imageData);
            }
        }
    }
}
