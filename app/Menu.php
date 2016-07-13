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
            ->where('role_users.role_id', '=', $user->pivot->role_id)
            ->groupBy('route');
    }

    public function getChildren()
    {
        return $this->children()->get();
    }

    public function parent()
    {
        return $this->hasMany('App\Menu', 'id');
    }

    public function getTopMenu()
    {
        return $this->topMenuQuery()->whereNull('menus.parent_id')->groupBy('route')->get();
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

    public function hasChildren()
    {
        return (bool)$this->children()->count();
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id')->get();
    }

    public function hasPermission($role_id)
    {
        $role_arr = [];
        foreach ($this->roles as $role_menu) {
            $role_arr[] = $role_menu->pivot->role_id;
        }
        return (bool) ( in_array($role_id, $role_arr) ) ? 1 : 0;
    }

}
