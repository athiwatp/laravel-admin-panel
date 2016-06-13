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
        return $this->hasManyThrough('App\Menu', 'menu_roles', 'role_id', 'menu_id');
    }

    public function all_menus(){
        return $this->menus->join('menu_roles', 'menus.id', '=', 'menu_roles.menu_id')
            ->join('menu_roles', 'roles.id', '=', 'menu_roles.role_id')
            ->get();
    }
}
