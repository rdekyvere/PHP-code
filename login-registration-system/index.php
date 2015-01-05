<?php
require_once 'core/init.php';
//create the db connection
DB::getInstance();
if(Session::exists('success')){
	echo Session::flash('success');
}
if (Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login and Registration System</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
    
   
     
         <?php
	  $user = new User();
	  if($user->isLoggedIn()){
		  ?>
           <div class="alert alert-success" role="alert">
        		<strong>Logged in as:</strong> <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username);  
		?></a>
        <?php
		 if($user->hasPermission('admin')){
   			echo '<p>You are an Administrator.</p>';
   }
		?>
      </div>
          
          <div class="page-header">
             <a href="protected.php">Continue</a> to protected area.
          </div>
		  <div class="col-sm-4">
          <ul class="list-group">
            <li class="list-group-item"><a href="logout.php">Log out</a></li>
            <li class="list-group-item"><a href="update.php">Update your details</a></li>
            <li class="list-group-item"><a href="changepassword.php">Change password</a></li>
           
          </ul>
        </div>
	  
		  
   <?php
   
  
   
} else {
	?>
	<div class="alert alert-warning" role="alert">
        <strong>You need to <a href="login.php"> log in</a> or <a href="register.php"> register</a>.</strong>
      </div>
	<?php
  
}
?> 
      
      
     
     
    

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>