@extends('layouts.app')

@section('style')
<style>
    #map-canvas{
        min-height:100%;
    }
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
                        <button id="btndisconnect"class="connector blue">
                            <img id ="disconnector"src="images/connected.png" alt=""></img>
                            <p>Disconnect</p>
                        </button>
                    </form>
                    @else
                    <form action="{{ route('connect', ['action' => 'connect']) }}" method="post">
                        @csrf
                        <button id="btnconnect"class="connector">
                            <img id ="connected"src="images/icon-connect2.png" alt=""></img>
                            <p>Connect</p>
                        </button>
                    </form>
                    @endif
                </div>
            </div>

            <div class="latlongsec">
                <div>
                    <img src="images/lat-long.png" alt=""></img>
                    <p> Titik Awal</p>
                    <p> Latitude, Longitude</p>
                    @if(session('lat'))
                        <i><small>{{ session('lat') }}, {{ session('long') }}</small></i>
                    @else
                        <i><small>Koordinat Tidak Tersedia</small></i>
                    @endif
                </div>
            </div>

            <div class="result">
                <p class="connect">Riwayat Perjalanan</p>
                <?php $i = '1' ?>
                @foreach ($trips as $item)                    
                    <div class="box">
                        <img src="images/car-icon.png" alt="" class="car"></img>
                        <div class="identity">
                            <p>Perjalanan {{ $i++ }}</p>
                            <small>{{ $item->created_at->format('d F Y h:i:s A') }} </small>
                        </div>
                        <a href="{{ route('log-perjalanan', ['tripCode' => $item->tripCode]) }}">
                            <img src="images/icon-eye.png" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<?php
    $str=rand();
    $result = md5($str);
?>
@endsection

@section('map')
    <div class="right">
        <div class = "navbar-mobile">
            <img src="images/Logo-with-text.png" alt=""style ="width : 200px;"></img>
        </div>
        <div class="map">
            <div id="map-canvas"></div>

            @if(session('lat'))
                <div class="tracks">
                    <img src="images/black-car.png"alt=""></img>
                    <span>
                        <p>D 400 CC</p>
                        <small>Tersambung Dengan GPS</small>
                    </span>
                    <?php
                        $str=rand();
                        $result = md5($str);
                    ?>
                    <button id="action" class="record">Start Tracking</button>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
<script>
    // tombol connect
    var iconConnect = document.querySelector("#connected");
    var buttonConnect = document.querySelector("#btnconnect");
    var iconDisconnect = document.querySelector("#disconnector");
    var buttonDisconnect = document.querySelector("#btndisconnect");

    
    
    @if(session('lat')) 
        window.lat = {{ session('lat') }};
        window.lng = {{ session('long') }};
        window.zoom = 16;
        buttonDisconnect.addEventListener('mouseover',function(){
        iconDisconnect.setAttribute("src","images/icon-connect2.png");
        });
        buttonDisconnect.addEventListener('mouseout',function(){
        iconDisconnect.setAttribute("src","images/connected.png");
        });
    @else    
        window.lat = -2.994494;
        window.lng = 120.195465;
        window.zoom = 4;
        buttonConnect.addEventListener('mouseover',function(){
        iconConnect.setAttribute("src","images/connected.png");
        });
        buttonConnect.addEventListener('mouseout',function(){
        iconConnect.setAttribute("src","images/icon-connect2.png");
        });
    @endif

    

    var map;
    var mark;
    var lineCoords = [];
    var image;
    
    var initialize = function() {
        map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:zoom});
        
        @if(session('lat')) 
            image = {
                url : '<?= asset("images/ant-design_car-filled.png") ?>',
                scaledSize: new google.maps.Size(30, 30),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(0, 0) 
            } 
            mark = new google.maps.Marker({position:{lat:lat, lng:lng}, map:map, icon:image});
        @endif
    };

    window.initialize = initialize;

    var redraw = function(payload) {
        if(payload.message.lat){
            const lat = payload.message.lat;
            const lng = payload.message.lng;
            map.setCenter({lat:lat, lng:lng, alt:0});
            mark.setPosition({lat:lat, lng:lng, alt:0});
            lineCoords.push(new google.maps.LatLng(lat, lng));
            var lineCoordinatesPath = new google.maps.Polyline({
                path: lineCoords,
                geodesic: true,
                strokeColor: '#2E10FF'
            });
            
            $.ajax({
                type: "GET",
                dataType: "json",
                async: false,
                url: "{{ route('record') }}",
                data : {
                    lat : lat,
                    lng : lng,
                },
                success:function(res) {
                    console.log(res);
                }
            }); 

            lineCoordinatesPath.setMap(map);
        }
    };

    var pnChannel = "raspi-tracker";

    var pubnub = new PubNub({
        publishKey:   'pub-c-b5f29b4d-106d-4f56-a433-bae479c38acd',
        subscribeKey: 'sub-c-6c5b3ed8-86d4-4233-8164-4ab7f349da6b'
    });

    document.querySelector('#action').addEventListener('click', function(){
        var text = document.getElementById("action").textContent;
        if(text == "Start Tracking"){
            pubnub.subscribe({channels: [pnChannel]});
            pubnub.addListener({message:redraw});
            document.getElementById("action").classList.add('btn-danger');
            document.getElementById("action").classList.remove('btn-success');
            // document.getElementById("action").textContent = 'Stop Tracking';
            this.innerHTML = "<div class='loader'><div class='circle'></div></div>";
            setTimeout(() => {
                this.innerHTML = "<i class='fa-solid fa-circle-stop'></i>Stop Tracking";
            }, 1500);
            tracking('mulai', '{{ $result }}');
        }
        else{
            pubnub.unsubscribe( {channels: [pnChannel] });
            document.getElementById("action").classList.remove('btn-danger');
            document.getElementById("action").classList.add('btn-success');
            document.getElementById("action").textContent = 'Start Tracking';
            tracking('stop');
            window.location.reload(true)
        }
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBWDLlrPxQCmqPeo7QcL6t5__Fzx6NO2K4&callback=initialize"></script>
<script>
    // function newPoint() {
    //     var data;
    //     $.ajax({
    //         type: "GET",
    //         dataType: "json",
    //         async: false,
    //         url: "{{ route('record') }}",
    //         success:function(res) {
    //             data = res;
    //         }
    //     });
    //     return data;
    // }

    // setInterval(function() {
    //     pubnub.publish({channel:pnChannel, message:newPoint()});
    // }, 5000);

    function tracking(param1, param2) {
        $.ajax({
            type: "GET",
            url: "{{ route('tracking') }}",
            data : {
                action : param1,
                tripCode : param2,
            },
            success: function (data) {
                console.log('Berhasil');
            },
            error: function (data) {
                console.log('Error');
            }
        });
    }
</script>
@endsection