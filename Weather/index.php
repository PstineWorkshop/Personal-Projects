<?php 
ob_start();

include ('includes/session.php');
include('includes/header.php');

if (isset($_SESSION['user_id'])) {
        echo '<div class="container">
                 <div class =" col-lg-8">
                   <div class =" col-md-6">
                        <img src="images/sun.jpg" class="img-rounded" alt="Cinque Terre" width="304" height="236"
                        id="weatherICON"/>
                    </div>
                    <div class =" col-md-6">
                        <ul style="list-style: none;">
                            <li ><h3 id ="city">City</h3></li>
                            <li ><h3 id = "time"></h3></li>
                             <li ><h3 id = "weather">Weather</h3></li>
                            <li ><h3 id = "humid">Humidity</h3></li>
                            <li><h3 id="summary"></h3></li>
                            <li><h3></h3></li>
                            <li><h3></h3></li>
                        </ul>
                    </div>
              </div>
           <div class =" col-lg-4">
                
                  <div class="formSG">
                   
                    <input size="25" id = "place" name="area" class="locationAuto">
                  </div>
                  <div class="formSG">
                    
                    <input size="25" id="date" type="date" name="area" class="locationAuto" required>
                  </div>
                  
                  <button class="btn btn-default" id = "sub">Submit</button>

           </div>     
      </div><canvas id="myChart" width="400" height="400"></canvas>
      <canvas id="huChart" width="400" height="400"></canvas>
      <canvas id="wiChart" width="400" height="400"></canvas>
      <canvas id="viChart" width="400" height="400"></canvas><p><a href="#top">click here to go back to selection tool</a></p>';

     

}else{
    header("Location:welcome.php");
}

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

      var user_id = <?php 
      if (isset($_SESSION['user_id'])){
          echo $_SESSION['user_id'];}else{
              echo 0;
          }
          ?>;
          
      function initMap() {

       getCurrentLocation();
             
        //**********AUTOCOMPLETE****************//
        place = document.getElementById('place');
       autocomplete = new google.maps.places.Autocomplete(place);
   

     $("#sub").click(function(){

          var placeToCoords = autocomplete.getPlace();
          //alert(placeToCoords.toString());
          var latt =  placeToCoords.geometry.location.lat(),
          lngg=  placeToCoords.geometry.location.lng();

          var date = $("#date").val();
          var dateString = date+"";
          //console.log(date);

        
        //var actuallyLocation= coordsToCity(latt,lngg);
        //console.log(actuallyLocation); 
        //if(date != undefined ){
            //var d = new Date(date);
            
         // }
            
       var city =  $("#place").val();

        var params = {
                        "id":user_id,
                        "lat":latt,
                        "lng":lngg,
                        "date":date+"",
                        "logLocation":city

                      };
          
          coordsToCity(latt,lngg);
           
           if(date == undefined || dateString===""){
           sendDateToDatabase(params);
            weatherTest(latt, lngg);
            
          }else{
           sendDateToDatabase(params);
           weatherTestTwo(latt,lngg,date);
          }
           
         

      }); 
   
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
                         //console.log(coordsToLocation);
                         document.getElementById("city").innerHTML ="<b>City:</b> "+  coordsToLocation;
                        
                    }
                }
            });
            
        }
        
        

      function weatherTest(lat, lng) {
         
         

         var d = new Date();
        var currTime = Math.floor(d.getTime() / 1000);


          var urlWithDate = "https://api.darksky.net/forecast/e337a02845955e88dac1e0b8650197d6/" + lat + ","+ lng+","+currTime;
          
          
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
              
              //var d= new Date(time * 1000);
          
             // document.getElementById("city").innerHTML ="<b>City:</b> "+  coordsToLocation;
              document.getElementById("time").innerHTML = "<b>Time:</b>"+date2;
              document.getElementById("weather").innerHTML =  "<b>Temp:</b>"+temp_f;
              document.getElementById("humid").innerHTML = "<b>Humidity:</b>"+h;
              
              document.getElementById("weatherICON").src=imageSRC;
              document.getElementById("summary").innerHTML="<b>Daily summary: </b>"+sum;
             

                }
             });
          
      }
      
   
      
      function weatherTestTwo(lat, lng,date) {
          //console.log("the date was not undefined");
          //console.log("date is: "+ date);
        var d = new Date(date);
        var currTime = Math.floor(d.getTime() / 1000);
        var allTemp ="";
        var allHum=" ";
        var allWind=" ";
        var allVis=" ";
        var allTime=" ";

        
        var urlWithDate = "https://api.darksky.net/forecast/e337a02845955e88dac1e0b8650197d6/" + lat + ","+ lng+","+currTime+"?exclude=minutely,alerts,flags";
        $.ajax({
              url : urlWithDate,
              dataType : "jsonp",
              success : function(parsed_json) {
              var location = parsed_json['timezone'];
              var temp_f = parsed_json['currently']['temperature'];
              var time = parsed_json['currently']['time'];
              var date2 = new Date(time);
              var h =  parsed_json['currently']['humidity'];
              var icon = parsed_json['currently']['icon']; 
              var sum=parsed_json['daily']['data'][0].summary;
              var hourTime=parsed_json['daily']['data'][0].time;

              var example=parsed_json['daily']['data'][1];
              //console.log(example);
              
              var newDate= new Date(hourTime*1000);
              
              
                     
              var imageSRC= "images/"+icon+".jpg";
              
              document.getElementById("time").innerHTML = "<b>Time:</b>"+newDate;
              document.getElementById("weather").innerHTML =  "<b>Temp:</b>"+temp_f;
              document.getElementById("humid").innerHTML = "<b>Humidity:</b>"+h;
              document.getElementById("weatherICON").src=imageSRC;
              document.getElementById("summary").innerHTML="<b>Daily summary: </b>"+sum;
              

              for(i=0;i<9;i++){
                  allTemp+= parsed_json['hourly']['data'][i].temperature+" ";
                }
              for(i=0;i<9;i++){
                allHum+= parsed_json['hourly']['data'][i].humidity+" ";
              }
              for(i=0;i<9;i++){
                allWind+= parsed_json['hourly']['data'][i].windSpeed+" ";
              }
              for(i=0;i<9;i++){
                allVis+= parsed_json['hourly']['data'][i].visibility+" ";
              }
              


              for(i=0;i<23;i++){
                allTime+= parsed_json['hourly']['data'][i].time+" ";
              }
                //console.log("All temperature: "+ allTemp);
                //console.log("All Hum: "+ allHum);
                //console.log("All win: "+ allWind);
                //console.log("All visibility: "+ allVis);
               // console.log("All time: "+ allTime);
                //temperature
                //humidity
                //windspeed
                //visibility
                createCharts(allTemp,allHum,allWind,allVis,allTime);
              }
             });
          
       

      }//end of weathertwo



      function sendDateToDatabase(params) {
         
          $.ajax({
            type: "POST",
            url: "save_history.php",
            data: params,
            success: success
          });

          function success(data) {
            //console.log(data);
          }
      }
      function createCharts(allTemp,allHum,allWind,allVis,allTime){
        //console.log(allTemp);
        var temp=allTemp.split(" ");
        var hum=allHum.split(" ");
        var win=allWind.split(" ");
        var visibility=allVis.split(" ");
        var timeHourly=allTime.split(" ");
        var tempString="";
        
        for(i=0;i<timeHourly.length-1;i++){
          
          var x= parseInt(timeHourly[i]);
          var time= new Date(x);
          
          tempString+=time.getHours()+":"+time.getMinutes()+":"+time.getSeconds();
          //console.log(tempString);
          timeHourly[i]=tempString;
          tempString="";
         
        }
        
        
        var ctx = document.getElementById("myChart");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: [timeHourly[1],timeHourly[2],
              timeHourly[3],timeHourly[4],timeHourly[5],timeHourly[6]
              ,timeHourly[7],timeHourly[8]],
                  datasets: [{
                      label: 'Temperature during the hour',
                      data: [temp[1],temp[2],temp[3],temp[4],
                      temp[5],temp[6],temp[7],temp[8],],
                      
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
          });
          var ctx = document.getElementById("huChart");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: [timeHourly[1],timeHourly[2],
              timeHourly[3],timeHourly[4],timeHourly[5],timeHourly[6]
              ,timeHourly[7],timeHourly[8]],
                  datasets: [{
                      label: 'Humidity during the hour',
                      data: [hum[1],hum[2],hum[3],hum[4],
                      hum[5],hum[6],hum[7],hum[8],],
                      
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
          });
          var ctx = document.getElementById("wiChart");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: [timeHourly[1],timeHourly[2],
              timeHourly[3],timeHourly[4],timeHourly[5],timeHourly[6]
              ,timeHourly[7],timeHourly[8]],
                  datasets: [{
                      label: 'Windspeed during the hour',
                      data: [win[1],win[2],win[3],win[4],
                      win[5],win[6],win[7],win[8],],
                      
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
          });
          var ctx = document.getElementById("viChart");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: [timeHourly[1],timeHourly[2],
              timeHourly[3],timeHourly[4],timeHourly[5],timeHourly[6]
              ,timeHourly[7],timeHourly[8]],
                  datasets: [{
                      label: 'Visibility during the hour',
                      data: [visibility[1],visibility[2],visibility[3],
                      visibility[4],
                      visibility[5],visibility[6],visibility[7],visibility[8],],
                      
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero:true
                          }
                      }]
                  }
              }
          });
      }//end of function

      /*var myChart = new Chart(ctx, {
          type: 'bar',
          data {
            labels: [
              timeHourly[0],timeHourly[1],timeHourly[2],
              timeHourly[3],timeHourly[4],timeHourly[5],timeHourly[6]
              ,timeHourly[7],,timeHourly[8]
            ],
            datasets:[
              {
                data:['40','43','55','66','89','101','104','39']
              }

            ]
          }

        });*/
     /* //format time
      function msToTime(s) {
          return new Date(s).toISOString().slice(11, -1);
        }*/
            
  </script>
 
<?php
include ('includes/footer.html');
?>