<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/smalllogo.png">

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
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);


        include_once('DBInfo.config');
        date_default_timezone_set("America/Phoenix");
        $date = date("Y-m-d", strtotime($_POST['date']));
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phonenum'];
        $vehicle = $_POST['model'];
        $time = $_POST['time'];
        $service = $_POST['service'];

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $summary = $fname." ".$lname." ".$service." ".$phone." ".$vehicle;

        $startdatetime = $date."T".$time.":00-07:00";

        $unixstartime =  strtotime($startdatetime);

        $unixendtime = strtotime('+1 hour', $unixstartime);

        $enddatetime = date("c",$unixendtime);

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
        'dateTime' => $startdatetime,
        'timeZone' => 'America/Phoenix',
        ),
        'end' => array(
        'dateTime' => $enddatetime,
        'timeZone' => 'America/Phoenix',
        ),
        'attendees' => array(
          array('email' => $email),
          array('email' => $emailaddress."+Appointment".$emailDomain),
        ),
        'reminders' => array(
          'useDefault' => FALSE,
        ),
        ));
        $optionalArguments = array("sendNotifications"=>true);
        $calendar_id = $calendarID;
        $event = $service->events->insert($calendar_id, $event, $optionalArguments);
      ?>
      
      <div class="starter-template">
        <h2>Your appointment has been scheduled! We sent a confirmation email to <?php echo $_POST['email']; ?></h2>
        <h3>We will contact you within 2 business days to let you know a more accurate length for your service based on your vehicle.</h3>
        <h3>If you did not receieve an email please contact us to make sure your appointment was entered in the system.</h3>
      </div>

    

    <div id="footer">   
	    <div id= "community">
			<p><span>Community</span><br>
			<a href="https://twitter.com/onpoint_AZ"
			onclick="window.open(this.href); return false;">
			<img src="images/twitter.ico" alt=" Twitter Icon" /></a>
			
			<a href="https://www.instagram.com/onpointdetailing_az/"
			onclick="window.open(this.href); return false;">
			<img src="images/instagram.ico" alt=" Instagram Icon" /></a></p>   
	    </div>
	   
		<div id="information">
			<p><span>Company Information</span><br>
				Location: Scottsdale, Arizona<br>
		        Phone #: 480-707-7744<br>
		        Be sure to check us out on Instagram!<br>
		        @OnPointDetailing_Az</p>
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
	</div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
