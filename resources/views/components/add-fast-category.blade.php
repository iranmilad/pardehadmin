<div class="mt-3">

    <div class="collapse" id="categoryCreateCollapse">
        <input class="form-control mb-2 new-cat-title" placeholder="عنوان">
        <input class="form-control mb-2 new-cat-slug" placeholder="نامک">
        <select class="form-select mb-2 new-cat-parent">
            <option value="mother">-- دسته مادر --</option>
            <option value="category1">دسته ی پرده</option>
            <option value="category2">دسته ی پارچه</option>
            <option value="category3">دسته ی روتختی</option>
        </select>
        <button class="btn btn-sm btn-primary tw-w-max" type="button">افزون</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-fast-category" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="categoryCreateFast">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">افزودن دسته ی جدید</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <input name="title" class="form-control" type="text" placeholder="عنوان">
                </div>
                <div class="mb-4">
                    <input name="slug" class="form-control" type="text" placeholder="نامک">
                </div>
                <select class="form-control" name="parent" id="">
                    <option value="mother">-- دسته مادر --</option>
                    <option value="category1">دسته ی پرده</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                <button type="submit" class="btn btn-primary">ذخیره</button>
            </div>
        </form>
    </div>
</div>