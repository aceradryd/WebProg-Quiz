<?php
include($_SERVER['DOCUMENT_ROOT']."/_include/php/header.php");
include($_SERVER['DOCUMENT_ROOT']."/_include/html/header.html");
include($_SERVER['DOCUMENT_ROOT']."/_include/php/config.php");
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
        <a id="nextsection" href="#start"><i class="font-icon-arrow-simple-down"></i></a>
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
				//Die Navbar zeigt intern und nicht extern auf die aktuelle Seite
				if (window.location.hash == "" || $(window.location.hash.replace("#","#nav-")).length == 0){
					$("#nav-start").attr('class', 'current');
				} else {
					$(window.location.hash.replace("#","#nav-")).attr('class', 'current');
				}
				$('#nav-start').html('<a href="#start">Start</a>');
			</script>
        </nav>
        
    </div>
</header>

<div id="start" class="page">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-page">
                    <h2 class="title">Verschlüsselung</h2>
                </div>
            </div>
        </div>
        
        <div class="row">
			<div class="col-md-12">
				Diese Website dient der Wissenvermittlung und Überprüfung des Themengebiets "Verschlüsselung".<br>
                Zuerst sollten Sie die 5 Seiten zu Wissenvermittlung lesen. Daraufhin ist der Reiter "Quiz" in der Navigationsbar verfügbar, mit dem Sie zum Quiz gelangen.<br>
				<br>
				Eine Auswertung des Quiz finden Sie in Ihrem Profil.<br>
				<br>
				Gutes Gelingen!
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