var i = 0;
//Html Tags - question list items
var questionCardsItem = "<li id='QNO' class='question_cards_item'>"
var questionCardDiv = "<div class='questionCard'>"
var cardContentDiv = "<div class='card_content'>"
var cardTitleHeading = "<h2 id='h2' class='card_title'>Question No. QNO</h2>"
var questionTextArea = "<textarea id='questionQNOTextArea' name='questionQNO' placeholder='Write your question here...' autocomplete='on' required></textarea>";
var cardOptionsDiv = "<div class='card_options'>";
var correctOptionRadio = "<input type='radio' name='qQNOcorrectOption' required>";
var optionInput1 = "<input type='text' name='qQNOoption1' placeholder='Enter option 1' required>";
var optionInput2 = "<input type='text' name='qQNOoption2' placeholder='Enter option 2' required>";
var optionInput3 = "<input type='text' name='qQNOoption3' placeholder='Enter option 3' required>";
var optionInput4 = "<input type='text' name='qQNOoption4' placeholder='Enter option 4' required>";
var cardOptionsCloseDiv = "</div>";
var appendButton = "<input type='button' name='append' id='submit'  class='btn card_btn' style='float: right;' value='Append' onclick='qValidate()' >";
var removeButton = "<input type='button' name='remove' class='btn card_btn' style='float: left;' value='Remove' onclick='removeQuestion(QNO);'>";
var cardContentCloseDiv = "</div>";
var questionCardCloseDiv = "</div>";
var questionCardsItemCloseLi = "</li>";

function questionValidation(){
    if(document.getElementById('quiz-radio-btn').checked){
        questions = document.getElementById('questionsList').getElementsByTagName("li").length;
        if(questions < 3){
            document.getElementById('error').innerHTML = "*Add atleast 3 questions";
            document.getElementById('error').style = "display:block;color:red;";
            return false;
        }
    }
    return true;
}

// function qValidate(){
//   var a = document.querySelector(".qtext").value;
//   var o1 = document.querySelector("#qoption1").value;
//   var o2 = document.querySelector("#qoption2").value;
//   var o3 = document.querySelector("#qoption3").value;
//   var o4 = document.querySelector("#qoption4").value;
//   var b = document.getElementById("radio").value;
//   console.log(b);
//   if (!a) {
//       alert("Enter question ");
//       return false;
//   }
//   if (!o1) {
//     alert("Please enter option 1");
//     return false;
//   }
//   if (!o2) {
//     alert("Please enter option 2");
//     return false;
//   }
//   if (!o3) {
//     alert("Please enter option 3");
//     return false;
//   }
//   if (!o4) {
//     alert("Please enter option 4");
//     return false;
//   }
//   if (!b) {
//       alert("Choose correct option");
//       return false;
//   }
// }

function showValue(){
    console.log(document.getElementById('subject').value);
}

function fillSubjectsdropdown(){
    var selectedYear = document.getElementById('year').value;
    var selectedBranch = document.getElementById('branch').value;
    var subjectDropDown = "<option value=''>----Select--Subject----</option>";
    if (!(selectedYear.trim() === "") && !(selectedBranch.trim() === "")) {
        //console.log(selectedYear);
        //console.log(selectedBranch);
        for (var i = 0; i < subjects.length; i++) {
            if (subjects[i]['branch'] === selectedBranch && subjects[i]['year'] === selectedYear) {
                subjectDropDown += "<option>"+subjects[i]['name']+"</option>";
           }
        }
        document.getElementById('subject').innerHTML = subjectDropDown;
    }
    else{
        document.getElementById('subject').innerHTML = subjectDropDown;
    }
    if(selectedBranch){
      document.getElementById('br').innerHTML="";
    }
    if(selectedYear){
      document.getElementById('yr').innerHTML="";
    }
    if(selectedBranch){
      document.getElementById('br').innerHTML="";
    }
    if(selectedYear){
      document.getElementById('yr').innerHTML="";
    }
}

function getList(){
    i = document.getElementById('questionsList').getElementsByTagName("li").length + 1;
    return (questionCardsItem+questionCardDiv+cardContentDiv+cardTitleHeading+questionTextArea+cardOptionsDiv+correctOptionRadio.replace(" "," value='1' ")+optionInput1+correctOptionRadio.replace(" "," value='2' ")+optionInput2+correctOptionRadio.replace(" "," value='3' ")+optionInput3+correctOptionRadio.replace(" "," value='4' ")+optionInput4+cardOptionsCloseDiv+appendButton+removeButton+cardContentCloseDiv+questionCardCloseDiv+questionCardsItemCloseLi).replace(/QNO/g, i);
}

function addQuestion(){
    document.getElementById('questionsList').insertAdjacentHTML('beforeend',getList());
    document.getElementById('error').style = "display:none;";
}

function removeQuestion(qno) {
    var fadeTarget = document.getElementById(qno.toString());
    var fadeEffect = setInterval(function () {
        if (!fadeTarget.style.opacity) {
            fadeTarget.style.opacity = 1;
        }
        if (fadeTarget.style.opacity > 0) {
            fadeTarget.style.opacity -= 0.1;
        } else {
            clearInterval(fadeEffect);
        }
    }, 50);
    setTimeout(function(){
        fadeTarget.remove();
        updateQuestions();
    }, 500);
}

function updateQuestions(){
    //update other cards
    var listItems = document.getElementById('questionsList').getElementsByTagName("li");
    //console.log(listItems[0].getElementsByTagName('h2'));
    for (var j = 1; j <= listItems.length; j++) {
        jstring = j.toString();
        listItems[j-1].setAttribute("id", jstring);
        //listItems[j-1].setAttribute("class", "question_cards_item"+jstring);
        listItems[j-1].getElementsByTagName('h2')[0].innerHTML = "Question No. " + jstring;
        listItems[j-1].getElementsByTagName('textarea')[0].setAttribute("id", "question"+jstring+"TextArea");
        var inputs = listItems[j-1].getElementsByTagName("input");
        for (var k = 1; k <= inputs.length; k++) {
            if (inputs[k-1].getAttribute('type') == 'radio') {
                inputs[k-1].setAttribute('name', 'q'+jstring+'correctOption');
            }
            else if (inputs[k-1].getAttribute('type') == 'text') {
                var optionx = inputs[k-1].getAttribute('name')[inputs[k-1].getAttribute('name').length-1]
                inputs[k-1].setAttribute('name', 'q'+jstring+'option'+optionx);
            }
            else if (inputs[k-1].getAttribute('name') == 'remove') {
                inputs[k-1].setAttribute('onclick', 'removeQuestion('+jstring+');');
            }
        }
    }
    console.log(listItems);

    //console.log(listItems);
}

function updateTotal(){

  var listItems = document.getElementById('questionsList').getElementsByTagName("li");
  console.log(listItems.length.toString());
  document.getElementById('hiddenText').value = listItems.length.toString();
}

function validateForm(){
          // alert("Hello");
          var selectedYear = document.getElementById('year').value;
          var branch = document.getElementById('branch').value;
          var subject = document.getElementById('subject').value;
          var type = document.getElementById('chk-btn').value;
          // var date = document.getElementById('chk-date').value;
          // var st = document.getElementById('chk-start-time').value;
          // var et = document.getElementById('chk-end-time').value;
          // console.log(type);
          //console.log(selectedYear);
          if (!selectedYear) {
            document.getElementById('yr').innerHTML="*Year should not be empty";
            return false;
          }
          if (!branch) {
            document.getElementById('br').innerHTML="*Branch should not be empty";
            return false;
          }
          if (!subject) {
            document.getElementById('sub').innerHTML="*Subject should not be empty";
            return false;
          }
          /*if (!type) {
            document.getElementById('radio-btn').innerHTML="*Select submission type";
            return false;
          }*/
          // if (!date) {
            // var a = document.getElementById('chk-date').innerHTML="*Enter Date";
            // console.log(type);
          //   return false;
          // }
          // }
          // if (!st) {
          //   document.getElementById('st').innerHTML="*Enter start time";
          //   return false;
          // }
          // if (!et) {
          //   document.getElementById('et').innerHTML="*Enter end time";
          //   return false;
          // }
          return questionValidation();
}

function isEmpty(){
  var a = document.getElementById('chk-btn').value;
  if (a) {
    document.getElementById('radio-btn').innerHTML="";
  }
}
