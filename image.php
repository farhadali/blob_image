<?php
    require_once "db.php";
    if(isset($_GET['id'])) {
        $sql = "SELECT photo  FROM users WHERE id=" . $_GET['id'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: image/jpeg");
        echo $row["photo"];
	}
	mysqli_close($conn);
?>