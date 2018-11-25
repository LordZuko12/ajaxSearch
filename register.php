<html>
<head>
	<title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/valid.js"></script>
</head>

<body class="container">
<br>
<a href="index.php"><span class="btn btn-primary">Home</span></a> <br />
<?php
include("config.php");
//connect to db here

if(isset($_POST['submit'])) {
	$aiubid = $_POST['aiubid'];
	$fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];

	/*if($pass == ""|| $aiubid == "" || $fullname == ""|| $email == "" || $phone == "") {
		echo "All fields should be filled. Either one or many fields are empty.";
		echo "<br/>";
		echo "<a href='register.php'>Go back</a>";
	} else {*/
		mysqli_query($conn,"INSERT INTO user(aiubid,fullname,email,phone,password) VALUES('$aiubid','$fullname','$email','$phone', md5('$pass'))")
			or die("Could not execute the insert query.");
			
		echo "<hr><div class='alert alert-success'>Registration successfully done. Click Home for login Now</div>";
		echo "<br/><hr>";
		
	//}
} else {
?>

	<center><h2>New User Registration</h2><hr></center>
	<form name="form1" method="post" action="" onsubmit="return (valid());">
		<table class="table table-striped table-bordered table-condensed">
            <tr>
                <td>AIUB ID</td>
                <td><input type="text" name="aiubid" class="form-control" onfocus="valid()"><p id="iderr"></p></td>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><input type="text" name="fullname" class="form-control" onfocus="valid()"></td>
            </tr>
            <tr>
				<td>Email</td>
				<td><input type="text" name="email" class="form-control" onfocus="valid()"></td>
			</tr>
            <tr>
                <td>Phone Number</td>
                <td><input type="text" name="phone" class="form-control" onfocus="valid()"></td>
            </tr>
			<tr> 
				<td>Password</td>
				<td><input type="password" name="password" class="form-control" onfocus="valid()"></td>
			</tr>
			<tr>
            <td colspan="2"><br></td>
            </tr>
            <tr> 
				
				<td colspan="2"><input type="submit" class="btn btn-success btn-block btn-lg" name="submit" value="Register" /></td>
			</tr>
		</table>
	</form>
<?php
}
//close the db connection here
?>
</body>
</html>
