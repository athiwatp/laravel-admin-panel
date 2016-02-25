<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $user = Auth::user()->roles()->first();

        $top_menus = DB::table('menus')
            ->join('menu_roles', 'menus.id', '=', 'menu_roles.menu_id')
            ->join('role_users', 'menu_roles.role_id', '=', 'role_users.role_id')
            ->where('role_users.role_id', '=', $user->pivot->role_id)
            ->get();

        view::share(['top_menus' => $top_menus]);
    }

    /**
     *  Display Dashboard
     */
    public function index(){

        return view('admin.index');
    }
}
