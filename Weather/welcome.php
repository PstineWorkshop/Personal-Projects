<?php
include ('includes/header.php');
echo '<div class="container">
           <div class =" col-lg-8">
                   <div class =" col-md-6">
                        <img src="images/sun.jpg" class="img-rounded" alt="Cinque Terre" width="304" height="236" id="weatherICON"/>
                    </div>
                    <div class =" col-md-6">
                        <ul style="list-style: none;">
                            <li ><h3 id ="city">City</h3></li>
                            <li ><h3 id = "time"></h3></li>
                             <li ><h3 id = "weather">Weather</h3></li>
                            <li ><h3 id = "humid">Humidity</h3></li>
                            <li><h3 id="summary"></h3></li>
                            <li><h3><a href="register.php">To change the current weather output create an account by either clicking this or navigate to register</a></h3></li>
                            <li><h3></h3></li>
                        </ul>
                    </div>
              </div>
           <div class =" col-lg-4">

             <input size="25" id = "place" hidden>
             <input size="25" id="date"hidden>
             <button  id = "sub" hidden>Submit</button>
           </div>     
        </div>';
?>

 <script type="text/javascript">
      
      $( document ).ready(function() {
       initMap();
    });
      
       var infoWindow;
       var geocoder;
      var locArray;  
      var autocomplete;
       var place;
   

      function initMap() {
         
    getCurrentLocation();
      
      }
      
      
        
         function getCurrentLocation(){
          var cityArr;
           $.ajax({
              url : "http://ip-api.com/json",
              dataType : "jsonp",
              success : function(parsed_json) {
               
               
                cityArr = {lat:parsed_json['lat'],lng:parsed_json['lon']};
                
                coordsToCity(cityArr.lat,cityArr.lng);
              weatherTest(cityArr.lat,cityArr.lng);
                }
             });
          
      }
      
      function coordsToCity(latt,lngg){
          
          var coords = {lat:latt,lng:lngg};
         var coordsToLocation;

           
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': coords }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) { 
                    
                    if (results[1]) {
                         var c = results[0].address_components[3].long_name;
                        
                          
                          var s = results[0].address_components[5].short_name;
                        //var s="";
                         
                         var  z = results[0].address_components[7].long_name;
                         //var z="";
                         var co = results[0].address_components[6].short_name;
                         //var co="";
                         coordsToLocation = c+","+s+","+z+","+co;
                         console.log(coordsToLocation);
                         document.getElementById("city").innerHTML ="<b>City:</b> "+  coordsToLocation;
                        
                    }
                }
            });
            
        }

      function weatherTest(lat, lng) {
       
         

         var d = new Date();
        var currTime = Math.floor(d.getTime() / 1000);


          var urlWithDate = "https://api.darksky.net/forecast/e337a02845955e88dac1e0b8650197d6/" + lat + ","+ lng+","+currTime;
          console.log("changed3");
          
          var urlWithoutDate ="https://api.darksky.net/forecast/e337a02845955e88dac1e0b8650197d6/" + lat + ","+ lng+"?exclude=minutely,alerts,flags";
          
              //Grabs the longitude and latitude
              //Makes the request
              $.ajax({
              url : urlWithoutDate,
              dataType : "jsonp",
              success : function(parsed_json) {
              var location = parsed_json['timezone'];
              var temp_f = parsed_json['currently']['temperature'];
              var time = parsed_json['currently']['time'];
              var date2 = new Date(currTime*1000);
              var h =  parsed_json['currently']['humidity'];
              var icon = parsed_json['currently']['icon']; 
              var sum=parsed_json['daily']['data'][0].summary;

              
                     
              var imageSRC= "images/"+icon+".jpg";
              
              
              document.getElementById("time").innerHTML = "<b>Time:</b>"+date2;
              document.getElementById("weather").innerHTML =  "<b>Temp:</b>"+temp_f;
              document.getElementById("humid").innerHTML = "<b>Humidity:</b>"+h;
              
              document.getElementById("weatherICON").src=imageSRC;
              document.getElementById("summary").innerHTML="<b>Daily summary: </b>"+sum;
             

                }
             });
          
      }
    
  </script>
 
<?php
include ('includes/footer.html');
?>