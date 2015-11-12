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

    <title>Scheduling</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- Script for interacting with google calendar api-->

    <script type="text/javascript">
      // Your Client ID can be retrieved from your project in the Google
      // Developer Console, https://console.developers.google.com

      var SCOPES = ["https://www.googleapis.com/auth/calendar.readonly"];
      var APIKey = 'AIzaSyAK7DrUkc4lV9yG7tyFrw8qxw8bA2IF1wY';
      var calendarID = 'onpointdetailingtest@gmail.com';

      /**
       * Load Google Calendar client library. List upcoming events
       * once client library is loaded.
       */
      function loadCalendarApi() {
        gapi.client.setApiKey(APIKey)
        gapi.client.load('calendar', 'v3', listUpcomingEvents);
      }

      /**
       * Print the summary and start datetime/date of the next ten events in
       * the authorized user's calendar. If no events are found an
       * appropriate message is printed.
       */
      function listUpcomingEvents() {
        var availableTimes = ["08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00"];
        var allTimes = ["08:00","09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00"];
        var startIndex;
        var endIndex;
        var startDate = new Date(document.getElementById('date').value.substring(0,4),document.getElementById('date').value.substring(5,7)-1,document.getElementById('date').value.substring(8,10),0,0,0,0);
        var endDate = new Date (startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + 1);
        var request = gapi.client.calendar.events.list({
          'calendarId': calendarID,
          'timeMin': startDate.toISOString(),
          'timeMax': endDate.toISOString(),
          'showDeleted': false,
          'singleEvents': true,
          'orderBy': 'startTime'
        });

        request.execute(function(resp) {

          var events = resp.items;

          if (events.length > 0) {
            for (i = 0; i < events.length; i++) {
              var event = events[i];
              startTime = event.start.dateTime.substring(11,16);
              endTime = event.end.dateTime.substring(11,16);

              for (j = 0; j < availableTimes.length; j++)
              {
                if (startTime === availableTimes[j])
                {
                  startIndex = j;
                }
                if (endTime === availableTimes[j])
                {
                  endIndex = j;
                }
                if (j>=startIndex && j===endIndex)
                  availableTimes.splice(startIndex,endIndex-startIndex);
              }
            }
          }

          var times = "";
          for (k = 0; k < allTimes.length; k++)
          {
            if ($.inArray(allTimes[k],availableTimes) != -1)
              times += '<option value="'+allTimes[k]+'">'+allTimes[k]+'</option>';
            else
              times += '<option disabled="true" value="'+allTimes[k]+'">'+allTimes[k]+'</option>';
          }
          listTimes(times);
        });
      }

      function listTimes(content){
        document.getElementById('time').innerHTML = content;
      }

      function getServiceName(){
        document.getElementById('service').innerHTML = window.location.hash.substring(1);
      }

    </script>
    <script src="https://apis.google.com/js/client.js">
    </script>

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
          <a class="navbar-brand" href="#">Project name</a>
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

      <h2>Appointment Scheduling</h2>
      <?php
        switch ($_GET['service']){
          case "hwash":
            echo "You are scheduling a hand wash.";
            break;
          case "washwax":
            echo "You are scheduling a wash and wax.";
            break;
          case "washwaxclay":
            echo "You are scheduling a wash, wax, and clay.";
            break;
          case "ultwash":
            echo "You are scheduling an ultimate wash.";
            break;
          case "paint":
            echo "You are scheduling a paint correction.";
            break;
          case "scratchswirl":
            echo "You are scheduling a scratch/swirl removal.";
            break;
          case "headlight":
            echo "You are scheduling a headlight restoration.";
            break;
          case "interior":
            echo "You are scheduling an interior detail.";
            break;
          case "engine":
            echo "You are scheduling an engine bay detail.";
            break;
          default:
            break;
          }
          ?></p>
      <form action="confirm.php" method="post">
        <div class="form-group">
          <input type="hidden" name="service" value=<?php echo "'".$_GET['service']."'"; ?>>
          <label for="First Name">First Name:</label>
          <input type="text" class="form-control" id="fname" name='fname' placeholder="First Name">
          <label for="Last Name">Last Name:</label>
          <input type="text" class="form-control" id="lname" name='lname' placeholder="Last Name">
          <label for="Email">Email:</label>
          <input type="email" class="form-control" id="email" name='email' placeholder="Email">
          <label for="Phone Number">Phone Number:</label>
          <input type="tel" class="form-control" id="phonenum" name="phonenum" placeholder="Phone Number">
          <label for="Model">Vehicle Make and Model:</label>
          <input type="text" class="form-control" id="model" name="model" placeholder="Make & Model">
          <label for="Date">Which date would you like?</label>
          <input type="date" class="form-control" id="date" name="date" onchange="loadCalendarApi();">
          <label for="time">Please pick an available start time.</label>
          <select class="form-control" id="time" name="time">
            <option value="null">Select a date to see times</option>
          </select>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
      </form>

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
