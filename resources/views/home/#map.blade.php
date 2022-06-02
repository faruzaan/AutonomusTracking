<div class="gmap_canvas">
    <div id="mapid"></div>
</div>
<script>
    @if(session('lat')) 
        var map = L.map('mapid').setView([{{ session('lat') }}, {{ session('long') }}], 17);
    @else    
        var map = L.map('mapid').setView([-2.994494, 120.195465], 4);
    @endif

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var greenIcon = L.icon({
        iconUrl: '<?= asset("images/ant-design_car-filled.png") ?>',
        
        iconSize: [30, 30], // size of the icon
    });

    @if(session('lat'))
        var marker = L.marker([{{ session('lat') }}, {{ session('long') }}], {icon : greenIcon}).addTo(map).bindPopup('<small style="color:black;">Kamu Berada Disini</small>').openPopup();
    @endif
    var latlngs = [
        [-6.914744, 107.609810],
        [-6.914744, 107.709810],
        [-6.914744, 107.609810],
        [-6.914744, 107.709810]
    ];
    var polyline = L.polyline(latlngs, {color: 'red'});
    polyline.addTo(map);
</script>