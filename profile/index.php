<?php
include($_SERVER['DOCUMENT_ROOT']."/_include/php/header.php");
include($_SERVER['DOCUMENT_ROOT']."/_include/html/header.html");
include($_SERVER['DOCUMENT_ROOT']."/_include/php/config.php");

if (isset($_REQUEST["nutzername"]) and isset($_REQUEST["email"])) {
	$nutzername = $_REQUEST["nutzername"];
	$email = $_REQUEST["email"];
	//Nutzername und Email wird auf Wunsch des Nutzers angepasst
	$stmt = $dbh->prepare("UPDATE `nutzer` SET `nutzername`=:nutzername, `email`=:email WHERE `id`=:id;");
	$stmt->bindParam(':nutzername', $nutzername);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':id', $_SESSION["id"]);
	$stmt->execute();
}


if (isset($_REQUEST["pass"]) and $_REQUEST["pass"]!="") {
	$pass = $_REQUEST["pass"];
	if ($pass == $_REQUEST["passw"]){
			$hash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);
			//Passwort wird auf Wunsch des Nutzers geupdatet
			$stmt = $dbh->prepare("UPDATE `nutzer` SET `passwort`=:passwort WHERE `id`=:id;");
			$stmt->bindParam(':passwort', $hash);
			$stmt->bindParam(':id', $_SESSION["id"]);
			$stmt->execute();
	}
}
?>
<body>
<?php
//Wenn nicht angemeldet, dann zum Login
if (!isset($_SESSION["user"]) or !isset($_SESSION["id"])){
	?>
	<script>
		window.location.href = "/login/#login"
	</script>
	<?php
	die();
}
?>
<div id="home-slider">	
    <div class="slider-text">
    	<div id="slidecaption"><div class="slide-content">Verschlüsselung</div></div>
    </div>   
	
	<div class="control-nav">
        <a id="nextsection" href="#profile"><i class="font-icon-arrow-simple-down"></i></a>
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
					$("#nav-profile").attr('class', 'current');
				} else {
					$(window.location.hash.replace("#","#nav-")).attr('class', 'current');
				}
				$('#nav-profile').html('<a href="#profile">Mein Profil</a>');
			</script>
        </nav>
        
    </div>
</header>

<div id="profile" class="page">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-page">
                    <h2 class="title">Mein Profil</h2>
                </div>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<form id="profile_form" class="form" action="./#profile" method="post">
					<?php
					//Aktuelle Nutzerdaten werden eingepflegt
					$stmt = $dbh->prepare("SELECT * FROM nutzer WHERE id=:id;");
					$stmt->bindParam(':id', $_SESSION["id"]);
					$stmt->execute();
					$userdata = $stmt->fetch();
					?>
					<div id="warning"></div>
					<p>
						<input type="text" placeholder="Benutzername" value="<?php echo $userdata["nutzername"]?>" name="nutzername" />
					</p>
					<p>
						<input type="text" placeholder="E-Mail" value="<?php echo $userdata["email"]?>" name="email" />
					</p>
					<p>
						<input id="login_pass" type="password" placeholder="Passwort" value="" name="pass"/>
					</p>
					<p>
						<input id="login_passw" type="password" placeholder="Passwort wiederholen" value="" name="passw"/>
					</p>
					<input type="submit" style="position: absolute; left: -9999px"/>
					<div class="row">
						<div class="col-md-2">
							<p class="login-submit">
								<a id="login-submit" class="submit" href="javascript:void(0)" onclick="check()">Absenden</a>
							</p>
						</div>
						<div class="col-md-2">
							<p class="login-submit">
								<a id="login-submit" class="submit" href="/login/?abmelden=true#login">Abmelden</a>
							</p>
						</div>
					</div>
					<script>
						function check(){
							if ($("#login_pass").val() == $("#login_passw").val()){
								$('#profile_form').submit();
							} else {
								$("#warning").html('<div class="alert alert-error fade in"><a class="close" data-dismiss="alert" href="#">×</a>Passwörter sind nicht gleich.</div>');
							}
						}
					</script>
				</form>
				<br>
                <div class="title-page">
                    <h2 class="title">Gesamtbewertung</h2>
                </div>
				<table class="data-table">
					<thead>
						<tr>
							<th>Anzahl richtiger Lösungen</th>
							<th>Anzahl bearbeiteteter Aufgaben</th>
							<th>Gesamtanzahl an Aufgaben</th>
						</tr>
					</thead>
					<?php
					//Gesamtbewertung vom Nutzer aus View wird abgerufen
					$stmt = $dbh->prepare("SELECT * FROM gesamtbewertung WHERE nutzer_id = :nutzer_id;");
					$stmt->bindParam(':nutzer_id', $_SESSION["id"]);
					$stmt->execute();
					$gesamtbewertung = $stmt->fetch();
					?>
					<tbody>
						<tr>
							<td><?php echo $gesamtbewertung["erfolgreich"];?></td>
							<td><?php echo $gesamtbewertung["anzahl"];?></td>
							<td>15</td>
						</tr>
					</tbody>
					<thead>
						<tr>
							<th>Frage</th>
							<th>Gebrauchte Versuche</th>
							<th>Erfolgreich</th>
						</tr>
					</thead>
					<tbody>
					<?php
					//Bewertung der einzelnen Bewertung wird abgerufen
					$stmt = $dbh->prepare("SELECT * FROM einzelbewertung WHERE nutzer_id = :nutzer_id;");
					$stmt->bindParam(':nutzer_id', $_SESSION["id"]);
					$stmt->execute();
					$einzelbewertung = $stmt->fetchAll();
					foreach ($einzelbewertung as $bewertung)
					{
						?>
						<tr>
							<td><?php echo $bewertung["frage"];?></td>
							<td><?php echo $bewertung["versuch"];?></td>
							<td><?php if ($bewertung["erfolgreich"]){ echo "JA";} else { echo "NEIN";}?></td>
						</tr>
						<?php
					}?>
					</tbody>
				</table>
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