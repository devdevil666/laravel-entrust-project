<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*var_dump(auth()->user()->hasRole('owner'));
        var_dump(auth()->user()->hasRole('admin'));
        var_dump(auth()->user()->can('edit-user'));
        var_dump(auth()->user()->can('create-post'));
        die;*/
        return view('home');
    }

    public function users(Request $request)
    {
        return User::filter($request->all())->get();
    }
}
