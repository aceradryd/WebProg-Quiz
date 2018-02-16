<div>
<form id="multipleChoice" class="form" action="./#quiz" method="post">
<?php
//Lade Fragestellung inkl. Hilfestellung
$stmt = $dbh->prepare("SELECT * FROM multipleChoice WHERE id = :id");
$stmt->bindParam(":id", $result["id"]);
$stmt->execute();
$multipleChoice = $stmt->fetch();
?>
	<div class="info-block">
		<div class="info-text">
			<h3>Multiple Choice - Nr. <?php echo $multipleChoice["id"]?></h3>
			<p>
				<?php echo $multipleChoice["frage"]?>
			</p>
			<?php
			//Gebe Hinweis, falls zweiter Versuch
			if ($versuch == 1){
				?>
				<br>
				<p>
					Hinweis: <?php echo $multipleChoice["hinweis"]?>
				</p>
				<?php
			}
			?>
			<br>
			<p>
				<input type="hidden" name="typ" value="2">
			</p>
			<p>
				<input type="hidden" name="number" value="<?php echo $multipleChoice["id"]?>">
			</p>
			<?php
			//Lade Fragen und gib diese aus
			$stmt = $dbh->prepare("SELECT * FROM multipleChoiceAnswers WHERE multipleChoice_id = :id ORDER BY RAND()");
			$stmt->bindParam(":id", $multipleChoice["id"]);
			$stmt->execute();
			$multipleChoiceAnswers = $stmt->fetchAll();
			foreach($multipleChoiceAnswers as $answers){
			?>
			<p>
				<input type="checkbox" name="<?php echo $answers["id"]?>" style="width: auto" ><?php echo $answers["antwort"]?>
			</p>
			<?php
			}
			?>
			<input type="submit" style="position: absolute; left: -9999px"/>
			<p>
				<a class="submit" href="javascript:void(0)" onclick="$('#multipleChoice').submit()">Absenden</a>
			</p>
		</div>
	</div>
</form>
</div>