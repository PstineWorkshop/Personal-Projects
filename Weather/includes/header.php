<html lang="en">
<head>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
        
    <!-- Bootstrap theme -->
    <!-- -->
	<link href="css/theme.css" rel="stylesheet" /> 
	<link href="css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="css/own.css" rel= "stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Bungee+Inline|Merriweather" rel="stylesheet">
  <script type="text/javascript" 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9z57PhrBd5wfNx5vABiF5SNPC-4Gjz9g&libraries=places" async defer>
    //http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false
    //AIzaSyDRteU9iGmsi5VRUcSx44YcldgDdDJd3Lw
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.js">
      
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js">
      
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js">
      
    </script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js">
      
    </script>

    <!--<script type="text/javascript" src="js/mapsWeather.js"> </script>-->

    <!-- Custom CSS -->
	<!-- 
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> 
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700"> 
	<link rel="stylesheet" href="css/otherstyle.css"> 
	-->
    
    <title><?php echo $page_title; ?></title>	
    
       <?php date_default_timezone_set('America/Chicago'); 
        
        //echo date("l, Y - g:ia", time());

       ?>

        <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body role="document">

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>

          </button>

          <a class="navbar-brand" href="#"><?php echo $user_name ?></a>
        </div>
        <div class="navbar-collapse collapse">
                <!-- Bootstrap theme col-md-3 search bar   type="submit"    -->
          <div class="col-sm-3  pull-left">
        
             
        
        </div>
        <!-- Bootstrap theme                  -->
         

          <ul class="nav navbar-nav">

             <li><a href="index.php">Home</a></li>

          
       
			<?php 
			
      if (!isset($_SESSION['user_id'])) {
				echo '<li><a href="register.php">Register</a></li> ';
				echo '<li><a href="login.php">Sign In</a></li>';
        
        
			}
			else
			{
				$user = $_SESSION['user_id'];
        
				echo '<li><a href="history.php">History</a></li>';
				echo '<li><a href="password.php">Change Password</a></li>';
				echo '<li><a href="logout.php">Log Out</a></li>';
        

			}
        
        
       

			?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
   
    <div class="container theme-showcase" role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
          <!-- Start of the page-specific content. -->
<!-- Script 8.1 - header.html -->

     <h1 id="top "style="text-align:center;">SkyCast Weather App</h1>
