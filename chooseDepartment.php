<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Choose Your Department</title>
	<link rel="stylesheet" href="styles.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
		<script type="text/javascript">
		$(function () {
			$(window).load(function(){
				$.ajax({
		            type: 'POST',
		            url: 'loadDepartments.php',
		            dataType: 'json',
		            encode: true,
		            success: function(response) {
		            	if(!response.success){ // print errors
		             		console.log(response.message);
		            	} else {
		            		$("#welcomeplace").html("Welcome, " + response.session_user + 
		            			"! Please choose your department.");
		            		// Add depts in html file
		            		var depts = response.depts;
		            		var html_str = "";
		            		for(var i = 0, len = depts.length; i < len; i++) {
		            			html_str += "<tr><td><input type=\"radio\" "
		            			+ "value=\"" + depts[i]["dept_id"] + "\" "
		            			+ "name=\"radiobutton\"></td><td>"
		            			+ depts[i]["dept_id"]
		            			+ "</td><td>"
		            			+ depts[i]["name"]
		            			// + "</td><td>"
		            			// + depts[i]["description"]
		            			+ "</td></tr>";
		            		}
		            		$("#departmentsPlace").html(html_str);
		            		console.log(depts);
		            	}},
	             	error: function(xhr, status, error) {
					 	console.log("error!!");
					},
		        });
			});
		    $('#deptform').submit(function(event) {
		    	event.preventDefault();
		    	var dept_no = $("input[name='radiobutton']:checked").val();
		    	console.log(dept_no);
		    	if (!dept_no) {
				    $("#errorplace").html("Please choose a department");
				} else {
					var k = parseInt(dept_no);
			        $.ajax({
			            type: 'POST',
			            url: 'setStudentDepartment.php',
			            data: { deptno: k}, // chosen department
			            dataType: 'json',
			            encode: true,
			            success: function(response) {
			            	if(!response.success){ // print errors
			             		console.log(response.message);
			            	} else {
			            		window.location.href = "showCourses.php";
			            	}},
			            error: function(ts) { alert(ts.responseText) }
			        });
			    }	
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
			<td></td>
			<td align="left"><b>No.</b></td>
			<td align="left"><b>Dept Name</b></td>
			<!-- <td align="left"><b>Description</b></td> -->
		</thead>
		
		<form id="deptform" method="POST" action="showCourses.php" >
			<tbody id="departmentsPlace">
			<!-- Rows containing departments should be inserted here,
			 each following a radio button. -->
			</tbody>
			<tr id="submitrow" ><td></td><td></td>
				<td><input id = "dept_but" class="deptclass" type="submit" value="submit">
					<p class="deptclass" id="errorplace"></p></td></tr>
		</form>
		<br/><br/>
	</table><br/>
	
</body>
</html>
