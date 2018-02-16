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
        <a id="nextsection" href="#info"><i class="font-icon-arrow-simple-down"></i></a>
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
					$("#nav-info").attr('class', 'current');
				} else {
					$(window.location.hash.replace("#","#nav-")).attr('class', 'current');
				}
				$('#nav-info').html('<a href="#info">Informationsvermittlung</a>');
			</script>
        </nav>
        
    </div>
</header>

<div id="info" class="page">
	<div class="container">
		<div class="row">
            <div class="col-md-12">
                <div class="title-page">
                    <h2 class="title">Verschlüsselung</h2>
                </div>
            </div>
        </div>
		<div align="center">
			<a class="button button-large" href="#1">1. Einführung</a>
			<a class="button button-large" href="#2">2. Symmetrische Verfahren</a>
			<a class="button button-large" href="#3">3. Caesar-Verschlüsselung</a>
			<br><br>
			<a class="button button-large" href="#4">4. Asymmetrische Verfahren</a>
			<a class="button button-large" href="#5">5. RSA-Verschlüsselung</a>
		</div>
		<br>
		<br>
		<div id="seite">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
		<script>
			//Seiten werden mit AJAX/JQUERY geladen
			function loadPage(parameter) {
				$.get('seite.php?seite='+parameter, function(data) {
					$('#seite').html(data);	
				})
			}
			
			$(function(){
			  $(window).hashchange( function(){
				var hash = window.location.hash;
				if (!((hash == "") || (hash == "#info") || (hash == "#menu-nav"))){
					hash = hash.substr(1);//Entferne # aus #[...]
					loadPage(hash);
				}
			  })
			  
			  $(window).hashchange();
			});
		</script>
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