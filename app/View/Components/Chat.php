<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Chat extends Component
{
    public $session;

    public function __construct($session) {
        $this->session = $session;
    }

    // Component logic goes here

    public function render()
    {
        return view('components.chat',[
            'session' => $this->session
        ]);
    }
}
