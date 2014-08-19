<!DOCTYPE html>
<html>
	<head>
		<title>Massive Project Here</title>
	</head>
	<body>
		<div id="container">
			<div id="top-menu">
				<ul>
					<li>Menu 1</li>
					<li>Menu 2</li>
				</ul>
			</div>
			<?php if( ! empty( $this->logged_user ) ): ?>
				<div id="user_center">
					<p>
						Welcome, <?php echo $this->logged_user['username']; ?>!
						<a href="<?php echo DX_ROOT_URL; ?>login/logout">[Logout]</a>
					</p>
				</div>
			<?php endif; ?>
			<div id="main">