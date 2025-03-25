<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasImages;

/**
 * User Model
 * 
 * This model represents system users
 * 
 * @property int $id
 * @property string $name User's name
 * @property string $email User's email
 * @property string $password User's password (hashed)
 * @property string|null $biography User's biography text
 * @property string|null $headline User's title or position
 * @property string|null $location User's location
 * @property string|null $website User's personal website
 * @property \Illuminate\Support\Carbon|null $email_verified_at Email verification date
 * @property string|null $remember_token Remember token
 * @property \Illuminate\Support\Carbon $created_at Creation date
 * @property \Illuminate\Support\Carbon $updated_at Last update date
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasImages;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'biography',
        'headline',
        'location',
        'website',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'password' => 'hashed',
        ];
    }

    /**
     * متد کمکی برای بررسی اینکه آیا کاربر پروفایل خود را تکمیل کرده است یا خیر
     * بر اساس وجود فیلدهای biography، headline و location
     * 
     * @return bool
     */
    public function hasCompletedProfile(): bool
    {
        return !empty($this->biography) && !empty($this->headline) && !empty($this->location);
    }

    /**
     * آدرس وب‌سایت کاربر را با پروتکل http یا https برمی‌گرداند
     * 
     * @return string|null
     */
    public function getFormattedWebsiteAttribute(): ?string
    {
        if (empty($this->website)) {
            return null;
        }

        if (!preg_match('~^(?:f|ht)tps?://~i', $this->website)) {
            return 'https://' . $this->website;
        }

        return $this->website;
    }

    /**
     * رابطه با تصویر پروفایل کاربر
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function profileImage()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
