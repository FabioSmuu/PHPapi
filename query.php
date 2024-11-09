<?php
function user($column, $username)
{
	$username = _filter($username);
	$column = _filter($column);

	$user = ler("SELECT * FROM users WHERE username = '$username' LIMIT 1;");
	return  $user[_filter($column)];
}

{
function json($json, $return = false)
	{
	if ($return)
		$json = array(
			'message' => $json
		);
	}
	
	print json_encode($json, JSON_NUMERIC_CHECK);
	exit;
}

function login($username, $password)
{	
	if ($password === user('senha', $username))
	{
		return user('id', $username);
	}
	else {
		json('Senha invalida.', true);
	}
}
