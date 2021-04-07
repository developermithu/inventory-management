<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //which col fillable
    // protected $fillable = ['id', 'name', 'email', 'password'];  

    //which col not fillable (id will be generate auto) without id all col are fillable
    protected $guarded = ['id'];

    // many to many relation between PermissionRole table
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
