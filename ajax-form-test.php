<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>how to submit a form without refreshing the page using jquery ajax - Tutsmake.com</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.4.1.js"></script> 
</head>
<body>
<div class="container">
<div class="row">
<div class="col-lg-8 col-offset-2">
<div class="page-header">
</div>
<p>Please fill all fields in the form</p>
<p class="alert alert-success" id="show_message" style="display: none">Form Data Successfully Saved. </p>
<span id="error" style="display: none"></span>
<form action="javascript:void(0)" method="post" id="ajax-form">
<div class="form-group">
<label>Name</label>
<input type="text" name="name" id="name" class="form-control" value="" maxlength="50" >
</div>
<div class="form-group ">
<label>Email</label>
<input type="email" name="email" id="email" class="form-control" value="" maxlength="30" >
</div>
<div class="form-group">
<label>Mobile</label>
<input type="text" name="mobile" id="mobile" class="form-control" value="" maxlength="12" >
</div> 
<input type="submit" class="btn btn-primary" name="submit" value="submit">
</form>
</div>
</div>    
</div>
<script type="text/javascript">
$(document).ready(function($){
// hide messages 
$("#error").hide();
$("#show_message").hide();
// on submit...
$('#ajax-form').submit(function(e){
e.preventDefault();
$("#error").hide();
//name required
var name = $("input#name").val();
if(name == ""){
$("#error").fadeIn().text("Name required.");
$("input#name").focus();
return false;
}
// email required
var email = $("input#email").val();
if(email == ""){
$("#error").fadeIn().text("Email required");
$("input#email").focus();
return false;
}
// mobile number required
var mobile = $("input#mobile").val();
if(mobile == ""){
$("#error").fadeIn().text("Mobile number required");
$("input#mobile").focus();
return false;
}
// ajax
$.ajax({
type:"POST",
url: "ajax-form-save.php",
data: $(this).serialize(), // get all form field value in serialize form
success: function(){
$("#show_message").fadeIn();
//$("#ajax-form").fadeOut();
}
});
});  
return false;
});
</script>
</body>
</html>