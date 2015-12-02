<?php
class User
{
	private $_db, $_data, $_sessionName,$_cookieName, $isLoggedIn;

	public function __construct($user=null)
	{
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');
		if(!$user)
		{
			if(Session::exists($this->_sessionName))
			{
				$user = Session::get($this->_sessionName);

				if($this->find($user))
				{
					$this ->isLoggedIn = true;
				}
				else
				{
					$this->logout();
				}
			}
		}
		else
		{
			$this->find($user);
		}
	}

	public function create($fields=array())
	{
		if($this->_db->insert('user_login',$fields))
		{
			return true;
		}
		else
		{
			throw new Exception('Problem Creating account');
		}
	}

	public function find($user=null)
	{
		if($user)
		{
			$field = (is_numeric($user)) ? 'user_id': 'user_email';
			$data = $this->_db->get('user_login',array('user_email', '=', $user));

			if($data->count())
			{
				$this->_data = $data->first();
				return true;
			}
		}

		return false;
	}

	public function login($username = null,$password = null,$remember = false)
	{
		if(!$username && !$password && $this->exists())
		{
			Session::put($this->_sessionName,$this->data()->user_id);
		}
		else
		{
			$user=$this->find($username);
			if($user)
			{
				$check=Hash::make($password,$this->data()->salt);
				if($this->data()->user_password === $check)
				{
					Session::put($this->_sessionName, $this->data()->user_id);
					Session::put('email',$this->data()->user_email);

					if($remember)
					{
						$hashcheck = $this->_db->get('session',array('user_id','=',$this->data()->user_id));

						if(!$hashcheck->count())
						{
							$hash = Hash::unique();
							$this->_db->insert('session',array(
								'user_id' => $this->data()->user_id,
								'hash' => $hash,
								'email' => $username
								));
						}
						else
						{
							$hash = $hashcheck->first()->hash;
						}

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}

					return true;
				}
			}
		}

		return false;

	}

	public function logout()
	{
		$this->_db->delete('session',array());
		session_destroy();
		Cookie::delete($this->_cookieName);
	}
	public function data()
	{
		return $this->_data;
	}

	public function isLoggedIn()
	{
		return $this->isLoggedIn;
	}

	public function exists()
	{
		return (!empty($this->_data))? true: false;;
	}
}
