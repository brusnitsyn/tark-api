<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'call',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Получить все вложения пользователя.
     */
    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    /**
     * Получить все "закладки" пользователя.
     */
    public function favorites()
    {
        return $this->morphMany('App\Models\UserFavorite', 'favoriteable');
    }

    /**
     * Получить организацию пользователя.
     */
    public function org()
    {
        return $this->hasOneThrough(Org::class, OrgUser::class, 'user_id', 'id');
    }
}
