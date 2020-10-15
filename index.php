
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
    <title>User information</title>
    </style>
</head>
<?php


/*$begin = new DateTime("09:00");
$end   = new DateTime("13:00");

$interval = DateInterval::createFromDateString('45 min');

$times    = new DatePeriod($begin, $interval, $end);

foreach ($times as $time) {
    echo $time->format('H:i'), '-', 
         $time->add($interval)->format('H:i'), "\n"
         ;
}*/






if(isset($_GET['id'])){
  require_once "db.php";
  $id =  $_GET['id'];
  	$sql = 'SELECT * FROM `users` WHERE id='.$id.'
';
	$result = mysqli_query($conn,$sql);
	$user=mysqli_fetch_assoc($result);
	$form_name = "User information Update";


}else{
$form_name = "Create New user";
}

//exit();
?>
<body>

    <div class="container">
    <?php require_once "nav.php"; ?>
    	
    	<h3><?php echo $form_name;  ?></h3>
    	<div class="row">
    		<div class="col-md-6">
    			<form action="action.php" enctype='multipart/form-data' method="POST">
			    	  <div class="form-group">
					    <label for="user">User Name <span>*</span></label>
					    <input type="text" name="user"  class="form-control" id="user" placeholder="User Name" required value="<?php if(isset($user['user'])) echo $user['user'] ?? '' ?>" >
					  </div>

			    	  <div class="form-group">
					    <label for="full_name">full name  <span>*</span></label>
					    <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" required value="<?php if(isset($user['full_name'])) echo $user['full_name'] ?? '' ?>">
					  </div>

			    	  <div class="form-group">
					    <label for="mobile">Mobile  <span>*</span></label>
					    <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Mobile" max="15" required value="<?php if(isset($user['mobile'])) echo $user['mobile'] ?? '' ?>">
					  </div>
					  <div class="form-group">
					    <label for="email">Email address</label>
					    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required value="<?php if(isset($user['email'])) echo $user['email'] ?? '' ?>">
					    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					  </div>
					  <div class="form-group">
					    <label for="password">Password <span>*</span></label>
					    <input type="password" name="password" class="form-control" id="password" placeholder="Password" 
					    <?php if(!isset($_GET['id'])){ echo "required"; }  ?>    >
					  </div>
					  <div class="form-group">
					  	<label for="active">active <span>*</span></label>
					  	<select name="active" class="form-control" required>
					  		<option value="0" <?php if(isset($user['active'])){if($user['active']==0){ echo "selected";}} ?> >In Active</option>
					  		<option value="1" <?php if(isset($user['active'])){if($user['active']==1){ echo "selected";}} ?> >Active</option>
					  	</select> 
					  							    
					  </div>
					  <div class="form-group">
					  	<div class="row">
					  		<div class="col-md-6">
					  			<label for="user_img">Photo <span>*</span></label>
							    <input type="hidden" name="photo" id="photo" >
							    <input type="file" name="user_img" class="form-control" id="user_img"  >
					  		</div>
					  		<div class="col-md-6">
					  			<?php
					  			if(isset($user['photo'])){ ?>
					  		<img id="croped_image" height="200" width="200" src="image.php?id=<?php echo $user['id'];  ?>"/>
					  			<?php }else{ ?>
					  				<img id="croped_image" src="" height="200" width="200" src="">
					  		<?php	} ?>
					  			
					  			
					  		</div>
					  	</div>

					    
					  </div>
					  <?php  if(isset($_GET['id'])){ ?>
					  	<input type="hidden" name="id" value="<?php echo $user['id'];  ?>">
						<button type="submit" name="update" class="btn btn-primary">Submit</button>

					<?php }else{ ?>

							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					<?php } ?>

					  
					</form>
    		</div>
    		<div class="col-md-6">
    			<section class="p-4">
		        <div class="container">
		            
		            <div class="row " id="app">
		                <div class="col-md-12">
		                    <div id="cropme"></div>
		                    <!-- Modal -->
		                    <div class="modal fade" id="cropmeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		                        aria-hidden="true">
		                        <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                                <div class="modal-header">
		                                    <h5 class="modal-title">Cropme result</h5>
		                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                        <span aria-hidden="true">&times;</span>
		                                    </button>
		                                </div>
		                                <div class="modal-body text-center">
		                                    <img id="cropme-result" src="" alt="cropme">
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="modal fade" id="cropmePosition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		                        aria-hidden="true">
		                        <div class="modal-dialog" role="document">
		                            <div class="modal-content">
		                                <div class="modal-header">
		                                    <h5 class="modal-title">Cropme Position output</h5>
		                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                                        <span aria-hidden="true">&times;</span>
		                                    </button>
		                                </div>
		                                <div class="modal-body">
		                                    <pre><code>{{ position}}</code></pre>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="col-md-12">
		                    <div class="options">
		                        <div class="row">
		                            <div class="col-md-6">
		                                <div class="title">Viewport Type</div>
		                                <select class="form-control" v-model="options.viewport.type">
		                                    <option value="square">square (default)</option>
		                                    <option value="circle">circle</option>
		                                </select>
		                            </div>
		                            <div class="col-md-6">
		                                <div class="title">transform origin center</div>
		                                <select class="form-control" v-model="options.transformOrigin">
		                                    <option value="image">image</option>
		                                    <option value="viewport">viewport (default)</option>
		                                </select>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="options">
		                        <div class="title">Border</div>
		                        <div class="row">
		                            <div class="col-md-4">
		                                enable: <select class="form-control" v-model="options.viewport.border.enable">
		                                    <option :value="true">true (default)</option>
		                                    <option :value="false">false</option>
		                                </select>
		                            </div>
		                            <div class="col-md-4">
		                                width: <select class="form-control" v-model="options.viewport.border.width">
		                                    <option value="2">2 (default)</option>
		                                    <option value="5">5</option>
		                                    <option value="10">10</option>
		                                </select>
		                            </div>
		                            <div class="col-md-4">
		                                color: <select class="form-control" v-model="options.viewport.border.color">
		                                    <option value="#fff">white (default)</option>
		                                    <option value="#f00">red</option>
		                                    <option value="#00f">bleu</option>
		                                </select>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="options">
		                        <div class="title">Zoom</div>
		                        <div class="row">
		                            <div class="col-md-4">
		                                enable: <select class="form-control" v-model="options.zoom.enable">
		                                    <option :value="true">true (default)</option>
		                                    <option :value="false">false</option>
		                                </select>
		                            </div>
		                            <div class="col-md-4">
		                                mouseWheel: <select class="form-control" v-model="options.zoom.mouseWheel">
		                                    <option :value="true">true (default)</option>
		                                    <option :value="false">false</option>
		                                </select>
		                            </div>
		                            <div class="col-md-4">
		                                slider: <select class="form-control" v-model="options.zoom.slider">
		                                    <option :value="true">true</option>
		                                    <option :value="false">false (default)</option>
		                                </select>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="options">
		                        <div class="title">Rotation</div>
		                        <div class="row">
		                            <div class="col-md-4">
		                                enable: <select class="form-control" v-model="options.rotation.enable">
		                                    <option :value="true">true (default)</option>
		                                    <option :value="false">false</option>
		                                </select>
		                            </div>
		                            <div class="col-md-4">
		                                slider: <select class="form-control" v-model="options.rotation.slider">
		                                    <option :value="true">true</option>
		                                    <option :value="false">false (default)</option>
		                                </select>
		                            </div>
		                            <div class="col-md-4">
		                                Position: <select class="form-control" v-model="options.rotation.position">
		                                    <option value="left">left</option>
		                                    <option value="right">right (default)</option>
		                                </select>
		                            </div>
		                        </div>
		                    </div>
		                    <div class="mt-4">
		                        <button class="btn btn-outline-danger" @click="reset">Reset </button>
		                        <button class="btn btn-outline-success float-right" @click="crop">Crop me</button>
		                        <button class="btn btn-outline-info float-right mr-3" @click="getPosition">Get position</button>
		                    </div>
		                </div>
		                
		            </div>
		        </div>
		    </section>
    		</div>
    	</div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
    <script src="dist/cropme.js"></script>
    <script src="js/app.js"></script>
    <script type="text/javascript">
    	function readURL(input) {
    		if(input.files[0].type=='image/jpeg'){
    			if (input.files && input.files[0]) {
			    var reader = new FileReader();
			    
			    reader.onload = function(e) {
			      $('.cropme-container img').attr('src', e.target.result);
			    }
			    
			    reader.readAsDataURL(input.files[0]); // convert to base64 string
			  }
    		}else{
    			alert('Please input only JPEG Image');
    			return false;
    		}
			  
			}

			$("#user_img").change(function() {
			   readURL(this);
			});
    </script>
<?php 
if(isset($_GET['id'])){ ?>
	<script type="text/javascript">
		$( document ).ready(function() {
			var imag_url = $('#croped_image').attr('src');
		    $('.cropme-container img').attr('src', imag_url );
		});
			
	</script>

<?php } ?>
   
</body>

</html>
