// function myf(){
//   // var c = document.getElementById('n-inner-elements');
//   // c.write(" <h1>Yooooooooooooooooooooooooooooooo</h1> ")
//   var myWindow = window.open("", "MsgWindow", "width=800, height=800");
//   myWindow.document.write("<p>No notification yet</p>");
//   // document.write("hi");
// }


function getTimeValue(distance) {
    // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);    
      return [days, hours, minutes, seconds];
  }

function getUpcomingtime() {

  if (document.getElementById('submissions') === null) {
    return false;
  }
  // Set the date we're counting down to
  var upcomingCountDown=[];
  for (var up = 0; up < upcoming_submissions.length; up++) {
    upcomingCountDown[up] = new Date(upcoming_submissions[up]['submission_date']+" "+upcoming_submissions[up]['start_time']).getTime();
  }

  var x;
  var now,distance;
  var getValues=[];
  var days,hours,minutes,seconds;

  //console.log(upcomingCountDown.length);
  // Update the count down every 1 second
  x = setInterval(function() {

    for (var up = 0; up < upcomingCountDown.length; up++) {
        // Get today's date and time
        now = new Date().getTime();
        // Find the distance between now and the count down date
        distance = upcomingCountDown[up] - now;
        // Time calculations for days, hours, minutes and seconds
        getValues = getTimeValue(distance);
        console.log(getValues);
        days = getValues[0];
        hours = getValues[1];
        minutes = getValues[2];
        seconds = getValues[3];
        // Output the result in an element with id="demo"
        document.getElementById("starts-in"+up.toString()).innerHTML = days + "d " +hours + "h "
        + minutes + "m " + seconds + "s "; 
        
        // If the count down is over, write some text
        if (distance < 0) {
        clearInterval(x);
        document.getElementById("starts-in"+up.toString()).innerHTML = "EXPIRED";
        document.getElementById("ends-at"+up.toString()).innerHTML = "EXPIRED";
        location.reload(true);
      }
    }
  }, 1000);

  return false;
} 

function getOngoingtime() {

  if (document.getElementById('submissions') === null) {
    return false;
  }
  
  var ongoingCountDown=[];
  for (var on = 0; on < ongoing_submissions.length; on++) {
    ongoingCountDown[on] = new Date(ongoing_submissions[on]['submission_date']+" "+ongoing_submissions[on]['end_time']).getTime();
  }

  var x;
  var now,distance;
  var getValues=[];
  var days,hours,minutes,seconds;

  // Update the count down every 1 second
  x = setInterval(function() {
    for (var on = 0; on < ongoingCountDown.length; on++) {
        // Get today's date and time
        now = new Date().getTime();
        // Find the distance between now and the count down date
        distance = ongoingCountDown[on] - now;
        getValues = getTimeValue(distance);
        days = getValues[0];
        hours = getValues[1];
        minutes = getValues[2];
        seconds = getValues[3];

        // Output the result in an element with id="demo"
        document.getElementById("ends-in"+on.toString()).innerHTML = days + "d " +hours + "h "
        + minutes + "m " + seconds + "s "; 
        
        // If the count down is over, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("started-at"+on.toString()).innerHTML = "EXPIRED";
        document.getElementById("ends-in"+on.toString()).innerHTML = "EXPIRED";
        location.reload(true);
      }
    }
  }, 1000);

  return false;
} 