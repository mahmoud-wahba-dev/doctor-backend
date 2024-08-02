<?php

namespace App\Models;

use app\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'phone',
        'password',
        'blocked',
        'block_after',
        'blocked_at',
        'active',
        'last_login_at',
        'login_count',
        'otp',
        'national_id',
        'phone_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'blocked_at' => 'datetime',
            'block_after' => 'datetime',
            'password' => 'hashed',
            'blocked' => 'boolean',
            'login_count' => 'integer',
            'active' => 'boolean',
        ];
    }

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
     * @return HasOne
     */
    public function account()
    {
        return $this->hasOne(Account::class , 'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function contexts()
    {
        return $this->belongsToMany(Context::class , 'context_user', 'user_id', 'context_id');
    }
}
