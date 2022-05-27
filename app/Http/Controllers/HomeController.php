<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    public function connect()
    {
        $respon = Http::get('https://7358-202-80-219-193.ap.ngrok.io/');
        $respon->body();

        $data = json_decode($respon);
        echo $data[1]->id;
    }   
}
