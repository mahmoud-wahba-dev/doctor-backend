<?php

namespace App\Models;

use app\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends User
{
    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->contexts()->syncWithoutDetaching(Context::whereIn('name', [UserType::DOCTOR])->pluck('id')->toArray());
        });
    }
}
