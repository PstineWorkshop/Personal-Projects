


var map, infoWindow;
      var geocoder;
var locArray;     
   
function initMap() {
   
    getLocation();
    function getLocation() {
        if (navigator.geolocation) {
             navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            alert("navigation not supported by this server");
        }
    }
    function showPosition(position) {
        locArray = {lat:position.coords.latitude,lng:position.coords.longitude}; 
       console.log( "ello");
        weatherTest(locArray.lat, locArray.lng);
}
   
       //**********AUTOCOMPLETE****************//
        var place = document.getElementById('place');
        var autocomplete = new google.maps.places.Autocomplete(place);
    
}

      

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

    
function callback(results, status) {
	  if (status == google.maps.places.PlacesServiceStatus.OK) {
	    for (var i = 0; i < results.length; i++) {
	      var place = results[i];
	      createMarker(results[i]);
	    }
	  }
    }

function weatherTest(lat, lng) {

		
        //Grabs the longitude and latitude
        //Makes the request
        $.ajax({
		    url : "https://api.darksky.net/forecast/e337a02845955e88dac1e0b8650197d6/" + lat + ","+ lng+"?exclude=minutely,hourly,daily,alerts,flags",
		    dataType : "jsonp",
		    success : function(parsed_json) {
		    var location = parsed_json['timezone'];
		    var temp_f = parsed_json['currently']['temperature'];
                    var time = parsed_json['currently']['time'];
                    var h =  parsed_json['currently']['v']; 
                   
                   
		    
		    document.getElementById("city").innerHTML = location;
                    document.getElementById("time").innerHTML = time;
                    document.getElementById("weather").innerHTML = temp_f;
                    document.getElementById("humid").innerHTML = h;
		}
        });
    
}

