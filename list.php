
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1 user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="dist/cropme.css">
    <title>User List</title>
    </style>
</head>
<?php
include_once 'db.php';
$sql = 'SELECT * FROM users ORDER BY id DESC';
$result = mysqli_query($conn,$sql);
?>

<body>
    <div class="container">
    	<?php require_once "nav.php"; ?>
    			<?php
			if (mysqli_num_rows($result) > 0) {
			?>
			  <table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">User</th>
			      <th scope="col">Full Name</th>
			      <th scope="col">Email</th>
			      <th scope="col">Mobile</th>
			      <th scope="col">photo</th>
			      <!-- <th scope="col">active</th> -->
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <body>
			<?php
			$i=0;
			while($row = mysqli_fetch_array($result)) {

			?>
			<tr>
			    <td><?php  echo $i+1;?></td>
			    <td><?php echo $row["user"]; ?></td>
			    <td><?php echo $row["full_name"]; ?></td>
			    <td><?php echo $row["email"]; ?></td>
			    <td><?php echo $row["mobile"]; ?></td>
			    <td>
			    	<img height="200" width="200" src="image.php?id=<?php echo $row['id']?>"/>
			    <td>
			    	<a href="index.php?id=<?php echo $row['id']; ?>"> edit</a>
			    </td>
			    
			    
			</tr>
			<?php
			$i++;
			}
			?>
			</body>
			</table>
			 <?php
			}
			else{
			    echo "No result found";
			}
			?>

    </div>

    
</body>

</html>
