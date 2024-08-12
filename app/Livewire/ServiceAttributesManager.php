<?php
namespace App\Livewire;


use Livewire\Component;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class ServiceAttributesManager extends Component
{
    public $product;
    public $services;
    public $serviceDetails;
    public $selectedServiceType;
    public $selectedServicesType;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->services = $product->services()->with('serviceDetails')->get();
        $this->serviceDetails = [];
        $this->selectedServicesType = [];

        if ($this->services->isNotEmpty()) {
            foreach ($this->services as $service) {
                foreach ($service->serviceDetails as $detail) {
                    if ($detail->user_id == Auth::id()) {
                        $this->serviceDetails[] = $detail->toArray();
                        $this->selectedServicesType[] = $service->type;
                    }
                }
            }
        }

        Log::info($this->services);
    }


    public function save()
    {
        // اعتبارسنجی ورودی‌های فرم
        $this->validate([
            'serviceDetails.*.holo_code' => 'nullable',
            'serviceDetails.*.normal_price' => 'nullable|numeric',
            'serviceDetails.*.urgent_price' => 'nullable|numeric',
            'serviceDetails.*.sale_price' => 'nullable|numeric',
            'serviceDetails.*.normal_duration' => 'nullable|numeric',
            'serviceDetails.*.urgent_duration' => 'nullable|numeric',
        ]);

        foreach ($this->serviceDetails as $detail) {
            $serviceDetailModel = ServiceDetail::find($detail['id']);
            $serviceDetailModel->holo_code = $detail['holo_code'] ?? null;
            $serviceDetailModel->normal_price = $detail['normal_price'];
            $serviceDetailModel->urgent_price = $detail['urgent_price'];
            $serviceDetailModel->sale_price = $detail['sale_price'];
            $serviceDetailModel->normal_duration = $detail['normal_duration'];
            $serviceDetailModel->urgent_duration = $detail['urgent_duration'];
            $serviceDetailModel->save();
        }


        // نمایش پیام موفقیت‌آمیز برای کاربر
        session()->flash('message', 'Services saved successfully.');
    }


    public function createService()
    {
        $this->validate([
            'selectedServiceType' => 'required',
        ]);

        // ایجاد سرویس
        $service = Service::create([
            'product_id' => $this->product->id,
            'type' => $this->selectedServiceType,
            'category_id' => 1, // بر اساس منطق دسته‌بندی خود تنظیم کنید
        ]);

        // ایجاد جزئیات سرویس
        $serviceDetail = new ServiceDetail();
        $serviceDetail->service_id = $service->id;
        $serviceDetail->user_id = Auth::id();
        $serviceDetail->holo_code = "";
        $serviceDetail->normal_price = 0; // مقدار پیش‌فرض یا مقدار مورد نظر
        $serviceDetail->urgent_price = 0; // مقدار پیش‌فرض یا مقدار مورد نظر
        $serviceDetail->sale_price = 0; // مقدار پیش‌فرض یا مقدار مورد نظر
        $serviceDetail->normal_duration = 0; // مقدار پیش‌فرض یا مقدار مورد نظر
        $serviceDetail->urgent_duration = 0; // مقدار پیش‌فرض یا مقدار مورد نظر
        $serviceDetail->save();

        // افزودن جزئیات سرویس به لیست serviceDetails
        array_push($this->serviceDetails, $serviceDetail);

        session()->flash('message', 'Service created successfully.');

        // Refresh the current page
        return redirect()->route('products.edit',$this->product->id); // نام route فعلی را به جای 'current.route.name' قرار دهید

    }


    public function render()
    {
        return view('livewire.service-attributes-manager');
    }
}
