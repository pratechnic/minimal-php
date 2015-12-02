<?php
	require_once 'init.php';

	if(Input::exists())
	{
		if(Token::check(Input::get('token')))
		{
			$user=new User();
			$login = $user->login(Input::get('email'),Input::get('password'));
			if($login)
			{
				Redirect::to('index.php');
			}
			else
			{
				echo '<p>Login Failed!</p>';
			}

		}
	}
?>
<form action="" method="post">
	<div class="field">
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" autocomplete="off">
	</div>

	<div class="field">
		<label for="password">Password:</label>
		<input type="password" name="password" value="" id="password" autocomplete="off">
	</div>

	<input type="hidden" name="token" value="<?php echo Token::generate();?>">

	<input type="submit" value="Log in">
</form>

