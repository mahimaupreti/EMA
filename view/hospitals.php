<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nearby Hospitals</title>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcXQeUOO3dylSTpeTaNOnUEkExnanSmvY&libraries=places"></script>
  <style>
    #map {
      height: 450px;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .container {
      max-width: 900px;
      margin: auto;
      padding: 30px;
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .info {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🏥 Nearby Hospitals</h2>
  <p class="info">This map displays hospitals near your current location.</p>
  <div id="map"></div>
</div>

<script>
function initMap() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
      const userLocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      const map = new google.maps.Map(document.getElementById("map"), {
        center: userLocation,
        zoom: 14,
      });

      new google.maps.Marker({
        position: userLocation,
        map,
        title: "Your Location",
        icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
      });

      const service = new google.maps.places.PlacesService(map);
      service.nearbySearch({
        location: userLocation,
        radius: 5000,
        type: ['hospital']
      }, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          const infoWindow = new google.maps.InfoWindow(); // Create one info window outside the loop

results.forEach(place => {
  const marker = new google.maps.Marker({
    map,
    position: place.geometry.location,
    title: place.name,
    icon: "https://maps.google.com/mapfiles/kml/shapes/hospitals.png" // Hospital icon
  });

  marker.addListener("click", () => {
    infoWindow.setContent(`<strong>${place.name}</strong><br>${place.vicinity || ''}`);
    infoWindow.open(map, marker);
  });
});

        } else {
          alert("No hospitals found or service error.");
        }
      });
    }, () => {
      alert("Failed to get your location.");
    });
  } else {
    alert("Geolocation is not supported by your browser.");
  }
}

window.onload = initMap;
</script>

</body>
</html>
