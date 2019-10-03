
  // document.querySelector('.edit').style.cursor="not-allowed";
  document.querySelector('.edit').disabled=true;
  document.querySelector('.edit1').disabled=true;
  document.querySelector('.edit2').disabled=true;
  document.querySelector('.branch').disabled=true;
  document.querySelector('.year').disabled=true;
  document.querySelector('.edit5').disabled=true;

  function enable(){
    document.querySelector('.edit').disabled=false;
    document.querySelector('.edit1').disabled=false;
    document.querySelector('.edit2').disabled=false;
    document.querySelector('.branch').disabled=false;
    document.querySelector('.year').disabled=false;
    document.querySelector('.edit5').disabled=false;
  }
