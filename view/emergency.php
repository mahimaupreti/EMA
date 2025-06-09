
<div class="center">
  <h2>🚨 Emergency Help</h2>
  <a href="tel:112"><button>📞 Call Emergency (112)</button></a>
  <p><strong>Your Current Location & Nearby Hospitals:</strong></p>
  <div id="map"></div>
</div>

<style>
  #map {
    height: 400px;
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.2);
  }
  .center {
    text-align: center;
    padding: 20px;
  }
  button {
    background-color: red;
    color: white;
    padding: 15px 25px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    margin-bottom: 20px;
    cursor: pointer;
  }
</style>

<!-- Google Maps API script with your API key -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcXQeUOO3dylSTpeTaNOnUEkExnanSmvY&libraries=places"></script>

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
        title: "You are here",
        icon: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
      });

      const service = new google.maps.places.PlacesService(map);
      service.nearbySearch({
        location: userLocation,
        radius: 5000,
        type: ['hospital']
      }, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          results.forEach(place => {
            new google.maps.Marker({
              map,
              position: place.geometry.location,
              title: place.name
            });
          });
        }
      });
    }, () => {
      alert("Unable to fetch location.");
    });
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

window.onload = initMap;
</script>
