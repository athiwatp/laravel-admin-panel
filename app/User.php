<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->is_admin; // this looks for an admin column in your users table
    }

    /**
     * 1st parameter : Model name
     * 2nd parameter : Table name (Exception)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users', 'role_id', 'user_id');
    }

    public function hasRouteAccess()
    {
        $path = request()->path();
        return $this->roles()
            ->join('menu_roles', 'role_users.role_id', '=', 'menu_roles.role_id')
            ->join('menus', 'menus.id', '=', 'menu_roles.menu_id')
            ->where('menus.route', '=', $path)->count();
    }


}
