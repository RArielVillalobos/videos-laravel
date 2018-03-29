<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Video;
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
        //query builder
        //$videos=Db::table('videos')->paginate(5);

        //eloquent orm
        $videos=Video::orderBy('id','desc')->paginate(5);
        return view('home',['videos'=>$videos]);
    }


}
