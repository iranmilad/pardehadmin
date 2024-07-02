<div>
    <button class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#imageUploaderModal">افزودن تصویر جدید</button>

    <div wire:ignore.self class="modal fade" id="imageUploaderModal" tabindex="-1" aria-labelledby="imageUploaderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageUploaderModalLabel">آپلود تصویر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="upload" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="file" wire:model="images" multiple>
                            @error('images.*') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">آپلود</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <h5>تصاویر آپلود شده:</h5>
        <div class="d-flex flex-wrap">
            @foreach($uploadedImages as $image)
                <div class="m-2">
                    <img src="{{ Storage::url($image) }}" alt="Image" style="max-width: 150px; max-height: 150px;">
                    <button wire:click="deleteImage('{{ $image }}')" class="btn btn-danger btn-sm mt-1">حذف</button>
                </div>
            @endforeach
        </div>
    </div>
</div>
