<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Context extends Model
{
    use HasFactory;

    public $timestamps =false;

    public function patients()
    {
        return $this->belongsToMany(Patient::class , 'context_user' , 'context_id' , 'user_id');
    }
}
