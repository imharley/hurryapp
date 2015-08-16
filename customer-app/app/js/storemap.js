function initMap(stores) {
    var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 0, lng: 0},
    zoom: 16,
    disableDefaultUI: true,
    mapTypeControl: false,

  });

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {

      var glat = position.coords.latitude,
          glng = position.coords.longitude;

      var pos = {
        lat: glat,
        lng: glng
      };

      image = 'images/you-pin.png';
      var marker = new google.maps.Marker({
  	    position: pos,
  	    map: map,
  	    title: 'You Are Here',
        icon: image,
  	  });

      var locations = stores;
      image = 'images/store-pin.png';
      image_close = 'images/store-pin-close.png';
  	  for (i = 0; i < locations.length; i++) {
      	marker = new google.maps.Marker({
          position: new google.maps.LatLng( locations[i].store_location.latitude, locations[i].store_location.longitude ),
  	      map: map,
          icon: ( locations[i].status ) ? image : image_close,
  	      title: locations[i].store_name
        });
     
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            showinfo(locations[i]);
          }
        })(marker, i));
      }
      
      map.setCenter(pos);

    });

  } else {
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your device doesn\'t support geolocation.');
}

function showinfo( data ) {
  console.log(data);
  // Update store details
  $('.store-details').css({ 'bottom' : -60});
  var store_status = (data.status == 1) ? 'open' : 'close';

  if (data.status == 1) {
    $('.store-order').attr('href', '#/order/' + data.id).show();
  } else {
    $('.store-order').hide();
  }

  $('.store-name').text(data.store_name);
  $('.store-desc').text(data.store_description);
  $('.store-hours')
      .find('.store-open').text(data.store_hours.open)
      .parent().find('.store-close').text(data.store_hours.close)
      .parent().find('.store-status').text(store_status);
  $('.store-details').delay(300).css({ 'bottom' : 60});
}

//jquery actions
$(function() {
  var store_data = '';

  $.get( domain + "/api/customer/stores/", function( data ) {
    initMap(data);
    store_data = data;
  });

  var reload_tpl = function() {
    $('#map, #dashbaord').css({'width':$(window).width(), 'height':$(window).height()});
  };

  $(window).resize(function() {
    reload_tpl();
  }).resize();
});