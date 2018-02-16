<?php
//Lade Regex/Antwort
$stmt = $dbh->prepare("
SELECT *
FROM freitext
WHERE id=:quiz_id");
$stmt->bindParam(":quiz_id", $_REQUEST["number"]);
$stmt->execute();
$freitext = $stmt->fetch();

$ergebnis = 0;
$normalisierteAntwort = str_replace(" ", "", strtolower($_REQUEST["answer"]));
if (preg_match($freitext["antwort"], $normalisierteAntwort)){
	$ergebnis = 1;
	?>
	<div class="alert alert-success fade in">
		<a class="close" data-dismiss="alert" href="#">x</a>
		Gut gemacht!
	</div>
	<?php
} else {
	?>
	<div class="alert alert-error fade in">
		<a class="close" data-dismiss="alert" href="#">x</a>
		Leider falsch!
	</div>
	<?php
}
//Lade bisherigen Versuch
$stmt = $dbh->prepare("
SELECT *
FROM quizerfolg
WHERE nutzer_id=:nutzer_id
AND quiz_id=:quiz_id");
$stmt->bindParam(":nutzer_id", $_SESSION["id"]);
$stmt->bindParam(":quiz_id", $_REQUEST["number"]);
$stmt->execute();
$quizerfolg = $stmt->fetch();

$versuch = $quizerfolg["versuch"]+1;
//Update nur, wenn weniger als 2 Versuche
if ($quizerfolg["versuch"]<2){
	$stmt = $dbh->prepare("
	UPDATE quizerfolg
	SET versuch=:versuch, erfolgreich=:erfolgreich
	WHERE quiz_id=:quiz_id and nutzer_id=:nutzer_id;");
	$stmt->bindParam(":versuch", $versuch);
	$stmt->bindParam(":erfolgreich", $ergebnis);
	$stmt->bindParam(":quiz_id", $_REQUEST["number"]);
	$stmt->bindParam(":nutzer_id", $_SESSION["id"]);
	
	$stmt->execute();
}
?>