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
        <a id="nextsection" href="#quiz"><i class="font-icon-arrow-simple-down"></i></a>
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
					$("#nav-quiz").attr('class', 'current');
				} else {
					$(window.location.hash.replace("#","#nav-")).attr('class', 'current');
				}
				$('#nav-quiz').html('<a href="#quiz">Quiz</a>');
			</script>
        </nav>
        
    </div>
</header>

<div id="quiz" class="page">
	<div class="container">
        <?php
		//Lädt View aus der Datenbank und überprüft, ob Nutzer alle Seiten gelesen hat
		$stmt = $dbh->prepare("SELECT * FROM quizbereitschaft WHERE nutzer_id=:id;");
		$stmt->bindParam(":id", $_SESSION["id"]);
		$stmt->execute();
		if ($result = $stmt->fetch()){
			//Falls Nutzer alle Seiten gelesen hat lade das Quiz
			include "specificQuiz.php";
		} else {
			//Sonst gebe "Fehlermeldung" aus
		?>

        <div class="row">
            <div class="col-md-12">
                <div class="title-page">
                    <h2 class="title">Quiz</h2>
                </div>
            </div>
        </div>
		
		<div class="row">
			<div class="col-md-12">
				Du musst dir erst Wissen aneignen bevor du das Quiz absolvieren kannst!
            </div>
        </div>
		
		<?php
		}
		?>
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