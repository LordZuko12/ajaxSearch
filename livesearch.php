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
    while($row = mysqli_fetch_assoc($result))
    {
        echo "<p><a href='#' class='leftborder'><b>".$row['id'].".".$row['assignmentname']." by ".$row['uploaded_by']."</b></a></p>";
    }

}
else
{
    echo "No news found according to this search term";
}