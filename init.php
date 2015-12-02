<?php
	session_start();

	$GLOBALS['config']=array(										//Globals array to store standard constant values
		'mysql' => 	array(	'host' => '127.0.0.1',
												'user'=>'root',
												'pass'=>'',
												'db'=>'test' //Change this variable to the name of the created database
											),

		'remember' => array(
													'cookie_name' => 'hash',
													'cookie_expiry' => 604800
												),

		'session' => 	array(
													'session_name'=>'user',
													'token_name' =>'token'
									)
		);

	spl_autoload_register(function($class){							//Used to autoload classes without the need for including on every page
		require_once( __DIR__ . '/classes/'.$class.'.php');							//Usage - ClassName::function($something) (autoload class & access the function)
	});

	require_once('sanitize.php');

	if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name')))
	{
		$hash = Cookie::get(Config::get('remember/cookie_name'));
		$check = DB::getInstance()->get('session',array('hash','=',$hash));

		if ($check->count()) {
			$user = new User($check->first()->user_id);
			$user->login();
		}
	}
?>
