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
                        @if(session('lat'))
                            <small> D 400 CC </small>
                        @else
                            <small> Tidak Tersambung </small>
                        @endif
                    </div>
                    @if(session('lat'))
                    <form action="{{ route('connect', ['action' => 'disconnect']) }}" method="post">
                        @csrf
                        <button class="connector">
                            <img src="images/icon-connect.png" alt=""></img>
                            <p>Disconnect</p>
                        </button>
                    </form>
                    @else
                    <form action="{{ route('connect', ['action' => 'connect']) }}" method="post">
                        @csrf
                        <button class="connector">
                            <img src="images/icon-connect.png" alt=""></img>
                            <p>Connect</p>
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="latlongsec">
                <div class="latlong">
                    <img src="images/lat-long.png" alt=""></img>
                    <p> LAT LONG</p>
                    @if(session('lat'))
                        <small>{{ session('lat') }}, {{ session('long') }}</small>
                    @else
                        <small>Koordinat Tidak Tersedia</small>
                    @endif
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
            <div id="map"></div>
            {{-- <div class="mapouter">
                <div class="gmap_canvas">
                    <div id="mapid"></div>
                </div>
            </div> --}}

            @if(session('lat'))
                <div class="tracks">
                    <img src="images/black-car.png"alt=""></img>
                    <span>
                        <p>Nama / Id Vehicle</p>
                        <small>Tidak Tersambung Dengan GPS</small>
                    </span>
                    <?php
                        $str=rand();
                        $result = md5($str);
                    ?>
                    @if(session('tripCode'))
                        <form action="{{ route('tracking', ['action' => 'stop']) }}" method="post">
                            @csrf
                            <button class="record"> Stop </button>
                        </form>
                    @else
                        <form action="{{ route('tracking', ['tripCode' => $result, 'action' => 'mulai']) }}" method="post">
                            @csrf
                            <button class="record"> Mulai Tracking</button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
<script>

    // $(document).ready(function() {
    function getMap() {   
        $.ajax({
            type: "GET",
            url: "{{ route('map') }}",
            success: function (data) {
                $("#map").html(data);
            }
        });
    }
    getMap();
    // });

    // @if(session('lat')) 
    //     var map = L.map('mapid').setView([{{ session('lat') }}, {{ session('long') }}], 17);
    // @else    
    //     var map = L.map('mapid').setView([-2.994494, 120.195465], 5);
    // @endif

    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    // }).addTo(map);

    // var greenIcon = L.icon({
    //     iconUrl: '<?= asset("images/ant-design_car-filled.png") ?>',
        
    //     iconSize: [30, 30], // size of the icon
    // });

    // @if(session('lat'))
    //     var marker = L.marker([-6.941699466981278, 107.72315740585327], {icon : greenIcon}).addTo(map).bindPopup('<small style="color:black;">Kamu Berada Disini</small>').openPopup();
    // @endif
</script>
@endsection