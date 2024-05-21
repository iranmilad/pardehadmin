<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class WidgetContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public $type;
    public $contact;
    public $options;

    public function mount($type,$options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);

        if ($this->type == "simple") {
            $this->contact = (object)$this->options;
        }

    }

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'subject' => 'required|string',
        'message' => 'required|string',
    ];

    public function submitForm()
    {
        //$this->validate();

        // Send email

        $name =  $this->name;
        $email =  $this->email;
        $phone = $this->phone;
        $subject = $this->subject;
        $message = $this->message;

        Mail::to(config('mail.from.address'))->send(new ContactFormMail($name, $email, $phone, $subject, $message));
        // Clear form fields
        $this->reset();

        // Show success message
        session()->flash('message', 'پیام شما با موفقیت ارسال شد!');
    }

    public function render()
    {
        $contact= $this->contact;
        return view('livewire.widget-contact-form',compact('contact'));
    }
}
