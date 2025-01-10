<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class PasswordAttributeCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): mixed
    {
        // Ma'lumotni olish uchun logika
        return $value;
    }

    public function set($model, string $key, $value, array $attributes): mixed
    {
        // Ma'lumotni saqlash uchun logika
        return bcrypt($value);
    }
}
