<div class="tw-max-h-56 tw-overflow-auto tw-pt-1">
    <ul class="intermediat-checkbox">
        <li>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="tall" name="category1" />
                <label class="form-check-label" for="tall">
                    دسته ی پرده
                </label>
            </div>
            <ul>
                <li>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tall2" name="category1['child']" />
                        <label class="form-check-label" for="tall2">
                            پرده ی اتاق خواب
                        </label>
                    </div>
                </li>
                <li>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tall3" name="category1['child']" />
                        <label class="form-check-label" for="tall3">
                            پرده ی اتاق نشیمن
                        </label>
                    </div>
                </li>
            </ul>
        </li>
    </ul>

</div>
<div class="mt-3">
    <button class="nav-link" type="button" data-bs-toggle="collapse" data-bs-target="#categoryCreateCollapse">افزودن دسته ی جدید</button>
    <form class="collapse" id="categoryCreateCollapse">
        <div class="card tw-shadow-none card-body">
            <input class="form-control mb-2 new-cat-title" placeholder="عنوان" />
            <select class="form-select mb-2 new-cat-parent" >
                <option value="mother">-- دسته مادر --</option>
                <option value="category1">دسته ی پرده</option>
                <option value="category2">دسته ی پارچه</option>
                <option value="category3">دسته ی روتختی</option>
            </select>
            <button class="btn btn-sm btn-primary tw-w-max" type="submit">افزون</button>
        </div>
    </form>
</div>