<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function roles(){
        $this->belongsToMany('App\Role', 'menu_roles');
    }
}
