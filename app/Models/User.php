<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    protected $guarded = ['id'];

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //  ''role_id,
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // role_id
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // From AuthGates Middleware
    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    // For Spatie Media Library
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }
}
