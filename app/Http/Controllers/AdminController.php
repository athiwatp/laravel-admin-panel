<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use stdClass;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::user()) {
            $top_menus = Menu::find(1)->getTopMenu()->get();
        } else {
            $top_menus = new StdClass;
        }

        view::share('top_menus', $top_menus);

        $this->middleware('auth');
    }

    /**
     *  Display Dashboard
     */
    public function index()
    {
        return view('admin.index');
    }

    public function users_administrator(){
        return view('admin.users.administrator');
    }
}
