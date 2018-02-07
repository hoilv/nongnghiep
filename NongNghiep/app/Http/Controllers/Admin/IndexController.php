<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check())
        {
            return redirect()->route('admin_top');
        }
        return view('admin.login');
    }

    public function hello1()
    {
       echo "ddd";
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('admin_top');
        }

        return redirect()->route('home_admin');
    }

    public function top()
    {
        return view('admin.top_index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home_admin');
    }
}
