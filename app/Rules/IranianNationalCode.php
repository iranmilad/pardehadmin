<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IranianNationalCode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // بررسی فرمت: اطمینان از اینکه کد ملی فقط شامل 10 رقم است
        if (!preg_match('/^\d{10}$/', $value)) {
            $fail('کد ملی وارد شده نامعتبر است.');
            return;
        }

        // تبدیل کد ملی به آرایه‌ای از اعداد
        $digits = str_split($value);

        // بررسی یکنواخت نبودن ارقام (مثل 1111111111)
        if (count(array_unique($digits)) === 1) {
            $fail('کد ملی وارد شده نامعتبر است.');
            return;
        }

        // محاسبه رقم کنترل
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $digits[$i] * (10 - $i);
        }
        $remainder = $sum % 11;
        $controlDigit = (int) $digits[9];

        // بررسی اعتبار بر اساس رقم کنترل
        if (!($remainder < 2 && $controlDigit == $remainder) && !($remainder >= 2 && $controlDigit == 11 - $remainder)) {
            $fail('کد ملی وارد شده نامعتبر است.');
        }
    }
}

