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

    <title>Scheduling</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <?php 
    switch ($_GET['service']){
          case "hwash":
            $serviceText="a hand wash.";
            $maxTime=2;
            break;
          case "washwax":
            $serviceText="a wash and wax.";
            $maxTime=4;
            break;
          case "washwaxclay":
            $serviceText="a wash, wax, and clay.";
            $maxTime=5;
            break;
          case "ultwash":
            $serviceText="an ultimate wash.";
            $maxTime=8;
            break;
          case "paint":
            $serviceText="a paint correction.";
            $maxTime=8;
            break;
          case "scratchswirl":
            $serviceText="a scratch/swirl removal.";
            $maxTime=7;
            break;
          case "headlight":
            $serviceText="a headlight restoration.";
            $maxTime=1;
            break;
          case "interior":
            $serviceText="an interior detail.";
            $maxTime=3;
            break;
          case "engine":
            $serviceText="an engine bay detail.";
            $maxTime=1;
            break;
          default:
            break;
          }
      ?>
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
        var availableTimes = ["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30"];
        var allTimes = ["08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30"];
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
                  for (k=startIndex;k<endIndex;k++)
                    availableTimes[k] = "TAKEN";
              }
            }
          }

          var length = <?php echo $maxTime; ?> * 2;

          var times = "";
          for (l = 0; l < allTimes.length; l++)
          {
            if (availableTimes[l]=="TAKEN")
              if(length > 1)
                for(z=1;z<length;z++)
                  availableTimes[l-z] = "TAKEN";     
            if (l + <?php echo $maxTime*2;?> > allTimes.length - 1 )
              availableTimes[l] = "TAKEN";
          }
                  

          for (k = 0; k < allTimes.length; k++)
            if (availableTimes[k]!="TAKEN")
              times += '<option value="'+allTimes[k]+'">'+allTimes[k]+'</option>';
            else
              times += '<option disabled="true" value="'+allTimes[k]+'">'+allTimes[k]+'</option>';

          allTaken=true;
          for (x=0;x<availableTimes.length;x++)
            if(availableTimes[x]!="TAKEN")
              allTaken=false;
          if(allTaken)
            times = '<option disabled="true">There are no available times, please select another day</option>';

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
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <h2>Appointment Scheduling</h2>
      <?php
        
          echo "You are scheduling ".$serviceText;
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
          <label for="Date">Please enter your desired date in MM/DD/YYYY format. If supported by your browser click the arrow in the right to open a calendar</label>
          <input type="date" class="form-control" id="date" name="date" onchange="loadCalendarApi();">
          <label for="time">Please pick an available start time, unavailable times will be unselectable. <br>Your appointment will take approximately <?php echo $maxTime; ?> hours at most.</label>
          <select class="form-control" id="time" name="time">
            <option value="null">Select a date to see times</option>
          </select>
        </div>
        <button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
      </form>


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
