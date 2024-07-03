<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->paginate(10); // دریافت همه‌ی اسلایدرها به صورت صفحه‌بندی شده

        return view('sliders', compact('sliders'));
    }

    public function create()
    {
        return view('slider');
    }

    public function store(Request $request)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255',
        ]);

        // ذخیره تصویر
        $imagePath = $request->file('image')->store('slider_images', 'public');

        // ایجاد اسلایدر
        $slider = Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'link' => $validatedData['link'],
            'image' => $imagePath,
        ]);

        return redirect()->route('sliders.list')->with('success', 'اسلایدر با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('slider', compact('slider'));
    }


    public function update(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'titles.*' => 'required|max:255',
            'captions.*' => 'nullable',
            'alts.*' => 'nullable',
            'links.*' => 'nullable|url|max:255',
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slider = Slider::findOrFail($id);

        // به‌روزرسانی تصاویر موجود
        foreach ($slider->images as $key => $sliderImage) {
            if (isset($validatedData['titles'][$key])) {
                $sliderImage->title = $validatedData['titles'][$key];
            }
            if (isset($validatedData['captions'][$key])) {
                $sliderImage->caption = $validatedData['captions'][$key];
            }
            if (isset($validatedData['alts'][$key])) {
                $sliderImage->alt = $validatedData['alts'][$key];
            }
            if (isset($validatedData['links'][$key])) {
                $sliderImage->link = $validatedData['links'][$key];
            }
            if ($request->hasFile('files') && isset($validatedData['files'][$key])) {
                if ($sliderImage->image && Storage::disk('public')->exists($sliderImage->image)) {
                    Storage::disk('public')->delete($sliderImage->image);
                }
                $file = $request->file('files')[$key];
                $address = 'images/sliders';
                $fileName = $file->getClientOriginalName();
                $file->storeAs('public/images/sliders', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
                $file->move(public_path($address), $fileName);
                $imgPath =  $address.'/'.$fileName ;
                $sliderImage->image = $imgPath;
            }
            $sliderImage->save();
        }

        // افزودن تصاویر جدید به انتهای لیست تصاویر
        // if ($request->hasFile('files')) {
        //     foreach ($request->file('files') as $file) {
        //         $address = 'images/sliders';
        //         $fileName = $file->getClientOriginalName();
        //         $file->storeAs('public/images/sliders', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
        //         $file->move(public_path($address), $fileName);
        //         $imgPath =  $address.'/'.$fileName ;
        //         $slider->images()->create(['image' => "/".$imgPath]);
        //     }
        // }

        return redirect()->route('sliders.list')->with('success', 'اسلایدر با موفقیت به‌روزرسانی شد.');
    }

    public function addImage(Request $request, $id)
    {
        // اعتبارسنجی داده‌های ورودی
        $validatedData = $request->validate([
            'titles.*' => 'required|max:255',
            'captions.*' => 'nullable',
            'alts.*' => 'nullable',
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slider = Slider::findOrFail($id);

        // افزودن تصاویر جدید
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                $address = 'images/sliders';
                $fileName = $file->getClientOriginalName();
                $file->storeAs('public/images/sliders', $fileName); // ذخیره فایل در مسیر مورد نظر، مانند storage/app/uploads
                $file->move(public_path($address), $fileName);
                $imgPath =  $address.'/'.$fileName ;

                $slider->images()->create([
                    'title' => $validatedData['titles'][$key],
                    'caption' => $validatedData['captions'][$key] ?? null,
                    'alt' => $validatedData['alts'][$key] ?? null,
                    'link' => $validatedData['links'][$key] ?? null,
                    'image' => $imgPath,
                ]);
            }
        }

        return redirect()->route('sliders.list')->with('success', 'تصاویر جدید با موفقیت به اسلایدر اضافه شدند.');
    }

    public function slideView($id)
    {
        $slider = Slider::findOrFail($id);
        return view('sliderCreate',compact("slider"));
    }

    public function storeNewImage(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'caption' => 'nullable',
            'alt' => 'nullable',
            'link' => 'nullable|url|max:255',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slider = Slider::findOrFail($id);

        $imagePath = $request->file('file')->store('slider_images', 'public');
        $slider->images()->create([
            'title' => $validatedData['title'],
            'caption' => $validatedData['caption'],
            'alt' => $validatedData['alt'],
            'link' => $validatedData['link'],
            'image' => $imagePath,
        ]);

        return redirect()->route('sliders.list')->with('success', 'تصویر جدید به اسلایدر افزوده شد.');
    }

    public function deleteImage($image_id)
    {
        $sliderImage = SliderImage::findOrFail($image_id);

        if ($sliderImage->image && Storage::disk('public')->exists($sliderImage->image)) {
            Storage::disk('public')->delete($sliderImage->image);
        }

        $sliderImage->delete();

        return redirect()->back()->with('success', 'تصویر با موفقیت حذف شد.');
    }

}
