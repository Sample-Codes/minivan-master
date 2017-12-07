"use_strict";

var geoboxSelector = document.getElementById('reactive-geobox');

if (geoboxSelector !== null) {
  var initLat = document.getElementById('latitude').value;
  var initLng = document.getElementById('longitude').value;

  function loadMap() {
    // if (initLat !== '' && initLng !== '') {
      var myLatLng = {lat: initLat, lng: initLng};
      var latlng = new google.maps.LatLng(initLat, initLng);
      var myOptions = {
        zoom: 13,
        center: latlng,
      // mapTypeControl: true,
      // mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
      // navigationControl: true,
        // mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("map"), myOptions);

      var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        draggable: true,
      });
    // }

      google.maps.event.addListener(marker,'dragend',function(event) {

        document.getElementById('latitude').value = event.latLng.lat();
        document.getElementById('longitude').value = event.latLng.lng();

        var location = {lat: parseFloat(event.latLng.lat()), lng: parseFloat(event.latLng.lng())};
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': location }, (responses) => {
          if (responses) {
            var result = responses[0];
            document.getElementById('pac-input').value = result.formatted_address;

            for (var i = 0; i < result.address_components.length; i++) {
              var addressType = result.address_components[i].types[0];

              if (addressType === 'locality') {
                document.getElementById('city').value = result.address_components[i]['long_name'];
              }

              if (addressType === 'country') {
                document.getElementById('country').value = result.address_components[i]['long_name'];
                document.getElementById('country_short_name').value = result.address_components[i]['short_name'];
              }

              if (addressType === 'administrative_area_level_1') {
                document.getElementById('state').value = result.address_components[i]['long_name'];
                document.getElementById('state_short_name').value = result.address_components[i]['short_name'];
              }

              if (addressType === 'postal_code') {
                document.getElementById('zipcode').value = result.address_components[i]['long_name'];
              }
            }
          }
          // infowindow.setContent('<div style="width: 180px;"><strong>' + result.formatted_address + '</strong></div>');
          // infowindow.open(map, marker);
        });
      });

      var input = /** @type {!HTMLInputElement} */(
      document.getElementById('pac-input'));

    var autocomplete = new google.maps.places.Autocomplete(input);

    // var infowindow = new google.maps.InfoWindow();
    
    autocomplete.addListener('place_changed', function() {
      // infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }

      // marker.setIcon(/** @type {google.maps.Icon} */({
      //   url: place.icon,
      //   size: new google.maps.Size(71, 71),
      //   origin: new google.maps.Point(0, 0),
      //   anchor: new google.maps.Point(17, 34),
      //   scaledSize: new google.maps.Size(35, 35),
      // }));
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }

      // Get each component of the address from the place details
      // and fill the corresponding field on the form.
      for (var i = 0; i < place.address_components.length; i++) {
        
        var addressType = place.address_components[i].types[0];
        
        if (addressType === 'locality') {
          document.getElementById('city').value = place.address_components[i]['long_name'];
        }

        if (addressType === 'country') {
          document.getElementById('country').value = place.address_components[i]['long_name'];
          document.getElementById('country_short_name').value = place.address_components[i]['short_name'];
        }

        if (addressType === 'administrative_area_level_1') {
          document.getElementById('state').value = place.address_components[i]['long_name'];
          document.getElementById('state_short_name').value = place.address_components[i]['short_name'];
        }

        if (addressType === 'postal_code') {
          document.getElementById('zipcode').value = place.address_components[i]['long_name'];
        }
      }

      document.getElementById('latitude').value = place.geometry.location.lat();
      document.getElementById('longitude').value = place.geometry.location.lng();

      // infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      // infowindow.open(map, marker);

      google.maps.event.addListener(marker,'dragend',function(event) {

        document.getElementById('latitude').value = event.latLng.lat();
        document.getElementById('longitude').value = event.latLng.lng();

        var location = {lat: parseFloat(event.latLng.lat()), lng: parseFloat(event.latLng.lng())};
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': location }, (responses) => {
          if (responses) {
            var result = responses[0];
            
            document.getElementById('pac-input').value = result.formatted_address;

            for (var i = 0; i < result.address_components.length; i++) {
              var addressType = result.address_components[i].types[0];

              if (addressType === 'locality') {
                document.getElementById('city').value = result.address_components[i]['long_name'];
              }

              if (addressType === 'country') {
                document.getElementById('country').value = result.address_components[i]['long_name'];
                document.getElementById('country_short_name').value = result.address_components[i]['short_name'];
              }

              if (addressType === 'administrative_area_level_1') {
                document.getElementById('state').value = result.address_components[i]['long_name'];
                document.getElementById('state_short_name').value = result.address_components[i]['short_name'];
              }

              if (addressType === 'postal_code') {
                document.getElementById('zipcode').value = result.address_components[i]['long_name'];
              }
            }
          }
          // infowindow.setContent('<div style="width: 180px;"><strong>' + result.formatted_address + '</strong></div>');
          // infowindow.open(map, marker);
        });
      });
    });


    // prevent enter key press
    var input = document.getElementById('pac-input');
    google.maps.event.addDomListener(input, 'keydown', function(e) {
      if (e.keyCode === 13) {
        e.preventDefault();
      }
    });
  }
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });

    var input = /** @type {!HTMLInputElement} */(
      document.getElementById('pac-input'));

    var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

    // var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29),
      draggable:true,
    });

    autocomplete.addListener('place_changed', function() {
      // infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
      }

      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
      }

      marker.setIcon(/** @type {google.maps.Icon} */({
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(35, 35),
      }));
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);

      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }

      // Get each component of the address from the place details
      // and fill the corresponding field on the form.
      for (var i = 0; i < place.address_components.length; i++) {
        
        var addressType = place.address_components[i].types[0];
        
        if (addressType === 'locality') {
          document.getElementById('city').value = place.address_components[i]['long_name'];
        }

        if (addressType === 'country') {
          document.getElementById('country').value = place.address_components[i]['long_name'];
          document.getElementById('country_short_name').value = place.address_components[i]['short_name'];
        }

        if (addressType === 'administrative_area_level_1') {
          document.getElementById('state').value = place.address_components[i]['long_name'];
          document.getElementById('state_short_name').value = place.address_components[i]['short_name'];
        }

        if (addressType === 'postal_code') {
          document.getElementById('zipcode').value = place.address_components[i]['long_name'];
        }
      }

      document.getElementById('latitude').value = place.geometry.location.lat();
      document.getElementById('longitude').value = place.geometry.location.lng();

      // infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
      // infowindow.open(map, marker);

      google.maps.event.addListener(marker,'dragend',function(event) {

        document.getElementById('latitude').value = event.latLng.lat();
        document.getElementById('longitude').value = event.latLng.lng();

        var location = {lat: parseFloat(event.latLng.lat()), lng: parseFloat(event.latLng.lng())};
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': location }, (responses) => {
          if (responses) {
            var result = responses[0];
            document.getElementById('pac-input').value = result.formatted_address;

            for (var i = 0; i < result.address_components.length; i++) {
              var addressType = result.address_components[i].types[0];

              if (addressType === 'locality') {
                document.getElementById('city').value = result.address_components[i]['long_name'];
              }

              if (addressType === 'country') {
                document.getElementById('country').value = result.address_components[i]['long_name'];
                document.getElementById('country_short_name').value = result.address_components[i]['short_name'];
              }

              if (addressType === 'administrative_area_level_1') {
                document.getElementById('state').value = result.address_components[i]['long_name'];
                document.getElementById('state_short_name').value = result.address_components[i]['short_name'];
              }

              if (addressType === 'postal_code') {
                document.getElementById('zipcode').value = result.address_components[i]['long_name'];
              }
            }
          }
          // infowindow.setContent('<div style="width: 180px;"><strong>' + result.formatted_address + '</strong></div>');
          // infowindow.open(map, marker);
        });
      });
    });
    // prevent enter key press
    var input = document.getElementById('pac-input');
    google.maps.event.addDomListener(input, 'keydown', function(e) {
      if (e.keyCode === 13) {
        e.preventDefault();
      }
    });
  }

  // initMap();
  if (initLat !== '' && initLng !== '') {
    google.maps.event.addDomListener(window, 'load', loadMap);
  } else {
    google.maps.event.addDomListener(window, 'load', initMap);
  }
}
