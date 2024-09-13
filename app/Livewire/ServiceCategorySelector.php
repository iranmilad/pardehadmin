<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class ServiceCategorySelector extends Component
{
    public $selectedCategory = [];
    public $selectedServicesType = ['sewing', 'design', 'installer'];
    public $productId;

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadSelectedCategories();
    }

    public function loadSelectedCategories()
    {
        // Ensure $selectedCategory is an array with default empty arrays for each service type
        foreach ($this->selectedServicesType as $serviceType) {
            $service = Service::where('type', $serviceType)
                ->where('product_id', $this->productId)
                ->first();

            if ($service) {
                $this->selectedCategory[$serviceType] = $service->categories()
                    ->select('categories.id') // Specify the table alias
                    ->pluck('id') // Retrieve IDs of selected categories
                    ->toArray();
            } else {
                $this->selectedCategory[$serviceType] = [];
            }
        }
    }

    public function save()
    {
        foreach ($this->selectedServicesType as $serviceType) {
            // Find or create the service
            $service = Service::firstOrCreate(
                ['type' => $serviceType, 'product_id' => $this->productId]
            );
    
            // Retrieve the selected categories for the current service type
            $selectedCategories = $this->selectedCategory[$serviceType] ?? [];
    
            // If the selected categories is a string (single category), convert it to an array
            if (is_string($selectedCategories)) {
                $selectedCategories = [$selectedCategories];
            }
    
            // Remove any empty values
            $selectedCategories = array_filter($selectedCategories);
    
            if (!empty($selectedCategories)) {
                // Sync selected categories with the service
                $service->categories()->sync($selectedCategories);
            } else {
                // Detach all categories if none are selected
                $service->categories()->detach();
            }
        }
    
        session()->flash('message', 'دسته‌بندی‌ها با موفقیت به‌روزرسانی شد.');
    
        // Reload the selected categories to reflect any changes
        $this->loadSelectedCategories();
    }
    

    public function render()
    {
        $categories = Category::all();

        return view('livewire.service-category-selector', [
            'categories' => $categories,
        ]);
    }
}
