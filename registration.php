<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
	<link rel="stylesheet" href="styles.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<!--<script src="submitform.js" type="text/javascript"></script>-->
	
	<script type="text/javascript">
	$(function () {
		$("#regform").hide();
	    $(".aform").submit(function(event) {
	    	
	    	event.preventDefault();
	    	var data = $(this).serializeArray();
	    	var form_id = $(this).attr('id');
			data.push({name: "formid", value: form_id});
	        $.ajax({
	            type: 'POST',
	            url: 'validateform.php',
	            data: $.param(data),
	            dataType: 'json',
	            encode: true,
	            success: function(response){
	            	if(!response.success){ // print errors\
	            		var x = "#result" + form_id;
	            		console.log(x);
	             		$(x).html(response.message + "<br/>");
	            	} else if(!response.hasDepartment) {
	            		window.location.href = "chooseDepartment.php";
	            	} else {	 
	            		window.location.href = "showCourses.php";
	            	}},
             	error: function(ts) { alert(ts.responseText) },
	        });
	    }); 
		$(".new_user").click(function(){
		    $("#loginform").hide();
		    $("#regform").show();
		});
		$(".already_user").click(function(){
		    $("#regform").hide();
		    $("#loginform").show();
		});
	});
	</script>

</head>
<body>
	<div id="header"><h3 id="welcomeplace">Welcome, please sign in or register below</h3></div>
	<br/><br/><br/><div id="wrapper">
		<form id="loginform" action="#" method="POST" class="aform" >
			<fieldset>
				<legend><strong>Sign in:</strong></legend>
				<p>Username </p>
				<input type="text" name="username" placeholder="Your Username"> <br/>
				<p>Password </p>
				<input type="password" name="password" placeholder="Your Password"> <br/> <br/>
				<span id="resultloginform"></span><br/>
				<input type="submit" name="submit" value="Sign in"> <br/>
				<button type="button"  class="new_user">New user? Register here</button><br/>
			</fieldset></form></br>
		</form>
		<form id="regform" action="#" method="POST" class="aform" >
			<fieldset>
				<legend><strong>Sign up:</strong></legend>
				<p>Email </p>
				<input type="email" name="rEmail" placeholder="Your Email"> <br/>
				<p>Username </p>
				<input type="text" name="rUsername" placeholder="Your Username"> <br/>
				<p>Password </p>
				<input type="password" name="rPassword" placeholder="Your Password"> <br/>
				<p>Confirm Password </p>
				<input type="password" name="rPasswordConf" placeholder="Your Password"> <br/> <br/>
				<span id="resultregform"></span><br/>
				<input type="submit" name="submitnew" value="Register"> <br/>
				<button type="button" class="already_user">Already a user? Sign in here</button><br/>
			</fieldset>
		</form>
		<br/>
	</div>
</body>
</html>
