<?php

namespace Liuchengguos\Other\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message=config("other.message");
        echo $message;
    }

}
