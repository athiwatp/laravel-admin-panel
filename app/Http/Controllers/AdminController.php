<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
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

    public $allowed_paths = array('admin');

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = Auth::user();
        $path = request()->path();

        if ($user) {
            $top_menus = Menu::find(1)->getTopMenu();
        } else {
            $top_menus = new StdClass;
        }

        view::share('top_menus', $top_menus);

        // Need to add exception for admin
        if (!in_array($path, $this->allowed_paths)) {
            $hasRouteAccess = Menu::find(1)->hasRouteAccess($path)->count();
            if (!$hasRouteAccess) {
                return redirect('/admin');
            }
        }


        $this->middleware('auth');
    }

    /**
     *  Display Dashboard
     */
    public function index()
    {
        return view('admin.index');
    }

    public function users_administrator()
    {
        return view('admin.users.administrator');
    }
}
