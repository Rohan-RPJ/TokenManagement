function events() {
  // var c = document.getElementById('n-inner-elements');
  // c.write(" <h1>Yooooooooooooooooooooooooooooooo</h1> ")
  var myWindow = window.open("file:///home/shubham/Desktop/WDLproject/Dashboard/events.html", "MsgWindow", "width=800, height=800");
  myWindow.document.write("<h1>Shubham</h1>");
  // document.write("hi");
}

function gettime() {
  // Set the date we're counting down to
  var countDownDate = new Date("Sept 17, 2019 22:02:25").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("set-et").innerHTML = hours + "h "
    + minutes + "m " + seconds + "s ";

    // If the count down is over, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("set-et").innerHTML = "EXPIRED";
    }
  }, 1000);
}
