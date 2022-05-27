@extends('layouts.app')

@section('style')
<style>
    #mapid { min-height: 100%; }
</style>
@endsection

@section('menu')
<div class="left">
    <div class="panel"> 
        <div class="inside">
            <div class="logo">
                <img src="images/Logo-with-text.png" alt=""></img>
            </div>

            <div class="vehicleId">
                <p class="connect">Sambungkan Kendaraan</p>
                <div class="box">      
                    <img src="images/car-icon.png" alt="" class="car"></img>
                    <div class="identity">
                        <p>Nama / Id Vehicle</p>
                        <small> Tidak Tersambung </small>
                    </div>
                    <form action="" method="post">
                        <button class="connector">
                            <img src="images/icon-connect.png" alt=""></img>
                            <p>Sambungkan</p>
                        </button>
                    </form>
                </div>
            </div>

            <div class="latlongsec">
                <div class="latlong">
                    <img src="images/lat-long.png" alt=""></img>
                    <p> LAT LONG</p>
                    <small>2102212, 2991291</small>
                </div>
                <div class="coordinate">
                    <img src="images/gps-coords.png" alt=""></img>
                    <p> GPS Coordinates </p>
                    <small>-018239292</small>
                </div>
            </div>

            <div class="result">
                <p>Hasil Record Perjalanan</p>
                <div class="container">
                    <img src="" alt="recordResult"></img>
                </div>
                <button>Simpan Hasil</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('map')
<div class="right">
    <div class="map"> 
        <div class="mapouter">
            <div class="gmap_canvas">
                <div id="mapid"></div>
            </div>
        </div>

        <div class="tracks">
            <img src="images/black-car.png"alt=""></img>
            <span>
                <p>Nama / Id Vehicle</p>
                <small>Tidak Tersambung Dengan GPS</small>
            </span>
            <button class="record"> Mulai Tracking</button>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var map = L.map('mapid').setView([-2.994494, 120.195465], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>
@endsection