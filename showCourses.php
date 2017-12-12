<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
	<link rel="stylesheet" href="styles.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<!--<script src="submitform.js" type="text/javascript"></script>-->
	
	<script type="text/javascript">
		$(function () {
		    $(window).load(function(){
				// console.log('7asal');
				$.ajax({
		            type: 'POST',
		            url: 'loadCourses.php',
		            dataType: 'json',
		            encode: true,
		            success: function(response) {
		            	if(!response.success){ // print errors
		             		console.log(response.message);
		            	} else {
		            		$("#welcomeplace").html("Welcome, " + response.session_user + 
		            			"!");
		            		// Add courses in html file
		            		var courses = response.courses;
		            		var html_str = "";
		            		for(var i = 0, len = courses.length; i < len; i++) {
		            			html_str += "<tr><td>"
		            			+ courses[i]["course_id"]
		            			+ "</td><td>"
		            			+ courses[i]["course_name"]
		            			+ "</td><td>"
		            			// + courses[i]["instructor_name"]
		            			// + "</td><td>"
		            			+ courses[i]["credit_hours"]
		            			// + "</td><td>"
		            			// + courses[i]["course_description"]
		            			+ "</td></tr>";
		            		}
		            		$("#coursesPlace").html(html_str);
		            		///$("#departmentsPlace").html($depts);
		            		console.log(depts);
		            	}},
					error: function(ts) { alert(ts.responseText) }
		        });
			});
		});
	</script>

</head>
<body>
	
<div id="header"><h3 id="welcomeplace"></h3>
	<form class="logoutLblPos" align="right" id="form1" method="post" action="logout.php">
	  <input type="submit" id="logout_butt" value="log out">
	</form></div>
<br/><br/>
<table align="center" cellspacing="5" cellpadding="8" >
		<thead>
			<td align="left"><b>No.</b></td>
			<td align="left"><b>Course Name</b></td>
			<!-- <td align="left"><b>Instructor Name</b></td> -->
			<td align="left"><b>Credit Hours</b></td>
			<!-- <td align="left"><b>Course Description</b></td> -->
		</thead>
		<tbody id="coursesPlace">
			<!-- Rows containing courses should be inserted here. -->
		</tbody>
		<br/><br/>
	</table><br/>
	<span id="errorplace"></span>
</body>
</html>
