<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Authorization code should be in the "code" query param
if (isset($_GET['code'])) {
	//echo 'Auth code: '.$_GET['code'];
	//echo 'Auth code: '.$_GET['state'];

	$url = 'https://specxnet.com/outlook/token?code='.$_GET['code'].'&state='.$_GET['state'];
	header('Location: '.$url);
	exit();
	exit();
}
elseif (isset($_GET['error'])) {
	exit('ERROR: '.$_GET['error'].' - '.$_GET['error_description']);
}
