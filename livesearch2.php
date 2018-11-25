<?php
/**
 * Created by PhpStorm.
 * User: mdsae
 * Date: 19-Nov-18
 * Time: 07:27 AM
 */
include('config.php');

///write new query here
$q=$_GET["q"];

$result=mysqli_query($conn,"SELECT id, assignmentname, uploaded_by FROM info where assignmentname like  '%$q%' or uploaded_by like '%$q%' ");

$rows=mysqli_num_rows($result);
if ($rows> 0)
{
	echo '<table>';
		echo '<tr>';
			//echo '<th>'."Course Name".'</th>';
			echo '<th>'."Assignment Name".'</th>';
			echo '<th>'."Uploaded By".'</th>';
			//echo '<th>'."Upload Time".'</th>';
			//echo '<th>'."Remarks".'</th>';
			
		echo '</tr>';
	
	
    while($row = mysqli_fetch_assoc($result))
    {
        /*echo "<p><a href='#' class='leftborder'><b>".$row['id'].".".$row['assignmentname']." by ".$row['uploaded_by']."</b></a></p>";*/
		
		echo "<tr>";
        //echo "<td>".$row['coursename']."</td>";
		echo "<td>".$row['assignmentname']."</td>";
		echo "<td>".$row['uploaded_by']."</td>";
		//echo "<td>".$row['uploaded_at']."</td>";
		//echo "<td>".$row['remarks']."</td>";
		echo "</tr>";
		
    }
	
	echo '</table>';
}
else
{
    echo "No news found according to this search term";
}