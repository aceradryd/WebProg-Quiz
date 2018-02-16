<?php
//Überprüfe ob Antwort abgegeben wurde
if (isset($_REQUEST["typ"])){
	//Überprüfe Antwort passend zum Typ
	if ($_REQUEST["typ"] == "1"){
		include "singleChoiceEvaluation.php";
	} elseif ($_REQUEST["typ"] == "2"){
		include "multipleChoiceEvaluation.php";
	} elseif ($_REQUEST["typ"] == "3"){
		include "freitextEvaluation.php";
	}
}
//Frage ab, ob ein Nutzer bei einer Frage maximal einen Versuch benutzt hat und noch nicht erfolgreich war
$stmt = $dbh->prepare("
	SELECT *
	FROM quizerfolg
	JOIN quiz ON (quiz.id = quizerfolg.quiz_id)
	WHERE versuch <= 1
	AND erfolgreich = 0
	AND nutzer_id = :id");
$stmt->bindParam(":id", $_SESSION["id"]);
$stmt->execute();
$versuch = 0;
if ($result = $stmt->fetch()){
	//Lade zum Fragetyp passende Seite
	$versuch = $result["versuch"];
	if ($result["typ"] == 1){
		include "singleChoice.php";
	} elseif ($result["typ"] == 2){
		include "multipleChoice.php";
	} elseif ($result["typ"] == 3){
			include "freitext.php";
	}
	
} else {
	//Lade eine zufällige noch nicht bearbeitete Aufgabe
	$stmt = $dbh->prepare("
	SELECT *
	FROM quiz
	LEFT JOIN (SELECT * FROM quizerfolg WHERE quizerfolg.nutzer_id = :id) as specificQuizErfolg
		ON (quiz.id = specificQuizErfolg.quiz_id)
	WHERE nutzer_id IS NULL
	ORDER BY RAND()
	LIMIT 1;");
	$stmt->bindParam(":id", $_SESSION["id"]);
	$stmt->execute();
	if ($result = $stmt->fetch()){
		//Wenn eine Frage gefunden wurde, trage den nullten versuch ein
		$stmt = $dbh->prepare("
		INSERT INTO
		quizerfolg (quiz_id, nutzer_id, versuch, erfolgreich)
		VALUES (:quiz_id, :nutzer_id, '0', '0');");
		$stmt->bindParam(":quiz_id", $result["id"]);
		$stmt->bindParam(":nutzer_id", $_SESSION["id"]);
		$stmt->execute();
		//Lade zum Fragetyp passende Seite
		if ($result["typ"] == 1){
			include "singleChoice.php";
		} elseif ($result["typ"] == 2){
			include "multipleChoice.php";
		} elseif ($result["typ"] == 3){
			include "freitext.php";
		}
		
	} else {
	//Keine Frage gefunden => Alle beantwortet
	?>
		<div class="row">
            <div class="col-md-12">
                <div class="title-page">
                    <h2 class="title">Alle Fragen beantwortet!</h2>
                </div>
            </div>
        </div>
	<?php
	
	}
}
?>