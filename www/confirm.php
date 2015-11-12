<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Confirmation</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>    
    <img id="logo" src="images/logo.png" alt=" On Point Logo" class="img-responsive center-block"/>
    
    <nav class="navbar navbar-inverse navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">On Point Detailing</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index.html">Home</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="about.html">About</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <?php

      include_once('DBInfo.config');
      /*$db = new mysqli($server,$user,$password,$db);

      if($db->connect_errno > 0){
        die('Unable to connect to database [' . $db->connect_error . ']');
      }
      if(isset($_POST['submit']))
      {
        $date = date("Y-m-d", strtotime($_POST['date']));
        */$fname = $_POST['fname'];
        $lname = $_POST['lname'];
        /*$email = $_POST['email'];
        $phone = $_POST['phonenum'];
        $vehicle = $_POST['model'];
        $time = $_POST['time'];
        */$service = $_POST['service'];/*

        $query = "insert into appointments (fname,lname,email,phone,vehicle,date,time,service) values ('$fname','$lname','$email','$phone','$vehicle','$date','$time','$service')";

        $db->query($query);

        $db->close();
      }*/
      ini_set('display_errors', 1);
      ini_set('display_startup_errors', 1);
      error_reporting(E_ALL);

      $summary = $fname." ".$lname." ".$service;


        require_once ('google-api-php-client/vendor/autoload.php');

        define('SCOPES', implode(' ', array(Google_Service_Calendar::CALENDAR)));
        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setAuthConfigFile("client_secrets.json");
        $client->setScopes(SCOPES);
        $service = new Google_Service_Calendar($client);
        $event = new Google_Service_Calendar_Event(array(
        'summary' => $summary,
        'location' => 'Scottsdale',
        'description' => 'All Info',
        'start' => array(
        'dateTime' => '2015-11-25T08:00:00-07:00',
        'timeZone' => 'America/Phoenix',
        ),
        'end' => array(
        'dateTime' => '2015-11-25T09:00:00-07:00',
        'timeZone' => 'America/Phoenix',
        ),
        'attendees' => array(
        array('email' => 'test@test.com'),
        ),
        'reminders' => array(
        'useDefault' => FALSE,
        ),
        ));
        $calendar_id = $calendarID;
        $event = $service->events->insert($calendar_id, $event);
      ?>
      <div class="starter-template">
        <h2>Your appointment has been scheduled! We sent a confirmation email to <?php echo $_POST['email']; ?></h2>
        <h3>If you did not receieve an email please contact us to make sure your appointment was entered in the system.</h3>
      </div>

    </div><!-- /.container -->

    <div id="footer">   
	    <div id= "community">
			<td> Community </td>
				<p>
					<td><img src="images/facebook.ico" alt=" Facebook Icon" /></td>
					<td><img src="images/twitter.ico" alt=" Twitter Icon" /></td>
					<td><img src="images/instagram.ico" alt=" Instagram Icon" /></td>
				</p>   
	    </div>
	   
		<div id="information">
			<p> Scottsdale, Arizona </p>
			<p> 480-707-7744</p>
			<p> Be sure to check us out on Instagram</p>
			<p> @OnPointDetailing_Az</p>
		</div>
		
		<div id="paymentoptions"> 
			<td> Payment Options </td>
				<p>
				   <td><img src="images/cash.ico" alt="Cash Icon" /></td>
				   <td><img src="images/check.ico" alt="Check Icon" /></td>
				   <td><img src="images/visa.ico" alt="Visa Icon" /></td>
				   <td><img src="images/mastercard.ico" alt="Mastercard Icon" /></td>
				</p>	
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
