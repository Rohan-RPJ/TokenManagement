//---------------------------------------------------------------------------------------- TO KNOW TEACHER OR STUDENT------------------------------------------------------------------------------

function usertype(s){
  var usertype = s;
}



// -----------------------------------------------------------------------------------------STUDENT VALIDATION--------------------------------------------------------------------------------

function validation1(){
  // alert("submitted");
  var sname = document.getElementById("sName").value;
  var semail = document.getElementById('sEmail').value;
  var syear = document.getElementById('sYear').value;
  var sbranch = document.getElementById('sBranch').value;
  var spassword  = document.getElementById('sPassword').value;
  var srollno = document.getElementById('sRollNo').value;

  // console.log(syear);
  // console.log(sbranch);
  console.log(srollno);

  if(!sname){
    document.getElementById('sn').innerHTML="*Username should not be empty";
    return false;
  }

  if(!semail){
    document.getElementById('se').innerHTML="*Email should not be empty";
    return false;
  }

  if(!syear){
    document.getElementById('sy').innerHTML="*Select year";
    return false;
  }

  if(!sbranch){
    document.getElementById('sb').innerHTML="*Select branch";
    return false;
  }

  if(!srollno){
    document.getElementById('srn').innerHTML="*RollNo should not be empty";
    return false;
  }

  if(isNaN(srollno)){
    document.getElementById('srn').innerHTML="*RollNo should be in Number";
    return false;
  }

  if(srollno<=0){
    document.getElementById('srn').innerHTML="*RollNo should be Positive";
    return false;
  } 

  if((srollno / 100) >= 1){

    document.getElementById('srn').innerHTML="*RollNo should be atmost 2 character";
    return false;
  }
  
  if(!spassword){
    document.getElementById('spass').innerHTML="*Password should not be empty";
    return false;
  }

  if(spassword.length < 8){
    document.getElementById('spass').innerHTML="*Password should be atleast 8 character long";
    return false;
  }

}


// ------------------------------------------------------------- TEACHER VALIDATION------------------------------------------------------------------------------------------


function validation2(){
  var tname = document.getElementById("tName").value;
  var temail = document.getElementById('tEmail').value;
  //var tbranch = document.getElementById('tBranch').value;
  var tpassword  = document.getElementById('tPassword').value;

  if(!tname){
    document.getElementById('tn').innerHTML="*Username should not be empty";
    return false;
  }

  if(!temail){
    document.getElementById('te').innerHTML="*Email should not be empty";
    return false;
  }

  /*if(!tbranch){
    document.getElementById('tb').innerHTML="*Select branch";
    return false;
  }*/

  if(!tpassword){
    document.getElementById('tpass').innerHTML="*Password should not be empty";
    return false;
  }

  if(tpassword.length < 8){
    document.getElementById('tpass').innerHTML="*Password should be atleast 8 character long";
    return false;
  }

}




// ------------------------------------------------------checking for empty (Student)-----------------------------------------------------------------

function isEmpty1() {
  var e = document.getElementById('sName').value;
  if(e.length > 0)
  {
    document.getElementById('sn').innerHTML="";
  }
}

function isEmpty2() {
  var e = document.getElementById('sEmail').value;
  if(e.length > 0)
  {
    document.getElementById('se').innerHTML="";
  }
}

function isEmpty3() {
  var e = document.getElementById('sYear').value;
  if(e.length > 0)
  {
    document.getElementById('sy').innerHTML="";
  }
}

function isEmpty4() {
  var e = document.getElementById('sBranch').value;
  if(e.length > 0)
  {
    document.getElementById('sb').innerHTML="";
  }
}

function isEmpty5() {
  var e = document.getElementById('sPassword').value;
  if(e.length > 0)
  {
    document.getElementById('spass').innerHTML="";
  }
}

function isEmpty6() {
  var e = document.getElementById('sRollNo').value;
  if(e.length > 0)
  {
    document.getElementById('srn').innerHTML="";
  }
}



// ------------------------------------------------------checking for empty (Teacher)-----------------------------------------------------------------

function isEmpty11() {
  var e = document.getElementById('tName').value;
  if(e.length > 0)
  {
    document.getElementById('tn').innerHTML="";
  }
}

function isEmpty22() {
  var e = document.getElementById('tEmail').value;
  if(e.length > 0)
  {
    document.getElementById('te').innerHTML="";
  }
}

function isEmpty33() {
  var e = document.getElementById('tBranch').value;
  if(e.length > 0)
  {
    document.getElementById('tb').innerHTML="";
  }
}

function isEmpty44() {
  var e = document.getElementById('tPassword').value;
  if(e.length > 0)
  {
    document.getElementById('tpass').innerHTML="";
  }
}
