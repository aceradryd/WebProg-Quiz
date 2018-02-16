<?php
//Lade richtige Antwort aus der Datenbank
$stmt = $dbh->prepare("
SELECT *
FROM singleChoice
WHERE id=:quiz_id");
$stmt->bindParam(":quiz_id", $_REQUEST["number"]);
$stmt->execute();
$singleChoice = $stmt->fetch();

//Überprüfe, ob gegebene Antwort richtig ist und gebe Feedback zurück
$ergebnis = 0;
if ($_REQUEST["answer"] == $singleChoice["antwort"]){
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

//Rufe bisherige Versuche ab
$stmt = $dbh->prepare("
SELECT *
FROM quizerfolg
WHERE nutzer_id=:nutzer_id
AND quiz_id=:quiz_id");
$stmt->bindParam(":nutzer_id", $_SESSION["id"]);
$stmt->bindParam(":quiz_id", $_REQUEST["number"]);
$stmt->execute();
$quizerfolg = $stmt->fetch();

//Erhöhe den Versuch um 1
$versuch = $quizerfolg["versuch"]+1;
//Trage ergebnis nur ein, wenn es bisher nicht zweimal probiert wurde
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