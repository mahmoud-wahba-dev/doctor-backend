<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disease extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'description',
    ];

    /**
     * @return BelongsToMany
     */
    public function patients()
    {
        return $this->belongsToMany(Patient::class , 'disease_patient' , 'disease_id' , 'id');
    }

    /**
     * @return HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
