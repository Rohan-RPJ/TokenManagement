function validation() {
  var user = document.getElementById('username').value;
  // console.log(username);
  if(user == "")
  {
    document.getElementById('user').innerHTML="*Username should not be empty";
    return false;
  }

  var userpass = document.getElementById('password').value;
  // console.log(username);
  if(userpass == "")
  {
    document.getElementById('pass').innerHTML="*Password should not be empty";
    return false;
  }
  // console.log(userpass.length);
  /*if(userpass.length < 8)
  {
    document.getElementById('pass').innerHTML="*Password should be atleast 8 character long";
    return false;
  }*/

  var usertype = document.getElementById('hide').value;
  // console.log(usertype);
  if(usertype == "")
  {
    document.getElementById('whologin').innerHTML="*Select Student or Teacher";
    return false;
  }
}

function usertype(user){
  document.getElementById("hide").value = user;
}

// ------------------------------------------------------checking for empty-----------------------------------------------------------------

function isEmpty1() {
  var e = document.getElementById('username').value;
  if(e.length > 0)
  {
    document.getElementById('user').innerHTML="";
  }
}

function isEmpty2() {
  var e = document.getElementById('password').value;
  if(e.length > 0)
  {
    document.getElementById('pass').innerHTML="";
  }
}

function isEmpty3() {
  var e = document.getElementById('hide').value;
  if(e.length > 0)
  {
    document.getElementById('whologin').innerHTML="";
  }
}
