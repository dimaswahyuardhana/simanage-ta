// console.log(profileAdmin[0]['longitude'])

mapboxgl.accessToken = 'pk.eyJ1IjoiZmFuaWVsMDciLCJhIjoiY2xpYnRvZnVpMGE5cTNmbXU1d3k0bm0zYSJ9.QN1E4XUHuvam_iMNd8GhnA';

var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [profileAdmin[0]['longitude'], profileAdmin[0]['latitude']], // Pusat peta awal
    zoom: 13 // Tingkat zoom awal
});

var marker = new mapboxgl.Marker();

marker.setLngLat([profileAdmin[0]['longitude'], profileAdmin[0]['latitude']]).addTo(map);

function searchLocation() {
    var searchInput = document.getElementById('search').value;

    var alamat = document.getElementById('alamat');
    alamat.value = searchInput;
    var alamat = document.getElementById('alamatHidden');
    alamatHidden.value = searchInput;

    // Permintaan geokoding menggunakan Mapbox Geocoding API
    fetch(
        `https://api.mapbox.com/geocoding/v5/mapbox.places/${searchInput}.json?access_token=${mapboxgl.accessToken}`
    )
        .then(response => response.json())
        .then(data => {
            if (data && data.features && data.features.length > 0) {
                var coordinates = data.features[0].center; // Koordinat lokasi pertama
                // console.log(coordinates)
                // Posisikan peta pada lokasi yang ditemukan
                map.flyTo({
                    center: coordinates,
                    zoom: 13
                });

                // Tampilkan marker pada lokasi yang ditemukan
                marker.setLngLat(coordinates).addTo(map);

                long = document.getElementById('longitude');
                long.value = coordinates[0];
                lat = document.getElementById('latitude');
                lat.value = coordinates[1];
            } else {
                console.log('Lokasi tidak ditemukan.');
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        });
}

// map.on('click', function (e) {
//     var clickedCoordinates = e.lngLat;
//     var latitude = clickedCoordinates.lat;
//     var longitude = clickedCoordinates.lng;

//     // Gunakan nilai latitude dan longitude yang didapatkan sesuai kebutuhan Anda
//     console.log('Latitude: ' + latitude + ', Longitude: ' + longitude);

//     // Atur nilai latitude dan longitude pada input form
//     document.getElementById('latitude').value = latitude;
//     document.getElementById('longitude').value = longitude;
// });
