<?php
 	require_once 'init.php';

 	if(Input::exists())
 	{
 		if(Token::check(Input::get('token')))
 			{

		 		$user = new User();

		 		$salt = Hash::salt(32);

		 		try
		 		{
		 			$user->create(array(
		 				'user_email' => Input::get('email') ,
		 				'user_password' => Hash::make(Input::get('password'),$salt),
		 				'salt' => $salt,
		 				'fullname' => Input::get('name'))
		 			);

		 			echo '<br>User created!';
		 		}
		 		catch(Exception $e)
		 		{
		 			die($e->getMessage());
		 		}
		 	}

 	}

?>

<a href="login.php">Login</a>

<form action = "" method="post">
	<div class="field">
		<label for="Email">Email:</label>
		<input type="text" name="email" value="" id="email">
	</div>

	<div class="field">
		<label for="password">Enter Password:</label>
		<input type="password" name="password" id="password">
	</div>

	<div class="field">
		<label for="password_a">Enter password again:</label>
		<input type="password" name="password_a" id="password_a">
	</div>

	<div class="field">
		<label for="name">Name:</label>
		<input type="text" name="name" value="" id="name">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>">
	<input type="submit" value="Register">
</form>

