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
        return Role::all();
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

        foreach ($roles as $role) {
            $request_menus = $request[$role->id];
            Role::find($role->id)->menus()->sync($request_menus);
        }

        return Response::json(['message' => 'Roles Saved Successfully']);
    }
}
