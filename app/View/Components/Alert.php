<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     */
    public $closeButton;
    public $debug;
    public $newestOnTop;
    public $progressBar;
    public $positionClass;
    public $preventDuplicates;
    public $onclick;
    public $showDuration;
    public $hideDuration;
    public $timeOut;
    public $extendedTimeOut;
    public $showEasing;
    public $hideEasing;
    public $showMethod;
    public $hideMethod;
    public $msg;
    public $title;
    public $type;
    public function __construct(
    $msg,$title,
    $closeButton = true, $debug = false, 
    $newestOnTop = false, $progressBar = false,
    $positionClass = "toastr-bottom-right", $preventDuplicates = true, 
    $onclick = null, $showDuration = "300", 
    $hideDuration = "1000", $timeOut = "5000", 
    $extendedTimeOut = "1000", $showEasing = "swing", 
    $hideEasing = "linear" , $showMethod = "fadeIn", 
    $hideMethod = "fadeOut", $type = "success"
    )
    {
        $this->msg = $msg;
        $this->title = $title;
        $this->closeButton = $closeButton;
        $this->debug = $debug;
        $this->newestOnTop = $newestOnTop;
        $this->progressBar = $progressBar;
        $this->positionClass = $positionClass;
        $this->preventDuplicates = $preventDuplicates;
        $this->onclick = $onclick;
        $this->showDuration = $showDuration;
        $this->hideDuration = $hideDuration;
        $this->timeOut = $timeOut;
        $this->extendedTimeOut = $extendedTimeOut;
        $this->showEasing = $showEasing;
        $this->hideEasing = $hideEasing;
        $this->showMethod = $showMethod;
        $this->hideMethod = $hideMethod;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
