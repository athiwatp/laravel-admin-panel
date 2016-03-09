<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu', 'menu_roles', 'role_id', 'menu_id');
    }
}
