$(document).ready(function() {
 /*
  $(".sumbitBtn").on("click", function(e) {
    //e.preventDefault();

    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var code = $("#code").val();
    
    $.ajax({
      url: "data.php",
      type: "POST",
      dataType: 'json',
      data: {
        first_name: $("#first_name").val(),
        last_name: $("#last_name").val(),
        code:  $("#code").val()
      },
      dataType: "JSON",
      success: function (data) {
       console.log(data)
      },
      error:function(err,xhr) {
        console.log("ERROR")
        console.log(err);
        console.log(xhr);
      },
      complete:function() {
        location.reload();
      }
    });//ajax

  });//on click
 */


$("#fupForm").on('submit', function(e){
  e.preventDefault();

  if (checkInputs()) {
    $.ajax({
        type: 'POST',
        url: 'data.php',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(msg){
          console.log(msg);
          $('#fupForm')[0].reset();
        }
    });
  }
});//on submit


//file type validation
$("#file").change(function() {
  var file = this.files[0];
  var imagefile = file.type;
  var match= ["image/jpeg","image/png","image/jpg","image/PNG","image/JPEG","image/JPG"];
  if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]) || (imagefile==match[4]) || (imagefile==match[5]) )){
      alert('Please select a valid image file (JPEG/JPG/PNG).');
      $("#file").val('');
      return false;
  }
  if (file.size > 500000) {
      alert("File size must under 500kb!");
      $("#file").val('');
      return false;
  }
});

function checkInputs() {
   var pass = true;
   var firstName = $("#first_name").val();
   var lastName = $("#last_name").val();
   var numberPattern = /\d+/g;

  //check length
  if (firstName.length < 2) {
    $("#first_name").css("outline","1px solid red");
    pass = false;
  } else {
    $("#first_name").css("outline","none");
  }

  if (lastName.length < 2) {
    $("#last_name").css("outline","1px solid red");
    pass = false;
  } else {
    $("#last_name").css("outline","none");
  }


  //check for only letters
  if ((firstName).match(numberPattern)) {
    $("#first_name").css("outline","1px solid red");
    pass = false;
  } else {
    $("#first_name").css("outline","none");
  }

  if ((lastName).match(numberPattern)) {
    $("#last_name").css("outline","1px solid red");
    pass = false;
  } else {
    $("#last_name").css("outline","none");
  }
 
  return pass;
}

}); //PAGE LOADED


