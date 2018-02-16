<?php
include($_SERVER['DOCUMENT_ROOT']."/_include/php/header.php");
include($_SERVER['DOCUMENT_ROOT']."/_include/php/config.php");

//Der Nutzer wird mittels Session und Cookie abgemeldet
if (isset($_REQUEST["abmelden"]) and $_REQUEST["abmelden"]){
	unset($_SESSION["user"]);
	unset($_SESSION["id"]);
	setcookie("user", "", time() - 3600, "/");
	setcookie("id", "", time() - 3600, "/");
}

//Der Nutzer versucht sich anzumelden
if (isset($_REQUEST["user"]) and isset($_REQUEST["pass"])) {
	$user = $_REQUEST["user"];
	$pass = $_REQUEST["pass"];
	
	//Überprüfe ob es ein Nutzer mit dem Nutzernamen gibt
	$stmt = $dbh->prepare("SELECT * FROM nutzer WHERE `nutzername`=:nutzername");
	$stmt->bindParam(':nutzername', $user);
	$stmt->execute();

	if ($row = $stmt->fetch()){
		//Überprüfe ob das Passwort stimmt
		if (password_verify($pass,$row["passwort"])){
			//Melde den Nutzer mit dem Cookie und Session an
			$_SESSION["user"]=$user;
			setcookie("user", $user, time() + (86400 * 30), "/");
			$_SESSION["id"]=$row["id"];
			setcookie("id", $row["id"], time() + (86400 * 30), "/");
		}
	}
}
//Spätes Include, da erst das Cookie gesendet werden muss
include($_SERVER['DOCUMENT_ROOT']."/_include/html/header.html");
?>
<body>
<?php
//Wenn angemeldet, dann zum Start
if (isset($_SESSION["user"]) and isset($_SESSION["id"])){
	?>
	<script>
		window.location.href = "/#start"
	</script>
	<?php
}
?>
<div id="home-slider">	
    <div class="slider-text">
    	<div id="slidecaption"><div class="slide-content">Verschlüsselung</div></div>
    </div>   
	
	<div class="control-nav">
        <a id="nextsection" href="#login"><i class="font-icon-arrow-simple-down"></i></a>
    </div>
</div>

<header>
    <div class="sticky-nav">
    	<a id="mobile-nav" class="menu-nav" href="#menu-nav"></a>
        
        <div id="logo">
        	Verschlüsselung
        </div>
        
        <nav id="menu">
        	<?php
				include($_SERVER['DOCUMENT_ROOT']."/_include/php/navbar.php");
			?>
			<script>
				if (window.location.hash == "" || $(window.location.hash.replace("#","#nav-")).length == 0){
					$("#nav-login").attr('class', 'current');
				} else {
					$(window.location.hash.replace("#","#nav-")).attr('class', 'current');
				}
				$('#nav-login').html('<a href="#login">Login</a>');
			</script>
        </nav>
        
    </div>
</header>

<div id="login" class="page">
	<div class="container">
        <div class="row">
			<div class="col-md-12">
				<div class="title-page">
					<h2 class="title">Login</h2>
				</div>
				<?php
					//Wenn keine Weiterleitung aber Anmeldung stattfand, wurde kein Profil gefunden
					if (isset($_REQUEST["user"])){
						?>
						<div class="alert alert-error fade in">
							<a class="close" data-dismiss="alert" href="#">×</a>
							Für diese Kombination aus Benutzernamen und Passwort wurde kein Profil gefunden.
						</div>
						<?php
					}
				?>
				<form id="login-form" class="form" action="./#login" method="post">
					<p>
						<input type="text" placeholder="Benutzername" value="<?php if (isset($_REQUEST["user"])) echo $_REQUEST["user"];?>" name="user" />
					</p>
					<p>
						<input type="password" placeholder="Passwort" value="" name="pass" />
					</p>
					<input type="submit" style="position: absolute; left: -9999px"/>
					<p>
						<a class="submit" href="javascript:void(0)" onclick="$('#login-form').submit()">Login</a>
					</p>
				</form>
			</div>
		</div>
    </div>
</div>


<?php
include($_SERVER['DOCUMENT_ROOT']."/_include/html/credits.html");
?>

<a id="back-to-top" href="#">
	<i class="font-icon-arrow-simple-up"></i>
</a>

</body>
</html>