<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="css/map.css">
    <link rel="stylesheet" href="css/panel.css">
    <link rel="stylesheet" href="css/index.css">
    
    <title>AV TRACKER</title>
</head>
<body>
    <div class="split-screen">
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
                            <button class="connector">
                                <img src="images/icon-connect.png" alt=""></img>
                                <p>Sambungkan</p>
                            </button>
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
        <div class="right">
            <div class="map"> 
                <div class="mapouter">
                    <div class="gmap_canvas">
                        <iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=cibiru&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        <a href="https://putlocker-is.org">putlocker</a><br />
                        <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
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
    </div>
</body>
</html>