<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Trip;
use App\Models\Record;

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

    public function map(Request $request)
    {
        return view('home.map');
    }

    public function connect(Request $request)
    {
        if ($request->action == 'connect') {

            // $respon = Http::get('http://127.0.0.1:7777/');
            // $respon->body();
    
            // $data = json_decode($respon, true);
            session([
                'lat' => '-6.914744',
                'long' => '107.609810',
                'timestamp' => '2020-10-9',
            ]); 

        } elseif($request->action == 'disconnect') {

            $request->session()->forget(['lat', 'long', 'timestamp']);

        }
        return redirect()->route('home'); 
    }   

    public function tracking(Request $request)
    {
        if ($request->action == 'mulai') {
            session([
                'tripCode' => $request->tripCode,
            ]); 
    
            Trip::create([
                'tripCode' => $request->tripCode,    
            ]);
        }elseif($request->action == 'stop'){
            $request->session()->forget(['tripCode']);
        }
        // return redirect()->route('home'); 
    }

    public function record($re)
    {
        // Record::create([

        // ]);

        // $respon = Http::get('http://127.0.0.1:7777/');
        // $respon->body();
        // $data = json_decode($respon, true);

        return response()->json([
            'lat' => $lat,
            'lng' => $long,
        ]);
    }
}
