<?php
// app/Http/Livewire/SearchUsers.php

namespace App\Livewire;

use Livewire\Component;

class SearchUsers extends Component
{
    public $selectedUser;
    public $users = [];

    public function mount()
    {
        // Generate random user data
        $this->users = [
            ['id' => 1, 'name' => 'فرهاد باقری' , 'phone' => '09123456789'],
            ['id' => 2, 'name' => 'علی رضایی' , 'phone' => '09123456789'],
            ['id' => 3, 'name' => 'سارا هدایتی' , 'phone' => '09123456789'],
            ['id' => 4, 'name' => 'مهدی امینی' , 'phone' => '09123456789'],
        ];
    }

    public function render()
    {
        return view('livewire.search-users');
    }
}
