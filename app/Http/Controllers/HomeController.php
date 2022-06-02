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
        $trips = Trip::get();
        return view('home.index', [
            'trips' => $trips,
        ]);
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

            $request->session()->forget(['lat', 'long', 'timestamp', 'tripCode']);

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
    }

    public function record()
    {
        // $respon = Http::get('http://127.0.0.1:7777/');
        // $respon->body();
        // $data = json_decode($respon, true);

        $radius = 0.01;
        $x = session('lat') + rand(10, 100) * $radius;
        $y = session('long') + rand(10, 100) * $radius;

        if (session('tripCode')) {
            Record::create([
                'tripCode' => session('tripCode'),    
                'lat' => $x,
                'long' => $y,
            ]);
        }

        return response()->json([
            'lat' =>  $x,
            'lng' => $y,
        ]);

        
    }
}
