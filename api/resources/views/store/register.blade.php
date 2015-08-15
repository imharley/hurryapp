@extends('master')

@section('content')
<style type="text/css">
  #map {
        height: 300px;
      }
</style>
<div class="container">
<div class="panel panel-default">
  <div class="panel-heading">Register Store</div>

 <div class="panel-body">
  <form method="post" action="/register">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-sm-6">
      <div class="form-group">
        <label for="name">Store Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      </div>
      <div class="form-group">
        <label for="description">Store Description</label>      
        <textarea class="form-control" id="description" name="description"></textarea>
      </div>
      <div class="form-group">
        <label for="name">Store Hours</label>
        <br/>
        <div class="col-sm-12">
        <label class="">Open</label>
        
          <input type="text" class="form-control" name="open" id="open" placeholder="Open">
        </div>
        <div class="col-sm-12">
        <label class="">Close</label>      
          <input type="text" class="form-control" name="close" id="close" placeholder="Close">
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="name">Store Location</label>
        <br/>
        <div >
        <div class="col-sm-6">
        <label class="">Longtitude</label>
        
          <input type="text" class="form-control" readonly="true" name="longitude" id="longitude" placeholder="Longitude">
        </div>
        <div class="col-sm-6">
        <label class="">Latitude</label>      
          <input type="text" class="form-control" readonly="true" name="latitude" id="latitude" placeholder="Latitude">
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <br/>
          <div class="col-sm-6">
            <p class="help-block">Click on map to get longtitude and latitude.</p>
          </div>
          <div class="col-sm-6">
            <a href="javascript:void(0)" id="id" alt="Reset" onclick="clearMarkers()">Reset Store Location</a>
          </div>
          <div class="clearfix"></div>  
          <div id="map"></div>
        </div>
        <div class="clearfix"></div>
      </div>
      
      
    </div>
<div class="clearfix"></div>

    <button type="submit" class="btn btn-info">Register Now</button>
  </form>
 </div>

   </div>
</div>

@stop

@section('footer')
<script>

    var map;
    var count = 0;
    var markers = [];
    function initMap() { 
       var myLatlng = {lat: 7.071507264234323, lng: 125.60896396636963};

      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: myLatlng
      });

      // This event listener calls addMarker() when the map is clicked.
      google.maps.event.addListener(map, 'click', function(event) {
        if(count == 0){
            addMarker(event.latLng, map);
            var lng = event.latLng.K;
            var lat = event.latLng.G;

            setLatLng(lat,lng);
            count++;   

        }
      });
    }

    function setLatLng(lat,lng){
      var longitude = document.getElementById("longitude");
      longitude.value = lng;

      var latitude = document.getElementById("latitude");
      latitude.value = lat;
    }

    function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers() {
      setMapOnAll(null);
      setLatLng('','');
      count = 0;
    }

    // Adds a marker to the map.
    function addMarker(location, map) {
      // Add the marker at the clicked location, and add the next-available label
      // from the array of alphabetical characters.
      var marker = new google.maps.Marker({
        position: location,        
        map: map
      });
      markers.push(marker);
    }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        async defer></script>
@stop