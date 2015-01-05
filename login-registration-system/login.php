<?php 
require_once 'core/init.php';

if (Input::exists()){
	if (Token::check(Input::get('token'))){

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
				'username' => array('required' => true),
				'password' => array('required' => true)
		));

	if ($validation->passed()){
		$user = new User();
		$remember = (Input::get('remember') === 'on') ? true : false;
		
		$login = $user->login(Input::get('username'), Input::get('password'), $remember);
	
		if ($login){
		  Redirect::to('index.php');
		} else {
		   echo '<h3>Login failed. Incorrect username and/or password.</h3>';
		}
		} else {
			foreach($validation->errors() as $error){
				echo $error, '<br>';
			}
		}

	}

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

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus autocomplete="off">
        
        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
        <div class="checkbox">
          <label for ="remember">
	      <input type="checkbox" name="remember" id="remember"> Remember me
	   </label>
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
