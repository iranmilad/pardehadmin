<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ImageUploader extends Component
{
    use WithFileUploads;

    public $images = [];
    public $uploadedImages = [];
    public $uploadPath;

    public function mount($uploadPath = 'uploads')
    {
        $this->uploadPath = $uploadPath;
        $this->loadUploadedImages();
    }

    public function loadUploadedImages()
    {
        $this->uploadedImages = Storage::files($this->uploadPath);
    }

    public function upload()
    {
        foreach ($this->images as $image) {
            $path = $image->store($this->uploadPath);
            $this->uploadedImages[] = $path;
        }

        $this->images = [];
    }

    public function deleteImage($imagePath)
    {
        Storage::delete($imagePath);
        $this->loadUploadedImages();
    }

    public function render()
    {
        return view('livewire.image-uploader');
    }
}
