<?php
/**
 * Created by PhpStorm.
 * User: Saef
 * Date: 08-Mar-16
 * Time: 10:31 AM
 */
session_start();
ob_start();

if (!(isset($_SESSION['admin']))){
    header("location:index.php");
}
else {
    require_once("config.php");
    //connect to db here
//fetching data in descending order (lastest entry first)
    $user=$_SESSION['aiubid'];
	$limit = 25;
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $limit;
  	$sql = "SELECT * FROM info where deleted_at is NULL order by id DESC LIMIT $start_from, $limit";
	$rs_result = mysqli_query ($conn,$sql);
}
?>

<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="css/switch.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/bootstrap.min.js"></script>
<style>
body {
   #background-image: url("css/bg.jpg");
   background-color: #cccccc;
   background-position: center; 
  background-repeat: no-repeat; 
  background-size: cover; /
}
input[type=text] {
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            #border-radius: 4px;
            font-size: 16px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 12px 20px 12px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }

input[type=text]:focus {
    width: 100%;
}
</style>
<script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("livesearch").innerHTML=this.responseText;
                    document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
        }
		
		function showResult2(str) {
            if (str.length==0) {
                document.getElementById("livesearch2").innerHTML="";
                document.getElementById("livesearch2").style.border="0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("livesearch2").innerHTML=this.responseText;
                    document.getElementById("livesearch2").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","livesearch2.php?q="+str,true);
            xmlhttp.send();
        }
    </script>
</head>

<body class="container-fluid">
<br>
<a href="add.php"> <span class="btn btn-success">Add New Data</span></a>
<a href="logout.php"><span class="btn btn-warning">Logout</span></a>
<a href="adm-view/mkdir.php"><span class="btn btn-warning">Create Dir</span></a>
<form>
        <input type="text" name="search" placeholder="Search" onkeyup="showResult(this.value)">
</form>
<div id="livesearch" style="border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;"></div>
<form method="post" action="adm-action/onoff.php">
  File Submission on:
  <input type="checkbox" name="onoff">
  <input type="submit" value="change status">
</form>
<center><h1>Assignment Tracking System</h1></center><hr>
<table class="table table-striped table-bordered table-condensed">
<tr>
<td colspan="8">

<form method="get" action="#" style="float:right">
<input type="text" name="search" placeholder="Search" class="input-sm" onkeyup="showResult2(this.value)">
</form>

<div id="livesearch2" style="border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;"></div>

</td>
</tr>
    <tr>
        <th>Course Name</th>
        <th>Assignment Name</th>
        <th>Uploaded By</th>
        <th>Upload Time</th>
        <th>Remarks</th>
        <th>Action</th>
    </tr>
    <?php
    while($res=mysqli_fetch_array($rs_result)) {
        echo "<tr>";
        echo "<td>".$res['coursename']."</td>";
		echo "<td>".$res['assignmentname']."</td>";
		echo "<td>".$res['uploaded_by']."</td>";
		echo "<td>".$res['uploaded_at']."</td>";
		echo "<td>".$res['remarks']."</td>";
		echo "<td><a href=./".$res['file_link']." target='_blank'><span class='glyphicon glyphicon-paperclip'></span></a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><span class='glyphicon glyphicon-remove-circle'></span></a></td>";
    }

    ?>

</table>
<?php
	$sql = "SELECT COUNT(id) FROM info";
	$rs_result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($rs_result);
	$total_records = $row[0];
	$total_pages = ceil($total_records / $limit);
	$pagLink = "<ul class='pagination pagination-lg'>";
	for ($i=1; $i<=$total_pages; $i++) {
             $pagLink .= "<li class='page-item'><a href='admin.php?page=".$i."'>".$i."</a></li>";
		};
	echo $pagLink . "</ul>";
    //close db connection here
?>
</body>
</html>
