<?php
require_once 'core/init.php';

if (Input::exists()){
	if (Token::check(Input::get('token'))){
	$validate = new Validate();
	$validation = $validate->check($_POST, array(
			'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20,
					'unique' => 'users'
			),
			'password' => array(
					'required' => true,
					'min' => 6
			),
			'password_again' => array(
					'required' => true,
					'matches' => 'password'
			),
			'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
			)

	));
	
	if($validation->passed()){
			$user = new User();
			$salt = Hash::salt(32);

			try{
			   $user->create(array(
				'username' => Input::get('username'),
				'password' => Hash::make(Input::get('password'), $salt),
				'salt' => $salt,
				'name' => Input::get('name'),
				'joined' => date('Y-m-d H:i:s'),
				'group' => 1
			   ));
			   Session::flash('home', 'You have been registered and can now log in!');
			   Redirect::to('index.php');
			   } catch (Exception $e) {
				die($e->getMessage());
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
        <h2 class="form-signin-heading">Registration details</h2>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" value="<?php echo escape(Input::get('username')); ?>" placeholder="Username" required autofocus autocomplete="off">
        
        <label for="password" class="sr-only">Choose a password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Choose a password" required>
        <label for="password_again" class="sr-only">Enter the password again</label>
        <input type="password" id="password_again" name="password_again" class="form-control" placeholder="Enter the password again" required>
        
         <label for="name" class="sr-only">Your name</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo escape(Input::get('name')); ?>" placeholder="Your name" required autofocus autocomplete="off">
        
       
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
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
