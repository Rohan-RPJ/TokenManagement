var i = 0;
//Html Tags - question list items
var questionCardsItem = "<li id='QNO' class='question_cards_item'>"
var questionCardDiv = "<div class='questionCard'>"
var cardContentDiv = "<div class='card_content'>"
var cardTitleHeading = "<h2 id='h2' class='card_title'>Question No. QNO</h2>"
var questionTextArea = "<textarea id='questionQNOTextArea' name='questionQNO' placeholder='Write your question here...' autocomplete='on'></textarea>";
var cardOptionsDiv = "<div class='card_options'>";
var correctOptionRadio = "<input type='radio' name='qQNOcorrectOption'>";
var optionInput1 = "<input type='text' name='qQNOoption1' placeholder='Enter option 1'>";
var optionInput2 = "<input type='text' name='qQNOoption2' placeholder='Enter option 2'>";
var optionInput3 = "<input type='text' name='qQNOoption3' placeholder='Enter option 3'>";
var optionInput4 = "<input type='text' name='qQNOoption4' placeholder='Enter option 4'>";
var cardOptionsCloseDiv = "</div>";
var appendButton = "<input type='button' name='append' class='btn card_btn' style='float: right;' value='Append'>";
var removeButton = "<input type='button' name='remove' class='btn card_btn' style='float: left;' value='Remove' onclick='removeQuestion(QNO);'>";
var cardContentCloseDiv = "</div>";
var questionCardCloseDiv = "</div>";
var questionCardsItemCloseLi = "</li>";

function showValue(){
    console.log(document.getElementById('subject').value);
}

function fillSubjectsdropdown(){
    var selectedYear = document.getElementById('year').value;
    var selectedBranch = document.getElementById('branch').value;
    var subjectDropDown = "";
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
        document.getElementById('subject').innerHTML = "<option value=''>---Select--Subject---</option>";
    }
}

function getList(){
    i = document.getElementById('questionsList').getElementsByTagName("li").length + 1;
    return (questionCardsItem+questionCardDiv+cardContentDiv+cardTitleHeading+questionTextArea+cardOptionsDiv+correctOptionRadio.replace(" "," value='1' ")+optionInput1+correctOptionRadio.replace(" "," value='2' ")+optionInput2+correctOptionRadio.replace(" "," value='3' ")+optionInput3+correctOptionRadio.replace(" "," value='4' ")+optionInput4+cardOptionsCloseDiv+appendButton+removeButton+cardContentCloseDiv+questionCardCloseDiv+questionCardsItemCloseLi).replace(/QNO/g, i);
}

function addQuestion(){
    document.getElementById('questionsList').insertAdjacentHTML('beforeend',getList());
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
                inputs[k-1].setAttribute('onclick', 'removeCard('+jstring+');');
            }
        }
    }
    console.log(listItems);
}

function updateTotal(){
  var listItems = document.getElementById('questionsList').getElementsByTagName("li");
  console.log(listItems.length.toString());
  document.getElementById('hiddenText').value = listItems.length.toString();
}
