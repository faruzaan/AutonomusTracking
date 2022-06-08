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
                <br><a href="{{route('home')}}">Kembali</a>
            </div>

            <div class="result">
                @foreach ($trips as $item)                    
                    <div class="box">
                        <img src="images/car-icon.png" alt="" class="car"></img>
                        <div class="identity">
                            <p>Riwayat Perjalanan Pada</p>
                            <small> {{ $item->created_at->format('d F Y h:i:s A') }} </small>
                        </div>
                    </div>
                @endforeach
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
            <div id="map-canvas"></div>
        </div>
    </div>
@endsection

@section('js')
<script>
    window.lat = -2.994494;
    window.lng = 120.195465;
    window.zoom = 5;

    var map;
    
    var initialize = function() {
        map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:zoom});
        
        const flightPlanCoordinates = [
            @foreach ($records as $item)
                { lat: {{ $item->lat }}, lng: {{ $item->long }} },
            @endforeach
        ];

        const flightPath = new google.maps.Polyline({
            path: flightPlanCoordinates,
            geodesic: true,
            strokeColor: "#FF0000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
        });

        flightPath.setMap(map);
    };

    window.initialize = initialize;
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBWDLlrPxQCmqPeo7QcL6t5__Fzx6NO2K4&callback=initialize"></script>
@endsection