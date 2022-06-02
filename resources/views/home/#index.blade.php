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
                <div>
                    <img src="images/lat-long.png" alt=""></img>
                    <p> Latitude, Longitude</p>
                    @if(session('lat'))
                        <i><small>{{ session('lat') }}, {{ session('long') }}</small></i>
                    @else
                        <i><small>Koordinat Tidak Tersedia</small></i>
                    @endif
                </div>
            </div>

            <div class="result">
                <p class="connect">Hasil Log Perjalanan</p>
                <div class="box">
                    <img src="images/car-icon.png" alt="" class="car"></img>
                    <div class="identity">
                        <p>Nama / Id Vehicle</p>
                        <small>22 April 2022 </small>
                    </div>
                    <a href="">
                        <img src="images/icon-eye.png" alt="">
                    </a>
                </div>
                <div class="box">
                    <img src="images/car-icon.png" alt="" class="car"></img>
                    <div class="identity">
                        <p>Nama / Id Vehicle</p>
                        <small>22 April 2022 </small>
                    </div>
                    <a href="">
                        <img src="images/icon-eye.png" alt="">
                    </a>
                </div>
                <div class="box">
                    <img src="images/car-icon.png" alt="" class="car"></img>
                    <div class="identity">
                        <p>Nama / Id Vehicle</p>
                        <small>22 April 2022 </small>
                    </div>
                    <a href="">
                        <img src="images/icon-eye.png" alt="">
                    </a>
                </div>
                <div class="box">
                    <img src="images/car-icon.png" alt="" class="car"></img>
                    <div class="identity">
                        <p>Nama / Id Vehicle</p>
                        <small>22 April 2022 </small>
                    </div>
                    <a href="">
                        <img src="images/icon-eye.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('map')
    <div class="right">
        <div class = "navbar-mobile">
            <img src="images/Logo-with-text.png" alt=""style ="width : 200px;"></img>
        </div>
        <div class="map"> 
            <div id="map"></div>
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
    getMap();
    function getMap(lat, long) {   
        $.ajax({
            type: "GET",
            url: "{{ route('map') }}",
            success: function (data) {
                $("#map").html(data);
            }
        });
    }

    setInterval(getMap, 5000);
</script>
@endsection