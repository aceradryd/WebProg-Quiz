<ul id="menu-nav">
	<?php
	//Gib je nach Anmeldung unterschiedliche Navbar aus
	if (isset($_SESSION["id"])){
		?>
		<li id="nav-start"><a href="/#start" class="external">Start</a></li>
		<li id="nav-info"><a href="/info/#info" class="external">Informationsvermittlung</a></li>
		<li id="nav-quiz"><a href="/quiz/#quiz" class="external">Quiz</a></li>
		<li id="nav-profile"><a href="/profile/#profile" class="external">Mein Profil</a></li>
		<?php
	} else {
		?>
		<li id="nav-login"><a href="/login/#login" class="external">Login</a></li>
		<li id="nav-register"><a href="/register/#register" class="external">Registrieren</a></li>
		<?php
	}
	?>
</ul>