<?php
header("Access-Control-Allow-Origin: *");
@require_once __DIR__ . '/pdo.php';
@require_once __DIR__ . '/query.php';

header('Content-Type: application/json');

if(!isset($_GET['username'])) json('...', true);

$username = _filter($_GET['username']);

if(!user('username', $username)) json('Cliente invalido.', true);

if(isset($_GET['password'])) {
	$password = _encode(_filter($_GET['password']));

	$json = array(
		'login' => login($username, $password)
	);

	json($json);
}

$json = array(
	'ID' => user('id', $username),
	'username' =>  user('username', $username),
	'email' =>  user('email', $username)
);

json($json);
