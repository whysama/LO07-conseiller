<!DOCTYPE HTML>
<head>
    <meta charset="utf-8"/>
    <title>Attribution des conseillers à l'UTT</title>
    <link href='http://fonts.googleapis.com/css?family=Vollkorn:700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="public/css/login.css">
</head>
<body>
	<div class="content">
		<div class="title">
			<h3>Attribution des conseillers</h3>
		</div>
		<form class="login-form" action="<?php echo URL;?>Home/identifyUser" method = "POST">
			<div class="username">
				<input type="text" name="email" placeholder="prenom.nom@utt.fr"/>
				<span class="user-icon icon">u</span>
			</div>
			<div class="password">
				<input type="password" name="pwd" placeholder="******"/>
				<span class="password-icon icon">p</span>
			</div>
			<div class="submit">
				<input type="submit" name="submit" value = "Login"/>
			</div>
		</form>
		<footer>
			<h6>Ce projet est réalisé par <em>Shenyang ZHOU</em> et <em>Chengze HUANG</em> en 2014 à l'UTT</h6>
		</footer>
	</div>
</body>

<?php
/*

<div>
    <h2>LONGIN</h2>
    <form action="<?php echo URL;?>Home/identifyUser" method = "POST">
        <label>Email</label>
        <input type="text" name="email" value="" required/>
        <label>Password</label>
        <input type="password" name="pwd" value="" required/>
        <input type="submit" name="submit" value = "OK"/>
    </form>
</div>
*/
?>