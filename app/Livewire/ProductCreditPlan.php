<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\CreditPlan;

class ProductCreditPlan extends Component
{
    public $product;
    public $selectedPlans = [];
    public $availablePlans = [];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->selectedPlans = $product->creditPlans()->pluck('credit_plans.id')->toArray();
        $this->availablePlans = CreditPlan::all();
    }

    public function save()
    {
        $this->product->creditPlans()->sync($this->selectedPlans);
        session()->flash('message', 'پلن‌های اعتباری با موفقیت ذخیره شدند.');
    }

    public function render()
    {
        return view('livewire.product-credit-plan');
    }
}
