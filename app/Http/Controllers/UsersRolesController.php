<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class UsersRolesController extends Controller
{

    public function index()
    {
        return User::with('roles')->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->all();

        $roles = Role::all();

        foreach ( $roles as $role )
        {
            $request_menus = $request[$role->id];
            print_r($request_menus);
            $role_menu_arr = [];
            $role_menus = $role->menus;
            foreach ($role_menus as $role_menu)
            {
                $role_menu_arr[] = $role_menu->pivot->menu_id;
            }
            print_r($role_menu_arr);

            foreach ( $request_menus as $request_menu )
            {
                if ( !in_array($request_menu, $role_menu_arr) )
                {
                    Role::find($role->id)->save([]);
                }
            }
            die;
        }



        /*$user = User::findOrFail($id);
        if ($request->input('password') != '') {
            $user->update(array_merge(
                array('password' => bcrypt($request->input('password'))),
                $request->except(['password'])
            ));
        } else {
            $user->update($request->except(['password']));
        }*/

       // return Response::json($request->all());
    }
}
