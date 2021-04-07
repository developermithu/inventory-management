<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    //which col fillable
    // protected $fillable = ['id', 'name', 'email', 'password'];  

    //which col not fillable (id will be generate auto) without id all col are fillable
    protected $guarded = ['id'];

    // module_id
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // many to many relation between PermissionRole table
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
