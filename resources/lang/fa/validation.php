<?php

return [

    'required' => 'وارد کردن :attribute الزامی است.',
    'string' => ':attribute باید یک رشته باشد.',
    'max' => [
        'string' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
    ],
    'integer' => ':attribute باید یک عدد صحیح باشد.',
    'exists' => ':attribute انتخاب شده معتبر نیست.',

    // سایر قوانین اعتبارسنجی...

    'attributes' => [
        'group' => 'گروه',
        'title' => 'عنوان',
        'min_score' => 'حداقل نمره',
        'max_score' => 'حداکثر نمره',
    ],

    'numeric' => 'فیلد :attribute باید عددی باشد.',
    'array' => 'فیلد :attribute باید آرایه باشد.',
    'in' => 'فیلد :attribute باید یکی از مقادیر مجاز باشد.',
    'boolean' => 'فیلد :attribute باید درست یا نادرست باشد.',
];

