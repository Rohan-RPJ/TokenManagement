function showStudents(card_id) {
    /*<tr>
      <td data-label="Token"></td>
      <td data-label="Name"></td>
      <td data-label="Roll No"></td>
      <td data-label="Notify"><button></button></td>
    </tr>*/
    var id = card_id;
    var required_students = ongoing_submissions[id]['students'];
    //console.log(required_students);
    //console.log(document.getElementById('call-modal-table').lastElementChild.id);
    var body_id = document.getElementById('call-modal-table').lastElementChild.id;
    //console.log(ongoing_submissions[id]['students']);

    var tableInnerHTML="";
    if (required_students.length == 0) {
      document.getElementById('call-modal-header').style = "color:black;display:all;";
      //Token value
        tableInnerHTML += "<tr><td data-label='Token'>-</td>"; 
        //Name
        tableInnerHTML += "<td data-label='Name'>-</td>";
        //Roll no
        tableInnerHTML += "<td data-label='Roll No'>-</td>";
        //Call btn
        tableInnerHTML += "<td data-label='Notify'>-</td></tr>"; //Token value
    }
    else{
      document.getElementById('call-modal-header').style = "display:none;";
      
      for (var i = 0; i < required_students.length; i++) {
        //Token value
        tableInnerHTML += "<tr><td data-label='Token' id='token" 
        + required_students[i]['id'].toString() + "'>" + (i+1).toString() + "</td>"; 
        //Name
        tableInnerHTML += "<td data-label='Name' id='name" 
        + required_students[i]['id'].toString() + "'>" + required_students[i]['sName'] + "</td>";
        //Roll no
        tableInnerHTML += "<td data-label='Roll No' id='roll-no" 
        + required_students[i]['id'].toString() + "'>" + required_students[i]['sRollNo'].toString() + "</td>";
        //Call btn
        tableInnerHTML += "<td data-label='Notify' id='call" 
        + required_students[i]['id'].toString() + "'><input type='checkbox' name='students_called[]' value='"+ 
        required_students[i]['id'].toString() +"' class='students_called'></td></tr>"; 
      }  
    }
    
    document.getElementById(body_id).innerHTML = tableInnerHTML;
}