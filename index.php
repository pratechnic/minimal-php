<?php
	require_once 'init.php';

	if(Session::exists('user'))
	{
		$user_id = Session::get('user');
		$user_info = DB::getInstance()->query('SELECT * from user_login where user_id = ?',array($user_id))->first();
?>
		<p> Welcome <a href = "#"><?php echo $user_info->fullname; ?></a></p>
		<ul>
			<li><a href="logout.php">Log Out</a></li>
		</ul>
<?php
	}
	else
		echo '<a href="login.php">Log In</a> or <a href="register.php">register</a>';
?>
