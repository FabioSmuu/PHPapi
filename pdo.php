<?php
@require_once __DIR__ . '/config.php';

$pdo = new PDO("mysql:host=$localhost:$db_port;dbname=$db_name;charset=utf8", $db_user, $db_pass);

if(isset($_GET)) foreach($_GET As $ng=>$vg) $_GET[$ng] = _filter($vg);
if(isset($_POST)) foreach($_POST As $np=>$vp) $_POST[$np] = _filter($vp);
if(isset($_COOKIE)) foreach($_COOKIE As $nc=>$vc) $_COOKIE[$nc] = _filter($vc);
if(isset($_REQUEST)) foreach($_REQUEST As $nr=>$vr) $_REQUEST[$nr] = _filter($vr);
if(isset($_SESSION)) foreach($_SESSION As $ns=>$vs) $_SESSION[$ns] = _filter($vs);

// Agora filter pode ser usado como filter_var nativo no PHP.
function _filter($str) {
	$str = strip_tags($str);
	$str = trim($str);
	$str = addslashes($str);
	$str = htmlspecialchars(nl2br($str));
	$str = html_entity_decode($str);
	$str = htmlentities($str);
	return $str;
}

function _exec($query) {
	global $pdo;
	$table = $pdo->prepare($query);
	$table->execute();
	return $table;
}

function _read($query) {
	return _exec($query)->fetch();
}

function _list($query) {
	return _exec($query)->fetchAll();
}

function _count($query) {
	return _exec($query)->RowCount();
}

function _encode($pass) {
	$key = "xCg532%@%gdvf^5DGaa6&*rFTfg^FD4\$OIFThrR_gh(ugf*/";
	$pass = md5($pass);
	$pass = sha1($pass);
	$pass = hash('md5', $pass, false);
	$pass = hash('sha512', $pass);
	$pass = crypt($pass, $key);
	$pass = hash_hmac('md5', $pass, $key, false);
	$pass = mhash(MHASH_MD5, $pass, $key);
	return md5($pass.($key));
}
