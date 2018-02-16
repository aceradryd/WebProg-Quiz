<?php
include($_SERVER['DOCUMENT_ROOT']."/_include/php/config.php");
include($_SERVER['DOCUMENT_ROOT']."/_include/php/header.php");
$page = $_REQUEST["seite"];
//Lade angegebene Seite aus der Datenbank
$stmt = $dbh->prepare("SELECT * FROM seiten WHERE id=:page;");
$stmt->bindParam(":page", $page);
$stmt->execute();
$result = $stmt->fetch();

if (isset($_SESSION["id"])){//Wenn Nutzer angemeldet ist
	//Füge die Seite zu seinen gelesenen Seiten hinzu
	$stmt = $dbh->prepare("INSERT INTO geleseneSeiten (`seiten_id`, `nutzer_id`) VALUES (:seiten_id, :nutzer_id);");
	$stmt->bindParam(":seiten_id", $page);
	$stmt->bindParam(":nutzer_id", $_SESSION["id"]);
	$stmt->execute();
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="title-page">
			<h2 class="title"><?php echo $result["titel"];?></h2>
		</div>
	</div>
</div>
<div>
	<?php echo $result["inhalt"];?>
</div>