<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{

    public $allowed_paths = array('admin');

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'menu_roles');
    }

    public function children()
    {
        $user = Auth::user()->roles()->first();

        return $this->hasMany('App\Menu', 'parent_id', 'id')
            ->join('menu_roles', 'menus.id', '=', 'menu_roles.menu_id')
            ->join('role_users', 'menu_roles.role_id', '=', 'role_users.role_id')
            ->where('role_users.role_id', '=', $user->pivot->role_id);
    }

    public function parent()
    {
        return $this->hasMany('App\Menu', 'id');
    }

    public function getTopMenu()
    {
        return $this->topMenuQuery()->whereNull('menus.parent_id')->get();
    }

    private function topMenuQuery()
    {
        $user = Auth::user()->roles()->first();

        return $this->join('menu_roles', 'menus.id', '=', 'menu_roles.menu_id')
            ->join('role_users', 'menu_roles.role_id', '=', 'role_users.role_id')
            ->where('role_users.role_id', '=', $user->pivot->role_id);
    }

    public function hasRouteAccess($path)
    {
        return $this->join('menu_roles', 'menus.id', '=', 'menu_roles.menu_id')
            ->join('role_users', 'menu_roles.role_id', '=', 'role_users.role_id')
            ->where('menus.route', '=', $path);
    }
}
