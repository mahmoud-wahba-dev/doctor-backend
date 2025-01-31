<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends User
{

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            $model->contexts()->syncWithoutDetaching(Context::whereIn('name', [UserType::PATIENT])->pluck('id')->toArray());
        });
    }

    /**
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('patient', function (Builder $builder) {
            $builder->whereHas('contexts', function (Builder $builder) {
                $builder->whereIn('name', [UserType::PATIENT]);
            });
        });
    }

    /**
     * @return BelongsToMany
     */
    public function digonses()
    {
        return $this->belongsToMany(Diagnosis::class);
    }

    /**
     * @return HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function diagnoses()
    {
        return $this->belongsToMany(Diagnosis::class);
    }
}
