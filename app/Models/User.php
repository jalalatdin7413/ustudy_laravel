<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Casts\PasswordAttributeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'name',
        'email',
        'password'
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
            'password' => PasswordAttributeCast::class,
        ];
    }

    /**
     * Summary of country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Summary of posts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    /**
     * Summary of point
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function point(): HasOne
    {
        return $this->hasOne(UserPoint::class, 'user_id', 'id');
    } 

    /**
     * Summary of phone
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */

    public function phone(): MorphOne
    {
        return $this->morphOne(Phone::class, 'phoneable');
    } 

    /**
     * Summary of computer
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */

    public function computer(): MorphOne
    {
        return $this->morphOne(Computer::class, 'computable');
    } 
}
