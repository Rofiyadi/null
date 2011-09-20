<?php
	$loggedIn = isset($_SESSION['loggedIn']);
	if ( $loggedIn ) $user = unserialize($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
	<head>
	<title><?php echo formatTitle($title) ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="assets/css/styles.css" />
    <script type="text/javascript" src="assets/js/jquery-1.6.4.min.js"></script>
    <script type="text/javascript" src="assets/js/scripts.js"></script>
</head>
<body>

	<div id="shader"></div>

	<div data-role="header">
		<h1>
<?php if ( $loggedIn ) { ?>
			<img src="assets/images/avatars/<?php echo $user->uID ?>.png" alt="avatar" title="<?php echo $user->username ?>" />
<?php } ?>
			<a href="./" id="logo" title="home"><img src="assets/images/banner/banner.png" alt="banner" /></a>
<?php if ( $loggedIn ) { ?>
			<img src="assets/images/settings.png" alt="menu" title="menu" id="menu" />
<?php } ?>
		</h1>
		<div id="settings"></div>
	</div>

	<div data-role="content">
