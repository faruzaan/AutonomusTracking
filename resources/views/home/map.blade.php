<div class="gmap_canvas">
    <div id="mapid"></div>
</div>
<script>
    @if(session('lat')) 
        var map = L.map('mapid').setView([{{ session('lat') }}, {{ session('long') }}], 17);
    @else    
        var map = L.map('mapid').setView([-2.994494, 120.195465], 5);
    @endif

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var greenIcon = L.icon({
        iconUrl: '<?= asset("images/ant-design_car-filled.png") ?>',
        
        iconSize: [30, 30], // size of the icon
    });

    @if(session('lat'))
        var marker = L.marker([-6.941699466981278, 107.72315740585327], {icon : greenIcon}).addTo(map).bindPopup('<small style="color:black;">Kamu Berada Disini</small>').openPopup();
    @endif
</script>