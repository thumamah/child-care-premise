function func(event){
  // debugger;
  var fullDay = document.getElementById("type1");
  var time1 = document.getElementById("time1");
  var halfDay = document.getElementById("type2");
  var time2 = document.getElementById("time2");

  if(document.getElementById("type1").checked){
    time1.style.display = "block";
  }
  else if (document.getElementById("type2").checked){
    time2.style.display = "block";
  }
  else{
        fullDay.style.display = "none";
        time1.style.display = "none";
        halfDay.style.display = "none";
        time2.style.display = "none";

  }


}

function reload(){
  setTimeout(() =>
    window.location.href = "https://knuth.griffith.ie/~s2999960/childcare-premise-php-project/project/AdminPages/registration_edit.php"
  , 60000);
}


// // day details script
// var today = new Date();
// var dd = today.getDate();
// var mm = today.getMonth() + 1; //January is 0!
// var yyyy = today.getFullYear();
// if (dd < 10) {
//     dd = '0' + dd
// }
// if (mm < 10) {
//     mm = '0' + mm
// }

// todayMin = yyyy + '-' + mm + '-' + (dd - 2);
// todayMax = yyyy + '-' + mm + '-' + (dd - 1);
// document.getElementById("date").setAttribute("max", todayMax);
// document.getElementById("date").setAttribute("min", todayMin);



// show passpord function

function FunctionPass() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
